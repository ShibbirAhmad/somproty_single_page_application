import Vue from 'vue'
import Vuex from 'vuex'

import router from './router.js'  // Vue router instance

Vue.use(Vuex)


const state = {

    //store admin
    admin: {},

    //initialize merchant 
    merchant: {},

    //store cart
    cartContent: {
        content: '',
        total: '',
        itemCount: ''
    },
    //store user

    user: {},
    //store categories
    categories: '',
    sub_categories: '',

    //store sliders
    sliders: '',

    //slider banner
    slider_banner: '',

    //category slider 
    category_sliders: '',

    //sub category slider 
    sub_category_sliders: '',

    //sub sub category slider 
    sub_sub_category_sliders: '',


    //store offer banner
    offer_banner: {},

    //store best selling products
    best_selling_produtcs: {},

    //for flash sale products
    sale_campaign: {},


    //for specific product
    single_product: {},

    //for product image
    product_images: {},

    //for check admin page view permisson
    view_permission:false,

    image_base_link: '/../storage/',

    //for home page products
    home_page_products: "",

    //for show sub sub category product on home page
    sub_sub_category_product: "",
   

    //general setting
    general_setting:"",

        
    //footer setting
    footer_setting:"",


    //theme setting
     theme_setting:"",





}
const getters = {
    admin(state) {
        return state.admin;
    },
    merchant(state) {
        return state.merchant;
    },
    cartContent(state) {
        return state.cartContent;
    },
    user(state) {
        return state.user;
    },
    admin(state) {
        return state.admin;
    },
    categories(state) {
        return state.categories;
    },
    sliders(state) {
        return state.sliders;
    },
    slider_banner(state) {
        return state.slider_banner;
    },
    category_sliders(state) {
        return state.category_sliders;
    },
    sub_category_sliders(state) {
        return state.sub_category_sliders;
    },

    sub_sub_category_sliders(state) {
        return state.sub_sub_category_sliders;
    },
    offer_banner(state) {
        return state.offer_banner;
    },
    best_selling_produtcs(state) {
        return state.best_selling_produtcs;
    },
    sub_categories(state) {
        return state.sub_categories;
    },
    sale_campaign(state) {
        return state.sale_campaign;
    },
    single_product(state) {
        return state.single_product;
    },
    view_permission(state) {
        return state.view_permission;
    },
    product_images(state) {
        return state.product_images;
    },
    image_base_link(state) {
        return state.image_base_link;
    },
    home_page_products(state) {
        return state.home_page_products;
    },
    sub_sub_category_product(state) {
        return state.sub_sub_category_product;
    },

    general_setting(state){
        return state.general_setting ;
    },

    footer_setting(state){
        return state.footer_setting ;
    },

    theme_setting(state){
        return state.theme_setting ;
    }



}
const actions = {

    //get authenticat user
    user(context) {
        axios.get('/_public/userToCheck')
            .then(resp => {
                if (resp.data.status == 'AUTHORIZED') {
                    context.commit('user', resp.data.user);
                } else {
                    // localStorage.setItem('user_tok')
                    localStorage.removeItem('user_tok')
                    localStorage.removeItem('user_token')
                }
            })
    },

    // merchant action in server
    merchant(context) {
        axios.get('/api/merchant/login/session/check')
            .then(resp => {
                //when session running
                if (resp.data.session == "running") {
                    context.commit('merchant', resp.data.merchant);
                }
                //when session expired
                if (resp.data.session == 'expired') {
                    localStorage.removeItem('merchant_token');
                    router.push({ name: 'merchant_login' });
                }
            })
    },

    //get cart content
    getCartContent(context) {
        axios.get('/_public/cartToContent')
            .then(resp => {

                context.commit('cartContent', resp.data);
                // console.log('data')
             })
    },
    //session check
    //every time this session check, for admin session running or expired
    admin(context) {
        axios.get("/check/session/admin")
            //if session status ruuning
            .then((resp) => {
                if (resp.data.status == "RUNNING") {
                    context.commit('admin', resp.data.admin)

                }

                //if session is expired, admin redirect ot login again
                if (resp.data.status == "EXPIRED") {
                    localStorage.removeItem("admin_token");
                    router.push({ name: "adminLogin" });
                    return;
                }
            })
            //error handaling
            .catch(() => {
                router.push({ name: "adminLogin" });
            });
    },

    //get category
    category(context) {
        axios.get("/_public/category")
            .then((resp) => {
                context.commit('category', resp.data.categories)
            })
            .catch((e) => {
                console.log(e.response.error)
             });
    },
     sub_categories(context, payload) {
        axios.get("/_public/sub/category/" + payload)
            .then((resp) => {
                context.commit('sub_categories', resp.data.sub_categories)
            })
            .catch((error) => {
                //   console.log('error');
            });
    },

    //get sliders 
    sliders(context) {
        axios
            .get("/_public/slider")
            .then((resp) => {
                //  console.log(resp)
                context.commit('sliders', resp.data.sliders);
                context.commit('slider_banner', resp.data.slider_banner)
                context.commit('best_selling_produtcs', resp.data.best_seller)
            })
            .catch((error) => { });
    },

    //get category sliders
    category_sliders(context) {
        axios.get('/_public/api/display/category/slider')
            .then(resp => {
                // console.log(resp);
                context.commit('category_sliders', resp.data.category_sliders);
            })
    },


    //get sub category sliders
    sub_category_sliders(context) {
        axios.get('/_public/api/display/sub/category/slider')
            .then(resp => {
                // console.log(resp);
                context.commit('sub_category_sliders', resp.data.sub_category_sliders);
            })
    },

    //get sub sub category sliders
    sub_sub_category_sliders(context) {
        axios.get('/_public/api/display/sub/sub/category/slider')
            .then(resp => {
                // console.log(resp);
                context.commit('sub_sub_category_sliders', resp.data.sub_sub_category_sliders);
            })
    },


    //get offer_banner 
    offer_banner(context) {
        axios.get("/_public/offers")
            .then((resp) => {
                context.commit('offer_banner', resp.data.offers)

            })
            .catch((error) => { });
    },


    //method initial for get campaign sale 
    sale_campaign(context) {
        axios.get("/_public/api/display/sale/campaign")
            .then((resp) => {
                console.log(resp)
                context.commit('sale_campaign', resp.data.sale_campaign)

            })
        // .catch((error) => { });
    },


    //method initial for get single product from db
    single_product(context, payload) {
        axios.get("/_public/product/" + payload).then((resp) => {
            
            document.title = resp.data.product.name+"- Mohasagor";
             context.commit('single_product', resp.data.product)

        });
    },

    //for get product images
    product_images(context, payload) {
        axios.get('/_public/product/images/' + payload)
            .then(resp => {
                console.log(resp.data);
                context.commit('product_images', resp.data)
            })
    },
    home_page_products(context) {
        axios.get('/_public/products/')
            .then(resp => {
                //  console.log(resp)
                context.commit('home_page_products', resp.data)
            })
            .catch(e => {
                // console.log(e);
            })
    },

    sub_sub_category_product(context) {
        axios.get("/_public/sub/sub/category/product")
            .then(resp => {
                // console.log(resp);
                context.commit('sub_sub_category_product', resp.data)
            })       

    },


    general_setting(context){
        axios.get("/_public/api/get/general/setting")
        .then(resp => {
            // console.log(resp);
            context.commit('general_setting', resp.data.general_setting);
        })       
    },

    footer_setting(context){
        axios.get("/_public/api/get/footer/setting")
        .then(resp => {
            // console.log(resp);
            context.commit('footer_setting', resp.data.footer_setting) ;
        })  
    },
    theme_setting(context){
        axios.get("/_public/api/get/theme/setting")
        .then(resp => {
            console.log(resp);
            context.commit('theme_setting', resp.data.theme_setting);
        })  
    },


}
const mutations = {
    admin(state, payload) {
        return state.admin = payload
    },

    merchant(state, payload) {
        return state.merchant = payload;
    },

    cartContent(state, cart) {
        state.cartContent.content = cart.cart_content;
        state.cartContent.total = cart.cart_total;
        state.cartContent.itemCount = cart.item_count;
    },
    user(state, payload) {
        return state.user = payload;

    },
    category(state, payload) {
        return state.categories = payload;
    },
    sub_categories(state, payload) {
        return state.sub_categories = payload;
    },
    sliders(state, payload) {
        return state.sliders = payload;
    },
    slider_banner(state, payload) {
        return state.slider_banner = payload;
    },


    category_sliders(state, payload) {
        return state.category_sliders = payload;
    },

    sub_category_sliders(state, payload) {
        return state.sub_category_sliders = payload;
    },

    sub_sub_category_sliders(state, payload) {
        return state.sub_sub_category_sliders = payload;
    },

    offer_banner(state, payload) {
        return state.offer_banner = payload;
    },
    best_selling_produtcs(state, payload) {
        return state.best_selling_produtcs = payload;
    },
    sale_campaign(state, payload) {
        return state.sale_campaign = payload;

    },

    single_product(state, payload) {
        return state.single_product = payload;
    },

    product_images(state, payload) {
        return state.product_images = payload;
    },
    home_page_products(state, payload) {
        return state.home_page_products = payload;
    },
    sub_sub_category_product(state, payload) {
        return state.sub_sub_category_product = payload;

    },

    general_setting(state,payload){
       return state.general_setting=payload ;
    },

    
    footer_setting(state,payload){
        return state.footer_setting=payload ;
     },
 

    theme_setting(state,payload){
        return state.theme_setting=payload ;
     },
 
 



}

const store = new Vuex.Store({
    
    state: state,
    mutations: mutations,
    getters: getters,
    actions: actions

})

global.store = store;

export default store;

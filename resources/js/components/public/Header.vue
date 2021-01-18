<template>
  <div class="header">
    
    <div class="header-top">
      <div class="container flex">
        <div class="header-top-left">
          <!-- <li>
            <i class="fa fa-envelope"></i>
            <span>some@gmail.com</span>
          </li> -->
          <li>
            <i class="fa fa-phone"></i>
            <span>{{ general_setting.header_contact_number }}</span>
          </li>
        </div>
        <div class="header-top-right">
          <!-- <li>

            <i class="fa fa-envelope"></i>
            <span>Reseller</span>
          </li> -->
          <!-- <li>
            <i class="fa fa-phone"></i>
            <span>01795297424</span>
          </li> -->
            <li>
            <i class="fa fa-users"></i>
            <span> <router-link style="color:#fff;"  target="_blank" :to="{name : 'merchant_login' }" >Login</router-link> </span>
          </li>
          <li>
            <i class="fa fa-user"></i>
            <span> <a style="color:#fff;" :href="'/_reseller/login'" >SignUp</a> </span>
          </li>

        </div>
      </div>
    </div>
    <div class="main-header">
      <div class="container flex">
        <div class="main-header-left">
          <li id="toggle-menu" >
            <i class="fa fa-bars"></i>
          </li>
          <li>
            <router-link :to="{name:'welcome'}">
              <img :src="base_url+general_setting.logo" class="site-logo"  />
            </router-link>
          </li>
          <li>
            <form @submit.prevent="subMitAutoComppleteForm">
            <input type="text"
              placeholder="searh products "
              class="search-input"
               @keyup="autocomplteSearch"
               v-model="search"/>
            <button class="search-btn"><i class="fa fa-search"></i></button>
             <div class="search-content" v-if="search_products.length >= 1">
                <ul class="list-group">
                  <li
                    class="list-group-item"
                    v-for="(product,index) in search_products"
                    :key="index"
                  >
                    <router-link
                      :to="{ name: 'single', params: { slug: product.slug }}"
                      class="search-router-link"
                    >{{product.name + '-' + product.product_code}}</router-link>
                  </li>
                </ul>
              </div>
              </form>
          </li>
          <li>
            <ul class="s-menu">

              <li>
                <router-link :to="{name:'all_products'}">All Products</router-link>

              </li>
            
            </ul>
          </li>
        </div>
        <div class="main-header-right">
          <li v-if="Object.keys(user).length">
            <div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{ user.name }}
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="padding: 15px 15px;">
    <router-link :to="{name:'UserDashboard'}" class="dropdown-item" href="#">Dashboard</router-link><br/><br/>
    <a class="dropdown-item" href="#" @click="Logout">Logout</a>
   
  </div>
</div>
          </li>
          <li v-else>
            <router-link style="color:#000;font-size:16px;" :to="{name:'UserLogin'}">
              <!-- <i class="fa fa-user"></i> -->
              <!-- Login/Signup -->
            </router-link>
          </li>

         </div>
      </div>
    </div>
    <!-- <div class="menu" id="navbar">
      <ul class="menu-list" id="menu-list">
        <li v-for="category in categories" :key="category.id" class="menu-item">
          <router-link  :to="{name: 'PublcaCategory',params: { slug: category.slug },}" class="menu-item-link">
            {{ category.name }}
             </router-link>
           <i class="fa fa-angle-down menu-icon"></i>
           <ul class="sub-item-list" v-if="category.sub_category.length > 0">
             <li class="sub-item" v-for="sub_category in category.sub_category" :key="sub_category.id">
               <router-link  :to="{ name: 'PublicSubCategory',params: { slug: sub_category.slug }}" class="sub-item-link">{{sub_category.name}}</router-link>
                <i class="fa fa-angle-down sub-menu-icon"></i>
                <ul class="sub-sub-item-list" v-if="sub_category.sub_sub_category.length">
                  <li class="sub-sub-item" v-for="sub_sub_category in sub_category.sub_sub_category" :key="sub_sub_category.id">
                    <router-link :to="{ name: 'PublicSubSUbCategory', params: { slug: sub_sub_category.slug}}" class="sub-sub-item-link">{{sub_sub_category.name}}</router-link>
                     <i class="fa fa-angle-down sub-sub-menu-icon"></i>
                  </li>
                </ul>
             </li>
             
           </ul>
        </li>
      </ul>
    </div> -->

  
   <div class="cart" id="s-cart">
      <div class="cart-header" @click="cartClosed">
       
        <h4 id="exitcart" class="exitC">CLOSED</h4>
       </div>
       <div class="cart-body">
       <div class="row cart_row"  v-for="(cart_content,index) in cart.content" :key="index" style="border-bottom:1px solid #ddd" >
        
         <div class="col-lg-5  col-sm-5   flex" style="align-items:center;">
           <ul class="p-image-name" style=" display: flex;margin: 0;padding: 0px 0px;">
               <li>
                 <img :src="base_url+cart_content.options.image[0].product_image" style="max-width:35px;max-height:35px;" alt="">

           </li>
          <li>{{ cart_content.name }}</li>
           </ul>
         </div>
         <div class="col-lg-2  col-sm-2  cart_responsive_item flex">
          <u style="text-decoration:none;">
             <li class="q-i-d"  @click="increamentQuantity(cart_content)">
             <i class="fa fa-angle-up"></i>
           </li>
            <li>{{ cart_content.qty }}</li>
             <li class="q-i-d"  @click="decreamentQuantity(cart_content)">
                 <i class="fa fa-angle-down" ></i>

             </li>
          </u>
       
         </div>
         <div class="col-lg-2 col-sm-2 cart_responsive_price  ">
          <h6>{{ cart_content.price }}</h6>
         </div>
         <div class="col-lg-2 col-sm-2  cart_responsive_total  ">
          <h6>{{ cart_content.price*cart_content.qty }}</h6>
         </div>
          <div class="col-lg-1 col-sm-1  cart_responsive_remove ">
          <h6 class="text-danger" style="cursor:pointer;" @click="cartRemove(cart_content)">X</h6>
         </div>
         
        </div>

       
     </div>
      <div class="cart-empy" v-if="cart.itemCount <=0">
             <img :src="base_url+'images/static/cartEmpty.jpg'" />
            <p>Your cart is empty</p>
         </div>
      <div class="cart-footer">
        <router-link :to="{name:'Chekout'}"  class="btn btn-block placebtn" href="#">Place Order | {{ cart.total }}</span></router-link>
      </div>
      </div>

    <div class="cart-open"  @click="cartOpen">
      <div class="cart-total">
      <i class="fa fa-shopping-bag"></i>
      <h5>{{ cart.total }}</h5>
      </div>
      <div class="cart-item-total">
        {{ cart.itemCount }} items
      </div>
    </div>
 
    
  </div>
</template>

<script>
export default {

  name: "main-header",
  //props: ["categories"],
  
 
  data() {
    return {
      renderComponent: false,
      cartContents: null,
      cartTotal: "",
     
      display: "none",

      base_url:this.$store.state.image_base_link,
      search_products: [],
      search: "",
    };
  },
  methods: {
    category() {
      axios
        .get("_public/category")
        .then((resp) => {
          //  this.categories = resp.data.categories;
          this.renderComponent = true;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    increamentQuantity(cartContent) {
      let quantity = parseInt(cartContent.qty) + parseInt(1);
      axios
        .get("/_public/cartToUpdate", {
          params: {
            qty: quantity,
            rowId: cartContent.rowId,
          },
        })
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.$store.dispatch("getCartContent");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    decreamentQuantity(cartContent) {
      if (cartContent.qty == 1) {
        alert("Qauntity shoud be at least 1");
        return;
      }

      let quantity = parseInt(cartContent.qty) - parseInt(1);
      axios
        .get("/_public/cartToUpdate", {
          params: {
            qty: quantity,
            rowId: cartContent.rowId,
          },
        })
        .then((resp) => {
          if (resp.data.status == "SUCCESS") {
            this.$store.dispatch("getCartContent");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    cartRemove(cartContent) {
      if (confirm("are you sure remove this item?")) {
        axios
          .get("/_public/cartToDestroy", {
            params: {
              rowId: cartContent.rowId,
            },
          })
          .then((resp) => {
            console.log(resp);
            if (resp.data.status == "SUCCESS") {
              this.$store.dispatch("getCartContent");
            }
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    changeDisplay() {
      if (this.display == "block") {
        this.display = "none";
      } else {
        this.display = "block";
      }
    },

    Logout() {
      axios
        .get("/_public/user/logout")
        .then((resp) => {
          console.log(resp);
          this.user = null;
         localStorage.removeItem("user_token");
            location.reload();
           
          
        })
        .catch();
    },

    autocomplteSearch() {
      if (this.search.length > 1) {
        axios
          .get("/_public/search/products/" + this.search)
          .then((resp) => {
            if (resp.data.length) {
              this.search_products = [];
              this.search_products.push(...resp.data);
            } else {
              this.search_products = [];
            }
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        this.search_products = [];
      }
    },
    subMitAutoComppleteForm() {
      this.$router.push({
        name: "PublicProductSearch",
        params: { search: this.search },
      });
    },
    menuShow() {
      let menu = document.getElementsByClassName("side-nav")[0];
      //  console.log(menu);
      menu.classList.toggle("nav-active");
    },
    cartOpen(){
       document.getElementById('s-cart').classList.add('colapse-cart');
     },
     cartClosed(){
       document.getElementById('s-cart').classList.remove('colapse-cart');
    }
  },

  mounted() {
   this.$store.dispatch("getCartContent");
    this.$store.dispatch("user");
    this.$store.dispatch("category");
    this.$store.dispatch("general_setting");
  },
  computed: {
    user() {
      return this.$store.getters.user;
    },
    categories() {
      return this.$store.getters.categories;
    },
    cart(){
      return  this.$store.getters.cartContent;
    },

    general_setting(){
       return this.$store.getters.general_setting;
    }


  },
};


</script>



import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import ExampleComponent from "./components/ExampleComponent";
import ExampleComponentTwo from "./components/ExampleComponentTwo";

import Category from "./components/admin/category/Category";
import CategoryAdd from "./components/admin/category/Add";
import CategoryEdit from "./components/admin/category/Edit";

import Subcategory from "./components/admin/subCategory/SubCategory";
import SubCategoryAdd from "./components/admin/subCategory/Add";
import SubCategoryEdit from "./components/admin/subCategory/Edit";

import SubSubCategory from "./components/admin/subSubCategory/SubSubCategory";
import SubSubCategoryAdd from "./components/admin/subSubCategory/Add";
import SubSubCategoryEdit from "./components/admin/subSubCategory/Edit";

import Slider from "./components/admin/slider/Slider";
import SliderAdd from "./components/admin/slider/Add";
import SliderEdit from "./components/admin/slider/Edit";


import CategorySlider from "./components/admin/Category_slider/Index";
import CategorySliderAdd from "./components/admin/Category_slider/Add";
import CategorySliderEdit from "./components/admin/Category_slider/Edit";


import AttributeAdd from "./components/admin/attribute/Add";
import Attribute from "./components/admin/attribute/Attribute";

import VariantAdd from "./components/admin/variant/Add";
import Variant from "./components/admin/variant/Variant";


import AddSupplier from "./components/admin/supplier/Add";
import EditSupplier from "./components/admin/supplier/Edit";
import Supplier from "./components/admin/supplier/Supplier";
import SupplierAmount from "./components/admin/supplier/Amount";
import AddFabricsSupplier from "./components/admin/supplier/AddFabricsSupplier";
import FabricsSupplier from "./components/admin/supplier/FabricsSupplier";


import AddCity from "./components/admin/city/Add";
import EditCity from "./components/admin/city/Edit";
import City from "./components/admin/city/City";

//sub city router is here
import AddSubCity   from  "./components/admin/sub_city/Add.vue";
import EditSubCity  from  "./components/admin/sub_city/Edit.vue";
import SubCity      from  "./components/admin/sub_city/Index.vue";

import AddRole from "./components/admin/role/Add";
import Role from "./components/admin/role/Role";
import EditPermissions from "./components/admin/role/Permissions";



import AddCompany from "./components/admin/company/Add";
import EditCompany from "./components/admin/company/Edit";
import Company from "./components/admin/company/Company";




import AddCredit from "./components/admin/credit/Add";
import EditCredit from "./components/admin/credit/Edit";
import Credit from "./components/admin/credit/Credit";
import CreditDue from "./components/admin/credit/Due";


import AddDebit from "./components/admin/debit/Add";
import EditDebit from "./components/admin/debit/Edit";
import Debit from "./components/admin/debit/Debit";

import AddOffer from "./components/admin/offer/Add";
import EditOffer from "./components/admin/offer/Edit";
import Offer from "./components/admin/offer/Offer";

import AddCourier from "./components/admin/courier/Add";
import EditCourier from "./components/admin/courier/Edit";
import Courier from "./components/admin/courier/Courier";

import AddComment from "./components/admin/comment/Add";
import EditComment from "./components/admin/comment/Edit";
import Comment from "./components/admin/comment/Comment";


import AddFactory from "./components/admin/factory/Add";
import EditFactory from "./components/admin/factory/Edit";
import Factory from "./components/admin/factory/Index";


import AddProduct from "./components/admin/product/Add";
import EditProduct from "./components/admin/product/Edit";
import Product from "./components/admin/product/Product";



import AddPurchase from "./components/admin/purchase/Add";
import EditPurchase from "./components/admin/purchase/Edit";
import Purchase from "./components/admin/purchase/Purchase";
import ViewPurchase from "./components/admin/purchase/View";

import AddPurchaseFabrics from "./components/admin/purchase/AddFabricsPurchase";
import ManagePurchaseFabrics from "./components/admin/purchase/ManageFabricsPurchase";

// account purpose 
import accountPurpose from "./components/admin/account/accountPurpose" ;
import accountPurposeAdd from "./components/admin/account/Add" ;
import accountPurposeEdit from "./components/admin/account/Edit" ;

import TeamMember from "./components/admin/team/index" ;
import AddTeamMember from "./components/admin/team/Add" ;
import EditTeamMember from "./components/admin/team/Edit";
import TeamSalary from "./components/admin/team/Salary";
import SalaryDetails from "./components/admin/team/SalaryDetails";


import AddSale from "./components/admin/sale/Add";
import AddSaleExchange from "./components/admin/sale/Exchange";

import AddCompanySale from "./components/admin/sale/AddCompanySale";

import OfficeSale from "./components/admin/sale/OfficeSale";
import CompanySale from "./components/admin/sale/CompanySale";
import selling_offer from "./components/admin/selling_offer/index";
import add_selling_offer from "./components/admin/selling_offer/Add";
import edit_selling_offer from "./components/admin/selling_offer/Edit";

import ViewSale from "./components/admin/sale/View";





import AddOrder from "./components/admin/order/Add";
import AddWholeSale from "./components/admin/order/AddWholeSale";

 import EditOrder from "./components/admin/order/Edit";
import Order from "./components/admin/order/Order";
import ApprovedOrder from "./components/admin/order/Approved";
import NewOrder from "./components/admin/order/New";
import PendingOrder from "./components/admin/order/Pending";
import ShipmentOrder from "./components/admin/order/Shipment";
import DeliveredOrder from "./components/admin/order/Delivered";
import ReturnOrder from "./components/admin/order/Return";
import CancelOrder from "./components/admin/order/Cancel";
import WholeSaleOrder from "./components/admin/order/Wholesale";

// components fo sms campaign
import SMS_campaign from "./components/admin/sms/Send" ;

//component of subscriber and contact message
import SubscriberList from "./components/admin/subscriber/Index" ;
import ContactMessage from "./components/admin/contact/Index" ;
import ContactMessageReply from "./components/admin/contact/Reply" ;

import ViewOrder from "./components/admin/order/View";


import Admin from "./components/admin/Index.vue";
import AdminLogin from "./components/admin/Login.vue";

import AdminList from "./components/admin/admin/Admin" ;
import addAdmin from "./components/admin/admin/Add" ;
import editAdmin from "./components/admin/admin/Edit";
import AssignRoleAdmin from "./components/admin/admin/Role";
import AssignAdminPermission from "./components/admin/admin/AdminPermission";

import adminPasswordChange from "./components/admin/admin/Password" ;
import AdminProfile from "./components/admin/admin/Profile.vue";

import fondtransfer from "./components/admin/fondtransfer/Index";
import fondtransferAdd from "./components/admin/fondtransfer/Add";

import Welcome from "./components/public/Index";
import SingleProduct from "./components/public/SingleProduct";
import PublicCategory from "./components/public/CategoryWiseProduct";

import UserDashboard from  "./components/public/user/Dashboard" ;
import UserLogin from "./components/public/Login";
import UserPasswordReset from "./components/public/PasswordReset";
import CodeVerified from "./components/public/CodeVerified";
import NewPasswordUser from "./components/public/NewPassword";


import UserRegister from "./components/public/user/Register";
import OrderHistory from "./components/public/user/OrderHistory";
import OrderDetails from "./components/public/user/OrderDetails";
import UserProfile from "./components/public/user/Profile";
import UserProfileEdit from "./components/public/user/Edit";
import PasswordEdit from "./components/public/user/Password";
// import UserPasswordReset from "./components/public/userPasswordReset";

import Checkout from "./components/public/Checkout";
import SubCategoryProduct from "./components/public/SubCategoryProduct";
import SubSubCategoryProduct from "./components/public/SubSubCategoryProduct";

import SearchProduct from "./components/public/SearchProduct";

import AboutUs from "./components/public/Aboutus";
import ContactUs from "./components/public/Contactus";

//return policy,blog,reseller  etc. component 
import AboutSeller from "./components/public/policy_and_info/About_seller" ;
import Blog from "./components/public/policy_and_info/Blog" ;
import HowToBuy from "./components/public/policy_and_info/how_to_buy" ;
import ReturnPolicy from "./components/public/policy_and_info/return_policy" ;
import Shipment from "./components/public/policy_and_info/Shipment" ;
import Team from "./components/public/policy_and_info/Team" ;

import OrderReport from "./components/admin/Report/OrderReport";
import OfficeSaleReport from "./components/admin/Report/OfficeSale";
import SaleProfite from "./components/admin/Report/SaleProfite";
import AccountReport from "./components/admin/Report/Account";
import ProductSock from "./components/admin/Report/ProductStock";
import PurchaseReport from "./components/admin/Report/Purchase";
import SupplierReport from "./components/admin/Report/SupplierReport";
import ProfiteReport from "./components/admin/Report/Profite";
import OrderProfite from "./components/admin/Report/OrderProfite";





import resellerHome from "./components/admin/reseller/index" ;
import  resellerAdd from "./components/admin/reseller/Add" ;
import resellerEdit from "./components/admin/reseller/Edit";
import UnpaidPayment from "./components/admin/reseller/UnpaidPayment";
import paidPayment from "./components/admin/reseller/paidPayment";
import PaymentInvoice from "./components/admin/reseller/PaymentInvoice";
import paymentDetails from "./components/admin/reseller/paymentDetails";



import user from "./components/admin/user/index" ;
import customer from "./components/admin/customer/index";

//component of public | frontend carrier
import CarrierPublic from "./components/public/carrier/index";
import CarrierDetails from "./components/public/carrier/CarrierDetails";


// component of backend carrier crud
import HomeCarrier from "./components/admin/carrier/index" ;
import AddCarrier  from "./components/admin/carrier/Add" ;
import ShowCarrier  from "./components/admin/carrier/Show" ;
import EditCarrier from "./components/admin/carrier/Edit" ;
import AppliedUsers from "./components/admin/carrier/jobApplied" ;


//component for merchant management in admin backend 
import  Merchant from "./components/admin/merchant/index" ;
import  AddMerchant from "./components/admin/merchant/Add" ;
import  EditMerchant from "./components/admin/merchant/Edit" ;


// merchant component in merchant self backend 
import MerchantRegister     from   "./components/merchant/Register" ;
import MerchantDashboard     from   "./components/merchant/Dashboard" ;
import MerchantLogin from "./components/merchant/Login";
import MerchantPasswordReset from "./components/merchant/PasswordReset";
import MerchantCodeVerified from "./components/merchant/CodeVerified";
import NewPasswordMerchant from "./components/merchant/NewPassword";


import MerchantProductMenage from   "./components/merchant/product/Menage" ;
// merchant product component
import MerchantProductAdd    from   "./components/merchant/product/Add" ;
import MerchantProductEdit   from   "./components/merchant/product/Edit" ;

//merchant order component
import MerchantOrder from "./components/merchant/order/Index" ;
import MerchantOrderView from "./components/merchant/order/View" ;

//merchant profile component 
import MerchantProfile       from   "./components/merchant/profile/Profile" ;
import MerchantProfileEdit   from   "./components/merchant/profile/Change_profile" ;
import MerchantPasswordEdit   from   "./components/merchant/profile/Change_password" ;


//loaner
import loaner from "./components/admin/loaner/Loaner";
import loanerAdd from "./components/admin/loaner/Add";
import loanerEdit from "./components/admin/loaner/Edit";

//loaner
import loan from "./components/admin/loan/Loan";
import loanAdd from "./components/admin/loan/Add";
// import loanerEdit from "./components/admin/loaner/Edit";

    
//sale campaign router is start from here
import SaleCampaign      from   "./components/admin/sale_campaign/Index.vue";
import AddSaleCampaign   from   "./components/admin/sale_campaign/Add.vue";
import EditSaleCampaign  from   "./components/admin/sale_campaign/Edit.vue";

import GeneralSetting    from   "./components/admin/general_setting/General.vue";
import FooterSetting     from   "./components/admin/footer_setting/Index.vue";
import BackgroundAndColorSetting from "./components/admin/background_and_color/Index.vue";


import AboutAndContact from "./components/admin/page_info/AboutContact.vue";
import OrderShipmentAndReturn from "./components/admin/page_info/OrderShipmentReturn.vue";
 

import AllProducts    from "./components/public/AllProducts.vue" ;



const routes = [

    {
        path: '/',
        component: Welcome,
        name: 'welcome',
        props: true,
        meta: {
            title:"Online Shopping In Bangladesh: Fashion, Electronics- Mohasagor.com"
        }

    },

    {
        path: '/public/carrier',
        component: CarrierPublic ,
        name : 'carrier_public',
        meta :{
            title : 'Carrier '
        }
    },

     
    {
        path: '/public/all/products',
        component: AllProducts ,
        name : 'all_products',
        meta :{
            title : 'all products '
        }
    },

    {
        path: '/public/carrier/details/:id',
        component: CarrierDetails ,
        name : 'carrier_details',
        meta :{
            title : 'Carrier Details '
        }
    },
    {
        path: '/public/product/view/:slug',
        component: SingleProduct,
        name: 'single',
        props: true,
        meta: {
            title: 'Singe product'
        }
    },

    {
        path: '/public/category/products/:slug',
        component: PublicCategory,
        name: 'PublcaCategory',

        meta: {
            title: 'Category wise product'
        }
    },

    {
        path: '/public/sub/caetgory/products/:slug',
        component: SubCategoryProduct,
        name: 'PublicSubCategory',

        meta: {
            title: 'sub-category wise product'
        }
    },

    {
        path: '/public/sub/sub/caetgory/products/:slug',
        component: SubSubCategoryProduct,
        name: 'PublicSubSUbCategory',

        meta: {
            title: 'sub-sub-category wise product'
        }
    },

    {
        path: '/public/products/search/:search',
        component: SearchProduct,
        name: 'PublicProductSearch',

        meta: {
            title: 'search product'
        }
    },

    {
        path: '/public/how/to/buy',
        component: HowToBuy,
        name: 'how_to_buy',

        meta: {
            title: 'How To Buy|| Product '
        }
    },

    {
        path: '/public/return/policy',
        component: ReturnPolicy,
        name: 'return_policy',

        meta: {
            title: ' Return || Policy '
        }
    },
    
    {
        path: '/public/team',
        component: Team,
        name: 'team',

        meta: {
            title: ' Team  '
        }
    },

    {
        path: '/public/blog',
        component: Blog,
        name: 'blog',

        meta: {
            title: ' Blog  '
        }
    },

     {
        path: '/public/shipment',
        component: Shipment,
        name: 'shipment',

        meta: {
            title: ' shipment '
        }
    },

    
    

    {
        path: '/public/about/seller',
        component: AboutSeller,
        name: 'about_seller',

        meta: {
            title: ' About Seller '
        }
    },


    {
        path: '/public/about/us',
        component: AboutUs,
        name: 'AboutUs',

        meta: {
            title: 'About||us'
        }
    },
    {
        path: '/public/contact/us',
        component: ContactUs,
        name: 'ContactUs',

        meta: {
            title: 'Contact||us'
        }
    },

    {
        path : '/public/user/dashboard',
        component : UserDashboard ,
        name : 'UserDashboard',
        meta : {
            title : 'Customer || Dashboard '
        }
    },


    {
        path: '/public/user/login',
        component: UserLogin,
        name: 'UserLogin',
        meta: {
            title: 'Login || User'
        }

    },

    {
        path: '/public/user/reset/password',
        component: UserPasswordReset,
        name: 'user_password_reset',
        meta: {
            title: 'Forgotten || User'
        }

    },


    {
        path: '/public/user/password/reset',
        component: UserPasswordReset,
        name: 'UserPasswordReset',
        meta: {
            title: 'Password Reset'
        }
    },
    {
        path: '/public/user/code/verify/:email',
        component: CodeVerified,
        name: 'CodeVerified',
        meta: {
            title: 'Password Reset'
        }
    },

    {
        path: '/public/user/reset/password/:email',
        component: NewPasswordUser,
        name: 'NewPasswordUser',
        meta: {
            title: 'Update Password'
        }
    },
    
     
    {
        path: '/public/user/register',
        component: UserRegister,
        name: 'UserRegister',
        meta: {
            title: 'Register || User'
        }

    },
    {
        path: '/public/user/Checkout',
        component: Checkout,
        name: 'Chekout',
        meta: {
            title: 'Checkout || User',
            requiresAuthUser: true,

        }

    },
    {
        path: '/public/user/order/history',
        component: OrderHistory,
        name: 'OrderHistory',
        meta: {
            title: 'Order || History',
            requiresAuthUser: true,

        }

    },

    {
        path: '/public/user/order/details/:id',
        component: OrderDetails,
        name: 'order_details',
        meta: {
            title: 'Order || Details',
            requiresAuthUser: true,

        }

    },

    {
        path: '/public/user/password',
        component: PasswordEdit,
        name: 'PasswordEdit',
        meta: {
            title: 'password || Update',
            requiresAuthUser: true,

        }

    },

    {
        path: '/public/user/profile',
        component: UserProfile,
        name: 'UserProfile',
        meta: {
            title: 'Prilfe || User',
            requiresAuthUser: true,

        }

    },

    {
        path: '/public/user/profile/edit',
        component: UserProfileEdit,
        name: 'UserProfileEdit',
        meta: {
            title: 'Prilfe || Edit',
            requiresAuthUser: true,

        }

    },

    {
        path: '/example',
        component: ExampleComponentTwo,
    },

     {
         path: '/merchant/backend/login' ,
         component : MerchantLogin,
         name : 'merchant_login',
         meta : {
             title : 'Merchant|Login'
         }
    },
     

    {
        path: '/public/merchant/password/reset',
        component: MerchantPasswordReset,
        name: 'merchant_password_reset',
        meta: {
            title: 'Merchant Password Reset'
        }
    },
    {
        path: '/public/merchant/code/verify/:phone',
        component: MerchantCodeVerified,
        name: 'merchant_code_verified',
        meta: {
            title: 'Merchant Password Reset'
        }
    },

    {
        path: '/public/merchant/reset/new/password/:phone',
        component: NewPasswordMerchant,
        name: 'new_password_merchant',
        meta: {
            title: 'Update Merchant Password'
        }

    },


     {
        path: '/public/merchant/register' ,
        component : MerchantRegister,
        name : 'merchant_register',
        meta : {
            title : 'Merchant | Register '
        }
 },
     
     {
        path: '/merchant/backend/home' ,
        component : MerchantDashboard,
        name : 'merchant_dashboard',
        meta : {
            title : 'Merchant|Dashboard'
        }

    },

     
    {
        path: '/merchant/backend/product/menage' ,
        component : MerchantProductMenage,
        name : 'merchant_product_menage',
        meta : {
            title : 'Product|Manage'
        }
    },

    {
        path: '/merchant/backend/product/add' ,
        component : MerchantProductAdd,
        name : 'merchant_product_add',
        meta : {
            title : ' Product | Add '
        }

    },


    {
        path: '/merchant/backend/product/edit/:id' ,
        component : MerchantProductEdit,
        name : 'merchant_product_edit',
        meta : {
            title : ' Product | Edit '
        }

    },
 
    {
        path: '/merchant/backend/order' ,
        component : MerchantOrder,
        name : 'merchant_order',
        meta : {
            title : 'Order Info'
        }
    },
    
    {
        path: '/merchant/backend/order/view/:id',
        component : MerchantOrderView,
        name : 'merchant_order_view',
        meta : {
            title : 'order details info '
        }

    },
     {
        path: '/merchant/backend/profile' ,
        component : MerchantProfile,
        name : 'merchant_profile',
        meta : {
            title : ' Profile info '
        }
 },

    {
        path: '/merchant/backend/profile/edit' ,
        component : MerchantProfileEdit,
        name : 'merchant_profile_edit',
        meta : {
            title : ' Profile info | Edit '
        }

    },

    {
        path: '/merchant/backend/security/edit' ,
        component : MerchantPasswordEdit,
        name : 'merchant_password_edit',
        meta : {
            title : ' Password | Edit '
        }

    },



    {
        path: '/backend/dashboard',
        component: Admin,
        name: 'dashboard',
        meta: {
            requiresAuthAdmin: true,
            title: 'Dashboard'

        }
    },
    {
        path: '/backend/category',
        component: Category,
        name: "category",
        meta: {
            requiresAuthAdmin: true,
            title: 'category'
        }
    },
    {
        path: '/backend/categoryEdit/:categoryId',
        component: CategoryEdit,
        name: "CategoryEdit",
        meta: {
            requiresAuthAdmin: true,
            title: 'category || edit'
        }
    },
    {
        path: '/backend/categoryAdd',
        component: CategoryAdd,
        name: "categoryAdd",
        meta: {
            requiresAuthAdmin: true,
            title: 'category || add'

        }
    },

    {
        path: '/backend/subcategory',
        component: Subcategory,
        name: 'SubCategory',
        meta: {
            requiresAuthAdmin: true,
            title: 'subCategory'
        }
    },
    {
        path: '/backend/subcategoryAdd',
        component: SubCategoryAdd,
        name: "subcategoryAdd",
        meta: {
            requiresAuthAdmin: true,
            title: 'sub category add'
        }
    },
    {
        path: '/backend/subcategoryEdit/:id',
        component: SubCategoryEdit,
        name: "subcategoryEdit",
        meta: {
            requiresAuthAdmin: true,
            title: 'sub category edit'
        }
    },

    {
        path: '/backend/subSubCategory',
        component: SubSubCategory,
        name: 'subSubCategory',
        meta: {
            requiresAuthAdmin: true,
            title: 'sub sub category'
        }
    },
    {
        path: '/backend/subSubCategoryAdd',
        component: SubSubCategoryAdd,
        name: "subSubCategoryAdd",
        meta: {
            requiresAuthAdmin: true,
            title: 'sub sub category add'
        }
    },
    {
        path: '/backend/subSubCategoryEdit/:id',
        component: SubSubCategoryEdit,
        name: "subSubCategoryEdit",
        meta: {
            requiresAuthAdmin: true,
            title: 'sub sub subcategory || Edit'
        }
    },

    {
        path: '/backend/slider',
        component: Slider,
        name: 'slider',
        meta: {
            requiresAuthAdmin: true,
            title: 'slider'
        }
    },
    {
        path: '/backend/sliderAdd',
        component: SliderAdd,
        name: "sliderAdd",
        meta: {
            requiresAuthAdmin: true,
            title: 'slider || add'
        }
    },
    {
        path : '/backend/sliderEdit/:id',
        component : SliderEdit,
        name : 'sliderEdit',
        meta : {

             requiresAuthAdmin : true ,
             title : 'slider || edit'
        }
    },


    
    {
        path: '/backend/category/slider',
        component: CategorySlider,
        name: 'category_slider',
        meta: {
            requiresAuthAdmin: true,
            title: 'category slider'
        }
    },
    {
        path: '/backend/category/slider/add',
        component: CategorySliderAdd,
        name: "category_slider_add",
        meta: {
            requiresAuthAdmin: true,
            title: 'category slider || add'
        }
    },
    {
        path : '/backend/category/slider/edit/:id',
        component : CategorySliderEdit,
        name : 'category_slider_edit',
        meta : {

             requiresAuthAdmin : true ,
             title : 'category slider || edit'
        }
    },

    {
        path: '/backend/category/slider',
        component: CategorySlider,
        name: 'CategorySlider',
        meta: {

            requiresAuthAdmin: true,
            title: 'category|slider'
        }
    },
    {
        path: '/backend/category/slider/add',
        component: CategorySliderAdd,
        name: 'CategorySliderAdd',
        meta: {
            requiresAuthAdmin: true,
            title: 'add|category|slider'
        }
    },
    {
        path: '/backend/category/slider/edit/:id',
        component: CategorySliderEdit,
        name: 'CategorySliderEdit',
        meta: {
            requiresAuthAdmin: true,
            title: 'add|category|slider'
        }
    },
    {
        path: '/backend/attribute',
        component: Attribute,
        name: "attribute",
        meta: {
            requiresAuthAdmin: true,
            title: 'attribute'
        }
    },
    {
        path: '/backend/attributeAdd',
        component: AttributeAdd,
        name: "attributeAdd",
        meta: {
            requiresAuthAdmin: true,
            title: 'attribute || add'
        }
    },

    {
        path: '/backend/reseller/menage',
        component: resellerHome,
        name  :'resellerHome',
        props : true ,
        meta : {
            title : 'Reseller | Menage',
            requiresAuthAdmin: true,
        }
    },

    {
        path: '/backend/reseller/add',
        component: resellerAdd,
        name  :'resellerAdd',
        props : true ,
        meta : {
            title : 'Reseller | Add',
            requiresAuthAdmin: true,
        }
    },

    {
        path: '/backend/reseller/edit/:id',
        component: resellerEdit,
        name  :'resellerEdit',
        meta : {
            title : 'Reseller | Edit',
            requiresAuthAdmin: true,
        }
    },
    {
        path: '/backend/reseller/un/paid/payment',
        component: UnpaidPayment,
        name: 'UnpaidPayment',
        props: true,
        meta: {
            title: 'Unpaid|payment|Reseller',
            requiresAuthAdmin: true,
        }
    },
    {
        path: '/backend/reseller/paid/payment',
        component: paidPayment,
        name: 'paidPayment',
        props: true,
        meta: {
            title: 'paid|payment|Reseller',
            requiresAuthAdmin: true,
        }
    },
    {
        path: '/backend/reseller/payment/invoice',
        component: PaymentInvoice,
        name: 'PaymentInvoice',
        props: true,
        meta: {
            title: 'paid|payment|Reseller',
            requiresAuthAdmin: true,
        }
    },

    {
        path: '/backend/reseller/payment/invoice/:id',
        component: paymentDetails,
        name: 'paymentDetails',
        props: true,
        meta: {
            title: 'paid|payment|Reseller',
            requiresAuthAdmin: true,
        }
    },
    
    
    
    

    {
        path:'/backend/user/list',
        component: user,
        name: 'user',
        meta:{
            title : 'User | List',
            requiresAuthAdmin : true ,
        }
    },

    {
        path:'/backend/customer/list',
        component: customer,
        name: 'customer',
        meta:{
            title : 'customer | List',
            requiresAuthAdmin : true ,
        }
    },

    {
        path: '/backend/variant',
        component: Variant,
        name: "variant",
        meta: {
            requiresAuthAdmin: true,
            title: 'variant'
        }
    },
    {
        path: '/backend/variantAdd',
        component: VariantAdd,
        name: "variantAdd",
        meta: {
            requiresAuthAdmin: true,
            title: 'variant add'
        }
    },

    {
        path: '/backend/adminLogin',
        component: AdminLogin,
        name: 'adminLogin',
        meta: {
            title: 'Login || Admin'
        }

    },

     {
         path: '/backend/merchant',
         component: Merchant,
         name : 'merchant',
         meta :{
             title : 'Merchant ',
             requiresAuthAdmin : true ,
         }
     },
     {
        path: '/backend/merchant/add',
        component: AddMerchant,
        name : 'add_merchant',
        meta :{
            title : 'Merchant | Add ',
            requiresAuthAdmin : true ,
        }
    },
    {
        path: '/backend/merchant/edit/:id',
        component: EditMerchant,
        name : 'edit_merchant',
        meta :{
            title : 'Merchant | edit ',
            requiresAuthAdmin : true ,
        }
    },
    {
        path: '/backend/supplier',
        component: Supplier,
        name: 'supplier',
        meta: {
            requiresAuthAdmin: true,
            title: 'suppler'
        }

    },
    {
        path: '/backend/fabrics/add/supplier/',
        component: AddFabricsSupplier,
        name: 'AddFabricsSupplier',
        meta: {
            requiresAuthAdmin: true,
            title: 'Fabrics| Supplier'
        }

    },
    {
        path: '/backend/fabrics/supplier',
        component: FabricsSupplier,
        name: 'FabricsSupplier',
        meta: {
            requiresAuthAdmin: true,
            title: 'Fabrics| Supplier'
        }

    },
    
    
    {
        path: '/backend/supplier/:id/amount',
        component: SupplierAmount,
        name: 'SupplierAmount',
        meta: {
            requiresAuthAdmin: true,
            title: 'suppler'
        }

    },
    
    {
        path: '/backend/Supplier/Add',
        component: AddSupplier,
        name: 'supllierAdd',
        meta: {
            requiresAuthAdmin: true,
            title: 'add|suppleir'
        }
    },
    {

        path: '/backend/edit/supplier/:id',
        component: EditSupplier,
        name: 'supplierEdit',
        meta: {
            requiresAuthAdmin: true,
            title: 'Edit| Supplier'
        }
    },

    {
        path: '/backend/credit',
        component: Credit,
        name: 'credit',
        meta: {
            requiresAuthAdmin: true,
            title: 'Credit'
        }

    },
    {
        path: '/backend/credit/due',
        component: CreditDue,
        name: 'CreditDue',
        meta: {
            requiresAuthAdmin: true,
            title: 'Due| Credit'
        }

    },
    
    {
        path: '/backend/credit/add',
        component: AddCredit,
        name: 'creditAdd',
        meta: {
            requiresAuthAdmin: true,
            title: 'add|credit'
        }

    },

    {
        path: '/backend/credit/edit/:id',
        component: EditCredit,
        name: 'creditEdit',
        meta: {
            requiresAuthAdmin: true,
            title: 'Edit"credit'
        }

    },

    {
        path: '/backend/debit',
        component: Debit,
        name: 'debit',
        meta: {
            requiresAuthAdmin: true,
            title: 'Debit'
        }

    },
    {
        path: '/backend/debit/add',
        component: AddDebit,
        name: 'debitAdd',
        meta: {
            requiresAuthAdmin: true,
            title: 'add|debit'
        }

    },

    {
        path: '/backend/debit/edit/:id',
        component: EditDebit,
        name: 'debitEdit',
        meta: {
            requiresAuthAdmin: true,
            title: 'Edit|Debit'
        }

    },


    {
        path: '/backend/city',
        component: City,
        name: 'city',
        meta: {
            requiresAuthAdmin: true,
            title: 'city'
        }

    },
    {
        path: '/backend/role',
        component: Role,
        name: 'role',
        meta: {
            requiresAuthAdmin: true,
            title: 'Role'
        }

    },

    {
        path: '/backend/role/add',
        component: AddRole,
        name: 'roleAdd',
        meta: {
            requiresAuthAdmin: true,
            title: 'Add"ROle'
        }

    },

    {
        path: '/backend/permissions/edit/role/:id',
        component: EditPermissions,
        name: 'EditPermissions',
        meta: {
            requiresAuthAdmin: true,
            title: 'Edit| Permissions'
        }

    },
    
    {
        path: '/backend/addCity',
        component: AddCity,
        name: 'cityAdd',
        meta: {
            requiresAuthAdmin: true,
            title: 'add city'
        }
    },
    {
        path: '/backend/editCity/:id',
        component: EditCity,
        name: 'editCity',
        meta: {
            requiresAuthAdmin: true,
            title: 'edit city'
        }
    },

    
    {
        path: '/backend/sub/city',
        component: SubCity,
        name: 'sub_city',
        meta: {
            requiresAuthAdmin: true,
            title: 'sub city'
        }
    },

    {
        path: '/backend/add/sub/city',
        component: AddSubCity,
        name: 'add_sub_city',
        meta: {
            requiresAuthAdmin: true,
            title: 'add sub city'
        }
    },
    {
        path: '/backend/edit/sub/city/:id',
        component: EditSubCity,
        name: 'edit_sub_city',
        meta: {
            requiresAuthAdmin: true,
            title: 'edit sub city'
        }
    },



    {
        path: '/backend/company',
        component: Company,
        name: 'company',
        meta: {
            requiresAuthAdmin: true,
            title: 'company'
        }

    },
    {
        path: '/backend/add/company',
        component: AddCompany,
        name: 'addCompany',
        meta: {
            requiresAuthAdmin: true,
            title: 'add company'
        }
    },
    {
        path: '/backend/edit/company/:id',
        component: EditCompany,
        name: 'editCompany',
        meta: {
            requiresAuthAdmin: true,
            title: 'edit company'
        }
    },


    
    {
        path: '/backend/found/transfer',
        component: fondtransfer,
        name: 'fondtransfer',
        meta: {
            requiresAuthAdmin: true,
            title: 'fondtransfer'
        }

    },
    {
        path: '/backend/found/transfer/add',
        component: fondtransferAdd,
        name: 'fondtransferAdd',
        meta: {
            requiresAuthAdmin: true,
            title: 'Add|ondtransfer'
        }

    },

    {
        path: '/backend/offer',
        component: Offer,
        name: 'offer',
        meta: {
            requiresAuthAdmin: true,
            title: 'offer'
        }

    },
    {
        path: '/backend/add',
        component: AddOffer,
        name: 'offerAdd',
        meta: {
            requiresAuthAdmin: true,
            title: 'add offer'
        }
    },
    {
        path: '/backend/edit/Offer/:id',
        component: EditOffer,
        name: 'edit_offer',
        meta: {
            requiresAuthAdmin: true,
            title: 'edit offer'
        }
    },

    {
        path: '/backend/courier',
        component: Courier,
        name: 'courier',
        meta: {
            requiresAuthAdmin: true,
            title: 'courier'
        }

    },
    {
        path: '/backend/addCourier',
        component: AddCourier,
        name: 'courierAdd',
        meta: {
            requiresAuthAdmin: true,
            title: 'add courier'
        }
    },
    {
        path: '/backend/editCourier/:id',
        component: EditCourier,
        name: 'editCourier',
        meta: {
            requiresAuthAdmin: true,
            title: 'Courier edit'
        }
    },

    {
        path: '/backend/comment',
        component: Comment,
        name: 'comment',
        meta: {
            requiresAuthAdmin: true,
            title: 'comment'
        }

    },
    {
        path: '/backend/addComment',
        component: AddComment,
        name: 'commentAdd',
        meta: {
            requiresAuthAdmin: true,
            title: 'comment || add'
        }
    },
    {
        path: '/backend/editComment/:id',
        component: EditComment,
        name: 'editComment',
        meta: {
            requiresAuthAdmin: true,
            title: 'comment edit'
        }
    },

    {
        path: '/backend/factory/list',
        component: Factory,
        name: 'factory_list',
        meta: {
            requiresAuthAdmin: true,
            title: 'factory'
        }

    },
    {
        path: '/backend/factory/add',
        component: AddFactory,
        name: 'add_factory',
        meta: {
            requiresAuthAdmin: true,
            title: 'factory || add'
        }
    },
    {
        path: '/backend/edit/factory/:id',
        component: EditFactory,
        name: 'edit_factory',
        meta: {
            requiresAuthAdmin: true,
            title: 'factroy edit'
        }
    },

    {
        path: '/backend/product',
        component: Product,
        name: 'product',
        meta: {
            requiresAuthAdmin: true,
            title: 'Product'
        }

    },


    {
        path: '/backend/report/product/stock',
        component: ProductSock,
        name: 'productStcok',
        meta: {
            requiresAuthAdmin: true,
            title: 'Product||stock'
        }

    },


    {
        path: '/backend/addProduct',
        component: AddProduct,
        name: 'productAdd',
        meta: {
            requiresAuthAdmin: true,
            title: 'product || add'
        }
    },
    {
        path: '/backend/product/edit/:id',
        component: EditProduct,
        name: 'productEdit',
        meta: {
            requiresAuthAdmin: true,
            title: 'product edit'
        }
    },


    {
        path: '/backend/purchase',
        component: Purchase,
        name: 'purchase',
        meta: {
            requiresAuthAdmin: true,
            title: 'Purchase'
        }

    },
    {
        path: '/backend/addPurchase',
        component: AddPurchase,
        name: 'addPurchase',
        meta: {
            requiresAuthAdmin: true,
            title: 'purchase || add'
        }
    },
    {
        path: '/backend/addPurchase/fabrics',
        component: AddPurchaseFabrics,
        name: 'AddPurchaseFabrics',
        meta: {
            requiresAuthAdmin: true,
            title: 'Fabrics||Purchase'
        }
    },
    {
        path: '/backend/purchase/manage/fabrics',
        component: ManagePurchaseFabrics,
        name: 'ManagePurchaseFabrics',
        meta: {
            requiresAuthAdmin: true,
            title: 'Fabrics||Purchase'
        }
    },
    {
        path: '/backend/purchaseEdit/:id',
        component: EditPurchase,
        name: 'purchaseEdit',
        meta: {
            requiresAuthAdmin: true,
            title: 'purchase edit'
        }
    },



    {
        path: '/backend/order',
        component: Order,
        name: 'order',
        meta: {
            requiresAuthAdmin: true,
            title: 'Order'
        }

    },

    {
        path: '/backend/new/order',
        component: NewOrder,
        name: 'NewOrder',
        meta: {
            requiresAuthAdmin: true,
            title: 'New | Order'
        }

    },


    {
        path: '/backend/order/pending',
        component: PendingOrder,
        name: 'PendingOrder',
        meta: {
            requiresAuthAdmin: true,
            title: 'Pending | Order'
        }

    },

    {
        path: '/backend/order/approved',
        component: ApprovedOrder,
        name: 'ApprovedOrder',
        meta: {
            requiresAuthAdmin: true,
            title: 'Approved | Order'
        }

    },

    {
        path: '/backend/order/shopment',
        component: ShipmentOrder,
        name: 'ShipmentOrder',
        meta: {
            requiresAuthAdmin: true,
            title: 'ShipmentOrder | Order'
        }

    },
    {
        path: '/backend/order/delivered',
        component: DeliveredOrder,
        name: 'DeliveredOrder',
        meta: {
            requiresAuthAdmin: true,
            title: 'DeliveredOrder | Order'
        }

    },
    {
        path: '/backend/order/return',
        component: ReturnOrder,
        name: 'ReturnOrder',
        meta: {
            requiresAuthAdmin: true,
            title: 'ReturnOrder | Order'
        }

    },
    {
        path: '/backend/order/cancel',
        component: CancelOrder,
        name: 'CancelOrder',
        meta: {
            requiresAuthAdmin: true,
            title: 'CancelOrder | Order'
        }

    },
    {
        path: '/backend/order/wholesale',
        component: WholeSaleOrder,
        name: 'WholeSaleOrder',
        meta: {
            requiresAuthAdmin: true,
            title: 'WholeSaleOrder | Order'
        }

    },
    
    {
        path: '/backend/addOrder',
        component: AddOrder,
        name: 'addOrder',
        meta: {
            requiresAuthAdmin: true,
            title: 'order || add'
        }
    },

    {
        path: '/backend/add/wholesale',
        component: AddWholeSale,
        name: 'addWholeSale',
        meta: {
            requiresAuthAdmin: true,
            title: 'wholesale || add'
        }
    },

    {
        path: '/backend/view/order/:id',
        component: ViewOrder,
        name: 'viewOrder',
        meta: {
            requiresAuthAdmin: true,
            title: 'order || view'
        }
    },
    {
        path: '/backend/orderEdit/:id',
        component: EditOrder,
        name: 'orderEdit',
        meta: {
            requiresAuthAdmin: true,
            title: 'order edit'
        }
    },

    {
        path: '/backend/purchaseView/:id',
        component: ViewPurchase,
        name: 'purchaseView',
        meta: {
            requiresAuthAdmin: true,
            title: 'view | purchase'
        }
    },



    {
        path: '/backend/sale/office',
        component:OfficeSale ,
        name: 'officeSale',
        meta: {
            requiresAuthAdmin: true,
            title: 'Office | Sale'
        }
    },

    {
        path: '/backend/sale/company',
        component:CompanySale ,
        name: 'compnaySale',
        meta: {
            requiresAuthAdmin: true,
            title: 'Company  | Sale'
        }
    },

    {
        path : '/backend/selling/offer',
        component: selling_offer ,
        name : 'selling_offer',
        meta : {
            requiresAuthAdmin: true ,
            title : 'selling | offer'
        }
    },

    {
        path : '/backend/selling/offer/add',
        component: add_selling_offer ,
        name : 'add_selling_offer',
        meta : {
            requiresAuthAdmin: true ,
            title : 'add | offer'
        }
    },

    {
        path: '/backend/carrier',
        component : HomeCarrier ,
        name : 'home_carrier',
        meta : {
            title : 'Carrier | Home',
            requiresAuthAdmin: true ,
        }
    },

    {
        path: '/backend/carrier/add',
        component : AddCarrier ,
        name : 'add_carrier',
        meta : {
            title : 'Carrier | Add',
            requiresAuthAdmin: true ,
        }
    }, 

    {
        path: '/backend/carrier/show/:id',
        component : ShowCarrier ,
        name : 'show_carrier',
        meta : {
            title : 'Carrier | show',
            requiresAuthAdmin: true ,
        }
    },

    {
        path: '/backend/carrier/edit/:id',
        component : EditCarrier ,
        name : 'edit_carrier',
        meta : {
            title : 'Carrier | Home',
            requiresAuthAdmin: true ,
        }
    },


    {
        path: '/backend/job/post/applied/users/:id',
        component : AppliedUsers ,
        name : 'applied_users',
        meta : {
            title : 'Carrier | Applied User',
            requiresAuthAdmin: true ,
        }
    },


    {
        path : '/backend/selling/offer/edit/:id',
        component: edit_selling_offer ,
        name : 'edit_selling_offer',
        meta : {
            requiresAuthAdmin: true ,
            title : 'Edit | offer'
        }
    },

    
    {
        path: '/backend/account/purpose',
        component : accountPurpose ,
        name : 'account_purpose',
        meta:{
            title : 'Account | Purpose',
            requiresAuthAdmin : true ,
        }
    },

       
    {
        path: '/backend/account/purpose/add',
        component : accountPurposeAdd ,
        name : 'account_purpose_add',
        meta:{
            title : 'Account | Purpose Add',
            requiresAuthAdmin : true ,
        }
    },

    {
        path: '/backend/account/purpose/edit/:id',
        component : accountPurposeEdit ,
        name : 'account_purpose_edit',
        meta:{
            title : 'Account | Purpose edit',
            requiresAuthAdmin : true ,
        }
    },

    {
        path: '/backend/team/member',
        component : TeamMember ,
        name : 'team_member',
        meta:{
            title : 'Team | Members',
            requiresAuthAdmin : true ,
        }
    },
    
    {
        path: '/backend/team/member/add',
        component : AddTeamMember ,
        name : 'add_team_member',
        meta:{
            title : 'Add | Member',
            requiresAuthAdmin : true ,
        }
    },

    {
        path: '/backend/team/member/edit/:id',
        component : EditTeamMember ,
        name : 'edit_team_member',
        meta:{
            title : 'Edit | Member',
            requiresAuthAdmin : true ,
        }
    },


    {
        path: '/backend/team/salary/:id',
        component: TeamSalary,
        name: 'teamSalary',
        meta: {
            title: 'Team| Salary',
            requiresAuthAdmin: true,
        }
    },
   
    {
        path: '/backend/team/salary/:id/:month',
        component: SalaryDetails,
        name: 'SalaryDetails',
        meta: {
            title: 'Team| Salary',
            requiresAuthAdmin: true,
        }
    },
     {
        path: '/backend/sale/add',
        component: AddSale,
        name: 'AddSale',
        meta: {
            requiresAuthAdmin: true,
            title: 'Add | Sale'
        }
    },
    {
        path: '/backend/sale/exchnage/add',
        component: AddSaleExchange,
        name: 'AddSaleExchange',
        meta: {
            requiresAuthAdmin: true,
            title: 'Add | Sale'
        }
    },
    
    {
        path: '/backend/sale/add/company',
        component: AddCompanySale,
        name: 'AddCompanySale',
        meta: {
            requiresAuthAdmin: true,
            title: 'Add | Sale'
        }
    },
    
     

    {
        path: '/backend/sale/view/:id',
        component: ViewSale,
        name: 'ViewSale',
        meta: {
            requiresAuthAdmin: true,
            title: 'View | Sale'
        }
    },

    {
        path: '/backend/order/report',
        component: OrderReport,
        name: 'OrderReport',
        meta: {
            requiresAuthAdmin: true,
            title: 'Order | Report'
        }
    },

    {
        path: '/backend/office/sale/report',
        component: OfficeSaleReport,
        name: 'OfficeSaleReport',
        meta: {
            requiresAuthAdmin: true,
            title: 'Office|sale | Report'
        }
    },
    {
        path: '/backend/purchase/report',
        component: PurchaseReport,
        name: 'PurchaseReport',
        meta: {
            requiresAuthAdmin: true,
            title: 'Purchase Report'
        }
    },
    {
        path: '/backend/supplier/report',
        component: SupplierReport,
        name: 'SupplierReport',
        meta: {
            requiresAuthAdmin: true,
            title: 'Purhase Report'
        }
    },
    {
        path: '/backend/profite/report',
        component: ProfiteReport,
        name: 'ProfiteReport',
        meta: {
            requiresAuthAdmin: true,
            title: 'Profite Report'
        }
    },

    {
        path: '/backend/sale/profite/report',
        component: SaleProfite,
        name: 'SaleProfite',
        meta: {
            requiresAuthAdmin: true,
            title: 'Profite Report'
        }
    },
    {
        path: '/backend/order/profite/report',
        component: OrderProfite,
        name: 'OrderProfite',
        meta: {
            requiresAuthAdmin: true,
            title: 'Profite Report'
        }
    },
    
    
    
    
    
    {
        path: '/backend/account/report',
        component: AccountReport,
        name: 'AccountReport',
        meta: {
            requiresAuthAdmin: true,
            title: 'Office|sale | Report'
        }
    },

    


    {
        path: '/backend/listAdmin',
        component: AdminList,
        name: 'admin',
        meta: {
            requiresAuthAdmin: true
        }

    },
    

    {
        path: '/backend/admin/profile',
        component: AdminProfile,
        name: 'adminProfile',
        meta: {
            requiresAuthAdmin: true,
            title: 'Profile | Admin'
        }

    },
    {
        path: '/backend/addAdmin',
        component: addAdmin,
        name: 'adminAdd',
        meta: {
            requiresAuthAdmin: true
        }
    },
    {
        path: '/backend/editAdmin/:adminId',
        component: editAdmin,
        name: 'editAdmin',
        meta: {
            requiresAuthAdmin: true
        }
    },
    {
        path: '/backend/assign/role/admin/:id',
        component:AssignRoleAdmin,
        name: 'AssignRoleAdmin',
        meta: {
            requiresAuthAdmin: true
        }
    },
   
    {
        path: '/backend/assign/admin/permission/:id',
        component:AssignAdminPermission,
        name: 'assign_admin_permission',
        meta: {
            requiresAuthAdmin: true
        }
    },
    
    {
        path: '/backend/admin/password/:id',
        component : adminPasswordChange,
        name : 'passwordChange',
        meta:{
            requiresAuthAdmin : true 
        }
    },

    {
        path: '/backend/sms/campaign',
        component: SMS_campaign,
        name: 'sms_campaign',
        meta: {
            requiresAuthAdmin: true
        }
    },
    {
        path: '/backend/subscriber/list',
        component: SubscriberList,
        name: 'subscriber_list',
        meta: {
            requiresAuthAdmin: true
        }
    },
    {
        path: '/backend/contact/message',
        component: ContactMessage,
        name: 'contact_message',
        meta: {
            requiresAuthAdmin: true
        }
    },

    {
        path: '/backend/contact/message/reply/:id',
        component: ContactMessageReply,
        name: 'contact_message_reply',
        meta: {
            requiresAuthAdmin: true
        }
    },

    {
        path: '/backend/loaner/add',
        component: loanerAdd,
        name: 'loanerAdd',
        meta: {
            requiresAuthAdmin: true
        }
    },

    {
        path: '/backend/loaner',
        component: loaner,
        name: 'loaner',
        meta: {
            requiresAuthAdmin: true
        }
    },
    {
        path: '/backend/loan',
        component: loan,
        name: 'loan',
        meta: {
            requiresAuthAdmin: true
        }
    },
    {
        path: '/backend/loan/add',
        component: loanAdd,
        name: 'loanAdd',
        meta: {
            requiresAuthAdmin: true
        }
    },


    {
        path: '/backend/general/setting',
        component: GeneralSetting,
        name: 'general_setting',
        meta: {
            requiresAuthAdmin: true
        }
    },

    {
        path: '/backend/footer/info',
        component: FooterSetting,
        name: 'footer_setting',
        meta: {
            requiresAuthAdmin: true
        }
    },
    
    {
        path: '/backend/theme/setting',
        component: BackgroundAndColorSetting,
        name: 'theme_setting',
        meta: {
            requiresAuthAdmin: true
          }
    },


    {
        path: '/backend/sale/campaigns',
        component: SaleCampaign,
        name: 'sale_campaign',
        meta: {
            requiresAuthAdmin: true
          }
    },


    {
        path: '/backend/sale/campaign/add',
        component: AddSaleCampaign,
        name: 'add_sale_campaign',
        meta: {
            requiresAuthAdmin: true
          }
    },


     {
        path: '/backend/sale/campaign/item/:id',
        component: EditSaleCampaign,
        name: 'edit_sale_campaign',
        meta: {
            requiresAuthAdmin: true
          }
     },



     {
        path: '/backend/about/contact/info',
        component: AboutAndContact,
        name: 'about_and_contact',
        meta: {
            requiresAuthAdmin: true
          }
     },


     {
        path: '/backend/order/return/shipment/info',
        component: OrderShipmentAndReturn,
        name: 'order_shipment_return',
        meta: {
            requiresAuthAdmin: true
        }
      },



    
]


const router = new VueRouter({
    mode: 'history',
    routes
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuthAdmin)) {
        if (localStorage.getItem('admin_token')) {
            next()
            return
        }
        next('/backend/adminLogin')
    }
     else {
        next()
    }

    if (to.matched.some(record => record.meta.requiresAuthUser)) {
        if (localStorage.getItem('user_token')) {
            next()
            return
        }
        next('/public/user/login')
    } else {
        next()
    }

    // if (to.matched.some(record=>record.meta.progressbar)){
    //     progress: {
    //         func: [
    //             {call: 'color', modifier: 'temp', argument: '#ffb000'},
    //             {call: 'fail', modifier: 'temp', argument: '#6e0000'},
    //             {call: 'location', modifier: 'temp', argument: 'top'},
    //             {call: 'transition', modifier: 'temp', argument: {speed: '1.5s', opacity: '0.6s', termination: 400}}
    //         ]
    //     }
    // }
})

export default router

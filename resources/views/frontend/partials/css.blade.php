<!-- CSS Part Start-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/js/bootstrap/css/bootstrap.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/font-awesome/css/font-awesome.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/stylesheet.css')}}" />
{{-- <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/owl.carousel.css')}}" /> --}}
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/owl.transitions.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/responsive.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/stylesheet-skin3.css')}}"/>
<link href='//fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/scrol.css')}}"/>
<link rel="stylesheet" href="{{ asset('admin/css/sweetalert2.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/customize.css')}}"/> --}}
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/header.css')}}"/>


{{-- <script type="text/javascript" src="{{asset('frontend/js/jquery-2.1.1.min.js')}}"></script> --}}
<script src="{{asset('admin/js/objectToFormData.js')}}"></script>


{{-- <script type="text/javascript" src="{{asset('frontend/js/custome.js')}}"></script> --}}
<script src="{{ asset('admin/js/sweetalert2.all.js') }}"></script>
<?php

$color=App\Models\BackgroundAndColor::first();


//dd($color);


?>
<style>


    
:root {
    --primary-color: <?php echo $color->primary_color; ?>;
    --body-backgroud: <?php echo $color->body_bg_color; ?>;
     --primary-text-color: <?php echo $color->primary_text_color ?>;
    --menu-text-color: <?php echo $color->menu_text_color ?>;
    --menu-background: <?php echo $color->menu_background_color ?>;
    
}
a{
    color: var(--primary-color)
}

.tab-content {
    display: block !important;

}

.list-group .active {
    background: var(--primary-color) !important;
}

.caption {
    text-align: center;
}

.product {
    height: 100%;

    border: 1px solid #ddd;
    margin-bottom: 20px;
}

.product-content {
    margin-top: 7px;
}

.single-product.mt-2 {
    margin-top: 20px;
}

.slider_background{
    background:var(--primary-color);
    margin-left: 0px;
    margin-right: 0px;
}

span.outstcok {
    background: yellow;
    color: #000;
}

.product-side-category {
    margin-left: 8px;
    margin-top: 7px;
}

.toasted.toasted-primary.success {
    width: 400px;
    height: 55px;
    font-size: 18px;
}

.toasted.toasted-primary.error {
    width: 400px;
    height: 55px;
    font-size: 18px;
    font-weight: bolder;
}

.image img {
    max-width: 200px;
    max-height: 200px;
}

table img.img-thumbnail {
    width: 50px;
    height: 50px;
}

.product-content .product-thumb {
    border: 2px solid #DDD !important;
    margin-bottom: 12px;
}

.quantityUpdat {
    font-size: 20px;
    cursor: pointer;
}

.cart-empy {
    text-align: center;
    padding: 0;
    margin: 0;
    border: 1px solid #eeeeee;
}

.cart-empy p {
    margin-top: 0px;
    font-size: 20px;
}

.cart-empy img {
    margin-bottom: 0px;
    margin-top: 0;
}

.custom-box {
   
    width: 100%;
    height: auto !important;
    background: #fff !important;
    padding: 25px 40px !important;
    margin: auto;
    border-radius: 10px !important;
    box-shadow: 3px 3px 3px #ddd !important;

}


.custom-box .title {
    text-align: center;
    text-transform: uppercase;
    border-bottom: 2px solid var(--primary-color);
}

.is-invalid {
    border: 1px solid red;
}

.invalid-feedback {
    color: red;
}

.cart-total {
    background: #fff;
    width: 100%;
    padding: 5px;
    font-size: 20px;
}

span.badge-danger {
    background: red;
}

span.badge-success {
    background: var(--primary-color);
}

span.badge-warning {
    background: #f39c12;
    color: #000 !important;
}

span.badge-primary {
    background: #3c8dbc;
}

.related_products .sub-title {
    text-align: center;
    border-bottom: 2px solid #ddd;
    margin-bottom: 45px;
}

.search-content {
    position: absolute;
    z-index: 1000;
    top: 88%;
    width: 520px;
    max-height: 300px;
    overflow-y: scroll;
}

.search-content li:hover {

    background: var(--primary-color);
    color: #fff;

}

.search-content li .search-router-link:hover {

    color: #fff;

}

.search-content li .search-router-link {

    color: #000;

}


.btnQuick:hover {
  background: #ff4d03;
}

.parallax_background {
  width: 98%;
  height: 300px;
  margin-left: 14px;
  background-image: url(https://mohasagor.com/public/storage/images/static/wed-template.jpg);
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

.parallax_inside {
  position: absolute;
  width: 40%;
  height: 200px;
}

.parallax_content {
  margin: 10px;
  position: absolute;

  width: 96%;
  height: 175px;
  text-align: center;
}

.parallax_content h4 {
  margin-top: 30px;
}

.parallax_offer {
  margin-top: 15px !important;
  margin-bottom: 15px !important;
}


.displayeBlok{
  display: none;
}



.product-header {
    position: relative;
    padding: 0px;
    margin: 0px 0px 20px 0px;
    line-height: normal;
    font-size: 20px;
    color: #000000;
    border-bottom: 2px solid #ddd;
    padding-bottom: 3px;
}

nav#top li a {
    color: #fff !important;
}

#header .htop {
    background-color: var(--primary-color);
}

.left-top {
    background-color: var(--primary-color)!important;
}

#header .button-search {
    width: 69px !important;

    color: #fff;
    background: var(--primary-color);
}

/* 
start left sideb bar css */
ul.side-nav {
    width: 267px;
    height: 450px;
    list-style: none;
    background: #c2eaaa;
    box-shadow: 3px 4px 7px 1px #ddd;
    border-radius: 4px
}

ul.side-nav li {
    line-height: 4rem;
    border-bottom: 1px solid #f6f6f6;

    position: relative;
    left: -23px;
    vertical-align: middle;
    cursor: pointer;
    transition: 3ms;
}

ul.side-nav .nav-main-item {
    color: #000;
    font-size: 14px;
    margin-left: 14px;
    transition: 3ms;

}

.side-nav li:hover {
    background-color: #fff;
}

.nav-main-item:hover {
    color: var(--primary-color);


}

ul.left-sub-menu {
    position: fixed;
    box-shadow: 3px 4px 7px 1px #ddd;
    background: #c2eaaa;
    width: 195px;
    z-index: 100;
    list-style: none;
    top: 120px;
    max-height: 420px;
    display: none;
    left: 350px;
    overflow-y: scroll;
    overflow-x: hidden;
    height: 420px;
}

ul.left-sub-menu .last-sider-bar {
    border: 1px solid #ddd;
    border-left: none;
    border-top: none;
    left: 52rem;
    position: fixed;
    background: #c2eaaa;
    list-style: none;
    top: 130px;
    max-height: 420px;
    display: none;

    overflow-y: scroll;
    overflow-x: hidden;
    height: 420px;
    width: 195px;
}

ul.left-sub-menu .last-sider-bar li {
    border: none;
    left: -15px;
}

ul.side-nav li:hover>.left-sub-menu {
    display: block;
}

.left-sub-menu li:hover>.last-sider-bar {
    display: block;
}

.show-sub {
    display: none;
    float: right;
    margin-top: 17px
}








.menu-show {
    display: block;
}

.category_icon_image {
    max-width: 20px;
    max-height: 20px;
}

.pull-right {
    background: var(--primary-color) !important;
} 

.chat-icon {
    float: right !important;
    position: fixed;
    text-align: right;
    left: 93%;
    z-index: 10000;
    top: 283px;
    vertical-align: middle;
  
    width: 75px;
    height: 120px;
    text-align: center;
    
    background: transparent;
    padding: 30px 0px;
    border: 2px solid var(--primary-color)
}

.product_carousel.sale_campaign h3 {
    font-weight: bold;
    text-transform: uppercase;
    color: var(--primary-color);
   
}
.sale_campaign{
    margin-bottom: 40px;
    margin-top: 40px;
    text-align: center;
    padding: 0px;
    background-color: #fff;

}
 .wrapper-wide{
    background-color:var( --body-backgroud);
}
.container{
    padding-left: 0;
    padding-right: 0;
}
.product-card {
    width: 100%;
    height: 290px; 
    background: #fff;
    text-align: center;
    margin-bottom: 10px;
    border-radius: 6px;
}
.best-selling .product-card img{
    border-radius: 40px;;
}

.product-card:hover>.product-card-footer{
    display: block;
    margin-top: -45px;
    animation: fly 1s ease 1;   
}

@keyframes fly {
    0% {
      transform: translateY(0%);
    }
  
    50% {
      transform: translateY(100%);
    }
  
    100% {
      transform: translateY(0);
    }
  }

.prodict-card-body img {
    padding: 10px;
    width: 200px;
    height: 200px;
    transition: .3s;
}
.prodict-card-body img:hover {
   transform: scale(1.5);
}

.product-detail h4 {
    font-size: 12px;
    padding: 5px;
}
.product-card-footer {
    display: none;
    background: var(--primary-color);
    padding: 5px;
    transition: .5s;
}
.detls_prodcut{
    color:#fff ;
    background:transparent;
}
.best-selling .product-card {
    width: 220px;
}
.banner img{
    max-width: 165px;
    max-height: 165px;
     border: 1px solid #eee;
     border-radius: 5px;
}
.product-link{
    color: #000;
    transition: .3s;
}
.product-link:hover {
    color: var(--primary-color);
}
.category-heading{
    display: inline;
}
.category-heading {
    display: inline;
}
.s-category{
    display: inline;
    float: right;
}

.sub-category-name:hover {
    color: var(--primary-color);
   
}
.c-v-all {
    background: #000;
    color: #fff;
    padding: 5px 18px;
    width: 22px;
    height: 38px;
    display: inline;
    border-radius: 4px;
    transition: .5s;
}
.c-v-all:hover {
   
    border-radius:0px;
    color: #fff;
    background: var(--primary-color);

}

.c-product {
    margin-top: 10px;
}
.c-product-header {
    margin-bottom: 8px;
    padding: 6px 0px;
    border-bottom: 1px solid #ddd;
}
.single-product-box {
    background: #fff;
    padding: 15px 25px;
  
   border-radius: 5px;
   height: auto;
}
.product-description{
      background: #fff;
      padding: 15px 25px;
      box-shadow: 3px 3px 3px #ddd;
      border-radius: 5px;
      height: auto;
      margin-top: 20px;
}
.realted-producs{
    margin-top: 20px;
}
.realted-producs h3{
    margin-left: 15px;
}
.bg-white{
    background: #fff;
}
.shadow{
     box-shadow: 3px 3px 3px #ddd;
}
.c-box{
    padding: 20px 25px;
}
.cart-dropdown {
    position: absolute;
    width: 350px;
    right: 0;
    height: 400px;
  
    z-index: 999;
}
.cart {
    position: fixed;
    z-index: 999999999999999999;
    right: 0;
    background: #fff;
    bottom: 0;
    height: 100%;
    width: 0px;
    transition:.5s;
}
.colapse-cart{
    width: 400px;
}
.cart-header {
    padding: 15px 15px;
    background: #000;
   text-transform: uppercase;
    font-weight: bold;
    color: var(--primary-color);
}
.cart-body {
    padding: 15px 15px;
    max-height: 500px;
    overflow-y: scroll;
    overflow-x: hidden;
}
.placebtn{
    text-transform: uppercase;
    color: var(--primary-color);
    font-size: 18px;
}
.placebtn:hover{
    color: var(--primary-color);
}
.cart-footer{
    position:absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #000000;
}
.cart-fiiter{
    padding: 15px 15px ;
}
 #exitcart {
   
    cursor: pointer;
}

.cart-open {
    position: fixed;
    right: 0;
    z-index: 999;

    top: 50%;

    width: 80px;
   background: var(--primary-color);
    text-align: center;
    height: 120px;
    cursor: pointer;
}
.cart-open i {
    font-size: 25px;
}
.cart-item-total {
    color: #fff;
}
.user-side-bar {
    padding: 10px 10px;
    margin-bottom: 30px;
}
.profile.clearfix {
    text-align: center;
}
.order-histrory {
    padding: 10px 20px;
    margin-left: 25px;
}   
.overlaw-offer {
  
    opacity: 0;
    position: absolute;
    top: 49%;
    left: 49%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    text-align: center;
    background: var(--primary-color);
    transition:  .5s;
    width: 165px;
    height: 165px;
    
}
.overlaw-offer:hover{
       
 width: 100px;
 opacity: .7;
}
.overlaw-offer-height:hover{
  height: 80px;
   width: 165px;
}
.sub-category-name {
    margin-right: 8px;
    background: #fff;
    padding: 5px 4px;
    font-size: 13px;
    font-weight: bold;
    width: 250px;
    color: var(--primary-color);
}

.product-details-tabe {
    background: #fff;
    margin-top: 25px;
    padding: px;
    box-shadow: 3px 3px 3px #ddd;
    border-radius: 10px;
}
ul.details-tab-menu-list {
    width: 100%;
    display: flex;
    text-transform: uppercase;
    background: #ddd;
    border-radius: 2px;
}

.details-tab-menu-item {
    padding: 10px;
    color: #000;
    font-weight: bolder;
   
    cursor: pointer;
}


.tab-menu-item-active {
    border-bottom: 4px solid var(--primary-color);
}
.product-tab-content {
    padding: 15px 15px;
    min-height: 250px;
}
.product-details{
    display: none;
}
.how-to-buy{
    display: none;
}
.block{
    display: block;
}
li.h-b-li {
    list-style-type: square;
    padding: 2px;
 
}
.product-thumb .image:hover {
    transform: scaleX(-1);
}

.banner .row{
 background: #fff;
 padding: 12px 12px;
 border-radius: 10px
}




img.responsive-image.choosed-thumb {
    max-width: 60px !important;
}

img.zoomer-control.responsive-image {
    max-width: 40px !important;
}

.nav-active {
    display: block !important;
}

.product-card-footer {
    padding: 0px;
}

.btnQuick:hover {
    background: var(--primary-color);
}

.parallax_background {

    width: 98%;
    height: 300px;
    margin-left: 14px;
    background-image: url(https://mohasagor.com/public/storage/images/static/wed-template.jpg);
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

}


.parallax_inside {

    position: absolute;
    width: 40%;
    height: 200px;
}

.parallax_content {

    margin: 10px;
    position: absolute;

    width: 96%;
    height: 175px;
    text-align: center;

}

.parallax_content h4 {
    margin-top: 30px;
}

.parallax_offer {
    margin-top: 15px !important;
    margin-bottom: 15px !important;
}



.service_row {

    width: 103%;
    height: 135px;
    background: #2e2e2e;
    margin-left: 0px;
    margin-top: -50px;

}


.service_container {

    float: left;

}

.service_outer {

    width: 75px;
    height: 75px;
    border-radius: 50%;
    border: 1px solid #fff;
    background: #222;
    margin: -22px 94px;

}

.service_inner {

    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--primary-color);
    margin: 6.5px 6px;

}


.service_icon {
    position: absolute;
    margin: 11px;
    color: #fff;
    font-size: 35px;
}

.service_outer:hover>.service_inner>.service_icon {

    -webkit-transform: scaleX(-1);
    transform: scaleX(-1);
    cursor: pointer;
    transition: 0.5s;

}

.service_description1 {

    color: #fff;
    padding: 10px;
    margin-top: 13px;
    font-size: 13px;

}


.service_description2 {

    color: #fff;
    padding: 10px;
    margin-top: 13px;
    font-size: 13px;
    margin-left: 25px;

}

.service_description3 {

    color: #fff;
    padding: 10px;
    margin-left: 45px;
    margin-top: 17px;
    font-size: 13px;

}


.service_description4 {

    color: #fff;
    padding: 10px;
    margin-left: 50px;
    margin-top: 13px;
    font-size: 13px;

}




/* menu css....... */

.category-menu {
 margin-top: 10px;
    width: 250px;
    background: var(--menu-background) !important;
    min-height: 450px;
    margin-left: -28px;
}

.menu-heading {
    background: var(--primary-color);
    padding: 10px;
    text-align: center;
    text-transform: uppercase;
    color: #fff;
}

img.category-img {
    width: 20px;
    height: 20px;
}

.category-menu-list {
    margin: 0;
    padding: 0;
        background: #fff;
    min-height: 450px;
}

.category-name {
     padding: 9px;
    vertical-align: middle;
    font-size: 14px;
    border: 1px solid var(--primary-color);
}

.category-link {
    color: #000;
}

li.category-name:hover {
    box-shadow: 3px 3px 3px 3px #ddd;
    transition: .3s;
    color: #000;
}

ul.sub-category-menu-list {
    min-width: 850px;
    z-index: 9;
    position: absolute;
    min-height: 450px;
    background: #fff;
    display: none;
    TOP: 5%;
    left: 90%;
    flex-wrap: wrap;
    padding: 20px 20px;
    max-height: 450px;
    overflow-y: auto;
    box-shadow: 4px 4px 4px 4px #ddd;

}

li.category-name:hover>.sub-category-menu-list {
    display: flex;
}

.sub-category-link {
    color: #000;
    border-bottom: 1px solid #ddd;
}

ul.sub-sub-category-list {
    margin-top: 10px;
    padding: 0px 20px;
}

.slider {
    margin-top: 10px;
}
.nav-active {
    display: block !important;
}

.sticky {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 9999999999999;
}

.q-i-d {
    cursor: pointer;

}

ul.p-image-name li {
    padding: 0px 2px;
    font-size: 12px;
}

button.btn.btn-primary.btnQuick {
    background: var(--primary-color);
}

li {
    list-style: none;
}

.header {
    position: relative;
    width: 100%;
    box-shadow: 2px 2px 2px #ddd;
    border-bottom: 1px solid #ddd;

}

.header-top {
    width: 100%;
    height: 29px;
    display: flex;
    background: var(--primary-color);
    border-bottom: 1px solid #ddd;
    color: #fff;

}

.header-top-left {
    display: flex;
    list-style: none;
}

.header-top li {
    padding: 5px 4px;
    font-size: 14px;
}

.flex {
    display: flex;
}

.header-top-right {
    margin-left: auto;
    display: flex;
}

.header-top li span {
    padding-right: 9px;
    padding: 3px;
}

.header-top li i {
    color: #fff;
}

.main-header {
    background: #fff;
}

.main-header li {
    padding: 5px 4px;
    font-size: 14px;
}

img.site-logo {
    max-width: 180px;
    max-height: 60px;
}


.search-input {
    width: 600px;
    height: 35px;
    border-radius: 5px;
    transition: .5s;
    background-color: #F7F8FA;
    border: 1px solid #ddd;
    padding: 10px;
    position: absolute;
    top: 48%;
}


.search-btn {
    height: 35px;
    border-radius: 5px;
    transition: .5s;
    background-color: #F7F8FA;
    border: 1px solid #ddd;
    border: none;
    right: 9px;
    background: var(--primary-color);
    color: #fff;
    width: 64px;
    position: absolute;
    top: 48%;
    left: 63%;
}


.main-header-left {
    display: flex;
}

.main-header-right {
    display: flex;
    margin-left: auto;
    padding: 13px;
}


.main-header-right li {

    font-size: 28px;
    padding: 10px 12px;
}

.main-header-right li i {
    color: var(--primary-color);

}

.menu {
    position: relative;
    width: 100%;
}

.menu-list {
    width: 100%;
    position: relative;
    background: var(--primary-color);
    height: 40px;
    display: flex;
    justify-content: center;
}

.menu-item {
    padding: 10px 15px;
    font-size: 14px;
    transition: .5s;

}


.menu-item-link {
    color: #fff;
    transition: .3s;
}

.menu-item-link:hover {
    color: #fff;

}

.menu-icon {
    display: none;
}

.sub-item-list {
    display: flex;
    width: 90%;
    min-height: 400px;
    height: auto;
    position: absolute;
    background: #fff;
    left: 5%;
    flex-direction: row;
    opacity: 0;
    visibility: hidden;
    box-shadow: 1px 0px 1px 1px #eee;
    flex-direction: row;
    flex-wrap: wrap;
    max-height: 600px;
    overflow-x: scroll;
    overflow-x: hidden;
    z-index: 99999999999;
    margin-top: 7px;
}

.menu-item:hover>.sub-item-list {
    opacity: 1;
    visibility: visible;
}

.sub-item {
    width: 200px;
    min-height: 220px;
    margin-top: 10px;

}

.sub-item-link {
    font-weight: bold;
    text-transform: uppercase;
    color: #000;
    font-size: 15px;
}

.sub-item-link:hover {
    color: var(--primary-color);

}

.sub-sub-item {
    text-transform: none;
    padding: 3px 0px !important;

}

.sub-sub-item-link {
    color: #000000;
    font-size: 14px;
    transition: .5s;
}

.sub-sub-item-link:hover {
    color: var(--primary-color);
}

.sub-sub-item-list {

    padding: 0px 15px;
    margin-top: 5px;
}

#toggle-menu {
    display: none;
}

.sub-menu-icon {
    display: none;
}


/* =========FOR ICON ROTATE======== */
.rotate {
    transform: rotate(180deg);
}
span.price-new {
    color: var(--primary-color);
}




#footer p {
    font-size: 16px !important;
    line-height: 24px;
}


#footer .column a {
    text-decoration: none;
    display: block;
    padding: 3px 0;
    line-height: 24px;
    font-size: 12px;
}

#footer .line {
    width: 72px;
    height: 2px;
    background: var(--primary-color);
    margin-top: -10px;
    margin-bottom: 12px;
}

#footer .social-icon {
    margin: 10px;
}

#footer .social-wrape {
    float: left;
    width: 40px;
    height: 40px;
    border: 2px dashed;
    border-radius: 50%;
    margin-left: 10px;
}

#footer .social-wrape:hover {
    background: var(--primary-color);
}

#footer .f_info_left {
    position: absolute;
    margin-top: 7px;
    margin-left: 5px;
    font-size: 14px;
}

#footer .f_info_right {
    float: right;
    margin-top: 7px;
    margin-left: 0px;
    font-size: 14px;
}

#footer .f-icon {
    margin: 11px;
    cursor: pointer;
    color: white;
}

#footer #powered {
    border-bottom-color: var(--primary-color);
    margin-top: -20px;
}

#footer .powered_text p {
    line-height: 18px;
    margin: -19px;
}

#footer .end_footer {
    background: var(--primary-color);
    height: 40px;
    width: 100%;
}

#footer .end_footer p {

    color: white;
}

#footer .email_icon_container {
    background: var(--primary-color);
    margin-top: -51px;
    float: right;
    padding: 9px 17px;
}

#footer .email_icon_container i {
    color: #fff;
}
.sub-sub-category-name {
    color: #000;
}
.s-menu {
    position: absolute;
    display: flex;
    right: 15%;
    top: 52%;
}

.s-menu li {
    background: var(--primary-color);
    color: #fff;
    padding: 5px 10px;
    margin-right: 15px;
    border-radius: 10px;
    font-size: 12px;
}
.s-menu li a{
    color: #fff;
}
.product-thumb.clearfix {
   
    border: 1px solid #ddd;
    box-shadow: 2px 2px 2px #ddd;
    background: #fff;
    height: 250px;
}
.sale_campaign{
    padding: 5px 5px;
}








#_qvm .modal_overlay{
      background: #00000073;
}
#_qvm .quick_view_image {
  width: 250px !important;
  height: 250px !important;
}

#_qvm .close_sign {
  font-size: 40px !important;
  margin-top: -19px !important;
  color: var(--primary-color) !important;
}

#_qvm .animator {
  margin-top: 100px;
  padding: 100px;
}

#_qvm .animator i {
  font-size: 70px;
}

#_qvm .modal-body h4 p {
  margin-left: 20px !important;
}

#_qvm .modal-dialog {
  width: 90% !important;
  position: absolute;
  left: 10%;
  transition: .3s;
}

#_qvm .quick_content{
  background: #fff;
}
#_qvm .quick_description {
  font-size: 14px;
}



#_qvm .r_p_title{
  font-size: 12px ;
  color: var(--primary-color);
}

#_qvm .r_p_image {
   width:110px;
   height:100px;
   border-radius: 5px;
}

#_qvm .r_p_button {
    margin-left: 35px;
    border-radius: 5px;
}

#_qvm .r_p_button:hover {
    border-radius: 50px;
    background: var(--primary-color);
}
#_qvm .related_quick_row[data-v-587a0637] {
    margin: 5px;
    max-height: 180px;
    overflow-y: scroll;
}

#_qvm .r_quick_body {
    padding: 15px 10px;
}



#_qvm .col-md-2 {
    margin-bottom: 25px;
}
.btn-primary{
    background: var(--primary-color) !important;
}
.cart-header {
    padding: 15px 15px;
   background: var(--primary-color);
   color: #fff;
}
.cart-footer {
   color: #fff;
    
    background-color: var(--primary-color);
}
.placebtn{
    color: #fff;
}
.btn_search{
    background: var(--primary-color) !important;
}
.show{

    display: block;

}
.hide{
    display:none;
}



.slider_imge {
    height: 200px;
    min-height: 200px !important;
}
.s-menu{
    display: none;
}
.campaign-text{
    text-align: left !important;
}
.__sub_category{
    display: none;
}
    
}

.__sub_category {
    min-height: 589px;
    max-height: 600px;
    background: #fff;
    box-shadow: 3px 3px 3px #ddd;
    width: 190px;
    text-align: left;
    margin: 0;
    padding: 0;
    margin-top: -8px;
}

.__sub-category_name {
    padding: 10px;
}
.__sub-category_name::before {content: "•"; color: green;
  display: inline-block; width: 1.5em;
 }

 .__sub-category_name::after {content: "•"; color: blue;
  float: right; width: 1em;
 }

.__sub-category_name:hover{
    color: var(--primary-color)
}

.__list_headig {
    padding: 10px 10px;
    background:var(--primary-color);
    width: 190px;
    color: #fff;
}

.__sub_category_link {
    color: #000;
   padding: 8px;
   }
   

.__product_category{
    margin-bottom: 50px;
}


/* start responsieve side menu css  */



/* =========START THE  MENU RESPONISVE CSS======== */


@media only screen and (min-width: 950px) {

        ul.side-nav {
            left: 0;
            width: 100%;
            position: absolute;


            z-index: 100;
            display: none;
            top: -200px;
        }

        ul.left-sub-menu {
            display: none;
            left: 0;
            width: 100%;
            position: absolute;
            left: 7px;
            top: 44px;
            border: 1px solid #eee;
        }

        .left-top {
            display: none !important;
        }

        #header #logo a img {
            display: inline-block;
            position: absolute;
            top: -84px;
            left: 8rem;
            background: #fff;
            padding: 0px;
            height: 53px;
        }

        #header #top-links>ul>li>a {

            padding: 10px 10px;
        }

        i.fa-align-justify {
            font-size: 35px;
            position: absolute;
            left: 28px;
            top: 12px;
            color: #fff;
        }

        .show-sub {
            display: block;
        }

        ul.side-nav li:hover>.left-sub-menu {
            display: none;
            position: absolute;
        }

        .left-sub-menu li:hover>.last-sider-bar {
            display: none;
        }
        .chat-icon {

            left: 80% !important;
            border: none !important;
            
        }

        .user-content{
        display: flex;

        }
        .user-side-bar{
        display: flex;
        flex-direction: column;
        width: 200px;
        }
        .d-sm-none{
        display: none;
        }
        .prodict-card-body img {
        width: 150px !important;
        height: 150px !important;
        padding: 18px 20px !important;


        }
        .width-20 {
            width: 20% !important;
        }


}


@media only screen and (max-width: 900px) {

    
    .header-top {
        display: none;
    }

    #toggle-menu {
        display: block;
        position: absolute;
        left: 2%;
        font-size: 30px
    }

    img.site-logo {

        position: absolute;
        left: 28%;
        top: -16%;
    }

    .main-header-left {

        width: 100%;
        position: absolute;
        z-index: 999999999;
        background: #F7F8FA;
        justify-content: center;
        position: absolute;
        height: 45px;
    }

    .main-header-right {

        z-index: 99999999999;
        top: -10%;
        position: absolute;
        right: 0;
    }

    .menu-item:hover>.sub-item-list {
        opacity: 1;
        visibility: visible;
    }

    /* =========MAIN MENU DIFFRENT STYLE IN  RESPONSIVE VIEW======== */
    .menu-list {
        display: flex;
        flex-direction: column;
        width: 250px;
        background: #000;
        min-height: 600px;
        visibility: hidden;
        opacity: 0;
        transition: .2s;
        justify-content: left !important;
        height: 100vh;
        position: fixed;
        z-index: 99999999999999999;
        top: 45px;
    }

    .collapse-manu {
        visibility: visible;
        opacity: 1;
    }

    .menu-overlaw {
        position: fixed;
        width: 100%;
        height: 100vh;
        background: rgb(0, 0, 0, 0.5);
        top: 0;
        z-index: 9;

    }

    .search-btn {
        display: none;
    }

    .menu-item {
        padding: 10px 0px;
        display: flex;
    }

    .menu-icon {
        display: block;
        color: #fff;

        justify-content: space-between;
        margin-left: auto;
        font-size: 17px;
        margin-right: 10px;
    }

    .main-header {
        height: 120px;
    }

    .search-input {
        width: 70%;
        left: 15%;
        margin-top: 50px;
    }

    .sub-item-list {
        display: none;
        flex-direction: column;
        width: 220px;
        min-height: auto !important;
        background: #272424;
        opacity: 1;
        visibility: visible;
        box-shadow: none;
        flex-direction: column;
        overflow-x: hidden;
        margin-left: -106px;
        position: relative;
        margin-top: 35px;
    }

    .sub-item {
        width: auto;
        min-height: auto;
        font-weight: normal;
        text-transform: none;
        padding: 8px 0px !important;

    }

    .sub-item-link {
        color: #fff;
    }

    .sub-menu-icon {
        display: block;
    }

}


@media only screen and (max-width: 850px) {


    .nav-list {
        width: 100% !important;
        height: 100vh !important;
        width: 100% !important;
        background-color: var(--primary-color) !important;
        flex-direction: column !important;
        display: none !important;


    }

    .nav-list li {
        font-size: 16px;
        left: 0px !important;
        border-bottom: 1px solid #fff;
        color: #000000;
    }

    .nav-list li .nav-router {
        text-align: left !important;
        color: #000000;
    }

    .nav-list li:hover>.sub-menu {
        display: none;
    }

    .menu-icons {
        display: block;

        top: -203px;
    }

    body {
        overflow-x: hidden;
    }
}


  
@media only screen and (max-width: 700px) {
    .category-menu{
        display: none;
            margin-top: -88px;
             z-index: 999999999;
         position: absolute;
         margin-left: -15px;
    }
    .menu-heading{
        display: none;
    }
    .category-img{
        display: none;
    }
    .search-content {
     top: 115px;
    width: 80%;
   
    left: 10%;
}



@media screen and (max-width: 600px) {


            


            /* landing page property  */
            
            .parallax_inside {
                width: 60%;
            }
            
            .parallax_content {
                width: 91%;
            }
            
            .parallax_offer {
                margin-top: 15px !important;
                margin-bottom: 15px !important;
            }
            
            .service_row {
                width: 100%;
                height: 160px;
                background: #2e2e2e;
                margin-left: 0px;
                margin-top: -50px;
            }
            
            .service_optional {
                display: none;
            }
            
            .service_container {
                display: flex;
            }
            .service_outer {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                border: dashed 1px #fff;
                background: #222;
                margin-left: 23px;
                margin-top: 26px;
            }
            
            .service_inner {
                width: 45px;
                height: 45px;
                border-radius: 50%;
                background: #fff;
                margin: 7px 6px;
            }
            
            .service_icon {
                position: absolute;
                margin: 7px;
                font-size: 30px;
            }
            
            .service_outer:hover > .service_inner > .service_icon {
                -webkit-transform: scaleX(-1);
                transform: scaleX(-1);
                cursor: pointer;
                transition: 0.5s;
            }
            
            .service_description1 {
                position: absolute;
                font-size: 15px !important;
                line-height: 22px !important;
                margin-left: 95px;
                padding-top: 15px;
            }
            
            .service_description2 {
                position: absolute;
                font-size: 15px !important;
                line-height: 22px !important;
                line-height: 22px !important;
                margin-left: 95px;
                padding-top: 27px;
            }
            
            
            
            .parallax_background {
            
                display: none;
            
            }
            
            .arrow_icon{
            display: inline-block;
            }
            
            .sub_category_view{
            display: none;
            margin-top: 15px;
            }
            
            
            .sub-category-name {
                border-bottom: 1px solid #ff4d03;
                background: #fff;
                padding: 0px 7px;
                font-size: 13px;
                font-weight: bold;
                margin-left: 5px;
                float: left;
                margin-bottom: 10px;
                border-block-end-style: none;
            }
            
            
            .c-v-all {
                background: #000;
                color: #fff;
                padding: 5px 13px;
                width: 22px;
                height: 38px;
                display: inline;
                border-radius: 4px;
                transition: .5s;
            }
            
            
                .search-content {
                    text-align: left;
                }
            
            .product-image-viewe {
                width: 85% ;
                margin-bottom: 60px !important;
            
            }
            
            img.responsive-image.preview-box {
                width: 85%;
                margin-bottom: 25px !important;
            }
            
            /* starte the custome nav css*/
            
            
            
            header.main-menu {
                position: relative;
                left: 0;
                top: 0;
            
            
            }
            
            nav.menu {
                display: flex;
                width: 100%;
            }
            
            ul.nav-list {
                display: flex;
                width: 100%;
                height: 40px;
                width: 100%;
                background-color: var(--primary-color);
            
            }
            
            ul.nav-list li {
                line-height: 2.5rem;
                position: relative;
                text-align: center;
                top: 9px;
                left: 9rem;
            
            
            }
            
            ul.nav-list li .nav-item {
                color: #fff;
                padding: 0 12px;
            }
            
            .menu-icons {
                color: var(--primary-color);
                font-size: 4rem;
                position: absolute;
                top: -40px;
                z-index: 1500;
                right: 2rem;
                transform: translateY(50%);
                display: none;
            }
            
            .sub-menu {
                background-color: #fff;
                color: #fff;
                top: 29px;
                left: 12px;
                width: 170px;
                z-index: 100000000;
                position: absolute;
                border-top: 3px solid var(--primary-color);
                font-size: 12px;
                text-align: left;
                display: none;
                border-bottom: 1px solid #ddd;
                border-right: 1px solid #ddd;
                border-left: 1px solid #ddd;
            
            
            }
            
            .sub-menu .sub-menu {
            
                top: 0px;
                left: 162px;
                border-top: none;
                border-top: 2px solid var(--primary-color)
            }
            
            .sub-menu::before {
                content: "";
                position: absolute;
                top: -16px;
                left: 0;
                border: 7px solid transparent;
                border-bottom-color: #fff;
            }
            
            .sub-menu .sub-menu::before {
            
                top: -4px;
                left: -14px;
                border: 7px solid transparent;
                border-right-color: #fff;
            }
            
            .nav-list li:hover>.sub-menu {
                display: block;
            }
            
            ul.sub-menu li {
                text-align: left;
                padding: 5px 0 0;
                border-bottom: 1px solid #ddd;
                background: #fff;
                margin-left: 5px;
                left: 0px;
            }
            
            .nav-router {
                color: #000;
            }
            
            /* responsive menu */
            
            .service_row {
            width: 103%;
            height: 135px;
            background: #2e2e2e;
            margin-left: 0px;
            margin-top: -50px;
            }
            
            .service_container {
            float: left;
            }
            
            .service_outer {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            border: 1px solid #fff;
            background: #222;
            margin: -22px 94px;
            }
            
            .service_inner {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #ff4d03;
            margin: 6.5px 6px;
            }
            
            .service_icon {
            position: absolute;
            margin: 11px;
            color: #fff;
            font-size: 35px;
            }
            
            .service_outer:hover > .service_inner > .service_icon {
            -webkit-transform: scaleX(-1);
            transform: scaleX(-1);
            cursor: pointer;
            transition: 0.5s;
            }
            
            .service_description1 {
            color: #fff;
            padding: 10px;
            margin-top: 13px;
            font-size: 13px;
            }
            
            .service_description2 {
            color: #fff;
            padding: 10px;
            margin-top: 13px;
            font-size: 13px;
            margin-left: 25px;
            }
            
            .service_description3 {
            color: #fff;
            padding: 10px;
            margin-left: 45px;
            margin-top: 17px;
            font-size: 13px;
            }
            
            .service_description4 {
            color: #fff;
            padding: 10px;
            margin-left: 50px;
            margin-top: 13px;
            font-size: 13px;
            }
            
    

    /* in small view device quick view button won't display */

            .btnQuick{
                
                display: none ;
            }

            
            /* frontend common responsive issue is start from here  */

            img.responsive-image.preview-box 
            {
            width: 85%;
            margin-left: 20px;
            }


            /* landing responsive code is start from here  */

            .container{
            margin:5px;
            }
            .banner_container{
            margin-left:-13px;
            }


        .banner img {
            max-width: 120px;
            max-height: 130px;
            border: 1px solid #eee;
            border-radius: 5px;
            }
        
        
            .top-product-card-small {
            height: 202px;
            width: 200px;
            }
        
            .top-product-card-small img {
            width: 160px !important ;
            height: 160px !important;
            }
        
            .top-product-card-small p {
            font-size: 13px;
            line-height: 2px;
            }
        
            .top-product-card-small h4 {
            font-size: 13px;
            padding-bottom: 3px;
            margin-top: -5px;
            }


            .c-product-header{

                display:none ;
            }
        
            
            .product-card {
            width: 184px;
            height: auto;
            background: #F4F1F0;
            border: 1px solid #ddd;
            text-align: center;
            padding-top: 5px;
            margin-bottom: 15px;
            }


            .product-card:hover>.product-card-footer{
                display: none;
            }
        
            .product-card p {
            font-size: 13px;
            margin-top: -15px;
        
            }
        
            .product-detail h4 {
            font-size: 13px;
            padding-bottom: 10px;
            margin-top: -10px;
            }
        
            .prodict-card-body img {
                width: 150px !important;
                height: 150px !important;
                padding: 5px 0px !important;
            }
        

        

        /* contact us responsive code is here  */
        .address_container {
            margin-top: 30px;
            margin-left: 10px;
            margin-right: 10px;
            margin-bottom: 20px !important;
        }
        .contact_row {
            margin-top: -15px !important;
        }
        p {
            position: relative;
            font-size: 13px;
            line-height: 15px ;
        }
        .box {
            margin: 10px;
        }



        /* single display product responsive isssue is start from here ; */

        
        
        .product-details{
            margin-left: -16px;
        } 

        .product-details ul {

        list-style: none;
        margin-left: -16px;
        margin-right: 3px;
        
        }

        .r_title {
            margin-left:20px;
        }

        .single_product_heading h4 { font-size: 16px ; }

        .list-unstyled h2 { font-size: 20px ; }



        .details-tab-menu-list li{

            font-size: 11px !important;

        }


        

        /* cart responsive is start from here */

        .cart_row{
            padding-bottom: 25px;
        }

        .cart_responsive_item {

                margin-left: 250px;
                margin-top: -54px;
            
        }

        .cart_responsive_price{
            margin-left: 270px;
            margin-top: -44px;

        }  


        .cart_responsive_total{

            margin-left: 310px;
            margin-top: -24px;
        }

        .cart_responsive_remove{

            cursor: pointer;
            margin-left: 350px;
            margin-top: -24px;
        }


        
        /* blog responsive issue is start from here */

        .desc_info p {
            font-size: 12px;
            line-height: 24px;
            font-style: normal;
        }
        .feature_image {
            width: 311px !important;
            height: 230px !important;
            margin-top: 18px !important;
            border: 3px dashed;
        }


        /* carrier details page responsive is here */
        
        .carrier_description {
            font-size: 14px;
            line-height: 24px;
        } 


        .carrier_feature_image {
        width: 205px;
        height: 132px;
        border-radius: 10px;
        }

        /* cart responsive is start from here */

        .cart-open {

            height: 70px;

        }

        .cart-open i {
            font-size: 18px;
        }

        .cart-total {
            background: #fff;
            width: 100%;
            padding: 0px;
            border: 1px solid #ddd ;
            font-size: 14px;
        }


        .cart-total h5 {
            margin-top: 2px !important;
            font-size: 14px;
        }


        /* footer responsive code is start from  here */
        .quick_link{
            margin-left:25px;
        }

        .news_letter{
            margin-left: 25px;
        }

        .subscribe_input{
        width:300px;
        margin-left: 18px;
        
        }

        .email_icon_container {
        margin-right: 70px;
        }

        
        .short_desc_footer{
        font-size: 14px;
        line-height: 24px ;
        padding-right: 10px; 
        }


        .end_footer {
            background: var(--primary-color);
            height: 60px !important;
            width: 100%;
            margin-top: -10px;
        }



        .f_info_left {
        font-size: 14px;
        }

        .f_info_right {
            margin-top: 30px !important;
            margin-left: 3px !important;
            padding-right: 58px !important;
        }



  
}



@media screen and (max-width: 400px) {


            .parallax_inside {
                width: 60%;
            }

            .parallax_content {
                width: 91%;
            }


            .parallax_offer {
                margin-top: 15px !important;
                margin-bottom: 15px !important;
            }


            .service_row {

                width: 100%;
                height: 160px;
                background: #2e2e2e;
                margin-left: 0px;
                margin-top: -50px;

            }

            .service_optional {
                display: none;
            }

            .service_container {
                display: flex;
            }

            .service_outer {

                width: 60px;
                height: 60px;
                border-radius: 50%;
                border: dashed 1px #fff;
                background: #222;
                margin-left: 23px;
                margin-top: 26px;

            }

            .service_inner {

                width: 45px;
                height: 45px;
                border-radius: 50%;
                background: #fff;
                margin: 7px 6px;

            }

            .service_icon {
                position: absolute;
                margin: 7px;
                font-size: 30px;
            }

            .service_outer:hover>.service_inner>.service_icon {

                -webkit-transform: scaleX(-1);
                transform: scaleX(-1);
                cursor: pointer;
                transition: 0.5s;

            }

            .service_description1 {

                position: absolute;
                font-size: 15px !important;
                line-height: 22px !important;
                margin-left: 95px;
                padding-top: 15px;


            }

            .service_description2 {

                position: absolute;
                font-size: 15px !important;
                line-height: 22px !important;
                line-height: 22px !important;
                margin-left: 95px;
                padding-top: 27px;


            }


}



@media screen and (max-width: 350px) {
        #_qvm .related_quick_row {
            display: none;
        }

        #_qvm .modal-dialog {
            margin-top: 10px !important;
            width: 400px !important;
            height: 512px;
        }

        #_qvm .close_sign {
            margin-right: 145px !important;
            font-size: 40px !important;
            margin-top: -19px !important;
            color:var(--primary-color) !important;
        }

        #_qvm .quick_view_image {
            width: 120px !important;
            height: 110px !important;
            margin-bottom: 26px !important;
            margin-left: 50px;
        }

        #_qvm .title {
            margin: 0px !important;
        }

        #_qvm .modal-body .form-group {
            margin-bottom: 5px !important;
        }
        #_qvm .modal-body ul {
            margin-top: -26px;
        }
        #_qvm .modal-body b {
            font-weight: normal;
        }
        #_qvm .modal-body .btn-lg {
            width: 35%;
            margin-top: 5px !important;
            margin-bottom: 5px !important;
            margin-left: 56px !important;
            padding: 5px 0px;
            font-size: 14px;
            border-radius: 5px;
        }

        #_qvm .quick_description {
            font-size: 14px;
            line-height: 15px;
            margin-left:-30px;
        }

        #_qvm .animator {
            margin-top: 10px;
            padding: 10px;
        }

        #_qvm .animator i {
            font-size: 20px;
        }

        #_qvm .modal-body h4 {
            margin-left: 5px !important;
            font-size: 14px !important;
        }

        #_qvm .modal-body p span {
            margin-left: 5px !important;
            font-size: 10px !important;
            line-height: 10px;
        }

        #_qvm .modal-body span {
            margin-left: 5px !important;
            font-size: 10px !important;
            margin-top: -10px;
        }

        #_qvm .modal-body select,
        input {
            width: 130px !important;
            height: 30px !important;
            margin-top: -30px;
            margin-left: 56px;
        }


}





</style>
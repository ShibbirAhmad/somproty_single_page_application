<template>
    <div>
        <div class="profile clearfix">
            <div class="row justify-content-center mt-1">
                <div class="col-lg-12 col-md-12 col-sm-12 ">
                 <strong  class="text-white">Welcome</strong>
                    <h5  class="text-white" style="line-height:.5;">{{user.name}}</h5>
             </div>
            </div>
        </div>
        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu ">
            <div class="menu_section">

                <ul class="nav side-menu">
                    <li><router-link :to=" {name : 'OrderHistory' }" ><i class="fa fa-cart-plus"></i> Order History </router-link> </li>
                    <li> <router-link :to="{ name : 'UserProfile' }"><i class="fa fa-user"></i> profile  </router-link>  </li>
                    <li><router-link :to="{ name: 'UserProfileEdit'}"> <i class="fa fa-edit"> </i> Edit Profile</router-link></li>
                    <li><router-link :to="{ name: 'PasswordEdit'}"> <i class="fa fa-key"></i> change password</router-link></li>
                  </ul>
            </div>
        </div>  
    </div>
</template>

<script>
export default {
    mounted(){
        this.$store.dispatch('user')
    },
    computed:{
        user(){
            return this.$store.getters.user;
        }
    }
}
</script>

<?php

$reseller=session()->get('reseller')
?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{route('dashboard.reseller')}}" class="site_title"><img src="https://mohasagor.com/icons/logo.png" style="height: 50px;width: 150px;margin-top: -14px;margin-left: 20px;"></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="row justify-content-center mt-1">
                <div class="col-lg-2"></div>
                <div class="col-lg-4">
                    <div class="user-profile">
                        @if(!empty($reseller->photo))
                        <img src="{{asset('public/storage/'.$reseller->photo)}}" style="width: 80px;height: 80px;">
                        @else
                        <img src="https://mohasagor.com/reseller/images/img.jpg" alt="" style="width: 80px;height: 80px;">
                        @endif

                    </div>
                </div>
                <div class="col-lg-6 profile_info">
                 <strong class="text-white">Welcome</strong>
                    <h2 class="text-white">{{$reseller->name}}</h2>

                </div>
            </div>

            <div class="profile_info">

            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">

                <ul class="nav side-menu">
                    <li>
                        <a href={{route('dashboard.reseller')}}><i class="fa fa-dashboard"></i> Dashboard </a>

                    </li>

                    <li><a><i class="fa fa-cart-plus"></i> Order <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('index.order.reseller')}}">Manage Order</a></li>
                          <li><a href="{{route('order.create.reseller')}}">Create Order</a></li>
                          <!--<li><a href="{{route('order.wholesale.create.reseller')}}">Wholesale Order</a></li>-->


                            <!--<li><a href="{{route('edit.profile.reseller')}}">Edit Profile</a></li>-->
                        </ul>
                    </li>
                    <li><a><i class="fa fa-user"></i> Profile <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('edit.profile.reseller')}}">Edit Profile</a></li>
                            <li><a href="{{route('view.profile.reseller')}}">view Profile</a></li>
                            <li><a href="{{route('change.profile.reseller.password')}}">Change Password</a></li>

                        </ul>
                    </li>
                    
                    
                     <li><a href="{{route('resellerWise.payment')}}"><i class="fa fa-file"></i> Payment</a>
                       
                    </li>
                    

                    </li>
                </ul>
            </div>


        </div>
    
    </div>
</div>

<style>
    .profile.clearfix {
        border-bottom: 1px solid #fff;
        height: 100px;
    }
</style>

<?php

$reseller=session()->get('reseller')
?>
@extends('reseller.layouts.app')
@section('page_title')
    {{ 'View | Reseller || Profile' }}
@endsection
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Profile View</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Settings 1</a>
                                    <a class="dropdown-item" href="#">Settings 2</a>
                                </div>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row justify-content-center">
                            <div class="col-md-6 bg-dark text-white text-center mt-5 col-sm-3  profile_left" style="border-right: 4px solidid #000;">
                                <div class="profile_img mt-5">
                                    <div id="crop-avatar">


                                        @if(!empty($reseller->photo))
                                            <img src="{{asset('public/storage/'.$reseller->photo)}}" class="img-responsive avatar-view" >
                                        @else
                                            <img src="https://mohasagor.com/reseller/images/img.jpg" alt="" class="img-responsive avatar-view">
                                        @endif
                                    </div>
                                </div>

                                <h2 class="text-black">{{$reseller->name}}</h2>
                                <h4 class="text-black">Mohasagor Reseller</h4>


                                <dl class="row">
                                    <dt class="col-sm-3">Email</dt>
                                    <dd class="col-sm-9 text-black">{{$reseller->email ?: "Not Recoded"}}</dd>

                                    <dt class="col-sm-3">Mobile</dt>
                                    <dd class="col-sm-9 text-black">
                                        {{$reseller->phone ?: "Not Recoded"}}
                                    </dd>

                                    <dt class="col-sm-3">Address</dt>
                                    <dd class="col-sm-9 text-black">

                                            {{$reseller->address?: "Not recoded at now"}}


                                    <dt class="col-sm-3 text-truncate">Bkash No</dt>
                                    <dd class="col-sm-9 text-black">

                                        {{$reseller->bkash_number?: "Not recoded at now"}}

                                    </dd>
                                    <dt class="col-sm-3 text-truncate">Comapany Name</dt>
                                    <dd class="col-sm-9 text-black">

                                        {{$reseller->company_name?: "Not recoded at now"}}

                                    </dd>


                                </dl>

                                <a class="btn btn-success btn-block" href="{{route('edit.profile.reseller')}}">Edit Profile</a>
                                <a class="btn btn-primary btn-block mb-5" href="{{route('change.profile.reseller.password')}}">Change Password</a>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /top tiles -->

    </div>


<style>
    .img-responsive{
        
        width:128px;
        height:128px;
    }
</style>

    </body>
@endsection



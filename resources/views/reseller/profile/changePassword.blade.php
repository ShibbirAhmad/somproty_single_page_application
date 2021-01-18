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
                                            <img src="{{asset('public/storage/'.$reseller->photo)}}" class="img-responsive avatar-view" style="width:128px;height128px;">
                                        @else
                                            <img src="https://mohasagor.com/reseller/images/img.jpg" alt="" class="img-responsive avatar-view">
                                        @endif
                                    </div>
                                </div>



                                <form action="{{route('change.profile.reseller.password')}}">
                                    @if (!session()->has('oldPassword'))
                                    <h2 class="text-black">Hi  ! {{$reseller->name}} input your old password</h2>


                                    @endif

                                    @if (session()->has('error'))
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                          {{ session()->get('error') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    @if (session()->has('oldPassword'))
                                        <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                                            {{ session()->get('oldPassword') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                  <input type="password" class="form-control" placeholder="Enter New Password" name="new_password">



                                    @endif


                                        @if (!session()->has('oldPassword'))

                                    <input type="password" class="form-control" placeholder="old_password" name="old_password">
                                     @endif
                                    <button class="btn btn-success btn-block mt-3 mb-3" type="submit">Next</button>
                                </form>


                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /top tiles -->

    </div>



    </body>
@endsection



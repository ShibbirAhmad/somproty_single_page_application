<?php

$reseller=session()->get('reseller')
?>
@extends('reseller.layouts.app')
@section('page_title')
    {{ 'Edit | Reseller || Profile' }}
@endsection
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6 text-right">
                <a class="btn btn-primary" href="{{route('view.profile.reseller')}}">view profile</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Profile</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form action="{{route('update.profile.reseller')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                                                      @if ($errors->any())
                                @foreach($errors->all() as $error)   
                        
                                    <li class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Alert!</strong> {{ $error }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </li>
                        
                                @endforeach
                            @endif
                        
                                @if (session()->has('message'))
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> {{ session()->get('message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                          <input type="hidden" name="id"  value="{{$reseller->id}}">
                       <div class="row justify-content-center">
                           <div class="col-lg-4">
                               <div class="form-group">
                                   <label>Username</label>
                                   <input type="text" class="form-control" placeholder="username" name="username" value="{{$reseller->username}}" readonly>
                               </div>

                               <div class="form-group">
                                   <label>Name</label>
                                   <input  class="form-control" placeholder="name" type="text" name="name" value="{{$reseller->name}}">
                               </div>
                                    
                                   
                               <div class="form-group">
                                   <label>Email</label>
                                   <input class="form-control" placeholder="email" type="email" name="email" value="{{$reseller->email ?: ""}}">
                               </div>

                               <div class="form-group">
                                   <label>Phone</label>
                                   <input class="form-control" placeholder="phone" type="text" name="phone" value="{{$reseller->phone ?: ""}}">
                               </div>
                           </div>
                           <div class="col-lg-2"></div>
                           <div class="col-lg-4">

                               <div class="form-group">
                                   <label>Address</label>
                                   <input class="form-control" placeholder="address" type="text" name="address" value="{{$reseller->address ?: ""}}">
                               </div>

                               <div class="form-group">
                                   <label>bKash_no</label>
                                   <input class="form-control" placeholder="bkash_no" type="text" name="bkash_no" value="{{$reseller->bkash_number ?: ""}}">
                               </div>
                               
                                <div class="form-group">
                                   <label>company_name</label>
                                   <input class="form-control" placeholder="company_name" type="text" name="company_name" value="{{$reseller->company_name ?: ""}}">
                               </div>

                              

                               <div class="form-group">
                                   <label>Photo</label>
                                   <input type="file"  class="form-control"  name="image">
                               </div>
                           </div>
                       </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4">
                                <button class="btn btn-primary"  type="submit" style="width: 100%;">Update</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /top tiles -->

    </div>




    </body>
@endsection



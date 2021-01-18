<?php

$reseller=session()->get('reseller')
?>

@extends('reseller.layouts.app')
@section('page_title')
    {{ 'Admin || Dashboard' }}
@endsection
@section('content')
    <!-- page content -->
        <div class="right_col" role="main">
            <!-- top tiles -->
            <div class="row" >
                <div class="tile_count">
                    <div class="col-lg-2  tile_stats_count">
                        <span class="count_top"> Total Orders</span>
                        <div class="count">{{$orders['total']}}</div>
                    </div>
                    <div class="col-lg-2  tile_stats_count">
                        <span class="count_top">New Orders</span>
                        <div class="count green">{{$orders['new']}}</div>
                    </div>
                    <div class="col-lg-2  tile_stats_count">
                        <span class="count_top">Pending Orders</span>
                        <div class="count ">{{$orders['pending']}}</div>
                    </div>
                    <div class="col-lg-2   tile_stats_count">
                        <span class="count_top">Approved Orders</span>
                        <div class="count green">{{$orders['approved']}}</div>
                    </div>
                    <div class="col-lg-2  tile_stats_count">
                        <span class="count_top">Shipment Orders</span>
                        <div class="count">{{$orders['shipment']}}</div>
                    </div>
                    <div class="col-lg-2  tile_stats_count">
                        <span class="count_top"> Delivered Orders</span>
                        <div class="count green">{{$orders['delivered']}}</div>
                    </div>
                    <div class="col-lg-2  tile_stats_count">
                        <span class="count_top">Cancel Orders</span>
                        <div class="count red">{{$orders['cancel']}}</div>
                    </div>
                </div>
            </div>
            <!-- /top tiles -->
            
           <br/>
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center" style="border-bottom:2px solid #fff;">
                    <h4>Useful Links</h4>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <a class="btn btn-dark text-white" href="https://www.facebook.com/onlinemohasagor" target="_blank">Facebook Page</a>
                    <a class="btn btn-dark text-white" href="https://bit.ly/3eXiOuD" target="_blank">Facebook Group</a>
                    <a class="btn btn-dark text-white" href="https://drive.google.com/drive/folders/117o8t__d5RrFQ47LeZlpNw0t4uC_4rHi?fbclid=IwAR2ZjaeF_eHaQMNSD88X5hgWWchwQqLMJvBKXC5EunTOvsusZipxN1Ubxac" target="_blank">Product list</a>
                    <!--<a class="btn btn-dark text-white">Terms and condition</a>-->
                </div>
            </div>

        </div>


<style>
@media only screen and (max-width: 768px) {
  /* For mobile phones: */
  [class*="col-lg-2"] {
    width: 50% !important;
  }
}
</style>

@endsection



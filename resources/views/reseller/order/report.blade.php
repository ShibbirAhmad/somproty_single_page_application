<?php

$reseller=session()->get('reseller');

$deliverdAmoutn=0;
$paid=0;
$advance=0;



foreach($orders as $order){
    
 
    if($order->orders->status==7){
        $deliverdAmoutn=$order->sum('order_total');
     }
     


}



?>
@extends('reseller.layouts.app')
@section('page_title')
    {{ 'Report | Order || Reseller' }}
@endsection
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                
                                <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
                                       Hi ! {{$reseller->name}}, Don't think about this report or calculation because currently we are developed our system. We promise that, you do not lose a penny or commission during the development of our system. Thank you so much.
                                        <button type="button" class="close btn-warning" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                             </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="order-preview">
                                    <h2 class="text-center text-black" style="border-bottom: 2px solid #000;margin-bottom: 30px;font-size: 25px;">Your order report </h2>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Invoice_no</th>
                                                    <th scope="col">Order_id</th>
                                                    <th scope="col">Order_date</th>
                                                    <th scope="col">Payment</th>
                                                    <th scope="col">Payment_data</th>
                                                    <th scope="col">Your Profit</th>
                                                    <th scope="col">Advance</th>
                                                      <th scope="col">Total</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                              
                                                    @foreach($orders as $k=> $item)
                                                    <tr>
                                                        <td>{{$k+1}}</td>
                                                        <td>{{$item->orders ? $item->orders->invoice_no: "null"}}</td>
                                                        <td>{{$item ? $item->order_id: "null"}}</td>
                                                             <td>
                                                                @if(!empty($item->orders) && !empty($item->orders->created_at))
                                                                    {{date_format($item->orders->created_at,"d M, Y ")}}
                                                                <br/>
                                                                    <b>{{ $item->orders->created_at->diffforhumans()}}</b>
                                                                @else
                                                                  "Not Recoded"
                                                                @endif
                                                            </td>
                                                        <td>{{$item->paid ? "paid" : "unpaid"}}</td>
                                                         <td>{{$item->paid_date ? $item->paid_date : "Unpaid"}}</td>

                                                        <td>{{$item->total_amount? $item->total_amount: "00000"}}</td>
                                                          <td>{{$item->advance? $item->advance: "00000"}}</td>
                                                            <td>{{$item->order_total ? $item->order_total: "00000"}}</td>

                                                     </tr>
                                                    @endforeach
                   
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                </div>
                            </div>
                           
                
                            <div class="col-lg-3">
                                  <div class="payment bg-dark text-white">
                                      <h2 class="text-center text-white" style="border-bottom: 2px solid #fff;margin-bottom: 30px;font-size: 25px;">Your amount report </h2>

                                      <div class="row">
                                      
                                          <div class="col-lg-12 bg-white mb-3">
                                             <h3 class="text-black text-center font-20"> Total amount :000 TK</h3>
                                          </div>
                                                 
                                
                                           <div class="col-lg-12 bg-white mb-3">
                                             <h3 class="text-black text-center font-20"> Total delivered amount : {{$deliverdAmoutn}} TK</h3>
                                          </div>
 
                                          <div class="col-lg-12 bg-white mb-3">
                                              <h3 class="text-black text-center font-20"> Total paid amount : {{$paid}} TK</h3>
                                          </div>

                                          <div class="col-lg-12 bg-white mb-3">
                                              <h3 class="text-black text-center font-20"> Total Unpaid Amount : 0000 TK</h3>
                                          </div>
                                          
                                         <li class="bg-warning"> Total amount not countable. we are just count deliverd product amount.</li>
                                     </div>
                                          </div>
                                      </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /top tiles -->

    </div>




    <!-- Button trigger modal -->


    <!-- Modal -->

    <style>

        .text-black{
            color: #000;

        }
        #_shiiping_Contact{
            display: none;
        }
        .payment {
            padding: 10px  25px;
        }
        .font-20{
            font-size: 20px;
        }
        .order-preview {
            background: #ddd;
            padding: 10px 25px;
        }

    </style>

@endsection



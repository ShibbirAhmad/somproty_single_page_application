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
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="text-black">Order Details</h4>
                                <h5 class="text-black">Payment Invoice Number :   {{"RSPAY-".$payment->id}}</h5>
                                <table class="table table-bordered">
                                    <thead style="background: #2A3F54;color: #fff;">
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice Number</th>
                                        <th>Order Total(BDT)</th>
                                        <th>Reseller Commission(BDT)</th>
                                        <th>Advance</th>
                                        <th>Order Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($details as $k=> $order )
                                        <tr>
                                            <td>{{$k+1}}</td>
                                            <td>{{$order->orders->invoice_no?? 'null'}}</td>
                                            <td>{{$order->order_total?? 'null'}}</td>
                                            <td>{{$order->total_amount?? 'null'}}</td>
                                            <td>{{$order->advance?? 'null'}}</td>
                                            <td>{{$order->created_at?? 'null'}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="total">Total Commission: <b class="text-black"> {{number_format($details->sum('total_amount')?:"00")}}</b></td>
                                        <td class="total">Total Advance: <b class="text-black"> {{number_format($details->sum('advance')?:"00")}}</b></td>
                                        <td></td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr/>
                        <div class="row summary">
                            <div class="col-lg-4"></div>
                            {{--            <div class="col-lg-4">--}}
                            {{--                <h3>Reseller Information</h3>--}}
                            {{--                <hr/>--}}
                            {{--                <dl class="row">--}}
                            {{--                    <dt class="col-sm-6">Username</dt>--}}
                            {{--                    <dd class="col-sm-6 text-black">{{$payment->reseller->username?:"null"}}</dd>--}}

                            {{--                    <dt class="col-sm-6">Name</dt>--}}
                            {{--                    <dd class="col-sm-6 text-black">--}}
                            {{--                        {{$payment->reseller->name?:"null"}}--}}
                            {{--                    </dd>--}}
                            {{--                    <dt class="col-sm-6">Company Name</dt>--}}
                            {{--                    <dd class="col-sm-6 text-black">--}}
                            {{--                        {{$payment->reseller->company_name?:"null"}}--}}
                            {{--                    </dd>--}}
                            {{--                    <dt class="col-sm-6">Address</dt>--}}
                            {{--                    <dd class="col-sm-6 text-black">--}}
                            {{--                        {{$payment->reseller->address?:"null"}}--}}
                            {{--                    </dd>--}}
                            {{--                    <dt class="col-sm-6">Mobile</dt>--}}
                            {{--                    <dd class="col-sm-6 text-black">--}}
                            {{--                        {{$payment->reseller->mobile?:"null"}}--}}
                            {{--                    </dd>--}}
                            {{--                    <dt class="col-sm-6">Email</dt>--}}
                            {{--                    <dd class="col-sm-6 text-black">--}}
                            {{--                        {{$payment->reseller->email?:"null"}}--}}
                            {{--                    </dd>--}}

                            {{--                </dl>--}}
                            {{--            </div>--}}

                            <div class="col-lg-4" style="border-right: 5px solid #333333;">
                                <h3>Order Summary</h3>

                                <dl class="row">
                                    <dt class="col-sm-8">Total Order</dt>
                                    <dd class="col-sm-4 text-black">
                                        {{$details->count()}}
                                    </dd>

                                    <dt class="col-sm-8">Total order amount (BDT)</dt>
                                    <dd class="col-sm-4 text-black">
                                        {{number_format($details->sum('order_total'))}}
                                    </dd>
                                    <dt class="col-sm-8">Total Reseller commission Amount (BDT)</dt>
                                    <dd class="col-sm-4 text-black">
                                        {{number_format($details->sum('total_amount'))}}
                                    </dd>




                                </dl>
                            </div>
                            <div class="col-lg-4">
                                <h3>Payment Summary</h3>

                                <dl class="row">
                                    <dt class="col-sm-8">Payment invoice number</dt>
                                    <dd class="col-sm-4 text-black">
                                        {{"RSPAY-".$payment->id}}
                                    </dd>
                                    <dt class="col-sm-8">Total amount(BDT)</dt>
                                    <dd class="col-sm-4 text-black">
                                        {{number_format($details->sum('total_amount'))}}
                                    </dd>

                                    <dt class="col-sm-8">Total advance amount (BDT)</dt>
                                    <dd class="col-sm-4 text-black">
                                        {{number_format($details->sum('advance'))}}
                                    </dd>

                                    <dt class="col-sm-8 text-truncate">Issue Date</dt>
                                    <dd class="col-sm-4 text-black">
                                        {{$payment->created_at}}
                                    </dd>


                                </dl>
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
    <style>
        .page-break {
            display: none;
            background-color: #fff;
            padding-bottom: 50px;
            padding-top: 50px;
            margin-bottom: 20px;
            width: 70%;
        }
        .main-content {
            background: #fff;
            border: 2px solid #000;
            padding: 15px 12px;
            margin-top: 29px;
        }
        .text-black{
            color: #000000;
            font-weight: bold;
        }
        .page-break{
            display: none;
        }
        @media print {
            #left-column {
                display: none;
            }
            .page-break{
                display: block;
            }
            .single-order{
                display: none;
            }
            .print{
                display: none;
            }
            #right-column {
                border-top: none;
            }
            #footer-container {
                display: none;
            }
            .col-lg-4{
                width: 300px !important;
                border-right: 0px !important;
            }
            .page-break{
                display: block;
                margin-top:15px !important;
            }
            .main-content{
                border: none !important;
            }
            .col-lg-4{
                width: 300px !important;
            }
            .table td{
                line-height: 1 !important;
            }
            .total{
                height: 60px !important;
            }
            .summary{
                display: none !important;
            }
            .nav_menu{
                display: none;
            }

        }
    </style>

@endsection



@extends('reseller.layouts.app')
@section('page_title')
    {{ 'Payment || Reseller' }}
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
                                <div class="order-preview">
                                    <h2 class="text-center text-black" style="border-bottom: 2px solid #000;margin-bottom: 30px;font-size: 25px;">Your payment from mohasagor </h2>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Payment_invoice_number</th>
                                                    <th scope="col">Payment_date</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                              
                                                    @foreach($payments as $k=> $payment)
                                                    <tr>
                                                        <td>{{$k+1}}</td>
                                                        <td>
                                                            {{"RSPAY-".$payment->id}}
                                                        </td>
                                                        <td>{{$payment->created_at ? $payment->created_at.'||'.$payment->created_at->diffforhumans()  :"null" }}</td>
                                                        <td>
                                                            <a href="{{route('details.resellerWise.payment',$payment->id)}}" class="btn btn-info" ><i class="fa fa-eye"></i></a>
                                                        </td>
                                              </tr>
                                                    @endforeach
                   
                                                </tbody>
                                            </table>

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



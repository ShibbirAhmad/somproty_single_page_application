<?php

$reseller=session()->get('reseller')
?>
@extends('reseller.layouts.app')
@section('page_title')
    {{ 'Manage | Order || Reseller' }}
@endsection
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6 text-right">
                <button class="btn btn-primary btn-dark" id="create">create new</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Order Table</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="filtering">
                            <form action="{{route('order.search.reseller')}}" >
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">


                                        <div class="col-lg-8">
                                            <input type="text" autocomplete="off" class="form-control mb-3" placeholder="Search With invoice or phone number" name="invoiceOrPhone">

                                        </div>

                                    </div>
                                    <div class="col-lg-2" style="margin-left: -120px;">
                                        <select class="form-control" name="status">
                                            <option disabled selected> Select status</option>
                                            <option value="1">New</option>
                                            <option value="2">Approved</option>
                                            <option value="3">Pending</option>
                                            <option value="4">Shipment</option>
                                            <option value="5">Delivered</option>
                                            <option value="6">Cancel</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-dark btn-small" style="height: 36px;">Search</button>
                                </div>
                            </form>


                        </div>

                        
                               @if (session()->has('message'))
                                    <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
                                        <strong>Success!</strong> {{ session()->get('message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer name</th>
                                <th scope="col">Customer mobile</th>
                                <th scope="col">Customer Address</th>
                                <th scope="col">Invoice_no</th>
                                <th scope="col">Order_status</th>

                                <th scope="col">shipping_cost</th>
                                <th scope="col">Advance</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Total_amount</th>
                                <th scope="col">Order_date</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                           @if(isset($orders))            
                            @foreach($orders as $k=> $order)
                                 <tr>
                                <th scope="row">{{$k+1}}</th>
                                <td>{{$order->customer->name ?: ""}}</td>
                                <td>{{$order->cutomer_phone ?: ""}}</td>
                                <td>{{$order->customer->address ?: ""}}</td>
                                <td>{{$order->invoice_no  ?: "null"}}</td>
                                <td>  @if($order->status == 1)
                                        <b style="color:grey;">New Order</b>
                                    @elseif($order->status == 2)
                                        <b style="color:#4596f1;">Pending Order</b>
                                    @elseif($order->status == 3)
                                        <b style="color:#f145cc;">Approved Order</b>
                                    @elseif($order->status == 4)
                                        <b style="color:#6f45f1;">Shipment Order</b>
                                    @elseif($order->status == 5)
                                        <b style="color:green;">Delivered Order</b>
                                    @elseif($order->status == 6 || $order->status == 5)
                                        <b style="color:red;">Cancel Order</b>
                                    @endif</td>
                                <td>{{$order->shipping_cost}}</td>
                                <td>{{$order->paid ?: 00}}</td>
                                <td>{{$order->discount ?: 00}}</td>
                                <td>
                                    {{$order->total}}-{{($order->discount  + $order->paid)}}=
                                   <b> {{($order->total)-($order->discount ?: 0 + $order->paid)}}</b>
                                </td>
                                <td>
                                    @if(!empty($order->created_at))
                                        {{date_format($order->created_at,"d M, Y ")}}
                                    <br/>
                                        <b>{{ $order->created_at->diffforhumans()}}</b>
                                    @else
                                      "Not Recoded"
                                    @endif
                                </td>

                                <td>
{{--                                    @if($order->status==7)--}}
{{--                                 <a href="{{route('edit.order.reseller',$order->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>--}}
{{--                                    @endif--}}
                                    <a href="{{route('view.order.reseller',$order->id)}}" class="btn btn-sm btn-dark" ><i class="fa fa-eye"></i></a>
                                    <a href="{{route('cancel.order.reseller',$order->id)}}" class="btn btn-sm btn-danger" title="Cancel" onclick="return confirm('Are you sure cancel this ?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr><h3 class="text-center">No Order Found</h3></tr>
                        @endif    
                            </tbody>
                        </table>
                
                 @if(!empty($appendData))
                            {{$orders ->appends($appendData)->links()}}
                        @else
                            {{$orders->links()}}
                        @endif
                        <p class="text-black">Showing <b>{{$orders->firstItem()}}</b> to <b>{{$orders->lastItem()}} </b> of total <b>{{$orders->total()}}</b> Item's</p>

                    </div>
                </div>
            </div>
        </div>
        <!-- /top tiles -->

    </div>




    <!-- Button trigger modal -->


 

    <style>

        .text-black{
            color: #000;
        }
        #_shiiping_Contact{
            display: none;
        }

    </style>

    <script>


        $("#create").on('click', function (e) {
            $("#addModal").modal('show');

        })
        $('#mobile').on('keyup', function (event) {        ////get customer search
            event.preventDefault();
            let value = $("#mobile").val();
            let admin_name = "{{session()->get('reseller')['name']}}"
            let action = "{{route('reseller.customer.search',':id')}}";

            if (value.length == 11) {

                $('.numberMsg').text('Number 11 digit. Great !! ');
                $('.numberMsg').removeClass('text-danger');
                $('.numberMsg').addClass('text-black');
                $.ajax({
                    url: action.replace(':id', value),
                    type: "GET",
                    dataType: 'json',
                    cache: false,
                    // beforeSend: function () {
                    //     $('.loading').show();
                    // },
                    success: function (resp) {
                        $('.spinner').hide();
                        if (resp.success == "OK") {


                            if (confirm(admin_name + ", This customer all ready register in mohasagor.com?  Remember  Last Order Created_at " + resp.data.created_at + " || " + resp.date)) {
                                $('#shipping_address').text(resp.data.address);
                                if (resp.data.mobile_no) {
                                    $('#mobile_no').val(resp.data.mobile_no);
                                    $('#name').val(resp.data.name);
                                    $('#shiping_contact').val(resp.data.mobile_no);
                                } else {
                                    $('#mobile_no').val(resp.data.shipping_mobile_no);
                                    $('#name').val(resp.user.full_name);
                                    $('#shiping_contact').val(resp.data.shipping_mobile_no);


                                }

                            }
                        }
                    },
                    error: function (e) {
                        //  console.log(e);
                        $('.loading').hide();

                    }

                });
            } else {
                $('.numberMsg').show()
                $('.numberMsg').addClass('text-danger');
                $('.numberMsg').removeClass('text-black');
                if (value.length > 11) {
                    $('.numberMsg').text('Number greater than 11 digit (' + value.length + ")");
                } else {
                    $('.numberMsg').text('Number smaller than 11 digit (' + value.length + ")");

                }
            }


        });


        $('#product_add').on('click', function (event) {        ////product find
            event.preventDefault();
            let id = $("#product_code").val();

            let action = "{{route('product.find.reseller',':id')}}";
            let table = $('#productTable');
            let tbdoy = table.find('tbody')
            let len = tbdoy.find('tr').length;


            $.ajax({
                url: action.replace(':id', id),
                type: "GET",
                dataType: 'json',
                cache: false,
                beforeSend: function () {
                    $('.spinner').show();
                },
                success: function (resp) {
                    $('.spinner').hide();
                    $('.error').hide();
                    if (resp.success == "OK") {
                        let option = "";
                        if (resp.size.length > 0) {
                            resp.size.forEach(function (element, idx) {

                                option += '<option value="' + element.product_wise_size_id + '">' + element.size_title_lang1 + ' </option>';
                            })
                        }
                        tbdoy.append('<tr>' +
                            '<td>' + len + '</td>' +
                            '' +
                            '<input  class="form-control col-md-1 input-sm order_id" type="hidden" name="details_in[' + (len - 1) + '][merchant_id]" value="' + resp.product.fk_merchant_id + '">' +
                            '<input  class="form-control col-md-1 input-sm order_id" type="hidden" name="product" value="hello">' +

                            '<input  class="form-control col-md-1 input-sm order_id" type="hidden" name="details_in[' + (len - 1) + '][sale_price]" value="' + resp.product.sale_price + '">' +
                            '<input  class="form-control col-md-1 input-sm order_id" type="hidden" name="details_in[' + (len - 1) + '][purchase_price]" value="' + resp.product.purchase_price + '">' +
                            '<input  class="form-control col-md-1 input-sm order_id" type="hidden" name="details_in[' + (len - 1) + '][product_id]" value="' + resp.product.id + '">' +
                            '<td>' + resp.product.product_name_lang2 + '</td>' +
                            '<td>' + resp.product.product_code + '</td>' +
                            '<td><input type="number" value="1" style="width: 60px;" id="quantity'+resp.product.id+'" class="quantity" name="details_in[' + (len - 1) + '][quantity]"></td>' +
                            '<td><select name="details_in[' + (len - 1) + '][product_wise_size_id]">' + option + '</select></td>' +
                            '<td class="single_price" id="single_price_'+resp.product.id+'">' + resp.product.sale_price + '</td>' +
                            '<td class="price" style="font-size:12px;color: #000; " id="price_' + resp.product.id + '">' + resp.product.sale_price + '</td>' +
                            '<td><input style="width: 50px;" type="text" value="0" name="details_in[' + (len - 1) + '][reseller_commission_percent]" onkeyup="com(' + resp.product.id + ')" id="commission' + resp.product.id + '"></td>' +
                            '<td><input style="width: 70px;cursor: no-drop;"  readonly type="text" class="commission" value="0" onkeyup="com(' + resp.product.id + ')" id="your_commission' + resp.product.id + '"></td>' +
                            '</tr>')
                        calculatePayment();
                        com(resp.product.id);
                        calculateDiscount();


                    }

                },
                error: function (e) {
                    console.log(e);
                    $('.error').show();
                    $('.spinner').hide();


                }

            });


        });
        $("#free_shipping").change(function () {

            if ($(this).is(':checked')) {
                if (confirm("Are you sure this is free shipping order or product.")) {
                    $("#shipping_cost").val('free-shipping');
                }
            } else {

                $("#shipping_cost").val('');

            }


        });
        $("#anaotherNumber").change(function () {

            if ($(this).is(':checked')) {

                $("#_shiiping_Contact").show();

            } else {

                $("#_shiiping_Contact").hide();

            }
        });
        $("#city").change(function () {

            let id = $("#city").val();

            if (id == 1) {
                $("#shipping_cost").val(60)

            } else {
                $("#shipping_cost").val(120)


            }


        });

        $('#productForm').on('submit', function (event) {
            event.preventDefault();
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let formData = new FormData($(this)[0]);
            $.ajax({
                headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
                url: $(this).attr('action'),
                method: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.spinner').show();
                    $('#smalText').text("Saving");
                },
                //success function
                success: function (resp) {
                    console.log(resp)
                    $('.spinner').hide();
                    if (resp.success == "OK") {
                        location.reload();

                        Swal.fire({
                            type: 'success',
                            text: "Product Add successfully",
                            position: 'top-end',
                            showConfirmButton: false
                        });

                    } else {
                        Swal.fire({
                            type: 'error',
                            title: '<P style="color: red;">Oops...<p>',
                            text: resp.errors,
                            footer: '<b> Something Wrong</b>'
                        });
                    }
                },
                //error function
                error: function (e) {
                    console.log(e)
                    alert("some thing want wrong");
                    $('.spinner').hide();

                }
            });
        });

        $('#productTable').on('change', '.quantity', function () {
            calculatePayment();
            calculateDiscount();
            let id=$(this).attr('id')
            let product_id=id.split('quantity')[1];
            let value=$(this).val();
            console.log(value);

            if (value<1){
                alert('quantity can not be smaller than 1')
                $(this).val(1)
                value=1;
            }

            let current_commission= $("#productTable").find('#your_commission' + product_id).val();
            let current_commission_percent= $("#productTable").find('#commission' + product_id).val();
            let price= $("#productTable").find('#single_price_' + product_id).text();

            $("#productTable").find('#your_commission' + product_id).val(parseFloat(value)*parseFloat(current_commission));
            $("#productTable").find('#price_' + product_id).text(parseFloat(value)*parseFloat(price));

            com(product_id);
        });
        
          $('#productTable').on('keyup', '.quantity', function () {
            calculatePayment();
            calculateDiscount();
            let id=$(this).attr('id')
            let product_id=id.split('quantity')[1];
            let value=$(this).val();
            console.log(value);

            if (value<1){
                alert('quantity can not be smaller than 1')
                $(this).val(1)
                value=1;
            }

            let current_commission= $("#productTable").find('#your_commission' + product_id).val();
            let current_commission_percent= $("#productTable").find('#commission' + product_id).val();
            let price= $("#productTable").find('#single_price_' + product_id).text();

            $("#productTable").find('#your_commission' + product_id).val(parseFloat(value)*parseFloat(current_commission));
            $("#productTable").find('#price_' + product_id).text(parseFloat(value)*parseFloat(price));

            com(product_id);
        });

        function calculatePayment() {
            var $tbody = $('#productTable').find('tbody');
            var total_amount = 0;

            $tbody.find('tr').each(function (idx) {

                var product_price = parseFloat($(this).find('.single_price').text().trim()) || 0;
                var product_quantity = parseFloat($(this).find('.quantity').val().trim()) || 0;
                total_amount += product_price * product_quantity;

            });


            $(".paymentDue").text(parseFloat(total_amount));
            $("#total_amount").val(parseFloat(total_amount));

        };

        function com(product_id) {

            var $tbody = $('#productTable').find('tbody');
            var total_percant = 0;
            let total_commission = 0;
            let main_price = parseFloat($("#price_" + product_id).text());
            let com = parseFloat($("#commission" + product_id).val());
            let your_commission = main_price / parseFloat(100) * com;
            $("#productTable").find('#your_commission' + product_id).val(parseFloat(your_commission));
            $tbody.find('tr').each(function (idx) {
                var percent = parseFloat($(this).find('.commission').val().trim()) || 0;
                total_percant += percent + 0;
            });
            $(".your-amount-commission").find('strong').text(total_percant.toFixed(2));
            $(".calculation").find('#reseller_total').val(parseFloat(total_percant.toFixed(2)));

            if (total_percant>0){
                $(".calculation").find('#reseller_total_percent').val(parseFloat(total_percant.toFixed(2)));

            }



        }
        function calculateDiscount() {
            let previous_amount = parseFloat($("#total_amount").val())
            let discount = parseFloat($(".discount").val().trim() || 0);
            let paid_amount = parseFloat($(".paid").val().trim() || 0);
            let amount =parseFloat(previous_amount)  - (parseFloat(discount+paid_amount));
            let total_percent = $("#reseller_total_percent").val();
            $(".paymentDue").text(amount);

        }
    </script>
@endsection



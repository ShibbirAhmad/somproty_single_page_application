<?php

$reseller = session()->get('reseller'); ?>
@extends('reseller.layouts.app')
@section('page_title')
    {{ 'Manage | Order || Reseller' }}
@endsection
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 class="text-black text-center">Order Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (session()->has('message'))
                            <li class="bg bg-success">{{ session()->get('message') }}</li>
                        @endif
                        <div class="order-information">
                            <div class="row">
                                <div class="col-lg-4">
                                    <dl class="row">
                                        <dt class="col-sm-3">Name</dt>
                                        <dd class="col-sm-9 text-black">{{ $order->customer->name ?? 'Not Recoded' }}</dd>

                                        <dt class="col-sm-3">Mobile</dt>
                                        <dd class="col-sm-9 text-black">
                                            {{ $order->cutomer_phone ?? 'Not Recoded' }}
                                        </dd>

                                        <dt class="col-sm-3">Address</dt>
                                        <dd class="col-sm-9 text-black">
                                            @if (!empty($order->city))
                                                {{ $order->customer->address . ',' . ' ' . $order->city->name }}
                                            @else
                                                {{ $order->customer_address }}
                                            @endif
                                        </dd>

                                        <dt class="col-sm-3 text-truncate">Courier</dt>
                                        <dd class="col-sm-9 text-black">
                                            @if (isset($order->courier))
                                                {{ $order->courier->name }}
                                            @else
                                                not set now
                                            @endif
                                        </dd>
                                        <dt class="col-sm-3 text-truncate">Note</dt>
                                        <dd class="col-sm-9 text-black">

                                            {{ $order->note ?? null }}

                                        </dd>


                                    </dl>
                                </div>

                                <div class="col-lg-4 text-left" style="border-right: 5px solid #dda0dd;">
                                    <dl class="row">
                                        <dt class="col-sm-6">Shipping Number</dt>
                                        <dd class="col-sm-6 text-black">

                                            @if (!empty($order->cutomer_phone))
                                                {{ $order->cutomer_phone }}
                                            @else
                                                {{ $order->cutomer_phone }}
                                            @endif
                                        </dd>

                                        <dt class="col-sm-6">Shipping City</dt>
                                        <dd class="col-sm-6 text-black">
                                            @if (!empty($order->city))
                                                {{ $order->city->name }}
                                            @endif
                                        </dd>

                                        <dt class="col-sm-6">Shipping Cost</dt>
                                        <dd class="col-sm-6 text-black">
                                            @if (!empty($order->shipping_cost))
                                                @if ($order->shipping_cost == 'free-shipping')
                                                    Free Shipping
                                                @else
                                                    {{ $order->shipping_cost }}
                                                @endif
                                            @else
                                                @if (!empty($order->subcity))
                                                    {{ $order->subcity->cost }}
                                                @endif

                                            @endif
                                        </dd>

                                        <dt class="col-sm-6 text-truncate">Invoice No</dt>
                                        <dd class="col-sm-6 text-black">
                                            <b>{{ $order->invoice_no }}</b>
                                        </dd>


                                    </dl>
                                </div>
                                <div class="col-lg-4">
                                    <h4 class="text-center text-black">Your Profit Information</h4>

                                    <dl class="row">
                                        <!--<dt class="col-sm-6">Profit (<strong class="text-black">%</strong>)</dt>-->
                                        <!--<dd class="col-sm-6 text-black">{{ $orderResellerDetails->total_percent ?: '00' }}</dd>-->

                                        <dt class="col-sm-6">Profit (<strong class="text-black">BDT</strong>)</dt>
                                        <dd class="col-sm-6 text-black">
                                            {{ $orderResellerDetails->total_amount ?: '00' }}
                                        </dd>

                                        <dt class="col-sm-6">Payment</dt>
                                        <dd class="col-sm-6 text-black">
                                            @if ($orderResellerDetails->paid == null)
                                                Unpaid

                                            @else

                                                Paid
                                            @endif
                                        </dd>




                                    </dl>
                                </div>

                            </div>
                        </div>
                        <div class="order-details">
                            <div class="row">
                                <h4 class="text-black mt-5">Product Information</h4>

                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Product_code</th>
                                            <th scope="col">Attribute</th>
                                             <th scope="col">Variant</th>

                                            <th scope="col">Qauntity</th>
                                            <th scope="col">Sub Total</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($order->orderItem as $k => $item)


                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    @foreach ($item->product->productImage as $image)
                                                        <img src="{{ asset('storage/' . $image->product_image) }}"
                                                            height="50px" width="50px">-{{ $item->product->name }}
                                                        @break
                                                    @endforeach
                                                </td>
                                                <td>{{ $item->product->product_code }}</td>



                                                <td>
                                                    @if (!empty($item->attribute))
                                                        {{ $item->attribute->name }}
                                                    @else
                                                        /
                                                    @endif


                                                </td>
                                                 <td>
                                                    @if (!empty($item->variant))
                                                        {{ $item->variant->name }}
                                                    @else
                                                        /
                                                    @endif


                                                </td>

                                                <td>{{ $item->quantity }}</td>

                                                <td>{{ $item->price * $item->quantity }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8"></div>
                            <div class="col-lg-4 calcaulation">

                                <dl class="row">
                                    <dt class="col-sm-6">Total</dt>
                                    <dd class="col-sm-96 text-black">{{ $order->total ?: 00 }}</dd>

                                    <dt class="col-sm-6">Discount</dt>
                                    <dd class="col-sm-6 text-black">
                                        {{ $order->discount ?: 00 }}
                                    </dd>

                                    <dt class="col-sm-6">Paid</dt>
                                    <dd class="col-sm-6 text-black">
                                        {{ $order->payable ?: 00 }}
                                    </dd>

                                    <dt class="col-sm-6 text-truncate">Shipping_cost</dt>
                                    <dd class="col-sm-6 text-black">

                                        @if (!empty($order->shipping_cost))
                                            @if ($order->shipping_cost == 'free-shipping')
                                                Free Shipping
                                            @else
                                                {{ $order->shipping_cost }}
                                            @endif
                                        @else
                                            @if (!empty($order->subcity))
                                                {{ $order->subcity->cost }}
                                            @endif

                                        @endif
                                    </dd>

                                    <dt class="col-sm-6 text-truncate">Grand Total</dt>
                                    <dd class="col-sm-6 text-black">

                                        {{ $order->total - $order->discount - $order->payable + $order->shipping_cost }}



                                    </dd>


                                </dl>

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
        .text-black {
            color: #000;
        }

        #_shiiping_Contact {
            display: none;
        }

    </style>

    <script>
        $("#create").on('click', function(e) {
            $("#addModal").modal('show');

        })
        $('#mobile').on('keyup', function(event) { ////get customer search
            event.preventDefault();
            let value = $("#mobile").val();
            let admin_name = "{{ session()->get('reseller')['name'] }}"
            let action = "{{ route('reseller.customer.search', ':id') }}";

            if (value.length == 11) {
                $.ajax({
                    url: action.replace(':id', value),
                    type: "GET",
                    dataType: 'json',
                    cache: false,
                    // beforeSend: function () {
                    //     $('.loading').show();
                    // },
                    success: function(resp) {
                        $('.spinner').hide();
                        if (resp.success == "OK") {


                            if (confirm(admin_name +
                                    ", This customer all ready register in mohasagor.com?  Remember  Last Order Created_at " +
                                    resp.data.created_at + " || " + resp.date)) {
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
                    error: function(e) {
                        //  console.log(e);
                        $('.loading').hide();

                    }

                });

            }


        });



        $('#product_add').on('click', function(event) { ////product find
            event.preventDefault();
            let id = $("#product_code").val();

            let action = "{{ route('product.find.reseller', ':id') }}";
            let table = $('#productTable');
            let tbdoy = table.find('tbody')
            let len = tbdoy.find('tr').length;


            $.ajax({
                url: action.replace(':id', id),
                type: "GET",
                dataType: 'json',
                cache: false,
                beforeSend: function() {
                    $('.spinner').show();
                },
                success: function(resp) {
                    $('.spinner').hide();
                    $('.error').hide();
                    if (resp.success == "OK") {
                        let option = "";
                        if (resp.size.length > 0) {
                            resp.size.forEach(function(element, idx) {

                                option += '<option value="' + element.id + '">' + element
                                    .size_title_lang1 + ' </option>';
                            })
                        }
                        tbdoy.append('<tr>' +
                            '<td>' + len + '</td>' +
                            '' +
                            '<input  class="form-control col-md-1 input-sm order_id" type="hidden" name="details_in[' +
                            (len - 1) + '][merchant_id]" value="' + resp.product.fk_merchant_id +
                            '">' +
                            '<input  class="form-control col-md-1 input-sm order_id" type="hidden" name="details_in[' +
                            (len - 1) + '][sale_price]" value="' + resp.product.sale_price + '">' +
                            '<input  class="form-control col-md-1 input-sm order_id" type="hidden" name="details_in[' +
                            (len - 1) + '][purchase_price]" value="' + resp.product.purchase_price +
                            '">' +
                            '<input  class="form-control col-md-1 input-sm order_id" type="hidden" name="details_in[' +
                            (len - 1) + '][product_id]" value="' + resp.product.id + '">' +
                            '<td>' + resp.product.product_name_lang2 + '</td>' +
                            '<td>' + resp.product.product_code + '</td>' +
                            '<td><input type="text" value="1" class="quantity" name="details_in[' +
                            (len - 1) + '][quantity]"></td>' +
                            '<td><select name="details_in[' + (len - 1) +
                            '][product_wise_size_id]">' + option + '</select></td>' +
                            '<td class="single_price">' + resp.product.sale_price + '</td>' +
                            '<td><input class="commission" type="text" ></td>' +
                            '</tr>')
                        calculatePayment();

                    }

                },
                error: function(e) {
                    console.log(e);
                    $('.error').show();
                    $('.spinner').hide();


                }

            });




        });


        $("#free_shipping").change(function() {

            if ($(this).is(':checked')) {
                if (confirm("Are you sure this is free shipping order or product.")) {
                    $("#shipping_cost").val('free-shipping');
                }
            } else {

                $("#shipping_cost").val('');

            }


        });
        $("#anaotherNumber").change(function() {

            if ($(this).is(':checked')) {

                $("#_shiiping_Contact").show();

            } else {

                $("#_shiiping_Contact").hide();

            }
        });


        $('#productTable').on('change', '.quantity', function() {

            calculatePayment();
        });

        $('.calculation').on('change', '.discount', function() {
            alert('hello')
            let previous_amount = parseFloat($(".paymentDue").text().trim() || 0)
            let discount = parseFloat($(".discount").val().trim() || 0);
            let amount = previous_amount - discount;


            $(".paymentDue").text(amount);
        });



        $('.calculation').on('change', '.paid', function() {
            alert('hello')
            let previous_amount = parseFloat($(".paymentDue").text().trim() || 0)
            let discount = parseFloat($(".paid").val().trim() || 0);
            let amount = previous_amount - discount;
            $(".paymentDue").text(amount);
        });


        $('#productTable').on('keyup', '.commission', function() {
            var $tbody = $('#productTable').find('tbody');
            var total_percant = 0;
            $tbody.find('tr').each(function(idx) {
                var percent = parseFloat($(this).find('.commission').val().trim()) || 0;
                total_percant += percent + 0;
            });
            $(".your-percent-commission").find('strong').text(parseFloat(total_percant))

            let amount = $("#total_amount").val();

            let Total_amount = parseFloat(amount) / parseFloat(100) * parseFloat(total_percant)
            $(".your-amount-commission").find('strong').text(parseFloat(Total_amount))
            $("#productTable").find('.reseller_total_percent').val(total_percant)
            $("#productTable").find('.reseller_total_amount').val(parseFloat(Total_amount))


        });






        function calculatePayment() {
            var $tbody = $('#productTable').find('tbody');
            var total_amount = 0;

            $tbody.find('tr').each(function(idx) {

                var product_price = parseFloat($(this).find('.single_price').text().trim()) || 0;
                var product_quantity = parseFloat($(this).find('.quantity').val().trim()) || 0;
                total_amount += product_price * product_quantity;

            });

            $(".paymentDue").text(parseFloat(total_amount));
            $("#total_amount").val(parseFloat(total_amount));

        };


        $('#productForm').on('submit', function(event) {
            event.preventDefault();
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let formData = new FormData($(this)[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                url: $(this).attr('action'),
                method: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.spinner').show();
                    $('#smalText').text("Saving");
                },
                //success function
                success: function(resp) {
                    console.log(resp)
                    $('.spinner').hide();


                    if (resp.success == "OK") {
                        Swal.fire({
                            type: 'success',
                            text: "Product Add successfully",
                            position: 'top-end'
                        });
                        location.reload();
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
                error: function(e) {
                    console.log(e)
                    alert("some thing want wrong");
                    $('.spinner').hide();

                }
            });
        });

    </script>

    <style>
        .order-information {
            background: #ddd;
            padding: 15px 25px;
            border: 2px solid #2A3F54;
        }

        .calcaulation {
            background: #ddd;
            padding: 10px 25px;
        }

    </style>
@endsection

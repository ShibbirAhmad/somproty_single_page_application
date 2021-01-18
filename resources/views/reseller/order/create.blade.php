<?php

$reseller = session()->get('reseller')
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
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Create order</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if(session()->has('message'))
                            <li class="bg bg-success">{{session()->get('message')}}</li>
                        @endif

                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">

                                        <input class="form-control" placeholder="Product Code" id="product_code">

                                    </div>
                                    <div class="col-lg-4">
                                        <button class="btn btn-dark" id="product_add">Add</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <form action="{{route('order.save.reseller')}}" method="post" id="productForm">
                            @csrf
                            <div class="row">


                                <div class="col-lg-3">
                                    <h5 class="text-black">Customer Information</h5>


                                    <div class="form-group">
                                        <label>Customer_mobile</label>
                                        <input type="text" maxlength="11" autocomplete="off" id="mobile" class="form-control"
                                               placeholder="Enter Mobile Number" name="customer_mobile" value="{{old('customer_mobile')}}"
                                               required>
                                        <h6 class="text-danger numberMsg">Number Must be 11 digit(<strong>0</strong>)
                                        </h6>

                                    </div>

                                 
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <input type="hidden" value="{{session()->get('reseller')['id']}}"
                                               name="reseller_id">

                                        <input type="text" id="name" class="form-control" placeholder="Enter Name"
                                               name="customer_name"
                                               value="{{ old('customer_name') }}" autocomplete="off" required>
                                    </div>


                                    <div class="form-group">
                                        <label>Customer_address</label>
                                        <textarea class="form-control" required autocomplete="off" id="shipping_address"
                                                  placeholder="Enter Customer_address"
                                                  name="customer_address">{{old('customer_address')}}</textarea>
                                    </div>

                                    {{--<div class="form-group">
                                        <label>Shipping_contact</label>
                                        <input type="text" id="shiping_contact" autocomplete="off" class="form-control" id="shipping_contact" name="shipping_contact" value="{{old('shipping_contact')}}">
                                    </div>--}}
                                    <div class="form-group">
                                        <label>Select City</label>
                                        <select class="form-control city" autocomplete="off" id="city" name="city"
                                                required>
                                            <option value="">Select City</option>
                                            @foreach(\App\Models\City::where('status',1)->get() as $city)
                                                <option class="form-control"
                                                        value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{--  <div class="form-group">
                                          <label>Upazila</label>
                                          <select class="form-control city" autocomplete="off" id="Subcity" name="subcity">
                                          </select>
                                      </div>--}}
                                    <div class="form-group">
                                        <label>Shipping_cost</label>
                                        <input type="text" class="form-control" name="shipping_cost" autocomplete="off"
                                               id="shipping_cost">
                                        <input type="checkbox" id="free_shipping"><label>Free Shipping</label>

                                    </div>
                                    <div class="form-group">
                                        <label>Courier</label>
                                        <select class="form-control city" name="courier" required>

                                            <option value="">Select Courier</option>

                                            @foreach($couriers as $courier )
                                                <option class="form-control"
                                                        value="{{$courier->id}}">{{$courier->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                     <div class="form-group">
                                        <label>Instruction/Note</label>
                                        <input type="text" class="form-control" name="note" autocomplete="off"
                                              >

                                    </div>

                                    <input type="hidden" value="0" id="total_amount" name="total_amount">

                                </div>
                                <div class="col-lg-9">
                                    <h5 class="text-black">Product Information</h5>

                                    <div class="product-section">
                                        <table id="productTable" class="table table-hover table-bordered" width="100%">
                                            <thead class="table-head bg-dark text-white">
                                            <tr>
                                                <th>#SL No</th>
                                                <th>Product Name</th>
                                                <th>Product Code</th>
                                                <th>Quantity</th>
                                                 <th>Variant </th>
                                                <th>Unit Price</th>
                                                <th>Price</th>
                                                <th>Product Commission(%)</th>
                                                <th>Your Commission(BDT)</th>
                                                <th><i class="fa fa-trash"></i></th>
                                                {{--                                    <th>Disc.</th>--}}

                                            </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                        </table>

                                        <table>
                                            <tr class="spinner" style="display: none;">
                                                <td>
                                                    <h1 class="text-center ml-5"><i
                                                                class="fa fa-spinner fa-spin"></i><small id="smalText">
                                                            Finding
                                                        </small></h1><br/>
                                                </td>
                                            </tr>
                                            <tr class="error" style="display: none;">
                                                <td><h2>Product Not Found</h2></td>
                                            </tr>
                                        </table>


                                        <div class="calculation">
                                            <br/>
                                            <br/>
                                            <br/>
                                            <br/>
                                            <div class="col-lg-4">
                                                {{--                                                    <li class="text-black your-percent-commission">Your Commission(%): <strong>00</strong></li>--}}
                                                <li class="your-amount-commission text-black">Your Commission(TK):
                                                    <strong class="reseller_total_commission">00</strong></li>

                                                <input type="hidden" name="commission" id="reseller_total_percent">
                                                <input type="hidden" name="reseller_amount_percent" id="reseller_total"
                                                       value="0">
                                            </div>
                                            <div class="col-lg-5"></div>
                                            <div class="col-lg-3 text-right">
                                                <div class="row mb-2">
                                                    <div class="col-lg-4">
                                                        <label class="text-black">Discount</label>

                                                    </div>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control discount" name="discount"
                                                               autocomplete="off" onkeyup="calculateDiscount()">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <label class="text-black">Advance Paid</label>

                                                    </div>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control paid" name="payable" onkeyup="calculateDiscount()" value="0">
                                                    </div>
                                                </div>
                                                
                                        <!--           <div class="row">-->
                                        <!--            <div class="col-lg-4">-->
                                        <!--                <label class="text-black"  style="margin-left: -27px">Paid by (Cash/bKash)</label>-->

                                        <!--            </div>-->
                                        <!--            <div class="col-lg-8">-->
                                        <!--                    <input type="text" name="paid_by" class="form-control required >        -->
                                        <!--    </div>-->
                                           
                                        <!--        </div>-->
                                                
                                    
                                            <div class="row">
                                                 <div class="col-lg-4">
                                                   <label class="text-black">Payment Due</label>

                                                 </div>
                                                 <div class="col-lg-8">
                                                     <label class="text-black paymentDue" style="font-size: 20px;">000</label>
                                                 </div>
                                            </div>
                                             <input type="hidden" name="status" value="1">
                                              <input type="hidden" name="reseller_id"
                                                     value="{{session()->get('reseller')['id']}}">


                                           </div>

                                        </div>

                                    </div>
                                    <input type="submit" style="width: 100%;" value="submit" class="btn btn-dark ">
                                </div>

                            </div>
                        </form>
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
        .xx {
        background: red;
        color: #fff;
        padding: 5px;
}

    </style>

    <script>

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
            console.log(id);

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
                    console.log(resp);
                    $('.spinner').hide();
                    $('.error').hide();
                    if (resp.success == "OK") {

                         if (resp.product.stock <= 0) {
                                return Swal.fire({
                                    type: "warning",
                                    title: "Wopps....",
                                    html: `${resp.product.name} - <strong> ${resp.product.product_code} </strong> in <b>stcok not available</b>.`,
                                });
                }
                        let option = "<option disabled selected> select variant</option>";
                        if (resp.variant.length > 0) {
                            resp.variant.forEach(function (element, idx) {

                                option += '<option value="' + element.variant_id + '">' + element.variant.name + ' </option>';
                            })
                        }
                        tbdoy.append('<tr>' +
                            '<td>' + len + '</td>' +
                            '' +
                            '<input  class="form-control col-md-1 input-sm order_id" type="hidden" name="details_in[' + (len - 1) + '][merchant_id]" value="' + resp.product.merchant_id + '">' +
                            '<input  class="form-control col-md-1 input-sm order_id" type="hidden" name="product" value="hello">' +

                            '<input  class="form-control col-md-1 input-sm order_id" type="hidden" name="details_in[' + (len - 1) + '][sale_price]" value="' + resp.product.price + '">' +
                            '<input  class="form-control col-md-1 input-sm order_id" type="hidden" name="details_in[' + (len - 1) + '][product_id]" value="' + resp.product.id + '">' +
                            '<td>' + resp.product.name + '</td>' +
                            '<td>' + resp.product.product_code + '</td>' +
                            '<td><input type="number" value="1" style="width: 60px;" id="quantity'+resp.product.id+'" class="quantity" name="details_in[' + (len - 1) + '][quantity]"></td>' +
                            '<td><select   name="details_in[' + (len - 1) + '][variant_id]">' + option + '</select></td>' +

                            '<td class="single_price" id="single_price_'+resp.product.id+'">' + resp.product.price + '</td>' +
                            '<td class="price" style="font-size:12px;color: #000; " id="price_' + resp.product.id + '">' + resp.product.price + '</td>' +
                            '<td><input style="width: 50px;" type="text" value="0" name="details_in[' + (len - 1) + '][reseller_commission_percent]" onkeyup="com(' + resp.product.id + ')" id="commission' + resp.product.id + '"></td>' +
                            '<td><input style="width: 70px;cursor: no-drop;"  readonly type="text" class="commission" value="0" onkeyup="com(' + resp.product.id + ')" id="your_commission' + resp.product.id + '"></td>' +
                             '<td onclick="removeItem(event)" class="xx"> X</td>' +
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

        function changeAttribute(id){
            alert(id)
        }

        function removeItem(event){
            console.log(event.target.parentElement)
         event.target.parentElement.remove()
           calculatePayment();
           com();
           calculateDiscount()
           
        }
    </script>

@endsection



<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Label Print</title>
</head>
<body>
<div class="btn-pr">
    <button class="btn btn-success text-center print-button" onclick="allPrint()" id="print"><i class="fa fa-print"></i></button>
</div>
<div class="container page-break">
    <div class="row justify-content-center break">
        <div class="col-lg-4  ml-5">
            <div class="header-left ml-4 text-left">
                <img class="inv_logo" src="{{ asset('frontend/image/logo.png') }}" alt="logo" width="240px">
                <p class="moha_title_inv" >Trusted Online Shopping In Bangladesh</p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="pull-right moha_add_inv" >
                <p>Office: House: 36, Road: 06, Block: A,</p>
                <p>Benarashi Polly, Section-10, Mirpur, Dhaka.</p>
                <p>E-mail: support@mohasagor.com</p>
                <p>Hot Line: 01627 444 999 / 01635 555 777</p>
                <p class="pull-right current_date" ><span style="border: 1px solid #000;padding:2px 4px 2px 4px; border-right: none;">Date: </span><span style="border: 1px solid #000;padding:2px 4px 2px 4px;"><?php echo date("d/m/Y"); ?></span></p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" style="margin-top: 6px;">
        <div class="col-lg-12">

            <table class="table table-bordered">
                <thead>
               

                <tr style="text-align: center;">
                    <th>SL No.</th>
                    <th>Customer_Name</th>
                    <th>Customer_Mobile</th>
                    <th>Address</th>
                    <th>COD</th>
                    <th>Invoice No.</th>
                    <th>Courier</th>
                </tr>
                </thead>
                <tbody>

                @foreach($orders as $k=> $order)
                    <tr style="text-align: center;">
                        <td>{{$k+1}}</td>
                        <td>
                           {{ $order->customer->name ?? "" }}
                        </td>
                        <td>
                           {{ $order->cutomer_phone }}
                        </td>
                        <td> 
                            {{ $order->city->name ?? "" }}
                        </td>
                        <td>
                           {{ ($order->total)-($order->paid+$order->discount)+$order->shipping_cost }}

                            
                        </td>
                        <td>{{$order->invoice_no}}</td>
                        <td>
                        {{ $order->courier->name ?? "" }}
                        </td>
                    </tr>
                @endforeach





                </tbody>
            </table>


        </div>
    </div>

</div>




<style>

    .pull-right.moha_add_inv p {
        line-height: .5;
    ;
    }
    .pull-right.moha_add_inv {
        text-align: right;
        margin-right: 120px !important;
        margin-top: 20px;
    }



    body {
        background: #ddd;
    }

    .print {
        background: #fff;
        padding:28px;
        display:block;
    }
    .page-break {
        page-break-after: always;
        background-color: #fff;
        padding-bottom: 50px;
        padding-top: 50px;
        margin-bottom: 20px;
        width: 70%;
    }
    .col-lg-4{
        text-align: center;
        width: 35% !important;
        margin: 0;
        padding:0;
        margin-left: 20px;
    }
    .col-lg-6{
        text-align: center;
        width: 60% !important;
        margin: 0;
        padding:0;
    }
    @media print {
        #print {
            display: none;
        }
    }
    .btn-pr{
        text-align: right;
        display: block;
        position: fixed;
        right:0;
        top: 280px;
    }
    .btn-pr button{
        height: 50px;
    }


</style>

<script>
    function allPrint() {
       window.print();
    };
  
    window.addEventListener('DOMContentLoaded', (event) => {
        window.print();
        window.localStorage();
    });

</script>

</body>
</html>
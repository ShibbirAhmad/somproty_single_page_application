
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        body{
            margin-top: 20px;
        }
        *{
            margin: 0;
            padding: 0;

        }
        .col-lg-6{
            width: 40%;
        }
    table {
        border: 1px solid #000; 
        padding: 10px 10px;
         /* background-image: url("https://i.stack.imgur.com/fNC36.png"); */

} 
td{
        border: 1px solid #000; 
        padding: 5px 5px;
        text-align: center;
    
}  
 table {
       text-align: center !important;
  }
.address{
    line-height: 0.4;
    text-align: center;
}
.logo{
   font-size: 32px;
   font-weight: bolder;

}
.p-h{
    text-align: center;
    text-transform: uppercase;
    font-weight: bold;
    font-size: 18px;
}
th{
    border: 1px solid #000;
    padding: 2px;
}
 </style>
  </head>
  <body>
   <?php

   

$total_product_qty=0;
$total_amount=$p_items->sum('total');

$total_paid=$p_items->sum('paid');

foreach ($p_items as $key => $p_item) {
        $total_product_qty+=$p_item->purchaseItems->sum('stock');

}



?>
   
    <div class="container">
        <div class="row">
             <div class="address">
                       <p class="logo">Mohasagor.com</p>     
                      <p class="address_line">
                        Office: House:02, Lane:11,Block:A, Banaroshi Polli, section-10,
                        Mirpur,Dhaka.
                      </p>
                      <p>Email: support@mohasagor.com</p>
                      <p>Hot Line: <strong> 09636 203040</strong></p>
                     
                    </div>

                    <div  class="supplier">
                        Supplier: <strong>{{$supplier->company_name ?? $supplier->name  }}</strong>
                         <br/>
                        Supplier Phone: <strong>{{$supplier->phone ?? ""  }}</strong>
                    </div>

            <div class="col-lg-6">
                <p class="p-h"> supplier purchase report</p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Invoice no</th>
                            <th>Product Qty	</th>
                            <th>Amount	</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($p_items as $k=> $p_item)

                     
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td  style="width:90px;">{{  date("d-m-Y", strtotime($p_item->purchase_date))}}</td>
                                    <td>{{ $p_item->invoice_no }}</td>
                                    <td>
                                      
                                       
                                        {{ $p_item->purchaseItems->sum('stock') }}
                                     
                                    </td>
                                    <td>{{ $p_item->total }}</td>
                                    <td>{{ $p_item->paid }}</td>
                                    <td>{{ intval($p_item->total)-intval($p_item->paid) }}</td>
                                    <td></td>

                                </tr>
                        @endforeach

                        <tr>
                            <td colspan="3"></td>
                            <td><strong> = {{ $total_product_qty }}</strong></td>
                              <td><strong> = {{ $total_amount }}</strong></td>

                            <td><strong> = {{ $total_paid }}</strong></td>
                            <td colspan="2"><strong> = {{ $total_amount- $total_paid}}</strong></td>
                         


                        </tr>
                        
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

  </body>
</html>
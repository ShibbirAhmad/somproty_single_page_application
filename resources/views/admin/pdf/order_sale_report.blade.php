<?php 
 // this is for count total quantity 
 $total_quantity=0;
    foreach ($orders as  $order) {
       foreach ($order->orderItem as $item) {
            $total_quantity += intval($item->quantity) ;
       }
    }  
      
//     //this orders item counter house
    function productItems($items){
         $s_item=0 ;
        foreach ($items as $item) {
             $s_item += intval($item->quantity);
        }
        return $s_item ;
    }


//     // this total amount counter man
    $total_amount=0;
    foreach ($orders as $order) {
        $total_amount += intval($order->total) - intval($order->discount) + intval($order->shipping_cost) ;
    }

// this is order status detector man
function orderStatus($status){
    $order_status="";
    switch ($status) { 
        case 1:
            $order_status="New" ;
            break;

            case 2:
            $order_status = "Pending";
            break;

            case 3:
            $order_status = "Approved";
            break;

            case 4:
            $order_status = "Shipment";
            break;

            case 5:
            $order_status = "Delivered";
            break;

            case 6:
            $order_status = "Cancel";
            break;

            case 7:
            $order_status = "Retrun";
            break;

        default:
            $order_status ="";
            break;
    }

    return  $order_status; 
}
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        
      * {
            margin: 0;
            padding: 0;

        }

        .address {
            margin-top: 50px;
            margin-bottom: 20px;
            line-height: 25px;
            text-align: center;
            
        }

        .logo {
            font-size: 32px;
            font-weight: bolder;

        }

        .container{ 
            position:absolute;
            width: 100%;
            height:auto;
                  
                  }
         .table_container{
             text-align: center;
             margin:5px;
           }

           th, td {
            border-bottom: 1px solid #ddd;
            padding: 2px;
            }

           th {
            height: 40px;
            width:55px;
           }

           td {
             text-align: center;
            }

           
    </style>    
</head>
<body>
     <div class="container">

        <div class="address">
            <p class="logo">Mohasagor.com</p>
            <p class="address_line">
                Office: Houes:02, Lane:11,Block:A, Banarosi Polli, section-10,
                Mirpur,Dhaka.
            </p>
            <p>Email: support@mohasagor.com</p>
            <p>Hot Line: <strong> 09636 203040</strong></p>

        </div>

          <div class="table_container">
                  <table class="table table-striped">
                    
                        <tr>
                            <th scope="col">Serial No</th>
                            <th scope="col">Customer_phone</th>
                            <th scope="col">Invoice_no</th>
                            <th scope="col">Product Quantity</th>
                            <th style="width:50px;" scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Amount</th>
                        </tr>
                      
                        <tbody>
                       
                        
                        <?php $n =1 ?>
                        @foreach ($orders as $key=> $order)
                        <tr>
                            <td> {{ $key + 1 }}  </td>
                            <td> {{ $order->cutomer_phone ? $order->cutomer_phone : "" }}  </td>
                            <td> {{ $order->invoice_no  }}   </td>
                            <td> {{  productItems($order->orderItem) }}        </td>
                            <td> {{ $order->created_at->format('d-m-Y') }}  </td>
                            <td> {{ orderStatus($order->status) }}  </td>
                            <td> {{ intval($order->total) - intval($order->discount) + intval($order->shipping_cost) }}    </td>
                         </tr>
                         
                          @if($n % 20 == 0)
                           <div  style="page-break-before:always;"></div>
                          @endif
                          <?php $n++ ?>
                        @endforeach
                        <tr>
                            <td colspan="3"></td>
                            <td style="width: 120px;">
                                Total Quantity<strong> =  {{ $total_quantity }}</strong>
                            </td>
                            <td colspan="1"></td>
                            <td style="width: 120px;">
                                Total Amount<strong> = {{ $total_amount }}</strong>
                            </td>
                        </tr>

                    </tbody>
                  </table>
         </div>
     </div>
  
   </body>
</html>
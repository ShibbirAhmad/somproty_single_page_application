

<?php 
// this is for count total quantity 
$total_stock_quantity=0;
   foreach ($stock_items as  $item) { 
      $total_stock_quantity += intval($item->insert_quantity) ;  
   }  
     
   // this total amount counter man
   $total_amount=0;
   foreach ($stock_items as $stock_item) {
       $total_amount += intval($stock_item->price) * intval($stock_item->insert_quantity) ;
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
                     height:auto ;
                 
                 }
        .table_container{
           
            text-align: center;
            margin:5px;
        }

   

          th, td {
           border-bottom: 1px solid #ddd;
           padding: 4px;
           }

          th {
           height: 40px;
           width: 25px;
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
                           <th scope="col">Proudct Name & Code </th>
                           <th scope="col"> Stock </th>
                           <th scope="col">Quantity</th>
                           <th style="width:80px;" scope="col">Date</th>
                           <th scope="col">Avarage Purchase Price</th>
                           <th scope="col">Total Purchase Price</th>
                       </tr>
           
                       <tbody>
                        <?php $sn=0 ; ?>
                       @foreach ($stock_items as $key=> $stock_item)
                       <tr >
                           <td> {{ $key + 1 }}  </td>
                           <td style="width:250px;" > {{ $stock_item->product->name ? $stock_item->product->name."-".$stock_item->product->product_code : "" }}  </td>
                           <td> {{ $stock_item->product->stock  }}   </td>
                           <td> {{ $stock_item->insert_quantity }}        </td>
                           <td> {{ $stock_item->created_at->format('d-m-Y') }}  </td>
                           <td> {{ intval($stock_item->price) }}  </td>
                           <td> {{ intval($stock_item->price) * intval($stock_item->insert_quantity) }}    </td>
                        </tr>
                        <?php $sn++ ?>
                        @if ($sn % 20 == 0)
                            <div style="page-break-before: always"></div>
                        @endif
                       @endforeach
                   
                       <tr>
                           <td colspan="3"></td>
                           <td style="width: 120px;">
                               Total Quantity<strong> =  {{ $total_stock_quantity }}</strong>
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
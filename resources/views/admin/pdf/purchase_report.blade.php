
<?php 
// this is for count total quantity 
$total_insert_quantity=0;
   foreach ($purchases as  $purchase) {
      foreach ($purchase->purchaseItems as $item) {
           $total_insert_quantity += intval($item->insert_quantity) ;
      }
   }  
     
   //this purchases item counter house
   function salte_items($items){
        $s_item=0 ;
       foreach ($items as $item) {
            $s_item += intval($item->insert_quantity);
       }
       return $s_item ;
   }


   // this total amount counter man
   $total_amount=0;
   foreach ($purchases as $purchase) {
       $total_amount += intval($purchase->total) ;
   }



?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
           padding: 3px;
           }

          th {
           height: 40px;
           width: 105px;
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
                           <th scope="col">Supplier</th>
                           <th scope="col">Invoice_no</th>
                           <th scope="col">Product Quantity</th>
                           <th scope="col">Date</th>
                           <th scope="col">Amount</th>
                       </tr>

                       <tbody>
                       <?php $n=1 ?>
                       @foreach ($purchases as $key=> $purchase)
                       <tr >
                           <td> {{ $key + 1 }}  </td>
                           <td> {{ $purchase->supplier->company_name ? $purchase->supplier->company_name : "" }}  </td>
                           <td> {{ "S-".$purchase->id  }}   </td>
                           <td> {{  salte_items($purchase->purchaseItems) }}        </td>
                           <td> {{ $purchase->created_at->format('d-m-Y') }}  </td>
                           <td> {{ intval($purchase->total) }}    </td>
                        </tr>
                        @if ( $n % 20 == 0 )
                            <div style="page-break-before:always;"> </div>
                        @endif
                        <?php $n++ ?>
                       @endforeach
                   
                       <tr>
                           <td colspan="3"></td>
                           <td style="width: 120px;">
                               Total Quantity<strong> =  {{ $total_insert_quantity }}</strong>
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
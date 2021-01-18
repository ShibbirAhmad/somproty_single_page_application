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
      .heading {
    text-align: center;
    line-height: .5;
}
body {
    padding: 20px 20px;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;

}

th, td {
 text-align: center;
  border: 1px solid #000;
}

th{
  padding: 4px;

}
td{
  font-size: 14px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
.col-lg-10{
  width: 80%;
  margin-left: 10%;
}
.month-name {
    text-align: right;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 12px;
    margin-top: 12px;
}
.sub-haeding {
   text-align: center;
    text-transform: uppercase;
    margin-top: 31px;
    line-height: .2;
    font-weight: bold;
    font-size: 13px
}
.footer {
    width: 80%;
    margin-left: 10%;
    margin-top: 25px;
}
.report-smmary {
   
    padding: 12px;
}
.report-smmary p {
    line-height: 1.5;
    font-size: 13px;
   font-weight: bold
}
.singature {
    margin-top: 50px;
}

.singature p {
    font-weight: bold;
    text-transform: uppercase;
    border-top: 2px solid #000;
    width: 150px;
    text-align: center;
}

    </style>
  
  </head>
  <body>

    <h4 id="abc" style="display: none;">  <?php
      $i=0;    
    ?></h4>
    
    <div class="main">
      <div class="heading">
        <div class="logo">
            <h2><img src="{{ asset('logo.png') }}" alt="">
</h2>
<p style="margin-top:-10px;">Office: House:02, Lane:11, Benaroshi Polli,,Mirpur-10,Dhaka-1216. 
</p>
<p>Email: support@mohasagor.com</p>
<p>Hot Line: <strong>09636 203040</strong></p>
        </div>
      </div>

      <div class="sub-haeding">
        <p style="    font-size: 18px;
    ">stock report</p>
        {{-- <p>this report based on website category</p> --}}
      </div>
      
      <div class="month">
           <div class="row">
             <div class="col-lg-10">
             <table>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Product Name</th>
                 <th>Stock Quantity</th>

                </tr>
              </thead>

              <tbody>

                <?php
                        $i=0;
                        $total=0;
                    ?>
               
             @foreach ($sub_categories as $k=> $item)

             @if($item->products->sum('stock')>0)
             <tr>
                 <td>{{ $i+1 }}</td>
                 <td>{{ $item->name }}</td>
                 <td>{{ $item->products->sum('stock') }}</td>
                <?php
                    $i++;
                    $total+=$item->products->sum('stock');
                ?>
             </tr>
             @endif
             
                 
             @endforeach

             <tr>
                 <td colspan="2"></td>
                 <td><strong>
                      =  {{number_format($total ) }}     
                </strong></td>
             </tr>
            </tbody>
             
            </table>
             </div>
           </div>
                  
      </div>
   
   
        </div>
         </div>
       </div>
      <div class="footer">
       <div class="row">
         <div class="col-lg-4">
            <div class="report-smmary">
            <h4 class="text-uppercase" style="
    padding: 2px">Report Summary</h4>
            <dl class="row" style="margin-bottom: 0;line-height:.5;">
  <dt class="col-sm-6 text-uppercase"><p>Total Stock Quantity</p></dt>
  <dd class="col-sm-6"><p> {{number_format($total ) }}  </p></dd>
  

 
</dl>
  

   <dl class="row" style="margin-bottom: 0;line-height:.5;margin-top:-20px;">
  <dt class="col-sm-6 text-uppercase"><p>Report Time</p></dt>
  <dd class="col-sm-6"><p>{{\Carbon\Carbon::now()}}</p></dd>
  

 
</dl>
        </div>
         </div>
       </div>
       <div class="row">
         <div class="singature">
           <p>Authorized</p>
         </div>
       </div>
      </div>
      </div>
    </div>
   

  </body>
</html>
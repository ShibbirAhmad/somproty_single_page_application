<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php

    $setting=App\Models\GeneralSetting::first();
   

    ?>
    <title>{{ $setting->title }}</title>
    <style>
              .email_box{
                 
                 width: 100%;
                 min-height: 500px;
                
              }
             .box_left{
                  width: 20%;
                  
              }

            .box_right{
                  width: 20%;
              }

              .box_center{
                  margin:0 auto ;
                  width: 80% ;
                  min-height: 300px;
                  background-color: #eee;
                  box-shadow: 1px 2px 1px  #ddd ;
              }


               .box_center h4 {
                    text-align:center ;
                   font-size: 24px;
                   font-style: bold;
                   color:#FF4D03;
                   padding-top: 50px;
               }
             
             
             .box_center h5 {
                   text-align:center ;
                   font-size: 20px;
                   font-style: bold;
                   color:#FF4D03;
                   padding-top: 20px;
               }


         


              
    </style>
</head>
<body>
   
       <div class="email_box">
                 <div class="box_left"></div>
                 <div class="box_center">

                     <h4> {{ $setting->title }}</h4>

                       <h5>
                         your password reset code is <span style="color:#000">  {!! $token !!}</span>
                       </h5>
                
               </div>
                 <div class="box_right"></div>
        </div>    
       

</body>
</html>
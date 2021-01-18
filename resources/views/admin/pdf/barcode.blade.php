<html>

<head>

    <title>
        Print
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
    </style>

</head>




<body>
    <div class="page" style="text-align:center;margin-top:5.5%;margin-left:4.5%;">
      @for ($i = 1; $i <= $howmany; $i++)
      <div style="text-align:center;width:23%;display:inline-block;height:6%;padding:0;margin:0;">
          {!! $product_barcode->barcode !!}
         <b style="float: left;
         margin-left: 25px;
        letter-spacing: 10px"> {{ $product_barcode->barcode_number }}</b>
         </div>
      @endfor
    </div>
</body>

<script type="text/javascript">
    window.addEventListener('DOMContentLoaded', (event) => {
      window.print();
});
</script>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="/frontend/image/favicon.png" rel="icon" />

    <title>Mohasagor.com</title>
    @include('admin.partials.css')
</head>
<style>
    .is-invalid {
        border: 1px solid red;
    }

    .invalid-feedback {
        color: red;
    }
    .swal2-popup{
        width: 24em!important;
        font-size: 1.2em !important;
    }
    .swal2-styled.swal2-confirm {

        font-size: 1.0625em;
    }
    .small-image{
        width: 50px;
        border: 1px solid #000;
    }
    .skin-blue .sidebar-menu .treeview-menu>li>router-link {
        color: #8aa4af;
    }
    .router-link-active{
        color: #fff !important;
    }
    .text-danger{
        color: red !important;
    }
    span.badge-danger {
        background: red;
    }
    span.badge-success {
        background: green;
    }
    span.badge-warning {
        background: #f39c12;
        color: #000 !important;
    }
    span.badge-primary {
        background: #3c8dbc;
    }
    .table td {
        border: 1px solid #ddd;

    }
    .table th {
        background-color: #ddd;

    }
    .login{
        display: none; !important;
    }
    .table-image{
        width: 100px;height: 95px
    }
    .barcode{
        margin-bottom: 0px;
    }
    .barcode-number{
        margin-left: 40px;
    }
    .two-percent{
        width: 2% !important;
    }
    .three-percent{
        width: 3% !important;
    }
    .action-btn {
    width: 70px !important;
    margin-bottom: 2px !important;
}
li.dropdown a {
    color: #fff !important;
}
li.dropdown a:hover {
    color: #000 !important;
}
.invoice-header{
    text-align: left;
    display: none;
}
.invoice-header .address {
    margin-top: 6px;
    text-align: right;
    position: absolute;
    right: 50px;

}
.invoice-header .address p {
    margin: 0 0px;
    font-weight: bolder;

}
.invoice-body{
    margin-bottom: 30px;
}
.invoice-body p{
    margin: 0 0px;
}
.toasted.toasted-primary.success {
    width: 400px;
    height: 55px;
    font-size: 18px;
}


.toasted.toasted-primary.error {
    width: 400px;
    height: 55px;
    font-size: 18px;
    font-weight: bolder;
}
.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred{
    height: 200px !important;
}
.permisson-denied {
        text-align: center;
    
}

.permisson-denied img {
    border: 5px solid red;
    border-radius: 9px;
}
.content-wrapper{
    min-height: 100vh !important;
}
html {
  scroll-behavior: smooth;
}




    /*.table tr:nth-child(even){background-color: #f2f2f2;}*/

    /*.table tr:hover {background-color: #ddd;}*/

</style>
<body class="hold-transition skin-blue sidebar-mini">
<div id="app" class="wrapper">
    @if(session()->has('admin'))
        @include('admin.partials.sidebar')
   @endif
    <router-view></router-view> 
    <vue-progress-bar></vue-progress-bar>
    
</div>
 @if(session()->has('admin'))
    @include('admin.partials.footer')
@endif
@include('admin.partials.js')

<script src="{{'/js/app.js'}}" type="text/javascript"></script>

<script>
  

 //set some global js variable 
window.Permissions=[];

@if(session()->has('admin'))
window.Permissions =   {!! json_encode(App\Models\Admin::adminPermission(), true) !!};
@endif

 
</script>

</body>
</html>

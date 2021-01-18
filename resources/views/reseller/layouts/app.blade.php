<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{asset('backend/images/favicon.ico')}}" type="image/ico" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title')</title>
<!--
========================================================
//=============ALL CSS LINKING || INCLUDING===========//
========================================================
-->
@include('reseller.partials.css')

</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('reseller.partials.sidebar')
            @include('reseller.partials.navbar')
            @yield('content')
            @include('reseller.partials.footer')
        </div>
    </div>
<!--
========================================================
//============ALL JS LINKING || INCLUDING=============//
========================================================
 -->
@include('reseller.partials.js')

</body>
</html>

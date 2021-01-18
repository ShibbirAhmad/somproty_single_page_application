<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Mohasagor Reseller - Index</title>


    <!-- Favicons -->
        <link rel="icon" type="image/png" sizes="32x32" href="https://mohasagor.com/frontend/assets/img/mohasagor.png">
        <link rel="icon" type="image/png" sizes="32x32" href="https://mohasagor.com/frontend/assets/img/mohasagor.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('reseller/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('reseller.assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
    <link href="{{asset('reseller/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('reseller/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('reseller/assets/vendor/venobox/venobox.css')}}" rel="stylesheet">
    <link href="{{asset('reseller/assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('reseller/assets/vendor/aos/aos.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: Arsha - v2.1.0
    * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto"><a href="{{route('home.reseller')}}" class="site_title"><img src="https://mohasagor.com/icons/logo.png" style="height: 50px;width: 150px;margin-top: -14px;margin-left: 20px;"></a>
</h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="#about">About</a></li>

                <li><a href="{{route('reseller.login')}}">Login</a></li>
                <li><a href="#contact">Terms</a></li>

            </ul>
        </nav><!-- .nav-menu -->

        <a href="{{route('reseller.register')}}" class="get-started-btn scrollto">Get Started</a>

    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                <h1>Are you prepared to start business without investment?</h1>
                <h2>Start business with us of with out any kind of investment.</h2>
                <div class="d-lg-flex">
                    <a href="#about" class="btn-get-started scrollto">Get Started</a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                <img src="{{asset('reseller/assets/img/hero-img.png')}}" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>

</section><!-- End Hero -->

<main id="main">

    <!-- ======= Cliens Section ======= -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>About Us</h2>
            </div>

            <div class="row content justify-content-center">
                <div class="col-lg-8">
                    <p>
                        Mohasagor.com is a complete e-commerce website in Bengali and English. Here, consumers of all ages can buy every essential product of the day, from gadgets, electronics, home appliances, leather goods, jewelry, baby accessories, cosmetics, fashion and lifestyle products to affordable prices at home.
                    </p>

                </div>
            </div>

        </div>
    </section><!-- End About Us Section -->


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Terms</h2>
                <li>You can do business from anywhere as well as any profession</li>
                <li>We will give details including pictures and prices of our own products.</li>
                <li>You can sell the products of your choice by posting and boosting on the Facebook page or different groups.</li>
                <li>In case of the order outside Dhaka, at least 100 rupees have to be taken in advance. That money will be with you.</li>
                <li>If the order is confirmed, the condition name including the customer's name, address, mobile number, product code, and size will be included in this ID.</li>
                <li>More . coming....</li>
            </div>


        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">



    <div class="container footer-bottom clearfix">
        <div class="copyright">
            &copy; Mohasasagor Limited. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
            Designed by <a href="https://bootstrapmade.com/">Mohasasagor Limited</a>
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
<div id="preloader"></div>

<script src="{{asset('reseller/assets/vendor/jquery/jquery.min.js')}}"></script>

<script src="{{asset('reseller/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('reseller/assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('reseller/assets/vendor/php-email-form/validate.js')}}"></script>
<script src ={{asset('reseller/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}></script>
<script src ={{asset('reseller/assets/vendor/waypoints/jquery.waypoints.min.js')}}></script>
{{--<script src="{{asset('reseller/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>--}}
{{--<script src="{{asset('reseller/assets/vendor/waypoints/jquery.waypoints.min.js)}}"></script>--}}
<script src="{{asset('reseller/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('reseller/assets/vendor/venobox/venobox.min.js')}}"></script>
<script src="{{asset('reseller/assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('reseller/assets/vendor/aos/aos.js')}}"></script>
<script src="{{asset('reseller/assets/js/main.js')}}"></script>




</body>

</html>

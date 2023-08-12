@php
$config = App\Http\Controllers\adminController::getConfigWeb();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Icon -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/line-icons.css') }}">
    <!-- Slicknav -->
    <link rel="stylesheet" href="{{ asset('assets/css/slicknav.css') }}">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nivo-lightbox.css') }}">
    <!-- Animate -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <!-- Responsive Style -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <script src="https://kit.fontawesome.com/1d954ea888.js"></script>
    <script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=6290c9ff50a887001a78dd03&product=inline-share-buttons"
        async="async"></script>
    <meta name="description" content="@yield('meta')">
    <meta name="author" content="Ade Hafis Rabbani">
    <link rel="icon" type="image/png" href="@yield('icon')" />
    <link rel="icon" type="image/jpg" href="@yield('icon')" />
    <link rel="icon" type="image/jpeg" href="@yield('icon')" />
</head>

<body>

    <!-- Header Area wrapper Starts -->
    <header id="header-wrap">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a href="/" class="navbar-brand"><img src="{{ asset('/storage/config/logo/'.$config->logo) }}"
                        class="my-2" style="width: 35px;height:auto"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="lni-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto w-100 justify-content-end clearfix">
                        <li class="nav-item {{ (Request::path() == '/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('clients.home') }}">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (Str::startsWith(Request::path(),'lowongan')) ? 'active' : '' }}"
                                href="{{ route('clients.loker') }}">
                                Lowongan Kerja
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (Str::startsWith(Request::path(),'patner')) ? 'active' : '' }}"
                                href="{{ route('clients.patner') }}">
                                Kemitraan DU/DI
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (Str::startsWith(Request::path(),'blog')) ? 'active' : '' }}"
                                href="{{ route('blog') }}">
                                Blog
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->

        @yield('content')



        <div class="copyright">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-3 col-xs-12">
                        <div class="footer-logo">
                            {{-- <img src="assets/img/logo.png" alt=""> --}}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div class="social-icon text-center">
                            <a class="facebook" href="#"><i class="lni-facebook-filled"></i></a>
                            <a class="twitter" href="#"><i class="lni-twitter-filled"></i></a>
                            <a class="instagram" href="#"><i class="lni-instagram-filled"></i></a>
                            <a class="linkedin" href="#"><i class="lni-linkedin-filled"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-xs-12">
                        <p class="text-center"><span>BKK SMKN 1 Cerme | Developed By Hafis Rabbani<a
                                    style="color: #3d60f4" href="http://hafisrabbani.tech"></a></span></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright Section End -->

        <!-- Go to Top Link -->
        <a href="#" class="back-to-top">
            <i class="lni-arrow-up"></i>
        </a>

        <!-- Preloader -->
        <div id="preloader">
            <div class="loader" id="loader-1"></div>
        </div>
        <!-- End Preloader -->

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('assets/js/jquery-min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.mixitup.js') }}"></script>
        <script src="{{ asset('assets/js/wow.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.nav.js') }}"></script>
        <script src="{{ asset('assets/js/scrolling-nav.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('assets/js/nivo-lightbox.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slicknav.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script src="{{ asset('assets/js/form-validator.min.js') }}"></script>
        <script src="{{ asset('assets/js/contact-form-script.min.js') }}"></script>

</body>

</html>

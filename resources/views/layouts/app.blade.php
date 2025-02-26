<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Eoorox - Gaming and eSports HTML Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="stylesheet" href="/css/magnific-popup.css">
    <link rel="stylesheet" href="/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/font-flaticon/flaticon.css">
    <link rel="stylesheet" href="/css/dripicons.css">
    <link rel="stylesheet" href="/css/slick.css">
    <link rel="stylesheet" href="/css/meanmenu.css">
    <link rel="stylesheet" href="/css/default.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/responsive.css">
</head>
<body>
<!-- header -->
<header class="header-area header-three">

    <div id="header-sticky" class="menu-area">
        <div class="container-fluid pl-50 pr-50">
            <div class="second-menu">
                <div class="row align-items-center">
                    <div class="col-xl-1 col-lg-1">
                        <div class="logo">
                            <a href="index.html"><img src="img/logo/logo.png" alt="logo"></a>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2">

                    </div>
                    <div class="col-xl-6 col-lg-6">

                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul>
                                    <li class="has-sub">
                                        <a href="index.html">Играть</a>
                                        <ul>
                                            <li><a href="index.html">Микс</a></li>
                                            <li><a href="index-2.html">Битва кланов</a></li>
                                            <li><a href="index-3.html">Турниры</a></li>

                                        </ul>
                                    </li>
                                    <li><a href="about.html">Рейтинг кланов</a></li>
                                    <li><a href="blog.html">Турниры</a></li>
                                    <li><a href="{{route('profile.index')}}">Профиль</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 text-left d-none d-lg-block mt-30 mb-30">
                        <div class="cart-top">
                            <ul>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#" class="menu-tigger"><i class="fas fa-search"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-1 text-right d-none d-lg-block mt-30 mb-30">
                        <a href="#" class="menu-tigger"><img src="img/bg/toggle-menu.png" alt="logo"></a>
                    </div>


                    <div class="col-12">
                        <div class="mobile-menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-end -->
<!-- offcanvas-area -->
<div class="offcanvas-menu">
    <span class="menu-close"><i class="fas fa-times"></i></span>
    <form role="search" method="get" id="searchform"   class="searchform" action="http://wordpress.zcube.in/xconsulta/">
        <input type="text" name="s" id="search" value="" placeholder="Search"  />
        <button><i class="fa fa-search"></i></button>
    </form>


    <div id="cssmenu3" class="menu-one-page-menu-container">
        <ul id="menu-one-page-menu-2" class="menu">
            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="index.html">Home</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="about.html">About Us</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="services.html">Services</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="pricing.html">Pricing </a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="team.html">Team </a></li>

            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="projects.html">Gallery Study</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="blog.html">Blog</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="contact.html">Contact</a></li>
        </ul>
    </div>

    <div id="cssmenu2" class="menu-one-page-menu-container">
        <ul id="menu-one-page-menu-1" class="menu">
            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="#home"><span>+8 12 3456897</span></a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="#howitwork"><span>info@example.com</span></a></li>
        </ul>
    </div>
</div>
<div class="offcanvas-overly"></div>
<!-- offcanvas-end -->

<!-- main-area -->
<main>

    <!-- search-popup -->
    <div class="modal fade bs-example-modal-lg search-bg popup1" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content search-popup">
                <div class="text-center">
                    <a href="#" class="close2" data-dismiss="modal" aria-label="Close">× close</a>
                </div>
                <div class="row search-outer">
                    <div class="col-md-11"><input type="text" placeholder="Search for products..." /></div>
                    <div class="col-md-1 text-right"><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /search-popup -->

    @yield('content')

</main>
<!-- main-area-end -->
<!-- footer -->
<footer class="footer-bg footer-p" style="background: #1e191f;">
    <div class="footer-top pt-70">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-xl-4 col-lg-4 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="f-widget-title mb-20">
                            <img src="img/logo/f_logo.png" alt="img">
                        </div>
                        <div class="footer-link">
                            Ощути конкурентную игру во всей ее красе, поднимаясь по рейтингу. Принимай участие в ранговых матчах, сбалансированных на основе навыков. Попробуй командные лиги, клубы и многое другое!
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="f-widget-title">
                            <h2>Навигация</h2>
                        </div>
                        <div class="footer-link">
                            <ul>
                                <li><a href="/">Главная</a></li>
                                <li><a href="{{route('about')}}">О нас</a></li>
                                <li><a href="{{route('index')}}">Играть </a></li>
                                <li><a href="{{route('contact')}}">Контакты</a></li>
                                <li><a href="{{route('blog')}}">Лента</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="f-widget-title">
                            <h2>Помощь</h2>
                        </div>
                        <div class="footer-link">
                            <ul>
                                <li><a href="{{route('faq')}}">FAQ</a></li>
                                <li><a href="#">Поддержка</a></li>
                                <li><a href="#">Политика конфиденциальности</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="f-widget-title">
                            <h2>Мы в соцсетях</h2>
                        </div>
                        <div class="footer-social  mt-30">
                            <a href="#"><i class="fab fa-vk"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-telegram"></i></a>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    Copyright © {{date('Y')}} Все права защищены.
                </div>
                <div class="col-lg-6 text-right text-xl-right">

                </div>

            </div>
        </div>
    </div>
</footer>
<!-- footer-end -->


<!-- JS here -->
<script src="/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="/js/vendor/jquery-3.6.0.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/slick.min.js"></script>
<script src="/js/ajax-form.js"></script>
<script src="/js/paroller.js"></script>
<script src="/js/wow.min.js"></script>
<script src="/js/js_isotope.pkgd.min.js"></script>
<script src="/js/imagesloaded.min.js"></script>
<script src="/js/parallax.min.js"></script>
<script src="/js/jquery.waypoints.min.js"></script>
<script src="/js/jquery.counterup.min.js"></script>
<script src="/js/jquery.scrollUp.min.js"></script>
<script src="/js/jquery.meanmenu.min.js"></script>
<script src="/js/parallax-scroll.js"></script>
<script src="/js/jquery.magnific-popup.min.js"></script>
<script src="/js/element-in-view.js"></script>
<script src="/js/main.js"></script>
</body>
</html>

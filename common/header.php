<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Vinaika Template" />
    <meta name="keywords" content="Vinaika, unica, creative, html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="psq8olwBXSDwtv5FuFNL7aXE5g8QXzX9kOx6haHA" />
    <title>Vinaika Jaipur</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,700&amp;display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo SITE_URL ?>fonts/icomoon/style.css" />
    <!-- Css Styles -->
    <link href="<?php echo SITE_URL; ?>dist/lib/animate/animate.min.html" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>dist/html/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>dist/html/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>dist/html/css/elegant-icons.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>dist/html/css/magnific-popup.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>dist/html/css/nice-select.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>dist/html/css/owl.carousel.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>dist/html/css/slicknav.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>dist/html/css/style.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>dist/html/lib/perfect-scrollbar/perfect-scrollbar.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>dist/html/css/custom.css" type="text/css" />

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <a id="button"></a>

    <div id="myModalsubscribe" class="modal fade subscribe">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close2" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <div class="modal-body">
                    <div class="row m-0">
                        <div class="col-md-6 p-0 position-relative">
                            <div class="newslettermodal-img">
                                <img onerror="" src="<?php echo SITE_URL ?>img/popup-img.jpg" alt="" title="" class="img-fluid" />
                            </div>
                        </div>
                        <div class="col-md-6 p-0">
                            <div class="newslettermodal-content">
                                <div class="text-center">
                                    <img onerror="" src="<?php echo SITE_URL ?>img/logo.png" alt="" title="" />
                                </div>
                                <h4 class="modal-title">Sign up our newsletter</h4>
                                <p>
                                    Enter Your email address to sign up to receive our latest
                                    news and offers
                                </p>
                                <form action="https://vinaikajaipur.com/" method="post" id="homeForm" onSubmit="return ajaxmailhome();"
                                    class="newslettermodal-content-form">
                                    <div class="form-group">
                                        <input type="email" name="homemail" id="homemail" class="form-control"
                                            placeholder="Enter Your e-mail address" />
                                    </div>
                                    <button type="button" class="btn-product btn--animated w-100" onClick="return ajaxmailhome();">
                                        Subscribe
                                    </button>
                                </form>
                                <ul>
                                    <li>
                                        <a href="#" class="icoRss" title=""><i class="fa fa-rss"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="icoFacebook" title=""><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="icoTwitter" title=""><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="icoGoogle" title=""><i class="fa fa-google-plus"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="icoLinkedin" title=""><i class="fa fa-linkedin"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-wrap">
        <header class="site-navbar" role="banner">
            <div class="header__top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <div class="header__top__left">
                                <p>
                                    <marquee width="100%" direction="left" scrollamount="3" height="20px">
                                        Get up to 60% Off | Addl. 10% Off on your first purchase,
                                        min order ₹999; Use Code: JKNEW10 | Addl. 10% on prepaid
                                        orders | Free shipping on orders above ₹599
                                    </marquee>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5">
                            <div class="header__top__right">
                                <div class="header__top__links">
                                    <a href="login.html" class="">Sign in</a>
                                </div>
                                <div class="header__top__currency">
                                    <select>
                                        <option value="">₹ INR</option>
                                        <option value="">$ USD</option>
                                        <option value="">$ SGD</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-navbar-top">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-4 col-md-4 order-2 order-md-1 site-search-icon text-left">
                            <div class="site-logo">
                                <a href="index.html" class=""><img onerror="" src="<?php echo SITE_URL ?>img/logo.jpg" style="height: 100px"
                                        alt="Vinaika" /></a>
                            </div>
                        </div>

                        <div class="col-8 col-md-8 order-3 order-md-3 text-right">
                            <div class="site-top-icons">
                                <ul>
                                    <!-- <li><a href="#"><span class="icon icon-person"></span></a></li> -->
                                    <li>
                                        <a href="javascript:void(0)" class="search-icon">
                                            <span class="icon -search"><i class="fa-solid fa-magnifying-glass"></i></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="wishlist.html"><span class="icon icon-heart-o"></span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="site-cart js-show-cart">
                                            <span class="icon icon-shopping_cart"></span>
                                            <span class="count">0</span>
                                        </a>
                                    </li>
                                    <li class="d-inline-block d-md-none ml-md-0">
                                        <a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="search-wrapper">
                        <div class="container">
                            <div class="search_flex">
                                <form action="#" class="site-block-top-search">
                                    <span class="icon icon-search2"></span>
                                    <input type="text" class="form-control border-0" placeholder="Search" />
                                </form>
                                <a href="javascript:void(0);" class="search-cancel"><span class="icon icon-cancel"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="site-navigation text-right text-md-center sticky-top" role="navigation">
                <div class="container">
                    <ul class="site-menu js-clone-nav d-none d-md-block">
                        <li><a href="category/new-arrivals.html">New Arrivals</a></li>
                        <li><a href="#">VJ Woman</a></li>
                        <li><a href="#">Jewellery</a></li>
                        <li><a href="#">Plus Size</a></li>
                        <li><a href="#">Deals of the Day</a></li>
                        <li><a href="#">Exhibitions</a></li>
                        <li><a href="new-contact.html">Contact</a></li>
                    </ul>
                </div>
            </nav>
        </header>
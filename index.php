<?php include('config.php');

if (!isset($_SESSION['user']) && empty($_SESSION['user'])) {
    header('Location: login.php');
}

$slider = "SELECT * FROM banner";
$sliderData = mysqli_query($conn, $slider);

$category = "SELECT * FROM category WHERE showonhome = 'on'";
$categoryData = mysqli_query($conn, $category);

$subcat = "SELECT * FROM subcategory WHERE 1";
$subcatData = mysqli_query($conn, $subcat);
include('../ecommerce/common/header.php'); ?>


<!-- <button><a href="logout.php">logout</a></button> -->
<div class="content">
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <?php while ($row = mysqli_fetch_assoc($sliderData)) {  ?>
                
                <div class="hero__items set-bg" data-setbg="<?php echo UPLOAD_PATH . $row['image']; ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-7 col-md-8">
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </section>
    &nbsp;
    <section class="section section-cat pt-0 animTop shop-by-category">
        <div class="container">
            <div class="heading-box wow fadeInUp" data-wow-delay="0.1s">
                <?php
                $category = mysqli_fetch_assoc($categoryData);
                
                ?>
                <h3><?php echo $category['category_name']; ?></h3>
                <p><?php echo $category['description']; ?></p>
            </div>

            <div class="row justify-content-center">
                <?php
                while ($row = mysqli_fetch_assoc($subcatData)) {

                    if ($row['category_id'] == $category['id']) {

                ?>
                        <div class="col-12 col-lg-4">
                            <div class="catBox">
                                <div class="imgBox">
                                    <img src="<?php echo UPLOAD_PATH . $row['image']; ?>" alt="" />
                                </div>
                                <h3><a style="color: #fff" href="product.php"><?php echo $row['subcategory_name']; ?></a></h3>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- <div class="col-xs-12 col-md-4 mb-4 mb-md-0 col-lg-4 catList">
                    <a href="category/kurta.html" class="catBox">
                        <div class="imgBox">
                            <img src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg" alt="" />
                        </div>
                        <h3>Kurta</h3>
                    </a>
                </div> -->
    <!-- <div class="col-xs-12 col-md-4 mb-4 mb-md-0 col-lg-4 catList">
                    <a href="category/kurta.html" class="catBox">
                        <div class="imgBox">
                            <img src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg" alt="" />
                        </div>
                        <h3>Kurta</h3>
                    </a>
                </div>
                <div class="col-xs-12 col-md-4 col-lg-4 catList">
                    <a href="category/kurta.html" class="catBox">
                        <div class="imgBox">
                            <img src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg" alt="" />
                        </div>
                        <h3>Kurta</h3>
                    </a>
                </div> -->


    <section class="product spad">
        <div class="container">
            <div class="heading-box wow fadeInUp" data-wow-delay="0.1s">
                <h3>See What’s Trending</h3>
                <p>A beautiful rendition of modern pieces to elevate your look</p>
            </div>
            <div class="product__filter">
                <div class="mix new-arrivals">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="product__item wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product__item__pic set-bg">
                                        <a class="pro-img" href="">
                                            <img onerror="" src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg" alt="" />
                                        </a>
                                        <span class="label">New</span>
                                        <ul class="product__hover">
                                            <li>
                                                <a href="#"><img onerror="" src="<?php echo SITE_URL ?>img/icon/heart.png" alt="" /><span>Wishlist</span></a>
                                            </li>
                                            <li>
                                                <a class="add-cart" href="#"><img onerror="" src="<?php echo SITE_URL ?>img/icon/cart.png" alt="" />
                                                    <span>Cart</span></a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="product__item__text">
                                        <a href="Vinaika-women-white-printed-sf-shrug-with-kurta.html">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="product__item wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product__item__pic set-bg">
                                        <a class="pro-img" href="">
                                            <img onerror="" src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg" alt="" />
                                        </a>
                                        <span class="label">New</span>
                                        <ul class="product__hover">
                                            <li>
                                                <a href="#"><img onerror="" src="<?php echo SITE_URL ?>img/icon/heart.png" alt="" /><span>Wishlist</span></a>
                                            </li>
                                            <li>
                                                <a class="add-cart" href="#"><img onerror="" src="<?php echo SITE_URL ?>img/icon/cart.png" alt="" />
                                                    <span>Cart</span></a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="product__item__text">
                                        <a href="Vinaika-women-white-printed-sf-shrug-with-kurta.html">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="product__item wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product__item__pic set-bg">
                                        <a class="pro-img" href="product/Vinaika-women-white-pink-women-shirt.html">
                                            <img onerror="" src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg" alt="" />
                                        </a>
                                        <span class="label">New</span>
                                        <ul class="product__hover">
                                            <li>
                                                <a href="#"><img onerror="" src="<?php echo SITE_URL ?>img/icon/heart.png" alt="" /><span>Wishlist</span></a>
                                            </li>
                                            <li>
                                                <a class="add-cart" href="#"><img onerror="" src="<?php echo SITE_URL ?>img/icon/cart.png" alt="" />
                                                    <span>Cart</span></a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="product__item__text">
                                        <a href="Vinaika-women-white-pink-women-shirt.html">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="product__item wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product__item__pic set-bg">
                                        <a class="pro-img" href="product/Vinaika-women-grey-printed-sf-shrug-with-kurta.html">
                                            <img onerror="" src="public/assets/images/images/women-kurtis.jpg" alt="" />
                                        </a>
                                        <span class="label">New</span>
                                        <ul class="product__hover">
                                            <li>
                                                <a href="#"><img onerror="" src="<?php echo SITE_URL ?>img/icon/heart.png" alt="" /><span>Wishlist</span></a>
                                            </li>
                                            <li>
                                                <a class="add-cart" href="#"><img onerror="" src="<?php echo SITE_URL ?>img/icon/cart.png" alt="" />
                                                    <span>Cart</span></a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="product__item__text">
                                        <a href="Vinaika-women-grey-printed-sf-shrug-with-kurta.html">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="product__item wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product__item__pic set-bg">
                                        <a class="pro-img" href="<?php echo SITE_URL ?>product/Vinaika-women-white-printed-knp-with-dupatta.html">
                                            <img onerror="" src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg" alt="" />
                                        </a>
                                        <span class="label">New</span>
                                        <ul class="product__hover">
                                            <li>
                                                <a href="#"><img onerror="" src="<?php echo SITE_URL ?>img/icon/heart.png" alt="" /><span>Wishlist</span></a>
                                            </li>
                                            <li>
                                                <a class="add-cart" href="#"><img onerror="" src="<?php echo SITE_URL ?>img/icon/cart.png" alt="" />
                                                    <span>Cart</span></a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="product__item__text">
                                        <a href="Vinaika-women-white-printed-knp-with-dupatta.html">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="product__item wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product__item__pic set-bg">
                                        <a class="pro-img" href="product/Vinaika-women-peach-floral-print-kurta-with-jacket-s.html">
                                            <img onerror="" src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg" alt="" />
                                        </a>
                                        <span class="label">New</span>
                                        <ul class="product__hover">
                                            <li>
                                                <a href="#"><img onerror="" src="<?php echo SITE_URL ?>img/icon/heart.png" alt="" /><span>Wishlist</span></a>
                                            </li>
                                            <li>
                                                <a class="add-cart" href="#"><img onerror="" src="<?php echo SITE_URL ?>img/icon/cart.png" alt="" />
                                                    <span>Cart</span></a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="product__item__text">
                                        <a href="Vinaika-women-peach-floral-print-kurta-with-jacket-s.html">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="product__item wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product__item__pic set-bg">
                                        <a class="pro-img" href="product/Vinaika-women-green-turquoise-kurta-palazzo.html">
                                            <img onerror="" src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg" alt="" />
                                        </a>
                                        <span class="label">New</span>
                                        <ul class="product__hover">
                                            <li>
                                                <a href="#"><img onerror="" src="<?php echo SITE_URL ?>img/icon/heart.png" alt="" /><span>Wishlist</span></a>
                                            </li>
                                            <li>
                                                <a class="add-cart" href="#"><img onerror="" src="<?php echo SITE_URL ?>img/icon/cart.png" alt="" />
                                                    <span>Cart</span></a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="product__item__text">
                                        <a href="Vinaika-women-green-turquoise-kurta-palazzo.html">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="product__item wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product__item__pic set-bg">
                                        <a class="pro-img" href="product/Vinaika-women-grey-printed-sf-shurg-with-kurta.html">
                                            <img onerror="" src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg" alt="" />
                                        </a>
                                        <span class="label">New</span>
                                        <ul class="product__hover">
                                            <li>
                                                <a href="#"><img onerror="" src="<?php echo SITE_URL ?>img/icon/heart.png" alt="" /><span>Wishlist</span></a>
                                            </li>
                                            <li>
                                                <a class="add-cart" href="#"><img onerror="" src="<?php echo SITE_URL ?>img/icon/cart.png" alt="" />
                                                    <span>Cart</span></a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="product__item__text">
                                        <a href="Vinaika-women-grey-printed-sf-shurg-with-kurta.html">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-cat pt-0 animTop shop-jwellery">
        <div class="container">
            <div class="heading-box wow fadeInUp" data-wow-delay="0.1s">
                <h3>Jwellery</h3>
                <p>A beautiful rendition of modern pieces to elevate your look</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-12">
                    <div class="row g-0 catWrap">
                        <div class="col-xs-12 col-md-6 col-lg-6 catList">
                            <a href="category/shop-by-price.html" class="catBox">
                                <div class="imgBox">
                                    <img src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg" alt="" />
                                </div>
                                <h3>SHOP BY PRICE</h3>
                            </a>
                        </div>
                        <div class="col-xs-12 mt-4 mt-md-0 col-md-6 col-lg-6 catList">
                            <a href="category/shop-by-price.html" class="catBox">
                                <div class="imgBox">
                                    <img src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg" alt="" />
                                </div>
                                <h3>LOOSE STONES</h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="spad about-us about-us-vinaika spacing-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="about__text">
                        <h4>Welcome to vinaika Store</h4>
                        <p>
                            "Sed ut perspiciatis unde omnis iste natus error sit
                            voluptatem accusantium doloremque laudantium, totam rem
                            aperiam, eaque ipsa quae ab illo inventore veritatis et
                            quasi architecto beatae vitae dicta sunt explicabo. Nemo
                            enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                            aut fugit, sed quia consequuntur magni dolores eos qui
                            ratione voluptatem sequi nesciunt. Neque porro quisquam est,
                            qui dolorem ipsum quia dolor sit amet.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="about__img">
                        <img onerror="" src="<?php echo SITE_URL ?>img/product/about-img.jpg" alt="image" />
                        <img onerror="" class="right__img" src="<?php echo SITE_URL ?>img/product/about-img2.jpg" alt="image" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="spad about-us about-us-vinaika">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 wow fadeInUp order-2 order-md-1" data-wow-delay="0.1s">
                    <div class="about__img">
                        <img onerror="" src="<?php echo SITE_URL ?>img/product/about-img3.jpg" alt="image" />
                        <img onerror="" class="right__img" src="<?php echo SITE_URL ?>img/product/about-img4.jpg" alt="image" />
                    </div>
                </div>
                <div class="col-md-6 wow fadeInUp order-1 order-md-2" data-wow-delay="0.3s">
                    <div class="about__text">
                        <h4>Welcome to vinaika jewellery Store</h4>
                        <p>
                            "Sed ut perspiciatis unde omnis iste natus error sit
                            voluptatem accusantium doloremque laudantium, totam rem
                            aperiam, eaque ipsa quae ab illo inventore veritatis et
                            quasi architecto beatae vitae dicta sunt explicabo. Nemo
                            enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                            aut fugit, sed quia consequuntur magni dolores eos qui
                            ratione voluptatem sequi nesciunt. Neque porro quisquam est,
                            qui dolorem ipsum quia dolor sit amet.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="spad client_reviews">
        <div class="container">
            <div class="heading-box">
                <h3>REVIEWS</h3>
                <p>A beautiful rendition of modern pieces to elevate your look</p>
            </div>
            <div class="customers-testimonials owl-carousel owl-loaded owl-drag">
                <div class="item">
                    <div class="product-collection-wrap">
                        <div class="product-collection-summery">
                            <p class="testimonialText">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe voluptas voluptatem ipsa commodi quibusdam numquam pariatur.
                            </p>
                            <hr />
                            <p class="testimonialHeading">Shubham Bhowmik</p>
                            <div class="rating_star">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="product-collection-wrap">
                        <div class="product-collection-summery">
                            <p class="testimonialText">
                                NICE FABRIC AND COMFORT FEEL AFTER WEAR THE KURTI. I
                                RECOMMAND TO ALL MUST BUY MYAZA KURTIS and FABRIC.
                            </p>
                            <hr />
                            <p class="testimonialHeading">SWETA DAS</p>
                            <div class="rating_star">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="product-collection-wrap">
                        <div class="product-collection-summery">
                            <p class="testimonialText">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Provident ipsa laboriosam recusandae fugiat nesciunt nobis, tempore!
                            </p>
                            <hr />
                            <p class="testimonialHeading">Swani Rai</p>
                            <div class="rating_star">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Blog Section Begin -->
    <section class="latest spad blog-section">
        <div class="container">
            <div class="heading-box">
                <h3>news & blog</h3>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry.
                </p>
            </div>
            <div class="swiper blogSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <a href="javascript:void(0)">
                                    <img onerror="" class="blog__item__pic_blog" src="<?php echo SITE_URL ?>img/about/testimonial-pic.jpg" />
                                </a>
                                <div class="blog-description">
                                    <span><img onerror="" src="<?php echo SITE_URL ?>img/icon/calendar.png" alt="" />
                                        13-09-2022 11:53:22</span>
                                    <h5 class="text-left">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                        elit. Ullam nisi nostrum debitis,
                                    </h5>
                                    <a class="btn product__btn wow bounce" data-wow-delay="0.5s" href="new-blog/blog.html">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <a href="javascript:void(0)">
                                    <img onerror="" class="blog__item__pic_blog" src="<?php echo SITE_URL ?>img/about/testimonial-pic.jpg" />
                                </a>
                                <div class="blog-description">
                                    <span><img onerror="" src="<?php echo SITE_URL ?>img/icon/calendar.png" alt="" />
                                        13-09-2022 11:53:22</span>
                                    <h5 class="text-left">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                        elit. Ullam nisi nostrum debitis,
                                    </h5>
                                    <a class="btn product__btn wow bounce" data-wow-delay="0.5s" href="new-blog/blog.html">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <a href="javascript:void(0)">
                                    <img onerror="" class="blog__item__pic_blog" src="<?php echo SITE_URL ?>img/about/testimonial-pic.jpg" />
                                </a>
                                <div class="blog-description">
                                    <span><img onerror="" src="<?php echo SITE_URL ?>img/icon/calendar.png" alt="" />
                                        13-09-2022 11:53:22</span>
                                    <h5 class="text-left">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                        elit. Ullam nisi nostrum debitis,
                                    </h5>
                                    <a class="btn product__btn wow bounce" data-wow-delay="0.5s" href="new-blog/blog.html">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <a href="javascript:void(0)">
                                    <img onerror="" class="blog__item__pic_blog" src="<?php echo SITE_URL ?>img/about/testimonial-pic.jpg" />
                                </a>
                                <div class="blog-description">
                                    <span><img onerror="" src="<?php echo SITE_URL ?>img/icon/calendar.png" alt="" />
                                        13-09-2022 11:53:22</span>
                                    <h5 class="text-left">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                        elit. Ullam nisi nostrum debitis,
                                    </h5>
                                    <a class="btn product__btn wow bounce" data-wow-delay="0.5s" href="new-blog/blog.html">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <a href="javascript:void(0)">
                                    <img onerror="" class="blog__item__pic_blog" src="<?php echo SITE_URL ?>img/about/testimonial-pic.jpg" />
                                </a>
                                <div class="blog-description">
                                    <span><img onerror="" src="<?php echo SITE_URL ?>img/icon/calendar.png" alt="" />
                                        13-09-2022 11:53:22</span>
                                    <h5 class="text-left">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                        elit. Ullam nisi nostrum debitis,
                                    </h5>
                                    <a class="btn product__btn wow bounce" data-wow-delay="0.5s" href="new-blog/blog.html">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <a href="javascript:void(0)">
                                    <img onerror="" class="blog__item__pic_blog" src="<?php echo SITE_URL ?>img/about/testimonial-pic.jpg" />
                                </a>
                                <div class="blog-description">
                                    <span><img onerror="" src="<?php echo SITE_URL ?>img/icon/calendar.png" alt="" />
                                        13-09-2022 11:53:22</span>
                                    <h5 class="text-left">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                        elit. Ullam nisi nostrum debitis,
                                    </h5>
                                    <a class="btn product__btn wow bounce" data-wow-delay="0.5s" href="new-blog/blog.html">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <a href="javascript:void(0)">
                                    <img onerror="" class="blog__item__pic_blog" src="<?php echo SITE_URL ?>img/about/testimonial-pic.jpg" />
                                </a>
                                <div class="blog-description">
                                    <span><img onerror="" src="<?php echo SITE_URL ?>img/icon/calendar.png" alt="" />
                                        13-09-2022 11:53:22</span>
                                    <h5 class="text-left">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                        elit. Ullam nisi nostrum debitis,
                                    </h5>
                                    <a class="btn product__btn wow bounce" data-wow-delay="0.5s" href="new-blog/blog.html">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <style>
        img,
        svg {
            vertical-align: middle;
        }
    </style>

    <!-- Latest Blog Section End -->
</div>


<?php include('../ecommerce/common/footer.php') ?>
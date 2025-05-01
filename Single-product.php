<?php include 'config.php';
include 'common/header.php';


$id = $_GET['id'];

$product = $conn->query("SELECT * FROM `product` WHERE id = '" . $id . "'");
$product_result = $product->fetch_assoc();


$wishlist = $conn->query("SELECT * FROM `wishlist` WHERE product_id = '" . $id . "'");
$wishlist_items = [];

while ($row = $wishlist->fetch_assoc()) {
    $wishlist_items[] = $row['product_id'];
}

$product_attributes = $conn->query(
    "SELECT aterbute.attribute_name,product_attributes.attribute_id,product_attributes.id as product_attribute_id FROM `product_attributes`
                 INNER JOIN aterbute ON aterbute.id = product_attributes.attribute_id
                 WHERE product_id = '" . $id . "'"
);

$attributes = [];


while ($product_attributes_result = $product_attributes->fetch_assoc()) {
    $attributes[] = $product_attributes_result;
}

$product_attribute_values = $conn->query(
    "SELECT `values`.name,`values`.hex_value,product_values.* FROM `product_values`
         INNER JOIN `values` ON `values`.id = product_values.values_id
         WHERE product_values.product_id = '" . $id . "'"
);
$values = [];
while ($product_attribute_values_result = $product_attribute_values->fetch_assoc()) {
    $values[] = $product_attribute_values_result;
}
?>


<div class="content">
    <section class="breadcrumb-option">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="index.html">Home</a>
                            <a href="shop.html">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">


                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <?php include('./galleryimgs.php') ?>

                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="product__details__text">
                            <h4 class="text-left"><?php echo $product_result['description'] ?></h4>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> - 0 Reviews</span>
                                <span class="toggle-whishlist" data-product-id="<?php echo $product_result['id']; ?>">
                                    <img id="wishlist-icon-<?php echo $product_result['id']; ?>"
                                        style="width: 25px;height:25px"
                                        onclick="addtowishlist('<?php echo $product_result['id'] ?>')"
                                        src="<?php echo SITE_URL . 'img/icon/' . (in_array($product_result['id'], $wishlist_items) ? 'heartfill.png' : 'heart.png'); ?>"
                                        alt="" />
                                    <span>Wishlist</span>
                                </span>
                            </div>
                            <h3 class="text-left">₹<?php echo $product_result['product_mrp'] ?><span>₹<?php echo $product_result['price'] ?>.00</span></h3>
                            <p>
                            <p>Dummy Details</p>
                            </p>
                            <div class="product__details__option">

                                <?php
                                if (!empty($attributes)) {
                                    foreach ($attributes as $attribute) {
                                        if ($attribute['attribute_name'] == 'color') {
                                ?>
                                            <div class="product__details__option__color">
                                            <?php } else { ?>
                                                <div class="product__details__option__size">
                                                <?php } ?>
                                                <span><?php echo $attribute['attribute_name']; ?>:</span>
                                                <?php
                                                if (is_array($values) && !empty($values)) {
                                                    foreach ($values as $value) {
                                                        if ($value['attribute_id'] == $attribute['attribute_id']) {
                                                            if ($attribute['attribute_name'] != 'color') {
                                                ?>
                                                                <label class="active_size " for="" size_id="14">
                                                                    <?php echo $value['name'] ?>
                                                                    <input type="radio" id="S">
                                                                </label>

                                                            <?php } else {

                                                            ?>

                                                                <label style="background:<?php echo $value['hex_value']; ?> !important">
                                                                    <input type="radio" class="active_color" id="pc-<?php echo $value['id']; ?>" value="<?php echo $value['hex_value']; ?> " />
                                                                </label>
                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>

                                                </div>
                                                <br> <br>
                                        <?php
                                    }
                                }

                                        ?>





                                        <br>


                                            </div>


                                            <a href="indexcart.php" class="primary-btn btn-product btn--animated shake add_to_cart_btn"
                                                product_id="<?php echo $product_result['id']; ?>">Add to Cart</a>
                            </div>
                            <div class="product__details__btns__option">

                            </div>
                            <div class="product__details__last__option">
                                <div class="safe-checkout">
                                    <img src="safe-checkout.png" />
                                </div>
                                <ul style="padding-top:0px">
                                    <li><span>SKU:</span> M500</li>
                                    <li><span>Categories:</span> Plus Size</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </section>
</div>
<div class="product__details__content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="product_description_area">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home"
                                role="tab" aria-controls="home" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Specification</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                                aria-controls="review" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <p>
                            <p>Vinaika is a women&rsquo;s ethnic clothing brand that offers fashion at an
                                affordable price. MYAZA offers a range of stylish outfits, perfectly blended for
                                workwear and occasion wear. The range consists of kurtas which are perfect for
                                the modern Indian woman.Pair this kurta with contrast legging or pants and
                                flats.</p>
                            </p>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <p>Dummy Details</p>
                        </div>
                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row total_rate">
                                        <div class="col-6">
                                            <div class="box_total">
                                                <h5>Overall</h5>
                                                <h4>0</h4>
                                                <h6>(0 Reviews)</h6>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="rating_list">
                                                <h3>Based on 0 Reviews</h3>


                                                <ul class="list">
                                                    <li>
                                                        <a href="#">5 Star
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            0</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">4 Star <i class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star"></i>
                                                            0</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">3 Star <i class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star"></i>
                                                            0</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">2 Star <i class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star"></i>
                                                            0</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">1 Star <i class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star"></i>
                                                            0</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review_list">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="review_box">
                                        <h4>Add a Review</h4>
                                        <p>Your Rating:</p>
                                        <ul class="list">
                                            <li>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                            </li>
                                        </ul>
                                        <p>Outstanding</p>
                                        <form class="row contact_form"
                                            action="https://vinaikajaipur.com/product/contact_process.php"
                                            method="post" id="contactForm" novalidate="novalidate">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" placeholder="Your Full name"
                                                        onfocus="this.placeholder = ''"
                                                        onblur="this.placeholder = 'Your Full name'" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" placeholder="Email Address"
                                                        onfocus="this.placeholder = ''"
                                                        onblur="this.placeholder = 'Email Address'" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="number"
                                                        name="number" placeholder="Phone Number"
                                                        onfocus="this.placeholder = ''"
                                                        onblur="this.placeholder = 'Phone Number'" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="message" id="message"
                                                        rows="1" placeholder="Review"
                                                        onfocus="this.placeholder = ''"
                                                        onblur="this.placeholder = 'Review'"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-right">
                                                <button type="submit" value="submit"
                                                    class="primary-btn btn-product btn--animated">Submit
                                                    Now</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Shop Details Section End -->

<!-- Related Section Begin -->
<section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Related Product</h3>
            </div>
        </div>
        <div class="product__filter wow fadeInUp" data-wow-delay="0.1s">


            <div class="swiper productSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="product__item">
                            <div class="product__item__pic set-bg">
                                <a class="pro-img" href="test-product.html">
                                    <img onerror="" src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg"
                                        alt="">
                                </a>
                                <span class="label">New</span>
                                <ul class="product__hover">
                                    <li class="toggle-whishlist" data-product-id="346">
                                        <img onerror="" src="<?php echo SITE_URL ?>img/icon/heart.png"
                                            alt="" /><span>Wishlist</span>
                                    </li>
                                    <li>
                                        <a class="add-cart" href="#"><img src="<?php echo SITE_URL ?>img/icon/cart.png"
                                                alt="" />
                                            <span>Cart</span></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product__item__text d-flex flex-column">
                                <a href="javascript:void(0)">
                                    <span>Vinaika Women White Straight Printed Kurta</span>
                                </a>
                                <span>₹ 1000</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product__item">
                            <div class="product__item__pic set-bg">
                                <a class="pro-img" href="test-product.html">

                                    <img onerror="" src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg"
                                        alt="">
                                </a>
                                <span class="label">New</span>
                                <ul class="product__hover">
                                    <li class="toggle-whishlist" data-product-id="346">
                                        <img onerror="" src="<?php echo SITE_URL ?>img/icon/heart.png"
                                            alt="" /><span>Wishlist</span>
                                    </li>
                                    <li>
                                        <a class="add-cart" href="#"><img src="<?php echo SITE_URL ?>img/icon/cart.png"
                                                alt="" />
                                            <span>Cart</span></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product__item__text d-flex flex-column">
                                <a href="javascript:void(0)">
                                    <span>Vinaika Women White Straight Printed Kurta</span>
                                </a>
                                <span>₹ 1000</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product__item">
                            <div class="product__item__pic set-bg">
                                <a class="pro-img" href="test-product.html">

                                    <img onerror="" src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg"
                                        alt="">
                                </a>
                                <span class="label">New</span>
                                <ul class="product__hover">
                                    <li class="toggle-whishlist" data-product-id="346">
                                        <img onerror="" src="<?php echo SITE_URL ?>img/icon/heart.png"
                                            alt="" /><span>Wishlist</span>
                                    </li>
                                    <li>
                                        <a class="add-cart" href="#"><img src="<?php echo SITE_URL ?>img/icon/cart.png"
                                                alt="" />
                                            <span>Cart</span></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product__item__text d-flex flex-column">
                                <a href="javascript:void(0)">
                                    <span>Vinaika Women White Straight Printed Kurta</span>
                                </a>
                                <span>₹ 1000</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product__item">
                            <div class="product__item__pic set-bg">
                                <a class="pro-img" href="test-product.html">

                                    <img onerror="" src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg"
                                        alt="">
                                </a>
                                <span class="label">New</span>
                                <ul class="product__hover">
                                    <li class="toggle-whishlist" data-product-id="346">
                                        <img onerror="" src="<?php echo SITE_URL ?>img/icon/heart.png"
                                            alt="" /><span>Wishlist</span>
                                    </li>
                                    <li>
                                        <a class="add-cart" href="#"><img src="<?php echo SITE_URL ?>img/icon/cart.png"
                                                alt="" />
                                            <span>Cart</span></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product__item__text d-flex flex-column">
                                <a href="javascript:void(0)">
                                    <span>Vinaika Women White Straight Printed Kurta</span>
                                </a>
                                <span>₹ 1000</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product__item">
                            <div class="product__item__pic set-bg">
                                <a class="pro-img" href="test-product.html">

                                    <img onerror="" src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg"
                                        alt="">
                                </a>
                                <span class="label">New</span>
                                <ul class="product__hover">
                                    <li class="toggle-whishlist" data-product-id="346">
                                        <img onerror="" src="<?php echo SITE_URL ?>img/icon/heart.png"
                                            alt="" /><span>Wishlist</span>
                                    </li>
                                    <li>
                                        <a class="add-cart" href="#"><img src="<?php echo SITE_URL ?>img/icon/cart.png"
                                                alt="" />
                                            <span>Cart</span></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product__item__text d-flex flex-column">
                                <a href="javascript:void(0)">
                                    <span>Vinaika Women White Straight Printed Kurta</span>
                                </a>
                                <span>₹ 1000</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product__item">
                            <div class="product__item__pic set-bg">
                                <a class="pro-img" href="test-product.html">

                                    <img onerror="" src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg"
                                        alt="">
                                </a>
                                <span class="label">New</span>
                                <ul class="product__hover">
                                    <li class="toggle-whishlist" data-product-id="346">
                                        <img onerror="" src="<?php echo SITE_URL ?>img/icon/heart.png"
                                            alt="" /><span>Wishlist</span>
                                    </li>
                                    <li>
                                        <a class="add-cart" href="#"><img src="<?php echo SITE_URL ?>img/icon/cart.png"
                                                alt="" />
                                            <span>Cart</span></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product__item__text d-flex flex-column">
                                <a href="javascript:void(0)">
                                    <span>Vinaika Women White Straight Printed Kurta</span>
                                </a>
                                <span>₹ 1000</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product__item">
                            <div class="product__item__pic set-bg">
                                <a class="pro-img" href="test-product.html">

                                    <img onerror="" src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg"
                                        alt="">
                                </a>
                                <span class="label">New</span>
                                <ul class="product__hover">
                                    <li class="toggle-whishlist" data-product-id="346">
                                        <img onerror="" src="<?php echo SITE_URL ?>img/icon/heart.png"
                                            alt="" /><span>Wishlist</span>
                                    </li>
                                    <li>
                                        <a class="add-cart" href="#"><img src="<?php echo SITE_URL ?>img/icon/cart.png"
                                                alt="" />
                                            <span>Cart</span></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product__item__text d-flex flex-column">
                                <a href="javascript:void(0)">
                                    <span>Vinaika Women White Straight Printed Kurta</span>
                                </a>
                                <span>₹ 1000</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

        </div>
    </div>
</section>



<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here....." />
        </form>
    </div>
</div>
<!-- Search End -->

<!-- signup form popup -->
<div class="sign__popup__form">
    <div class="signin-overlay"></div>
    <div class="offcanvas-menu-wrapper2">
        <div class="offcanvas__option2">
            <div class="text-right d-flex align-items-center justify-content-sm-between">
                <h5>My Account</h5>
                <div class="js_close-btn close__icon">+</div>
            </div>

            <form id="loginform">
                <input type="hidden" name="_token" value="psq8olwBXSDwtv5FuFNL7aXE5g8QXzX9kOx6haHA">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="InputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter email" />
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="InputPassword1"
                        placeholder="Password" />
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn product__btn signin_btn">Login</button>
                <div class="mb-20 mt-10 text-center">
                    <a href="../forgot.html" class="forgot_password">Forgot Your Password?</a>
                </div>
                <div class="text-center mb-20">
                    <span>OR</span>
                </div>
                <button class="loginBtn loginBtn--facebook">
                    Login with Facebook
                </button>

                <button class="loginBtn loginBtn--google mb-20">
                    Login with Google@
                </button>
                <a href="../new-register.html" class="btn product__btn signin_btn">Sign up Now!</a>
            </form>
        </div>
    </div>
</div>
<!-- Cart popup -->
<div class="wrap-header-cart js-panel-cart">
    <div class="header-cart flex-col-l p-l-20 p-r-20">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <h5>Your Cart</h5>
            <div class="js-hide-cart close__icon">
                +
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <div class="shopping__cart__table">
                <table>
                    <tbody>
                    </tbody>
                </table>


            </div>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Total: ₹<span class="total_cart">0</span>
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="../new-cart.html" class="btn-product btn--animated size-107 m-r-8">
                        View Cart
                    </a>
                    <a href="../login.html" class="btn-product btn--animated size-107">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- <div class="cookie-bar-section">
        <img onerror="" src="../html/img/cookie.png" alt="" />
        <div class="content">
            <h3>Cookies Consent</h3>
            <p class="font-light">This website use cookies to ensure you get the best experience on our website.</p>
            <div class="cookie-buttons">
                <button class="btn-product btn--animated" id="js_understand">I understand</button>
                <a href="javascript:void(0)" class="btn-product btn--animated">Learn more</a>
            </div>
        </div>
    </div> -->

<!-- Js Plugins -->

<!-- Swiper Slider Init -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".add_to_cart_btn").click(function(e) {
            e.preventDefault();
            let product_id = $(this).attr("product_id");

            $.ajax({
                url: "cart.php",
                type: "POST",
                data: {
                    product_id: product_id,
                    quantity: 1
                },
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                }
            });
        });
    });
</script>



<?php include 'common/footer.php'; ?>


<script>
    var swiper = new Swiper(".productSwiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 10,
            },
        },
    });
</script>


<script>
    // $(document).ready(function() {
    //     $("a.grouped_elements").fancybox({
    //         'transitionIn': 'elastic',
    //         'transitionOut': 'elastic',
    //         'speedIn': 600,
    //         'speedOut': 200,
    //         'overlayShow': false
    //     });
    // });
</script>
<script>
    $(".cookie-bar-section #js_understand").on("click", function() {
        $(".cookie-bar-section").toggleClass("hide");
    });

    const unique = (list) => {
        return [...new Set(list)];
    }

    const inArray = (needle, haystack) => {
        var length = haystack.length;
        for (var i = 0; i < length; i++) {
            if (haystack[i] == needle) return true;
        }
        return false;
    }
</script>

<script>
    $('.search-icon').click(function() {
        $('.search-wrapper').toggleClass('open');
        $('body').toggleClass('search-wrapper-open');
    });
    $('.search-cancel').click(function() {
        $('.search-wrapper').removeClass('open');
        $('body').removeClass('search-wrapper-open');
    });
</script>
<script>
    // Initiate the wowjs
    new WOW().init();
</script>
<script>
    $(".js-pscroll").each(function() {
        $(this).css("position", "relative");
        $(this).css("overflow", "hidden");
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on("resize", function() {
            ps.update();
        });
    });
</script>
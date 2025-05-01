<?php include 'config.php';

include 'common/header.php';


$product_query = "SELECT * FROM product";
$product_result = mysqli_query($conn, $product_query);
$products = [];

while ($row = mysqli_fetch_assoc($product_result)) {
    $products[] = $row;
}
// dd($products);

$category_query = "SELECT * FROM category WHERE showonhome = 'on'";
$category_result = mysqli_query($conn, $category_query);
$row1 = mysqli_fetch_assoc($category_result);


foreach ($products as $product) {
    
$sub_category_query = "SELECT * FROM subcategory WHERE id = '" .$product['subcategory_id']. "'";
$sub_category_result = mysqli_query($conn, $sub_category_query);
$row2 = mysqli_fetch_assoc($sub_category_result);
}


$attr = $conn->query("SELECT * FROM attribute WHERE id = '5'");


$value_query = $conn->query("SELECT * FROM `values` WHERE attribute_id = '5'");

$value_data = [];
while ($value = mysqli_fetch_assoc($value_query)) {
    $value_data[] = $value;
}


?>



<div class="content">
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div id="sideBarFilter" class="shop__sidebar left-bar">
                        <span class="icon icon-cancel block d-lg-none" onclick="closeSidebar()"></span>
                        <div class="shop__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search..." />
                                <button type="submit">
                                    <span class="icon_search"></span>
                                </button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="filter-wrap">
                                                    <li><a href="kurta.html">Kurta(1)</a></li>
                                                    <li>
                                                        <a href="kurta.html">Kurta Pant(5)</a>
                                                    </li>
                                                    <li><a href="kurta.html">Gown(1)</a></li>
                                                    <li><a href="kurta.html">KURTIS(2)</a></li>
                                                    <li>
                                                        <a href="kurta.html">Tops &amp; Tunics(0)</a>
                                                    </li>
                                                    <li><a href="kurta.html">sale(0)</a></li>
                                                    <li>
                                                        <a href="kurta.html">new arrival(0)</a>
                                                    </li>
                                                    <li><a href="kurta.html">A-Line(0)</a></li>
                                                    <li><a href="kurta.html">Kurta(0)</a></li>
                                                    <li>
                                                        <a href="kurta.html">Tops &amp; Tunics(0)</a>
                                                    </li>
                                                    <li><a href="kurta.html">RINGS(0)</a></li>
                                                    <li><a href="kurta.html">EARINGS(0)</a></li>
                                                    <li><a href="kurta.html">NOSEPINS(0)</a></li>
                                                    <li><a href="kurta.html">NECKLACE(0)</a></li>
                                                    <li>
                                                        <a href="kurta.html">MANGALSUTRA(0)</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurta.html">KURTI PANT SET(0)</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurta.html">DUPATTA SETS(0)</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurta.html">BOTTOM WEAR(0)</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurta.html">UNSTITCHED MATERIALS(0)</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurta.html">CATALOUGE(0)</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurta.html">SHOP BY PRICE(0)</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurta.html">LOOSE STONES(0)</a>
                                                    </li>
                                                    <li><a href="kurta.html">RINGS(0)</a></li>
                                                    <li><a href="kurta.html">EARRINGS(0)</a></li>
                                                    <li>
                                                        <a href="kurta.html">NOSE PINS(0)</a>
                                                    </li>
                                                    <li><a href="kurta.html">PENDENTS(0)</a></li>
                                                    <li>
                                                        <a href="kurta.html">BRACELETS(0)</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurta.html">MANGALSUTRA(0)</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurta.html">NECKLACE SETS(0)</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurta.html">STRAIGTH KURTI(0)</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurta.html">A-LINE KURTI(0)</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurta.html">TOP/SHORT KURTIS(0)</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul class="filter-wrap">
                                                    <li>
                                                        <a href="kurta664b.html?s_price=0&amp;e_price=500">₹0.00 - ₹500.00</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurta1253.html?s_price=500&amp;e_price=1000">₹500.00 - ₹1000.00</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurta74be.html?s_price=1000&amp;e_price=1500">₹1000.00 - ₹1500.00</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurta1e23.html?s_price=1500&amp;e_price=2000">₹1500.00 - ₹2000.00</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurtac68c.html?s_price=2000&amp;e_price=2500">₹2000.00 - ₹2500.00</a>
                                                    </li>
                                                    <li>
                                                        <a href="kurta0f30.html?s_price=2500&amp;e_price=+">2500.00+</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                    </div>
                                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__size">
                                                <label for="xs" class="">
                                                    <a href="kurtaae4d.html?s_id=13" style="color: black">
                                                        XS
                                                        <input type="radio" id="xs" />
                                                    </a>
                                                </label>
                                                <label for="xs" class="">
                                                    <a href="kurta7f14.html?s_id=14" style="color: black">
                                                        S
                                                        <input type="radio" id="xs" />
                                                    </a>
                                                </label>
                                                <label for="xs" class="">
                                                    <a href="kurtabdf2.html?s_id=15" style="color: black">
                                                        M
                                                        <input type="radio" id="xs" />
                                                    </a>
                                                </label>
                                                <label for="xs" class="">
                                                    <a href="kurta560c.html?s_id=16" style="color: black">
                                                        L
                                                        <input type="radio" id="xs" />
                                                    </a>
                                                </label>
                                                <label for="xs" class="">
                                                    <a href="kurta22c3.html?s_id=17" style="color: black">
                                                        XL
                                                        <input type="radio" id="xs" />
                                                    </a>
                                                </label>
                                                <label for="xs" class="">
                                                    <a href="kurtaf635.html?s_id=18" style="color: black">
                                                        XXL
                                                        <input type="radio" id="xs" />
                                                    </a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                                    </div>
                                    <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__color">
                                                <a href="kurta2080.html?c_id=1"><label class="c-1" for="sp-1"
                                                        style="background: #ff0000 !important">
                                                    </label>
                                                </a>
                                                <a href="kurta97f3.html?c_id=3"><label class="c-1" for="sp-1"
                                                        style="background: #ffff00 !important">
                                                    </label>
                                                </a>
                                                <a href="kurta01da.html?c_id=5"><label class="c-1" for="sp-1"
                                                        style="background: #0000ff !important">
                                                    </label>
                                                </a>
                                                <a href="kurtae5e9.html?c_id=6"><label class="c-1" for="sp-1"
                                                        style="background: #fb9dc7 !important">
                                                    </label>
                                                </a>
                                                <a href="kurtacfa4.html?c_id=9"><label class="c-1" for="sp-1"
                                                        style="background: #7b7a5b !important">
                                                    </label>
                                                </a>
                                                <a href="kurta10b6.html?c_id=16"><label class="c-1" for="sp-1"
                                                        style="background: #24ae86 !important">
                                                    </label>
                                                </a>
                                                <a href="kurta3b65.html?c_id=24"><label class="c-1" for="sp-1"
                                                        style="background: #ec4e33 !important">
                                                    </label>
                                                </a>
                                                <a href="kurta19e1.html?c_id=27"><label class="c-1" for="sp-1"
                                                        style="background: #1c1f4f !important">
                                                    </label>
                                                </a>
                                                <a href="kurta2e5f.html?c_id=40"><label class="c-1" for="sp-1"
                                                        style="background: #db1fd4 !important">
                                                    </label>
                                                </a>
                                                <a href="kurtade96.html?c_id=53"><label class="c-1" for="sp-1"
                                                        style="background: #87ceeb !important">
                                                    </label>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function openSidebar() {
                        var sideabr = document.getElementById("sideBarFilter");
                        sideabr.classList.toggle("open");
                    }

                    function closeSidebar() {
                        var sideabr = document.getElementById("sideBarFilter");
                        sideabr.classList.toggle("open");
                    }
                </script>
                <div class="col-lg-9">
                    <div class="shop__sidebar__right">
                        <div class="shop__product__option">
                            <div class="row align-items-center justify-content-lg-between">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6  d-block d-lg-none">
                                    <button class="product-filter-mobile filter-toggle p-0" onclick="openSidebar()">FILTER
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="#808080c9">
                                            <path
                                                d="M3 17v2h6v-2H3zM3 5v2h10V5H3zm10 16v-2h8v-2h-8v-2h-2v6h2zM7 9v2H3v2h4v2h2V9H7zm14 4v-2H11v2h10zm-6-4h2V7h4V5h-4V3h-2v6z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <div class="shop__product__option__left">
                                        <p>Showing 2 results</p>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <div class="shop__product__option__right">
                                        <p>Sort by Price:</p>
                                        <select>
                                            <option value="asc">Low To High</option>
                                            <option value="desc">High To Low/</option>
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row product_add_row">
                            <?php foreach ($products as $row) {
                                if ($row['subcategory_id'] == $row2['id']) {



                            ?>

                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg">
                                                <a href="Single-product.php?id=<?php echo $row['id'] ?>">
                                                    <img src="<?php echo UPLOAD_PATH . $row['product_logo']; ?>" alt="" />
                                                </a>

                                                <ul class="product__hover">
                                                    <li class="toggle-whishlist" data-product-id="178">
                                                        <img onerror="" src="<?php echo SITE_URL ?>/img/icon/heart.png" alt="" /><span>Wishlist</span>
                                                    </li>
                                                    <li class="add-cart add_to_cart_btn" product_id="178">
                                                        <img onerror="" src="<?php echo SITE_URL ?>/img/icon/cart.png" alt="" />
                                                        <span>Cart</span>
                                                    </li>
                                                </ul>
                                                <div class="product__hover__details">
                                                    <a href="Single-product.php?id=<?php echo $row['id'] ?>"><span>View Details</span></a>
                                                </div>
                                            </div>

                                            <div class="product__item__text">
                                                <a title="Vinaika Women White  Straight  Printed Kurta" href="Single-product.php?id=<?php echo $row['id'] ?>">
                                                    <span><?php echo $row['description'] ?></span>
                                                </a>

                                                <span>₹<?php echo $row['price'] ?></span>

                                                <div class="product__color__select">
                                                    <?php
                                                    foreach ($value_data as $value) {
                                                    ?>
                                                        <label for="pc-1">
                                                            <a title="M" href="javascript:void(0)">
                                                                <?php echo $value['name']; ?>
                                                            </a>
                                                        </label>
                                                    <?php
                                                    }
                                                    ?>

                                                    <!-- <label for="pc-1">
                                                <a title="M" href="javascript:void(0)">M</a>
                                            </label>
                                            <label for="pc-1">
                                                <a title="L" href="javascript:void(0)">L</a>
                                            </label>
                                            <label for="pc-1">
                                                <a title="XL" href="javascript:void(0)">XL</a>
                                            </label>
                                            <label for="pc-1">
                                                <a title="XXL" href="javascript:void(0)">XXL</a>
                                            </label> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            }  ?>
                            <!-- <div class="col-lg-4 col-md-6 col-sm-6 col-12 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg">
                                        <a href="../product/Single-product.html">
                                            <img onerror="" src="<?php echo SITE_URL ?>public/assets/images/images/women-kurtis.jpg" />
                                        </a>

                                        <ul class="product__hover">
                                            <li class="toggle-whishlist" data-product-id="346">
                                                <img onerror="" src="<?php echo SITE_URL ?>img/icon/heart.png" alt="" /><span>Wishlist</span>
                                            </li>
                                            <li class="add-cart add_to_cart_btn" product_id="346">
                                                <img onerror="" src="<?php echo SITE_URL ?>img/icon/cart.png" alt="" />
                                                <span>Cart</span>
                                            </li>
                                        </ul>
                                        <div class="product__hover__details">
                                            <a href="../product/Single-product.html"><span>View Details</span></a>
                                        </div>
                                    </div>

                                    <div class="product__item__text">
                                        <a title="Vinaika Women Peach  Floral Print Kurta with Jacket-S"
                                            href="../product/Single-product.html">
                                            <span>Vinaika Women Peach Floral Print Kurta with Jacket-S</span>
                                        </a>

                                        <span>₹ 1000</span>

                                        <div class="product__color__select">
                                            <label for="pc-1">
                                                <a title="XS" href="javascript:void(0)">XS</a>
                                            </label>
                                            <label for="pc-1">
                                                <a title="S" href="javascript:void(0)">S</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg">
                                        <a href="../product/Single-product.html">
                                            <img onerror="" src="../public/assets/images/images/women-kurtis.jpg" />
                                        </a>

                                        <ul class="product__hover">
                                            <li class="toggle-whishlist" data-product-id="346">
                                                <img onerror="" src="../html/img/icon/heart.png" alt="" /><span>Wishlist</span>
                                            </li>
                                            <li class="add-cart add_to_cart_btn" product_id="346">
                                                <img onerror="" src="../html/img/icon/cart.png" alt="" />
                                                <span>Cart</span>
                                            </li>
                                        </ul>
                                        <div class="product__hover__details">
                                            <a href="../product/Single-product.html"><span>View Details</span></a>
                                        </div>
                                    </div>

                                    <div class="product__item__text">
                                        <a title="Vinaika  Women Green  Turquoise Kurta & Palazzo"
                                            href="../product/Single-product.html">
                                            <span>Vinaika Women Green Turquoise Kurta & Palazzo</span>
                                        </a>

                                        <span>₹ 1000</span>

                                        <div class="product__color__select">
                                            <label for="pc-1">
                                                <a title="XS" href="javascript:void(0)">XS</a>
                                            </label>
                                            <label for="pc-1">
                                                <a title="S" href="javascript:void(0)">S</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg">
                                        <a href="../product/Single-product.html">
                                            <img onerror="" src="../public/assets/images/images/women-kurtis.jpg" />
                                        </a>

                                        <ul class="product__hover">
                                            <li class="toggle-whishlist" data-product-id="346">
                                                <img onerror="" src="../html/img/icon/heart.png" alt="" /><span>Wishlist</span>
                                            </li>
                                            <li class="add-cart add_to_cart_btn" product_id="346">
                                                <img onerror="" src="../html/img/icon/cart.png" alt="" />
                                                <span>Cart</span>
                                            </li>
                                        </ul>
                                        <div class="product__hover__details">
                                            <a href="../product/Single-product.html"><span>View Details</span></a>
                                        </div>
                                    </div>

                                    <div class="product__item__text">
                                        <a title="Vinaika  Women Green  Turquoise Kurta & Palazzo"
                                            href="../product/Single-product.html">
                                            <span>Vinaika Women Green Turquoise Kurta & Palazzo</span>
                                        </a>

                                        <span>₹ 1000</span>

                                        <div class="product__color__select">
                                            <label for="pc-1">
                                                <a title="XS" href="javascript:void(0)">XS</a>
                                            </label>
                                            <label for="pc-1">
                                                <a title="S" href="javascript:void(0)">S</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg">
                                        <a href="../product/Single-product.html">
                                            <img onerror="" src="../public/assets/images/images/women-kurtis.jpg" />
                                        </a>

                                        <ul class="product__hover">
                                            <li class="toggle-whishlist" data-product-id="346">
                                                <img onerror="" src="../html/img/icon/heart.png" alt="" /><span>Wishlist</span>
                                            </li>
                                            <li class="add-cart add_to_cart_btn" product_id="346">
                                                <img onerror="" src="../html/img/icon/cart.png" alt="" />
                                                <span>Cart</span>
                                            </li>
                                        </ul>
                                        <div class="product__hover__details">
                                            <a href="../product/Single-product.html"><span>View Details</span></a>
                                        </div>
                                    </div>

                                    <div class="product__item__text">
                                        <a title="Vinaika  Women Green  Turquoise Kurta & Palazzo"
                                            href="../product/Single-product.html">
                                            <span>Vinaika Women Green Turquoise Kurta & Palazzo</span>
                                        </a>

                                        <span>₹ 1000</span>

                                        <div class="product__color__select">
                                            <label for="pc-1">
                                                <a title="XS" href="javascript:void(0)">XS</a>
                                            </label>
                                            <label for="pc-1">
                                                <a title="S" href="javascript:void(0)">S</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg">
                                        <a href="../product/Single-product.html">
                                            <img onerror="" src="../public/assets/images/images/women-kurtis.jpg" />
                                        </a>

                                        <ul class="product__hover">
                                            <li class="toggle-whishlist" data-product-id="346">
                                                <img onerror="" src="../html/img/icon/heart.png" alt="" /><span>Wishlist</span>
                                            </li>
                                            <li class="add-cart add_to_cart_btn" product_id="346">
                                                <img onerror="" src="../html/img/icon/cart.png" alt="" />
                                                <span>Cart</span>
                                            </li>
                                        </ul>
                                        <div class="product__hover__details">
                                            <a href="../product/Single-product.html"><span>View Details</span></a>
                                        </div>
                                    </div>

                                    <div class="product__item__text">
                                        <a title="Vinaika  Women Green  Turquoise Kurta & Palazzo"
                                            href="../product/Single-product.html">
                                            <span>Vinaika Women Green Turquoise Kurta & Palazzo</span>
                                        </a>

                                        <span>₹ 1000</span>

                                        <div class="product__color__select">
                                            <label for="pc-1">
                                                <a title="XS" href="javascript:void(0)">XS</a>
                                            </label>
                                            <label for="pc-1">
                                                <a title="S" href="javascript:void(0)">S</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>





<?php include 'common/footer.php'; ?>
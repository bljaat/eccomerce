<?php
include 'config.php';

include('../ecommerce/common/header.php');

if (!isset($_SESSION['user']['id'])) {
    echo "<p>Please login to view your cart.</p>";
    exit;
}

$user_id = $_SESSION['user']['id'];
$cart = $conn->query("SELECT product.product_logo, product.price,product.description, cart.quantity FROM cart INNER JOIN product ON cart.product_id = product.id WHERE cart.user_id = '$user_id'");

// $quantity = $_POST['quantity'];
// $update_cart = $conn->query("UPDATE `cart` SET `quantity`='$quantity' WHERE user_id = '$user_id'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="content">
        <!-- Breadcrumb Section Begin -->
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
                            <h4>Shopping Cart</h4>
                            <div class="breadcrumb__links">
                                <a href="index-2.html">Home</a>
                                <a href="shop.html">Shop</a>
                                <span>Shopping Cart</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- Shopping Cart Section Begin -->
        <section class="shopping-cart spad pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="shopping__cart__table">
                            <div class="">
                                <div class="product-table-header">
                                    <div class="product-table-header-inner">
                                        <div class="pro-header basis-50">
                                            <h3>Product</h3>
                                        </div>
                                        <div class="qty-header basis-20">
                                            <h3>Quantity</h3>
                                        </div>
                                        <div class="total-header basis-20">
                                            <h3>Total</h3>
                                        </div>
                                        <div class="empty-head basis-10">
                                            <h3></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-table-body">
                                    <div class="product-table-body-inner">
                                        <?php
                                        $grand_total = 0;

                                        if ($cart->num_rows == 0) {
                                            echo "<p>Your cart is empty!</p>";
                                        } else {
                                            while ($row = $cart->fetch_assoc()) {
                                                $product_total = $row['price'] * $row['quantity']; // 🏷️ हर प्रोडक्ट की कुल कीमत निकालें
                                                $grand_total += $product_total; // 🏷️ इसे Grand Total में जोड़ें
                                        ?>
                                                <div class="product__cart__item d-flex align-items-center basis-50">
                                                    <div class="product__cart__item__pic">
                                                        <img src="<?php echo UPLOAD_PATH . $row['product_logo']; ?>" />
                                                    </div>
                                                    <div class="product__cart__item__text" style="width: 89%;">
                                                        <h6><?php echo $row['description']; ?></h6>
                                                        <h5>₹<?php echo number_format($row['price'], 2); ?></h5>
                                                    </div>
                                                </div>
                                                <div class="quantity__item basis-20">
                                                    <div class="quantity">
                                                        <div class="pro-qty-2">
                                                            <input type="number" class="quantity-input" name="quantity" data-price="<?php echo $row['price']; ?>" value="<?php echo $row['quantity']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="cart__price basis-20">
                                                    <span class="product-total">₹ <?php echo number_format($product_total, 2); ?></span>
                                                </div>
                                                <div class="cart__close remove_fron_cart_btn basis-10">
                                                    <i class="fa fa-close"></i>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn">
                                    <a href="#">Continue Shopping</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn update__btn">
                                    <a class="btn-product btn--animated" href="#"><i class="fa fa-spinner"></i>
                                        Update cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart__discount">
                            <h6>Discount codes</h6>
                            <form method="POST" action="#">
                                <input type="text" placeholder="Coupon code">
                                <button type="submit">Apply</button>
                            </form>
                        </div>
                        <div class="cart__total">
                            <h6>Cart total</h6>
                            <ul>
                                <li>Subtotal <span>₹<?php echo number_format($grand_total, 2); ?></span></li>
                                <li>Total <span>₹<?php echo number_format($grand_total, 2); ?></span></li>
                            </ul>
                            <a href="login.html" class="primary-btn btn-product btn--animated">Proceed to
                                checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Shopping Cart Section End -->

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let quantityInputs = document.querySelectorAll(".quantity-input");

            quantityInputs.forEach(function(input) {
                input.addEventListener("change", function() {
                    let price = parseFloat(this.getAttribute("data-price"));
                    let quantity = parseInt(this.value);
                    let totalElement = this.closest(".quantity__item").nextElementSibling.querySelector(".product-total");
                    if (quantity > 0) {
                        let newTotal = price * quantity;
                        totalElement.textContent = "₹ " + newTotal.toFixed(2);
                        updateGrandTotal();
                    }
                });
            });

            function updateGrandTotal() {
                let totalElements = document.querySelectorAll(".product-total");
                let grandTotal = 0;

                totalElements.forEach(function(element) {
                    grandTotal += parseFloat(element.textContent.replace("₹", "").trim());
                });

                document.querySelector(".cart__total ul li span").textContent = "₹ " + grandTotal.toFixed(2);
            }
        });
    </script>



    <?php include('../ecommerce/common/footer.php') ?>
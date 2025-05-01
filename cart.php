
<?php
include 'config.php';

if (!isset($_SESSION['user']['id'])) {
    echo json_encode(["status" => "error", "message" => "Please login to add items to the cart."]);
    exit;
}

$user_id = $_SESSION['user']['id']; // यूजर का ID 
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'] ?? 1;

// पहले चेक करें कि यह प्रोडक्ट पहले से कार्ट में है या नहीं
$check_cart = $conn->query("SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'");
if ($check_cart->num_rows > 0) {
    // अगर प्रोडक्ट पहले से है, तो उसकी quantity बढ़ाएं
    $conn->query("UPDATE cart SET quantity = quantity + $quantity WHERE user_id = '$user_id' AND product_id = '$product_id'");
} else {
    // वरना नया प्रोडक्ट कार्ट में डालें
    $conn->query("INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')");
}

echo json_encode(["status" => "success", "message" => "Product added to cart"]);
?>

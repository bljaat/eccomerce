<?php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == "wishlist") {
    if (!isset($_SESSION['user']['id'])) {
        echo json_encode(["status" => "error", "message" => "Login required"]);
        exit;
    }
    

    $user_id = $_SESSION['user']['id'];
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0; 
    $variation_id = isset($_POST['variation_id']) ? intval($_POST['variation_id']) : null;

    if ($product_id == 0) {
        echo json_encode(["status" => "error", "message" => "Invalid product"]);
        exit;
    }

    $query = "SELECT * FROM wishlist WHERE user_id='$user_id' AND product_id='$product_id'";
    if ($variation_id) {
        $query .= " AND variation_id='$variation_id'";
    }

    $check = $conn->query($query);
    
    if ($check->num_rows == 0) {
        $insertQuery = "INSERT INTO wishlist (user_id, product_id, variation_id) VALUES ('$user_id', '$product_id', '$variation_id')";
        if ($conn->query($insertQuery)) {
            echo json_encode(["status" => "success", "message" => "Added to wishlist"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database error"]);
        }
    }elseif($check->num_rows > 0){
        $removeQuery = "DELETE FROM wishlist WHERE user_id='$user_id' AND product_id='$product_id'";
        if ($variation_id) {
            $removeQuery .= " AND variation_id='$variation_id'";
        }
        if ($conn->query($removeQuery)) {
            echo json_encode(["status" => "success", "message" => "Removed from wishlist"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database error"]);
        }
    }
     else {
        echo json_encode(["status" => "error", "message" => "Already in wishlist"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

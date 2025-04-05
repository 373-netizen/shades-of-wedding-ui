<?php
session_start();
include('./includes/connect.php'); // Database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in to add items to the cart.'); window.location.href = './includes/log_in.php';</script>";
    exit();
}

// Initialize cart session if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if the request is a POST request and has a product_id
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);

    // Fetch product details from the database
    $query = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);

    if ($product) {
        // Check if the product is already in the cart
        if (!isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] = [
                'title' => $product['product_title'],
                'price' => $product['product_price'],
                'image' => $product['product_image1'],
                'quantity' => 1
            ];
        } else {
            $_SESSION['cart'][$product_id]['quantity']++;
        }
    }

    // Redirect to the cart page after adding to cart
    header("Location: cart.php");
    exit();
}
?>

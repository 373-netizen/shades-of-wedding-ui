<?php
session_start();
include('../includes/connect.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("❌ Error: User not logged in.");
}

$user_id = $_SESSION['user_id'];

// Check if cart is empty
$cart_query = mysqli_query($con, "SELECT * FROM cart WHERE user_id = $user_id");
if (!$cart_query) {
    die("❌ Cart Query Error: " . mysqli_error($con));
}

if (mysqli_num_rows($cart_query) == 0) {
    die("❌ Error: Your cart is empty!");
}

// Calculate total order price
$total_price = 0;
$cart_items = [];
while ($cart = mysqli_fetch_assoc($cart_query)) {
    $product_id = $cart['product_id'];
    $product_query = mysqli_query($con, "SELECT product_price FROM products WHERE product_id = $product_id");

    if (!$product_query) {
        die("❌ Product Query Error: " . mysqli_error($con));
    }
    
    $product = mysqli_fetch_assoc($product_query);
    if (!$product) {
        die("❌ Error: Product not found in database.");
    }
    
    $total_price += $product['product_price'] * $cart['quantity'];

    // Store cart items for later insertion
    $cart_items[] = [
        'product_id' => $product_id,
        'quantity' => $cart['quantity'],
        'price' => $product['product_price']
    ];
}

// Insert into `orders` table
$order_query = "INSERT INTO `orders`(`user_id`, `total_amount`, `payment_status`) 
                VALUES ($user_id, $total_price, 'completed')";

if (!mysqli_query($con, $order_query)) {
    die("❌ Order Insert Error: " . mysqli_error($con));
}

$order_id = mysqli_insert_id($con); // Get last inserted ID

if (!$order_id) {
    die("❌ Error: Order ID not generated.");
}

// Insert into `order_items` table
foreach ($cart_items as $item) {
    $product_id = $item['product_id'];
    $quantity = $item['quantity'];
    $price = $item['price'];

    $insert_item = "INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`, `price`) 
                    VALUES ($order_id, $product_id, $quantity, $price)";

    if (!mysqli_query($con, $insert_item)) {
        die("❌ Order Item Insert Error: " . mysqli_error($con));
    }
}

// Clear the cart AFTER inserting order items
mysqli_query($con, "DELETE FROM cart WHERE user_id = $user_id") or die("❌ Cart Delete Error: " . mysqli_error($con));

// Redirect to receipt page
header("Location: ../receipt.php?order_id=$order_id");
exit();
?>

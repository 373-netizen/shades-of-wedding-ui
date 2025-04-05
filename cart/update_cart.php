<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../includes/log_in.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = intval($_POST['product_id']); // Ensure it's an integer
    $quantity = intval($_POST['quantity']); // Ensure quantity is a valid number

    // Validate and update quantity in session
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = max(1, $quantity); // Store as an integer
    }

    header("Location: cart.php");
    exit();
}
?>

<?php
include('C:\wamp64\www\zobiya_373\includes\connect.php');

if (!$con) {
    die("❌ Database connection failed: " . mysqli_connect_error());
}

// Debugging: Print all GET parameters
echo "<pre>";
print_r($_GET);
echo "</pre>";

// Check if order_id is present
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    die("❌ Invalid order ID: Order ID not received in URL.");
}

$order_id = intval($_GET['order_id']); // Convert to integer for security

if ($order_id <= 0) {
    die("❌ Invalid order ID: Order ID should be a positive number.");
}

// Debugging
echo "✅ Order ID Received: " . $order_id;

// Fetch order details
$order_query = mysqli_query($con, "SELECT * FROM orders WHERE id = $order_id");

if (mysqli_num_rows($order_query) == 0) {
    die("❌ Order not found in database.");
}

$order = mysqli_fetch_assoc($order_query);

// Fetch order items
$order_items_query = "SELECT order_items.*, products.product_title 
                      FROM order_items 
                      JOIN products ON order_items.product_id = products.product_id 
                      WHERE order_items.order_id = $order_id";

$order_items = mysqli_query($con, $order_items_query);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2>Order Receipt</h2>
    <p><strong>Order ID:</strong> <?php echo $order['id']; ?></p>
    <p><strong>Total:</strong> ₹<?php echo number_format($order['total_amount'], 2); ?></p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($item = mysqli_fetch_assoc($order_items)) { ?>
                <tr>
                    <td><?php echo $item['product_title']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>₹<?php echo number_format($item['price'], 2); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../shop_for_brides.php" class="btn btn-primary">Continue Shopping</a>
</div>

</body>
</html>

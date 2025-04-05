<?php
include('./includes/connect.php');
session_start();

if (!$con) {
    die("❌ Database connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in to view your orders.'); window.location.href = './includes/log_in.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch order items along with product title and image
$order_items_query = "SELECT order_items.*, products.product_title, products.product_image1 
FROM order_items 
JOIN products ON order_items.product_id = products.product_id 
JOIN `orders` ON order_items.order_id = `orders`.id 
WHERE `orders`.user_id = $user_id;";

$order_items = mysqli_query($con, $order_items_query);

if (mysqli_num_rows($order_items) == 0) {
    die("❌ No orders found.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Main Navigation Bar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-body-info">
            <div class="container-fluid">
                <img src="./images/logo.png" alt="Logo" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="shades_wedding.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="shop_for_brides.php">Shop for Brides</a></li>
                        <li class="nav-item"><a class="nav-link" href="./cart/cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                        <li class="nav-item"><a class="nav-link" href="order.php">Orders</a></li>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li class="nav-item"><a class="nav-link" href="./includes/logout.php">Logout</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="./includes/log_in.php">Log in</a></li>
                        <?php endif; ?>
                    </ul>
                    <form class="d-flex" role="search" action="search.php" method="GET">
                        <input class="form-control me-2" type="search" name="query" placeholder="Search">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>

    <!-- Orders Table -->
    <div class="container mt-4">
        <h2 class="text-center mb-4">Your Orders</h2>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Image</th> <!-- Added Image Column -->
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = mysqli_fetch_assoc($order_items)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['product_title']); ?></td>
                        <td>
                            <img src="./admin_area/product_images/<?php echo htmlspecialchars($item['product_image1']); ?>" 
                                 width="80" height="80" alt="Product Image" class="img-fluid rounded">
                        </td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>₹<?php echo number_format($item['price'], 2); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="shop_for_brides.php" class="btn btn-primary">Continue Shopping</a>
        </div>
    </div>
  <!---last child---->
  <div class="bg-info">
            
            <footer style="background-color: #282828; color: #fff; padding: 20px 0; text-align: center;">
               <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <p>&copy; 2025 Shades of wedding. All rights reserved.</p>
                  <p>
          <a href="/privacy-policy" style="color: #fff; text-decoration: none; margin: 0 10px;">Privacy Policy</a> |
          <a href="/terms-of-service" style="color: #fff; text-decoration: none; margin: 0 10px;">Terms of Service</a> |
          <a href="https://facebook.com/yourcompany" style="color: #fff; text-decoration: none; margin: 0 10px;">Facebook</a> |
          <a href="https://twitter.com/yourcompany" style="color: #fff; text-decoration: none; margin: 0 10px;">Twitter</a>
        </p>
      </div>
    </footer>
    </div>
</body>
</html>

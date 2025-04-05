<?php
session_start();

// Check if cart is initialized
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Remove item from cart
if (isset($_GET['remove'])) {
    $remove_id = intval($_GET['remove']);
    unset($_SESSION['cart'][$remove_id]);
    header("Location: cart.php");
    exit();
}

// Handle checkout process
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['checkout'])) {
    if (!empty($_SESSION['cart'])) {
        $_SESSION['cart'] = []; // Empty cart after checkout
        header("Location: receipt.php"); // Redirect to receipt page
        exit();
    } else {
        $checkout_error = "Your cart is empty!";
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>



        <!-- Navigation Bar -->
        <div class="container-fluid p-0">
                <nav class="navbar navbar-expand-lg bg-body-info">
                    <div class="container-fluid">
                        <img src="./images/logo.png" alt="" class="logo">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item"><a class="nav-link active" href="shades_wedding.php">Home</a></li>
                              
                                <li class="nav-item"><a class="nav-link" href="shop_for_brides.php">Shop for Brides</a></li>
                                <li class="nav-item"><a class="nav-link" href="./cart/cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Orders</a></li>
                                <li class="nav-item"><a class="nav-link" href="./includes/log_in.php">Log in</a></li>
                            </ul>
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search">
                                <button class="btn btn-outline-light" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </nav>
        </div>       

<div class="container my-4">
    <h2>Shopping Cart</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $id => $item):
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><img src="./admin_area/product_images/<?php echo $item['image']; ?>" width="50"></td>
                        <td><?php echo $item['title']; ?></td>
                        <td>₹<?php echo $item['price']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>₹<?php echo $subtotal; ?></td>
                        <td><a href="cart.php?remove=<?php echo $id; ?>" class="btn btn-sm btn-danger">Remove</a></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4"><strong>Total</strong></td>
                    <td><strong>₹<?php echo $total; ?></strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <form method="POST">
            <button type="submit" name="checkout" class="btn btn-success">Proceed to Checkout</button>
        </form>
        <a href="products.php" class="btn btn-primary mt-3">Shop More</a>
    <?php else: ?>
        <p class="text-danger">Your cart is empty.</p>
        <a href="../shop_for_brides.php" class="btn btn-primary">Shop Now</a>
    <?php endif; ?>

</div>
      
         <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3">
        <p>&copy; 2025 Shades of Wedding. All rights reserved.</p>
    </footer>
</body>
</html>

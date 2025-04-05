<?php
session_start();
include('./includes/connect.php');

// Get the search query from the URL, and use mysqli_real_escape_string for security.
$query = isset($_GET['query']) ? mysqli_real_escape_string($con, $_GET['query']) : '';

// Initialize an empty array for results
$results = [];

if (!empty($query)) {
    // Run a search query on the products table (adjust the query as needed)
    $sql = "SELECT * FROM products WHERE product_title LIKE '%$query%' OR product_description LIKE '%$query%'";
    $result = mysqli_query($con, $sql);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    } else {
        die("❌ Search Query Error: " . mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results for "<?php echo htmlspecialchars($query); ?>"</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Search Results for "<?php echo htmlspecialchars($query); ?>"</h2>
    <?php if (empty($results)): ?>
        <p>No products found.</p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($results as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="./admin_area/product_images/<?php echo htmlspecialchars($product['product_image1']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['product_title']); ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['product_title']); ?></h5>
                            <p class="card-text">₹<?php echo number_format($product['product_price'], 2); ?></p>
                            <!-- You can add more product details and an Add to Cart form here -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <a href="shop_for_brides.php" class="btn btn-secondary mt-3">Back to Shop</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

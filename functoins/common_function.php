<?php
include('./includes/connect.php');

// Fetch Products with Filtering
// Fetch Products with Filtering
function getproducts() {
    global $con;

    // Filtering by Occasion or Category
    $where_clause = "";
    if (isset($_GET['occasion_id']) && !empty($_GET['occasion_id'])) {
        $occasion_id = intval($_GET['occasion_id']);
        $where_clause = " WHERE occasion_id = $occasion_id"; // <-- Uses `occasion_id` column
    } elseif (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
        $category_id = intval($_GET['category_id']);
        $where_clause = " WHERE category_id = $category_id"; // <-- Uses `category_id` column
    }

    // Fetch products with random order
    $select_query = "SELECT * FROM `products` $where_clause ORDER BY RAND()"; // <-- Uses `products` table
    $result_query = mysqli_query($con, $select_query);

    if (mysqli_num_rows($result_query) > 0) {
        while ($row = mysqli_fetch_assoc($result_query)) {
            // Fetching data from the database
            $product_id = $row['product_id'];  // <-- Uses `product_id` column
            $product_title = htmlspecialchars($row['product_title']);  // <-- Uses `product_title` column
            $product_description = htmlspecialchars($row['product_description']);  // <-- Uses `product_description` column
            $product_price = $row['product_price'];  // <-- Uses `product_price` column
            
            // Handling product image
            $product_image = !empty($row['product_image1']) 
                ? "admin_area/product_images/" . trim($row['product_image1'])  // <-- Uses `product_image1` column
                : "default.jpg";

            // Display product card
            echo '
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="'.$product_image.'" class="card-img-top" alt="'.$product_title.'" onerror="this.onerror=null; this.src=\'default.jpg\';">
                        <div class="card-body text-center">
                            <h5 class="card-title">'.$product_title.'</h5>
                            <p class="card-text">'.$product_description.'</p>
                            <p class="card-text"><strong>Price: ₹'.$product_price.'</strong></p>

                            <div class="d-flex justify-content-between mt-2">
                                <button class="btn btn-primary view-details" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#productModal" 
                                        data-title="'.$product_title.'"
                                        data-description="'.$product_description.'"
                                        data-image="'.$product_image.'"
                                        data-price="₹'.$product_price.'">
                                    View Details
                                </button>

                                <form method="POST" action="add_to_cart.php">
                                    <input type="hidden" name="product_id" value="'.$product_id.'">
                                    <button type="submit" class="btn btn-success">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
    } else {
        echo "<h3 class='text-center'>No products found for this filter.</h3>";
    }
}


// Occasion Dropdown
function getOccasionDropdown() {
    global $con;

    echo '<div class="dropdown text-center d-inline-block">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="occasionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                By Occasion
            </button>
            <ul class="dropdown-menu" aria-labelledby="occasionDropdown">';

    $select_occasion = "SELECT * FROM `ocassion`";
    $result_occasion = mysqli_query($con, $select_occasion);

    while ($row_data = mysqli_fetch_assoc($result_occasion)) {
        $occasion_title = htmlspecialchars($row_data['ocassion_title']);
        $occasion_id = $row_data['occasion_id'];
        echo "<li><a class='dropdown-item' href='shop_for_brides.php?occasion_id=$occasion_id'>$occasion_title</a></li>";
    }

    echo '</ul></div>';
}

// Category Dropdown
function getCategoryDropdown() {
    global $con;

    echo '<div class="dropdown text-center d-inline-block">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                By Category
            </button>
            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">';

    $select_category = "SELECT * FROM `categories`";
    $result_category = mysqli_query($con, $select_category);

    while ($row_data = mysqli_fetch_assoc($result_category)) {
        $category_title = htmlspecialchars($row_data['category_title']);
        $category_id = $row_data['category_id'];
        echo "<li><a class='dropdown-item' href='shop_for_brides.php?category_id=$category_id'>$category_title</a></li>";
    }

    echo '</ul></div>';
}

// Display Dropdowns in the center
function displayDropdowns() {
    echo '<div class="text-center mt-3">';
    getOccasionDropdown();
    getCategoryDropdown();
    echo '</div>';
}


<!-- connect file -->
<?php
include('./includes/connect.php');
include('./functoins/common_function.php');
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shades of Wedding</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <style>
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: contain;
        }
        .dropdown-container {
    text-align: center;
    margin: 20px 0;
}

.dropdown {
    display: inline-block;
    position: relative;
}

.dropdown-button {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
}

.dropdown-button:hover {
    background-color: #0056b3;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    text-align: left;
}

.dropdown-content a {
    color: black;
    padding: 10px 15px;
    display: block;
    text-decoration: none;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
}

.show {
    display: block;
}

    </style>
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
                        <li class="nav-item"><a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
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

        <div class="bg-light text-center p-3">
            <h3>Shades of Wedding</h3>
            <p>Find your perfect shade for your big day</p>
        </div>
    </div>
    <?php
          displayDropdowns();
    ?>

    <!-- Product Section -->
    <div class="container my-4">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php getproducts(); ?>
        </div>
    </div>

    <!-- Product Details Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="modalImage" src="" class="img-fluid" alt="Product Image">
                        </div>
                        <div class="col-md-6">
                            <h3 id="modalTitle"></h3>
                            <p id="modalDescription"></p>
                            <h5>Price: <span id="modalPrice"></span></h5>
                            <button class="btn btn-success">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
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
    
    
         
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
    const viewDetailButtons = document.querySelectorAll(".view-details");

    viewDetailButtons.forEach(button => {
        button.addEventListener("click", function () {
            const title = this.getAttribute("data-title") || "No Title";
            const description = this.getAttribute("data-description") || "No Description";
            const image = this.getAttribute("data-image") || "./images/default.jpg";
            const price = this.getAttribute("data-price") || "No Price";

            console.log("Product Loaded:", { title, description, image, price });

            // Ensure elements exist before updating
            const modalTitle = document.getElementById("modalTitle");
            const modalDescription = document.getElementById("modalDescription");
            const modalImage = document.getElementById("modalImage");
            const modalPrice = document.getElementById("modalPrice");

            if (modalTitle) modalTitle.innerText = title;
            if (modalDescription) modalDescription.innerText = description;
            if (modalImage) modalImage.src = image;
            if (modalPrice) modalPrice.innerText = price;
        });
    });
});
</script>
</body>
</html>

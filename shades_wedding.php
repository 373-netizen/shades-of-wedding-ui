<?php
session_start();
include('./includes/connect.php');

// Default welcome message
$welcome_message = '<span>Welcome Guest</span>';

// Check if the user is logged in using session keys
if (isset($_SESSION['user_id'])) {
    $username = $_SESSION['name'] ?? 'User';
    $welcome_message = '<span>Welcome ' . htmlspecialchars($username) . '</span>';
}
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
  <style>
      .card-img-top {
          width: 100%;
          height: 200px;
          object-fit: contain;
      }
      /* styling for the second child */
      .welcome-section {
          background-color: #f8f9fa;
          padding: 15px;
          text-align: center;
          font-size: 1.2em;
          margin-bottom: 20px;
      }
  </style>
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
            <li class="nav-item">
              <a class="nav-link active" href="shades_wedding.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="shop_for_brides.php">Shop for Brides</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./cart/cart.php">
                <i class="fa-solid fa-cart-shopping"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Orders</a>
            </li>
            <?php if (isset($_SESSION['user_id'])): ?>
              <li class="nav-item">
                <a class="nav-link" href="./includes/logout.php">Logout</a>
              </li>
            <?php else: ?>
              <li class="nav-item">
                <a class="nav-link" href="./includes/log_in.php">Log in</a>
              </li>
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

  <!-- Second Child: Welcome Message Section -->
  <div class="welcome-section">
    <?= $welcome_message ?>
  </div>
         <!----third child--->
         <div class="bg-light">
            <h3 class="text-center">Shades of wedding</h3>
            <p class="text-center"> where you can find your perfect shade for your big days</p>
         </div>  
        <!----fifth child---> 
                <div class="row">
                <div class="col-md-12">
 
    <!-- Product Section -->
    <div class="container my-4">
        <div class="row">
            <!-- Product Card -->
            <div class="col-md-4 mb-3">
                <div class="card product-card" 
                     data-title="Golden Bridal Lehenga" 
                     data-image="./images/cape_lehenga1.png"
                     data-description="The Rambagh Lehenga"
                     data-price="₹360,000">
                    <img src="./images/cape_lehenga1.png" class="card-img-top" alt="Golden Bridal Lehenga">
                    <div class="card-body">
                        <h5 class="card-title">Off White Bridal Lehenga</h5>
                        <p class="card-text">A dazzling outfit for the bride.</p>
                        <button class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#productModal">View Details</button>
                        <a href="./cart/cart.php" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card product-card" 
                     data-title="Golden Bridal Lehenga" 
                     data-image="./images/cape_saree1.png"
                     data-description="The cape saree"
                     data-price="₹300,000">
                    <img src="./images/cape_saree1.png" class="card-img-top" alt="Golden Bridal Lehenga">
                    <div class="card-body">
                        <h5 class="card-title"> Bridal cape saree</h5>
                        <p class="card-text">A dazzling outfit for the bride.</p>
                        <button class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#productModal">View Details</button>
                        <a href="#" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card product-card" 
                     data-title="Red Bridal Lehenga" 
                     data-image="./images/red_lehenga1.png"
                     data-description="A stunning red bridal lehenga with golden embroidery."
                     data-price="₹25,000">
                    <img src="./images/red_lehenga1.png" class="card-img-top" alt="Red Bridal Lehenga">
                    <div class="card-body">
                        <h5 class="card-title">Red Bridal Lehenga</h5>
                        <p class="card-text">Elegant lehenga with intricate designs.</p>
                        <button class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#productModal">View Details</button>
                        <a href="#" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card product-card" 
                     data-title="Golden Bridal gown" 
                     data-image="./images/golden_gown1.png"
                     data-description="Golden gown with handcrafted embroidery and rich fabric."
                     data-price="₹30,000">
                    <img src="./images/golden_gown1.png" class="card-img-top" alt="golden_gown1">
                    <div class="card-body">
                        <h5 class="card-title">Golden Bridal gown</h5>
                        <p class="card-text">A dazzling outfit for the bride.</p>
                        <button class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#productModal">View Details</button>
                        <a href="#" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card product-card" 
                     data-title="maroon Bridal anarkali" 
                     data-image="./images/maroon_anarkali1.png"
                     data-description="A royal maroon anarkali a with an exquisite pattern."
                     data-price="₹28,000">
                    <img src="./images/maroon_anarkali1.png" class="card-img-top" alt="maroon_anarkali1">
                    <div class="card-body">
                        <h5 class="card-title">maroon anarkali</h5>
                        <p class="card-text">Feel like royalty on your big day.</p>
                        <button class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#productModal">View Details</button>
                        <a href="#" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
    
    <div class="col-md-4 mb-3">
                <div class="card product-card" 
                     data-title="Golden Bridal lehenga" 
                     data-image="./images/golden_lehenga3.png"
                     data-description="Golden lehenga with handcrafted embroidery and rich fabric. perefct for your big day."
                     data-price="₹39,700">
                    <img src="./images/golden_lehenga3.png" class="card-img-top" alt="golden_lehenga">
                    <div class="card-body">
                        <h5 class="card-title">Golden Bridal lehenga</h5>
                        <p class="card-text">A dazzling outfit for the bride.</p>
                        <button class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#productModal">View Details</button>
                        <a href="#" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card product-card" 
                     data-title="green Bridal gown" 
                     data-image="./images/green_gown1.png"
                     data-description="Green gown with handcrafted embroidery and sequence work and  rich fabric."
                     data-price="₹50,000">
                    <img src="./images/green_gown1.png" class="card-img-top" alt="green_gown1">
                    <div class="card-body">
                        <h5 class="card-title">Green Bridal gown</h5>
                        <p class="card-text">make your day perfect.</p>
                        <button class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#productModal">View Details</button>
                        <a href="#" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
           
            <div class="col-md-4 mb-3">
                <div class="card product-card" 
                     data-title="white Bridal gown" 
                     data-image="./images/white_gown1.png"
                     data-description="white gown with handcrafted embroidery  and stylish design."
                     data-price="₹65,000">
                    <img src="./images/golden_gown1.png" class="card-img-top" alt="golden_gown1">
                    <div class="card-body">
                        <h5 class="card-title">white bridal gown</h5>
                        <p class="card-text">A designer outfit to make your day more stylish .</p>
                        <button class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#productModal">View Details</button>
                        <a href="#" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card product-card" 
                     data-title="red bridal anarkali" 
                     data-image="./images/red_anarkali1.png"
                     data-description="a red anarkali with hand embroidery.."
                     data-price="₹46,000">
                    <img src="./images/red_anarkali1.png" class="card-img-top" alt="red_anarkali1">
                    <div class="card-body">
                        <h5 class="card-title">red bridal anarkali</h5>
                        <p class="card-text">a simple yet classy look for your speacial day.</p>
                        <button class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#productModal">View Details</button>
                        <a href="#" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card product-card" 
                     data-title="sky blue bridal gown" 
                     data-image="./images/skyblue_gown2.png"
                     data-description="sky blue coloured ball gown with sequence work."
                     data-price="₹30,000">
                    <img src="./images/skyblue_gown2.png" class="card-img-top" alt="skyblue_gown2">
                    <div class="card-body">
                        <h5 class="card-title">white bridal gown</h5>
                        <p class="card-text">unique and creative designer outfit for speacial you .</p>
                        <button class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#productModal">View Details</button>
                        <a href="#" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card product-card" 
                     data-title="white  bridal peplum" 
                     data-image="./images/white_peplum1.png"
                     data-description="White peplum or lehenga with lace and handcraft embroidery work."
                     data-price="₹20,000">
                    <img src="./images/white_peplum1.png" class="card-img-top" alt="white_peplum1">
                    <div class="card-body">
                        <h5 class="card-title">white bridal peplum</h5>
                        <p class="card-text">Go traditional with a unique white lehenga .</p>
                        <button class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#productModal">View Details</button>
                        <a href="#" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card product-card" 
                     data-title="pastel bridal lehenga" 
                     data-image="./images/pastel_lehenga1.png"
                     data-description="pastel colour lehenga with handcrafted embroidery . and stylish design."
                     data-price="₹50,000">
                    <img src="./images/pastel_lehenga1.png" class="card-img-top" alt="pastel_lehenga1">
                    <div class="card-body">
                        <h5 class="card-title">pastel bridal lehenga</h5>
                        <p class="card-text">A designer outfit to make your day more stylish .</p>
                        <button class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#productModal">View Details</button>
                        <a href="#" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card product-card" 
                     data-title="red Bridal lehenga" 
                     data-image="./images/red_lehenga9.png"
                     data-description="white gown with handcrafted embroidery . and stylish design."
                     data-price="₹30,000">
                    <img src="./images/red_lehenga9.png" class="card-img-top" alt="red_lehenga9">
                    <div class="card-body">
                        <h5 class="card-title">red Bridal lehenga</h5>
                        <p class="card-text">Here is your perfect outfit for you big day to look most traditional .</p>
                        <button class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#productModal">View Details</button>
                        <a href="#" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card product-card" 
                     data-title="turcoish colored bridal lehenga" 
                     data-image="./images/turcoish_lehenga1.png"
                     data-description="turcoish lehenga with handcrafted embroidery  and stylish design."
                     data-price="₹30,000">
                    <img src="./images/turcoish_lehenga1.png" class="card-img-top" alt="turcoish_lehenga1">
                    <div class="card-body">
                        <h5 class="card-title">turcoish colored bridal lehenga</h5>
                        <p class="card-text">A unique and elligent outfit just for you.</p>
                        <button class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#productModal">View Details</button>
                        <form action="add_to_cart.php" method="POST" style="display:inline;">
                    <input type="hidden" name="product_id" value="' . $product_id . '">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
                    </div>
                </div>
            </div>
</div>   

    <!-- Product Details Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Product Details</h5>
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
    <!-- Custom JS -->
    <script src="script.js"></script>

</body>
</html>

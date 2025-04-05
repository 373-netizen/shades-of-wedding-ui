<?php
session_start();
include('../includes/connect.php'); // Connect to DB using $con

// Check if the user is already logged in via cookies
if (isset($_COOKIE['user_id']) && isset($_COOKIE['name'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['name'] = $_COOKIE['name'];
    header("Location: shop_for_brides.php"); // Redirect to shop
    exit();
}

// Handle login
$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']); // Username field
    $password = trim($_POST['password']);
    $remember = isset($_POST['remember']); // Check if "Remember Me" is checked

    // Use MySQLi instead of PDO
    $stmt = $con->prepare("SELECT * FROM users WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];

        // If "Remember Me" is checked, set cookies for 7 days
        if ($remember) {
            setcookie('user_id', $user['id'], time() + (7 * 24 * 60 * 60), "/");
            setcookie('name', $user['name'], time() + (7 * 24 * 60 * 60), "/");
        }

        header("Location:../shop_for_brides.php"); // Redirect after login
        exit();
    } else {
        $error = "Invalid username or password!";
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Shades of Wedding</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
      <!-- Custom CSS -->
      <link rel="stylesheet" href="../style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            margin: 80px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    
    <!-- Navigation Bar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-body-info">
            <div class="container-fluid">
                <img src="../images/logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="../shades_wedding.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="../shop_for_brides.php">Shop for Brides</a></li>
                        <li class="nav-item"><a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
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
<div class="login-container">
    <h3><i class="fas fa-user-lock"></i> Login</h3>
    
    <?php if (!empty($error)): ?>
        <p class="error-message"><?php echo $error; ?></p>
    <?php endif; ?>
    
    <form method="POST" autocomplete="off">
        <div class="mb-3">
            <label for="name" class="form-label">Username</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Username" required autocomplete="new-username">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required autocomplete="new-password">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>
        <button type="submit" class="btn btn-custom w-100"><i class="fas fa-sign-in-alt"></i> Login</button>
    </form>

    <div class="text-center mt-3">
        <a href="register.php">Don't have an account? Register</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

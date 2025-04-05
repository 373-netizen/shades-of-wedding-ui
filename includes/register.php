<?php
include('connect.php'); // Database connection
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt password
    $country = isset($_POST['country']) ? trim($_POST['country']) : 'India'; // Default country
    $gender = isset($_POST['gender']) ? $_POST['gender'] : 'Other'; // Default gender

    // Check if the username or email already exists
    $check_query = "SELECT * FROM users WHERE name = ? OR email = ?";
    $stmt = $con->prepare($check_query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
            setTimeout(function() {
                if (confirm('Username or Email already exists! Do you want to go to Login?')) {
                    window.location.href = 'log_in.php';
                }
            }, 500);
        </script>";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (name, email, password, country, gender) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssss", $username, $email, $password, $country, $gender);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful! You can now login.'); window.location='log_in.php';</script>";
        } else {
            error_log("Database Error: " . $con->error . "\n", 3, "error_log.txt");
            echo "<script>alert('Something went wrong. Please try again later.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            margin-top: 50px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Register</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Country</label>
            <input type="text" name="country" class="form-control" placeholder="Enter Country (Default: India)">
        </div>

        <div class="mb-3">
            <label class="form-label">Gender</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="Male" required>
                <label class="form-check-label">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="Female" required>
                <label class="form-check-label">Female</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="Other" required>
                <label class="form-check-label">Other</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
    <p class="mt-3 text-center">Already have an account? <a href="log_in.php">Login</a></p>
</div>

</body>
</html>

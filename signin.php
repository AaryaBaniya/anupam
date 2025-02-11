<?php
require_once 'connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if inputs are not empty
    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Query to check credentials and role
        $sql = "SELECT * FROM customer WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $hashedPassword = md5($password); // Hash the password before checking
        $stmt->bind_param("ss", $email, $hashedPassword);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Set session variables
            $_SESSION['customer_id'] = $user['customer_id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['fullname'] = $user['fullname'];

            if ($user['role'] === 'admin') {
                // Redirect to admin dashboard
                header('Location: admindash.php');
            } else {
                // Redirect to userdashboard
                header('Location: userdash.php');
            }
            exit;
        } else {
            // Invalid credentials
            $error = "Invalid email or password.";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In</title>
    <link rel="stylesheet" href="./css/all.min.css" />
    <link rel="stylesheet" href="./css/style.css" />
</head>
<body>
<header class="page-header">
      <div class="wrapper">
        <nav class="main-nav">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="signup.php">Sign Up</a></li>
          </ul>
        </nav>
      </div>
</header>
<div class="box">  
    <div class="signin-container">
        <h1>Sign In</h1>
        <form method="POST" action="signin.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required />
            </div>
            <button type="submit">Sign In</button>
        </form>
        <!-- Display error message -->
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>

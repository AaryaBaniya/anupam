<?php
session_start(); // Start session
include 'connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']); // Trim input to remove extra spaces
    $password = trim($_POST['password']);
    $hashedPassword = md5($password); // Hash the password for comparison

    // Check if the email and hashed password exist in the database
    $query = "SELECT * FROM customer WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $hashedPassword); // Use prepared statements
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user details
        $user = $result->fetch_assoc();

        // Set session variables
        $_SESSION['customer_id'] = $user['customer_id'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['email'] = $user['email'];

        // Redirect to user dashboard
        header("Location: userdash.php");
        exit();
    } else {
        // If login fails, show an alert and redirect back to the login page
        echo "<script>alert('Invalid email or password');</script>";
        echo "<script>window.location.href='signin.php';</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In</title>
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <div class="box">  
<div class="signin-container">
      <h1>Sign In</h1>
        <form method="post" action="signin.php">
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
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
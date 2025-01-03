<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "login"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Query to check admin credentials
    $sql = "SELECT * FROM adminlogin WHERE username = 'admin' AND password = 'admin'"; // Ensure 'users' is your table name
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Redirect to the admin dashboard
        header("Location: admindash.php");
        exit();
    } else {
        echo "<script>alert('Invalid username or password!');</script>";
        echo "<script>window.location.href='index.html';</script>"; // Replace with the login form page if necessary
    }
}

$conn->close();
?>

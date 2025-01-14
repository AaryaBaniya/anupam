<?php 
// Database connection 
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "login"; 

// Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM adminlogin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $inputUsername, $inputPassword); // "ss" specifies the type of parameters as string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Redirect to the admin dashboard
        header("Location: admindash.php");
        exit();
    } else {
        echo "<script>alert('Invalid username or password!');</script>";
        echo "<script>window.location.href='adminlogin.php';</script>"; 
    }

    $stmt->close();
}

$conn->close();
?>

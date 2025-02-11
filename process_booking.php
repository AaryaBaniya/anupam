<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    header("Location: signin.php");
    exit();
}
$booking_date = $_POST['date'];
if (new DateTime($booking_date) < new DateTime('now')) {
    die("Invalid booking date. Please select a future date.");
}


include 'connect.php';

// Get form data
$customer_id = $_SESSION['customer_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$venue = $_POST['venue'];
$date = $_POST['date'];
$time = $_POST['time'];

// Insert booking into the database
$query = "INSERT INTO bookings (customer_id, name, email, phone, venue, booking_date, booking_time, status)
          VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')";
$stmt = $conn->prepare($query);
$stmt->bind_param("issssss", $customer_id, $name, $email, $phone, $venue, $date, $time);

if ($stmt->execute()) {
    // Redirect to dashboard with a success message
    echo "<script>alert('Booking submitted successfully!');</script>";
    echo "<script>window.location.href='userdash.php';</script>";
} else {
    // Show error message
    echo "<script>alert('Failed to submit booking. Please try again.');</script>";
    echo "<script>window.location.href='userdash.php';</script>";
}

$stmt->close();
$conn->close();
?>

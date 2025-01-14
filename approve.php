<?php
include 'connect.php';

// Check if 'booking_id' is passed
if (isset($_GET['customer_id']) && !empty($_GET['customer_id'])) {
    $customer_id = (int)$_GET['customer_id'];

    // Validate the booking ID
    if ($customer_id <= 0) {
        echo "<script>alert('Invalid booking ID!');</script>";
        header('location: admindash.php');
        exit();
    }

    // Update the booking status to 'approved'
    $query = "UPDATE bookings SET status = 'approved' WHERE customer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $customer_id);

    if ($stmt->execute()) {
        echo "<script>alert('Booking approved successfully!');</script>";
        header('location: admindash.php');
    } else {
        echo "<script>alert('Failed to approve booking. Please try again.');</script>";
        header('location: admindash.php');
    }

    $stmt->close();
} else {
    echo "<script>alert('No booking ID provided!');</script>";
    header('location: admindash.php');
    exit();
}

$conn->close();
?>

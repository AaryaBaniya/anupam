<?php
require_once 'connect.php';

// Check if booking ID is passed via GET
if (isset($_GET['booking_id']) && !empty($_GET['booking_id'])) {
    $booking_id = (int)$_GET['booking_id']; // Casting to ensure it's an integer

    if ($booking_id <= 0) {
        // Invalid ID check
        header('location: admindashboard.php'); // Redirect back if invalid
        exit;
    }

    // Update the booking status to approved
    $sql = "UPDATE bookings SET status = 'approved' WHERE booking_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id); // Binding the booking ID
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // If successfully updated, redirect to the admin dashboard
        header('location: admindashboard.php?msg=Booking approved');
        exit;
    } else {
        // If no rows were affected, show an error
        header('location: admindashboard.php?msg=Error approving booking');
        exit;
    }

    $stmt->close();
} else {
    // Redirect if booking ID is not set
    header('location: admindashboard.php');
    exit;
}
?>
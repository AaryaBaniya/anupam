<?php 
session_start();

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: signin.php");
    exit();
}

include 'connect.php'; 

// Fetch user details using session
$customer_id = $_SESSION['customer_id']; 

// Get user details
$query_user = "SELECT * FROM customer WHERE customer_id = ?";
$stmt_user = $conn->prepare($query_user);
$stmt_user->bind_param("i", $customer_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user->num_rows > 0) {
    $user = $result_user->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}


// Fetch pending bookings for the user
$query_pending = "SELECT * FROM bookings WHERE customer_id = ? AND status = 'pending' ORDER BY created_at DESC";
$stmt_pending = $conn->prepare($query_pending);
$stmt_pending->bind_param("i", $customer_id);
$stmt_pending->execute();
$result_pending = $stmt_pending->get_result();

$stmt_user->close();
$stmt_pending->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #fffdf3;
            color: #333;
        }
        header {
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
            position: relative;
        }
        header h1 {
            margin: 0;
        }
        .logout-button {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 8px 15px;
            background-color: #ff6347;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .logout-button:hover {
            background-color: #ff4c29;
        }
        .container {
            margin: 20px;
        }
        .buttons {
            margin-bottom: 20px;
        }
        .buttons button {
            margin-right: 10px;
            padding: 10px;
            background-color: #ddd;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .buttons button:hover {
            background-color: #ffeeba;
        }
        .section {
            display: none;
            margin-top: 20px;
            padding: 10px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .section.active {
            display: block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
<header>
    <h1>Welcome, <?php echo htmlspecialchars($user['fullname']); ?>!</h1>
    <a href="logout.php" class="logout-button">Log Out</a>
</header>
<div class="container">
    <div class="buttons">
        <button onclick="showSection('booking-form')">Booking Form</button>
        <button onclick="showSection('approved-bookings')">Approved Bookings</button>
        <button onclick="showSection('pending-bookings')">Pending Bookings</button>
    </div>
    <div id="booking-form" class="section active">
        <h2>Booking Form</h2>
        <form action="process_booking.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['fullname']); ?>" required /><br><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required /><br><br>
            
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required /><br><br>
            
            <label>Choose venue:</label>
            <label><input type="radio" name="venue" value="Akshyapatra Hall" required /> Akshyapatra Hall</label>
            <label><input type="radio" name="venue" value="Kalpavrikshya Hall" /> Kalpavrikshya Hall</label>
            <label><input type="radio" name="venue" value="Garden Hall" /> Garden Hall</label><br><br>
            
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required /><br><br>
            
            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required /><br><br>
            
            <button type="submit">Submit Booking</button>
        </form>
    </div>
    <div id="approved-bookings" class="section">
        <h2>Approved Bookings</h2>
        <p>Your approved bookings will appear here.</p>
    </div>
    <div id="pending-bookings" class="section">
        <h2>Pending Bookings</h2>
        <?php if ($result_pending->num_rows > 0): ?>
            <table bordee="1">
                <thead>
                    <tr>
                        <th>Venue</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($booking = $result_pending->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($booking['venue']); ?></td>
                            <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                            <td><?php echo htmlspecialchars($booking['booking_time']); ?></td>
                            <td><?php echo htmlspecialchars($booking['created_at']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No pending bookings found.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    function showSection(sectionId) {
        const sections = document.querySelectorAll('.section');
        sections.forEach(section => section.classList.remove('active'));
        document.getElementById(sectionId).classList.add('active');
    }
</script> 
</body>
</html>

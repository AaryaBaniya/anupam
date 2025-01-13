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

$query = "SELECT * FROM customer WHERE customer_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

$stmt->close();
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
        form label {
            font-weight: bold; /* Making the labels bold */
            display: block;
            margin: 10px 0 5px;
        }
        form input, form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        form button {
            background-color: #4caf50;
            color: white;
            border: none;
        }
        form button:hover {
            background-color: #45a049;
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
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['fullname']); ?>" required />
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required />
            
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required />
            
            <label>Choose venue:</label>
            <label><input type="radio" name="venue" value="Akshyapatra Hall" required /> Akshyapatra Hall</label>
            <label><input type="radio" name="venue" value="Kalpavrikshya Hall" /> Kalpavrikshya Hall</label>
            <label><input type="radio" name="venue" value="Garden Hall" /> Garden Hall</label><br><br>
            
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required />
            
            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required />
            
            <button type="submit">Submit Booking</button>
        </form>
    </div>
    <div id="approved-bookings" class="section">
        <h2>Approved Bookings</h2>
        <p>Your approved bookings will appear here.</p>
    </div>
    <div id="pending-bookings" class="section">
        <h2>Pending Bookings</h2>
        <p>Your pending bookings will appear here.</p>
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

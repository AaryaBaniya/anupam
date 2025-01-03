<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    // Redirect to Sign-In page if the user is not logged in
    header("Location: signin.php");
    exit();
}

include 'connect.php'; // Include your database connection file

// Fetch user details using session
$customer_id = $_SESSION['customer_id']; // Use the correct variable name

// Use prepared statements to prevent SQL injection
$query = "SELECT * FROM customer WHERE customer_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id); // Bind parameter as integer
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    // Redirect to an error page or show a meaningful message
    echo "User not found.";
    exit();
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="time"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .radio-group {
            display: flex;
            align-items: center;
            margin-top: 5px;
        }
        .radio-group label {
            font-weight: normal;
        }
        button {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background-color: #45a049;
        }
        .container {
            width: 30%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 100px;
            margin-bottom: 50px;
        }
        @media (max-width: 600px) {
            .container {
                width: 50%;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
<header>
    <div style="
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        padding: 10px; 
        background-color: #f1f1f1;">
        <h1 style="margin: 0; font-size: 24px;">Welcome, <?php echo htmlspecialchars($user['fullname']); ?>!</h1>
        <a href="logout.php" style="
            text-decoration: none;
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-left: auto; /* Pushes the button to the right */
        ">Log Out</a>
    </div>
</header>
<div class="container">
    <h1>Booking Form</h1>
    <form action="process_booking.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['fullname']); ?>" required />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required />

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required />

        <label>Choose venue to book:</label>
        <div class="radio-group">
            <input type="radio" id="akshyapatra" name="venue" value="Akshyapatra Hall" required />
            <label for="akshyapatra">Akshyapatra Hall</label>

            <input type="radio" id="kalpavrikshya" name="venue" value="Kalpavrikshya Hall" />
            <label for="kalpavrikshya">Kalpavrikshya Hall</label>

            <input type="radio" id="garden" name="venue" value="Garden Hall" />
            <label for="garden">Garden Hall</label>
        </div>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required />

        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required />

        <button type="submit">Submit Booking</button>
    </form>
</div>
</body>
</html>
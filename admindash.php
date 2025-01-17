<?php include 'connect.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin dashboard</title>
    <style>
        .logout-button {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 8px 15px;
            background-color:rgb(85, 215, 38);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .logout-button:hover {
            background-color: #ff4c29;
        }
</style>
</head>

<body>
<h2>Booking Management</h1>
<a href="adminlogout.php" class="logout-button">Log Out</a>
 <table border="1">
        <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Hall Name</th>
                <th>Booking Date</th>
                <th>Booking Time</th>
                <th>Actions</th>
                <th>Created Date and Time</th>
                <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM bookings";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) <= 0) {
            echo "No data found in table.";
        } else {
            $i = 1;
            while ($row = mysqli_fetch_assoc($query)) {
        ?>
                <tr>
                    <td><?php echo $i++ . "."; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['venue']; ?></td>
                    <td><?php echo $row['booking_date']; ?></td>
                    <td><?php echo $row['booking_time']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <a href="approve.php?customer_id=<?php echo $row['customer_id']; ?>">Approve</a>
                        <a href="delete.php?customer_id=<?php echo $row['customer_id']; ?>" onclick="return confirm('Are you sure you want to delete your data?')">Delete</a>
                    </td>
                </tr>
        <?php
            }
        }

        ?>
    </table>
</body>

</html>
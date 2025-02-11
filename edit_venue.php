<?php
// Include the database connection file
include 'connect.php';

// Check if 'id' is set in the URL, and fetch the current venue details
if (isset($_GET['id'])) {
    $venue_id = (int) $_GET['id']; // Convert 'id' to an integer for security

    // SQL query to fetch the venue details by ID
    $sql = "SELECT * FROM venue WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $venue_id); // Bind the ID as an integer
    $stmt->execute();
    $result = $stmt->get_result(); // Get the result set
    $venue = $result->fetch_assoc(); // Fetch the venue details as an associative array
    $stmt->close();
}

// Check if the form was submitted (via POST method)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and assign POST data to variables
    $venue_id = (int) $_POST['id']; // Venue ID (hidden field in the form)
    $venue_name = $conn->real_escape_string($_POST['venue_name']); // Venue name
    $capacity = (int) $_POST['capacity']; // Capacity as an integer
    $description = $conn->real_escape_string($_POST['description']); // Description text
    $image_updated = false; // Flag to track if the image is updated

    // Handle the image upload process
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name']; // Temporary file path
        $imageName = basename($_FILES['image']['name']); // Original file name
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION)); // Extract file extension
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Allowed file types

        // Check if the file extension is valid
        if (in_array($imageExtension, $allowedExtensions)) {
            $uploadDir = 'uploads/'; // Directory to store uploaded images
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
            }

            // Generate a unique file name to prevent overwriting
            $uniqueImageName = uniqid('venue_', true) . '.' . $imageExtension;
            $imagePath = $uploadDir . $uniqueImageName; // Full file path

            // Move the uploaded file to the target directory
            if (move_uploaded_file($imageTmpPath, $imagePath)) {
                $image_updated = true; // Mark image as updated
            } else {
                echo "Failed to upload the image."; // Error handling
            }
        } else {
            echo "Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed."; // Invalid file type
        }
    }

    // Prepare the SQL query to update the venue
    if ($image_updated) {
        // Update all fields, including the image path
        $sql = "UPDATE venue SET name = ?, capacity = ?, description = ?, image_path = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sissi", $venue_name, $capacity, $description, $imagePath, $venue_id);
    } else {
        // Update fields except for the image path
        $sql = "UPDATE venue SET name = ?, capacity = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisi", $venue_name, $capacity, $description, $venue_id);
    }

    // Execute the SQL query
    if ($stmt->execute()) {
        // Redirect to the admin dashboard with a success message
        header("Location: admindash.php?msg=Venue updated successfully!");
        exit;
    } else {
        // Display an error message if the query fails
        echo "Error updating venue: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Venue</title>
    <style>
        /* General styling for the page */
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Header styling */
        h2 {
            color: #eebb5d;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Form styling */
        form {
            background-color: #f9f9f9;
            border: 2px solid #eebb5d;
            border-radius: 8px;
            padding: 20px 30px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Input and button styling */
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        button {
            background-color: #eebb5d;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #d8a54a;
        }

        /* Styling for the current image display */
        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div>
        <h2>Edit Venue</h2>
        <form action="edit_venue.php" method="POST" enctype="multipart/form-data">
            <!-- Hidden input to store the venue ID -->
            <input type="hidden" name="id" value="<?php echo $venue['id']; ?>">

            <!-- Input for venue name -->
            <label for="venue_name">Venue Name:</label>
            <input type="text" name="venue_name" value="<?php echo htmlspecialchars($venue['name']); ?>" required>

            <!-- Input for capacity -->
            <label for="capacity">Capacity:</label>
            <input type="number" name="capacity" value="<?php echo $venue['capacity']; ?>" required>

            <!-- Textarea for description -->
            <label for="description">Description:</label>
            <textarea name="description" required><?php echo htmlspecialchars($venue['description']); ?></textarea>

            <!-- Display the current image -->
            <label for="image">Current Image:</label>
            <?php if (!empty($venue['image_path'])): ?>
                <img src="<?php echo htmlspecialchars($venue['image_path']); ?>" alt="Current Image">
            <?php endif; ?>

            <!-- File input for uploading a new image -->
            <label for="image">Upload New Image :</label>
            <input type="file" name="image" accept="image/*">

            <!-- Submit button -->
            <button type="submit">Update Venue</button>
        </form>
    </div>
</body>
</html>

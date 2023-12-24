<?php
include 'config.php'; // Include the configuration file

session_start(); // Start or resume the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html"); // Redirect to index.html if not logged in
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['profile_picture'])) {
    $username = $_SESSION['username']; // Get username from session or authentication method

    // File properties
    $file_name = $_FILES['profile_picture']['name'];
    $file_tmp = $_FILES['profile_picture']['tmp_name'];
    $file_size = $_FILES['profile_picture']['size'];
    $file_error = $_FILES['profile_picture']['error'];

    // Allowed file types
    $allowed_extensions = array('jpeg', 'jpg', 'png');

    // Get file extension
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Check if the file type is allowed
    if (in_array($file_extension, $allowed_extensions)) {
        // Define upload directory and create if it doesn't exist
        $upload_dir = 'faces/'; // Update this to your desired directory
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // New file name (with unique identifier)
        $new_file_name = uniqid('', true) . '.' . $file_extension;
        $file_destination = $upload_dir . $new_file_name;

        // Resize uploaded image (optional)
        $max_width = 400; // Change as needed
        $max_height = 400; // Change as needed

        list($orig_width, $orig_height) = getimagesize($file_tmp);

        $ratio = $orig_width / $orig_height;

        if ($max_width / $max_height > $ratio) {
            $max_width = $max_height * $ratio;
        } else {
            $max_height = $max_width / $ratio;
        }

        $resized_image = imagecreatetruecolor($max_width, $max_height);

        if ($file_extension === 'jpeg' || $file_extension === 'jpg') {
            $source_image = imagecreatefromjpeg($file_tmp);
        } elseif ($file_extension === 'png') {
            $source_image = imagecreatefrompng($file_tmp);
        }

        imagecopyresampled($resized_image, $source_image, 0, 0, 0, 0, $max_width, $max_height, $orig_width, $orig_height);

        // Save resized image
        if ($file_extension === 'jpeg' || $file_extension === 'jpg') {
            imagejpeg($resized_image, $file_destination);
        } elseif ($file_extension === 'png') {
            imagepng($resized_image, $file_destination);
        }

        imagedestroy($source_image);
        imagedestroy($resized_image);

        // Update the user's profile picture path in the database
        $update_query = "UPDATE users SET profile_picture_path = ? WHERE username = ?";
        if ($stmt = $conn->prepare($update_query)) {
            $stmt->bind_param("ss", $file_destination, $username);
            if ($stmt->execute()) {
                echo "Profile picture uploaded and resized successfully.";
            } else {
                echo "Error updating profile picture path.";
            }
            $stmt->close();
        } else {
            echo "Error in preparing the update statement.";
        }
    } else {
        echo "Only JPEG, JPG, and PNG files are allowed.";
    }
} else {
    echo "Invalid request.";
}
?>

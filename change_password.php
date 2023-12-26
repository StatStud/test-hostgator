<?php
session_start();
include 'config.php'; // Include your database configuration

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username']; // Get username from the session

    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords match
    if ($new_password !== $confirm_password) {
        echo "New passwords do not match.";
        exit();
    }

    // Fetch the user's current password hash from the database
    $query = "SELECT password FROM users WHERE username = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($stored_password);
        $stmt->fetch();
        $stmt->close();

        // Verify the old password matches the stored password
        if (password_verify($old_password, $stored_password)) {
            // Hash the new password before updating
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the user's password in the database
            $update_query = "UPDATE users SET password = ? WHERE username = ?";
            if ($stmt = $conn->prepare($update_query)) {
                $stmt->bind_param("ss", $hashed_password, $username);
                $stmt->execute();
                $stmt->close();
                echo "Password changed successfully!";
            } else {
                echo "Error updating password.";
            }
        } else {
            echo "Incorrect old password.";
        }
    } else {
        echo "Error fetching password.";
    }
}
?>


<form action="" method="POST">
    <label for="old_password">Old Password:</label>
    <input type="password" id="old_password" name="old_password" required><br><br>

    <label for="new_password">New Password:</label>
    <input type="password" id="new_password" name="new_password" required><br><br>

    <label for="confirm_password">Confirm New Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br><br>

    <input type="submit" value="Change Password">
</form>

<?php
include 'config.php'; // Include the configuration file

// Establish a database connection (replace with your credentials)
$conn = new mysqli($servername, $username, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from the registration form
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and execute a SQL query with prepared statements to insert the new user
$query = "INSERT INTO users (username, password) VALUES (?, ?)";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("ss", $username, $hashed_password);
    if ($stmt->execute()) {

        // Update last login time
        $currentDateTime = date("Y-m-d H:i:s");
        $updateQuery = "UPDATE users SET last_login = ? WHERE username = ?";
        if ($updateStmt = $conn->prepare($updateQuery)) {
            $updateStmt->bind_param("ss", $currentDateTime, $username);
            $updateStmt->execute();
            $updateStmt->close();
        }

        echo "Registration successful. You can now <a href='login.html'>log in</a>.";
    } else {
        echo "Registration failed. Please try again later.";
    }
    $stmt->close();
} else {
    echo "Error in preparing the statement.";
}

$conn->close();
?>

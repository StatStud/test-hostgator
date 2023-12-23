<?php

include 'config.php'; // Include the configuration file

// Establish a database connection (replace with your credentials)
$conn = new mysqli($servername, $username, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from the registration form
$username = $_POST['username'];

// Check if the username already exists
$check_query = "SELECT * FROM users WHERE username = ?";
if ($stmt_check = $conn->prepare($check_query)) {
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        http_response_code(400);
        echo "Username already taken. Please choose another username.";
        $stmt_check->close();
        $conn->close();
        exit(); // Stop further execution
    }

    $stmt_check->close();
} else {
    http_response_code(500);
    echo "Error in preparing the statement for username check.";
    $conn->close();
    exit(); // Stop further execution
}
?>
<?php
// Database connection parameters
$servername = "localhost";
$username = "alejahel_demo";
$dbpassword = "%ntRuZ&dn)iE";
$dbname = "alejahel_demo";

// Create a connection to the database
$conn = new mysqli($servername, $username, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and execute a SQL query with prepared statements
$query = "SELECT id, username, password FROM users WHERE username = ?";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $db_username, $db_password);
        $stmt->fetch();

        echo "Input Password: $password<br>";
        echo "Database Password: $db_password<br>";

        // Verify the password
        if (password_verify($password, $db_password)) {
            // Password is correct
            // You can set session variables here to indicate the user is logged in
            session_start();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $db_username;
            echo "Login successful. Redirecting..."; // You can redirect the user to a dashboard page.
        } else {
            // Password is incorrect
            echo "Incorrect password. Please try again.";
        }
    } else {
        // User not found
        echo "User not found.";
    }

    $stmt->close();
} else {
    echo "Error in preparing the statement.";
}

$conn->close();
?>

<?php
// Initialize the session
session_start();

include 'config.php'; // Include the configuration file

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

        // Verify the password
        // password_verify($password, $db_password)
        // $password == $db_password
        if (password_verify($password, $db_password)) {
            // Password is correct

            // Update last login time
            $currentDateTime = date("Y-m-d H:i:s");
            $updateQuery = "UPDATE users SET last_login = ? WHERE username = ?";
            if ($updateStmt = $conn->prepare($updateQuery)) {
                $updateStmt->bind_param("ss", $currentDateTime, $username);
                $updateStmt->execute();
                $updateStmt->close();
            }

            // You can set session variables here to indicate the user is logged in
            session_start();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $db_username;
            // Redirect to the user dashboard page
            header("Location: index.php");
            exit();
        } else {
            // Password is incorrect
            // echo "Incorrect password. Please try again.";
            $_SESSION['login_error'] = "Incorrect password. Please try again.";
            header("Location: login.html"); // Redirect back to the login page
            exit();            
        }
        $stmt->close();
    } else {
        // User not found
        // echo "User not found.";
        $_SESSION['login_error'] = "Error in preparing the statement.";
        header("Location: login.html"); // Redirect back to the login page
        exit();
    }

    $stmt->close();
} else {
    echo "Error in preparing the statement.";
}

$conn->close();
?>

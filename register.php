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

// Check if the username already exists
$check_query = "SELECT * FROM users WHERE username = ?";
if ($stmt_check = $conn->prepare($check_query)) {
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        echo "Username already taken. Please choose another username.";
        $stmt_check->close();
        $conn->close();
        exit(); // Stop further execution
    }

    $stmt_check->close();
} else {
    echo "Error in preparing the statement for username check.";
    $conn->close();
    exit(); // Stop further execution
}




// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and execute a SQL query with prepared statements to insert the new user
$query = "INSERT INTO users (username, password) VALUES (?, ?)";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("ss", $username, $hashed_password);
    if ($stmt->execute()) {
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

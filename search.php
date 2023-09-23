<?php
// Database connection parameters
$servername = "localhost";
$username = "alejahel_demo";
$dbpassword = "%ntRuZ&dn)iE";
$dbname = "alejahel_demo";

// Create a connection to the database
$conn = new mysqli($servername, $username, $dbpassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the minimum and maximum prices from the form
$minPrice = $_POST["minPrice"];
$maxPrice = $_POST["maxPrice"];

// Construct the SQL query
$sql = "SELECT * FROM menu_items WHERE price BETWEEN $minPrice AND $maxPrice";

// Execute the query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output the data from the query
    while ($row = $result->fetch_assoc()) {
        echo "Product Name: " . $row["item_name"] . " - Price: $" . $row["price"] . "<br>";
    }
} else {
    echo "No products found within the specified price range.";
}

// Close the database connection
$conn->close();
?>

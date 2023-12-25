<?php
session_start(); // Start or resume the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html"); // Redirect to index.html if not logged in
    exit();
}

include 'config.php'; // Include the configuration file

// Establish a database connection (replace with your credentials)
$conn = new mysqli($servername, $username, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the profile picture path for the logged-in user
$username = $_SESSION['username'];
$query = "SELECT profile_picture_path FROM users WHERE username = ?";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $username);
    $stmt->execute();
    $stmt->bind_result($profile_picture_path);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Error in preparing the statement.";
}
// $profile_picture_path = "faces/dan.png"

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Web App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Nav bar -->
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#info">Info</a></li>
        </ul>
    </nav>


  <div class="profile-container" style="margin-top: 75px">
    <div class="profile-picture">
      <!-- User's profile picture -->
      <img src="<?php echo $profile_picture_path; ?>" alt="Profile Picture" style="width: 200px; height: 200px; margin: 20px; border-radius: 50%;">
    </div>
    <div class="profile-details" style="margin: 20px;">
      <!-- Generic details -->
      <h2><?php echo $_SESSION['username']; ?></h2>
      <p><?php echo $query ?></p>
      <p><?php echo $profile_picture_path ?></p>
      <p>Email: user@example.com</p>
      <!-- Add more generic details here -->
    </div>
    <div class="advanced-settings" style="margin: 20px;">
      <!-- Tabs for advanced settings -->
      <ul class="tabs">
        <li><a href="#tab1">Settings 1</a></li>
        <li><a href="#tab2">Settings 2</a></li>
        <!-- Add more tabs as needed -->
      </ul>
      <div class="tab-content" id="tab1" style="margin: 20px;">
        <!-- Content for Settings 1 -->
        <p>Advanced settings content 1 goes here.</p>
      </div>
      <div class="tab-content" id="tab2" style="margin: 20px;">
        <!-- Content for Settings 2 -->
        <p>Advanced settings content 2 goes here.</p>
      </div>
      <!-- Add more tab content as needed -->
    </div>
  </div>
  <!-- Add your scripts or JavaScript links here -->
  <!-- <script src="scripts.js"></script> -->
</body>
</html>

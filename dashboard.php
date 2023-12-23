<?php
session_start(); // Start or resume the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html"); // Redirect to index.html if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Profile</title>
  <!-- Add your CSS links or stylesheets here -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="profile-container">
    <div class="profile-picture">
      <!-- User's profile picture -->
      <img src="path/to/profile_picture.jpg" alt="Profile Picture">
    </div>
    <div class="profile-details">
      <!-- Generic details -->
      <h2>User's Name</h2>
      <p>Email: user@example.com</p>
      <!-- Add more generic details here -->
    </div>
    <div class="advanced-settings">
      <!-- Tabs for advanced settings -->
      <ul class="tabs">
        <li><a href="#tab1">Settings 1</a></li>
        <li><a href="#tab2">Settings 2</a></li>
        <!-- Add more tabs as needed -->
      </ul>
      <div class="tab-content" id="tab1">
        <!-- Content for Settings 1 -->
        <p>Advanced settings content 1 goes here.</p>
      </div>
      <div class="tab-content" id="tab2">
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

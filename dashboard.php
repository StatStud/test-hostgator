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
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($profile_picture_path);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Error in preparing the statement.";
}


// Handling form submission for modifying settings
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the user ID from the session
  $username = $_SESSION['username'];

  // Update user settings
  if (isset($_POST['distance']) && isset($_POST['languages']) && isset($_POST['hourly_rate'])) {
      $distance = $_POST['distance'];
      $languages = implode(", ", $_POST['languages']); // Convert array to comma-separated string
      $hourly_rate = $_POST['hourly_rate'];

      // Update the user settings in the database
      echo "here are the results for username:" . $username;
      $update_query = "UPDATE users SET distance = ?, languages = ?, hourly_rate = ? WHERE username = ?";
      if ($stmt = $conn->prepare($update_query)) {
          $stmt->bind_param("issi", $distance, $languages, $hourly_rate, $username);
          $stmt->execute();
          $stmt->close();
          // Optionally, you can add a success message here
      } else {
          echo "Error updating user settings.";
      }
  }
}

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


<!-- Form for modifying settings -->
  <div class="advanced-settings" style="margin: 20px;">
      <h3>Modify Settings</h3>
      <form action="" method="POST">
          <label for="distance">Distance:</label>
          <input type="number" id="distance" name="distance" placeholder="Enter distance"><br><br>

          <label for="languages">Languages:</label>
          <select id="languages" name="languages[]" multiple>
              <option value="English">English</option>
              <option value="Spanish">Spanish</option>
          </select><br><br>

          <label for="hourly_rate">Hourly Rate:</label>
          <input type="number" id="hourly_rate" name="hourly_rate" placeholder="Enter hourly rate"><br><br>

          <input type="submit" value="Save Changes">
      </form>
  </div>



  <!-- Add your scripts or JavaScript links here -->
  <!-- <script src="scripts.js"></script> -->
</body>
</html>

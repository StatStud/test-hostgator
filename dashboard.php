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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // if we're only modifying the user's attributes
  if (isset($_POST['modify_attributes'])) {
      // Get the user ID from the session
      //$username = $_SESSION['username'];

      // Initialize variables
      $update_query = "UPDATE users SET ";
      $params = array();
      $types = '';

      // Check and build the query for each field
      if (isset($_POST['distance']) && $_POST['distance'] !== '') {
          $update_query .= "distance = ?, ";
          $params[] = $_POST['distance'];
          $types .= 'i';
      }

      if (isset($_POST['languages'])) {
          $languages = implode(", ", $_POST['languages']);
          $update_query .= "languages = ?, ";
          $params[] = $languages;
          $types .= 's';
      }

      if (isset($_POST['hourly_rate']) && $_POST['hourly_rate'] !== '') {
          $update_query .= "hourly_rate = ?, ";
          $params[] = $_POST['hourly_rate'];
          $types .= 'i';
      }

      if (isset($_POST['bio']) && $_POST['bio'] !== '') {
        $update_query .= "bio = ?, ";
        $params[] = $_POST['bio'];
        $types .= 's';
      }

      // Remove trailing comma and space from the query
      $update_query = rtrim($update_query, ", ");

      // Complete the query
      $update_query .= " WHERE username = ?";

      // Add username parameter and its type
      $params[] = $username;
      $types .= 's';

      // Prepare and execute the statement
      if ($stmt = $conn->prepare($update_query)) {
          $stmt->bind_param($types, ...$params);
          $stmt->execute();
          $stmt->close();
          // Optionally, add a success message here
      } else {
          echo "Error updating user settings.";
      }
  }

  // if we're changing the user's password
  if (isset($_POST['change_password'])) {

      //$username = $_SESSION['username']; // Get username from the session

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
      <h2> Welcome, <?php echo $_SESSION['username']; ?></h2>
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

<!-- New container for displaying user attributes -->
<div class="user-attributes" style="margin: 20px; width: 500px">
    <h3>User Attributes</h3>
    <?php
    $reveal_query = "SELECT distance, languages, hourly_rate, bio, verified FROM users WHERE username = ?";
    if ($stmt = $conn->prepare($reveal_query)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($distance, $languages, $hourly_rate, $bio, $verified);
        $stmt->fetch();
        $stmt->close();
        ?>
        <p> <strong>Distance:</strong> <?php echo $distance; ?></p>
        <p> <strong>Languages:</strong> <?php echo $languages; ?></p>
        <p> <strong>Hourly Rate:</strong> <?php echo $hourly_rate; ?></p>
        <p> <strong>Bio:</strong> <?php echo $bio; ?></p>
        <p> <strong>Verified:</strong> <?php echo $verified == 0 ? "Unverified" : "Verified"; ?></p>
        <?php
    } else {
        echo "Error fetching user attributes.";
    }
    ?>
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

          <label for="bio">Bio:</label>
          <textarea id="bio" name="bio" placeholder="Enter your bio"></textarea><br><br>


          <input type="submit" name="modify_attributes" value="Save Changes">
      </form>
  </div>


<!-- Password change section -->
<div class="pwd-change" style="margin: 20px;">
      <h3>Change Password</h3>
      <form action="" method="POST">
        <label for="old_password">Old Password:</label>
        <input type="password" id="old_password" name="old_password" placeholder="Enter old password"><br><br>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" placeholder="Enter new password"><br><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password"><br><br>

        <!-- Submit button for changing password -->
        <input type="submit" name="change_password" value="Change Password">
      </form>
  </div>




  <!-- Add your scripts or JavaScript links here -->
  <!-- <script src="scripts.js"></script> -->
</body>
</html>

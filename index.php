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
            <?php
            // Start the session
            session_start();

            // Check if the user is logged in
            if (isset($_SESSION['user_id'])) {
                // User is logged in, display the "Profile" tab
                echo '<li><a href="dashboard.php">Profile</a></li>';
                echo '<li><a href="logout.php">Logout</a></li>';
            } else {
                echo '<li><a href="login.html">Login</a></li>';
                echo '<li><a href="register.html">Sign Up</a></li>';
            }
            ?>
            <li><a href="#about">About Us</a></li>
            <li><a href="#info">Info</a></li>
        </ul>
    </nav>

    <!-- Image spot -->
    <div class="image-spot" style="margin-top: 60px;">
        <img src="faces/cover.png">
    </div>

    <!-- Filter options -->
    <div class="filters mt-4">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="zip-code">Zip Code:</label>
                <input type="text" class="form-control" id="zip-code">
            </div>
            <div class="form-group col-md-4">
                <label for="distance">Distance:</label>
                <select id="distance" class="form-control">
                    <option value="5">Within 5 miles</option>
                    <option value="10">Within 10 miles</option>
                    <option value="15">Within 15 miles</option>
                    <option value="30">Within 30 miles</option>
                    <option value="50">Within 50 miles</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="verified">Verified:</label>
                <select id="verified" class="form-control">
                    <option value="all">All</option>
                    <option value="true">Verified Only</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="hourly-rate">Hourly Rate:</label>
                <input type="range" class="form-control-range" id="hourly-rate-min" min="0" max="500">
                <input type="range" class="form-control-range" id="hourly-rate-max" min="0" max="500">
                <span id="hourly-rate-values">$0 - $500</span>
            </div>
            <div class="form-group col-md-4">
                <label for="languages">Languages:</label>
                <select id="languages" class="form-control" multiple>
                    <optgroup label="Primary Languages">
                        <option value="English" selected>English</option>
                        <option value="Spanish">Spanish</option>
                    </optgroup>
                    <optgroup label="More">
                        <!-- Additional languages will be added dynamically -->
                    </optgroup>
                </select>
            </div>
        </div>
    </div>



<!-- Profiles section -->
<div class="profiles">
    <!-- Profile 1 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/ann.png">
        </div>
        <div class="profile-description">
            <p class="profile-name""> <strong>Ann</strong> </p>
            <p> Industry leader with 5 years of experience </p>
        </div>
    </div>

    <!-- Profile 2 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/dave.png">
        </div>
        <div class="profile-description">
            <p>Senior Cleaning Consultant at WaterWorks Inc. Senior Cleaning Consultant at WaterWorks Inc. Senior Cleaning Consultant at WaterWorks Inc. Senior Cleaning Consultant at WaterWorks Inc.</p>
            
        </div>
    </div>

    <!-- Profile 3 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/steve.png">
        </div>
        <div class="profile-description">
            <p> Cleaning Consultant at WaterWorks Inc.</p>
        </div>
    </div>

    <!-- Profile 4 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/sonya.png">
        </div>
        <div class="profile-description">
            <p> Staff Cleaning and operations manager. </p>
        </div>
    
    </div>


    <!-- Profile 5 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/dan.png">
        </div>
        <div class="profile-description">
            <p> Staff Cleaning and operations manager. </p>
        </div>
    </div>

    <!-- Profile 6 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/jen.png">
        </div>
        <div class="profile-description">
            <p> Staff Cleaning and operations manager. </p>
        </div>
    </div>

    <!-- Profile 7 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/scott.png">
        </div>
        <div class="profile-description">
            <p> Staff Cleaning and operations manager. </p>
        </div>
    </div>

    <!-- Profile 8 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/lauren.png">
        </div>
        <div class="profile-description">
            <p> Staff Cleaning and operations manager. </p>
        </div>
    </div>

    <!-- Profile 9 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/kendra.png">
        </div>
        <div class="profile-description">
            <p> Staff Cleaning and operations manager. </p>
        </div>
    </div>

    <!-- Profile 10 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/tyrone.png">
        </div>
        <div class="profile-description">
            <p> Staff Cleaning and operations manager. </p>
        </div>
    </div>


    <!-- Profile 11 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/sofia.png">
        </div>
        <div class="profile-description">
            <p> Staff Cleaning and operations manager. </p>
        </div>
    </div>


    <!-- Profile 12 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/james.png">
        </div>
        <div class="profile-description">
            <p> Staff Cleaning and operations manager. </p>
        </div>
    </div>

</div>

    <!-- Next Page button -->
    <div class="next-page-button">
        <button>Next Page</button>
    </div>
    <footer>
    </footer>
    <script src="script.js"></script>
</body>
</html>

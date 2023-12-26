<?php
// Start the session
session_start();
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
            <?php
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

            <div class="form-group col-md-4">
            <label>&nbsp;</label>
            <div class="input-group">
                    <div class="input-group-append">
                        <button class="btn btn-primary rounded-right" type="button">
                            <i class="fas fa-search text-white"></i> Search
                        </button>
                    </div>
                </div>
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
            <p class="profile-name"> <strong>Ann</strong> </p>
            <p style="margin: 0px;"> <i>Staff Cleaner</i> </p>
            <p> Hi, I'm Ann! I'm thrilled to be part of the team, diving into the world of home cleaning. My goal is to make every corner sparkle and ensure that your space feels brand new! </p>
        </div>
    </div>

    <!-- Profile 2 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/dave.png">
        </div>
        <div class="profile-description">
            <p class="profile-name"> <strong>Dave</strong> </p>
            <p style="margin: 0px;"> <i>Operations Manager</i> </p>
            <p>Hey there, I'm Dave! I orchestrate our cleaning operations to ensure everything runs seamlessly. My passion lies in delivering top-notch service and creating a positive experience for everyone involved.</p>
        </div>
    </div>

    <!-- Profile 3 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/steve.png">
        </div>
        <div class="profile-description">
            <p class="profile-name"> <strong>Steve</strong> </p>
            <p style="margin: 0px;"> <i>Business Development Consultant</i> </p>
            <p> Hi, I'm Steve! I leverage industry insights to drive our business growth. My goal is to expand our reach and enhance our position in the home cleaning market.</p>
        </div>
    </div>

    <!-- Profile 4 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/sonya.png">
        </div>
        <div class="profile-description">
            <p class="profile-name"> <strong>Sonya</strong> </p>
            <p style="margin: 0px;"> <i>Marketing Coordinator</i> </p>
            <p> Hey there, I'm Sonya! I lead our marketing efforts to showcase our amazing services. Through storytelling, I make sure our brand resonates with potential clients. </p>
        </div>
    
    </div>


    <!-- Profile 5 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/dan.png">
        </div>
        <div class="profile-description">
            <p class="profile-name"> <strong>Dan</strong> </p>
            <p style="margin: 0px;"> <i>Associate Cleaner</i> </p>
            <p> Hola, I'm Dan! With over ten years of experience, I've perfected the art of transforming spaces. I take pride in my meticulous work and love seeing the smiles on clients' faces after a thorough clean. </p>
        </div>
    </div>

    <!-- Profile 6 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/jen.png">
        </div>
        <div class="profile-description">
            <p class="profile-name"> <strong>Jen</strong> </p>
            <p style="margin: 0px;"> <i>Cleaning Supervisor</i> </p>
            <p> Hey there, I'm Jen! I oversee our teams to guarantee that every home gets the five-star treatment. I focus on training and quality to maintain our high standards. </p>
        </div>
    </div>

    <!-- Profile 7 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/scott.png">
        </div>
        <div class="profile-description">
            <p class="profile-name"> <strong>Scott</strong> </p>
            <p style="margin: 0px;"> <i>Cleaning Technician</i> </p>
            <p> Hola, I'm Scott! I'm your go-to guy for specialized cleaning needs. From carpets to unique surfaces, I bring expertise and a friendly approach to every job. </p>
        </div>
    </div>

    <!-- Profile 8 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/lauren.png">
        </div>
        <div class="profile-description">
            <p class="profile-name"> <strong>Lauren</strong> </p>
            <p style="margin: 0px;"> <i>Quality Assurance Specialist</i> </p>
            <p> Hi, I'm Lauren! I meticulously inspect every nook and cranny to ensure our high standards are met. Your satisfaction with our service is my top priority.</p>
        </div>
    </div>

    <!-- Profile 9 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/kendra.png">
        </div>
        <div class="profile-description">
            <p class="profile-name"> <strong>Kendra</strong> </p>
            <p style="margin: 0px;"> <i>Cleaning Specialist</i> </p>
            <p> Hi, I'm Kendra! I specialize in eco-friendly cleaning methods. My aim is to keep your space sparkling clean while being kind to the environment. </p>
        </div>
    </div>

    <!-- Profile 10 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/tyrone.png">
        </div>
        <div class="profile-description">
            <p class="profile-name"> <strong>Ty</strong> </p>
            <p style="margin: 0px;"> <i>Training Coordinator</i> </p>
            <p> Hi, I'm Ty! I design and implement our training programs. I'm passionate about empowering our team with the skills needed to deliver exceptional service. </p>
        </div>
    </div>


    <!-- Profile 11 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/sofia.png">
        </div>
        <div class="profile-description">
            <p class="profile-name"> <strong>Sofia</strong> </p>
            <p style="margin: 0px;"> <i>Health and Safety Consultant</i> </p>
            <p> Hello, I'm Sofia! I bring my expertise in health and safety to ensure our cleaning practices prioritize your well-being while maintaining top-notch standards. </p>
        </div>
    </div>


    <!-- Profile 12 -->
    <div class="profile">
        <div class="profile-picture">
            <img src="faces/james.png">
        </div>
        <div class="profile-description">
            <p class="profile-name"> <strong>James</strong> </p>
            <p style="margin: 0px;"> <i>Customer Service Representative</i> </p>
            <p> Hello, I'm James! I'm here to make sure your experience with us is fantastic. Whether it's scheduling or resolving concerns, I'm dedicated to providing top-notch customer support. </p>
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

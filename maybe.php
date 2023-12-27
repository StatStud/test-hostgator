<!DOCTYPE html>
<html>
<head>
    <title>E-commerce users</title>
    <style>
        /* Style for product grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .product-card {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        /* Style for pagination */
        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            margin: 0 4px;
        }

        .pagination a.active {
            background-color: #f2f2f2;
        }

        /* Style for next page button */
        .next-page {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            display: grid;
            background-color: #0b0f19;
            place-items: center;
            font-family: 'Poppins', sans-serif;
        }

        .double-slider-box {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 10px;
            max-width: 20rem;
        }

        h3.range-title {
            margin-bottom: 4rem;
        }

        .range-slider {
            position: relative;
            width: 100%;
            height: 5px;
            margin: 30px 0;
            background-color: #8a8a8a;
        }

        .slider-track {
            height: 100%;
            position: absolute;
            background-color: #fe696a;
        }

        .range-slider input {
            position: absolute;
            width: 100%;
            background: none;
            pointer-events: none;
            top: 50%;
            transform: translateY(-50%);
            appearance: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            height: 25px;
            width: 25px;
            border-radius: 50%;
            border: 3px solid #FFF;
            background: #FFF;
            pointer-events: auto;
            appearance: none;
            cursor: pointer;
            box-shadow: 0 .125rem .5625rem -0.125rem rgba(0, 0, 0, .25);
        }

        input[type="range"]::-moz-range-thumb {
            height: 25px;
            width: 25px;
            border-radius: 50%;
            border: 3px solid #FFF;
            background: #FFF;
            pointer-events: auto;
            -moz-appearance: none;
            cursor: pointer;
            box-shadow: 0 .125rem .5625rem -0.125rem rgba(0, 0, 0, .25);
        }


        .input-box {
            display: flex;
        }

        .min-box,
        .max-box {
            width: 50%;
        }

        .min-box {
            padding-right: .5rem;
            margin-right: .5rem;
        }

        .input-wrap {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            width: 100%;
        }
    </style>

    <script>
        window.onload = function () {
        slideMin();
        slideMax();
        };

        const minVal = document.querySelector(".min-val");
        const maxVal = document.querySelector(".max-val");
        const priceInputMin = document.querySelector(".min-input");
        const priceInputMax = document.querySelector(".max-input");
        const minTooltip = document.querySelector(".min-tooltip");
        const maxTooltip = document.querySelector(".max-tooltip");
        const minGap = 1500;
        const range = document.querySelector(".slider-track");
        const sliderMinValue = parseInt(minVal.min);
        const sliderMaxValue = parseInt(maxVal.max);

        function slideMin() {
        let gap = parseInt(maxVal.value) - parseInt(minVal.value);
        }

        function slideMax() {
        let gap = parseInt(maxVal.value) - parseInt(minVal.value);
        }

        function setArea() {
        range.style.left = `${
            ((minVal.value - sliderMinValue) / (sliderMaxValue - sliderMinValue)) * 100
        }%`;

        range.style.left = (minVal.value / sliderMaxValue) * 100 + "%";
        minTooltip.style.left = (minVal.value / sliderMaxValue) * 100 + "%";
        range.style.right = `${
            100 -
            ((maxVal.value - sliderMinValue) / (sliderMaxValue - sliderMinValue)) * 100
        }%`;
        maxTooltip.style.right = 100 - (maxVal.value / sliderMaxValue) * 100 + "%";
        }

        function setMinInput() {
        let minPrice = parseInt(priceInputMin.value);
        }

        function setMaxInput() {
        let maxPrice = parseInt(priceInputMax.value);
        }
    </script>
</head>
<body>

<div class="filter-bar">
    <!-- Filter form -->
    <form action="" method="GET">
        <div class="double-slider-box">
            <h3 class="range-title">Price Range Slider</h3>
            <div class="range-slider">

            </div>
            <div class="input-box">

            </div>
        </div>


        <label for="distance">Filter by distance:</label>
        <select name="distance" id="distance">
            <option value="">Select Distance</option>
            <option value="1">Within 1 mile</option>
            <option value="5">Within 5 miles</option>
            <option value="10">Within 10 miles</option>
            <!-- Add more distance options as needed -->
        </select>
        
        <input type="submit" value="Filter">
    </form>
</div>

<div class="product-grid">
    <?php
    // Database connection and initial setup
    include 'config.php'; // Include the configuration file

    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $results_per_page = 12; // Number of results per page
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number, default is 1

    // Calculate starting point for fetching users based on current page
    $start_index = ($current_page - 1) * $results_per_page;

    // Set default sorting by 'last_login' when no filters are applied
    $sort_by = 'last_login'; // Default sorting
    $order = 'DESC'; // Default sorting order

    // Fetch users from the database
    $sql = "SELECT * FROM users";

    // Apply filters if provided
    if((isset($_GET['hourly_rate']) && !empty($_GET['hourly_rate'])) || (isset($_GET['distance']) && !empty($_GET['distance']))) {
        $sql .= " WHERE";

        // Hourly rate filter
        if(isset($_GET['hourly_rate']) && !empty($_GET['hourly_rate'])) {
            $hourly_rate = $_GET['hourly_rate'];
            $sql .= " hourly_rate BETWEEN 0 AND $hourly_rate";
        }

        // Distance filter
        if(isset($_GET['distance']) && !empty($_GET['distance'])) {
            $distance = $_GET['distance'];
            if(isset($_GET['hourly_rate']) && !empty($_GET['hourly_rate'])) {
                $sql .= " AND distance <= $distance";
            } else {
                $sql .= " distance <= $distance";
            }
        }
    }

    $sql .= " ORDER BY $sort_by $order LIMIT $start_index, $results_per_page"; // Add ORDER BY clause

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            // Display each product in a card format
            echo '<div class="product-card">';
            echo '<h3>'.$row['username'].'</h3>';
            echo '<p>'.$row['bio'].'</p>';
            echo '<p>hourly_rate: $'.$row['hourly_rate'].'</p>';
            echo '<p>Distance: '.$row['distance'].'</p>';
            echo '<img src="'.$row['profile_picture_path'].'" alt="'.$row['username'].'" width="100">';
            echo '</div>';
        }

        // Pagination with preserved filters
        $sql = "SELECT COUNT(*) AS total FROM users";
        if((isset($_GET['hourly_rate']) && !empty($_GET['hourly_rate'])) || (isset($_GET['distance']) && !empty($_GET['distance']))) {
            $sql .= " WHERE";

            // Hourly rate filter
            if(isset($_GET['hourly_rate']) && !empty($_GET['hourly_rate'])) {
                $hourly_rate = $_GET['hourly_rate'];
                $sql .= " hourly_rate BETWEEN 0 AND $hourly_rate";
            }

            // Distance filter
            if(isset($_GET['distance']) && !empty($_GET['distance'])) {
                $distance = $_GET['distance'];
                if(isset($_GET['hourly_rate']) && !empty($_GET['hourly_rate'])) {
                    $sql .= " AND distance <= $distance";
                } else {
                    $sql .= " distance <= $distance";
                }
            }
        }

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total_pages = ceil($row['total'] / $results_per_page);

        echo '<div class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<a href="?page='.$i.'&hourly_rate=' . $_GET['hourly_rate'] . '&distance=' . $_GET['distance'] . '"';
            if ($i == $current_page) {
                echo ' class="active"';
            }
            echo '>'.$i.'</a>';
        }
        echo '</div>';
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</div>

<a href="#top" class="next-page">Next Page</a>

</body>
</html>

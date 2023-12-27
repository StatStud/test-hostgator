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
    </style>
</head>
<body>

<div class="filter-bar">
    <!-- Filter form -->
    <form action="" method="GET">
        <label for="hourly_rate">Filter by hourly_rate:</label>
        <input type="number" username="hourly_rate" id="hourly_rate">
        <!-- Other filter options go here -->
        <input type="submit" value="Filter">
    </form>
</div>

<div class="product-grid">
    <?php
    // Database connection and initial setup
    include 'config.php'; // Include the configuration file

    $results_per_page = 12; // Number of results per page
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number, default is 1

    // Calculate starting point for fetching users based on current page
    $start_index = ($current_page - 1) * $results_per_page;

    // Set default sorting by 'last_login' when no filters are applied
    $sort_by = isset($_GET['hourly_rate']) && !empty($_GET['hourly_rate']) ? 'hourly_rate' : 'last_login';
    $order = $sort_by === 'last_login' ? 'DESC' : 'ASC';

    // Fetch users from the database
    $sql = "SELECT * FROM users";

    // Apply filters if provided
    if(isset($_GET['hourly_rate']) && !empty($_GET['hourly_rate'])) {
        $hourly_rate = $_GET['hourly_rate'];
        $sql .= " WHERE hourly_rate <= $hourly_rate"; // Example: filtering users with hourly_rate less than or equal to the provided value
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

        // Pagination
        $sql = "SELECT COUNT(*) AS total FROM users";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total_pages = ceil($row['total'] / $results_per_page);

        echo '<div class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<a href="?page='.$i.'"';
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

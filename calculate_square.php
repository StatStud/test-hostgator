<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the number from the form
    $number = $_POST["number"];
    
    // Execute the Python script to calculate the square
    $output = shell_exec("python square.py $number");

    // Print the result
    //echo "<h2>The square of $number is $output</h2>";
    echo json_encode(array('result' => $output));
}
?>


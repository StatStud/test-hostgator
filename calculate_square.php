<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // run_python_script.php
    $num = $_GET['num']; // Get input number from AJAX request
    $command = "python square.py $num";
    $output = shell_exec($command);
    echo json_encode(array('result' => $output));
}
?>


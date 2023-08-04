<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tubesiot";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve parking status from the database
$sql = "SELECT * FROM datasensor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $parking1 = $row['sensorSatu'];
    $parking2 = $row['SensorDua'];
    $parking3 = $row['SensorTiga'];

    // Create an associative array for the parking status
    $status = array(
        'parking1' => $parking1,
        'parking2' => $parking2,
        'parking3' => $parking3
    );

    // Convert the array to JSON format
    $json_status = json_encode($status);

    // Send the JSON response
    header('Content-Type: application/json');
    echo $json_status;
} else {
    // No parking status found
    echo "No parking status found";
}

// Close the database connection
$conn->close();
?>

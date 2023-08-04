<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tubesiot";

// Get the data from the ESP8266 board
$sensor = $_GET['status'];
$sensor2 = $_GET['status2'];
$sensor3 = $_GET['status3'];

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement to insert the data into the table
$sql = "UPDATE datasensor SET sensorSatu = '$sensor'";
$sql2 = "UPDATE datasensor SET sensorDua = '$sensor2'";
$sql3 = "UPDATE datasensor SET sensorTiga = '$sensor3'";

// Execute the SQL statement
if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE) {
    echo "Data saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>

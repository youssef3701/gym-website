<?php

// Database connectivity page 

$host = "localhost";
$username = "root";
$password = "";
$dbname = "gym_members_data";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Display an error message and stop the script if connection fails
    die("Connection failed: " . $conn->connect_error);
} else {
 //   echo "Connected successfully to the database!";
}

?>




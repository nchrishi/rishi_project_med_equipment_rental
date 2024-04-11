<?php
$servername = "localhost:3308";
$username = "root"; // default username for XAMPP
$password = ""; // default password for XAMPP
$dbname = "med_equipment_rental";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
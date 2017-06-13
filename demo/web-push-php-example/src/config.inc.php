<?php
$servername = "localhost";
$username = "root";
$password = "webpush";
$database = "notifications";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>

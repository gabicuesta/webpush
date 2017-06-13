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
}else{
    echo "Connected successfully";

    $sql = "INSERT INTO customers (name,logo,active) VALUES ('Cliente1','logo.png','1')";
    echo("<br/>");
    echo($sql);

    if ($conn->query($sql) === TRUE) {
        echo "<br/>New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

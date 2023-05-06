<?php
header("Access-Control-Allow-Origin: *");
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Retrieve the base64 encoded image data from the POST request
$imgData = $_POST['imgData'];

// Set the folder where you want to save the images
// $folder = 'images/';

// Generate a unique filename for the image and prepend the folder path
$filename = 'images/'.uniqid() . '.png';

// Save the image to the server
$file = fopen($filename, 'wb');
fwrite($file, base64_decode($imgData));
fclose($file);

// Insert the filename into the MySQL table 'requests'
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_shoes";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO requests (filename) VALUES ('$filename')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

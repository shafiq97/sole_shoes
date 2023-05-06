<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();

// Database configuration
$host = "localhost";
$user = "root";
$password = "";
$dbname = "db_shoes";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete variation if variation_id is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['variation_id'])) {
    $variation_id = $_POST['variation_id'];
    $sql = "DELETE FROM variation WHERE variation_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $variation_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = '<div class="alert alert-success">Variation deleted successfully</div>';
    } else {
        $_SESSION['message'] = '<div class="alert alert-danger">Failed to delete variation</div>';
    }

    $stmt->close();
}

// Redirect to variation list page
header("Location: variation_list.php");
exit;
?>

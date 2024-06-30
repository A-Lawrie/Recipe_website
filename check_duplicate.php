<?php
// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get email and username from AJAX request
$email = $_POST['email'];
$username = $_POST['username'];

// Query to check if email or username already exists
$sql = "SELECT * FROM your_table_name WHERE email = '$email' OR username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Duplicate found
    echo 'exists';
} else {
    // No duplicate found
    echo 'not_exists';
}

$conn->close();
?>

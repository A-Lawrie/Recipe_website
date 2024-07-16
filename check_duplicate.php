<?php
include('db-connect.php');

$email = $_POST['email'];
$username = $_POST['username'];

$sql = "SELECT * FROM your_table_name WHERE email = '$email' OR username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo 'exists';
} else {
    echo 'not_exists';
}

$conn->close();
?>

<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'recipe_website';

$mysqli = new mysqli($servername, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $profile_photo = $_POST['profile_photo'];
    $role = $_POST['role'];

    $stmt = $mysqli->prepare("UPDATE users SET name=?, email=?, username=?, profile_photo=?, role=? WHERE id=?");
    $stmt->bind_param("sssssi", $name, $email, $username, $profile_photo, $role, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();

    // Redirect back to the view users page
    header("Location: view-users.php");
    exit();
}
?>

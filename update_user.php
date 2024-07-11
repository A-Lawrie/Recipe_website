<?php

include('db-connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $profile_photo = $_POST['profile_photo'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET name=?, email=?, username=?, profile_photo=?, role=? WHERE id=?");
    $stmt->bind_param("sssssi", $name, $email, $username, $profile_photo, $role, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: admin/view-users.php");
    exit();
}
?>

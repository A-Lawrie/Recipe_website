<?php
session_start();

    include('db-connect.php');

    if (!isset($_SESSION['username'])) {
        echo '<script type="text/javascript">';
        echo 'alert("You need to be logged in to submit a recipe.");';
        echo 'window.location.href = "sign-in.php";';
        echo '</script>';
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST["name"];
        $owner = $_POST["owner"];
        $ingredients = $_POST["ingredients"];
        $steps = $_POST["steps"];
        $category = $_POST["category"];

        $file_path = '';
    if (isset($_FILES['food-photo']) && $_FILES['food-photo']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file = $_FILES['food-photo'];
        $target_file = $target_dir . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            echo "The file " . htmlspecialchars(basename($file['name'])) . " has been uploaded.<br>";
            $file_path = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    } else {
        echo "No file uploaded or there was an error with the upload.<br>";
    }
    }

    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    if (empty($user_id)) {
        echo "User ID not found.<br>";
        exit();
    }

    

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $sql = "INSERT INTO recipes (FoodName, OwnerName, Ingredients, Steps, Category, food_photo, id)
            VALUES(?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $name, $owner, $ingredients, $steps, $category, $file_path, $user_id);
    if ($stmt->execute()) {
        echo '<script type="text/javascript">';
        echo 'alert("New recipe created successfully");';
        echo 'window.location.href = "index.html";';
        echo '</script>';
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }
        $stmt->close();

    mysqli_close($conn);
?>
<?php

    include('db-connect.php');
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST["name"];
        $email = $_POST["mail"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirm = $_POST["confirm"];
        $role = $_POST["role"];

        $file_path = '';
    if (isset($_FILES['profile-photo']) && $_FILES['profile-photo']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file = $_FILES['profile-photo'];
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

    //Function to prevent malicious attact by sanitizing the input
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //insert data into the table
    $sql = "INSERT INTO users (name, email, username, password, profile_photo, role) VALUES ('$name', '$email', '$username', '$password', '$file_path', '$role')";

    if(mysqli_query($conn, $sql)){
        echo '<script type="text/javascript">';
        echo 'alert("New user created successfully");';
        echo 'window.location.href = "sign-up.php";'; 
        echo '</script>';
    } else {
        echo "Error " . $sql. "<br>".mysqli_error($conn);
    }

    mysqli_close($conn);
?>





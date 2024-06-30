<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database ='recipe_website';

    //create the connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
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

    //Function to prevent malicious attact by sanitizing the input
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $sql = "INSERT INTO recipes (FoodName, OwnerName, Ingredients, Steps, Category, food_photo)
    VALUES('$name', '$owner', '$ingredients', '$steps', '$category', '$file_path')";

if(mysqli_query($conn, $sql)){
    echo '<script type="text/javascript">';
    echo 'alert("New recipe created successfully");';
    echo 'window.location.href = "index.html";'; // Redirect after alert
    echo '</script>';
} else {
    echo "Error " . $sql. "<br>".mysqli_error($conn);
}

    mysqli_close($conn);
?>
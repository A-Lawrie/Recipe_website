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

    // Retrieve form data
    $category = $_POST["category"];

    //add to table
    $sql = "INSERT INTO category (category) VALUES ('$category')";

    if(mysqli_query($conn, $sql)){
        echo '<script type="text/javascript">';
        echo 'alert("New category created successfully");';
        echo 'window.location.href = "index.html";'; // Redirect after alert
        echo '</script>';
    } else {
        echo "Error " . $sql. "<br>".mysqli_error($conn);
    }

    mysqli_close($conn);
?>

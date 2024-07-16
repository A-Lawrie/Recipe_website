<?php
    include('db-connect.php');

    $category = $_POST["category"];

    $sql = "INSERT INTO category (category) VALUES ('$category')";

    if(mysqli_query($conn, $sql)){
        echo '<script type="text/javascript">';
        echo 'alert("New category created successfully");';
        echo 'window.location.href = "index.html";';
        echo '</script>';
    } else {
        echo "Error " . $sql. "<br>".mysqli_error($conn);
    }

    mysqli_close($conn);
?>

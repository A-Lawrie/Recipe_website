<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database ='recipe_website';

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
    }

    // Fetch categories from database
    $sql = "SELECT category FROM category";
    $result = mysqli_query($conn, $sql);

    // Display categories as options
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row["category"] . '">' . $row["category"] . '</option>';
        }
    }

    mysqli_close($conn);
?>

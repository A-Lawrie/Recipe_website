<?php
    include('db-connect.php');

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

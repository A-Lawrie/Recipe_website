<?php
include('db-connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare SQL statement to delete a record
    $stmt = $mysqli->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();

    // Redirect back to the view users page
    header("Location: view-users.php");
    exit();
} else {
    echo "Invalid request";
}
?>

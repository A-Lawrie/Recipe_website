<?php
session_start();

include('db-connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $user = stripcslashes($user);  
    $pass = stripcslashes($pass);  
    $user = mysqli_real_escape_string($conn, $user);  
    $pass = mysqli_real_escape_string($conn, $pass); 

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $users = $result->fetch_assoc();
        $_SESSION['user_id'] = $users['id'];
        $_SESSION['username'] = $users['username'];
        $_SESSION['role'] = $users['role'];

        if ($users['role'] == 'Owner' || $users['role'] == 2){
            header("Location: recipe-owner.php");
        } elseif ($users['role'] == 'user' || $users['role'] == 1 || $users['role'] == 'User'){
            header("Location: index.html");
        } else {
            echo "<script>alert('Login failed. Invalid username or password. Please sign up if you do not have an account.');</script>";
            echo "<script>window.location.href = 'sign-up.php';</script>";
        }
        exit();

        $stmt->close();
    }
}
$conn->close();
?>


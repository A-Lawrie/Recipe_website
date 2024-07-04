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
        $_SESSION['email'] = $users['email'];

    // Redirect to recipe-owner.php
    header("Location: recipe-owner.php");
    exit();
    } else {
        echo "<script>alert('Login failed. Invalid username or password. Please sign up if you do not have an account.');</script>";
        echo "<script>window.location.href = 'sign-up.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>


<?php
session_start(); // Start the session

include('db-connect.php');

$username_email = $_POST['username/email'];
$password = $_POST['password'];

// Strip slashes and escape special characters to prevent from mysqli injection  
$username_email = stripcslashes($username_email);  
$password = stripcslashes($password);  
$username_email = mysqli_real_escape_string($conn, $username_email);  
$password = mysqli_real_escape_string($conn, $password);  

// Use prepared statements for better security
$stmt = $conn->prepare("SELECT id, username, email FROM users WHERE (username = ? OR email = ?) AND password = ?");
$stmt->bind_param("sss", $username_email, $username_email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User exists, fetch user data
    $user = $result->fetch_assoc();
    
    // Store user data in session variables
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];

    // Redirect to recipe-owner.php
    header("Location: recipe-owner.php");
    exit();
} else {
    // User doesn't exist, show alert and redirect to sign-up.php
    echo "<script>alert('Login failed. Invalid username or password. Please sign up if you do not have an account.');</script>";
    echo "<script>window.location.href = 'sign-up.php';</script>";
}

$stmt->close();
$conn->close();
?>

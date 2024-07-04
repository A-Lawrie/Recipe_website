<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "recipe_website";
 
$conn = new MySQLi($host, $username, $password, $dbname);
 
if(!$conn){
    die("Database Connection failed. Error: ". $conn->error);
}
?>
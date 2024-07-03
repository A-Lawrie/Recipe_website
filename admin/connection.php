<?php

$conn = "";

try {
	$servername = "localhost:3306";
	$dbname = "recipe_website";
	$username = "root";
	$password = "";

	$conn = new PDO(
		"mysql:host=$servername; dbname=recipe_website",
		$username, $password
	);
	
$conn->setAttribute(PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

?>

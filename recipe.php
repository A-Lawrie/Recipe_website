<?php
require 'config.php';

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    if (isset($_GET['RecipeID'])) {
        $recipe_id = $_GET['RecipeID'];

        $stmt = $pdo->prepare('SELECT * FROM recipes WHERE RecipeID = ?');
        $stmt->execute([$recipe_id]);
        $recipe = $stmt->fetch();

        if (!$recipe) {
            echo 'Recipe not found.';
            die();
        }
    } else {
        echo 'No recipe ID provided.';
        die();
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($recipe['FoodName']); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/recipes.css">
</head>
<body>
    <div class="reipe-container">
        <div class="card">
            <h1><?php echo htmlspecialchars($recipe['FoodName']); ?></h1>
            <img src="<?php echo htmlspecialchars($recipe['food_photo']); ?>" alt="<?php echo htmlspecialchars($recipe['FoodName']); ?>">

            <p><strong>Owner Name:</strong> <?php echo htmlspecialchars($recipe['OwnerName']); ?></p>
            <p><strong>Ingredients:</strong> <?php echo htmlspecialchars($recipe['Ingredients']); ?></p>
            <p><strong>Steps:</strong> <?php echo htmlspecialchars($recipe['Steps']); ?></p>
            <p><strong>Category:</strong> <?php echo htmlspecialchars($recipe['Category']); ?></p>
        </div>
    </div>
</body>
</html>
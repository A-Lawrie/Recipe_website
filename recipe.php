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
    <?php include 'nav.html'; ?>
    <div class="recipe-container">
        <div class="card">
            <h1><?php echo htmlspecialchars($recipe['FoodName']); ?></h1>
            <img src="<?php echo htmlspecialchars($recipe['food_photo']); ?>" alt="<?php echo htmlspecialchars($recipe['FoodName']); ?>">

            <p><strong>Owner Name:</strong></p>
            <p><?php echo htmlspecialchars($recipe['OwnerName']); ?></p>
            <p><strong>Ingredients:</strong></p>
            <p><?php echo htmlspecialchars($recipe['Ingredients']); ?></p>
            <p><strong>Steps:</strong></p>
            <p><?php echo htmlspecialchars($recipe['Steps']); ?></p>
            <p><strong>Category:</strong></p>
            <p><?php echo htmlspecialchars($recipe['Category']); ?></p>
            <p><strong>Uploaded at:</strong></p>
            <p><?php echo htmlspecialchars($recipe['CreatedAt']);?></p>
            <span><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000"><path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Zm0-108q96-86 158-147.5t98-107q36-45.5 50-81t14-70.5q0-60-40-100t-100-40q-47 0-87 26.5T518-680h-76q-15-41-55-67.5T300-774q-60 0-100 40t-40 100q0 35 14 70.5t50 81q36 45.5 98 107T480-228Zm0-273Z"/></svg></span>
        </div>
    </div>
</body>
</html>
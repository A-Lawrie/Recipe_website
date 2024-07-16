<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in.php");
    exit();
}

$recipe_id = isset($_GET['RecipeID']) ? (int)$_GET['RecipeID'] : 0;

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Fetch the recipe details
    $stmt = $pdo->prepare('SELECT * FROM recipes WHERE RecipeID = :recipe_id AND id = :user_id');
    $stmt->execute(['recipe_id' => $recipe_id, 'user_id' => $_SESSION['user_id']]);
    $recipe = $stmt->fetch();

    if (!$recipe) {
        echo "Recipe not found.";
        echo "<br>Debug Info: RecipeID: $recipe_id, UserID: {$_SESSION['user_id']}";
        exit();
    }

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}

require_once('db-connect.php'); 

$category_qry = $conn->query("SELECT * FROM `category` ORDER BY `Category` ASC");
$category = $category_qry->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
    <link rel="stylesheet" href="styles/forms.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="main">
        <h2>Edit Recipe</h2>
        <form class="recipe-add" action="update-recipe.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="recipe_id" value="<?php echo $recipe_id; ?>">
            
            <label for="food_name">Food Name:</label>
            <input type="text" id="food_name" name="food_name" value="<?php echo htmlspecialchars($recipe['FoodName'] ?? ''); ?>" required>

            <label for="food_photo">Upload New Food Photo:</label>
            <label for="file-upload" class="custom-file-upload">
                <img id="current-photo" class="image-upload" src="<?php echo htmlspecialchars($recipe['food_photo']); ?>" alt="">
                <input type="file" id="food-photo" name="food-photo" accept="image/*" />
            </label>
            
            <label for="ingredients">Ingredients:</label>
            <textarea class="textbox" id="ingredients" name="ingredients" required><?php echo htmlspecialchars($recipe['Ingredients'] ?? ''); ?></textarea>
            
            <label for="instructions">Steps:</label>
            <textarea class="textbox" id="steps" name="steps" required><?php echo htmlspecialchars($recipe['Steps'] ?? ''); ?></textarea>

            <label for="category">Category:</label>
           
            <select required id="category" name="category">
            <option value="">Select Category</option>
            <?php foreach ($category as $row): ?>
                <option value="<?php echo htmlspecialchars($row['CategoryID']); ?>" <?php echo ($row['CategoryID'] == $recipe['Category']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row['Category']); ?>
                </option>
            <?php endforeach; ?>
        </select>


            <input class="Submit-btn" type="submit" value="Update Recipe">
        </form>
    </div>
</body>
</html>

<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in.php");
    exit();
}

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $recipe_id = isset($_POST['recipe_id']) ? (int)$_POST['recipe_id'] : 0;

        if ($recipe_id === 0) {
            echo "No recipe ID provided.";
            exit();
        }

        $food_name = $_POST['food_name'];
        $ingredients = $_POST['ingredients'];
        $steps = $_POST['steps'];
        $category = $_POST['category'];
        $food_photo = ''; 

        // Handle photo upload
        if (!empty($_FILES['food-photo']['name'])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["food-photo"]["name"]);
            if (move_uploaded_file($_FILES["food-photo"]["tmp_name"], $target_file)) {
                $food_photo = $target_file; 
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            // Use existing photo if no new photo is uploaded
            $stmt = $pdo->prepare('SELECT food_photo FROM recipes WHERE RecipeID = :recipe_id');
            $stmt->execute(['recipe_id' => $recipe_id]);
            $current_recipe = $stmt->fetch();

            if ($current_recipe) {
                $food_photo = $current_recipe['food_photo'];
            }
        }

        // Update the recipe
        $update_stmt = $pdo->prepare('UPDATE recipes SET FoodName = :food_name, food_photo = :food_photo, Ingredients = :ingredients, Steps = :steps, Category = :category WHERE RecipeID = :recipe_id AND id = :user_id');
        $result = $update_stmt->execute([
            'food_name' => $food_name,
            'food_photo' => $food_photo,
            'ingredients' => $ingredients,
            'steps' => $steps,
            'category' => $category,
            'recipe_id' => $recipe_id,
            'user_id' => $_SESSION['user_id']
        ]);

        if ($result) {
            echo '<script type="text/javascript">';
            echo 'alert("Recipe updated successfully");';
            echo 'window.location.href = "recipe-owner.php";';
            echo '</script>';
        } else {
            $errorInfo = $update_stmt->errorInfo();
            echo "Failed to update recipe. Error: " . $errorInfo[2];
        }
    }

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}
?>

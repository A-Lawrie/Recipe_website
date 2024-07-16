<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in.php");
    exit();
}

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();
    
    if (!$user) {
        echo "User not found.";
        exit();
    }

    $stmt = $pdo->prepare('SELECT RecipeID, food_photo, FoodName, CreatedAt FROM recipes WHERE id = :id ORDER BY CreatedAt DESC');
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $recipes = $stmt->fetchAll();

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
    <title>Owner page</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="landing-owner">
        <div class="sidebar-owner">
            <div class="owner-profile">
                <img src="<?php echo htmlspecialchars($user['profile_photo']); ?>" alt="<?php echo htmlspecialchars($user['name']); ?>">
                <div class="names">
                    <h4><?php echo htmlspecialchars($user['name']); ?></h4>
                    <h4 style="color: gray; font-weight: 500;"><?php echo htmlspecialchars($user['username']); ?></h4>
                </div>
            </div>
            <ul>
                <li><a href="index.php"><i><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000"><path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/></svg></i>Home</a></li>
                <li><a href="add-recipe.php"><i><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg></i>Add Recipe</a></li>
                <li><a href="recipes.php"><i><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000"><path d="M320-240h320v-80H320v80Zm0-160h320v-80H320v80ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-520v-200H240v640h480v-440H520ZM240-800v200-200 640-640Z"/></svg></i>View Recipes</a></li>
                <li><a href="#"><i><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000"><path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z"/></svg></i>Edit Profile</a></li>
                <li><a href="logout.php"><i><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg></i>Log Out</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2>Recent Recipes</h2>
            <div class="owner-recipe-cards">
                <?php foreach ($recipes as $recipe): ?>
                        <div class="owner-recipe-card">
                        <a href="edit-recipe.php?RecipeID=<?php echo htmlspecialchars($recipe['RecipeID']); ?>" class="recipe-link">
                            <img src="<?php echo htmlspecialchars($recipe['food_photo']); ?>" alt="<?php echo htmlspecialchars($recipe['FoodName']); ?>"></a>

                            <a href="edit-recipe.php?RecipeID=<?php echo htmlspecialchars($recipe['RecipeID']); ?>" class="recipe-link">
                                <div class="recipe-details">
                                <h4><?php echo htmlspecialchars($recipe['FoodName']); ?></h4>
                                <p>Created on: <?php echo htmlspecialchars($recipe['CreatedAt']); ?></p>
                            </div></a>
                        </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
require_once('db-connect.php'); 

$category_qry = $conn->query("SELECT * FROM `category` ORDER BY `Category` ASC");
$category = $category_qry->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>

    <link rel="stylesheet" href="styles/forms.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav>
        <div id="logo" class="logo">
            <a href="index.html"><h1>CHEF LAWRIE</h1></a>
        </div>
        <div class="navigations">
            <a href="#">Recipes</a>
            <input class="add-recipe" type="submit" value="Add a Recipe">
        </div>
    </nav>
    <div class="main">
        <form class="recipe-add" action="submit-recipe.php" method="post" enctype="multipart/form-data">
            <label for="name">Food name</label>
            <input required type="text" name="name" id="name" placeholder="E.g. Pancakes">
            <!-- input to select food photo -->
            <label for="file-upload" class="custom-file-upload">
                <img class="image-upload" src="img/camera.png" alt="">
                <input required type="file" id="food-photo" name="food-photo" accept="image/*" />
                <script src="script.js"></script>
            </label>
            <label for="owner">Recipe Owner Name</label>
            <input required type="text" id="owner" name="owner" placeholder=" E.g. John Doe">
            <label for="ingredients">Ingredients</label>
            <textarea required class="textbox" name="ingredients" id="ingredients" placeholder="
1 cup all-purpose flour
1 tablespoon sugar
2 teaspoons baking powder
1/2 teaspoon salt"></textarea>
            <label for="steps">Steps</label>
            <textarea required class="textbox" name="steps" id="steps" placeholder="
In a medium bowl, whisk together the flour, sugar, baking powder and salt.
In another bowl, whisk together the egg, milk, melted butter and vanilla extract."></textarea>
            <label for="category">Category</label>
            <select required id="category" name="category">
                <option value="">Select one</option>
                <?php
                    foreach($category as $row):
                        echo "<option value='{$row['id']}'>{$row['Category']}</option>";
                    endforeach;
                ?>
            </select>
            <input class="Submit-btn" type="submit" value="Add a Recipe">
        </form>
    </div>

    <script>
        // JavaScript function to handle input of food photo
        function previewFile() {
            var preview = document.querySelector('img'); // selects the query named img
            var file    = document.querySelector('input[type=file]').files[0]; // same as here
            var reader  = new FileReader();
        
            reader.onloadend = function () {
              preview.src = reader.result;
            }
        
            if (file) {
              reader.readAsDataURL(file); // reads the data as a URL
            } else {
              preview.src = "";
            }
        }
    </script>  
</body>
</html>

<?php $conn->close(); ?>

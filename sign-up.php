<?php
require_once('db-connect.php');

$users_qry = $conn->query("SELECT * FROM `user_types` ORDER BY `type_name` ASC");
$users = $users_qry->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css'>
    <link rel="stylesheet" href="styles/forms.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>
<body>
    <nav>
        <div id="logo" class="logo">
            <a href="index.html"><h1>CHEF LAWRIE</h1></a>
        </div>
    </nav>

    <div class="main">
    <form id="signup-form" method="post" action="register.php" enctype="multipart/form-data">
            <h4>Create an account</h4>
            <label for="name">Full name</label>
            <input required type="text" name="name" id="name" placeholder="Enter your full name">
            <label for="mail">Email</label>
            <input required type="email" name="mail" id="mail" placeholder="your@example.com">
            <label for="username">Username</label>
            <input required type="text" name="username" id="username" placeholder="Choose a username">
            <label for="password">Password</label>
            <input required type="password" name="password" id="password" placeholder="Create a password" autocomplete="new-password">
            <label for="confirm">Confirm password</label>
            <input required type="password" name="confirm" id="confirm" placeholder="Confirm your password" autocomplete="new-password">
            <!--input to select profile photo-->
            <label for="file-upload" class="custom-file-upload">
                <img class="image-upload" src="img/camera.png" alt="">
                <input required type="file" id="profile-photo" name="profile-photo" accept="image/*" />
                <script src="script.js"></script>
            </label>
            <!--select input to choose role-->
            <label for="role">Choose a role</label>
            <select required id="role" name="role">
            <option value="">Select one</option>
            <?php
                foreach($users as $row):
                  echo "<option value='{$row['id']}'>{$row['type_name']}</option>";
                endforeach;
            ?>
            </select>


            <input class="Submit-btn" type="submit" value="Sign up with email">
                <div class="or">
                    <hr><p>Or sign up with</p><hr>
                </div>
                <button class="continue-with">Continue with Google</button>
                <button class="continue-with">Continue with Apple</button>
                <a href="sign-in.html">Already a member? Sign in now</a>

        </form>
    </div>
 

    <script>
      //Javascript functions to handle input of profile photo
        function previewFile() {
          var preview = document.querySelector('img'); // selects the query named img
          var file    = document.querySelector('input[type=file]').files[0]; // sames as here
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

        //Function to validate the passwords
        document.getElementById('signup-form').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            var confirm = document.getElementById('confirm').value;
            var passwordPattern = /(?=.*[A-Z])(?=.*[a-z])(?=.*[\W]).{8,}/;
            
            if (!password.match(passwordPattern)) {
                alert('Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one special character.');
                event.preventDefault(); // Prevent form submission
            } else if (password !== confirm) {
                alert('Passwords do not match.');
                event.preventDefault(); // Prevent form submission
            }
        });
      </script>
</body>
</html>


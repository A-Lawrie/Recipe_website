<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css'>
    <link rel="stylesheet" href="styles/forms.css">
</head>
<body>
    <?php session_start(); ?>
    <nav>
        <div id="logo" class="logo">
            <a href="index.html"><h1>CHEF LAWRIE</h1></a>
        </div>
    </nav>
    
    <div class="main">
        <form action="authentication.php" method="POST">
            <h4>Sign in to your account</h4>
            <label for="username/email">Enter your Username</label>
            <input type="text" name="username" id="username" placeholder="Username" required>
            <label for="password"> Enter yourPassword</label>
            <input type="password" name="password" id="password" placeholder="Password" autocomplete="current-password" required>
            <div class="checkbox-container">
                <input type="checkbox" id="keep-signed-in" name="keep_signed_in" />
                <label for="keep-signed-in">Keep me signed in</label>
            </div>
            <button class="Submit-btn" type="submit">Sign in</button>

            <div class="or">
                <hr><p>or</p><hr>
            </div>
            <button class="continue-with">Continue with Facebook</button>
            <button class="continue-with">Continue with Google</button>
            <button class="continue-with">Continue with Apple</button>
            <a href="sign-up.html">Not a member? Sign up now</a>
        </form>
    </div>
</body>
</html>

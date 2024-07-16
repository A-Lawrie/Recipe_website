<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="toggle.js"></script>
</head>
<body>
    <?php include 'nav.html' ; ?>
    <section class="above-fold">
        <main class="landing">
            <div class="landing-text">
                <span>WELCOME</span>
                <h2>Get recipes <br> for any occasion</h2>
                <p>Welcome to our recipe hub! Discover delicious recipes from around the world and easily bookmark your favorites for later. Start exploring now and turn your kitchen into a culinary adventure!</p>
                <p>Join us today to:</p>
                <ul>
                    <li class="special">Get to cook like Gordon Ramsay</li>
                    <li>Bookmark your favorite recipes for later</li>
                    <li>Interact with fellow foodies</li>
                    <li>Share the recipes you love</li>
                    <li>Get help where you are stuck</li>
                </ul>
                <div class="buttons">
                    <a href="sign-up.php"><button class="sign-up">Sign up</button></a>
                    <a href="sign-in.php"><button class="sign-in">Sign in</button></a>
                </div>
            </div>
            <div class="landing-image">
                <img src="img/ramsay.jpg" alt="">
            </div>
        </main>
    </section>
    <section id="about" class="about-us">
        <h1>WHY CHOOSE US</h1>
        <div class="why-us">
            <div class="column-1">
                <h2>DELICIOUS EXPERTISE</h2>
                <p>Indulge in culinary excellence with our team of seasoned chefs and food enthusiasts. With years of experience crafting delectable dishes, we guarantee recipes that will tantalize your taste buds and elevate your cooking skills.</p>
          
            </div>
          
            <div class="column-2">
                <h2>CREATIVE FLAIR IN THE KITCHEN</h2>
                <p>Experience the artistry of cooking like never before. Our recipes aren't just about taste; they're about creativity and innovation. From classic comfort foods to avant-garde creations, our culinary masterpieces will inspire you to unleash your inner chef.</p>
          
            </div>
          
          
            <div class="column-3">
              <h2>TIME SAVING DELIVERY</h2>
              <p>Say goodbye to endless hours spent scouring the internet for recipes. With our user-friendly platform and curated collections, you'll have access to a diverse range of dishes right at your fingertips. Get cooking quickly and efficiently, without sacrificing quality or flavor.</p>
          
          </div>
        </div>
</section>

    <script>
        function showSidebar(){
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = 'flex'
        }
        function hideSidebar(){
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = 'none'
        }
    </script>
</body>
</html>
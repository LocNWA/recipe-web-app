<?php
include('db_connection.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Retrieve user profile information
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $profile = $result->fetch_assoc();
} else {
    // Handle the case where the user profile doesn't exist
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.8">
    <meta http:equiv="X-UA-Compatible" content="IE-edge">
    <link rel="stylesheet" href="assets/CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Loc's Recipes</title>
</head>

<body>
    <header>
        <div class="logo">Loc's Recipes</div>
        <div class="nav-bar">
            <ul>
                <li><a href="chefhome.php">Home</a></li>
                <li><a href="recipes.php">All Recipes</a></li>
                <li><a href="favrecipes.php">Favorite Recipes</a></li>
                <li><a style='color:#D2D0C3;' href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>
    <div class="hero">
        <div class="content">
            <p style='color:gold; '>Welcome, <?php echo $profile['username']; ?>!</p>
            <h4>Spark Your Taste Buds</h4>
            <h1>Discover Taste Sensations</h1>
            <h3>Elevate Your Cooking Game</h3>
        </div>
        <div class="search">
            <form action="search_recipe.php" method="GET">
                <input type="text" id="searchInput" name="search_term" placeholder="Search recipes">
                <button type="submit" id="searchButton">Search</button>
            </form>
        </div>
    </div>

    <!--Add Section Part-->

    <section class="about">
        <h2>About Us</h2>
        <div class="main">
            <img src="assets/images/about.jpg" alt="">
            <div class="about-text">
                <p>Welcome to our website, where culinary inspiration meets delicious creations! Whether you're a
                    seasoned chef or a passionate home cook, we are here to ignite your taste buds and guide you on a
                    delightful culinary journey. Our extensive collection of recipes covers a wide range of cuisines,
                    from comforting classics to innovative fusion dishes. each recipe is thoughtfully crated, tested,
                    and presented with step-by-step instructions, ensuring that even the novice cook can crete
                    extraordinary meals. We believe that cooking is an art from that brings people together, and our
                    goal is to empower you to explore your culinary creativity and make every meal a masterpeice. So
                    come in, explore our diverse recipe collection, and let's embark on a delightful gastromic adventure
                    together</p>
            </div>
        </div>
    </section>
    <!------------contact section-------------------------->
    <section class="contact">
        <div class="contact-info">
            <h2>Contact Information</h2>
            <p><strong>Address:</strong> LD Street, Locville, Ghana</p>
            <p><strong>Phone:</strong> +233242223631</p>
            <p><strong>Email:</strong> info@locrecipes.com</p>
        </div>
        <div class="contact-form">
            <h2>Contact Form</h2>
            <form>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                <label for="message">Message:</label>
                <textarea name="message" id="message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </section>
    <footer>
        <div class="social-icons">
            <a href="#" class="social-icon"> <i class="fab fa-facebook"></i> </a>
            <a href="#" class="social-icon"> <i class="fab fa-twitter"></i> </a>
            <a href="#" class="social-icon"> <i class="fab fa-instagram"></i> </a>
        </div>
        <h5>CopyRight © 2024 By Loc's Recipes </h5>
    </footer>

    <script src="script.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Recipes</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <!-- Include Remix Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="http://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="usingAjax.js"></script>

</head>
<body>
    <a href="filter_ingredients.php">Filter by ingredient</a>
    <div class="search">
        <form action="search_recipe.php" method="GET">
            <input type="text" id="searchInput" name="search_term" placeholder="Search recipes">
            <button type="submit" id="searchButton">Search</button>
        </form>
    </div>

    <?php
    include('db_connection.php');

    // Fetch recipes with average ratings from the database
    $sql = "SELECT recipes.id, recipes.title, recipes.prep_time, recipes.cooking_time, recipes.media_upload, AVG(ratings.rating) AS average_rating
            FROM recipes
            LEFT JOIN ratings ON recipes.id = ratings.recipe_id
            GROUP BY recipes.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='recipe'>";
            echo "<h2>" . $row["title"] . "</h2>";
            echo "<p>Prep Time: " . $row["prep_time"] . " minutes</p>";
            echo "<p>Cooking Time: " . $row["cooking_time"] . " minutes</p>";
            echo "<p>Average Rating: " . round($row["average_rating"], 1) . "</p>";
            echo "<div class='rating-stars' data-rating='" . round($row["average_rating"]) . "'></div>";
            echo "<img src='" . $row["media_upload"] . "' alt='" . $row["title"] . "'><br>";
            echo "<button onclick='favoriteRecipe(" . $row["id"] . ")'>Favorite</button>";
            echo "<button onclick='rateRecipe(" . $row["id"] . ")'>Rate</button>";
            echo "<a href='recipe_details.php?id=" . $row["id"] . "'>View Details</a>";

            // Social media sharing buttons with remix icons
            $recipeTitle = urlencode($row["title"]);
            $recipeUrl = urlencode("http://localhost/php/recipe-web-app/recipes.php/recipe_details.php?id=" . $row["id"]);
            echo "<div class='social-media-buttons'>";
            echo "<a href='https://www.facebook.com/sharer/sharer.php?u=$recipeUrl' target='_blank'><i class='ri-facebook-fill'></i></a>";
            echo "<a href='https://twitter.com/intent/tweet?url=$recipeUrl&text=$recipeTitle' target='_blank'><i class='ri-twitter-fill'></i></a>";
            echo "<a href='https://pinterest.com/pin/create/button/?url=$recipeUrl&description=$recipeTitle' target='_blank'><i class='ri-pinterest-fill'></i></a>";
            echo "</div>";

            echo "<hr>";
            echo "</div>";
        }
    } else {
        echo "No recipes found.";
    }

    $conn->close();
    ?>

<script>
    function favoriteRecipe(recipeId) {
        // Send an AJAX request to mark the recipe as favorite
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "favorite_recipe.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log("Recipe favorited:", recipeId);
            }
        };
        xhr.send("recipe_id=" + recipeId);
    }

    function rateRecipe(recipeId) {
        // Send an AJAX request to submit the rating for the recipe
        var rating = prompt("Please enter your rating (1-5):");
        if (rating !== null && rating !== "" && !isNaN(rating) && rating >= 1 && rating <= 5) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "rate_recipe.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log("Rating for recipe:", recipeId, "Rating:", rating);
                }
            };
            xhr.send("recipe_id=" + recipeId + "&rating=" + rating);
        } else {
            alert("Please enter a valid rating (1-5).");
        }
    }

    // Function to generate star ratings
    function generateStarRating(container, rating) {
        var stars = '';
        for (var i = 1; i <= 5; i++) {
            if (i <= rating) {
                stars += '<i class="fas fa-star"></i>';
            } else {
                stars += '<i class="far fa-star"></i>';
            }
        }
        container.innerHTML = stars;
    }

    // Generate star ratings for each recipe
    var ratingContainers = document.querySelectorAll('.rating-stars');
    ratingContainers.forEach(function(container) {
        var rating = container.getAttribute('data-rating');
        generateStarRating(container, rating);
    });
</script>

</body>
</html>

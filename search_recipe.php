<?php
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Sanitize the search term
    $search_term = mysqli_real_escape_string($conn, $_GET["search_term"]);

    // Prepare and execute the SQL query using prepared statements
    $sql = "SELECT id, title, prep_time, cooking_time, instructions, media_upload FROM recipes WHERE title LIKE ?";
    $stmt = $conn->prepare($sql);
    $search_param = "%$search_term%";
    $stmt->bind_param("s", $search_param);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Display search results
        while ($recipe = $result->fetch_assoc()) {
            // Sanitize output
            $title = htmlspecialchars($recipe['title']);
            $prep_time = htmlspecialchars($recipe['prep_time']);
            $cooking_time = htmlspecialchars($recipe['cooking_time']);
            $instructions = htmlspecialchars($recipe['instructions']);
            $media_upload = htmlspecialchars($recipe['media_upload']);
            $recipe_id = $recipe['id'];

            echo "<div class='recipe'>";
            echo "<h2>$title</h2>";
            echo "<p><strong>Prep Time:</strong> $prep_time minutes</p>";
            echo "<p><strong>Cooking Time:</strong> $cooking_time minutes</p>";
            echo "<p><strong>Instructions:</strong> $instructions</p>";
            echo "<p><strong>Media:</strong> <img src='$media_upload' alt='$title'></p>";
            echo "<a href='recipe_details.php?id=$recipe_id'>View Details</a><hr>";    
            echo "</div>";
        }
    } else {
        echo "No recipes found.";
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
</body>
</html>


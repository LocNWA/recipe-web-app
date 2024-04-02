<?php
include('db_connection.php');

// Fetch recipes from the database
$sql = "SELECT id, title, prep_time, cooking_time, media_upload FROM recipes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h2>" . $row["title"] . "</h2>";
        echo "<p>Prep Time: " . $row["prep_time"] . " minutes</p>";
        echo "<p>Cooking Time: " . $row["cooking_time"] . " minutes</p>";
        echo "<img src='" . $row["media_upload"] . "' alt='" . $row["title"] . "'><br>";
        echo "<a href='recipe_details.php?id=" . $row["id"] . "'>View Details</a><hr>";
    }
} else {
    echo "No recipes found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Recipes</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
</body>
</html>

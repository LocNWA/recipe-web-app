<?php
include('db_connection.php');

// Get recipe ID from the URL parameter
if (isset($_GET['id'])) {
    $recipe_id = $_GET['id'];

    // Fetch recipe details from the database
    $sql = "SELECT * FROM recipes WHERE id = $recipe_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h2>" . $row["title"] . "</h2>";
        echo "<p>Prep Time: " . $row["prep_time"] . " minutes</p>";
        echo "<p>Cooking Time: " . $row["cooking_time"] . " minutes</p>";
        echo "<p>Instructions: " . $row["instructions"] . "</p>";
        echo "<p>Ingredients:</p>";

        // Fetch and display ingredients
        $ingredients_sql = "SELECT ingredient_name, quantity FROM ingredients WHERE recipe_id = $recipe_id";
        $ingredients_result = $conn->query($ingredients_sql);

        if ($ingredients_result->num_rows > 0) {
            while ($ingredient = $ingredients_result->fetch_assoc()) {
                echo "<p>" . $ingredient["quantity"] . " " . $ingredient["ingredient_name"] . "</p>";
            }
        } else {
            echo "No ingredients found.";
        }
    } else {
        echo "Recipe not found.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Details</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
</body>
</html>

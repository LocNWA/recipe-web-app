<?php
include('db_connection.php');
session_start(); // Start the session to access the chef's ID

// Check if the chef is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: chef_login.php");
    exit();
}

// Get the chef's ID from the session
$chef_id = $_SESSION['user_id'];

// Fetch recipes published by the chef from the database
$sql = "SELECT id, title, prep_time, cooking_time, media_upload FROM recipes WHERE chef_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $chef_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Display the published recipes
    while ($recipe = $result->fetch_assoc()) {
        echo "<div class='recipe'>";
        echo "<h2>" . htmlspecialchars($recipe['title']) . "</h2>";
        echo "<p><strong>Prep Time:</strong> " . htmlspecialchars($recipe['prep_time']) . " minutes</p>";
        echo "<p><strong>Cooking Time:</strong> " . htmlspecialchars($recipe['cooking_time']) . " minutes</p>";
        echo "<img src='" . htmlspecialchars($recipe['media_upload']) . "' alt='" . htmlspecialchars($recipe['title']) . "'><br>";
        echo "<a href='edit_recipe.php?id=" . $recipe['id'] . "'>Edit</a> | ";
        echo "<a href='delete_recipe.php?id=" . $recipe['id'] . "'>Delete</a>";
        echo "<hr>";
        echo "</div>";
    }
} else {
    echo "No recipes found.";
}

$stmt->close();
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

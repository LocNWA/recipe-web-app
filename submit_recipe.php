<?php
// Include database connection file
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST["title"];
    $instructions = $_POST["instructions"];
    $prep_time = $_POST["prep_time"];
    $cooking_time = $_POST["cooking_time"];
    $media_upload = $_POST["media_upload"];
    // Add more fields as needed

    // Insert new recipe into the database
    $sql = "INSERT INTO recipes (title, instructions, prep_time, cooking_time, media_upload) VALUES ('$title', '$instructions', '$prep_time', '$cooking_time', '$media_upload')";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Add Recipe</title>
</head>
<body>
    <h2>Add Recipe</h2>
    <form action="add_recipe.php" method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>
        <label for="instructions">Instructions:</label><br>
        <textarea id="instructions" name="instructions" required></textarea><br><br>
        <label for="prep_time">Prep Time (minutes):</label><br>
        <input type="number" id="prep_time" name="prep_time" required><br><br>
        <label for="cooking_time">Cooking Time (minutes):</label><br>
        <input type="number" id="cooking_time" name="cooking_time" required><br><br>
        <label for="media_upload">Media Upload:</label><br>
        <input type="file" id="media_upload" name="media_upload" accept="image/*"><br><br>
        <!-- Add more fields as needed -->
        <button type="submit">Add Recipe</button>
    </form>
</body>
</html>

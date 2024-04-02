<?php
// Include database connection file
include('db_connection.php');

// Check if recipe ID is provided in the URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Fetch recipe details from the database
    $sql = "SELECT * FROM recipes WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST["title"];
    $instructions = $_POST["instructions"];
    $prep_time = $_POST["prep_time"];
    $cooking_time = $_POST["cooking_time"];
    $media_upload = $_POST["media_upload"];
    // Add more fields as needed

    // Update recipe in the database
    $sql = "UPDATE recipes SET title='$title', instructions='$instructions', prep_time='$prep_time', cooking_time='$cooking_time', media_upload='$media_upload' WHERE id = $id";
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
    <title>Edit Recipe</title>
</head>
<body>
    <h2>Edit Recipe</h2>
    <form action="edit_recipe.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>" required><br><br>
        <label for="instructions">Instructions:</label><br>
        <textarea id="instructions" name="instructions" required><?php echo $row['instructions']; ?></textarea><br><br>
        <label for="prep_time">Prep Time (minutes):</label><br>
        <input type="number" id="prep_time" name="prep_time" value="<?php echo $row['prep_time']; ?>" required><br><br>
        <label for="cooking_time">Cooking Time (minutes):</label><br>
        <input type="number" id="cooking_time" name="cooking_time" value="<?php echo $row['cooking_time']; ?>" required><br><br>
        <label for="media_upload">Media Upload:</label><br>
        <input type="file" id="media_upload" name="media_upload" accept="image/*"><br><br>
        <!-- Add more fields as needed -->
        <button type="submit">Update Recipe</button>
    </form>
</body>
</html>

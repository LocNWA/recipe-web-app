<?php
include('db_connection.php');
session_start();

// Check if the user is signed in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not signed in
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $title = $_POST["title"];
    $instructions = $_POST["instructions"];
    $prep_time = $_POST["prep_time"];
    $cooking_time = $_POST["cooking_time"];

    // Perform basic validation (you should enhance this)
    if (empty($title) || empty($instructions) || empty($prep_time) || empty($cooking_time)) {
        $error_message = "All fields are required.";
    } else {
        // Upload image file
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $error_message = "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            $error_message = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $error_message = "Sorry, only JPG, JPEG, PNG files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $error_message = "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // File uploaded successfully, now insert recipe details into the database
                $media_upload = $target_file;
                $sql = "INSERT INTO recipes (user_id, title, instructions, prep_time, cooking_time, media_upload) VALUES ('$user_id', '$title', '$instructions', '$prep_time', '$cooking_time', '$media_upload')";

                if ($conn->query($sql) === TRUE) {
                    // Recipe added successfully, redirect to the home page
                    header("Location: index.php");
                    exit();
                } else {
                    $error_message = "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                $error_message = "Sorry, there was an error uploading your file.";
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Recipe</title>
</head>
<body>
    <h2>Submit Recipe</h2>
    <?php
    // Display error message if there's an error
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>
    <form action="submit_recipe.php" method="POST" enctype="multipart/form-data">
        <label for="title">Recipe Title</label>
        <input type="text" id="title" name="title" required>
        <label for="instructions">Instructions</label>
        <textarea id="instructions" name="instructions" required></textarea>
        <label for="prep_time">Prep Time (minutes)</label>
        <input type="number" id="prep_time" name="prep_time" required>
        <label for="cooking_time">Cooking Time (minutes)</label>
        <input type="number" id="cooking_time" name="cooking_time" required>
        <label for="image">Upload Image</label>
        <input type="file" id="image" name="image" accept="image/*" required>
        <input type="submit" name="submit" value="Submit Recipe">
    </form>
</body>
</html>

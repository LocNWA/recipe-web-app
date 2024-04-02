<?php
include('db_connection.php');
session_start();

// Check if the user is signed in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not signed in
    header("Location: cheflogin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $title = $_POST["title"];
    $instructions = $_POST["instructions"];
    $prep_time = $_POST["prep_time"];
    $cooking_time = $_POST["cooking_time"];


    if(isset($_POST["submit"])) {
        $sql = "INSERT INTO recipes (title, instructions, prep_time, cooking_time) VALUES ('$title', '$instructions', '$prep_time', '$cooking_time')";
    }    
    if ($conn->query($sql) === TRUE) {
        // Recipe added successfully, redirect to the home page
        header("Location: chefhome.php");
        exit();
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
    
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="remixicons/fonts/remixicon.css">
    <link rel="stylesheet" href="assets/CSS/mstyle.css">

    <title>Submit Recipe</title>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Add Recipe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="chefhome.php">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav <!-- // NAVBAR -->

    <?php
    // Display error message if there's an error
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

    <section id="subrec">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form action="submit_recipe.php" method="POST" enctype="multipart/form-data">
                        <div>
                            <input type="text" id="title" name="title" placeholder="Recipe Title" required>
                        </div>
                        <div class="form group col-12">
                            <textarea id="instructions" name="instructions" placeholder="Instructions"
                                required></textarea>
                        </div>
                        <div class="form group col-12">
                            <input type="number" id="prep_time" name="prep_time" placeholder="Prep Time (Minutes)"
                                required>
                        </div>
                        <div class="form group col-12">
                            <input type="number" id="cooking_time" name="cooking_time"
                                placeholder="Cooking Time (Minutes)" required>
                        </div>
                        <div class="form group col-12">
                            <button type="submit" class="btn btn-brand">Submit Recipe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
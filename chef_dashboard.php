<?php
include('db_connection.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: cheflogin.php");
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


// Retrieve chef profile information
$chef_sql = "SELECT id, chef_id, full_name, bio, profile_picture FROM chefs";
$chef_result = $conn->query($chef_sql);

if ($chef_result->num_rows > 0) {
    $chef = $chef_result->fetch_assoc();
} else {
    // Handle the case where the chef profile doesn't exist
}

// Retrieve chef's recipes
$recipes_sql = "SELECT * FROM recipes WHERE id = 'chef_id'";
$recipes_result = $conn->query($recipes_sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Chef Dashboard</title>
</head>
<body>
    <h2>Chef Dashboard</h2>
    <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>

    <!-- Display Chef Profile Information -->
    <h3>Your Profile</h3>
    <p><strong>Full Name:</strong> <?php echo $chef['full_name']; ?></p>
    <p><strong>Bio:</strong> <?php echo $chef['bio']; ?></p>
    <p><strong>Profile Picture:</strong> <img src="<?php echo $chef['profile_picture']; ?>" alt="Profile Picture"></p>

    <!-- Chef's Recipes -->
    <h3>Your Recipes</h3>
    <?php if ($recipes_result->num_rows > 0): ?>
        <ul>
            <?php while ($recipe = $recipes_result->fetch_assoc()): ?>
                <li>
                    <strong><?php echo $recipe['title']; ?></strong>
                    <p>Prep Time: <?php echo $recipe['prep_time']; ?> minutes</p>
                    <p>Cooking Time: <?php echo $recipe['cooking_time']; ?> minutes</p>
                    <img src="<?php echo $recipe['media_upload']; ?>" alt="<?php echo $recipe['title']; ?>">
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No recipes found.</p>
    <?php endif; ?>

    <!-- Links to Edit Profile and Add New Recipe -->
    <p><a href="edit_profile.php">Edit Your Profile</a></p>
    <p><a href="submit_recipe.php">Add New Recipe</a></p>
</body>
</html>

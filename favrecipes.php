<?php
// Include database connection file
include('db_connection.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch the user's favorite recipes from the database
$sql = "SELECT recipes.id, recipes.title, recipes.prep_time, recipes.cooking_time, recipes.media_upload 
        FROM recipes
        INNER JOIN favorites ON recipes.id = favorites.recipe_id
        WHERE favorites.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Display the favorite recipes
    while ($row = $result->fetch_assoc()) {
        echo "<h2>" . $row["title"] . "</h2>";
        echo "<p>Prep Time: " . $row["prep_time"] . " minutes</p>";
        echo "<p>Cooking Time: " . $row["cooking_time"] . " minutes</p>";
        echo "<img src='" . $row["media_upload"] . "' alt='" . $row["title"] . "'><br>";
        echo "<a href='recipe_details.php?id=" . $row["id"] . "'>View Details</a><hr>";
    }
} else {
    echo "You haven't favorited any recipes yet.";
}

// Close prepared statement and database connection
$stmt->close();
$conn->close();
?>

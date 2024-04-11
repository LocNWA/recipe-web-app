<?php
// Include database connection file
include('db_connection.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the recipe_id parameter is set in the POST request
    if (isset($_POST["recipe_id"])) {
        // Sanitize the input to prevent SQL injection
        $recipe_id = mysqli_real_escape_string($conn, $_POST["recipe_id"]);

        // Check if the recipe ID exists in the database
        $check_recipe_sql = "SELECT * FROM recipes WHERE id = '$recipe_id'";
        $check_recipe_result = $conn->query($check_recipe_sql);

        if ($check_recipe_result->num_rows > 0) {
            // Get the user ID from the session
            session_start();
            $user_id = $_SESSION['user_id'];

            // Check if the user has already favorited the recipe
            $check_favorite_sql = "SELECT * FROM favorites WHERE user_id = '$user_id' AND recipe_id = '$recipe_id'";
            $check_favorite_result = $conn->query($check_favorite_sql);

            if ($check_favorite_result->num_rows == 0) {
                // Insert a new favorite record into the favorites table
                $insert_favorite_sql = "INSERT INTO favorites (user_id, recipe_id) VALUES ('$user_id', '$recipe_id')";
                if ($conn->query($insert_favorite_sql) === TRUE) {
                    // Favorite successfully added
                    echo "Recipe favorited successfully.";
                } else {
                    // Error inserting favorite
                    echo "Error: " . $conn->error;
                }
            } else {
                // Recipe already favorited by the user
                echo "Recipe is already favorited.";
            }
        } else {
            // Recipe not found
            echo "Recipe not found.";
        }
    } else {
        // recipe_id parameter not set
        echo "Recipe ID not provided.";
    }
} else {
    // Invalid request method
    echo "Invalid request method.";
}

// Close database connection
$conn->close();
?>

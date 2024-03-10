<?php
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_term = $_POST["search_term"];

    // Implement search logic based on your requirements

    // Example: Search recipes by title
    $sql = "SELECT * FROM recipes WHERE title LIKE '%$search_term%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display search results
        while ($recipe = $result->fetch_assoc()) {
            echo "<p><strong>Title:</strong> " . $recipe['title'] . "</p>";
            echo "<p><strong>Prep Time:</strong> " . $recipe['prep_time'] . " minutes</p>";
            echo "<p><strong>Cooking Time:</strong> " . $recipe['cooking_time'] . " minutes</p>";
            // Add more information as needed
            echo "<hr>";
        }
    } else {
        echo "No recipes found.";
    }
}

$conn->close();
?>

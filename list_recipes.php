<?php
// Include database connection file
include('db_connection.php');

// Fetch all recipes from the database
$sql = "SELECT * FROM recipes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through each recipe and display as a table row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["instructions"] . "</td>";
        echo "<td>" . $row["prep_time"] . "</td>";
        echo "<td>" . $row["cooking_time"] . "</td>";
        echo "<td>" . $row["media_upload"] . "</td>";
        echo "<td><a href='edit_recipe.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete_recipe.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No recipes found.</td></tr>";
}

// Close database connection
$conn->close();
?>

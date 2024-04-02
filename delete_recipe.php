<?php
// Include database connection file
include('db_connection.php');

// Check if recipe ID is provided in the URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Delete recipe from the database
    $sql = "DELETE FROM recipes WHERE id = $id";
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

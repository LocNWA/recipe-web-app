<?php
// Include database connection file
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Retrieve admin credentials from the database
    $sql = "SELECT * FROM admins WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password']; // Note: Password stored in plaintext

        // Verify the password
        if ($password === $storedPassword) { // Compare plaintext passwords
            // Start a session and store admin ID
            session_start();
            $_SESSION["admin_id"] = $row["id"];
            header("Location: admin_dashboard.php"); // Redirect to the admin dashboard
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }
}

// Close database connection
$conn->close();
?>

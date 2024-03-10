<?php
include('db_connection.php');

if (isset($_GET['code'])) {
    $verification_code = $_GET['code'];

    $sql = "SELECT id, username, email FROM users WHERE verification_code = '$verification_code'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        // Mark the user as verified
        $update_sql = "UPDATE users SET verification_code = NULL, verified = 1 WHERE id = $user_id";
        $conn->query($update_sql);

        echo "Email verification successful! You can now <a href='login.php'>log in</a>.";
    } else {
        echo "Invalid verification code.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>

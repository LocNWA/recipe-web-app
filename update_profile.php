<?php
include('db_connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $full_name = $_POST['full_name'];
    $bio = $_POST['bio'];

    // Update chef profile information
    $update_sql = "UPDATE chef_profiles SET full_name = '$full_name', bio = '$bio' WHERE user_id = '$user_id'";
    $conn->query($update_sql);

    // Handle profile picture upload
    if ($_FILES['profile_picture']['error'] == 0) {
        $upload_dir = 'profile_pictures/';
        $profile_picture_path = $upload_dir . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture_path);

        // Update the profile picture path in the database
        $update_picture_sql = "UPDATE chef_profiles SET profile_picture = '$profile_picture_path' WHERE user_id = '$user_id'";
        $conn->query($update_picture_sql);
    }

    // Redirect back to the chef profile page
    header("Location: chef_profile.php");
    exit();
}

$conn->close();
?>

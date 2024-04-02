<?php
include('db_connection.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Retrieve chef profile information
$profile_sql = "SELECT * FROM chefs WHERE user_id = '$user_id'";
$profile_result = $conn->query($profile_sql);

if ($profile_result->num_rows > 0) {
    $profile = $profile_result->fetch_assoc();
} else {
    // Handle the case where the chef profile doesn't exist
}

// Handle form submission to update the profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $bio = $_POST['bio'];

    // Update chef profile information
    $update_sql = "UPDATE chefs SET full_name = '$full_name', bio = '$bio' WHERE user_id = '$user_id'";
    $conn->query($update_sql);

    // Redirect back to the chef dashboard
    header("Location: chef_dashboard.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Your Profile</h2>

    <!-- Form to Edit Chef Profile -->
    <form action="edit_profile.php" method="POST">
        <label for="full_name">Full Name</label>
        <input type="text" id="full_name" name="full_name" value="<?php echo $profile['full_name']; ?>" required>
        <label for="bio">Bio</label>
        <textarea id="bio" name="bio"><?php echo $profile['bio']; ?></textarea>
        <input type="submit" value="Save Changes">
    </form>
</body>
</html>

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
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$profile_result = $conn->query($sql);

$sql2 = "SELECT * FROM chefs WHERE id = '$chef_id'";
$profile_result2 = $conn->query($sql2);


if ($profile_result2->num_rows > 0) {
    $profile = $profile_result2->fetch_assoc();
} else {
    // Handle the case where the chef profile doesn't exist
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef Profile</title>
</head>
<body>
    <h2>User Profile</h2>
    <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>

    <!-- Display Chef Profile Information -->
    <h3>Your Profile</h3>
    <p><strong>Full Name:</strong> <?php echo $profile['full_name']; ?></p>
    <p><strong>Bio:</strong> <?php echo $profile['bio']; ?></p>
    <p><strong>Profile Picture:</strong> <img src="<?php echo $profile['profile_picture']; ?>" alt="Profile Picture"></p>

    <!-- Form to Edit Chef Profile -->
    <h3>Edit Your Profile</h3>
    <form action="update_profile.php" method="POST" enctype="multipart/form-data">
        <label for="full_name">Full Name</label>
        <input type="text" id="full_name" name="full_name" value="<?php echo $profile['full_name']; ?>" required>
        <label for="bio">Bio</label>
        <textarea id="bio" name="bio"><?php echo $profile['bio']; ?></textarea>
        <label for="profile_picture">Profile Picture</label>
        <input type="file" id="profile_picture" name="profile_picture">
        <input type="submit" value="Save Changes">
    </form>
</body>
</html>

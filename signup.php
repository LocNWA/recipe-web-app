<?php
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Perform basic validation (you should enhance this)
    if (empty($username) || empty($password) || empty($email)) {
        echo "All fields are required.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Generate a unique verification code
        $verification_code = md5(uniqid(rand(), true));

        $sql = "INSERT INTO users (username, password, email, verification_code) VALUES ('$username', '$hashed_password', '$email', '$verification_code')";

        if ($conn->query($sql) === TRUE) {
            // Send the verification email
            $subject = "Verify Your Email";
            $message = "Click the following link to verify your email: http://yourwebsite.com/verify.php?code=$verification_code";
            // Use a proper mailing library or service for production
            mail($email, $subject, $message);

            echo "Registration successful! Check your email to verify your account.";
            // Redirect to the home page after successful sign-up
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/950345636d.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/CSS/signupstyle.css">
  <link rel="stylesheet" href="assets/CSS/OTstyle.css">
  <title>Sign Up</title>
</head>

<body>
    <div class="container">
        <div class="logo"><a href="index.php"></a>LOC'S RECIPES</div>
        <div class="form-box">
        <h1 id="title">Sign Up</h1>
        <form action="signup.php" method="POST">
            <div class="input-group">
            <div class="input-field" id="nameField">
                <i class="fa-solid fa-user"></i>
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="input-field">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-field">
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            </div>
            <div class="btn-field">
                <button type="submit" value="Sign Up" id="signupBtn">Sign up</button>
                <button type="button" value="Login" id="siginBtn" class="disable"><a href="login.php"></a>Sign in</button>
            </div>
        </form>
        </div>
     </div>
</body>

</html>
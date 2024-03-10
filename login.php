<?php
include('db_connection.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Set session variables for user authentication
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];

            // Redirect to the home page after successful login
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "User not found.";
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
    <title>Sign In</title>
    </head>

    <body>
        <div class="container">
            <div class="form-box">
                <h1>User Sign In</h1>
                <?php
                // Display error message if login fails
                if (isset($error_message)) {
                    echo "<p style='color: red;'>$error_message</p>";
                }
                ?>
                <form action="login.php" method="POST">
                    <div class="input-group">
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" id="username" name="username" placeholder="username">
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Password">
                    </div class="fgp">
                      <p>Forgotten Password? <a href="#">Click here</a></p>
                    </div>
                    <div class="sbtn-field">
                        <button type="submit" value="Login" id="signinBtn">Sign in</button>
                        <button type="submit" value="Sign up" id="signupBtn" class="disable">Sign up</button>
                    </div>
                </form>
            </div>
        </div>
    </body>

</html>
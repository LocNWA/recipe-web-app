<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="remixicons/fonts/remixicon.css">
    <link rel="stylesheet" href="assets/css/mstyle.css">
    <link rel="stylesheet" href="assets/css/msignupstyle.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/950345636d.js" crossorigin="anonymous"></script>

    <title>Chef Sign Up</title>

</head>

<body id="home" data-bs-spy="scroll" data-bs-target=".navbar">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Loc's Recipes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cheflogin.php">Chef Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav <!-- // NAVBAR -->

    <section id="sitter">
        <div class="container">
            <div class="form-box">
                <h1 id="title">Chef Sign Up</h1>
                <form action="signup_process_chef.php" method="POST">
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
                        <div class="input-field">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="confirm password" name="confirm password" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <div class="btn-field">
                        <button type="submit" value="Sign up" id="signupBtn">Sign up</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>
<?php
	session_start();					//retrieve or create session
	if (!IsSet($_SESSION["user"]))		//user name must in session to stay here
		header("Location: login.php");	//if not, go back to login page
	$username=$_SESSION["user"];		//get user name into variable $username
?>
<!doctype html>
<html>
	<head>
		<title>User Home</title>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>User Home Page</h1>
		<p>
			Welcome back, <?php print $username; ?>!
			This is your home page.
			As far as you are logged in, you can go to <a href="another.php">another page</a> too.
			
			If you want to logout, use the button below.
		</p>
		<!--
			This form allows you to logout by invoking the logoutphp script.
		-->
		<form method="get" action="logout.php">
			<button type="submit">Logout</button>
		</form>
	</body>
</html>

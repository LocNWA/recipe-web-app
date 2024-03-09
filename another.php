<?php
	session_start();
	if (!IsSet($_SESSION["user"]))		//user variable must exist in session to stay here
		header("Location: login.php");	//if not, go back to login page
	$username=$_SESSION["user"];		//get user name into variable $username
?>
<!doctype html>
<html>
	<head>
		<title>Another Page</title>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>User Home Page</h1>
		<p>
			Welcome back, <?php print $username; ?>!
			This is another page apart from the <a href="home.php">home page</a>.
		</p>
		<form method="get" action="logout.php">
			<button type="submit">Logout</button>
		</form>
	</body>
</html>

<?php
session_start();	//create or retrieve session

if (IsSet($_SESSION["user"]))			//if username exists in session, user has logged in
	{
	header("Location: home.php");		//forward to use home page
	exit();
	}
?>
<!--
	Otherwise show login page/form.
-->
<!doctype html>
<html>
	<head>
		<title>Login Using PHP Session Example</title>
		<link rel="stylesheet" href="common.css">
		<style>
			table {border-style:solid;border-width:1px;border_color:blue}
			td {background-color:yellow}
		</style>
	</head>
	<body>
		<h1>Login using PHP Session Examples</h1>
		<section>
			<h2>Usename and Password</h2>
			<p>
				This login page knows the following username and password pairs:
			</p>
			<table>
				<tr>
					<th>Username</th><th>Password</th>
				</tr>
				<?php
					require("accounts.php");		//include PHP script where accounts information are stored
					foreach ($accounts as $user=>$pwd)
						{
						print "<tr>\n";
						print "<td>".$user."</td><td>".$pwd."</td>\n";
						print "</tr>\n";
						}
				?>
			</table>
		</section>
		<section>
			<h2>Login Form</h2>
			<p>
				When you login successfully, you username will be kept in the session.
				Then you will be directed to the user home page.
			</p>
			<!--
				This form submits the username and password to the script validate.php.
			-->
			<form id="login" method="post" action="validate.php">
				Username: <input type="text" name="user"> <br/>
				Password: <input type="password" name="password"> <br/>
				<button type="submit">Login</button>
			</form>
		</section>
	</body>
</html>

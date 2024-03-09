<?php
	session_start();	//start a session here in case user login successfully
	if (!IsSet($_POST))					//if no $_POST array
		{
		session_destroy();				//clear session
		header("Location: login.php");	//send user back to login page
		exit();
		}

	if (!IsSet($_POST["user"]) || !IsSet($_POST["password"]))	//if no username or password submitted
		{
		session_destroy();				//clear session
		header("Location: login.php");	//send user back to login page
		exit();
		}

	/*
		I put all accounts into a separate PHP file and include it here.
		I use "required_once" as the script cannot run without the account information,
		and I do not want to include it more than once.
	*/
	require_once "accounts.php";

	/*
		This function return true/false for a given username and password.
		It will only return true if the username-password pair appears in the array
		defined in "accounts.php".
	*/
	function valid_login($username,$password)
	{
	global $accounts;							//$accounts is a global variable
												//defined in accounts.php, which is included above.
	if (!IsSet($accounts[$username]))			//check to see if this username has a password
		return(false);							//return false if no password exists
	return($password==$accounts[$username]);	//use username as index to retreive password
												//then compare
	}

	$username=$_POST["user"];			//get username value submitted by form
	$password=$_POST["password"];		//get password from form
	if (valid_login($username,$password))	//validate login
		{
		$_SESSION["user"]=$username;	//store username into session variable
		header("Location: home.php");	//then forward to home page
		exit();							//stop PHP script here
		}
	/*
		So this is unsuccessful login
	*/
	session_destroy();					//destroy the session
	header("Location: login.php");		//send user back to login page
?>

<?php
	session_start();				//retrieve session
	session_destroy();				//then destroy it
	header("Location: login.php");	//redirect to login page
?>

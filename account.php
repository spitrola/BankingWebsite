<?php
	/*
		this sets up the account page when logged in by calling accountPage from 
		accountFunctions.php
	*/
	session_save_path("./tmp/");
	session_start();
	include_once("accountFunctions.php");
	$user = $_SESSION['uname'];
	echo accountPage($user);
?>
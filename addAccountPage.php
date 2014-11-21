<?php
	/*
		this sets up the account form by calling addAccountForm from the accountAddForm.php
	*/
	session_save_path("./tmp/");
	session_start();
	include_once("accountAddForm.php");
	$user = $_SESSION['uname'];
	echo addAccountForm($user);
?>
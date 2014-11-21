<?php
	session_save_path("./tmp/");
	session_start();
	include_once("welcomeFunctions.php");
		//check if the session username is not set
		if(!isset($_SESSION['uname'])){
			//then check if it is set with an error
			if(isset($_SESSION['error'])){
				//user name and password resulted in an error
				$user = "error";
				echo welcomePage($user);
			
			}
			else{
				//else set up page as first login or when login page opens first 
				$user = "firstLogin";
				echo welcomePage($user);
			}
		}
		else{ //if the page is set and same with session then create page
			$user = $_SESSION['uname'];
			header("Location: account.php");
		}  
?>
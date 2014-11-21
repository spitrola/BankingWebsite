<?php
	/*
		this sets up the transaction page for the user and does error checking for the query string
	*/
	session_save_path("./tmp/");
	session_start();
	
	include_once("viewTransFunctions.php");
	$user = $_SESSION['uname'];//get the user
	 if(isset($_GET['view'])) //check to see if the view is set  
		{
		$choice = $_GET['view'];//set choice to be the view number
		$file = "./".$user."/T".$choice.".txt";
			if((is_numeric($choice)) && (file_exists($file))){ //checks to see if view is a number and if file exists 
				if(isset($_SESSION['error'])){//if the session has an error
					$invalid = "error";
					unset($_SESSION['error']);
					echo getViewofTransaction($user,$choice,$invalid);//call get view transaction and pass in the invalid variable to print error msg
				}
				else{
					$invalid = "number";
					echo getViewofTransaction($user,$choice,$invalid);//call get view transaction and pass in the invalid variable to print user page
				}
			}
			else{//if view is not a number and is file does not exist display error page
				echo errorPage($user);
			}
	}
	else{//if view is not set then display error page
		echo errorPage($user);
	} 
?>
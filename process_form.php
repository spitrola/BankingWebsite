<?php

	/*
		this checks if the user name and password exist so the user can log in 
	*/
	session_save_path("./tmp/");
	session_start();
	//check if the username and password is set 
	 if((isset($_POST['uname'])) && (isset($_POST['upass']))){
		
		$userName = $_POST['uname'];
		$userPass =$_POST['upass'];
	
		$file = "./"."loginInfo"."/".$userName.".txt";
			if(file_exists($file)){//if file exists then open and read
				$fh = fopen($file, 'r');
				$line = fgets($fh);
				fclose($fh);
	
				$text = explode(":",$line);//explode the line 
				$good_name = $text[0];//save username
				$good_pass = trim($text[1]);//save password
					//check if what the user entered is the same
					if( ($userName === $good_name) && (md5($userPass) === $good_pass)){
						//if so unset the error and set the session with the username 
						unset($_SESSION['error']);
						$_SESSION['uname'] = $userName;
 						header("Location: index.php");//go back to index.php
 					}	
					else{
					    
						//else unset the session username and set the session with an error
						unset($_SESSION['uname']);
						$_SESSION['error'] = "Error";   
						header("Location: index.php");//go back to index.php
					}

			}
			else{//if file does not exist
						//else unset the session username and set the session with an error
						unset($_SESSION['uname']);
						$_SESSION['error'] = "Error";
						header("Location: index.php");//go back to index.php
			}
	} 
?>
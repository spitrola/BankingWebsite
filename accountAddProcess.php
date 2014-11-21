<?php
	/*
		this opens up a file and then takes the contents that were filled in from the 
		add account form and then written to the file.
	*/
	session_save_path("./tmp/");
	session_start();
	include_once("getDataFunctions.php");
	$accountName = $_POST['aname'];
	$accountNote = $_POST['anote'];
	$accountOpenBalance = 0;
	$user = $_SESSION['uname'];
	
	$file = "./".$user."/A.txt";
	if(checkInput($accountName)){//check the input to see if it is all letters no special characters 
	//if file exists then open it up and add account at the end of the file
	if(file_exists($file))
	{
		unset($_SESSION['errorAdd']);
		$file_handle = fopen($file, 'a');
		$choice = getFileCount($user);//count the number of t files 
		$file = "./".$user."/T".$choice.".txt";//set up the account page for that account ex: T0.txt 
		touch ($file);
		$data = "<!!>".$accountName."<:>".$accountNote;
		fwrite($file_handle, $data);
		fclose($file_handle);
		header("Location: account.php");
	}
	else
	{
		unset($_SESSION['errorAdd']);
		//else if create a new file and write to it starting from the beginning...only happens when there is no account file
		$file_handle = fopen($file, 'w');
		$choice = getFileCount($user);//count the number of t files 
		$file = "./".$user."/T".$choice.".txt";//set up the account page for that account ex: T0.txt 
		touch ($file);
		$data = $accountName."<:>".$accountNote;
		fwrite($file_handle, $data);
		fclose($file_handle);
		header("Location: account.php");
	}
}
else{//else return an error add 
	$_SESSION['errorAdd'] = "errorAdd";
	header("Location: addAccountPage.php");
}
?>


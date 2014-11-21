<?php
/*
	this function gets the total balance  
	this is used in accountFunctions.php
*/
	 function getAccountBalance($accountChoice){
		$balance = 0;
		$user = $_SESSION['uname'];
		$file1 = "./".$user."/A.txt";
		 	$fileContents = file_get_contents($file1);
			$accounts = explode("<!!>", $fileContents);
			$file2 = "./".$user."/T".$accountChoice.".txt";
			if(file_exists($file2)){
				$fileContents2 = file_get_contents($file2);
				if($fileContents2 != ''){//if the file is not empty
					$records = explode("<!!>",$fileContents2);
			
				for($i = 0; $i < sizeof($records); $i++){//run through the number of records
					$recordFields = explode("<:>", $records[$i]);
					$balance += $recordFields[3];//balance = balance + amount
				}
			}
		}
			else{
				$balance = 0;//return balance 0 if there is no sum
			}
		
		return $balance;
	} 

/*
	this function sets up the balance so it can print in reverse order 
	this is used in viewTransactionFunctions.php
*/
 function getAccountBalance2($accountChoice, $stopRow){
	$balance = 0;
	$user = $_SESSION['uname'];
	$file1 = "./".$user."/A.txt";
		$fileContents = file_get_contents($file1);
		$accounts = explode("<!!>", $fileContents);
		$file2 = "./".$user."/T".$accountChoice.".txt";
		if(file_exists($file2)){
			$fileContents2 = file_get_contents($file2);
		    	if($fileContents2 != '') {//if the file is not empty
					$records = explode("<!!>",$fileContents2);
					if(sizeof($records) > 0){//check to make sure records are greater than zero 
						for($i = 0; $i <= $stopRow; $i++){//run through the number of loops
							$recordFields = explode("<:>", $records[$i]);
							$balance += $recordFields[3];//balance = balance + amount
						}
					}
				}
			}
		else{
			$balance = 0;
		}
		
			return $balance;
} 
		
		
		
/*
	this counts the number of files in the user directory 
*/
function getFileCount($user){
	$directory = "./".$user;
	$filecount = 0;//start file count at zero
	if (glob($directory . "/T*") != false){
		$filecount = count(glob($directory . "/T*"));//count file if it starts with a T
		return $filecount;
	}
	else{
		return $filecount;//return 0 if T does not exist 
	}
}	
/* 
	this function checks if the string is a string and not a delimiter 
*/
function checkInput($string){
	if(($string == "<:>")||($string == "<!!>")){
		return false;
	}else{
		return true;
	}
}
?>
<?php
/*
	   this php file processes the transaction by writing to the file and checking if the amount is a 
    	   number. 
*/
		session_save_path("./tmp/");
		session_start();
		include_once("getDataFunctions.php");
		//set the variables with the form contents	
		$tranAmount = $_POST['amount'];
		$tranFrom = $_POST['moneyFrom'];
		$tranNote = $_POST['note'];
		$tranChoice = $_POST['choice'];
		date_default_timezone_set('America/Edmonton');
		$currentDate = date("F j, Y, g:i a");  
		$i = $_SESSION['choice'];
	
		$user = $_SESSION['uname'];
		$file = "./".$user."/T".$i.".txt";
		$fileContents = file_get_contents($file);
		
		if($fileContents != '')//if file is not empty
		{
			$file_handle = fopen($file, 'a');
			if($tranChoice == 'deposit'){//check if the tranChoice is a deposit
			//if the amount is set and the amount is a number then write to the file
				if(isset($_POST['amount']) && is_numeric($tranAmount['amount'])){
					$data = "<!!>".$currentDate."<:>".$tranFrom."<:>".$tranNote."<:>".$tranAmount;
				}
				else{//if not then set a session variable to error and boot back to the viewTransaction.php…helps set up the error msg
				
					$_SESSION['error'] = "error";
					header("Location: viewTransactions.php?view=$i");
				}
			}
			
			else if($tranChoice == 'withdraw'){//check if the tranChoice is a deposit
			
				//if the amount is set and the amount is a number then write to the file			
				if(isset($_POST['amount']) && is_numeric($tranAmount['amount'])){
					$tranNegAmount = $tranAmount * -1;//times it by negative one to make number negative
					$data = "<!!>".$currentDate."<:>".$tranFrom."<:>".$tranNote."<:>".$tranNegAmount;
				}
				else{//if not then set a session variable to error and boot back to the viewTransaction.php…helps set up the error msg
					$_SESSION['error'] = "error";
					header("Location: viewTransactions.php?view=$i");
				}
			}
			//write to file and close the file…then boot back to the transaction page for the specific account
			fwrite($file_handle, $data);
			fclose($file_handle);
			
			header("Location: viewTransactions.php?view=$i");
		}
 		else if($fileContents == ''){//if file is empty
			//if the amount is set and the amount is a number then write to the file…if pass then open file 	
			if(isset($_POST['amount']) && is_numeric($tranAmount['amount'])){
				$file_handle = fopen($file, 'w');
				if($tranChoice == 'deposit'){//check if the tranChoice is a deposit
					$data = $currentDate."<:>".$tranFrom."<:>".$tranNote."<:>".$tranAmount;
				}
				elseif($tranChoice == 'withdraw'){//check if the tranChoice is a withdraw
					$tranNegAmount = $tranAmount * -1;//times it by negative one to make number negative
					$data = $currentDate."<:>".$tranFrom."<:>".$tranNote."<:>".$tranNegAmount;
				}
				//write to file and close the file…then boot back to the transaction page for the specific account
				fwrite($file_handle, $data);
				fclose($file_handle);
				header("Location: viewTransactions.php?view=$i");	
				
			}
			else{//if not then set a session variable to error and boot back to the viewTransaction.php…helps set up the error msg
				$_SESSION['error'] = "error";
				header("Location: viewTransactions.php?view=$i");
			}
		} 
	
?>
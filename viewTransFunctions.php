<?php
/*
	this php file has all the transaction functions that help set up the page
*/
include_once("functions.php");
include_once("getDataFunctions.php");

/*
	this creates the transaction header 
*/
function getTransactionHeader($user,$page){
 		$header = '<header>'."\r\n";
 		$header .= "<h1>SP Financial Services</h1>\r\n";
 		$header .= getNavigation($user,$page);
 		$header .= "</header>\r\n";
 		return $header;
 	}

/*
	this sets up the page by setting up the head, body, header and content
*/
function getViewofTransaction($user,$view,$invalid){
	$page = "viewHistory";
	$html = getHead($page);
	$html .= '<body>'."\r\n";
	$html .= '<div class="container">'."\r\n";
 	$html .= getTransactionHeader($user,$page);
	$html .= getTransactionContent($user,$view,$invalid);
	$html .= "</body>\r\n";
	return $html;
}

/*
	this sets up the page content by calling the container and footer 
*/
function getTransactionContent($user,$view,$invalid){
 		$content = getTransactions($user,$view,$invalid);
 		$content .= '<div class="clear">'."</div>\r\n";
 		$content .= getFooter();
 		$content .= "</div>\r\n";
 		return $content;
 	}

/*
	this function calls the helpSetUpTransaction to help set up the page, also the getTransactionForm and listHistoryHeadings
	helps make the page content 
*/
function getTransactions($user,$view,$invalid){
	//if invalid is error then print error msg with the form and table 
	if($invalid == "error"){
		$accounts = helpSetUpTransaction();
		$accounts .= '<p class="noAccounts">'."Invalid Amount</p>";
		$accounts .= '<table class="table table-bordered accountTable">'."\r\n";
		$accounts .= listHistoryHeadings($user,$view);
		$accounts .= "</table>\r\n";
		$accounts .= "</section>"."\r\n";
		return $accounts;
	}else if("number"){//else print the table and form 
		$accounts = helpSetUpTransaction();
		$accounts .= '<p id="currBalance">'."Current Balance: $".number_format(getAccountBalance($view),2)."</p>\r\n";
		$accounts .= '<table class="table table-bordered table table-striped accountTable">'."\r\n";
		$accounts .= listHistoryHeadings($user,$view);
		$accounts .= "</table>\r\n";
		$accounts .= "</section>"."\r\n";
		return $accounts;
	}	

/*
	this is a helper function in setting up the page for Transaction
*/
 }
 
 function helpSetUpTransaction(){
	$helper = '<section class="accountsPage">'."\r\n";
	$helper.= '<h2 class="form-signin-heading">'."Transaction</h2>\r\n";
	$helper .= getTransactionForm();
	$helper .= '<p class="pHeadings">'."History</p>";
	return $helper;
 }
 
/*
	this sets up the transaction form by calling it in from a file
*/
function getTransactionForm(){
	$dirName = "formContent";
	$form = '<p class="pHeadings">'."Make Transaction</p>";
	$form .= '<form class="form-inline" method="post" action="processTransaction.php">'."\r\n";
	$file = "./".$dirName."/".'3'.".txt";
	$form .= file_get_contents($file)."\r\n";
	$form .= "</form>";
	return $form;
}
 	
/*
	this sets up the table headings. For example, Data, From, Note, Amount and Balance
*/ 	
function listHistoryHeadings($user,$view){
		$list = "<tr>\r\n";
		$list .= "<th>Date</th><th>From</th><th>Note</th><th>Amount</th><th>Balance</th>";
		$list .= "</tr>\r\n";
		$list .=  listHistory($user,$view);
		return $list;
	}

/*
	this function creates the table along with the content by exploding files 
*/
function listHistory($user,$view){
		$file = "./".$user."/T".$view.".txt";
		$balance = 0;
		$_SESSION['choice'] = $view;
		$tableData = '';
		//if file exists then open up the file and explode the lines...use for loops to 
		//display the accounts
		if(file_exists($file)){	
		 		$fileContents = file_get_contents($file);
				if($fileContents != ''){//if the file is not empty
				$history = explode("<!!>", $fileContents);
				for($i = sizeof($history)-1; $i >= 0; $i--){//print backwards
						$tableData .= '<tr class ="tableAlign">'."\r\n";
						$historyDetails= explode("<:>",$history[$i]);		
							for($j = 0; $j < sizeof($historyDetails); $j++){
								if(($j == 0)||($j == 1)||($j == 2)){
									$tableData .= '<td class="lengthForm">'.$historyDetails[$j]."</td>\r\n";
								}
								if($j == 3){
									$tableData .= '<td class="lengthForm">$'.number_format($historyDetails[$j],2)."</td>\r\n";
								}
							}		
								//this calls the getAccountBalance2 by taking in the account choice and index which is "i"
								$tableData .= '<td class="lengthForm"> $'. number_format(getAccountBalance2($view,$i),2)."</td>\r\n";
							
							$tableData .= "</tr>\r\n";
					}
				}
				else{
				$tableData = '<tr><td colspan= "5" class="noAccounts">'."Please Make A Transaction ".ucfirst($user)."</td></tr>\r\n";
			}
		}
		else{
			//else if there are no accounts print a message saying to add an account 
			$tableData = '<tr><td colspan= "5"  class="noAccounts">'."Please Make A Transaction ".ucfirst($user)."</td></tr>\r\n";
		}
		return $tableData;
	}

/*
	this sets up the error page when user plays the the query string
*/
function errorPage($user){
	$page = "errorPage";
	$html = getHead($page);
	$html .= '<body>'."\r\n";
	$html .= '<div class="container">'."\r\n";
 	$html .= getTransactionHeader($user,$page);
	$html .= getErrorContent();
	$html .= "</body>\r\n";
	return $html;
}

/*
	this sets up the error page content...displays an error msg
*/
function getErrorContent(){
	$error = '<section class="errorPage">'."\r\n";
	$error .= '<p id = "errorMsg"> Account Does Not Exist, Please Use The Navigation Above</p>';
	$error .= "</section>"."\r\n";
	$error .= '<div class="clear">'."</div>\r\n";
 	$error .= getFooter();
 	$error .= "</div>\r\n";
	return $error;
}

?>
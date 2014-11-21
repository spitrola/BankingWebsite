<?php
	include_once("functions.php");
	include_once("getDataFunctions.php");
	/*
		this sets up the account header and calling get navigation from functions.php
	*/
	function getAccountHeader($user,$page){
 		$header = '<header>'."\r\n";
 		$header .= "<h1>SP Financial Services</h1>\r\n";
 		$header .= getNavigation($user,$page);
 		$header .= "</header>\r\n";
 		return $header;
 	}
 	
 	/*
		this sets up the account container by calling the header, sidebar, accounts and footer
	*/
	function getAccountContent($user,$page){
		$content = '<div class="container">'."\r\n";
 		$content .= getAccountHeader($user,$page);
 		$content .= getAccounts($user);
 		$content .= '<div class="clear">'."</div>\r\n";
 		$content .= getFooter();
 		$content .= "</div>\r\n";
 		return $content;
	}
	
	/*
		this gets the accounts by calling listAllAccounts
	*/
	function getAccounts($user){
		$file = "./".$user."/A.txt";
		if(file_exists($file)){
		$accounts = '<section class="accountsPage">'."\r\n";
		$accounts.= '<h2 class="form-signin-heading">'."Active Accounts</h2>\r\n";
		$accounts .= '<table class="table table-bordered  table table-hover accountTable">'."\r\n";
		$accounts .= listAllAccountHeadings($user);
		$accounts .= "</table>\r\n";
		}else{
			$accounts = '<section id="addAccountsPage">'."\r\n";
			$accounts.= '<h2 class="form-signin-heading">'."Active Accounts</h2>\r\n";
			$accounts.= '<p class="noAccounts" id="addAccount">'.'<a href="addAccountPage.php">Please Add an Account '.ucfirst($user). '</a>'."</p>\r\n";
		}
		$accounts .= "</section>"."\r\n";
		return $accounts;
 	}
	
	/*
		this sets up the table headers
	*/
	function listAllAccountHeadings($user){
		$list = "<tr>\r\n";
		$list .= "<th></th><th>Name</th><th>Note</th><th>Balance</th>";
		$list .= "</tr>\r\n";
		$list .=  listAccounts($user);
		return $list;
	}
	
	/*
		this is called in accounts.php and sets up the whole page 
	*/
	function accountPage($user){
		$page = "account";
		$html = getHead($page);
		$html .= '<body>'."\r\n";
		$html .= getAccountContent($user,$page);
		$html .= "</body>\r\n";
		return $html;
	}
	
	/*
		this displays the active accounts...by opening up the file 
	*/
	function listAccounts($user){
		$file = "./".$user."/A.txt";
		//open up the file and explode the lines...use for loops to 
		//display the accounts
		 		$fileContents = file_get_contents($file);	
				$accounts = explode("<!!>", $fileContents);
				$tableData = '';
					for($i = 0; $i < sizeof($accounts); $i++){
						$tableData .= '<tr class ="tableAlign">'."\r\n";
						$tableData .= "<td>"."<a href = 'viewTransactions.php?view=$i'>".'View History</a>'."</td>\r\n";
						$accountDetails= explode("<:>",$accounts[$i]);
							for($j = 0; $j < sizeof($accountDetails); $j++){
								$tableData .= '<td class="lengthForm">'.$accountDetails[$j]."</td>";
							}
						$tableData .= '<td class="lengthForm">$'.number_format(getAccountBalance($i),2)."</td>";//make call to getAccountBalance from getDataFunctions
						$tableData .= "</tr>\r\n";
					}	
			return $tableData;
	}
?>
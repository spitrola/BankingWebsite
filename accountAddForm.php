<?php	
	include_once("functions.php");
	
	/*
		this function gets the account header and calls get Navigation from functions.php
	*/
	function getAccountHeader($user,$page){
 		$header = '<header>'."\r\n";
 		$header .= "<h1>SP Financial Services</h1>\r\n";
 		$header .= getNavigation($user,$page);
 		$header .= "</header>\r\n";
 		return $header;
 	}
 	
 	/*
		this sets up the account form page by calling getHead and getAccountForm 
	*/
 	function addAccountForm($user){
		$page = "addAccountPage";
		$html = getHead($page);
		$html .= '<body>'."\r\n";
		$html .= getAccountForm($user,$page);
		$html .= "</body>\r\n";
		return $html;
	}
	
	/*	
		this sets up the account form container by calling the header, sidebar, account 
		and footer
	*/
	function getAccountForm($user,$page){
		$content = '<div class="container">'."\r\n";
 		$content .= getAccountHeader($user,$page);
 		$content .= addAccount($user);
 		$content .= '<div class="clear">'."</div>\r\n";
 		$content .= getFooter();
 		$content .= "</div>\r\n";
 		return $content;
	}
	
	/*
		this creates the form for adding an account 
	*/
	function addAccount($user){
		if(isset($_SESSION['errorAdd'])){//if error in add account then print error msg	
			$form = '<section class="accountsPage">'."\r\n";
			$form .= '<p class = "noAccounts">'."Sorry Account Could not be Added, Try Again"."</p>\r\n";
			$form.= '<h2 class="form-signin-heading">'."Fill Out The Information to Add an Account</h2>\r\n";
			$dirName = "formContent";
			$form .= '<form  id="accountForm" role="form" method="post" action="accountAddProcess.php">'."\r\n";
			$file = "./".$dirName."/".'2'.".txt";
			$form .= file_get_contents($file)."\r\n";
			$form .= "</form>\r\n";
			$form .= "</section>"."\r\n";
			unset($_SESSION['errorAdd']);//used when page needs to be refreshed 
		}else{//else no error msg
			$form = '<section class="accountsPage">'."\r\n";
			$form.= '<h2 class="form-signin-heading">'."Fill Out The Information to Add an Account</h2>\r\n";
			$dirName = "formContent";
			$form .= '<form  id="accountForm" role="form" method="post" action="accountAddProcess.php">'."\r\n";
			$file = "./".$dirName."/".'2'.".txt";
			$form .= file_get_contents($file)."\r\n";
			$form .= "</form>\r\n";
			$form .= "</section>"."\r\n";
			}
		return $form;
 	}

?>
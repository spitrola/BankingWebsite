<?php
/*
	sets up the stylesheets(bootstrap and my stylesheet) along with the doctype and meta tag
*/
function getHead($page){
		$dirName = "titles";
		$head = "<!DOCTYPE html>\r\n<html lang='en'>\r\n";
			$head .= "<head>\r\n<meta charset= 'utf-8'>\r\n";
			$head .= "<link rel='stylesheet' type='text/css' href='http://yui.yahooapis.com/3.13.0/build/cssreset/cssreset-min.css'>"."\r\n";
 			$head .= "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>"."\r\n";
 			$head .= "<link  rel='stylesheet' href='stylesheet.css'>\r\n";
 			$head .= "<link rel='icon' type='image/png' href='images/favicon.ico'>"."\r\n";
 		$file = getFileName($page,$dirName);//get file name
 		$head .= getTitle($file);//placing file name in getTitle to get the title
		$head .= "</head>\r\n";
		return $head;
	}	
	
/*
	sets up the navigation on every page display contact us and about us
	on other pages also display the add account, active accounts, and logout 
*/
 	function getNavigation($user,$page){
 		$nav = '<nav class ="navigationStyle">'."\r\n";
 		$nav .= '<ul>'."\r\n";
 		if($page == "account"){//checks to see if page is equal to account if so then add the current style
 			$nav .= '<li class="linkButton">'.'<a href = "account.php" id="current">Active Accounts</a>'."</li>\r\n";
 		}
 		else{//else dont add the current style
 			$nav .= '<li class="linkButton">'.'<a href = "account.php">Active Accounts</a>'."</li>\r\n";
 		}
 		if($page == "addAccountPage"){//checks to see if page is equal to addAccountPage if so then add the current style
 			$nav .= '<li class="linkButton">'.'<a href = "addAccountPage.php" id="current">Add Account</a>'."</li>\r\n";
 		}
 		else{//else dont add the current style
 			$nav .= '<li class="linkButton">'.'<a href = "addAccountPage.php">Add Account</a>'."</li>\r\n";
 		}
		$nav .= '<li class="linkButton">'.'<a href = "logout.php">Click Here to Logout '.ucfirst($user).'</a>'."</li>\r\n";
 		$nav .= "</ul>\r\n";
 		$nav .= "</nav>\r\n";
 		return $nav;
 	} 	
	 	
/*
	this function gets the login form...if user equals firstlogin then display login without 
	and error message.
	else if the user is equal to error then display an error message saying username and password 
	is incorrect
*/ 	
 	function getLoginForm($user){
		if($user == "firstLogin"){
			$dirName = "formContent";
			$form = '<form class="form-signin" method="post" action="process_form.php">'."\r\n";
			$form .= '<h2 class="form-signin-heading">'."Login To Our Secure Finacial Services Site</h2>\r\n";
			$file = "./".$dirName."/".'1'.".txt";
			$form .= file_get_contents($file)."\r\n";
			$form .= "</form>\r\n";
		}else if($user == "error"){
			$dirName = "formContent";
			$form = '<form class="form-signin" method="post" action="process_form.php">'."\r\n";
			$form .= '<h2 class="form-signin-heading">'."Login To Our Secure Finacial Services Site</h2>\r\n";
			$form .= '<p class="noAccounts">'."Username and Password are Incorrect, Please Try Again"."</p>\r\n";
			$file = "./".$dirName."/".'1'.".txt";
			$form .= file_get_contents($file)."\r\n";
			$form .= "</form>\r\n";
			unset($_SESSION['error']);//used when page needs to be refreshed 
		}
			return $form;
 	}
/*
	this sets up the footer content...date, contact us and copy right
*/ 	
  	function getFooter(){
 		$dirName = "footer";
 		$footer = '<footer id="footer">'."\r\n";
 		$footer .= '<p id="contactUs">Contact Us: Toll Free Number: 1888 999 7888'."</p>\r\n";
 		date_default_timezone_set('America/Edmonton');
 		$footer .= '<p id="date"> Date: '.date("F j, Y g:i a")."</p>\r\n";
 		$footer .= '<p id="copy"> &copy; SP Banking Financial Services Site</p>';
 		$footer .= "</footer>\r\n";
 		return $footer;
 	} 
 	
/*
	getting the title called from head
*/		
 	function getTitle($file){
		$title = file_get_contents($file);//opening up the file 
 		return "<title>".$title."</title>"."\r\n";
 	} 	
 	
/*
	this gets the file name
*/ 	
 	 function getFileName($page,$dirName){
		$path = "./";//path symbol
		$extension = ".txt";//hard-coding the file extension
		$directory = $dirName;//making directory equal to dirName
 		$file = $path.$directory."/".$page.$extension;//place everything 
 		return $file;
 	}
	
?>
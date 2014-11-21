<?php
	include_once("functions.php");
	/*
		the get welcome header sets up the title along with the navigation 
		which is called from functions.php
	*/
	function getWelcomeHeader($user,$page){
 		$header = '<header>'."\r\n";
 		$header .= "<h1>SP Financial Services</h1>\r\n";
 		$header .= "</header>\r\n";
 		return $header;
 	}
 	
	/*
		get welcome content takes in the user and page and sets up the header according 
		to the page. This sets up the main container for the login page also known as the
		welcome page
	*/
	function getWelcomeContent($user,$page){
 		$content = '<div class="container">'."\r\n";
 		$content .= getWelcomeHeader($user,$page);
 		$content .= getWelcome($user);
 		$content .= '<div class="clear">'."</div>\r\n";
 		$content .= getFooter();
 		$content .= "</div>\r\n";
 		return $content;
 	}
 	
	/*
		the get welcome page sets up the login form 
	*/
	function getWelcome($user){
		$welcome = '<section id="welcomeContent">'."\r\n";
		$welcome .= getLoginForm($user);
		$welcome .= "</section>\r\n";
		return $welcome;
	}
	
	/*
		the welcome page sets up the whole page by calling the head and welcome content
	*/
	function welcomePage($user){
		$page = "home";
		$html = getHead($page);
		$html .= '<body>'."\r\n";
		$html .= getWelcomeContent($user,$page);
		$html .= "</body>\r\n";
		return $html;
	}
?>
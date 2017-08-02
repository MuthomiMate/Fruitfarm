<?php
		
	session_start();

	if (!isset($_SESSION['id'])) {
	    $_SESSION['msg'] = "No session found. Please log In";
		header("location: http://onesha.dev/www/fruitfarm/account?msg=".$_SESSION['msg']);
	    
	} 
		

?>


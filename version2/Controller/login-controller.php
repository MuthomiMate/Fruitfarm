<?php
	
	require_once('../Models/adminmodel.php');

	$h = new User();
	$ad = new Admin();	
	
	session_start();
	//session_unset($_SESSION['id']);
	if (isset($_SESSION['id'])) {
		$id = $_SESSION['id'];
	    $_SESSION['msg'] = "Already logged in";
		header("location: ../dashboard?".$_SESSION['msg']);	    
	}

	else if(isset($_POST['login'])) {
		//session_unset($_SESSION['id']);
		
		$email = $_POST['email'];
		$password = $_POST['password'];
		$usertype = $_POST['usertype'];

		if ($usertype == 1) {
			$d = $ad->adminLogin($email, $password);
		} else{
			$d = $h->login($email, $password);
		}
		
		
		if ($d != null) {
			
			$_SESSION['id'] = $d['customer_id'];
			$_SESSION['name'] = $d['firstname'];

			$id = $d['customer_id'];
			$_SESSION['type'] = $usertype;
			$_SESSION['msg'] = "Login Successfull";

		
			//Check user role and redirect them to the correct page
			if($usertype == 1) { //Super Admin Page
				header("location: ../adminboard?msg=".$_SESSION['msg']);		
			}
			elseif($usertype == 2) { //Normal User Page
				
				header("location: ../dashboard?msg=".$_SESSION['msg']);
			}

		} else {
			 $_SESSION['msg'] = "Please check your login details <br>";
			 header("location: ../account?msg=".$_SESSION['msg']);
			 
		}
	} else { header("location: ../account"); }
?>


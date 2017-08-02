<?php

	require_once('../Models/usermodel.php');
	$h = new User();

	if(isset($_POST['signup'])) {
			
		$fname = $_POST['firstname'];
		$lname = $_POST['lastname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$pword = $_POST['password'];
		$address = $_POST['address'];
		$location = $_POST['location'];
		$usertype = $_POST['usertype'];

		if($fname != "" && $lname != "" && $email != "" && $pword != "" && $phone != "" ) { //check if not empty
			$d = $h->signup($fname, $lname, $email, $phone, $address, $pword, $location);
			
			if ($d) {
				//create session
				session_start();
				$_SESSION['id'] = $d['customer_id'];
				$_SESSION['name'] = $d['firstname'];

				$id = $d['customer_id'];
				$_SESSION['type'] = $usertype;

				//take user to dashboard according to their role
				$_SESSION['msg'] = "Welcome ".$fname;
				//Check user role and redirect them to the correct page
				if($usertype == 1) { //Admin Page
					header("location: ../adminboard");
				}
				elseif($usertype == 2) { //Normal User Page
					header("location: ../dashboard");
				}
			}
			else {
				$msg = "An error has occurred";
				header("location: ../account.php");
			}

		} else {
			echo "Please fill all fields";
			$_SESSION['msg'] = "Please fill all fields";
			header("refresh:1;url= ../account");
		}

	} else { header("location: ../account"); }
?>
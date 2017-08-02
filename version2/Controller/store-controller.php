<?php

	require_once('../Models/usermodel.php');
	$h = new User();

	if(isset($_POST['signup'])) {
			
		$fname = $_POST['firstname'];
		$email = $_POST['email'];
		$pword = $_POST['password'];
		$usertype = $_POST['usertype'];
		$approved = $_POST['approved'];

		//check if not empty
		if($fname != "" && $email != "" && $pword != "" ) {
			$result = $h->signup($fname, $email, $pword, $usertype, $approved);
			if ($result) {
				//login the user
				//create session
				$id = $result;
				session_start();
				$_SESSION['id'] = $id ;
				//take user to dashboard according to their role
				$msg = "successful Login";
				header("location: ../views/dashboard.php?msg=".$msg."&id=@".$id);
			} else {
				$msg = "An error has occurred";
				header("location: ../views/signup.php?msg=".$msg);
			}

		} else {
			echo "Please fill all fields";
			$msg = "Please fill all fields";
			header("refresh:5;url= ../views/signup.php?msg=".$msg);
		}

	} else { header("location: ../views/signup.php?msg=".$msg."&id=@".$id); }
?>
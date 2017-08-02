<?php		
	require_once('../Models/profilemodel.php');

	$pro = new Profile();
	$user = new User();

	@session_start();

	if (!isset($_SESSION['id'])) {
	    $msg = " Please log In &id=@".$_SESSION['id'];
		header("location: ../pages/login.php?msg=".$msg);
	    
	}
	//read session info
	$uid = $_SESSION['id'][0]['id'];
	$utype =$_SESSION['id'][0]['type'];
	if ($utype == 1) { $usertype = "Superadmin";}
	elseif ($utype == 2) { $usertype = "Bookstore";}
	elseif ($utype == 3) { $usertype = "Corporate";}
	elseif ($utype == 4) { $usertype = "Individual";}

	//read user info
	$profileData = $pro->readProfile($uid); 
	$firstname = ucfirst($profileData[0]['fname']);
	$lastname = ucfirst($profileData[0]['lname']);
	$email = ucfirst($profileData[0]['email']);
	$username = $firstname." ".$lastname;
	$location = @ucfirst($profileData[1][0]['location']);
	$description = @ucfirst($profileData[1][0]['description']);

	//look for the pressed button
	if(isset($_POST['save-details'])) {
		//get the variables
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		//call the function
		$d = $user->editUser($uid,$firstname, $lastname);
		//check the result if not null
		if($d != null) {
			//show success message
			$msg = "Submited Successfully";
			header("location: ../views/profile.php?msg=".$msg);
		} else {
			//show error message
			$msg = "Failed to update";
			header("location: ../views/profile.php?msg=".$msg);
		}
	}
	//look for the pressed button (edit user profile)
	elseif(isset($_POST['save-profile'])) {
		//get the variables
		$description = $_POST['description'];
		$location = $_POST['location'];
		//call the function
		$d = $pro->editProfile($uid, $fname, $lname);
		//check the result if not null
		if($d != null) {
			//show success message
			$msg = "Submited Successfully";
			header("location: ../views/profile.php?msg=".$msg);
		} else {
			//show error message
			$msg = "Failed to update";
			header("location: ../views/profile.php?msg=".$msg);
		}
	}
	//look for the pressed button (add to the profile)
	elseif(isset($_POST['add-details'])) {
		//get the variables
		$description = $_POST['description'];
		$location = $_POST['location'];
		//call the function
		$d = $pro->addProfile($uid, $description, $location);
		//check the result if not null
		if($d != null) {
			//show success message
			$msg = "Added Successfully";
			header("location: ../views/profile.php?msg=".$msg);
		} else {
			//show error message
			$msg = "Failed to update";
			header("location: ../views/profile.php?msg=".$msg);
		}
	}
?>


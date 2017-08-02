<?php	

	require('Models/itemmodel.php');
	require_once('Models/categorymodel.php');

	$pro = new Item();
	$cat = new Category();
	@session_start();

	//read session info
	if (isset($_SESSION['id'])) {
		$uid = $_SESSION['id'];
		$allproductsFor = $pro->getAllItemsFor($uid);
	}
	

	//read product info
	$allproducts = $pro->getAllItems();
	$allBestProducts = $pro->getBestItems();
	$allCategories = $cat->getCategories();
	//$deleted=  $pro->deleteproduct($id);

	//delete if isset action
	if(isset($_GET['action'])) {
		if ($_GET['action'] == "delete") { 
			$d = $pro->deleteproduct($_GET['id']);
			if($d != null) {
			//show success message
			$msg = "Deleted Successfully";
			header("location: ../views/productstore.php?msg=".$msg);
			} else {
				//show error message
				$msg = "Failed to Delete";
				header("location: ../views/productstore.php?msg=".$msg);
			}
		} elseif ($_GET['action'] == "edit") {
			$productinfo = $pro->getproduct(($_GET['id']));
			if ($productinfo != null) {
				$_SESSION['data'] = $productinfo;
				header("location: ../views/product_editor.php?action=edit");
			} else {
				//show error message
				$msg = "No product Info";
				header("location: ../views/productstore.php?msg=".$msg);
			}
		} elseif ($_GET['action'] == "buy") {			
			$productinfo = $pro->getproduct(($_GET['id']));	
			
			if ($productinfo != null) {
				$_SESSION['product'] = $productinfo;
				header("location: ../views/buyer.php");
			} else {
				//show error message
				$msg = "No product Info";
				header("location: ../views/dashboard.php?msg=".$msg);
			}
		}
	}
	//look for the pressed button
	if(isset($_POST['save_product'])) {
		
		//get the variables
		$category = $_POST['category'];
		$title = $_POST['title'];
		$author = $_POST['author'];
		$edition = $_POST['edition'];
		$publisher = $_POST['publisher'];
		$cost = $_POST['cost'];
		$copies = $_POST['copies'];
		$status = $_POST['status'];

		$isbn = trim($_POST['title'])."-".trim($_POST['author'])."-".trim($_POST['edition']);
		//call the function
		$d = $pro->addproduct($isbn, $category, $title, $author ,$edition ,$publisher ,$cost ,$copies, $status, $uid );
		//check the result if not null
		if($d != null) {
			if ($d !== 1) {
				//show success message
			$msg = "The product already exists.";
			header("location: ../views/productstore.php?msg=".$msg);
			}else {
			//show success message
			$msg = "Submited Successfully";
			header("location: ../views/productstore.php?msg=".$msg);
			}
		} else {
			//show error message
			$msg = "Failed to update";
			header("location: ../views/product_editor.php?msg=".$msg);
		}
	}
	if(isset($_POST['edit-product'])) {

		var_dump($_POST); 
		//get the variables
		$id = $_POST['id'];
		//$category = $_POST['category'];
		//$title = $_POST['title'];
		//$author = $_POST['author'];
		//$edition = $_POST['edition'];
		//$publisher = $_POST['publisher'];
		$cost = $_POST['cost'];
		$status = $_POST['status'];
		$copies = $_POST['copies'];
		$data  = array('copycost' => $cost,'copies' => $copies,'status' => $status);

		//call the function
		$d = $pro->editproduct($id, $data );
		//check the result if not null
		if($d != null) {
			//show success message
			$msg = "Submited Successfully";
			header("location: ../views/productstore.php?msg=".$msg);
		} else {
			//show error message
			$msg = "Failed to update";
			header("location: ../views/product_editor.php?msg=".$msg);
		}
	}
?>
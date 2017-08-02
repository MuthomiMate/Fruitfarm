<?php		
	require_once('../Models/tendermodel.php');

	$pro = new Tender();
	@session_start();

	if (!isset($_SESSION['id'])) {
	    $msg = " Please log In &id=@".$_SESSION['id'];
		header("location: ../pages/login.php?msg=".$msg);
	    
	}
	//read session info
	$uid = $_SESSION['id'][0]['id'];

	//read book info
	$allTenders = $pro->getAllTenders();
	//$allCatBooks = $pro->getAllBooks($cat,$val);
	//$allBooksFor = $pro->getAllBooks($id);
	//$deleted=  $pro->deleteBook($id);
	//delete if isset action
	if(isset($_GET['action'])) {
		if ($_GET['action'] == "delete") { 
			$d = $pro->deleteTender($_GET['id']);
			if($d != null) {
			//show success message
			$msg = "Deleted Successfully";
			header("location: ../views/bookstore.php?msg=".$msg);
			} else {
				//show error message
				$msg = "Failed to Delete";
				header("location: ../views/bookstore.php?msg=".$msg);
			}
		} elseif ($_GET['action'] == "edit") { 
			$bookinfo = $pro->getBook(($_GET['id']));
			if ($bookinfo != null) {
				$_SESSION['data'] = $bookinfo;
				header("location: ../views/book_editor.php?action=edit");
			} else {
				//show error message
				$msg = "No Book Info";
				header("location: ../views/bookstore.php?msg=".$msg);
			}
		}
	}
	//add tender function
	//look for the pressed button
	if(isset($_POST['save_tender'])) {
		
		//get the variables
		$category = $_POST['category'];
		$title = $_POST['title'];
		$author = $_POST['author'];
		$edition = $_POST['edition'];
		$publisher = $_POST['publisher'];
		$cost = $_POST['cost'];
		$copies = $_POST['copies'];
		//call the function
		$d = $pro->addBook($category, $title, $author ,$edition ,$publisher ,$cost ,$copies, $uid );
		//check the result if not null
		if($d != null) {
			//show success message
			$msg = "Submited Successfully";
			header("location: ../views/bookstore.php?msg=".$msg);
		} else {
			//show error message
			$msg = "Failed to update";
			header("location: ../views/book_editor.php?msg=".$msg);
		}
	}
	if(isset($_POST['edit-book'])) {
		//get the variables
		$id = $_POST['id'];
		$category = $_POST['category'];
		$title = $_POST['title'];
		$author = $_POST['author'];
		$edition = $_POST['edition'];
		$publisher = $_POST['publisher'];
		$cost = $_POST['cost'];
		$copies = $_POST['copies'];
		$data  = array('category' => $category,'title' => $title,'author' => $author,'edition' => $edition,'publisher' => $publisher,'copycost' => $cost,'copies' => $copies);

		//call the function
		$d = $pro->editBook($id, $data );
		//check the result if not null
		if($d != null) {
			//show success message
			$msg = "Submited Successfully";
			header("location: ../views/bookstore.php?msg=".$msg);
		} else {
			//show error message
			$msg = "Failed to update";
			header("location: ../views/book_editor.php?msg=".$msg);
		}
	}
?>
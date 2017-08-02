<?php 
require_once("main.php");
 
class Category extends Main
{

	public function addCategory($name)
	{
		$querry="INSERT INTO category (category_id, category_name) VALUES (null, :name) ";
		
		$result= $this->conn->prepare($querry);		
		$result->execute(array( ':name'=>$name));
		$row= $result->lastInsertId();
		return $row;
	}

	public function getCategories() {
		$querry = "SELECT category_id, category_name, category_icon  FROM category";
		$result= $this->conn->prepare($querry);	
		$result->execute();
		$results = $result->fetchAll();
		$row= $result->rowCount();
		if ($row > 0) {
			return $results;
		} else {
			return false;
		}
		
	}

	//Get all fruits in a category
	public function getFruitsInCategory($id) { 
		$querry="SELECT * FROM items WHERE category = :val  ";
		$result= $this->conn->prepare($querry);	
		$result->execute(array(':val'=>$id));
		$results = $result->fetchAll();
		return $results;
	}

	public function editCategory($id, $details) { 
		$val = array();
		foreach ($details as $key => $value) {
		 	if ($value) {
		 		$querry="UPDATE items SET  $key = $value WHERE id = $id ";
				$result= $this->conn->prepare($querry);		
				$result->execute();
				$row= $result->rowCount();
				array_push($val, $row, $querry, "<br>");
				
		 	} else { continue; }
			
		 }
	 	if ($row < 0) {
	 		var_dump('failed');
			return false;
		}
	 	var_dump($result->rowCount());
	 	var_dump($val);
		return true;
	}

	public function deleteCategory($id) { 
		$querry="DELETE from category WHERE category_id = :id ";
		$result= $this->conn->prepare($querry);		
		$result->execute(array(':id'=>$id));
		$row= $result->rowCount();


		return $row;
	}

	//Check if a category exists
	public function categoryExists($id) { 
		$querry="SELECT category_id FROM category WHERE category_id = :id";
		$result= $this->conn->prepare($querry);
		$result->setFetchMode(PDO::FETCH_ASSOC);

		$result->execute(array(':id'=>$id));
		$row= $result->rowCount();
		return $row;
	}

}
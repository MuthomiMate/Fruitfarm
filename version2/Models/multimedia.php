<?php 
require_once("main.php");

class Multimedia extends Main
{

	public function addMedia($name, $path, $item_id)
	{
		$querry="INSERT INTO media (media_id, name, path, item_id) VALUES (null, :name, :path, :item) ";
		
		$result= $this->conn->prepare($querry);		
		$result->execute(array( ':name'=>$name, ':path'=>$path,':item'=>$item_id));
		$row= $result->lastInsertId();
		return $row;
	}

	//Get a single media 
	public function getMedia($id) { 
		$querry="SELECT * FROM media WHERE item_id = :id ";
		$result= $this->conn->prepare($querry);		
		$result->execute(array(':id'=>$id));
		$results = $result->fetchAll();
	}

	//Edit a single media 
	public function editMedia($id,$details) {
		$val = array();
		foreach ($details as $key => $value) {
		 	if ($value) {
		 		$querry="UPDATE media SET  $key = $value WHERE media_id = $id ";
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

	//Delete a single media 
	public function deleteMedia($id) {
		$querry="DELETE from media WHERE media_id = :id ";
		$result= $this->conn->prepare($querry);		
		$result->execute(array(':id'=>$id));
		$row= $result->rowCount();


		return $row;
	}

}
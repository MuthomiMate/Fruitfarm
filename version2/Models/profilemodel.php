<?php 
require_once("usermodel.php");
 
class Profile extends User
{

	//Get a single profile info
	public function readProfile($id) { 
		$querry="SELECT * FROM users WHERE id = :id ";
		$result= $this->conn->prepare($querry);		
		$result->execute(array(':id'=>$id));
		$results = $result->fetchAll();

		$querry2="SELECT * FROM profile WHERE id = :id ";
		$result2= $this->conn->prepare($querry2);		
		$result2->execute(array(':id'=>$id));
		$results2 = $result2->fetchAll();

		array_push($results, $results2);
		return $results;
	}
	public function addProfile($id, $description, $location) {
		$querry="INSERT INTO profile (id, m_id, location, description) VALUES (:id, 2,:location,:description) ";
		$result= $this->conn->prepare($querry);		
		$result->execute(array(':id'=>$id, ':description'=>$description, ':location'=>$location));
		$row= $result->rowCount();

		return $row;
	}
	public function editProfile($id, $fn, $ln) {
		$querry="UPDATE profile SET  fname = :fname, lname = :lname WHERE id = :id ";
		$result= $this->conn->prepare($querry);		
		$result->execute(array(':id'=>$id, ':fname'=>$fn, ':lname'=>$ln));
		$row= $result->rowCount();

		if ($row > 0) {
			echo "Record updated successfully";
		}
	}	

	public function deleteProfile($id) { }

	//Check if a user exists
	public function userHasProfile($id) { }

}
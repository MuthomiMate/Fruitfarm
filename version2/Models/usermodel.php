<?php 
require_once("main.php");
 
class User extends Main {	

	//$main = new Main();

	public function signup($fname, $lname, $email, $phone, $address, $pword, $location)
	{
		$querry="INSERT INTO customers (customer_id, firstname, lastname, email, phone_no, address, password, location, active) VALUES ( null, :fname, :lname, :email, :phone, :address ,:pword, :location, 1)";
		$result= $this->conn->prepare($querry);

		$pass = sha1($pword);

		$result->execute(array(':fname'=>$fname, ':lname'=>$lname, ':email'=>$email, ':phone'=>$phone, ':pword'=>$pass, ':address'=>$address, ':location'=>$location));

		$row= $result->rowCount();
		if ($row >0) {
			//$id = $this->conn->lastInsertId();
			//$results = $this->login($email, $pword);
			return $row;
		} else {
			return $row;
		}
		
	}

	public function login($email, $pword)
	{
		$udate= date('Y-m-d H:i:s');
		$querry="SELECT email FROM customers WHERE email = :email AND active = 1";
		$result= $this->conn->prepare($querry);
		$result->setFetchMode(PDO::FETCH_ASSOC);

		$result->execute(array(':email'=>$email));
		$row= $result->rowCount();
		if($row>0)
		{
			$pass = sha1($pword);
			$querry="SELECT customer_id, firstname FROM customers WHERE email = :email AND password = :pword";
			$results= $this->conn->prepare($querry);
			$results->setFetchMode(PDO::FETCH_ASSOC);

			$results->execute(array(':email'=>$email, ':pword'=>$pass));
			$data= $results->fetchall();

			$row= $results->rowCount();
			if($row==1){
				return $data[0];
			} else {
				return false;
			}

		} else {
			return false;
		}

	}

	//Edit a user info
	public function editUser($id,$fn,$ls) {
		$querry="UPDATE customers SET  firstname = :firstname, lastname = :lastname WHERE customer_id = :id ";
		$result= $this->conn->prepare($querry);		
		$result->execute(array(':id'=>$id, ':firstname'=>$fn, ':lastname'=>$ls));
		$row= $result->rowCount();

		return $row;
	}

	public function logout($id) { }

}

?>
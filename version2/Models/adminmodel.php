<?php 
require_once("usermodel.php");
 
class Admin extends User
{
	public function adminSignup($uname, $email, $pword, $phone)
	{
		$querry="INSERT INTO admins (admin_id, username, email, password, phone_no) VALUES ( null, :uname, :email, :pword, :phone )";
		$result= $this->conn->prepare($querry);

		$pass = sha1($pword);

		$result->execute(array(':uname'=>$fname,':email'=>$email, ':phone'=>$phone, ':pword'=>$pword));

		$row= $result->rowCount();
		$id = $this->conn->lastInsertId();
		$results = $this->login($email, $pword);
		return $results;
	}

	public function adminLogin($email, $pword)
	{
		$udate= date('Y-m-d H:i:s');
		$querry="SELECT email FROM admins WHERE email = :email ";
		$result= $this->conn->prepare($querry);
		$result->setFetchMode(PDO::FETCH_ASSOC);

		$result->execute(array(':email'=>$email));
		$row= $result->rowCount();
		if($row>0)
		{
			$pass = sha1($pword);
			$querry="SELECT admin_id FROM admins WHERE email = :email AND password = :pword ";
			$results= $this->conn->prepare($querry);
			$results->setFetchMode(PDO::FETCH_ASSOC);

			$results->execute(array(':email'=>$email, ':pword'=>$pass));
			$data= $results->fetchall();

			$row= $results->rowCount();

			if($row==1){
				return $data;
			} else {
				return "Wrong Password";
			}

		} else {
			return "The email doesn't exist";
		}

	}

	public function adminLogout($id) { }

	//Get a single user info
	public function getUser($id) {
		$querry="SELECT * FROM customers WHERE customer_id = :id ";
		$result= $this->conn->prepare($querry);
		$result->setFetchMode(PDO::FETCH_ASSOC);		
		$result->execute(array(':id'=>$id));
		$data= $result->fetchall();
		return $data;
	}

	//Get all users
	public function getAllUsers() { 
		$querry="SELECT * FROM customers  ";
		$result= $this->conn->prepare($querry);		
		$result->execute();
		$results = $result->fetchAll();
		return $results;
	}
	

	//Enable/Disable a user
	public function enableUser($id, $value) { 
		$querry="UPDATE customers SET  active = $value WHERE id = $id ";
		$result= $this->conn->prepare($querry);		
		$result->execute();
		$row= $result->rowCount();
	}

	//Delete a user
	public function deleteUser($id) {
		$querry="DELETE * FROM users  WHERE customer_id = :id ";
		$result= $this->conn->prepare($querry);		
		$result->execute(array(':id'=>$id));
		return true;
	}

	//Check if a user exists
	public function userExists($id) {
		$querry="SELECT customer_id FROM customers WHERE customer_id = :id";
		$result= $this->conn->prepare($querry);
		$result->setFetchMode(PDO::FETCH_ASSOC);

		$result->execute(array(':id'=>$id));
		$row= $result->rowCount();
		return $row;
	}


}
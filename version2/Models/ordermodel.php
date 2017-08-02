<?php 
require_once("main.php");
 
class Order extends Main
{

	public function addOrder($category,$title,$edition,$copies_no,$delivery_deadline,$location,$id)
	{
		$querry="INSERT INTO orders (id,category, title, edition, copies_no, delivery_deadline, location, user_id) VALUES (null, :category, :title, :edition, :copies_no, :delivery_deadline, :location, :id) ";
		$result= $this->conn->prepare($querry);		
		$result->execute(array( ':category'=>$category,':title'=>$title,':edition'=>$edition,':copies_no'=>$copies_no,':delivery_deadline'=>$delivery_deadline, ':copies_no'=>$copies_no, ':id'=>$id));
		$row= $result->rowCount();
		return $row;
	}

	public function addOrderDetails($category,$title,$edition,$copies_no,$delivery_deadline,$location,$id)
	{
		$querry="INSERT INTO orders (id,category, title, edition, copies_no, delivery_deadline, location, user_id) VALUES (null, :category, :title, :edition, :copies_no, :delivery_deadline, :location, :id) ";
		$result= $this->conn->prepare($querry);		
		$result->execute(array( ':category'=>$category,':title'=>$title,':edition'=>$edition,':copies_no'=>$copies_no,':delivery_deadline'=>$delivery_deadline, ':copies_no'=>$copies_no, ':id'=>$id));
		$row= $result->rowCount();
		return $row;
	}

	//Get a single Order info
	public function getOrder($id) { 
		$querry="SELECT * FROM orders WHERE id = :id ";
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

	public function getAllOrders($cat = null, $val = null) {
		if ( is_null($cat)) {
			$querry="SELECT * FROM books  ";
			$result= $this->conn->prepare($querry);		
			$result->execute();
			$results = $result->fetchAll();
			//return $results;
			return"silly";
		}else {
			$querry="SELECT * FROM orders WHERE $cat = :val  ";
			$result= $this->conn->prepare($querry);		
			$result->execute(array(':val'=>$cat));
			$results = $result->fetchAll();
			return $results;					
		}
	}

	public function getAllOrdersFor($id) {
		$querry="SELECT * FROM orders WHERE owner_id = :val  ";
			$result= $this->conn->prepare($querry);		
			$result->execute(array(':val'=>$id));
			$results = $result->fetchAll();
			return $results;
	}

	public function editOrder($id,$details) {
		$val = array();
	foreach ($details as $key => $value) {
	 	if ($value) {
	 		$querry="UPDATE orders SET  $key = $value WHERE id = $id ";
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

	public function deleteOrder($id) { 
		$querry="DELETE from orders WHERE id = :id ";
		$result= $this->conn->prepare($querry);		
		$result->execute(array(':id'=>$id));
		$row= $result->rowCount();


		return $row;
	 }

	//Check if a book exists
	public function OrderExists($id) { }

}
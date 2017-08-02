<?php 
require_once("main.php");
 
class Item extends Main
{

	public function addItem($name,$des,$cat,$qty,$price)
	{
		
		$querry="INSERT INTO items (item_id, item_name, description, category, quantity, price, date_added) VALUES (null, :name, :description, :category, :quantity, :price, null) ";
		
		$result= $this->conn->prepare($querry);		
		$result->execute(array( ':name'=>$name, ':category'=>$cat,':description'=>$des,':quantity'=>$qty,':price'=>$price));
		$row= $result->lastInsertId();
		return $row;
		
	}

	//Get a single bid info
	public function getItem($id) { 
		$querry="SELECT * FROM items WHERE item_id = :id ";
		$result= $this->conn->prepare($querry);		
		$result->execute(array(':id'=>$id));
		$results = $result->fetchAll();

		$querry2="SELECT * FROM media WHERE item_id = :id ";
		$result2= $this->conn->prepare($querry2);		
		$result2->execute(array(':id'=>$id));
		$results2 = $result2->fetchAll();

		array_push($results, $results2);
		return $results;

	}

	//get all items existing
	public function getAllItems() {
			$querry="SELECT * FROM items  ";
			$result= $this->conn->prepare($querry);		
			$result->execute();
			$results = $result->fetchAll();
			return $results;
	}

	//get all items for a category
	public function getAllItemsFor($id) {
		$querry="SELECT * FROM items WHERE category = :val  ";
		$result= $this->conn->prepare($querry);	
		$result->execute(array(':val'=>$id));
		$results = $result->fetchAll();
		return $results;
	}

	//get all best selling items existing
	public function getBestItems() {
			$querry = "SELECT

			   items.item_id as 'id',
			   items.item_name as 'name',
			   items.price as 'price',
			   items.thumbnail as 'thumbnail',

			    SUM(order_details.quantity) as 'total',
			    order_details.status,
			    order_details.item_id

			    FROM items, order_details
			    WHERE items.item_id = order_details.item_id AND order_details.status = '2'
			    GROUP BY items.item_id
			    ORDER BY SUM(order_details.quantity) DESC LIMIT 3";
			$result= $this->conn->prepare($querry);		
			$result->execute();
			$results = $result->fetchAll();

			$row= $result->rowCount();
			if ($row > 0) {
				return $results;
			} else { return false; }
	}

	public function editItem($id,$details) {
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

	public function deleteItem($id) { 
		$querry="DELETE from items WHERE item_id = :id ";
		$result= $this->conn->prepare($querry);		
		$result->execute(array(':id'=>$id));
		$row= $result->rowCount();


		return $row;
	 }

	//Check if a Item exists
	public function ItemExists($id) {
		$querry="SELECT item_id FROM items WHERE item_id = :id";
		$result= $this->conn->prepare($querry);
		$result->setFetchMode(PDO::FETCH_ASSOC);

		$result->execute(array(':id'=>$id));
		$row= $result->rowCount();
		return $row;
	}

}
<?php
include 'db.php';
if(isset($_POST)){

	$price = $_POST['total'];
	$quantity=$_POST['qty'] ;
	$item=$_POST['item'];

	$query="SELECT * FROM orders WHERE status='ordered'";
	$result= $connection->query($query);
	$rowproduct = $result1->fetch_assoc();
	$orderid=$rowproduct['order_id'];

	$query_details = "UPDATE order_details SET price= '$price', quantity = '$quantity' WHERE order_id = '$orderid' AND item_name='$item'";
            $resultdetails = $connection->query($query_details);

}

  
?>
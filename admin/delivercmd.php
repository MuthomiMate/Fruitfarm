<?php
session_start();

  include_once '../db.php';

if (isset($_GET['id']) && isset($_GET['userid'])) {
   $id=$_GET['id'];
   $iduser = $_GET['userid'];


	$queryupdate = "UPDATE orders SET status = 'delivered' WHERE order_id = '$id' ";
  
          $result_update = $connection->query($queryupdate);

        if ($result_update) {
          $queryupdate = "UPDATE order_details SET status = '2' WHERE detail_id = '$id'";
          
        }
          header('Location: ' . $_SERVER['HTTP_REFERER']);
       
}

else {
  header('Location: ../sign');
}
?>

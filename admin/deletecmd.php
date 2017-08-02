<?php
session_start();

  include_once '../db.php';

if (isset($_GET['id']) && isset($_GET['userid'])) {
   $id=$_GET['id'];
   $iduser = $_GET['userid'];

   $query_delete = "DELETE FROM orders WHERE order_id = '$id' ";
   $result_delete = $connection->query($query_delete);

    if ($result_delete) {
        	$queryupdate = "DELETE FROM order_details WHERE order_id = '$id'";
    }
header('Location: ' . $_SERVER['HTTP_REFERER']);
}

else {
  header('Location: ../sign');
}
?>

<?php

session_start();

if ($_SESSION['role'] !== 'admin') {
  header('Location: ../index');
}

$category = $_GET['id'];

 require 'includes/header.php';
 require 'includes/navconnected.php'; //require $nav;?>

 <div class="container-fluid product-page">
   <div class="container current-page">
      <nav>
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="index" class="breadcrumb">Dashboard</a>
            <a href="products" class="breadcrumb">Stock</a>
            <a href="productstock" class="breadcrumb">Products</a>
          </div>
        </div>
      </nav>
    </div>
   </div>
   <div class="container stocki">
       <div class="row">
           <?php
           include '../db.php';
            // get stock
            $query = "SELECT * FROM product WHERE id_category = '$category'";
            $result = $connection->query($query);
            if ($result->num_rows > 0) {
              while($rows = $result->fetch_assoc()) {
               $id_product = $rows['id'];
               $name = $rows['name'];
               $thumbnail = $rows['thumbnail'];
               $price = $rows['price'];
               $qty = $rows['quantity'];
           ?>
           <div class="col s12 m4">
             <div class="card hoverable animated slideInUp wow">
               <div class="card-image">
                     <img src="" style="background-image: url('../products/<?= $thumbnail; ?>'); background-repeat: no-repeat; background-size: contain;" alt="" height="250px">
                 </div>
                 <div class="card-content">                      
                   <span class=" grey-text"><?= $name; ?> <span class="pull-right"><?= $qty; ?> left</span></span>
                      <h5 class="white-text">Ksh <?= $price; ?></h5>
                      <a class="red-text" href="deleteproduct.php?id=<?= $id_product;?>">Delete</a>
                      <a href="editproduct.php?id=<?= $id_product; ?>&icon=<?= $thumbnail ?>" class="btn-floating blue halfway-fab waves-effect waves-light right"><i class="material-icons">edit</i></a>
                 </div>
             </div>
           </div>

         <?php }} ?>
       </div>
   </div>
  <?php require 'includes/footer.php'; ?>

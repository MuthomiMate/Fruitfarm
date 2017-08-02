<?php

session_start();

if ($_SESSION['role'] !== 'admin') {
  header('Location: ../index');
}

 require 'includes/header.php';
 require 'includes/navconnected.php'; //require $nav;?>

 <div class="container-fluid product-page">
   <div class="container current-page">
      <nav>
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="index" class="breadcrumb">Dashboard</a>
            <a href="products" class="breadcrumb">Stock</a>
          </div>
        </div>
      </nav>
    </div>
   </div>

   <div class="container stock">
     <div class="container">
       <div class="row">
       <h5>Select Category</h5>
           <?php
           include '../db.php';
            // get stock
            $querystock = "SELECT
            product.id_category as 'name',
            count(product.id_category) as 'total',

            category.id as 'id_cat',
            category.name as 'name',
            category.icon as 'icon'

            FROM product, category
            WHERE product.id_category = category.id
            GROUP BY category.id";
            $resultstock = $connection->query($querystock);
            if ($resultstock->num_rows > 0) {
              while($rowstock = $resultstock->fetch_assoc()) {
               $id_cat = $rowstock['id_cat'];
               $name = $rowstock['name'];
               $icon = $rowstock['icon'];
               $total = $rowstock['total'];

           ?>

           <div class="col s12 m4">
             <div class="card hoverable animated slideInUp wow">
               <div class="card-image">
                 <a href="productstock.php?id=<?= $id_cat; ?>&category=<?= $name; ?>&icon=<?= $icon; ?>">
                   <img style="background-image: url('../src/img/<?= $icon; ?>.jpg'); background-repeat: no-repeat; background-size: contain;" alt="" height="200px" alt=""></a>
                 <span class="card-title blue-text"><?= $name; ?></span>
               </div>
               <div class="card-content">
                  <span>Products
                 <h5 class="white-text"><?= $total; ?></h5></span>
               </div>
             </div>
           </div>

         <?php }} ?>
       </div>
     </div>
   </div>
 <?php require 'includes/footer.php'; ?>

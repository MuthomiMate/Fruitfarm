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
            <a href="infoproduct" class="breadcrumb">Products</a>
            <a href="stats" class="breadcrumb">Records</a>
          </div>
        </div>
      </nav>
    </div>
   </div>

        <div class="container center-align staaats">
          <div class="row">
          <h4>All Sales</h4>
          <hr>
          <?php


          include '../db.php';

         $queryfirst = "SELECT

        product.id as 'id',
        product.id_category,

         SUM(command.quantity) as 'total',
         command.statut,
         command.id_produit,

         category.name as 'name',
         category.id

         FROM product, command, category
         WHERE product.id = command.id_produit
         AND command.statut = 'paid' 
         AND category.id = product.id_category GROUP BY category.id";
         $resultfirst = $connection->query($queryfirst);
         if ($resultfirst->num_rows > 0) {

           // output data of each row
           while($rowfirst = $resultfirst->fetch_assoc()) {

                 $idp = $rowfirst['id'];
                 $name_best = $rowfirst['name'];
                 $totalsold = $rowfirst['total'];
                 $percent = ($totalsold / 50 )*100;

                 ?>

                  <div class="col s2">
                    <p class="black-text"><?= $name_best; ?></p>
                    <div class="card red<?= $idp; ?>" style="padding-top:<?=number_format((float)$percent, 2, '.', ''); ?>%">
                       <h5 class="white-text"><?=number_format((float)$percent, 2, '.', '');  ?>%</h5><p class="grey-text"><?=$totalsold ?></p>
                    </div>
                  </div>

                 <?php }} ?>
          </div>
          <hr>

          <div class="row">      
              <table class="table-responsive table-bordered table-striped">
                <thead>
                  <th>#</th>
                  <th>Fruit Name</th>
                  <th>Fruit Category</th>
                  <th>Sold</th>
                  <th>Remaining</th>
                </thead>
                <tbody>
                <?php
                    include '../db.php';

                     $queryfirst = "SELECT

                    product.id as 'id',
                    product.name as 'pname',
                    product.quantity as 'quantity',
                    product.id_category,

                     SUM(command.quantity) as 'total',
                     command.statut,
                     command.id_produit,

                     category.name as 'name',
                     category.id

                     FROM product, command, category
                     WHERE product.id = command.id_produit
                     AND command.statut = 'paid' 
                     AND category.id = product.id_category GROUP BY product.id ORDER BY SUM(command.quantity) DESC";
                     $resultfirst = $connection->query($queryfirst);
                     if ($resultfirst->num_rows > 0) {

          
                       // output data of each row
                      $id = 1;
                       while($rowfirst = $resultfirst->fetch_assoc()) {

                             $idp = $rowfirst['id'];
                             $name_prod = $rowfirst['pname'];
                             $name_best = $rowfirst['name'];
                             $totalsold = $rowfirst['total'];
                             $totalrem = $rowfirst['quantity'];
                  ?>
                  <tr>
                    <td><?=$id ?></td>
                    <td><?=$name_prod ?></td>
                    <td><?=$name_best ?></td>
                    <td><?=$totalsold ?></td>
                    <td><?=$totalrem ?></td>
                  </tr>
                <?php
                    $id ++;  }
                    }
                ?>
                </tbody>
              </table>
          </div>
        </div>
 <?php require 'includes/footer.php'; ?>

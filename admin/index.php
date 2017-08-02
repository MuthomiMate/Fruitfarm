<?php

session_start();

if ($_SESSION['role'] !== 'admin') {
  header('Location: ../index');
}

 require 'includes/header.php';
 require 'includes/navconnected.php'; //require $nav;?>

 <div class="container-fluid product-page" style="padding-top: 9px; padding-bottom: 79px">
   <div class="container current-page">
      <nav>
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="../index" class="breadcrumb">Fruitfarm</a>
            <a href="index" class="breadcrumb">Admin Dashboard</a>
          </div>
          <form method="GET" action="search.php">          
            <div class="input-field">            
              <input id="search" class="searchings" type="search" name='searched' placeholder="Search for an order or user" required>
              <label for="search"><i class="material-icons">search</i></label>
              <i class="material-icons">close</i>
            </div>

            <div class="center-align">
              <button type="submit" name="search" class="blue waves-light miaw waves-effect btn hide">Search</button>
            </div>
          </form>          
        </div>
      </nav>
    </div>
   </div>

<div class="container dashboard">
  <div class="row">
         <div class="col s12 m4">
           <div class="card horizontal">
             <div class="card-image">
               <img src="src/img/fruit-basket.png" alt="" />
             </div>
             <div class="card-stacked">
              <div class="card-content">
                <p><a href="infoproduct" class="black-text">Products</a></p>
              </div>
               <div class="card-action">
                 <a href="infoproduct" class="blue-text">Learn more</a>
               </div>
             </div>
           </div>
         </div>

         <div class="col s12 m4">
           <div class="card horizontal">
             <div class="card-image">
               <img src="src/img/cat.png" alt="" />
             </div>
             <div class="card-stacked">
        <div class="card-content">
          <p><a href="products" class="black-text">Stock</a></p>
        </div>
             <div class="card-action">
               <a href="products" class="blue-text">Learn more</a>
             </div>
             </div>

           </div>
         </div>

         <div class="col s12 m4">
           <div class="card horizontal">
             <div class="card-image">
               <img src="src/img/user.png" alt="" />
             </div>
             <div class="card-stacked">
              <div class="card-content">
                <p><a href="allusers" class="black-text">Users</a></p>
              </div>
               <div class="card-action">
                 <a href="allusers" class="blue-text">Learn more</a>
               </div>
             </div>
           </div>
         </div>
         <?php

            include '../db.php';
            //get total users
            $queryusers = "SELECT count(id) as total FROM users";
            $resultusers = $connection->query($queryusers);

            if($resultusers->num_rows > 0) {
              while ($rowusers = $resultusers->fetch_assoc()) {
                $totalusers = $rowusers['total'];
              }
            }

            //get total orders
            $queryorder = "SELECT count(order_id) as total, status FROM orders";
            $resultorder = $connection->query($queryorder);

            if($resultorder->num_rows > 0) {
              while ($roworder = $resultorder->fetch_assoc()) {
                $totalorder = $roworder['total'];
              }
            }

            //get total paid orders
            $querypaid = "SELECT count(order_id) as total, status FROM orders WHERE status = 'paid'";
            $resultpaid = $connection->query($querypaid);

            if($resultorder->num_rows > 0) {
              while ($rowpaid = $resultpaid->fetch_assoc()) {
                $totalpaid = $rowpaid['total'];
              }
            }
          ?>
          <hr>
         <!-- <div class="col s12 m4">
           <div class="card green lighten-1 horizontal">
             <div class="card-stacked">
              <div class="card-content">
                <h5 class="white-text"><i class="material-icons left">shopping_cart</i> Total Payments</h5>
              </div>
               <div class="card-action">
                 <a class="pull-right btn" href="records">View All</a>
                 <h5 class="white-text"><?= $totalpaid; ?></h5>
               </div>
             </div>
           </div>
         </div> -->

         <!-- <div class="col s12 m4">
           <div class="card blue lighten-1 horizontal">
             <div class="card-stacked">
              <div class="card-content">
                <h5 class="white-text"><i class="material-icons left">shopping_cart</i> Total Orders</h5>
              </div>
               <div class="card-action">
                 <a class="pull-right btn" href="orders">View All</a>
                 <h5 class="white-text"><?= $totalorder; ?></h5>
               </div>
             </div>
           </div>
         </div> -->


         <!-- <div class="col s12 m4">
           <div class="card horizontal red lighten-1">
             <div class="card-stacked">
              <div class="card-content">
                <h5 class="white-text"><i class="material-icons left">supervisor_account</i> Total Users</h5>
              </div>
               <div class="card-action">
                 <a class="pull-right btn" href="allusers">View All</a>
                 <h5 class="white-text"><?= $totalusers; ?></h5>
               </div>
             </div>
           </div>
         </div> -->
         
       </div>
</div>
 <?php require 'includes/footer.php'; ?>

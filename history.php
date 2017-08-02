<?php

session_start();

 require 'includes/header.php';
 require 'includes/navconnected.php'; //require $nav;?>

 <div class="container-fluid product-page">
   <div class="container current-page">
      <nav>
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="index" class="breadcrumb">Home</a>
            <a href="#" class="breadcrumb">History</a>
          </div>
        </div>
      </nav>
    </div>
   </div>

        <div class="staaats">
          <div class="row">
          <h4 class="center-align ">All Purchases</h4>
          
          <?php


          include 'db.php';
        $idsess = $_SESSION['id'];
        //$idsess='3';
         ?>
         <div class="container" style="margin-top: 20px">
  <div class="row">
    <div class="col s12">
      <hr>
    </div>
    <div id="test1" class="col s12" style="margin-top: 20px">
      <ul class="collapsible popout" data-collapsible="accordion">
      <?php
        include 'db.php';

        $queryfirst=" SELECT * FROM orders where buyer_id='$idsess' ";
        $resultfirst = $connection->query($queryfirst);
        
        if ($resultfirst->num_rows > 0) {
        
        
          // output data of each row
          while($rowfirst = $resultfirst->fetch_assoc()) {

            $idp = $rowfirst['order_id'];
            $name = $rowfirst['buyer_name'];
            $statut = $rowfirst['status'];
            $ddate = $rowfirst['date_ordered'];
            $price = $rowfirst['total_price'];
            $user = $rowfirst['buyer_id'];
            $address = $rowfirst['address'];
            $phone = $rowfirst['phone'];
            $queryuser="SELECT * FROM order_details WHERE order_id='$idp'";
            $resultuser = $connection->query($queryuser);
           
            
            
              

        ?>
        <li>
          <div class="collapsible-header">
                 <table class="highlight striped">
                  <thead>
                    <tr>
                        <th data-field="orderid"><i class="material-icons">filter_drama</i> #<?php echo" $idp"; ?></th>
                        <th data-field="user"><?php echo" $name"; ?> </th>
                        <td data-field="statut"><?php echo" $statut"; ?></td>
                        <th data-field="price"> <?php echo"Total: $price"; ?></th>
                        <th data-field="ddate"><?php echo"Due on: $ddate"; ?></th>
                    </tr>
                  </thead>
                </table>
              </div>
          <div class="collapsible-body card-stacked">
            <div class="card-content">
                
                <table class="highlight striped">
                 <thead>
                   <tr>
                       <th data-field="name">Item name</th> 
                       <th data-field="price">Price</th>
                        <th data-field="quantity">Quantity</th> 
                       <th data-field="address">Address</th>
                       <th data-field="phone">Phone</th>
                       <th data-field="statut">Status</th>
                       <!-- <th data-field="delete">Delete</th> -->
                   </tr>
                 </thead>
                 <tbody>
                 <?php
                 $tprice = 0;
                  while($rowuser = $resultuser->fetch_assoc()) {
            //$rows=$resultuser->num_rows;
             $item_name=$rowuser['item_name'];
                $quantity=$rowuser['quantity'];
                $item_price=$rowuser['price'];
                echo '<tr>';

                 echo'<td>' ;echo $item_name;echo '</td> 
                  <td>'; echo $item_price; echo '</td>
                  <td>';echo $quantity; echo '</td> 
                  <td>';echo $address; echo '</td>
                  <td>'; echo $phone; echo '</td>
                  <td>' ;echo $statut ; 
                  echo '</tr>';

                  $tprice += $item_price * $quantity;
                }

                  ?>
               </tbody>
              </table> 


              <?php
              ;

              echo '<h5>Total price: '.$tprice.'</h5>';?>
            </div>
          </div>
        </li>

        <?php } } ?>


          </div>
        </div>
 <?php require 'includes/footer.php'; ?>

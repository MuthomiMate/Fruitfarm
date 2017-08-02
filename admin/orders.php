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
            <a href="editproduct" class="breadcrumb">Orders</a>
          </div>
        </div>
      </nav>
    </div>
   </div>


<div class="container" style="margin-top: 20px">
  <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3"><a  class="active black-text"href="#test1">Latest</a></li>
        <li class="tab col s3"><a class="grey-text" href="#test2">Pending</a></li>
        <li class="tab col s3"><a class="grey-text" href="#test3">Completed</a></li>
      </ul>
    </div>
    <div id="test1" class="col s12" style="margin-top: 20px">
      <h5><a href="#" class="black-text">Latest Orders by Users</a></h5>
      <ul class="collapsible popout" data-collapsible="accordion">
      <?php
        include '../db.php';

        $queryfirst=" SELECT * FROM orders GROUP BY buyer_id";
        $resultfirst = $connection->query($queryfirst);
        var_dump($resultfirst);
        exit();
        if ($resultfirst->num_rows > 0) {
        
          // output data of each row
          while($rowfirst = $resultfirst->fetch_assoc()) {

            $idp = $rowfirst['order_id'];
            $name = $rowfirst['buyer_name'];
            $statut = $rowfirst['status'];
            //$quantity = $rowfirst['quantity'];
            $price = $rowfirst['total_price'];
            $user = $rowfirst['buyer_id'];
            $address = $rowfirst['address'];
            $phone = $rowfirst['phone'];

            
            //get user name
           // $queryuser = "SELECT firstname, lastname FROM users WHERE id = '$user' ";
            //$resultuser = $connection->query($queryuser);
           // if ($resultuser->num_rows > 0) {
              // output data of each row
             // while($rowuser = $resultuser->fetch_assoc()) {
               // $userfirstname = $rowuser['firstname'];
               // $userlasttname = $rowuser['lastname'];
            $queryuser="SELECT * FROM order_details WHERE order_id='$idp'";
            $resultuser = $connection->query($queryuser);
          ?>
        <li>
          <div class="collapsible-header"><i class="material-icons">filter_drama</i><?php echo" $name"; ?></div>
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
                       <th data-field="delete">Delete</th>
                   </tr>
                 </thead>
                 <tbody>
                 <?php
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
                  <td>' ;echo $statut ; echo '</td>
                  <td><a href="deletecmd.php?id=<?= $idp; ?>&userid=<?= $user; ?>"><i class="material-icons red-text">close</i></a></td>' ;
                  echo '</tr>';
                }

                  ?>
               </tbody>
              </table> 


              <?php
              ;

              echo '<h5 class="highlight striped">Total price :'.$price.'</h5>' ?>
            </div>
          </div>
        </li>

        <?php } } ?>
        <br>
        <h5><a href="#" class="black-text">Latest Orders by Items</a></h5>
        <ul class="collapsible popout" data-collapsible="accordion">
        <?php
            include '../db.php';

            $queryfirst=" SELECT DISTINCT
            orders.order_id as 'orderid',
            orders.status as 'status',
            orders.total_price as 'price',
            orders.buyer_id as 'user',
            orders.buyer_name as 'name',
            orders.address as 'address',
            orders.phone as 'phone',
            orders.date_ordered as 'ddate'
            FROM  orders ";
            $resultfirst = $connection->query($queryfirst);
            if ($resultfirst->num_rows > 0) {
              while ($rowfirst = $resultfirst->fetch_assoc()) {
                
          // output data of each row
              $orderid = $rowfirst['orderid'];
                $status = $rowfirst['status'];
                $phone = $rowfirst['phone'];
                $price = $rowfirst['price'];
                $user = $rowfirst['user'];
                $name = $rowfirst['name'];
                $ddate = $rowfirst['ddate'];
                $address = $rowfirst['address'];

              ?>
            <li>
              <div class="collapsible-header">
                 <table class="highlight striped">
                  <thead>
                    <tr>
                        <th data-field="orderid">#<?php echo" $orderid"; ?></th>
                        <th data-field="user"><?php echo" $name"; ?> </th>
                        <td data-field="address"><?php echo" $address"; ?></td>
                        <td data-field="phone"><?php echo" $phone"; ?></td>
                        <td data-field="statut"><?php echo" $status"; ?></td>
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
                           <th data-field="quantity">Quantity</th> 
                           <th data-field="address">Address</th>
                           <th data-field="phone">Phone</th>                           
                           <th data-field="price">Price</th>
                           <th data-field="statut">Status</th>
                           <th data-field="delete">Delete</th>
                       </tr>
                     </thead>
                     <tbody>
                     <?php

                    $queryuser="SELECT * FROM order_details WHERE order_id='$orderid'";
                  $resultuser = $connection->query($queryuser);
                    while($rowuser = $resultuser->fetch_assoc()) {

                    //$rows=$resultuser->num_rows;
                     $item_name=$rowuser['item_name'];
                      $quantity=$rowuser['quantity'];
                      $item_price=$rowuser['price'];
                      echo '<tr>';

                      echo'<td>' ;echo $item_name;echo '</td>
                        <td>';echo $quantity; echo '</td> 
                        <td>';echo $address; echo '</td>
                        <td>'; echo $phone; echo '</td>                         
                        <td>'; echo $item_price; echo '</td>
                        <td>' ;echo $status ; echo '</td>
                        <td><a href="deletecmd.php?id=<?= $idp; ?>&userid=<?= $user; ?>"><i class="material-icons red-text">close</i></a></td>' ;
                        echo '</tr>';
                    }

                      ?>
                   </tbody>
                  </table> 


                  <?php
                  }

                  echo '<h5 class="highlight striped">Total price :'.$price.'</h5>' ?>
                </div>
              </div>
            </li>

            <?php }  ?>
        </ul>

        <?php

        $querytwo = "SELECT 

        
        orders.order_id as 'orderid',
        orders.status as 'status',
        orders.total_price as 'price',
        orders.buyer_id as 'user',
        orders.address as 'address',
        orders.phone as 'phone',
        orders.date_ordered as 'ddate'
        FROM  orders GROUP BY order_id";
        
        $resulttwo = $connection->query($querytwo);
        if ($resulttwo->num_rows > 0) { ?>
        
        <br>
        <h5><a href="#" class="black-text">All Orders</a></h5>

        <table class="highlight striped">
          <thead>
            <tr>
                <th data-field="orderid">Order</th>
                <th data-field="user">User</th>
                <th data-field="address">Address</th>
                <th data-field="phone">Phone</th>
                <th data-field="statut">Status</th>
                <th data-field="price">Price</th>
                <th data-field="ddate">Date Due</th>
                <th data-field="delete" colsp an="2">Action</th>
            </tr>
          </thead>
          <tbody>
    
        <?php
        // output data of each row
        while($rowfirst = $resulttwo->fetch_assoc()) {

            $orderid = $rowfirst['orderid'];
            $status = $rowfirst['status'];
            $phone = $rowfirst['phone'];
            $price = $rowfirst['price'];
            $user = $rowfirst['user'];
            $ddate = $rowfirst['ddate'];
            $address = $rowfirst['address'];

            //get user name
            $queryuser = "SELECT firstname, lastname FROM users WHERE id = '$user' ";
            $resultuser = $connection->query($queryuser);
            if ($resultuser->num_rows > 0) {
              // output data of each row
              while($rowuser = $resultuser->fetch_assoc()) {
                $userfirstname = $rowuser['firstname'];
                $userlasttname = $rowuser['lastname'];
              ?>    
              <tr>
                <td><?= $orderid; ?></td>
                <td><?php echo" $userfirstname "." $userlasttname"; ?></td>
                <td><?= $address; ?></td>
                <td><?= $phone; ?></td>
                <td><?= $status; ?></td>
                <td><?= $price; ?></td>
                <td><?= $ddate; ?></td>
                <td> <a href="delivercmd.php?id=<?= $orderid; ?>&userid=<?= $idp; ?>"><i class="<?php if($status == 'delivered'){ echo "material-icons grey-text"; } else { echo "material-icons green-text";} ?>">done</i></a>
                <a href="cancelcmd.php?id=<?= $orderid; ?>&userid=<?= $idp; ?>"><i class="<?php if($status !== 'delivered'){ echo "material-icons grey-text"; } else { echo "material-icons green-text";} ?>">restore</i></a>
                </td>
                <td> <a href="deletecmd.php?id=<?= $orderid; ?>&userid=<?= $idp; ?>"><i class="material-icons red-text">close</i></a></td>
              
              </tr>
          <?php }} }} ?>
          </tbody>
        </table> 
    
    </div>
    <div id="test2" class="col s12" style="margin-top: 20px">

      <?php
      $querytwo = "SELECT
        product.id as 'id',
        product.name as 'name',
        product.price as 'price',

        SUM(order_details.quantity),
        orders.order_id as 'orderid',
        orders.status as 'status',
        order_details.item_id,
        order_details.quantity as 'quantity',
        orders.buyer_id as 'user',
        orders.address as 'address',
        orders.phone as 'phone'

        FROM product, order_details
        LEFT JOIN orders ON orders.order_id = order_details.order_id
        WHERE product.id = order_details.item_id
        AND orders.status = 'pending'
        GROUP BY orders.order_id
        ORDER BY SUM(order_details.quantity) DESC ";
        $resulttwo = $connection->query($querytwo);
        if ($resulttwo->num_rows > 0) { ?>

      <h5><a href="#" class="black-text">Pending Orders by Users</a></h5>
        <table class="highlight striped">
          <thead>
            <tr>
                <th data-field="name">Item name</th>
                <th data-field="price">Price</th>
                <th data-field="quantity">Quantity</th>
                <th data-field="user">User</th>
                <th data-field="address">Address</th>
                <th data-field="phone">Phone</th>
                <th data-field="statut">Status</th>
                <th data-field="delete" colsp an="2">Action</th>
            </tr>
          </thead>
          <tbody>

        <?php
        // output data of each row
        while($rowfirst = $resulttwo->fetch_assoc()) {

            $orderid = $rowfirst['orderid'];
            $idp = $rowfirst['id'];
            $name = $rowfirst['name'];
            $status = $rowfirst['status'];
            $phone = $rowfirst['phone'];
            $quantity = $rowfirst['quantity'];
            $price = $rowfirst['price'];
            $user = $rowfirst['user'];
            $address = $rowfirst['address'];

            //get user name
            $queryuser = "SELECT firstname, lastname FROM users WHERE id = '$user' ";
            $resultuser = $connection->query($queryuser);
            if ($resultuser->num_rows > 0) {
              // output data of each row
              while($rowuser = $resultuser->fetch_assoc()) {
                $userfirstname = $rowuser['firstname'];
                $userlasttname = $rowuser['lastname'];
              ?>    
              <tr>
                <td><?= $name; ?></td>
                <td><?= $price; ?></td>
                <td><?= $quantity; ?></td>
                <td><?php echo" $userfirstname "." $userlasttname"; ?></td>
                <td><?= $address; ?></td>
                <td><?= $phone; ?></td>
                <td><?= $status; ?></td>
                <td> <a href="delivercmd.php?id=<?= $orderid; ?>&userid=<?= $idp; ?>"><i class="<?php if($status == 'delivered'){ echo "material-icons grey-text"; } else { echo "material-icons green-text";} ?>">done</i></a>
                <a href="cancelcmd.php?id=<?= $orderid; ?>&userid=<?= $idp; ?>"><i class="<?php if($status !== 'delivered'){ echo "material-icons grey-text"; } else { echo "material-icons green-text";} ?>">restore</i></a>
                </td>
                <td> <a href="deletecmd.php?id=<?= $orderid; ?>&userid=<?= $idp; ?>"><i class="material-icons red-text">close</i></a></td>
              </tr>
          <?php }} }} ?>
          </tbody>
        </table> 
    </div>
    <div id="test3" class="col s12" style="margin-top: 20px">
      <h5><a href="#" class="black-text">Completed Orders by Users</a></h5>
      <?php
      $querytwo = "SELECT
        product.id as 'id',
        product.name as 'name',
        product.price as 'price',

        SUM(order_details.quantity),
        orders.order_id as 'orderid',
        orders.status as 'status',
        order_details.item_id,
        order_details.quantity as 'quantity',
        orders.buyer_id as 'user',
        orders.address as 'address',
        orders.phone as 'phone'

        FROM product, order_details
        LEFT JOIN orders ON orders.order_id = order_details.order_id
        WHERE product.id = order_details.item_id
        AND orders.status = 'delivered'
        GROUP BY orders.order_id
        ORDER BY SUM(order_details.quantity) DESC ";
        $resulttwo = $connection->query($querytwo);
        if ($resulttwo->num_rows > 0) { ?>
        <table class="highlight striped">
          <thead>
            <tr>
                <th data-field="name">Item name</th>
                <th data-field="price">Price</th>
                <th data-field="quantity">Quantity</th>
                <th data-field="user">User</th>
                <th data-field="address">Address</th>
                <th data-field="phone">Phone</th>
                <th data-field="statut">Status</th>
                <th data-field="delete" colsp an="2">Action</th>
            </tr>
          </thead>
          <tbody>

        <?php
        // output data of each row
        while($rowfirst = $resulttwo->fetch_assoc()) {

            $orderid = $rowfirst['orderid'];
            $idp = $rowfirst['id'];
            $name = $rowfirst['name'];
            $status = $rowfirst['status'];
            $phone = $rowfirst['phone'];
            $quantity = $rowfirst['quantity'];
            $price = $rowfirst['price'];
            $user = $rowfirst['user'];
            $address = $rowfirst['address'];

            //get user name
            $queryuser = "SELECT firstname, lastname FROM users WHERE id = '$user' ";
            $resultuser = $connection->query($queryuser);
            if ($resultuser->num_rows > 0) {
              // output data of each row
              while($rowuser = $resultuser->fetch_assoc()) {
                $userfirstname = $rowuser['firstname'];
                $userlasttname = $rowuser['lastname'];
              ?>    
              <tr>
                <td><?= $name; ?></td>
                <td><?= $price; ?></td>
                <td><?= $quantity; ?></td>
                <td><?php echo" $userfirstname "." $userlasttname"; ?></td>
                <td><?= $address; ?></td>
                <td><?= $phone; ?></td>
                <td><?= $status; ?></td>
                <td> <a href="delivercmd.php?id=<?= $orderid; ?>&userid=<?= $idp; ?>"><i class="<?php if($status == 'delivered'){ echo "material-icons grey-text"; } else { echo "material-icons green-text";} ?>">done</i></a>
                <a href="cancelcmd.php?id=<?= $orderid; ?>&userid=<?= $idp; ?>"><i class="<?php if($status !== 'delivered'){ echo "material-icons grey-text"; } else { echo "material-icons green-text";} ?>">restore</i></a>
                </td>
                <td> <a href="deletecmd.php?id=<?= $orderid; ?>&userid=<?= $idp; ?>"><i class="material-icons red-text">close</i></a></td>
              </tr>
          <?php }} }} ?>
          </tbody>
        </table> 
    </div>

  </div>
  
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.collapsible').collapsible();
  });
</script>
 <?php require 'includes/footer.php'; ?>

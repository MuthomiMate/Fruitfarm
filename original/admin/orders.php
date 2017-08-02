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


<div class="container scroll">
  <h5><a href="#" class="black-text">Latest Orders by Users</a></h5>
     <ul class="collapsible popout" data-collapsible="accordion">
<?php
include '../db.php';

$queryfirst = "SELECT
product.id as 'id',
product.name as 'name',
product.price as 'price',

SUM(command.quantity),
command.statut as 'statut',
command.id_produit,
command.quantity as 'quantity',
command.id_user as 'user',
max(details_command.id_command),
details_command.address as 'address'

FROM product, command
LEFT JOIN details_command ON command.id = details_command.id_command
WHERE product.id = command.id_produit 
GROUP BY command.id_user -- or command.id_produit
ORDER BY SUM(command.quantity) DESC ";
$resultfirst = $connection->query($queryfirst);
if ($resultfirst->num_rows > 0) {
  // output data of each row
  while($rowfirst = $resultfirst->fetch_assoc()) {

        $idp = $rowfirst['id'];
        $name = $rowfirst['name'];
        $statut = $rowfirst['statut'];
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
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i><?php echo" $userfirstname "." $userlasttname"; ?></div>
      <div class="collapsible-body card-stacked">
        <div class="card-content">
            
            <table class="highlight striped">
             <thead>
               <tr>
                   <th data-field="name">Item name</th>
                   <th data-field="price">Price</th>
                   <th data-field="quantity">Quantity</th>
                   <th data-field="address">Address</th>
                   <th data-field="statut">Status</th>
                   <th data-field="delete">Delete</th>
               </tr>
             </thead>
             <tbody>
              <td><?= $name; ?></td>
              <td><?= $price; ?></td>
              <td><?= $quantity; ?></td>
              <td><?php echo" $address"; ?></td>
              <td><?= $statut; ?></td>
              <td><a href="deletecmd.php?id=<?= $idp; ?>&userid=<?= $user; ?>"><i class="material-icons red-text">close</i></a></td>
           </tbody>
          </table>  
        </div>
      </div>
    </li>

    <?php }} }} 

    $querytwo = "SELECT
    product.id as 'id',
    product.name as 'name',
    product.price as 'price',

    SUM(command.quantity),
    command.statut as 'statut',
    command.id_produit,
    command.quantity as 'quantity',
    command.id_user as 'user',
    details_command.address as 'address'

    FROM product, command
    LEFT JOIN details_command ON command.id = details_command.id_command 
    WHERE product.id = command.id_produit 
    GROUP BY command.id
    ORDER BY SUM(command.quantity) DESC ";
    $resulttwo = $connection->query($querytwo);
    if ($resulttwo->num_rows > 0) { ?>

    </ul><br>
    <h5><a href="#" class="black-text">All Orders</a></h5>
     <ul class="collapsible popout" data-collapsible="accordion">
    <table class="highlight striped">
      <thead>
        <tr>
            <th data-field="name">Item name</th>
            <th data-field="price">Price</th>
            <th data-field="quantity">Quantity</th>
            <th data-field="user">User</th>
            <th data-field="address">Address</th>
            <th data-field="statut">Status</th>
            <th data-field="delete">Delete</th>
        </tr>
      </thead>
      <tbody>

    <?php
    // output data of each row
    while($rowfirst = $resulttwo->fetch_assoc()) {

        $idp = $rowfirst['id'];
        $name = $rowfirst['name'];
        $statut = $rowfirst['statut'];
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
    ?>    <tr>
            <td><?= $name; ?></td>
            <td><?= $price; ?></td>
            <td><?= $quantity; ?></td>
            <td><?php echo" $userfirstname "." $userlasttname"; ?></td>
            <td><?= $address; ?></td>
            <td><?= $statut; ?></td>
            <td><a href="deletecmd.php?id=<?= $idp; ?>&userid=<?= $user; ?>"><i class="material-icons red-text">close</i></a></td>
          </tr>
      <?php }} }} ?>
      </tbody>
    </table> 
    
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.collapsible').collapsible();
  });
</script>
 <?php require 'includes/footer.php'; ?>

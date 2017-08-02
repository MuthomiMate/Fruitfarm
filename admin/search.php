<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
  $nav ='includes/nav.php';
  if (!isset($_GET['search'])) {
    header('Location: index');
  }
  else {
    $word = $_GET['searched'];
  }
}
else {
  $nav ='includes/navconnected.php';
  $idsess = $_SESSION['id'];
  if (!isset($_GET['search'])) {
    header('Location: index');
  }
  else {
    $word = $_GET['searched'];
  }
}

require 'includes/header.php';
require $nav;?>

<div class="container-fluid product-page" id="top">
 <div class="container current-page">
  <nav>
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="index" class="breadcrumb">Home</a>
        <a href="search" class="breadcrumb">Search</a>
      </div>
    </div>
  </nav>
</div>
</div>

<div class="container search-page">
 <div class="row">
  <div class="col-md-12" style="margin-bottom: 10px;padding-top: 10px;">
    <h4 class="animated slideInUp wow">Results for '<?= $word ?>' </h4>
  </div>
  <?php

  include '../db.php';
       //get products

       //pages links
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $perpage = isset($_GET['per-page']) && $_GET['per-page'] <= 16 ? (int)$_GET['per-page'] : 16;

  $start = ($page > 1) ? ($page * $perpage) - $perpage : 0;

  if (!is_numeric($word)) {
    $check = "orders.buyer_name LIKE '%{$word}%'";
  } else {
    $check = "orders.buyer_id = '$word'";
  }

  $queryproduct = "SELECT 
  orders.order_id as 'orderid',
  product.id as 'id',
  product.name as 'name',
  product.price as 'price',

  SUM(order_details.quantity),
  orders.status as 'status',
  order_details.item_id,
  order_details.quantity as 'quantity',
  orders.buyer_name as 'user',
  orders.address as 'address',
  orders.phone as 'phone'

  FROM product, order_details
  LEFT JOIN orders ON orders.order_id = order_details.order_id
  WHERE $check  
  AND product.id = order_details.item_id ORDER BY orderid DESC LIMIT {$start}, 16";
  $result = $connection->query($queryproduct);

//var_dump($queryproduct);
       //pages
  $total = $connection->query("SELECT FOUND_ROWS() as total")->fetch_assoc()['total'];
  $pages = ceil($total / $perpage); ?>

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

      if ($result->num_rows > 0) {
         // output data of each row
       while($rowproduct = $result->fetch_assoc()) {
         $idp = $rowproduct['id'];
         $name_product = $rowproduct['name'];
         $price_product = $rowproduct['price'];
         $quantity_product = $rowproduct['quantity'];
         $name_buyer = $rowproduct['user'];
         $address_buyer = $rowproduct['address'];
         $phone_buyer = $rowproduct['phone'];
         $status_order = $rowproduct['status'];
         $orderid = $rowproduct['orderid'];

         ?>


         <tr class="card hoverable animated slideInUp wow">

          <td><?= $name_product; ?></td>
          <td><?= $price_product; ?></td>
          <td><?= $quantity_product; ?></td>
          <td><?php echo $name_buyer; ?></td>
          <td><?= $address_buyer; ?></td>
          <td><?= $phone_buyer; ?></td>
          <td><?= $status_order; ?></td>
          <td> <a href="delivercmd.php?id=<?= $orderid; ?>&userid=<?= $idp; ?>"><i class="<?php if($status == 'delivered'){ echo "material-icons grey-text"; } else { echo "material-icons green-text";} ?>">done</i></a>
            <a href="cancelcmd.php?id=<?= $orderid; ?>&userid=<?= $idp; ?>"><i class="<?php if($status !== 'delivered'){ echo "material-icons grey-text"; } else { echo "material-icons green-text";} ?>">restore</i></a>
          </td>
          <td> <a href="deletecmd.php?id=<?= $orderid; ?>&userid=<?= $idp; ?>"><i class="material-icons red-text">close</i></a></td>
        </tr>
        <?php }
        } else {
         echo '<tr class="card hoverable animated slideInUp wow"><div class="container center-align">
         <h4 class="black-text">Item not found</h4>
       </div>"</tr>';
     }?>
   </tbody>
 </table> 

</div>

<div class="center-align animated slideInUp wow">
 <ul class="pagination <?php if($total<15){echo "hide";} ?>">
   <li class="<?php if($page == 1){echo 'hide';} ?>"><a href="?page=<?php echo $page-1; ?>&per-page=15"><i class="material-icons">chevron_left</i></a></li>
   <?php for ($x=1; $x <= $pages; $x++) : $y = $x;?>


     <li class="waves-effect pagina  <?php if($page === $x){echo 'active';} elseif($page <  ($x +1) OR $page > ($x +1)){echo'hide';} ?>"><a href="?page=<?php echo $x; ?>&per-page=15" ><?php echo $x; ?></a></li>



   <?php endfor; ?>
   <li class="<?php if($page == $y){echo 'hide';} ?>"><a href="?page=<?php echo $page+1; ?>&per-page=15"><i class="material-icons">chevron_right</i></a></li>
 </ul>
</div>
</div>

<?php require 'includes/footer.php'; ?>

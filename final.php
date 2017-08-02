<?php
  session_start();

 if (!isset($_SESSION['logged_in']) && !isset($_POST['pay'])) {
     header('Location: sign');
 }

 if (isset($_POST['pay'])) {

    include 'db.php';

    $querycmd ="SELECT product.id as 'productid',
                       product.name as 'product',
                       product.price as 'price',
                       product.quantity as 'qty',

                       order_details.detail_id as 'idcmd',
                       order_details.item_id,
                       order_details.quantity as 'quantity',
                       orders.order_id as 'idorder',
                       orders.status,
                       orders.buyer_id as 'iduser',

                       users.id

                       FROM product, orders, order_details, users
                       WHERE product.id = order_details.item_id AND users.id = orders.buyer_id
                       AND order_details.order_id = orders.order_id
                       AND orders.buyer_id = '{$_SESSION['id']}' AND orders.status = 'ordered'";
    $resultcmd = $connection->query($querycmd);
    if($resultcmd->num_rows > 0){
      $price = 0;
      while ($rowcmd = $resultcmd->fetch_assoc()) {
          $productid = $rowcmd['productid'];
          $productcmd = $rowcmd['product'];
          $quantitycmd = $rowcmd['quantity'];
          $quantityprd = $rowcmd['qty'];
          $pricecmd = $rowcmd['price'];
          $itemid = $rowcmd['idcmd'];
          $orderid = $rowcmd['idorder'];
          $firstnamecmd = $_POST['firstname'];
          $lastnamecmd = $_POST['lastname'];
          $phonecmd = $_POST['phone'];
          $citycmd = $_POST['city'];
          $addresscmd = $_POST['address'];

          $idusercmd = $rowcmd['iduser'];

          $price += $pricecmd * $quantitycmd;
          $fullname = $firstnamecmd . " " . $lastnamecmd ;
          $qty = $quantityprd - $quantitycmd;
          }
          
          if ($qty > 0) {
            $query_details = "UPDATE orders SET total_price = '$price', status = 'ready', phone = '$phonecmd', city = '$citycmd' WHERE order_id = '$orderid'";
            $resultdetails = $connection->query($query_details);

            if ($resultdetails ) {
              # Reduce quantity if not below zero...
              $queryreduce = "UPDATE product SET quantity = '$qty' WHERE id = '{$productid}' ";
              //var_dump($queryreduce);
              $resultreduce = mysqli_query($connection, $queryreduce);
              if ($resultreduce) {
                $msg = "Thank you for your purchase";
                $msg2 = "Your order is on its way Dear";

                $querypay = "UPDATE orders SET status = 'checked' WHERE order_id = '$orderid' AND status = 'ready'";
                //var_dump($querypay);
                $resultpay = mysqli_query($connection, $querypay);
              }else {
              $msg = "Sorry. Not enough items in stock";
              $msg2 = "Your order could not be completed";
              }
            } else {
                //var_dump($query_details);
                $msg = "Sorry. An error occurred";
                $msg2 = "Your order could not be completed";
              }
          } else {
            $msg = "Sorry. Not enough items in stock";
            $msg2 = "Your order could not be completed";
          }
        
      }
    unset($_SESSION["item"]);
    unset($_SESSION["orderinfo"]);

   $nav ='includes/navconnected.php';
   $idsess = $_SESSION['id'];

   $email_sess = $_SESSION['email'];
   $phone_sess = $_SESSION['phone'];
   $firstname_sess = $_SESSION['firstname'];
   $lastname_sess = $_SESSION['lastname'];
   $city_sess = $_SESSION['city'];
   $address_sess = $_SESSION['address'];
 }

  require 'includes/header.php';
  require $nav;?>
  <div class="container-fluid product-page">
    <div class="container current-page">
       <nav>
         <div class="nav-wrapper">
           <div class="col s12">
             <a href="index" class="breadcrumb">Home</a>
             <a href="cart" class="breadcrumb">Cart</a>
             <a href="checkout" class="breadcrumb">Checkout</a>
             <a href="final" class="breadcrumb">Thank you</a>
           </div>
         </div>
       </nav>
     </div>
    </div>

<div class="container thanks">
  <div class="row">
    <div class="col s12 m3">

    </div>

  <div class="col s12 m6">
  <div class="card center-align">
     <div class="card-image">
       <img src="src/img/thanks.png" class="responsive-img" alt="">
     </div>
     <div class="card-content center-align">
       <h5><?= $msg ?></h5>
       <p><?= $msg2 ?> : <h5 class="green-text"><?php echo"$firstname_sess". " " . "$lastname_sess";  ?></h5></p>
     </div>
   </div>

   <div class="center-align">
     <a href="details.php" class="button-rounded blue btn waves-effects waves-light">Details</a>
     <a href="index" class="button-rounded btn waves-effects waves-light">Home</a>
   </div>
  </div>
  <div class="col s12 m3">

  </div>
 </div>
</div>

    <?php require 'includes/footer.php'; ?>

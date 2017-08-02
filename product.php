<?php
session_start();

if (!isset($_GET['id'])) {
    header('Location: index');
}

if (!isset($_SESSION['logged_in'])) {
  $nav = 'includes/nav.php';
}
else {
  $nav ='includes/navconnected.php';
  $idsess = $_SESSION['id'];
}

$id_product =$_GET['id'];
 require 'includes/header.php';
 require $nav;?>

 <div class="container-fluid product-page" id="top">
   <div class="container current-page">
      <nav>
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="index" class="breadcrumb">Home</a>
            <a href="product.php?id=<? $id_product; ?>" class="breadcrumb">Product</a>
          </div>
        </div>
      </nav>
    </div>
   </div>


<div class="container-fluid product">
  <div class="container">
   <div class="row">
     <div class="col s12 m6">
        <div class="card">
          <div class="card-image">
            <?php

            include 'db.php';

            //get products
            $queryproduct = "SELECT id, name, price, description, id_picture, thumbnail
              FROM product WHERE id = '{$id_product}'";
            $result1 = $connection->query($queryproduct);
            if ($result1->num_rows > 0) {
            // output data of each row
            while($rowproduct = $result1->fetch_assoc()) {
              $id_productdb = $rowproduct['id'];
              $name_product = $rowproduct['name'];
              $price_product = $rowproduct['price'];
              $id_pic = $rowproduct['id_picture'];
              $description = $rowproduct['description'];
              $thumbnail_product = $rowproduct['thumbnail']; }}?>
            <img class="materialboxed" width="650" src="products/<?= $thumbnail_product; ?>" alt="">
          </div>
        </div>
       <div class="row">
         <?php

         //get categories
           $querypic = "SELECT picture, id_produit FROM pictures WHERE id_produit = '$id_pic'";
           $total = $connection->query($querypic);
           if ($total->num_rows > 0) {
           // output data of each row
           while($rowpic = $total->fetch_assoc()) {
             $pics = $rowpic['picture'];
          ?>
           <div class="col s12 m4">
             <div class="card hoverable">
               <div class="card-image">
                 <img class="materialboxed" width="650" src="productsimg/<?= $pics; ?>" alt="">
               </div>
             </div>
           </div>
         <?php }} ?>
       </div>
     </div>

     <div class="col s12 m6">
       <form method="post">
       <h2><?= $name_product; ?></h2>
       <div class="divider"></div>
       <div class="stuff">
        <h3 class="woow">Price</h3>
        <h5>Ksh <?= $price_product; ?></h5>
           <p><?= $description; ?></p>
          <div class="input-field col s12">
            <i class="material-icons prefix">shopping_basket</i>
            <input id="icon_prefix" type="number" name="quantity" min="1" class="validate" required>
            <label for="icon_prefix">Quantity</label>
          </div>

           <?php

            if (isset($_POST['buy'])) {

                if (!isset($_SESSION['logged_in'])) {
                  echo "<meta http-equiv='refresh' content='0;url=sign' />";
                }

                else {
                    $quantity = $_POST['quantity'];

                    //inserting into command
                    include 'db.php';
                    date_default_timezone_set('UTC');
                    $namesess = $_SESSION['firstname'].' '.$_SESSION['lastname'];
                    $addsess = $_SESSION['address'];
                    $date_ordered = date("F j, Y");
                    if (!isset($_SESSION['orderinfo'])) {
                      
                      $queryorder = "INSERT INTO orders(order_id, buyer_id, buyer_name, date_ordered, total_price, status, address)
                      VALUES (null, '$idsess', '$namesess', '$date_ordered', '0','ordered',  '$addsess')";
                      $result1 = $connection->query($queryorder);

                      if ($result1 === TRUE) {                    
                        $last_id = $connection->insert_id;
                        $_SESSION['orderinfo'] = $last_id;
                      }else {
                           echo "<h5 class='text-red'>Error: " . $queryorder . "</h5><br><br><br>" . $connection->error;
                      }

                    } else{
                      $last_id = $_SESSION['orderinfo'];
                    }
                    
                      $queryitem = "SELECT detail_id FROM order_details WHERE item_id = '$id_productdb' AND order_id = '$last_id'";
                      $totalitem = $connection->query($queryitem);

                      if ($totalitem->num_rows > 0) { //update quantity of item with similar id
                        while($rowitem = $totalitem->fetch_assoc()) {
                          $detail_id = $rowitem['detail_id'];
                          $querybuy = "UPDATE order_details SET quantity = '$quantity' WHERE detail_id = '$detail_id'";
                        }

                      } else{
                        $querybuy = "INSERT INTO order_details(detail_id, order_id, item_id,item_name, price, quantity, status)
                        VALUES (null, '$last_id', '$id_productdb', '$name_product', '$price_product', '$quantity', '1')";
                      }

                      if ($connection->query($querybuy) === TRUE) {  
                           $_SESSION['item'] += 1;

                           echo "<meta http-equiv='refresh' content='0;url=index' />";
                       } else {
                           echo "<h5 class='text-red'>Error: " . $querybuy . "</h5><br><br><br>" . $connection->error;
                       }
                  
                 $connection->close();
                }
            }

            ?>

       <div class="center-align">
           <button type="submit" name="buy" class="btn-large meh button-rounded waves-effect waves-light ">Add to Cart</button>
       </div>
       </div>
        </form>
     </div>
   </div>
  </div>
</div>
<?php
 require 'includes/secondfooter.php';
 require 'includes/footer.php'; ?>

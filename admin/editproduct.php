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

<div class="container addp">
  <form method="post" enctype="multipart/form-data">
    <div class="card">
      <?php

      include '../db.php';
      $caticon = $_GET['icon'];
      $item = $_GET['id'];

      //get products
            $queryproduct = "SELECT id, name, price, description, id_picture, thumbnail, quantity
              FROM product WHERE id = '{$item}'";
            $result1 = $connection->query($queryproduct);
            if ($result1->num_rows > 0) {
            // output data of each row
            while($rowproduct = $result1->fetch_assoc()) {
              $id_productdb = $rowproduct['id'];
              $name_product = $rowproduct['name'];
              $price_product = $rowproduct['price'];
              $id_pic = $rowproduct['id_picture'];
              $description = $rowproduct['description'];
              $thumbnail_product = $rowproduct['thumbnail'];
              $qty_product = $rowproduct['quantity']; 
             ?>         
      
      <div class="center-align">
        <img class="responsive-img" src="../products/<?= $caticon; ?>" style="height:100px">
      </div>

      <div class="row">
        <div class="input-field col s6">
          <i class="fa fa-product-hunt prefix"></i>
          <input id="icon_prefix" type="text" class="validate" name="name" value="<?= $name_product ?>">
          <label for="icon_prefix">Item name</label>
        </div>

        <div class="input-field col s3">
          <i>Ksh</i>
          <input id="icon_prefix" type="number" class="validate" name="price"  value="<?= $price_product ?>">
          <label for="icon_prefix">Price</label>
        </div>

        <div class="input-field col s3">
          <i class="fa fa-product-hunt prefix"></i>
          <input id="icon_prefix" type="text" class="validate" name="quantity" value="<?= $qty_product ?>">
          <label for="icon_prefix">Item Quantity</label>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">mode_edit</i>
          <textarea id="icon_prefix2" class="materialize-textarea" name="description"  value=""><?= $description ?></textarea>
          <label for="icon_prefix2">Description</label>
        </div>

        <div class="file-field input-field col s6">
          <div class="btn blue">
            <span>Thumbnail</span>
            <input type="file" name="thumbnail">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" name="thumbnail"  value="<?= $thumbnail_product ?>">
          </div>
        </div>
         <?php

         //get categories
           $querypic = "SELECT picture, id_produit FROM pictures WHERE id_produit = '$id_pic'";
           $total = $connection->query($querypic);
           if ($total->num_rows > 0) {
           // output data of each row
          $i = 3;
           while($rowpic = $total->fetch_assoc()) {
             $pics = $rowpic['picture'];
             $ip=$i-count($rowpic);
          ?>
        <div class="file-field input-field col s2">
          <div class="red btn">
            <span><?= $ip ?></span>
            <input type="file" name="picture<?= $ip ?>">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" name="picture<?= $ip ?>" value="<?= $pics?>">
          </div>
        </div>
          <?php $i++;  }
          } ?>
        

      <div class="center-align">
        <button type="submit" name="done" class="waves-effect button-rounded waves-light btn">Save</button>
      </div>
    </div>
    <?php  }

       } ?> 
    <?php require 'success.php'; ?>
  </form>
</div>




 <?php require 'includes/footer.php'; ?>

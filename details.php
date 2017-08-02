<?php
  session_start();

 if (!isset($_SESSION['logged_in'])) {
     header('Location: sign');
 }

else {
 $idsess = $_SESSION['id'];
}
 require 'includes/header.php';
 ?>

 <div class="container print">
   <table>
      <thead>
        <tr>
            <th data-field="name">Item Name</th>
            <th data-field="category">quantity</th>
            <th data-field="price">price</th>
            <th data-field="quantity">user</th>
            <th data-field="phone">Phone</th>
            <th data-field="city">city</th>
            <th data-field="address">address</th>
        </tr>
      </thead>
      <tbody class="scroll">
        <?php
         include 'db.php';
        //get detailss
        $querydetails = "SELECT * FROM orders, order_details WHERE orders.buyer_id = '$idsess' AND orders.status ='checked' AND order_details.order_id = orders.order_id";
        $result = $connection->query($querydetails);
        if ($result->num_rows > 0) {
        // output data of each row
          $total = 0;
        while($rowdetails = $result->fetch_assoc()) {
          $id_details = $rowdetails['detail_id'];
          $product_details = $rowdetails['item_name'];
          $quantity_details = $rowdetails['quantity'];
          $unit_price=$rowdetails['price'];
          $pric=intval($quantity_details)*intval($unit_price);
          $price_details = $rowdetails['total_price'];
          $user_details = $rowdetails['buyer_name'];
          $phone_details = $rowdetails['phone'];
          $city_details = $rowdetails['city'];
          $address_details = $rowdetails['address'];
          $idcmdd = $rowdetails['order_id'];

          ?>
        <tr>
          <td><?= $product_details; ?></td>
          <td><?= $quantity_details; ?></td>
          <td>Ksh <?= $pric; ?></td>
          <td><?= $user_details; ?></td>
          <td><?= $phone_details; ?></td>
          <td><?= $city_details; ?></td>
          <td><?= $address_details; ?></td>
        </tr>
      <?php 
      $price_details; }} ?>
      <div class="left-align">
        <?php

        $querycmd = "SELECT order_id FROM orders WHERE order_id = '$idcmdd'";
        $getid = mysqli_query($connection, $querycmd);
        $rowcmd = mysqli_fetch_array($getid);
        $idcmd = $rowcmd['order_id'];

        ?>
        <h5>Invoice #<?= $idcmd; ?></h5>
      </div>
      </tbody>
    </table>
    <div class="left-align">
      <h5>Total is <strong><?= $price_details ?>/=</strong></h5>
      <p class="right-align">Thank you for trusting us © FruitFarm Inc <?= date('Y'); ?></p>
    </div>

    <form method="post">
      <button type="submit" name="done" class="button-rounded waves-effect waves-light btn">Home</button>
      <!--<button type="submit" name="done2" class="blue waves-effect waves-light btn">
      save as pdf <i class="fa fa-print"></i></button>-->
      <?php

        if (isset($_POST['done'])) {



          $queryupdate = "UPDATE orders SET status = 'pending' WHERE buyer_id = '$idsess' AND status = 'checked'";
          $queryupdate = mysqli_query($connection, $queryupdate);

          echo "<meta http-equiv='refresh' content='0;url=index' />";
        }

       ?>
    </form>
 </div>

<?php require 'includes/footer.php'; ?>

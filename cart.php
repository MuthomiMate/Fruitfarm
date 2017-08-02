<?php
session_start();

if ($_SESSION['item'] < 1 OR !isset($_SESSION['logged_in'])) {
    header('Location: sign');
}

else {
  $nav ='includes/navconnected.php';
  $idsess = $_SESSION['id'];
}



 require 'includes/header.php';
 require $nav;?>
 <style>
   .view input {
  border:0;
  background:0;
  outline:none !important;
}
 </style>
 <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
 <div class="container-fluid product-page">
   <div class="container current-page">
      <nav>
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="index" class="breadcrumb">Home</a>
            <a href="cart" class="breadcrumb">Cart</a>
          </div>
        </div>
      </nav>
    </div>
   </div>

   <div class="container scroll info">
     <table id="form" class="highlight">
        <thead>
          <tr>
              <th data-field="name">Item Name</th>
              <th data-field="category">Category</th>
              <th data-field="price">Price</th>
              <th data-field="quantity">Quantity</th>
              <th data-field="total">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
           include 'db.php';
          //get products
          $queryproduct = "SELECT product.name as 'name',
          product.id as 'id', product.price as 'price',
          category.name as 'category', orders.buyer_id, orders.status,
          order_details.detail_id as 'item',
          order_details.quantity as 'quantity'
FROM category, product, orders, order_details
WHERE order_details.item_id = product.id AND order_details.order_id = orders.order_id AND product.id_category = category.id AND orders.status = 'ordered'";
          $result1 = $connection->query($queryproduct);
          if ($result1->num_rows > 0) {
            $row_id=0;
          // output data of each row
          while($rowproduct = $result1->fetch_assoc()) {
            $id_productdb = $rowproduct['id'];
            $name_product = $rowproduct['name'];
            $category_product = $rowproduct['category'];
            $quantity_product = $rowproduct['quantity'];
            $id_item = $rowproduct['item'];
            $price_product = $rowproduct['price'];
            $row_id=$row_id+1;
            $unit.$row_id=$price_product;

            ?>
          <tr>
<script type="text/javascript">
  function calc() 
{
  var price ='<?= $price_product; ?>';
  var noTickets = document.getElementById("num").value;;
  var total = parseFloat(price) * noTickets
  if (!isNaN(total))
    document.getElementById("total").innerHTML = total
}
</script>


            <td><p><input type="text" style="border:none"  id="nam" value=<?= $name_product; ?>  readonly  /></td>
            <td><p><input type="text" style="border:none"  id="cat" value=<?= $category_product;  ?> readonly  /></td>
            <td><p><input type="text" style="border:none"  id="nu" value=<?= $price_product; ?> readonly  /></p></td>
            <td> <p><input type="text"  id="num"   value= <?= $quantity_product; ?>  /></p></td>
            <td><p><input type="text" style="border:none"  id="nun" value=<?= $price_product*$quantity_product; ?> readonly /></p></td>
            <td><a href="deletecommand.php?id=<?= $id_item; ?>&itemid=<?= $id_productdb; ?>"><i class="material-icons red-text">close</i></a></td>
            
            <!-- <td><button id="edit">Edit</button></td> -->
          <!--   <script>

              $('#edit').click(function(){
  $('#form').toggleClass('view');
  $('input').each(function(){
    var inp = $(this);
    if (inp.attr('readonly')) {
     inp.removeAttr('readonly');
    }
    else {
      inp.attr('readonly', 'readonly');
    }
  });
});
            </script> -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
          </tr>
        <?php }}?>
        </tbody>
      </table>
      <script>
  (function() {
    "use strict";

    $("#form").on("change", "input", function() {
      var row = $(this).closest("tr");
      var qty = parseFloat(row.find("input:eq(2)").val());
      var price = parseFloat(row.find("input:eq(3)").val());
      var total = qty * price;
      var id=
      row.find("input:eq(4)").val(isNaN(total) ? "" : total);
      var item = row.find("input:eq(0)").val();
       $.ajax({
                    type: "POST",
                    url: "changes.php?id=<?= $id_item; ?>",//your url here
                    data: {
                      qty: qty, total : total, item: item 
                    },  //this is the current value that was changed
                    dataType: 'json',
                    success: function(response) {
                        console.log("success");
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
      window.location.href = window.location.pathname + window.location.search + window.location.hash;
    });
  })();
</script>

      <div class="right-align">
        <a href="checkout"
        class='btn-large button-rounded waves-effect waves-light'>
          Check out <i class="material-icons right">payment</i></a>
      </div>
   </div>
   <?php
    require 'includes/secondfooter.php';
    require 'includes/footer.php'; ?>

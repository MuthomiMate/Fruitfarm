<?php

session_start();

if (!isset($_SESSION['logged_in'])) {
  $nav ='includes/nav.php';
}
else {
  $nav ='includes/navconnected.php';
  $idsess = $_SESSION['id'];
}


require 'includes/header.php';
require $nav; ?>

<div class="container-fluid home" id="top" style="padding-bottom: 40px;padding-top: 20px; margin-bottom: 40px">
  <div class="container search">
    <nav class="animated slideInUp wow">
      <div class="nav-wrapper">
        <form method="GET" action="search.php">          
          <div class="input-field">            
            <input id="search" class="searchings" type="search" name='searched' placeholder="Search for a product" required>
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

<div class="container ">
  <div class="row">
  <div class="col-md-12" style="margin-bottom: 50px;padding-top: 10px;">
      <h4 class="animated slideInUp wow">Best Selling Items</h4>
  </div>
    <?php

     include 'db.php';

    $queryfirst = "SELECT

   product.id as 'id',
   product.name as 'name',
   product.price as 'price',
   product.thumbnail as 'thumbnail',

    SUM(command.quantity) as 'total',
    command.statut,
    command.id_produit

    FROM product, command
    WHERE product.id = command.id_produit AND command.statut = 'paid'
    GROUP BY product.id
    ORDER BY SUM(command.quantity) DESC LIMIT 3";
    $resultfirst = $connection->query($queryfirst);
    if ($resultfirst->num_rows > 0) {
      // output data of each row
      while($rowfirst = $resultfirst->fetch_assoc()) {

            $id_best = $rowfirst['id'];
            $name_best = $rowfirst['name'];
            $price_best = $rowfirst['price'];
            $thumbnail_best = $rowfirst['thumbnail'];
            $totalsold = $rowfirst['total'];

            ?>

            <div class="col s12 m4">
              <div class="card hoverable animated slideInUp wow">
                <div class="card-image">
                  <a href="product.php?id=<?= $id_best;  ?>">

                    <img style="background-image: url('products/<?= $thumbnail_best; ?>'); background-repeat: no-repeat; background-size: contain;" alt="" height="210px"></a>
                  <span class="card-title red-text"><?= $name_best; ?></span>
                  <a href="product.php?id=<?= $id_best; ?>" class="btn-floating red halfway-fab waves-effect waves-light right"><i class="material-icons">add</i></a>
                </div>
                  <div class="card-content">
                    <div class="container">
                      <div class="row">
                        <div class="col s6">
                          <p class="black-text">Ksh <?= $price_best; ?></p>
                        </div>
                        <div class="col s6">
                          <p class="black-text"><i class="left fa fa-shopping-basket"></i> <?= $totalsold; ?></p>
                        </div>
                      </div>
                    </div>

                  </div>

                </div>
              </div>
              <?php }} ?>

<hr>
            </div>
          </div>
          
          <div class="row">
          <div class="">
          <div class="col-md-12" style="padding-bottom: 10px;padding-top: 10px;">
              <h4 class="animated slideInUp wow center-align">All Products</h4>
          </div>
          <div class="col s12 m2  cat">
        <div class="collection card">        

          <div class="divAllBrands" style="margin: 10px; padding: 10px 10px; border-bottom: 1px solid #eee">  All Fruits </div>
                  
              <div class="left-align">
                <div class="jspPane" style="padding: 0px; width: 203px; top: 0px;">
                  <div class="divAllBrandsSelectionContainer">
                    <div class="divSuperCategoryTitleContainer ">
                      <div class="divSuperCategoryTitle">
                        <?php

                          include 'db.php';

                          //get categories
                            $querycategory = "SELECT id, name FROM category";
                            $total = $connection->query($querycategory);
                            if ($total->num_rows > 0) {
                            // output data of each row
                            while($rowcategory = $total->fetch_assoc()) {
                              $id_categorydb = $rowcategory['id'];
                              $name_category = $rowcategory['name'];
                          ?>
                          <div class="" style="cursor:pointer; ">  
                              <a href="category.php?id=<?= $id_categorydb; ?>"
                               class='collection-item <?php if($id_categorydb == $id_category) {echo"active";} ?>'>
                               <input type="checkbox" style="cursor:pointer;" onclick="">
                                <label class="black-text"><?= $name_category; ?></label>
                              </a>
                          </div>
                         <?php }} ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        <div>
       </div>
      </div>

      <div class="col m10 m10 ">
        <div class="content">
        <div class="row">
          <?php
          //get products

          //pages links
          $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $perpage = isset($_GET['per-page']) && $_GET['per-page'] <= 16 ? (int)$_GET['per-page'] : 16;

          $start = ($page > 1) ? ($page * $perpage) - $perpage : 0;

          $queryproduct = "SELECT SQL_CALC_FOUND_ROWS id, name, price, id_picture, thumbnail FROM product  ORDER BY id DESC LIMIT {$start}, 12";
          $result = $connection->query($queryproduct);

          //pages
           $total = $connection->query("SELECT FOUND_ROWS() as total")->fetch_assoc()['total'];
           $pages = ceil($total / $perpage);

            if ($result->num_rows > 0) {
            // output data of each row
            while($rowproduct = $result->fetch_assoc()) {
              $id_product = $rowproduct['id'];
              $name_product = $rowproduct['name'];
              $price_product = $rowproduct['price'];
              $id_pic = $rowproduct['id_picture'];
              $thumbnail_product = $rowproduct['thumbnail'];

            ?>

                <div class="col s12 m3">
                  <div class="card hoverable animated slideInUp wow">
                    <div class="card-image">
                        <a href="product.php?id=<?= $id_product; ?>">
                          <img src="" style="background-image: url('products/<?= $thumbnail_product; ?>'); background-repeat: no-repeat; background-size: contain;" alt="" height="250px"></a>
                        <a href="product.php?id=<?= $id_product; ?>" class="btn-floating halfway-fab waves-effect waves-light right"><i class="material-icons">add</i></a>
                      </div>
                      <div class="card-action">
                        <div class="container-fluid">                        
                          <span class=" black-text"><?= $name_product; ?></span>
                          <h5 class="grey-text">Ksh <?= $price_product; ?></h5>
                        </div>
                      </div>
                  </div>
                </div>
              <?php }} ?>

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
            </div>
          </div>
        </div>

          <div class="container-fluid center-align categories">
            <a href="#category" class="button-rounded btn-large waves-effect waves-light">Categories</a>
            <div class="container" id="category">
              <div class="row">
                <?php

                //get categories
                $querycategory = "SELECT id, name, icon  FROM category";
                $total = $connection->query($querycategory);
                if ($total->num_rows > 0) {
                  // output data of each row
                  while($rowcategory = $total->fetch_assoc()) {
                    $id_category = $rowcategory['id'];
                    $name_category = $rowcategory['name'];
                    $icon_category = $rowcategory['icon'];

                    ?>

                    <div class="col s12 m4">
                      <div class="card hoverable animated slideInUp wow">
                        <div class="card-image" >
                          <a href="category.php?id=<?= $id_category; ?>">
                          <img style="background-image: url('src/img/<?= $icon_category; ?>.jpg'); background-repeat: no-repeat; background-size: contain;" alt="" height="250px"></a>
                          <span class="card-title black-text"><?= $name_category; ?></span>
                        </div>
                      </div>
                    </div>

                    <?php }} ?>
                  </div>
                </div>
              </div>


              <div class="container-fluid about" id="about">
                <div class="container">
                  <div class="row">
                    <div class="col s12 m6">
                      <div class="card animated slideInUp wow">
                        <div class="card-image">
                          <img src="src/img/about.jpg" alt="">
                        </div>
                      </div>
                    </div>

                    <div class="col s12 m6">
                      <h3 class="animated slideInUp wow">About Us</h3>
                      <div class="divider animated slideInUp wow"></div>
                      <p class="animated slideInUp wow black-text">We are a fruit selling website which is involved in health education on the benefits of fruits. We also partner with suppliers of the fruits to make them available to users wanting to live a more healthy life.</p>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="container contact" id="contact">
                  <div class="row">
                    <form class="col s12 animated slideInUp wow">
                      <div class="row">
                        <div class="input-field col s12 m6">
                          <i class="material-icons prefix">account_circle</i>
                          <input id="icon_prefix" type="text" class="validate">
                          <label for="icon_prefix">Full Name</label>
                        </div>
                        <div class="input-field col s12 m6">
                          <i class="material-icons prefix">email</i>
                          <input id="email" type="email" class="validate">
                          <label for="email" data-error="wrong" data-success="right">Email</label>
                        </div>



                        <div class="input-field col s12 ">
                          <i class="material-icons prefix">message</i>
                          <textarea id="icon_prefix2" class="materialize-textarea" type="text" name="message" rows="8" style="resize: vertical;min-height: 16rem;" required></textarea>
                          <label for="icon_prefix2">Your message</label>
                        </div>

                        <div class="center-align">
                          <button type="submit" name="contact" class="button-rounded btn-large waves-effect waves-light">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <?php
                require 'includes/secondfooter.php';
                require 'includes/footer.php'; ?>

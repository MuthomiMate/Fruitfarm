 <div class="navbar-fixed">
  <nav class="navblack">
    <div class="nav-wrapper nav-wrapper-2 container white">
    <ul class="left hide-on-med-and-down">
      <li><a href="http://onesha.dev/www/fruitfarm/index" class="brand"></a></li>
      <li><a href="http://onesha.dev/www/fruitfarm/index" class="dark-text">FruitFarm</a></li>

    </ul>

    <ul class="center hide-on-large-only">
      <li><a href="http://onesha.dev/www/fruitfarm/index.php" class="dark-text">FruitFarm</a></li>

    </ul>

    <ul  class="right hide-on-med-and-down">
        <li><a href="http://onesha.dev/www/fruitfarm/account-admin" class="dark-text">Admin</a></li>
      <li><a href="http://onesha.dev/www/fruitfarm/account" class="waves-effect waves-light btn button-rounded">Sign In</a></li>
      <li><a href="http://onesha.dev/www/fruitfarm/cart" class="dark-text baskett"><i class="material-icons">shopping_cart</i>
        <span class="badge <?php if(!isset($_SESSION['item']) OR $_SESSION['item'] == 0) echo'hide'; ?>"><?= $_SESSION['item']; ?></span></a></li>
    </ul>
  </div>
  </nav>
</div>
<div class="row">
    <div class="alert alert info">
      <p style="text-align: center;">
      <?php if (isset($_SESSION['msg'])) { 
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
      } ?>
      </p>
    </div>
</div>
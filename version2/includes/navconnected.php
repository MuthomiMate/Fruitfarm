
<ul id="dropdown2" class="dropdown-content">
<li><a class="blue-text" href="http://onesha.dev/www/fruitfarm/editprofile">Edit</a></li>
<li><a class="blue-text" href="http://onesha.dev/www/fruitfarm/includes/logout">Log out</a></li>
</ul>
<div class="navbar-fixed">
 <nav class="navblack">
   <div class="nav-wrapper nav-wrapper-2 container white">
   <ul class="left hide-on-med-and-down">
     <li><a href="dashboard" class="brand"></a></li>
     <li><a href="http://onesha.dev/www/fruitfarm/dashboard" class="dark-text">FruitFarm</a></li>

   </ul>

   <ul class="center hide-on-large-only">
     <li><a href="http://onesha.dev/www/fruitfarm/dashboard" class="dark-text">FruitFarm</a></li>

   </ul>

   <ul  class="right hide-on-med-and-down">
       <li><a href="http://onesha.dev/www/fruitfarm/orders" class="dark-text">My Oders</a></li>
     <li><a href="http://onesha.dev/www/fruitfarm/cart" class="dark-text baskett"><i class="material-icons">shopping_cart</i>
       <span class="badge <?php if(!isset($_SESSION['item']) OR $_SESSION['item'] == 0) echo'hide'; ?>"><?= $_SESSION['item']; ?></span></a></li>
     <li><a href="editprofile" class="nohover dropdown-button" class="dropdown-button" data-activates="dropdown2"><img class="responsive-img" src="users/default.jpg">
       <i class="fa fa-angle-down dark-text right"></i></a></li>
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

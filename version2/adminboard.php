<?php include '../includes/header.php'; ?>
<?php require_once 'Controller/index-controller.php'; ?>

<div class="container-fluid home" id="top">
  <div class="container search">
    <nav class="animated slideInUp wow">
      <div class="nav-wrapper">
      	<label>Welcome <?= $_SESSION[''] ?> </label>
        <form method="GET" action="search.php">
          <div class="input-field">
            <input id="search" class="searching" type="search" name='searched' required>
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

 <?php
require '../includes/secondfooter.php';
require '../includes/footer.php'; ?>

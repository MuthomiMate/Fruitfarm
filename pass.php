<?php

session_start();

if (!isset($_SESSION['logged_in'])) {
    $nav ='includes/nav.php';
}

elseif($_SESSION['logged_in'] == 'True') {
  header('Location: index');
}

else{
  $nav ='includes/navconnected.php';
  $idsess = $_SESSION['id'];
}
error_reporting(0);

 require 'includes/header.php';
 require $nav; ?>



<div class="container-fluid center-align sign">
  <div class="container">

  <div class="row">
    <div class="col s12">
       <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#test1">Password Recovery</a></li>
        
       </ul>
   </div>

<div class="container forms">
 <div class="row">


      <div id="test1" class="col s12 left-align">

        <div class="card">
          <div class="row">
       <form class="col s12" method="POST" enctype="multipart/form-data">
          <div>Enter valid Email</div>

           <div class="input-field col s12">
             <i class="material-icons prefix">email</i>
             <input id="icon_prefix" type="text" name="emaillog" class="validate">
             <label for="icon_prefix">Email</label>
           </div>
           

         
               <div class="center-align">
                   <button type="submit" name="recover" class="btn button-rounded waves-effect waves-light ">Submit</button>
                   <?php require 'includes/loginconfirmation.php';?>
               </div>
       </form>
     </div>
        </div>

      </div>
      </div>
      </div>
   </div>
  </div>
</div>


  <?php require 'includes/footer.php'; ?>

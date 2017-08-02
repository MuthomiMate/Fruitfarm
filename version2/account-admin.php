
<!DOCTYPE html>
<html>
  <head>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>FruitFarm</title>
      <link rel="icon" href="src/img/icon.png">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <!-- font-awesome -->
      <link rel="stylesheet" href="src/css/font-awesome-4.6.3/css/font-awesome.min.css">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="src/css/materialize.min.css"  media="screen,projection"/>
      <!-- animate css -->
      <link rel="stylesheet" href="src/css/animate.css-master/animate.min.css">
      <!-- My own style -->
      <link rel="stylesheet" href="src/css/style.css">
      <!-- Progress bar -->
      <link rel='stylesheet' href='src/css/nprogress.css'/>
    </head>
  <body>
<?php
error_reporting(0);

require 'includes/nav.php';
?>



<div class="container-fluid center-align sign">
  <div class="container">

    <div class="row">
      <div class="col s12">
       <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#test1">Log In</a></li>
        <li class="tab col s3"><a  href="#test2">Sign Up</a></li>
      </ul>
    </div>

    <div class="container forms">
     <div class="row">

      <div id="test2" class="col s12 left-align">
       <div class="card">
         <div class="row">

         <form class="col s12" method="POST" action="Controller/signup-controller.php" enctype="multipart/form-data">
            <div class="row">

              <div class="input-field col s6">
                <i class="material-icons prefix">email</i>
                <input id="icon_prefix" type="text" name="email" class="validate" required>
                <label for="icon_prefix">Email</label>
              </div>

              <div class="input-field col s6">
                <i class="material-icons prefix">phone</i>
                <input id="icon_prefix" type="text" name="phone" class="validate" required>
                <label for="icon_prefix">Phone</label>
              </div>

              <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_prefix" type="text" name="firstname" class="validate" required>
                <label for="icon_prefix">First Name</label>
              </div>

              <div class="input-field col s6">
                <i class="material-icons prefix">perm_identity</i>
                <input id="icon_prefix" type="text" name="lastname" class="validate" required>
                <label for="icon_prefix">Last Name</label>
              </div>

              <div class="input-field col s6">
                <i class="material-icons prefix">lock</i>
                <input id="icon_prefix" type="password" name="password" class="validate value1" required>
                <label for="icon_prefix">Password</label>
              </div>

              <div class="input-field col s6">
                <i class="material-icons prefix">lock</i>
                <input id="icon_prefix" type="password" name="confirmation" class="validate value2" required>
                <label for="icon_prefix">Confirm Password</label>
              </div>

              <div class="input-field col s6">
                <i class="material-icons prefix">business</i>
                <input id="icon_prefix" type="text" name="location" class="validate" required>
                <label for="icon_prefix">City</label>
              </div>

              <div class="input-field col s6 meh">
                <i class="material-icons prefix">location_on</i>
                <input id="icon_prefix" type="text" name="address" class="validate" required>
                <label for="icon_prefix">Address</label>
                <input type="hidden" name="usertype" value="2">
              </div>

              <div class="center-align">
                <button type="submit" id="confirmed" name="signup" class="btn meh button-rounded waves-effect waves-light ">Sign up</button>
              </div>

              <p>By Registering, you agree that you've read and accepted our <a href="">User Agreement</a>,
                you're at least 18 years old, and you consent to our <a href="">Privacy Notice and receiving</a>
                marketing communications from us.</p>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div id="test1" class="col s12 left-align">

        <div class="card">
          <div class="row">
           <form class="col s12" method="POST" action="Controller/login-controller.php">

             <div class="input-field col s12">
               <i class="material-icons prefix">email</i>
               <input id="icon_prefix" type="text" name="email" class="validate">
               <label for="icon_prefix">Email</label>
             </div>
             <div class="input-field col s12 meh">
               <i class="material-icons prefix">lock</i>
               <input id="icon_prefix" type="password" name="password" class="validate">
               <label for="icon_prefix">Password</label>
               <input type="hidden" name="usertype" value="1">
             </div>

             <div class="center-align">
               <button type="submit" name="login" class="btn button-rounded waves-effect waves-light ">Login</button>
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

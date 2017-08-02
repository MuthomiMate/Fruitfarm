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
        <li class="tab col s3"><a class="active" href="#test1">Change Password</a></li>
        
       </ul>
   </div>
   <script>
         

function validatePassword(){
  var password = document.getElementById("passworddu")
  , confirm_password = document.getElementById("passworddb");
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}


   
       </script>

<div class="container forms">
 <div class="row">


      <div id="test1" class="col s12 left-align">

        <div class="card">
          <div class="row">
       <form class="col s12" method="POST" onsubmit="return validatePassword()" action="reset.php?encrypt=<?php echo$_GET['encrypt'];?>&action=reset">
       
       

          <div class="input-field col s12 meh">
             <i class="material-icons prefix">lock</i>
             <input id="passworddu" type="password" name="passworddu" class="validate" onchange="validatePassword()" required>
             <label for="passworddu"> New Password</label>
           </div>

           
           <div class="input-field col s12 meh">
             <i class="material-icons prefix">lock</i>
             <input id="passworddb" type="password" name="passworddb" class="validate"  onkeyup="validatePassword()" required>
             <label for="passworddb"> Confirm Password</label>
           </div>
           <div name="encrypt" value=" "></div>

           
           
               <div class="center-align">
                   <button type="submit" name="sent" class="btn button-rounded waves-effect waves-light " >Submit</button>
               </div>
               
                <div class="registrationFormAlert" id="divCheckPasswordMatch">
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

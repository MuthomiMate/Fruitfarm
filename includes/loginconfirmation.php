<?php

if (isset($_POST['login'])) {


$email = $_POST['emaillog'];
$password=md5($_POST['passworddb']);
include 'db.php';
$email=mysqli_real_escape_string($connection, $email);
$query = "SELECT * FROM users WHERE email='{$email}' and password = '{$password}'";
$select_user_query = mysqli_query($connection, $query);


if (!$select_user_query) {
DIE("QUERY FAILED". mysqli_error($connection));
}
$row = mysqli_fetch_array($select_user_query);

$user_id = $row['id'];
$user_email = $row['email'];
$user_password = $row['password'];
$user_firstname= $row['firstname'];
$user_lastname= $row['lastname'];
$user_address= $row['address'];
$user_city= $row['city'];
$user_phone= $row['phone'];
$user_role = $row['role'];


if ($email !== $user_email && $password !== $user_password) {
echo "<div class='center-align meh'>
  <h5 class='red-text'>Wrong Info</h5>
</div>";
}



else{
  if($user_role == 'admin'){

    $_SESSION['id'] = $user_id;
    $_SESSION['firstname'] = $user_firstname;
    $_SESSION['lastname'] = $user_lastname;
    $_SESSION['address'] = $user_address;
    $_SESSION['city'] = $user_city;
    $_SESSION['phone'] = $user_phone;
    $_SESSION['email'] = $user_email;
    $_SESSION['role'] = 'admin';
    $_SESSION['logged_in']= 'True';
    echo "<meta http-equiv='refresh' content='0;url=admin/index' />";
  }

    else {
    $_SESSION['id'] = $user_id;
    $_SESSION['firstname'] = $user_firstname;
    $_SESSION['lastname'] = $user_lastname;
    $_SESSION['address'] = $user_address;
    $_SESSION['city'] = $user_city;
    $_SESSION['phone'] = $user_phone;
    $_SESSION['email'] = $user_email;
    $_SESSION['logged_in']= 'True';
    $back = $_SERVER['HTTP_REFERER'];
    echo '<meta http-equiv="refresh" content="0;url=' . $back . '">';
    }
 }
} 
if (isset($_POST['recover'])) {
    $email = $_POST['emaillog'];
    include 'db.php';
    $email=mysqli_real_escape_string($connection, $email);
    $query = "SELECT * FROM users WHERE email='{$email}'";
    $select_user_query = mysqli_query($connection, $query);
    if ($select_user_query->num_rows>0) {
            $Results = mysqli_fetch_array($select_user_query);
         $encrypt = md5(1290*3+$Results['id']);
            $message = "Your password reset link send to your e-mail address.";
            $to=$email;
            $subject="Forget Password";
            $from = 'muthomimate@gmail.com';
            $body='Hi, <br/> <br/>Your Membership ID is '.$Results['id'].' <br><br>Click here to reset your password http://localhost/fruitfarm/passrec.php?encrypt='.$encrypt.'&action=reset   <br/> <br/>--<br>fruitfarm<br>Solve your problems.';
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 
            if(mail($to,$subject,$body,$headers)){
                echo "<div class='center-align meh'>
  <h5 class='red-text'>Reset link has been sent to your email</h5>
</div>";
            }
            else{
                echo "<div class='center-align meh'>
  <h5 class='red-text'>Email not sent</h5>
</div>";
            }


        
    }else{
        echo "<div class='center-align meh'>
  <h5 class='red-text'>User with that email not found. Please sign up</h5>
</div>";
    }
}
// if (isset($_POST['sent'])) {
//     $password = $_POST['passworddu'];
//     include 'db.php';
    
//     $query = "UPDATE SET password= '$password' WHERE email='{$email}'";
//     $select_user_query = mysqli_query($connection, $query);
//     if ($select_user_query->num_rows>0) {
//         echo "<div class='center-align meh'>
//   <h5 class='red-text'>Wrong Info</h5>
// </div>";
//     }else{
//         echo "<div class='center-align meh'>
//   <h5 class='red-text'>User with that email not found. Please sign up</h5>
// </div>";
//     }
// }


// if(isset($_GET['action']))
// {          
//     if($_GET['action']=="reset")
//     {
//         $encrypt = mysqli_real_escape_string($connection,$_GET['encrypt']);
//         $query = "SELECT id FROM users where md5(90*13+id)='".$encrypt."'";
//         $result = mysqli_query($connection,$query);
//         $Results = mysqli_fetch_array($result);
//         if(count($Results)>=1)
//         {
 
//         }
//         else
//         {
//            // $message = 'Invalid key please try again. <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
//         }
//     }
// }
// elseif(isset($_POST['sent']))
// {
 
//     $encrypt      = mysqli_real_escape_string($connection,$_POST['action']);
//     $password     = mysqli_real_escape_string($connection,$_POST['password']);
//     $query = "SELECT id FROM users where md5(90*13+id)='".$encrypt."'";
 
//     $result = mysqli_query($connection,$query);
//     $Results = mysqli_fetch_array($result);
//     if(count($Results)>=1)
//     {
//         $query = "update users set password='".md5($password)."' where id='".$Results['id']."'";
//         mysqli_query($connection,$query);
 
//       //  $message = "Your password changed sucessfully <a href=\"http://demo.phpgang.com/login-signup-in-php/\">click here to login</a>.";
//     }
//     else
//     {
//         //$message = 'Invalid key please try again. <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
//     }
// }
// else
// {
//     header("location: /login-signup-in-php");
// }


?>

<?php
include "db.php";
if(isset($_GET['action'])){
	
        
    if($_GET['action']=="reset")
    {
       $encrypt = mysqli_real_escape_string($connection, $_GET['encrypt']);
       //$encrypt=intval($_GET['encrypt']);
      // echo($encrypt);

    	//$encrypt=$_GET['encrypt'];
       //where md5(90*13+id)='".$encrypt."'";
        $query = "SELECT * FROM users";

        
        $result = mysqli_query($connection,$query);
        //  $Results = mysqli_fetch_assoc($result);
        // var_dump($Results);

        while ($ids=mysqli_fetch_assoc($result)) {
        	$id=$ids['id'];
        	$mu=md5(1290*3+$id);
        	//var_dump($mu);
        	//var_dump($encrypt);
        	//var_dump($mu);
        	if($mu==$encrypt){
        		$password     = $_POST['passworddu'];
        		//var_dump($password);
        		$query = "update users set password='".md5($password)."' where id='".$id."'";
       			 if(mysqli_query($connection,$query)==TRUE){
       			 	echo("updated sucessfully");
       			 	header("location:sign.php");
       			 }
       			 else{
       			 	echo(" not updated");
       			 }
        	}
        	
        }

       
        
       
    }
}
elseif(isset($_POST['']))
{
	echo $_GET['action'];
	
 	//$encrypt = mysqli_real_escape_string($connection,$_GET['encrypt']);
   $encrypt      = mysqli_real_escape_string($connection,$_POST['encrypt']);
    $password     = mysqli_real_escape_string($connection,$_POST['passworddu']);
    $query = "SELECT id FROM users where md5(90*13+id)='".$encrypt."'";

 
    $result = mysqli_query($connection,$query);
    $Results = mysqli_fetch_array($result);
    if(count($Results)>=1)
    {
        $query = "update users set password='".md5($password)."' where id='".$Results['id']."'";
        mysqli_query($connection,$query);
 
      $message = "Your password changed sucessfully <a href=\"http://demo.phpgang.com/login-signup-in-php/\">click here to login</a>.";
    }
    else
    {
        $message = 'Invalid key please try again. <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
    }
}
else
{
    //header("location: /login-signup-in-php");
}
?>
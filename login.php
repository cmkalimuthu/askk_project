<?php 

include 'core/init.php';
protect_redirect();
if(empty($_POST)===false){
$username=$_POST['username'];
$password=$_POST['password'];

if(user_exists($username)===true)
{
	//acount exists
	$errors[]='username exist';
	if(user_active($username)===true){
		//account activated
		$login=login($username,$password);
		if($login==true){
			//set the user sesion 
			//redirect user to home
		      $_SESSION['user_id']=$login;
		     ?>
		      <script>
		      setTimeout(function()
{ 
     window.location = "feeds.php"; 
}, 500);
</script>
		    <?php  
		      exit();
		      
		}
		else{
			
			$errors[]='password/username incorrect';
		}
	}
	else{
		$errors[]='account not activated';
	}
	
}
//user name is not exist in db
else{
	$errors[]='username not exist have you registered ?';
}

}
include 'includes/overall/overall_header.php';
if(empty($errors)===false){
	?>
	<h2>we tried to log you in, but...</h2>
	<?php 
echo output_errors($errors);
}
include 'includes/overall/overall_footer.php';

 ?>

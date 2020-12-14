<?php 
include 'core/init.php'; 
//protect_page();//protect page from accessing from outside

//checking whether data recieved in server
protect_redirect();//to avoid accessing the page after logged in
include 'includes/overall/overall_header.php';?>
<?php 
//check whether page is new or already visited 
//checking whether url contains the success keyword in it
if(isset($_GET['success'])===true&&empty($_GET['success'])===true){
	?>
	<h2>thanks ,we've activated your account</h2>
	<p>your are free to login</p>
	<?php  
}
//if it is new visit 1st time
////checking whether url contains the email_id and email_code keyword in it from mail link
else if(isset($_GET['email_id'],$_GET['email_code'])===true){
	$email_id     =trim($_GET['email_id']);//to avoid space while copying the link
	$email_code   =trim($_GET['email_code']);
    //check whether email is exist and it is registered and ready to activate
	if(email_exists($email_id)===false){
		$errors[] ='oops something went wrong and we coundnt find this email id';
	}
	//function in users file to check the user activated or not
	else if (activate($email_id,$email_code)===false) {
		$errors[ ]='we have problems at activatating your account';
	}
	//if above all are notsatisfied it print the errors
	if(empty($errors)===false){
		?>
		<h2>oops..</h2>
		<?php 
		echo output_errors($errors);
	}
	//if everything is fine it redirects to activate.php with success keyword to indicate its visited
	else{
		 ?>
		<script>

setTimeout(function()
{ 
     window.location = "activate.php?success"; 
}, 500);

</script>
		<?php
          exit();
		
	}
}
//if nothing happens it directs to index page
else{
 ?>
		<script>

setTimeout(function()
{ 
     window.location = "index.php"; 
}, 500);

</script>
		<?php
          exit();
}

?>


 
            
<?php
 
include 'includes/overall/overall_footer.php';
 ?>
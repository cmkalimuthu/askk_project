<?php 
include 'core/init.php'; 
//protect_page();//protect page from accessing from outside

//checking whether data recieved in server
protect_redirect();
include 'includes/overall/overall_header.php'; 
?>

            <!-- article starts here -->
            <h1>RECOVERY</h1>
            <!-- article ends here -->
<?php 
if(isset($_GET['success'])===true&& empty($_GET['success'])===true){
	?>
	<p>Thanks, Request successfull please check your mail </p>
	<?php  

}
else{
$mode_allowed=array('username','password');
if(isset($_GET['mode'])===true && in_array($_GET['mode'],$mode_allowed)===true){
	if(isset($_POST['email_id'])===true &&empty($_POST['email_id'])===false){
		if(email_exists($_POST['email_id'])===true){
   recover($_GET['mode'],$_POST['email_id']);
    ?>
		<script>

setTimeout(function()
{ 
     window.location = "recover.php?success"; 
}, 500);

</script>
		<?php
          exit();
   
		}
		else{
			echo '<p>oops,we could\'t find the email address</p>';
		}
	}
 ?>
    <form action="" method="post">
    	<ul  style="list-style-type: none">
    		<li>
    			Recovery Email Id:<br>
    			<input type="text" name="email_id">
    		</li><br>
    		<li>
    			<input type="submit" value="send">
    		</li>
    	</ul>
    </form>  
    <?php
}
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
}
    ?>      



 
            
<?php
 
include 'includes/overall/overall_footer.php';
 ?>
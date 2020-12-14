<?php 
include 'core/init.php'; 
//protect_page();//protect page from accessing from outside

//checking whether data recieved in server
protect_page();
admin_protect();
include 'includes/overall/overall_header.php'; 
if(isset($_GET['success'])&&empty($_GET['success'])){
             	?>
             	<h1>email delievered to all subscribers!!</h1>
             	<?php  
             }
             else{
 	?>



            <!-- article starts here -->
            <h1>Email all users</h1>
            <?php 

 			 if(empty($_POST)===false){
 			 	if(empty($_POST['subject'])===true){
 			 		$errors[]='Subject is required';
 			 	}
 			 	if(empty($_POST['body'])===true){
 			 		$errors[]='Body is required';
 			 	}
 			 	if(empty($errors)===false){
 			 		echo output_errors($errors);
 			 	}else{
 			 		//send email
 			 		mail_users($_POST['subject'],$_POST['body']);
 			 	 ?>
		<script>

setTimeout(function()
{ 
     window.location = "mail_users.php?success"; 
}, 500);

</script>
		<?php
          exit();
 			 	}


 			 }


?>
  <form method="post" action="">
            	<ul style="list-style-type: none;">
            		<li>
            			Subject*:<br>
            			<input type="text" name="subject">
            		</li><br>
            		<li>
            			Body*:<br>
            			<textarea name="body" style="width: 400px;height: 150px;"></textarea>
            		</li><br>
            		<li>
            			<input type="submit" value="send">
            		</li>
            	</ul>
            	
            </form>
            
<?php
             }
include 'includes/overall/overall_footer.php';
 ?>
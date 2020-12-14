<?php 
include 'core/init.php'; 
//protect_page();//protect page from accessing from outside

//checking whether data recieved in server
if(empty($_POST)===false){
	$required_fields=array('current_password','new_password','new_password_again');//to get values from db using init.php variable
	foreach ($_POST as $key => $value) {
         if(empty($value)&& in_array($key,$required_fields)===true){
         	$errors[]='fields marked with asterisk are required';//all fields are required
         	break 1;
         }
     }
         if (md5($_POST['current_password'])===$user_data['password']) {//checking entered and bd password are same
         	if (trim($_POST['new_password'])!==trim($_POST['current_password'])) {//checking new and old pass are same
         			
         	 if(strlen($_POST['new_password'])<6){//check password less than 6 chars
         		$errors[]='Your password must atleast greater than 6 chars';
         	}
         	else{//check for new and new again is same
         	if(trim($_POST['new_password'])!==trim($_POST['new_password_again']))
         	{
         		$errors[]='new password and new password again should match';
         	}
         }
         
     }
     		else{
     		$errors[]='new password and old password are same please try another one';
     		}
 }
     else{
         	$errors[]='please enter the correct current password';
      }
}


 
 include 'includes/overall/overall_header.php'; 

 ?>

            <!-- article starts here -->
            <h1>change your current password</h1>
            <?php  
            if(isset($_GET['success'])&&empty($_GET['success'])){//checking 1st vist or operation success
             	echo "your password changed successfully please login to verify it";             
             }
            else{//everything is fine then change password function call
            	if(isset($_GET['force'])&&empty($_GET['force'])){
            			?>
            			<p>you must change your password to proceed further !!</p>
            			<?php
            	}
               if(empty($errors)===true&&empty($_POST)===false){
			    $change_password=change_password($_POST['new_password'],$user_data['user_id']);
			    //if function returns true directs the page with success keyword
			   if($change_password===true){
	              ?>
		<script>

setTimeout(function()
{ 
     window.location = "change_password.php?success"; 
}, 500);

</script>
		<?php
	              exit();
}
//if not fine some errors occured in format db
else{
	echo "some error has occured please give correct format";
   }
 }
//display the errors using the general function
elseif (empty($errors)===false) {
	# code...
	echo output_errors($errors);
    }


?>
            <form method="post" action="">
            	<ul style="list-style-type: none;">
            		<li>
            			Current Password*:<br>
            			<input type="password" name="current_password">
            		</li><br>
            		<li>
            			New Password*:<br>
            			<input type="password" name="new_password">
            		</li><br>
            		<li>
            			New Password again*:<br>
            			<input type="password" name="new_password_again">
            		</li><br>
            		<li>
            			<input type="submit" value="  change  ">
            		</li>


            	</ul>

            </form>

            <!-- article ends here -->
            
<?php
} 
include 'includes/overall/overall_footer.php';
 ?>
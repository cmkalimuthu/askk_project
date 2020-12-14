<?php 
include 'core/init.php'; 
//protect_page();//protect page from accessing from outside

//checking whether data recieved in serve;
protect_redirect();
include 'includes/overall/overall_header.php'; 

if(empty($_POST)===false){
	$required_fields=array('username','password','password_again','first_name','last_name','email_id','address','location','contact_no1','contact_no2','liscense_no','city');
	foreach ($_POST as $key => $value) {
         if(empty($value)&& in_array($key,$required_fields)===true){
         	$errors[]='fields marked with asterisk are required';
         	break 1;
         }
         if(empty($errors)===true){
         	$user_exists=user_exists($_POST['username']);
         	$email_exists=email_exists($con,$_POST['email_id']);
         	if($user_exists===true){
         		$errors[]=' sorry, the user name \''.$_POST['username'].'\' already exist choose another';
         	}
         	if(preg_match('/^([a-z]|[A-Z]|[0-9]| |_|-)+$/', $_POST['username'])===0){
         		$errors[]='ýour username should not contain special chars';
         	}
         	if(preg_match("/\\\s/",$_POST['username'])==true){
         		$errors[]='ýour username should not contain more space';
         	}
         	

         	if(strlen($_POST['password'])<6){
         		$errors[]='Your password must atleast greater than 6 chars';
         	}
         	if($_POST['password']!==$_POST['password_again']){
         		$errors[]='Your password do not match';
         	}
         	if(filter_var($_POST['email_id'],FILTER_VALIDATE_EMAIL)===false){
         		$errors[]='enter valid email_id';
         	}
         	if($email_exists===true){
         		$errors[]=' sorry, the email id \''.$_POST['email_id'].'\' already exist choose another';
         	}
         }
	}

}
?>
   <!-- article starts here -->
            <h1>Registration form</h1>
             <?php  
             if(isset($_GET['success'])&&empty($_GET['success'])){
             	echo "you have been registered successfully please verify email to activate your account";
             }
             else{
                if(empty($errors)===true&&empty($_POST)==false){
//registered
	            $register_data=array(
				'username'		=>$_POST['username'],
	    		'first_name'	=>$_POST['first_name'],
				'last_name'		=>$_POST['last_name'],
				'email_id'		=>$_POST['email_id'],
				'password'		=>$_POST['password'],
				'email_code'    =>md5($_POST['username']+microtime()),
				'address'		=>$_POST['address'],
				'location'		=>$_POST['location'],
				'contact_no1'	=>$_POST['contact_no1'],
				'contact_no2'	=>$_POST['contact_no2'],
				'liscense_no'	=>$_POST['liscense_no'],
				'city'			=>$_POST['city']
				);
				$registered_users=registered_users($register_data);
				if($registered_users===true){
					?>
		<script>

setTimeout(function()
{ 
     window.location = "registration.php?success"; 
}, 2000);

</script>
		<?php
          exit();
				}
else{
	echo "some error has occured please give correct format";
	//redirect
}

}
elseif (empty($errors)===false) {
	# code...
	echo output_errors($errors);
}


?>
            <form action="" method="post">
            	<ul style="list-style-type: none;">
            		<li>
            			Username*:<br>
            			<input type="text" name="username">
            		</li>
            		<br>
            		<li>
            			Password*:<br>
            			<input type="password" name="password">
            		</li>
            		<br>
            		<li>
            			Password again*:<br>
            			<input type="password" name="password_again">
            		</li>
            		<br>
            		<li>
            			First Name*:<br>
            			<input type="text" name="first_name">
            		</li>
            		<br>
            	<li>
            			Organisation Type*:<br>
            			<select name="last_name"style="width: 150px;height: 30px">
                  <option value="" disabled="disabled"selected="selected">select-one</option>
                  <option value="orphanage">orphanage</option>
                  <option value="old age home">old age home</option> 
                  <option value="community hall">community hall</option>
                  <option value="catering service">catering service</option>
                  <option value="others">others</option>

                     </select>
            		</li>
            		<br>
            		<li>
            			Email Id*:<br>
            			<input type="text" name="email_id">
            		</li>
            		<hr>
            		<br>
            		<li>
            			Address*:<br>
            			<textarea name="address"></textarea>
            		</li><br>
            		<li>
            			City*:<br>
            			<input type="text" name="city">
            		</li>
            		<br>
            		<li>
            			Map Location *:<br>
            			<input type="text" name="location">
            		</li>
            		<hr>
            		<br>
            		<li>
            			Contact No 1*:<br>
            			<input type="text" name="contact_no1">
            		</li>
            		<br>
            		<li>
            			Contact No 2:<br>
            			<input type="text" name="contact_no2">
            		</li>
            		<br>

            		<li>
            			Organization Liscense No*:<br>
            			<input type="text" name="liscense_no">
            		</li>
            		<br><hr>
            		<li style="text-align: center;">
            			<input type="submit" value="Register" style="width: 100px">
            		</li>
            	</ul>
            </form>
            <!-- article ends here -->
           
            
<?php
             }
include 'includes/overall/overall_footer.php';
 ?>
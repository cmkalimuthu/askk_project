<?php 

//for checking each page not to access when user logged in
function protect_redirect(){
	if(logged_in()==true){
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
}
//for checking each page not to access when user not logged in
function protect_page(){
	if(logged_in()==false){
	?>
		<script>

setTimeout(function()
{ 
     window.location = "protected.php"; 
}, 500);

</script>
		<?php
		exit();
	}
	
}
//admin
function admin_protect(){
	global $user_data;
	if(is_admin($user_data['user_id'])===false){
		header('Location:feeds.php');
		exit();
	}
	
}
//for avoiding cross scripting
function xss($data){
	$var=strip_tags($data);
	$var=htmlentities($var);
	return $var;
}

//santize data to avoid sql injection and htmlentities
function sanitize($con,$data){

	$var= mysqli_real_escape_string($con,$data);
	//$var=xss($data);
    return $var;
}
//output errors in body page in list format
function output_errors($errors){
	$output=array();
	foreach ($errors as $error) {
		# code...
		$output[]='<li style="color:red;">'. $error .'</li>';
	}//impode for array to string
	return '<ul>' . implode('',$output) .'</ul>';
}
function display_users($users){
	$output=array();
	foreach ($users as $user) {
		# code...
		$output[]='<li style="color:red;">'. $user .'</li>';
	}//impode for array to string
	echo '<ul>' . implode('',$output) .'</ul>';
}
 ?>


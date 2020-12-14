<?php
session_start();
//error_reporting(0);
require 'database/connect.php';
require 'functions/general.php';
require 'functions/users.php';
require 'functions/posts.php';
$errors=array();
$current_file=explode('/',$_SERVER['SCRIPT_NAME']);
$current_file=end($current_file);
$user_count=users_count();
if(logged_in()===true){
	$session_user_id=$_SESSION['user_id'];
	$user_data=users_data($session_user_id,'user_id','username','first_name','last_name','email_id','password','password_recovery','user_type','allow_email','address','city','location','contact_no1','contact_no2','liscense_no');
	$user_active=user_active($user_data['username']);
	$post_data=post_select($session_user_id,'post_id','food_type','food_quantity','time_limit','active','user_id','posting_time','description');
    

	if($user_active===false){
session_destroy();
header('Location:index.php');
exit();
	}
	if($current_file!=='change_password.php'&& $user_data['password_recovery']==1){
		header('Location:change_password.php?force');
		exit();
	}
}

 ?>

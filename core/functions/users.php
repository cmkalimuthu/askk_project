<?php 


function mail_users($subject,$body){
	global $con;
$query="SELECT email_id,first_name FROM users WHERE allow_email=1";
$res=mysqli_query($con,$query);

while($row=mysqli_fetch_assoc($res)){
	 email($row['email_id'],$subject,"Hello ".$row['first_name'] .",\n\n".$body."\n\n-donors.org");
}
//$count=count($mail);
//for($i=0;$i<$count;$i++){
	  

}
function is_admin($user_id){
	global $con;
	$user_id=(int)$user_id;
	$query="SELECT count(user_id) FROM users WHERE user_id='$user_id' AND user_type=1";
	$res=mysqli_query($con,$query);
	$row=mysqli_fetch_array($res); //fetch one by one data from db
	$count=$row['count(user_id)'];
	if($count)
		return true;
	else
		return false;

}

//recovery for username and password
function recover($mode,$email_id){
	global $con;
	$mode=sanitize($con,$mode);
	$email_id=sanitize($con,$email_id);
	$user_id=user_id_from_email($email_id);
    $user_data=users_data($user_id,'first_name','username');
    if($mode==='username'){
     email($email_id,'your username recovery',"Hello ".$user_data['first_name'].",\n\nYour username is: ".$user_data['username'].".\n\n-donors.org");
     return true;
    }else if($mode==='password'){
     $generated_password=substr(md5(rand(999,999999)),0,8);
     change_password($generated_password,$user_id);
     settings_update($user_id,array('password_recovery'=>'1'));

     email($email_id,'your password recovery',"Hello ".$user_data['first_name'].",\n\nYour password is: ".$generated_password.".\n\n-donors.org");
     return true;
    }

}
function settings_update($user_id,$update_data){
	global $con;
	foreach ($update_data as $key => $value) {
	$value=sanitize($con,$value);
	}
	$update=array();
	
	foreach ($update_data as $fields => $data) {
		# code...
		$update[]='`'.$fields.'`=\''.$data.'\'';//coverting to sql update format
	}
	$update=implode(', ',$update);//array to string
	$query="UPDATE users SET $update WHERE user_id='$user_id'";
	if ($con->query($query) === TRUE) {
		return true;
	}
	else{
		return false;
	}

}

//funtion to activate user account through email verification
function activate($email,$email_code){
	global $con;
 	$email        =mysqli_real_escape_string($con,$email);
 	$email_code   =mysqli_real_escape_string($con,$email_code);
 	$query        ="SELECT count(user_id) FROM users WHERE email_id='$email' AND email_code='$email_code' AND active=0";
 	$res          =mysqli_query($con,$query);
 	$row          =mysqli_fetch_array($res);
 	$count        =$row['count(user_id)'];
 	if($count==1){
 		//active user status
 		$query="UPDATE users SET active=1 WHERE email_id='$email'";
 		if ($con->query($query) === true) {
 		return true;
 	}
	
	 }
	 else{
	 	return false;
 	 }
}

//function to send mail to the registered user to activate account
function email($to,$subject,$body){
	mail($to,$subject,$body,'from:organisation.com');
}
//function to register the user
function registered_users($register_data){
	global $con;
	foreach ($register_data as $key => $value) {
	$value=mysqli_escape_string($con,$value);
}
	$register_data['password']    =md5($register_data['password']);
	$fields                       ='`'.implode('`, `',array_keys($register_data)).'`';
	$data                         ='\''.implode('\', \'',	 $register_data).'\'';
    $query                        ="INSERT INTO users ($fields) VALUES ($data)";
	//connect query and database
	if ($con->query($query) === TRUE) {
    //for activating account
  	    email($register_data['email_id'],'Activate your account',"hello ".$register_data['first_name'].",\n\nyou need to activate your account, so use the link bellow link:\n\n  https://askk1.000webhostapp.com/activate.php?email_id=".$register_data['email_id']."&email_code=".$register_data['email_code']. ",\n\nThanks and Regards !\n\n- Donorsclub.");
       return true;
    } 
    else {
       return false;
}
$con->close();
}
//function for changing the user password 
function change_password($new_password,$user_id){
	global $con;
	$user_id=(int)$user_id;
	$new_password=md5($new_password);
	$new_password=sanitize($con,$new_password);
	$query="UPDATE users SET password='$new_password',password_recovery=0 where user_id='$user_id' ";
	if ($con->query($query) === TRUE) {
  		return true;
	} 
	else {
  		return false;
	}

}
//function to get the user data from database
function users_data($user_id){
	global $con;
	$data=array();
	$user_id=(int)$user_id;
	$func_num_args=func_num_args();
	$func_get_args=func_get_args();

	if($func_get_args>1){
		unset($func_get_args[0]);//removing first session id 
		$fields='`'.implode('`, `',$func_get_args) .'`';//converting array to string
		$query="SELECT $fields FROM users WHERE user_id='$user_id'";
		$res=mysqli_query($con,$query);
		$data=mysqli_fetch_assoc($res);//fetch one by one data from db
		return $data;
	}
}
//return session id
function logged_in(){
    
    
	return (isset($_SESSION['user_id']))?true:false;
}
//for active users
function users_count(){
	global $con;
    $query="SELECT count(user_id) FROM users WHERE active=1";
	$res=mysqli_query($con,$query);
	$row=mysqli_fetch_array($res);//fetch one by one data from db
	$count=$row['count(user_id)'];
	return $count;
}
//check user exist in db
function user_exists($data){
	global $con;
    //data sanitization
	$username=sanitize($con,$data);
	//query for database
	$query="SELECT 1 FROM users WHERE username='$username'";
	//connect query and database
	$res=mysqli_query($con,$query);
	//result 
	if(mysqli_num_rows($res)===1){
		return true;
	}
	else{
		return false;
	}
}
//check email already exist
function email_exists($data){
    //data sanitization
    global $con;
	$email_id=sanitize($con,$data);
	//query for database
	$query="SELECT 1 FROM users WHERE email_id='$email_id'";
	//connect query and database
	$res=mysqli_query($con,$query);
	//result 
	if(mysqli_num_rows($res)===1){
		return true;
	}
	else{
		return false;
	}
}
//check account is active 
function user_active($data){
	global $con;
	$username=sanitize($con,$data);
	$query="SELECT 1 FROM users WHERE active=1 AND username='$username'";
	$res=mysqli_query($con,$query);
	if(mysqli_num_rows($res)===1){
		return true;
	}
	else{
		return false;
	}
}
//username from user id
function username_from_user_id($user_id){
	global $con;
	$username=sanitize($con,$user_id);
	$query="SELECT username FROM users WHERE user_id='$user_id'";
	$res=mysqli_query($con,$query);
	$row=mysqli_fetch_array($res);
	$username=$row['username'];
	return $username;
	
}
//user id by username
function user_id_from_username($username){
	global $con;
	$username=sanitize($con,$username);
	$query="SELECT user_id FROM users WHERE username='$username'";
	$res=mysqli_query($con,$query);
	$row=mysqli_fetch_array($res);
	$user_id=$row['user_id'];
	return $user_id;
	
}
//user id from email
function user_id_from_email($email_id){
	global $con;
	$username=sanitize($con,$email_id);
	$query="SELECT user_id FROM users WHERE email_id='$email_id'";
	$res=mysqli_query($con,$query);
	$row=mysqli_fetch_array($res);
	$user_id=$row['user_id'];
	return $user_id;
	
}
//check login password/username correct
function login($username,$password){
   global $con;
	$user_id=user_id_from_username($username);
	$username=sanitize($con,$username);
	$password=md5($password);
	$query="SELECT count(user_id) FROM users WHERE username='$username' AND password='$password' ";
	$res=mysqli_query($con,$query);
	$row=mysqli_fetch_array($res);
	$count=$row['count(user_id)'];
	if($count>0){
		return $user_id;
	}
	else{
		return false;
	}

}


?>


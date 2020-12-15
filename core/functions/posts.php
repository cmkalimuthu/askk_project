<?php  
if(array_key_exists('delete', $_POST)) { 
            delete_post($_GET['post_id']); 
        } 
function delete_post($post_id){
  global $con;
  $query="DELETE  FROM post WHERE post_id='$post_id'";
  $res=mysqli_query($con,$query);
  //header('Location:profile.php');
  //exit();
  ?>
		<script>

setTimeout(function()
{ 
     window.location = "profile.php"; 
}, 100);

</script>
		<?php
          exit();
}
//notification
function my_messages($username,$data){
  global $con;
   if($data==="sent")
   $query="SELECT  message,reciever,message_time,sender FROM messages WHERE sender='$username'";
   else if($data==="recieved")
   $query="SELECT  message,reciever,message_time,sender FROM messages WHERE reciever='$username'";

   $res=mysqli_query($con,$query);
    while ($row = $res->fetch_assoc()) {//fetch one by one data from db
      $message=$row['message'];
      $reciever=$row['reciever'];
      $recieved_time=$row['message_time'];
      $sender=$row['sender'];
      my_message_display($message,$reciever,$recieved_time,$sender,$data);
  }

}
function my_message_display($message,$reciever,$recieved_time,$sender,$data){
  if($data=="sent"){
  ?>
  
  <div style="background-color: #bbb;padding: 4.5px;margin: 5px;">&nbsp;To&nbsp;<a href="<?php echo "$reciever"; ?>"><?php echo "$reciever"; ?></a>&nbsp;:<?php echo "$message"; ?><span style="float: right;"><?php echo "$recieved_time"; ?></span></div>
  <?php
   }
  else if($data=="recieved"){
    ?>
      <div style="background-color: #bbb;padding: 4.5px;margin: 5px;">&nbsp;From&nbsp;<a href="<?php echo "$sender"; ?>"><?php echo "$sender"; ?>&nbsp;</a>:<?php echo "$message"; ?><span style="float: right;"><?php echo "$recieved_time"; ?></span></div>
    <?php
  }  
}
function message($sender,$reciever,$message){
   global $con;
   date_default_timezone_set('Asia/Kolkata');
   $sending_time= date("Y-m-d H:i");
   $query="INSERT INTO `messages` (`sender` ,`reciever`,`message`,`message_time`)VALUES('$sender','$reciever','$message','$sending_time')";
   
  if ($con->query($query) === TRUE) 
  return true;
  else
  return false;

   
}
function user_id_from_post_id($post_id){
  global $con;
  $post_id      =(int)$post_id;
 
    $query="SELECT  user_id FROM post WHERE post_id='$post_id'";
    $res=mysqli_query($con,$query);
    //fetch one by one data from db
    while ($row = $res->fetch_assoc()) {
    $data=$row['user_id'];
  }
    return $data;

  }
function post_notification($post_id){
  global $con;
  $query="SELECT post_accepted,food_type FROM post WHERE post_id='$post_id' ";
  $res=mysqli_query($con,$query);
  while ($row = $res->fetch_assoc()) {
    $user_id=$row['post_accepted'];
    $food_type=$row['food_type'];
  }
  if($user_id!=0)
  $accepted_username=username_from_user_id($user_id);
  else
    $accepted_username="None"
?>
<p style="">&nbsp;Post Served By &nbsp;:&nbsp<a href="<?php echo "$accepted_username" ?>"style="color:#116573"><?php echo $accepted_username ?> </a></p>
<?php  
}

function notifications($data){
  global $con ,$session_user_id;
  if($data==="posted")
  $query="SELECT post_accepted,post_id,food_type,accept_time FROM post WHERE active=1";
  else if($data==="notifications")
  $query="SELECT post_accepted,post_id,food_type,accept_time FROM post WHERE user_id=$session_user_id "; 
  $res=mysqli_query($con,$query);
  while ($row = $res->fetch_assoc()) {
 $notification_data=array(
    'user_id' =>$row['post_accepted'],
    'post_id' =>$row['post_id'],
    'food_type' =>$row['food_type'],
    'accept_time'=>$row['accept_time'],
  );
    if($notification_data['user_id']!=0){
    $accepted_username=username_from_user_id($notification_data['user_id']);
    notification_display($notification_data,$accepted_username,$data);}
  }
  
$res->free();
}
function notification_display($notification_data,$accepted_username,$data){
  $user_id=$notification_data['user_id'];
  $post_id=$notification_data['post_id'];
  $food_type=$notification_data['food_type'];
  $accepted_username=$accepted_username;
  $data=$data;
  $accept_time=$notification_data['accept_time'];

  ?>

  <h4 style="background-color:#dae1e1;font-weight:400;"><ul style="list-style-type:none"><li>Post:&nbsp; <?php echo "$food_type"; ?></li>|<li><spam>Accepted By &nbsp;:&nbsp;</spam><a href="<?php echo "$accepted_username" ?>"style="color:#116573"><?php echo $accepted_username ?></a> <span style="float: right;"><?php echo $accept_time; ?></span></li></h4> <?php 
  

}
//post accepted
function post_accepted($post_id){
 global $con,$post_data,$session_user_id;
    date_default_timezone_set('Asia/Kolkata');
   $accept_time= date("Y-m-d H:i");
   $current_user=$session_user_id;
  $query="UPDATE post SET post_accepted='$current_user',accept_time='$accept_time' WHERE post_id='$post_id'";
  
  if ($con->query($query) === TRUE) 
  return true;
  else
  return false;

}
// to disable the post which is inactive
function post_disable($post_id){
  global $con,$post_data;
  $query="UPDATE post SET active=0 WHERE post_id='$post_id'";
  $res=mysqli_query($con,$query);
  
}
//to get all data from database post and store it in the post_data variable in init 
function update_post($post_id,$update_data){
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
  $query="UPDATE post SET $update WHERE post_id='$post_id'";
  if ($con->query($query) === TRUE) {
    return true;
  }
  else{
    return false;
  }

}
function post_accepted_id($post_id){
  global $con;
  $post_id      =(int)$post_id;
 
    $query="SELECT  post_accepted FROM post WHERE post_id='$post_id'";
    $res=mysqli_query($con,$query);
    //fetch one by one data from db
    while ($row = $res->fetch_assoc()) {
    $data=$row['post_accepted'];
  }
    return $data;

  }

function post_select_by_post_id($post_id){
  global $con;
  $data         =array();
  $post_id      =(int)$post_id;
 
    $query="SELECT  * FROM post WHERE post_id='$post_id'";
    $res=mysqli_query($con,$query);
    $data=mysqli_fetch_assoc($res);//fetch one by one data from db
    return $data;
  }

function post_select($user_id){
  global $con;
  $data         =array();
  $user_id      =(int)$user_id;
  $func_num_args=func_num_args();
  $func_get_args=func_get_args();

  if($func_get_args>1){
    unset($func_get_args[0]);//removing first session id 
    $fields='`'.implode('`, `',$func_get_args) .'`';//converting array to string
    $query="SELECT $fields FROM post WHERE user_id='$user_id'";
    $res=mysqli_query($con,$query);
    $data=mysqli_fetch_assoc($res);//fetch one by one data from db
    return $data;
  }
}
function   post_info($data,$user_id){
 global $con,$session_user_id;
	   if($data==='feeds')//for normal feed page
		   $query="SELECT * FROM post WHERE active=1";

	   else if($data==='profile')//for profile post
	   	 $query="SELECT * FROM post where user_id=$user_id";

		 else if($data==='admin')//to admin for viewing all post in db
       $query="SELECT * FROM post "; 

		 if($res=mysqli_query($con,$query)) {
    //store values in variable from post table
    while ($row = $res->fetch_assoc()) {
    	  $post_data=array(

        'user_id'=>$row['user_id'],
        'food_type' => $row["food_type"],
        'food_quantity' => $row["food_quantity"],
        'time_limit' => $row["time_limit"],
        'active' =>$row['active'],
        'description'=>$row['description'],
        'posting_time'=>$row['posting_time'],
        'post_id'=>$row['post_id'],
        'picture'=>$row['picture']

        );?>
        <table style="width:700px;height:200px;margin-left:30px ">
  <tr>
    <td valign="top" width="80%" >
     
       <?php   $username=username_from_user_id($post_data['user_id']);?>
       <?php $passing_to_post=post_box($post_data,$username);?>
        </td>
        
        <td valign="top" width="40%">
          <div style="padding: 10px">
           <a href="<?php echo $post_data['picture']; ?>"> <img src="<?php echo $post_data['picture']; ?>" width="100%" alt="<?php echo $post_data['food_type']." picture unavailable" ?>" ></a>
          </div>
      
    </td>
  </tr>
</table><br>
<?php 
    }

    //free result set 
    $res->free();
}

}
function post_box($post_data,$username){
 $user_id=$post_data['user_id'];
  $food_type=$post_data['food_type'];
  $food_quantity=$post_data['food_quantity'];
  $time_limit=$post_data['time_limit'];
  $active=$post_data['active'];
  $posting_time=$post_data['posting_time'];
  $description=$post_data['description'];
  $post_id=$post_data['post_id'];
	?>
	<div class="post_box">
    <?php 
        global $session_user_id;
        $post_notification=0; $delete=0;
        if(post_active($user_id,$posting_time,$time_limit)==true)
          $color="green";
        else 
          $color="red";
                   if(post_active($post_id,$posting_time,$time_limit)===true) $hidden="";else{ $hidden="hidden";$post_notification=1;$delete=1;}
                  if($user_id===$session_user_id&&$hidden==="")
                   $value="edit";
                 
                  else
                     $value="accept";

                 if($value==="edit")
                   $accept="edit_post.php?post_id= ".$post_id;
                  else
                     {
                      
                      $accept="feeds.php?post_id=".$post_id;


                      }
                      $disable="";
                  if(post_accepted_id($post_id)!=0&&$hidden!=="hidden"){
                  $value="served";
                  $bgcolor="orange";
                  $disable="disabled";
                  //post_notification($post_id);
                  $post_notification=1;
                  }
                  else{
                   $bgcolor="#1dbb1d";
                  }
               
                  
     ?>
           	<form action="<?php echo "$accept"; ?>" method="post">
           		<ul  style="list-style-type: none">
           			<li>
           				<h2><a href="<?php echo($username) ?>" style="color:#116573;"><?php echo($username) ?></a><span class='post_active' style="background-color:<?php echo "$color"; ?>;">&nbsp;&nbsp;</span></h2><small>posted on <?php echo "$posting_time"; ?></small>
           			</li>
           			<li >
           				<h4 style="color:#731d3d">Food Type:
           				<?php echo($food_type) ?>&nbsp;
           			
           				|Quantity:
           				<?php echo($food_quantity) ?>(kgs)&nbsp;
           			
           				|Time limit:
           				<?php echo($time_limit) ?>(hrs)</h4>
           			
           				<li><h4>Description:</h4><?php echo $description; ?></li>
           			</li><br>
           			<li>
           				
                  <input <?php echo $hidden;if( $disable==="disabled")echo $disable; ?> type="submit"  value="<?php echo $value ?>" style="background-color: <?php echo "$bgcolor" ?>;color: white;cursor: pointer ;border: 2px solid white;"> 
                  <?php
                  if($value!="edit"&&$session_user_id!="$user_id"){  
                  ?>
                  <span><a href="message.php?user_id=<?php echo $user_id; ?>"style="border: 2px solid white;background-color:#ddd;padding: 4.5px;color:#116573; ">message</a></span>

                <?php
              }
              if($delete===1&&post_active($user_id,$posting_time,$time_limit)==false||$value==="edit"){
                ?>
                <span><input type="submit" value="delete" name ="delete" style="border: 2px solid white;background-color:#ff1111;padding: 4.5px;margin: 3px;color:white;cursor:pointer;"></input></span>
                <?php  
              }
                if($post_notification==1) 
                  post_notification($post_id);
                ?>
                   
           			</li>
           			
           		</ul>
           	</form>
           </div>
           
	<?php 
}
//to check post is active or not
function post_active($post_id,$posted_time,$time_limit){

	  date_default_timezone_set('Asia/Kolkata');
    $current_time= strtotime(date("Y-m-d H:i"));
    $posted_time=strtotime($posted_time);
    $diff=abs($current_time-$posted_time)/(60*60);
    if($time_limit>=$diff){
      return true;
    }
    else{
      //if post is inactive then change state of post to inactive
      post_disable($post_id);
    return false;
    }
    
   
}
function post_data($post_data){
	global $con;
	foreach ($post_data as $key => $value) {
	$value=sanitize($con,$value);
		
	}
	$fields                       ='`'.implode('`, `',array_keys($post_data)).'`';
	$data                         ='\''.implode('\', \'',	 $post_data).'\'';
    $query                        ="INSERT INTO post ($fields) VALUES ($data)";
	//connect query and database
   
	if ($con->query($query) === TRUE) 
  return true;
  else
	return false;

}
?>
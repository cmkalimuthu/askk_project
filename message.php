<?php 
include 'core/init.php'; 
//checking whether data recieved in server
protect_page();
include 'includes/overall/overall_header.php';

global $session_user_id;
if(isset($_GET['success'])===true){
	?>
	<h2>message successfully sent !!</h2>
	<?php 
}
else{
if(isset($_GET['user_id'])===true){
$user_id=$_GET['user_id'];
$reciever=username_from_user_id($user_id); 

}

else if(empty(($_POST))===false){
	$message=$_POST['message_box'];
    $reciever=$_GET['reciever'];
	$sender=$session_user_id;
	$sender=username_from_user_id($sender);
	$messages=message($sender,$reciever,$message);
	if($messages===true)
	{
		
		 ?>
		<script>
        setTimeout(function()
        { 
             window.location = "message.php?success"; 
        }, 500);
        
        </script>
		<?php
          exit();
		
	}
	else{
		echo "some technical error";
	}

 }



?>
  <h1>Message here</h1>
            <form method="post" action="message.php?reciever=<?php echo($reciever); ?>">
            <textarea name="message_box"style="width: 250px;height: 150px;"></textarea>
           <input type="submit" name="send" value="send">
           </form>
            
<?php
}
include 'includes/overall/overall_footer.php';
 ?>
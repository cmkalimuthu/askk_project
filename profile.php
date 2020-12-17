
<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overall_header.php'; 
//checking  input is empty and it has username or not htaccess
if(isset($_GET['username'])===true&&empty($_GET['username'])===false){
	$username=$_GET['username'];
	//user exist
	if(user_exists($username)===true){
        $user_id=user_id_from_username($username);
	    //fetching details from database using users data function
	    $profile_data=users_data($user_id,'first_name','last_name','email_id','address','city','location','contact_no1','contact_no2','liscense_no','profile_pic');
?>
	
	    <div class="profile_pic">
    		<?php 
    		if(empty($profile_data['profile_pic'])===false){
    			?>
    			<a href="<?php echo $profile_data['profile_pic']; ?>">
    			<img src="<?php echo $profile_data['profile_pic']; ?>" alt="image unavilable" width="100%" height="100%"></a>
    			<?php if($session_user_id===$user_id){ ?>
    			<span style="float: right;"><a href="profile_pic.php?delete">Delete</a>&nbsp;&nbsp;<a href="profile_pic.php?change">Change</a></span>
    			<?php 
    		}
    		}
    	    else if($session_user_id===$user_id){
    			?>
    			<a href="profile_pic.php?upload">upload</a>
    			<?php 
    		}
    		else{
    			?>
    			<img src="unknown.jpg" alt="unknown" width="100%" height="100%"></a>
    			<?php }
    		?>
    
	    </div>
	
	<h1 style="color:#116573"><?php echo xss($profile_data['first_name']);?>'s profile</h1>
    <?php  
    if($session_user_id!==$user_id){
?>
     <span><a href="message.php?user_id=<?php echo $user_id; ?>"style="border: 2px solid white;background-color:#ddd;padding: 4.5px;color:#116573; ">message</a></span><?php } ?>

	<p><strong>Organisation Type:&nbsp;</strong><?php echo $profile_data['last_name'];?></p>
	<p><strong>Email Id:&nbsp;</strong><?php echo $profile_data['email_id'];?></p><hr>

	<h2 style="color:#116573">contact info</h2><hr>
	<div>
	<strong>Name:&nbsp;</strong><?php echo xss($profile_data['first_name']);?><br><br>
	<strong>Address:&nbsp;</strong><?php echo xss($profile_data['address']);?><br><br>
	<strong>City:&nbsp;</strong><?php echo xss($profile_data['city']);?><br><br>
    <strong>Location:&nbsp;</strong><a href="location.php?loc=<?php echo $profile_data['location']; ?>"target="_blank" style="border:1px solid black;color:#116573">Navigate</a><br><br>
	<strong>Contact No1:&nbsp;</strong><?php echo xss($profile_data['contact_no1']);?><br><br>
	<strong>Contact No2:&nbsp;</strong><?php echo xss($profile_data['contact_no2']);?><br><br>
	<strong>Organization LIC No:&nbsp;</strong><?php echo xss($profile_data['liscense_no']);?></div><hr>
    <h2 align="center">My Posts</h2>
	<?php
	$data='profile';
	post_info($data,$user_id);
    }
else{
	echo "sorry that user name not exists :(";
}
}
else{
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
?>

<?php include 'includes/overall/overall_footer.php'; ?>
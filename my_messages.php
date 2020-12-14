<?php 
include 'core/init.php'; 
//protect_page();//protect page from accessing from outside

//checking whether data recieved in server
protect_page();
global $session_user_id ;
$username=username_from_user_id($session_user_id);
include 'includes/overall/overall_header.php';
?>
          


            <!-- article starts here -->
            <h1>MY MESSAGES<span style="float: right;">
            <form method="GET" action="my_messages.php">	
            <select name="value" style="width: 110px;height: 30px">
            	<option value="sent">sent</option>
            	<option value="recieved" selected="selected">recieved</option>
            </select><input type="submit" name="" value="go"></form></span></h1><hr>
            
            <?php
            if(isset($_GET['value'])===true&&$_GET['value']==='sent')
	           my_messages($username,"sent");
            else
	           my_messages($username,"recieved"); 
             ?>

           
            <!-- article ends here -->
            
            

            <!-- article ends here -->
            
<?php
 
include 'includes/overall/overall_footer.php';
 ?>
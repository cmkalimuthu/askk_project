<?php 
include 'core/init.php'; 
//protect_page();//protect page from accessing from outside

//checking whether data recieved in server
protect_page();
global $session_user_id;


if(empty($_POST)===false){
  $required_fields=array('post_id','food_type','food_quantity','time_limit','active');
  foreach ($_POST as $key => $value) {
         if(empty($value)&& in_array($key,$required_fields)===true){
          $errors[]='fields marked with asterisk are required';
          break 1;
         }
       }
         
}
include 'includes/overall/overall_header.php';
?>
          <h1>New Posts</h1>
           <?php  
             if(isset($_GET['success'])&&empty($_GET['success'])){
              echo "you have been successfully posted your post";
             }
             else{
                if(empty($errors)===true&&empty($_POST)===false){
//registered     
                  date_default_timezone_set('Asia/Kolkata');
                  $posting_time= date("Y-m-d H:i");
              $post_data=array(
          'food_type'  =>$_POST['food_type'],
        'food_quantity'   =>$_POST['food_quantity'],
        'time_limit'    =>$_POST['time_limit'],
        'user_id'      =>$session_user_id,
        'posting_time' =>$posting_time,
        'description' =>$_POST['description']
        );
        $post_data=post_data($post_data);
        if($post_data===true){
          ?>
		<script>

setTimeout(function()
{ 
     window.location = "new_post.php?success"; 
}, 500);

</script>
		<?php
          exit();
        }
else{
  echo "some error has occured please give correct format";
  //redirect
}
}


else if (empty($errors)===false) {
  # code...
  echo output_errors($errors);
}
?>
           	<form method="post" action="new_post.php">
           		<ul  style="list-style-type: none">
           			<li>
           				food type:*<br>
           				<input type="text" name="food_type">
           			</li><br>
           			<li>
           				quantity:*<br>
           				<input type="text" name="food_quantity">
           			</li><br>
           			<li>
           				time limit:*<br>
           				<input type="text" name="time_limit">
           			</li><br>
                <li>
                  Description:*<br>
                  <textarea style="width: 300px;height: 100px" name="description"></textarea>
                </li><br>
           			<li>
           				
           				<input type="submit" value="post">
           			</li>
           		</ul>
           	</form>
           
 


<?php
}
include 'includes/overall/overall_footer.php';
 ?>
<?php 
include 'core/init.php'; 
protect_page();
global $session_user_id;
if(empty($_POST)===false){
  $required_fields=array('post_id','food_type','food_quantity','time_limit','active','post_img');
  foreach ($_POST as $key => $value) {
         if(empty($value)&& in_array($key,$required_fields)===true){
          $errors[]='fields marked with asterisk are required';
          break 1;
         }
    }
    if(isset($_FILES['post_img'])===true)
        {
              if(empty($_FILES['post_img']['name'])===true)
                $errors[]="choose a file";
              else
              {
                $allowed=array('jpeg','jpg','gif','png');
                $file_name=$_FILES['post_img']['name'];
                $file_ext=(explode('.', $file_name));
                $file_ext=end($file_ext);
                $file_ext=strtolower($file_ext);
                $file_temp=$_FILES['post_img']['tmp_name'];
                if(in_array($file_ext, $allowed)===true)
                {
                  $file_path='images/post/'.substr(md5(time()),0, 10).'.'.$file_ext;
                       move_uploaded_file($file_temp, $file_path);

                }
                else{
                  $errors[]="incorrect file type ";
                  $errors[]= " format should be ".implode('.', $allowed);
                }

              }
        }
    else
          $errors[] ='file not selected';
       

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
                    'food_value'  =>$_POST['food_value'],
                    'food_quantity'   =>$_POST['food_quantity'],
                    'quantity_value'  =>$_POST['quantity_value'],
                    'time_limit'    =>$_POST['time_limit'],
                    'user_id'      =>$session_user_id,
                    'posting_time' =>$posting_time,
                    'description' =>$_POST['description'],
                    'picture' =>$file_path
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
            <form method="post" action="" enctype="multipart/form-data">
              <ul  style="list-style-type: none">
                <li>
                  food type:*<br>
                  <input type="text" name="food_type" placeholder="ex.dinner/breakfast">
                  <select name="food_value">

                    <option value="veg" selected="selected">veg</option>
                    <option value="non-veg">non-veg</option>

                  </select>
                </li><br>
                <li>
                  quantity:*<br>
                  <input type="number" name="food_quantity" placeholder="kgs/persons">
                  <select name="quantity_value">

                    <option value="kgs" selected="selected">kgs</option>
                    <option value="persons">persons</option>

                  </select>
                </li><br>
                <li>
                  time limit:*<br>
                  <input type="number" name="time_limit" placeholder="hours" min="1" max="12">
                </li><br>
                    <li>
                      Description:*<br>
                      <textarea style="width: 300px;height: 100px" name="description"></textarea>
                    </li><br>
                    <li>
                      Picture:*<input type="file" name="post_img">
                    </li>
                <li>
                  <input type="submit" value="post">
                </li>
              </ul>
            </form>

<?php
}
include 'includes/overall/overall_footer.php';
?>
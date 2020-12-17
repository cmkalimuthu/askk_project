<?php 
include 'core/init.php'; 
//protect_page();//protect page from accessing from outside
protect_page();
include 'includes/overall/overall_header.php';
//checking whether data recieved in server
if(isset($_GET['success'])===false){
$post_id= $_GET['post_id'];
$selected_data=post_select_by_post_id($post_id);
}

if(empty($_POST)===false){
  $required_fields=array('food_type','food_quantity','time_limit','description','post_img');
  foreach ($_POST as $key => $value) {
         if(empty($value)&& in_array($key,$required_fields)===true){
          $errors[]='fields marked with asterisk are required';
          break 1;
         }
    }
    //checking for any files uploaded in input
  if(isset($_FILES['post_img'])===true)
    {
        if(empty($_FILES['post_img']['name'])===true){
            $errors[]="choose a file";

        }
        else
        { 
            //format check,extension,lowercase,then location path
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

if(isset($_GET['success'])&&empty($_GET['success'])){
    echo "you have been successfully updated your post";
}
else{
    if(empty($errors)===true&&empty($_POST)===false){
     //registered    

    $post_data=array(
        'food_type'  =>$_POST['food_type'],
        'food_value' =>$_POST['food_value'],
        'food_quantity'   =>$_POST['food_quantity'],
        'quantity_value' =>$_POST['quantity_value'],
        'time_limit'    =>$_POST['time_limit'],
        'description' =>$_POST['description'],
        'picture' =>$file_path
        );
    $post_update=update_post($post_id,$post_data);
        if($post_update===true){
        ?>
          <script>
                setTimeout(function()
                { 
                     window.location = "edit_post.php?success"; 
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
    <h1>Edit post</h1>
    <form  action="" method="post" enctype="multipart/form-data">
              <ul  style="list-style-type: none">
                <li>
                  food type:*<br>
                  <input type="text" name="food_type" placeholder="ex.dinner/breakfast" value="<?php echo $selected_data['food_type'] ?>">
                  <input type="text" name="food_value" value="<?php echo $selected_data['food_value']; ?>"disabled="disabled">
                  <select name="food_value">
                    <option value="<?php echo $selected_data['food_value']; ?>" selected="selected">default
                    <option value="veg" >veg</option>
                    <option value="non-veg">non-veg</option>

                  </select>
                </li><br>
                <li>
                  
                  quantity:*<br>
                  <input type="number" name="food_quantity" placeholder="kgs/persons"value="<?php echo $selected_data['food_quantity'] ?>">
                  <input type="text" name="quantity_value" value="<?php echo $selected_data['quantity_value']; ?>"disabled="disabled">

                  <select name="quantity_value">
                    <option value="<?php echo $selected_data['quantity_value']; ?>" selected="selected">default</option>
                    <option value="kgs" >kgs</option>
                    <option value="persons">persons</option>

                  </select>
                </li><br>
                <li>
                  time limit:*<br>
                  <input type="number" name="time_limit"value="<?php echo $selected_data['time_limit']; ?>"min="1" max="12">
                </li><br>
                <li>
                  Description:*<br>
                  <textarea style="width: 300px;height: 100px" name="description"><?php echo $selected_data['description'];?></textarea>
                </li><br>
                <li>
                  <div style="padding: 10px">
                    <img src="<?php echo $selected_data['picture']; ?>" width="10%" alt="<?php echo $selected_data['food_type']." picture unavailable" ?>" >
                  </div>
                  Picture:*<input type="file" name="post_img">
                </li>
                <li>
                  <input type="submit" value="update">
                </li>
              </ul>
    </form>
            
<?php
}
include 'includes/overall/overall_footer.php';
 ?>
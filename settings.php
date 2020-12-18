<?php 
include 'core/init.php'; 
protect_page();
include 'includes/overall/overall_header.php';
//checking not empty 
if(empty($_POST)===false){
    $required_fields=array('first_name','email_id','address','city','contact_no1','contact_no2','liscense_no');
    foreach ($_POST as $key => $value) {
         if(empty($value)&& in_array($key,$required_fields)===true){
            $errors[]='fields marked with asterisk are required';
            break 1;
        }
       
    }
    if( preg_match('/^[0-9]{10}+$/', $_POST['contact_no1'])==false)
            $errors[]='enter a valid phone number in contact_no1';
        if( preg_match('/^[0-9]{10}+$/', $_POST['contact_no2'])==false)
            $errors[]='enter a valid phone number in contact_no2';
    //validate email
        if(empty($errors)===true){
            if(filter_var($_POST['email_id'],FILTER_VALIDATE_EMAIL)===false){
            $errors[]='enter a valid email id ';
            }
        //email exists and check new email is exist
            else if (email_exists($_POST['email_id'])===true && $user_data['email_id']!==$_POST['email_id']) {
                $errors[]=' sorry, the email id \''.$_POST['email_id'].'\' already exist choose another';
                
            }
        }

}
?>
 <h1>   SETTINGS</h1>
<?php 
 if(isset($_GET['success'])&&empty($_GET['success'])){
                echo "you have been updated successfully";
 }
 else{
    if(empty($_POST)===false&&empty($errors)===true){
    //update the details in db
    $allow_email=($_POST['allow_email']=='on')?1:0;
    $update_data=array(
                'first_name'    =>$_POST['first_name'],
                'last_name'     =>$_POST['last_name'],
                'email_id'      =>$_POST['email_id'],
                'allow_email'   =>$allow_email,
                'address'       =>$_POST['address'],
                'city'          =>$_POST['city'],
                'location'      =>$_POST['location'],
                'contact_no1'   =>$_POST['contact_no1'],
                'contact_no2'   =>$_POST['contact_no2'],
                'liscense_no'   =>$_POST['liscense_no']
            );
    $settings_update=settings_update($session_user_id,$update_data);
        if($settings_update===true){
         ?>
            <script>
    
            setTimeout(function()
            { 
                 window.location = "settings.php?success"; 
            }, 500);
            
            </script>
                    <?php
                      exit();
        }


    }
      else if(empty($errors)===false){
      echo output_errors($errors);
      }
?>
<form action="" method="post">
    
    <ul style="list-style-type: none">
        <li>
            First Name*:<br>
            <input type="text" name="first_name" value="<?php echo $user_data['first_name']; ?>">
        </li><br>
        <li>
            Organisation Type default:<br>
            <input type="text" name="last_name" value="<?php echo $user_data['last_name']; ?>"disabled="disabled">
             <li>
                        choose another:<br>
                        <select name="last_name"style="width: 150px;height: 30px">
                  <option value="<?php echo $user_data['last_name']; ?>" selected="selected">default</option>
                  <option value="orphanage">orphanage</option>
                  <option value="old age home">old age home</option> 
                  <option value="community hall">community hall</option>
                  <option value="catering service">catering service</option>
                  <option value="others">others</option>

                     </select>
            </li>
        </li>
        <br>
        <li>
            Email Id*:<br>
            <input type="text" name="email_id" value="<?php echo $user_data['email_id']; ?>">
        </li>
        <li>
            <input type="checkbox" name="allow_email"<?php if($user_data['allow_email']==1){echo 'checked="checked"';} ?>>would you like to recieve email's from us.
        </li><br>
        <li>
            Address*:<br>
            <textarea name="address" ><?php echo $user_data['address']; ?></textarea>
        </li><br>
        <li>
            city*:<br>
            <input type="text" name="city" value="<?php echo $user_data['city']; ?>">
        </li><br>
        <li>
            Location*:<br>
            <input type="text" name="location" value="<?php echo $user_data['location']; ?>">
        </li><br>
        <li>
            Contact No1*:<br>
            <input type="text" name="contact_no1" value="<?php echo $user_data['contact_no1']; ?>">
        </li><br>
         <li>
            Contact No2*:<br>
            <input type="text" name="contact_no2" value="<?php echo $user_data['contact_no2']; ?>">
        </li><br>
         <li>
            Organization Liscense*:<br>
            <input type="text" name="liscense_no" value="<?php echo $user_data['liscense_no']; ?>">
        </li><br>
        <li>
            <a href="change_password.php"> change password</a>
        </li><br>

        <li>
            <input type="submit" value="update">
        </li><br>

    </ul>
</form>
 
            
<?php
}
include 'includes/overall/overall_footer.php';
 ?>
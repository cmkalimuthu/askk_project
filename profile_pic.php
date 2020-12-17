<?php 
include 'core/init.php'; 

protect_page();
include 'includes/overall/overall_header.php';

if(isset($_GET['change'])===true||isset($_GET['upload'])===true){
            if(isset($_FILES['post_img'])===true)
             {
              if(empty($_FILES['post_img']['name'])===true)
                echo "please choose a file"; 
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
                    $profile_upload=profile_upload($file_ext,$file_temp,$session_user_id);
                        if($profile_upload===true){
                          echo "success";
                        }
                  }
                    else{
                    echo "incorrect file type ";
                    echo " format should be ".implode('.', $allowed);
                  }

              }
             }
            else
                echo '<h1 style="font-weight:100">'. 'change profile picture !!'.'</h1>';
       
             ?>

                  <div style="width: 500px;width: 500px;margin:0 auto;padding:20px">
                    <img src="<?php echo $user_data['profile_pic']; ?>"width="100%" height="100%">
                    <form method="post" action="" enctype="multipart/form-data">
             
                      <input type="file" name="post_img">
                      <input type="submit" value="change">
                  </form>
                 </div>
              

             <?php 
    
}
            if(isset($_GET['delete'])===true){
              $delete_profile=delete_profile($session_user_id);
              if($delete_profile===true)
                echo '<h1 style="font-weight:100">'. 'profile picture deleted successfully !!'.'</h1>';
              else
                echo '<h1 style="font-weight:100">'. 'deletetion unsuccessfully !!'.'</h1>';
                ?>
            <script>

                setTimeout(function()
                { 
                     window.location = "profile.php?success"; 
                }, 500);

                </script>
            <?php
                    exit();
            }
                ?>

        
            
<?php

include 'includes/overall/overall_footer.php';
 ?>
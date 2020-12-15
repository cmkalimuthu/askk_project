            <?php 
            include 'core/init.php';
            include 'includes/overall/overall_header.php';
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
                       $file_path='images/post'.substr(md5(time()),0, 10).'.'.$file_ext;
                       echo "$file_path";
                       move_uploaded_file($file_temp, $file_path);
             		}
             		else{
             			echo "incorrect file type ";
             			echo " format should be ".implode('.', $allowed);
             		}

             	}
             }
         else
         	echo 'hello';
             ?>




            <ul>
            	<form method="post" action="" enctype="multipart/form-data">
 				<li>
                  Picture:*<input type="file" name="post_img">
                </li>
           		<li>
           				<input type="submit" value="post">
           		</li>
           	</ul>
           		</form>

           	<?php 
			include 'includes/overall/overall_footer.php';
           	 ?>
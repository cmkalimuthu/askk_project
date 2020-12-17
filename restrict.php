<?php 
include 'core/init.php'; 
admin_protect();
protect_page();
include 'includes/overall/overall_header.php';
?>
         <h1>RESTRICT USERS</h1>
            
            <?php  
                all_users();
          
             ?> 
            
<?php
 
include 'includes/overall/overall_footer.php';
 ?>
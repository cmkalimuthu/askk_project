
<?php 
include 'core/init.php'; 
include 'includes/overall/overall_header.php'; 
admin_protect();

?>

            <!-- article starts here -->
            <h1>RESTRICT USERS</h1>
            
            <?php  
                
              $all_users=all_users();
              
             
              
               print_r($all_users);
          
               ?> 
                
 				
            
            
<?php include 'includes/overall/overall_footer.php'; ?>
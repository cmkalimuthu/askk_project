<?php 
include 'core/init.php'; 
protect_page();
include 'includes/overall/overall_header.php'; 


?>

            <!-- article starts here -->
            <h1>NOTIFICATIONS</h1><hr>
            <div style="margin:40px;">
            <?php 
            $data="notifications";
            notifications($data);
             ?>
            </div>
            <!-- article ends here -->
            
            
<?php include 'includes/overall/overall_footer.php'; ?>
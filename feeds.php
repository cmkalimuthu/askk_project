<?php 
//feeds
include 'core/init.php';
protect_page();
include 'includes/overall/overall_header.php';
?>

            <!-- article starts here -->
            
            <h1 style="text-align: center;">Feeds</h1><hr>
            <?php
            $feeds='feeds';
            $admin='admin';
            if(is_admin($user_data['user_id'])===true)
            $post_data=post_info($admin,$session_user_id);
            else  
              $post_data=post_info($feeds,$session_user_id);
              if(isset($_GET['post_id'])===true)
                post_accepted($_GET['post_id']);
      ?>
              
            <!-- article ends here -->
            
<?php
include 'includes/overall/overall_footer.php'; 
?>

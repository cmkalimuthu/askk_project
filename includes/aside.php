 
 <aside > 
          <?php 
          global $session_user_id;
          if(logged_in()===true){//check user logged shows controls
          	if(is_admin($session_user_id)===true)
          	include 'includes/widgets/admin_control.php';
          	else
            include 'includes/widgets/loggedin.php';
          }
          else{//shows login form
            
            include 'includes/widgets/login_form.php';
          }//shows user count 
          include 'includes/widgets/user_count.php';
          ?>
</aside>
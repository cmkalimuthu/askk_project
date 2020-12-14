<?php  
global $flag; 
if($flag===0||logged_in()===false){
	?>
  <style type="text/css">
    .navlink:hover{
      background-color: #aaa;

    }
    
  </style>
	<nav >
      <a href="index.php" class="navlink">
      Home</a>&nbsp;&nbsp;
      <a href="blog.php" class="navlink">
      Read blog</a>&nbsp;&nbsp;
      <a href="about.php" class="navlink">
      About</a>&nbsp;&nbsp;
       <a href="contact.php" class="navlink">
      Contact</a>&nbsp;&nbsp;
</nav>
<?php 
}
 
else{//display user nav when user logged in
include 'includes/widgets/user_nav.php';

}
?>
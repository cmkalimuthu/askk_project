<?php 
$loc=$_GET['loc'];
$loc="https://www.google.com/maps?q=".$loc;
header('Location:'.$loc);
 ?>
<?php
//the subject
$sub = "test from xampp";
//the message
$msg = "for project purpose";
//recipient email here
$rec = "cmkalimuthukalee@gmail.com";
//send email
$mail=mail($rec,$sub,$msg);

if($mail){
	echo "sent";
}
else{
	echo "not sent";
}


 ?>
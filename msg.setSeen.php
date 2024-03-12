<?php
    require "config.php";
  ob_start();
	session_start();
  

    $sql = "UPDATE msg SET seen='1' WHERE roomId=".$_GET['room'];

    $res  = $con->query($sql);
$i=0;
   
    
   if($res){ 
echo "{\"res\" : \"$i\"}"; }
else{ 
echo "{\"res\" : \"error\"}"; }
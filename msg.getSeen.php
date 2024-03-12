<?php
    require "config.php";
  ob_start();
	session_start();
    //create array
    $myArray = array();

    $sql = "SELECT DISTINCT roomId FROM msg INNER JOIN users ON msg.sentBy=users.customer_id WHERE users.Type='Customer' AND seen='0'";

    $res  = $con->query($sql);
$i=0;
    while($row = $res->fetch_assoc()) {
        
       $i++;
    }
    
   if($res){ 
echo "{\"res\" : \"$i\"}"; }
else{ 
echo "{\"res\" : \"error\"}"; }
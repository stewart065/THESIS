<?php

    require "config.php";

ob_start();
	session_start();


    $sql = "SELECT* FROM rooms WHERE sentBy=".$_SESSION['Id']." ORDER BY roomId DESC LIMIT 1";



    $res  = $con->query($sql);
$total=0;
$row = $res->fetch_assoc();

$total++;



    if($res){
       if($row!=NULL){
	        echo "{\"res\" :". $row['roomId']."}";

}else{

echo "{\"res\" : \"error\"}";

}

    }else{
        echo "{\"res\" : \"error\"}";
    }
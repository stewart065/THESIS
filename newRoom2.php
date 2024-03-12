<?php

    require "config.php";

ob_start();
	session_start();


    

$sql = "INSERT INTO joined(roomId, customer_id) VALUES(".$_SESSION['Nroom'].", ".$_GET['user2'].")";

$res  = $con->query($sql);

    if($res){
        
	
	        echo "{\"res\" :"."hh"."}";
	
    }else{
        echo "{\"res\" : \"error\"}";
    }
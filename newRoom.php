<?php

    require "config.php";

ob_start();
	session_start();


    $sql = "INSERT INTO rooms(roomId, sentBy) VALUES(NULL,".$_SESSION['Id'].")";



    $res  = $con->query($sql);


$sql = "SELECT* FROM rooms ORDER BY roomId DESC LIMIT 1";



    $res  = $con->query($sql);

$row = $res->fetch_assoc();
$_SESSION['Nroom']=$row['roomId'];

$sql = "INSERT INTO joined(roomId, UserId) VALUES(".$row['roomId'].", ".$_SESSION['Id'].")";

$res  = $con->query($sql);

    if($res){
        
	
	        echo "{\"res\" :"."hh"."}";
	
    }else{
        echo "{\"res\" : \"error\"}";
    }
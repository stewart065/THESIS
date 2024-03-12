<?php

    require "config.php";

ob_start();
	session_start();

$Date=date('Y-m-d H:i:s');

$_GET['mes']=$con->real_escape_string($_GET['mes']);
    $sql = "INSERT INTO msg (mes, sentBy, roomId, sentDate) VALUES('".$_GET['mes']."', ".$_SESSION['Id'].", ".$_GET['room'].", '".$Date."')";



    $res  = $con->query($sql);

    if($res){
        echo "{\"res\" : \"success\"}";
    }else{
        echo "{\"res\" : \"error\"}";
    }
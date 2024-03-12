<?php
    require "config.php";
  ob_start();
	session_start();
    //create array

    $sql = "UPDATE Info SET typingAt=".$_GET['type']." WHERE Id=".$_SESSION['Id'];
    $res  = $con->query($sql);

     if($res){
        echo "{\"res\" : \"success\"}";
    }else{
        echo "{\"res\" : \"error\"}";
    }
<?php

    require "config.php";

ob_start();
	session_start();


    if(isset($_SESSION['Id'])){
        echo "{\"res\" :".$_SESSION['Id']."}";
    }else{
        echo "{\"res\" : \"error\"}";
    }
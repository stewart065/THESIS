<?php
    session_start();
    require 'config.php';

          //user type
       if(isset($_REQUEST['id'])){
        $utid=$_REQUEST['id'];
        $sql = "DELETE FROM users WHERE customer_id ='$utid'";
        $query= $con->query($sql)or die($con->error);
       }
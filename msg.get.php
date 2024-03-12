<?php
    require "config.php";
  ob_start();
	session_start();
    //create array
    $myArray = array();

    $sql = "Select * FROM Info Where Id=".$_SESSION['Id'];
$sql2= "SELECT joined.*, users.* FROM joined INNER JOIN users ON joined.customer_id=users.Id WHERE joined.customer_id!=".$_SESSION['Id']." AND joined.roomId=".$_GET['room'];

    $res  = $con->query($sql2);

    while($row = $res->fetch_assoc()) {
        $myArray[] = $row;
if($row['typingAt']==$_GET['room']){
break;
}
    }
    
    echo json_encode($myArray);
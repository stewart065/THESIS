<?php
    require "config.php";
  ob_start();
	session_start();
    
    $myArray = array();
    




$sql2 = "Select msg.*, users.firstname, users.lastname FROM msg INNER JOIN users ON msg.sentBy=users.customer_id Where msg.roomId=".$_GET['room']." ORDER BY msg.Id";


 $res  = $con->query($sql2);

    while($row = $res->fetch_assoc()) {
        $myArray[] = $row;
       
       // $_SESSION['init']=$row['Id'];
 
    }
    
    echo json_encode($myArray);

?><?php
    require "config.php";
  ob_start();
	session_start();
    
    $myArray = array();
    




$sql2 = "Select msg.*, users.firstname, users.lastname FROM msg INNER JOIN users ON msg.sentBy=users.customer_id Where msg.roomId=".$_GET['room']." ORDER BY msg.Id";


 $res  = $con->query($sql2);

    while($row = $res->fetch_assoc()) {
        $myArray[] = $row;
       
       // $_SESSION['init']=$row['Id'];
 
    }
    
    echo json_encode($myArray);

?><?php
    require "config.php";
  ob_start();
	session_start();
    
    $myArray = array();
    




$sql2 = "Select msg.*, users.firstname, users.lastname FROM msg INNER JOIN users ON msg.sentBy=users.customer_id Where msg.roomId=".$_GET['room']." ORDER BY msg.Id";


 $res  = $con->query($sql2);

    while($row = $res->fetch_assoc()) {
        $myArray[] = $row;
       
       // $_SESSION['init']=$row['Id'];
 
    }
    
    echo json_encode($myArray);

?>
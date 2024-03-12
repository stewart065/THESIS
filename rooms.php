<?php
    require "config.php";
   ob_start();
	session_start();
    //create array
    $myArray = array();

    $sql ="SELECT DISTINCT roomId, MAX(sentDate) FROM msg GROUP BY roomId ORDER BY MAX(sentDate) DESC, roomId";
    $res  = $con->query($sql);

   while($row = $res->fetch_assoc()) {
	
	$sql2= "SELECT joined.*, users.* FROM joined INNER JOIN users ON joined.UserId=users.customer_id WHERE users.Type='Customer' AND joined.roomId=".$row['roomId'];
    $res2  = $con->query($sql2);

while($row2 = $res2->fetch_assoc()) {


$sql3 = "Select * FROM msg INNER JOIN users ON msg.sentBy=users.customer_id WHERE users.Type='Customer' AND msg.seen='0' AND roomId=".$row['roomId'].""; 
$res3 = $con->query($sql3); 
$i=0; 
while($row3 = $res3->fetch_assoc()){ 
$i++;
}
    $row2['seen']=$i;
        $myArray[] = $row2;

             }
    }
    
    echo json_encode($myArray);
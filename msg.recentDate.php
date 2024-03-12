<?php
    require "config.php";
  ob_start();
	session_start();
    //create array
    $myArray = array();
$user=$_SESSION['Id'];
$Date=date('Y-m-d');

$room=0;


$s="SELECT * FROM rooms WHERE sentBy=".$_SESSION['Id'];

$res  = $con->query($s);

while($row = $res->fetch_assoc()){

$room=$row['roomId'];
}

    $sql = "SELECT * FROM msg WHERE roomId=$room ORDER BY sentDate DESC LIMIT 1";

    $res  = $con->query($sql);
$lastDate;
$ii=0;

    while($row = $res->fetch_assoc()) {
      	$lastDate=$row['sentDate'];  
       $ii++;
    }

$l;
if($ii>0){
$l=new DateTime($lastDate);
 }   




if($ii==0){
$Date=date('Y-m-d H:i:s');



$sql = "INSERT INTO msg(mes, sentBy, roomId, sentDate) VALUES('Good day Ka-Wheeltek! what is your concern?', 28, ".$room.", '".$Date."')";


$res  = $con->query($sql);





echo "{\"res\" : \"Yes\"}";

}else{





   if($Date>$l->format('Y-m-d')){ 
$Date=date('Y-m-d H:i:s');



$sql = "INSERT INTO msg(mes, sentBy, roomId, sentDate) VALUES('Good day Ka-Wheeltek! what is your concern?', 28, ".$room.", '".$Date."')";


$res  = $con->query($sql);





echo "{\"res\" : \"Yes\"}"; }
else{ 
echo "{\"res\" : \"error\"}"; }
}
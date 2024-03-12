<?php

require "config.php";

$id = $_POST['cid'];


$sql = "UPDATE `repair_reservation` SET `status`='Finished' WHERE id = '$id';";


$result = mysqli_query($con,$sql);


if($result){

    echo 0;

}
else{
 echo 1;
}


?>
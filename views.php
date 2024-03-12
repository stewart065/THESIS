<?php
session_start();
include 'config.php';

$prod = $_GET['vid'];

$sql="SELECT product_id, concat(firstname,'',lastname) as custname, rated_points, comment 
FROM rated_product         
INNER JOIN users ON users.customer_id = rated_product.customer_id 
where rated_product.product_id='$prod' AND rate_status='rated'";

$query = mysqli_query($con,$sql);

$array = array();


while($row = mysqli_fetch_assoc($query)){

    $array [] = $row;

}

echo json_encode($array);

?>





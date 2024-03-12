<?php
session_start();
include 'config.php';


$cusid = $_GET['cid'];

$sql="SELECT DISTINCT pickid, product_name, pickup.quantity, price,(price * pickup.quantity) as total, pickup.status, CONCAT(firstname,' ',middlename,' ',lastname) AS custname, users.customer_id as custid, proof,
(
 CASE
 WHEN payments.status = 'pending' THEN 'NOT PAID'
ELSE 'PAID'
END
) as pstat

from pickup 


INNER JOIN product ON product.product_id = pickup.pid  
LEFT JOIN payments ON payments.cus_id = pickup.cus_id  
INNER JOIN users ON users.customer_id = pickup.cus_id  


where pickup.cus_id= '$cusid' GROUP BY pickid;";

$query = mysqli_query($con,$sql);

$array = array();


while($row = mysqli_fetch_assoc($query)){

    $array [] = $row;

}

echo json_encode($array);

?>





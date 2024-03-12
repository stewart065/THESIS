<?php
include 'config.php';
 //--------- DELETE ADMIN ---------->
 if(isset($_POST['delete_cart']))
 {
         $cartid =  $_POST['prod_cart_id'];

 
         $query = "DELETE FROM productcart WHERE id = '$cartid'";

         $query_run = mysqli_query($con, $query);
 
     if($query_run)
     {
         echo 0;
     }
     else
     {
        echo 1;
     }
 }
    ?>

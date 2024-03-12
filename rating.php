<?php
session_start();
include "config.php";


if(isset($_POST['submit']) && isset($_POST['rating']) && isset($_POST['review_comment'])  ){

$points = $_POST['rating'];
$buyid = $_POST['userid'];
$pid = $_POST['prodid'];

$comment = $_POST['review_comment'];


$file_name = $_FILES['review_files']['name'] ;

$new_file_name = str_replace(" ","", $file_name);

 $file_size =$_FILES['review_files']['size'];
 $file_tmp =$_FILES['review_files']['tmp_name'];
$file_type=$_FILES['review_files']['type'];  



// $sqlcheck = "SELECT * FROM rated_product WHERE customer_id = '$buyid' AND product_id = '$pid'";
// $result = $con->query($sqlcheck);
// if($result == NULL)
// {
//      }
//  else{
$sql = "UPDATE rated_product SET rated_points = '$points', rate_status = 'rated', rated_product.comment = '$comment', rated_product.media='$new_file_name' WHERE rated_id = '$pid' ";
// }
// else
// {
// $sql = "INSERT INTO rated_product (customer_id, product_id, rated_points, rate_status) VALUES ('$buyid', '$pid', '$points', 'RATED')";
// }


$query = mysqli_query($con,$sql);

if($query){

    move_uploaded_file($file_tmp,"comment_media/".$new_file_name);
    header("location: Home_rate.php");


}else{

 echo die(mysqli_error($con));

}




}





?>

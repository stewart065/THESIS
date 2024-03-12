<?php
session_start();
include 'config.php';


$cus_id = $_SESSION['Id'];

$method = $_POST['payment_method'];


$sqlone = "SELECT * FROM payments WHERE cus_id = '$cus_id'";
$res1 = mysqli_query($con, $sqlone);


if (mysqli_num_rows($res1) > 0) {

    $sql = "SELECT * FROM payments WHERE cus_id = '$cus_id' AND type = '$method';";

    $res = mysqli_query($con, $sql);

    if (mysqli_num_rows($res) > 0) {

        options();

    } else {

        echo 1;

    }
} else {
    options();
}

function options()
{
    include 'config.php';
    $cus_id = $_SESSION['Id'];

    $method = $_POST['payment_method'];


    if ($method == 'online') {
        $amount = $_POST['payment_amount'];

        $file_tmp = $_FILES['file']['tmp_name'];
        $filename = $_FILES['file']['name'];

        $newfilename = str_replace(" ", "", $filename);


        $query = "INSERT INTO `payments` (`cus_id`, `total`, `proof`, `status`, `type`) 
    VALUES ('$cus_id','$amount','$newfilename','paid','online')";

        $result = mysqli_query($con, $query);




        if ($result) {
            move_uploaded_file($file_tmp, "C:/xampp/htdocs/transmaster/proof/" . $newfilename);

            $datas = json_decode($_POST['cids']);


            foreach ($datas as $data) {
                $query1 = "INSERT INTO pickup (pid, quantity, cus_id)
            SELECT pid, qty, customerid
            FROM productcart
            WHERE productcart.id = '$data';";

                $result1 = mysqli_query($con, $query1);
            }

            for ($i = 0; $i < sizeof($datas); $i++) {


                $delete = "DELETE FROM productcart WHERE id = '$datas[$i]'";

                $result2 = mysqli_query($con, $delete);
            }


            echo 0;
        } else {
            echo 1;
        }


    } else if ($method == 'counter') {
        $amount = $_POST['payment_amount'];

        $query = "INSERT INTO `payments` (`cus_id`, `total`, `status`, `type`) 
    VALUES ('$cus_id','$amount','pending','counter')";

        $result = mysqli_query($con, $query);

        if ($result) {

            $datas = json_decode($_POST['cids']);

            foreach ($datas as $data) {
                $query1 = "INSERT INTO pickup (pid, quantity, cus_id)
            SELECT pid, qty, customerid
            FROM productcart
            WHERE productcart.id = '$data';";

                $result1 = mysqli_query($con, $query1);
            }


            for ($i = 0; $i < sizeof($datas); $i++) {


                $delete = "DELETE FROM productcart WHERE id = '$datas[$i]'";

                $result2 = mysqli_query($con, $delete);
            }




            echo 0;
        } else {
            echo 1;
        }
    } 
    
    else {

        $customerid = $_POST['cid'];


        $query = "UPDATE
    `product`
    INNER JOIN pickup ON pickup.pid = product.product_id
  SET
    product.quantity = (product.quantity - pickup.quantity), sold = product.sold + pickup.quantity

  WHERE
    pickup.status = 'pickup'
    AND pickup.cus_id = '$customerid';";



        $setsold = "INSERT INTO sold_items (pid, qty, total)
    SELECT pid, pickup.quantity, (product.price * pickup.quantity) as total
    FROM pickup
    INNER JOIN product ON product.product_id = pickup.pid
    WHERE pickup.cus_id = '$customerid' AND pickup.status = 'pickup';";

        $delete_pickup = "DELETE FROM pickup WHERE cus_id = '$customerid' AND status = 'pickup';";

        $delete_payment = "DELETE FROM payments WHERE cus_id = '$customerid';";




            $newprod = "SELECT pid FROM pickup where cus_id = '$customerid'";

            $newprodall = mysqli_query($con, $newprod);

                while ($rowse = mysqli_fetch_array($newprodall)) {

                    $newToRate[] = $rowse['pid'];

                }




        $result2 = mysqli_query($con, $setsold);

        $result = mysqli_query($con, $query);
        $insert_toRate;

        for ($k = 0; $k < count($newToRate); $k++) {

            $checkrated = "SELECT product_id, customer_id
                FROM rated_product
                WHERE customer_id = '$customerid' AND product_id = '$newToRate[$k]';";
                
            $resultrated = mysqli_query($con, $checkrated);
            if (mysqli_num_rows($resultrated) == 0) {
                $insert_toRate = "INSERT INTO `rated_product`(`product_id`, `customer_id`) values ('$newToRate[$k]', '$customerid');";
                $result3 = mysqli_query($con, $insert_toRate);

            }
        }

        $result4 = mysqli_query($con, $delete_pickup);
        $result5 = mysqli_query($con, $delete_payment);

        echo 0;

    }

}
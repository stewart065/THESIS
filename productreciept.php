<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="header">
    <h4>TRANSMASTER ENTERPRISES AND SERVICES</h4>
    <P>Dakit, Bogo City, Cebu</P>
    </div>
    <hr>
    <div class="body">
        <div class="table">
            <table>
                <thead>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Amount</th>
                </thead>
                <tbody>


                <?php

        include 'config.php';

        $total_arr = array();

        $id = $_GET['id'];
        $name;

        $sql = "SELECT DISTINCT pickid, product_name, pickup.quantity,price, (price * pickup.quantity) as total, pickup.status, CONCAT(firstname,' ',middlename,' ',lastname) AS custname, users.customer_id as custid, proof,
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
        
        
        where pickup.cus_id = '$id'";

        $query = mysqli_query($con,$sql);

        while($row = mysqli_fetch_array($query)){
            $total_arr[] = $row['total'];
            $name = $row['custname'];



?>




                    <tr>
                        <td><?php  echo $row['product_name'];   ?></td>
                        <td style="text-align:right;"><?php  echo $row['quantity'];  ?></td>
                        <td style="text-align:right;">₱ <?php  echo number_format($row['price']);  ?></td>
                        <td style="text-align:right;">₱ <?php  echo number_format($row['total']);  ?></td>

                    </tr>
                   

                    <?php
            }
                    ?>
                </tbody>
            </table>
            <hr>
            <table>
                <thead>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td style="text-align:right;">Total:</td>
                        <td style="text-align:right;">₱ <?php  echo number_format(array_sum($total_arr));  ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align:right;">Cash:</td>
                        <td style="text-align:right;">₱ <?php echo number_format($_GET['amount']);  ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align:right;">Change:</td>
                        <td style="text-align:right;">₱ <?php echo  number_format((float)$_GET['amount'] - (float)array_sum($total_arr)) ; ?></td>
                    </tr>
                </tbody>
            </table>
                <hr>
        </div>

    </div>
    <div class="footer">
        <h4><?php echo date("Y-m-d");  ?></h4>
        <h4>Costumer: <?php echo $name;  ?></h4>
    </div>
</body>

<STYLE type="text/css">
/* @media print {
   .PrintOnly {font-size: 10pt; line-height: 120%; background: white;}
} */
@media screen {
   body {display: none}
}
</STYLE>


<style>
    .header
    {
        line-height: .5;
        text-align:center; 
    }
    .footer
    {
        line-height: .4;
        text-align:center; 
    }
    table
    {
        margin: auto;
    }
    table thead
    {
        text-align:center;   
    }
    table th
    {
        width:100px;
    }
    
</style>


<script>



const queryString = window.location.search;

const urlParams = new URLSearchParams(queryString);

const cusid = urlParams.get('id')





</script>

</html>
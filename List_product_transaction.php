<?php
session_start();
require 'config.php';
if (empty($_SESSION['TYPE'])) {
  if($_SESSION['TYPE'] != "ADMIN" )
  {
  header("Location: login.php");
  exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

                <title>Product Transaction | Trans-Master APARORS</title>
        <link rel="shortcut icon" href="pictures/logo.png" type="image/x-icon">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-danger">
            <h1 class="navbar-brand ps-3">TRANS-MASTER</h1>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
             
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php?logout'">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark " id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <br>
                            <a class="nav-link " href="Dashboard.php">
                                <div class="sb-nav-link-icon "><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <hr>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class='fas fa-user-friends'></i></div>
                                List of Account
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="List_admin.php">Admin Account</a>
                                    <a class="nav-link" href="List_customer.php">Customer Account</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="List_employee.php">
                                <div class="sb-nav-link-icon"><i class='fa fa-users'></i></div>
                               List of Employee
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseInventory" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class='fa fa-list'></i></div>
                                INVENTORY
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseInventory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="List_product.php">Product available</a>
                                    <a class="nav-link" href="List_sold.php">Product Sold</a>
                                </nav>
                            </div>
                            <hr>
                            <a class="nav-link collapsed text-light" href="#" data-bs-toggle="collapse" data-bs-target="#collapsetransaction" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon text-light"><i class='fa-solid fa-list-check'></i></div>
                                TRANSACTION
                                <div class="sb-sidenav-collapse-arrow text-light"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsetransaction" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link text-light" href="List_product_transaction.php">Product Transaction</a>
                                    <a class="nav-link" href="List_repair_transaction.php">Repair Transaction</a>
                                </nav>
                            </div>
                            <hr>
                            <a class="nav-link" href="List_inquires.php">
                                <div class="sb-nav-link-icon"><i class='fa fa-envelope'></i></div>
                                Inquires
                            </a>
                            <a class="nav-link" href="List_reviews.php">
                                <div class="sb-nav-link-icon"><i class='fa-solid fa-check-to-slot'></i></div>
                                Reviews
                            </a>
                        </div>
                    </div>
                    <?php
                        $sql = "SELECT * from users WHERE customer_id =".$_SESSION['Id'];  
                        $query= $con->query($sql)or die($con->error);
                        while ($row = $query->fetch_assoc()) 
                        {
                    ?>  
                    <div class="sb-sidenav-footer">
                        <div class="small ">Logged in as: <b class="text-light"><?php echo $row['username'];?></b></div>
                    </div>
                    <?php }?> 
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 mt-5">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List of prduct to pick-up
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT DISTINCT customer_id, firstname,lastname FROM pickup INNER JOIN users ON users.customer_id = pickup.cus_id ";
                                            $res = $con->query($sql);
                                            if (!$res) {
                                                echo 'error';
                                            }
                                            while ($row = mysqli_fetch_object($res)) { 
                                                $fname = $row->firstname;
                                                $lanme = $row->lastname;
                                                $cus_id = $row->customer_id;
                                        ?>

                                        <tr>
                                            <td><?php echo $fname; ?> <?php echo $lanme; ?></td>
                                            <td>
                                            <button type="submit" class="btn btn-info btn-sm" data-bs-toggle="modal" customer=<?php echo $cus_id ?> data-bs-target="#pickup">
                                            <i class="fa-solid fa-eye"></i>
                                            </button>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="modal fade" id="pickup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <template id="rows-template">
                        <tr id="row-template">
                            <td class="pname">Reymon</td>
                            <td class="qty">Nice ra sya</td>
                            <td class="price">Nice ra sya</td>
                            <td class="total">Nice ra sya</td>
                            <td class="stat">pick-up </td>
                        </tr>
                    </template>
                    <div class="modal-body">
                        <h2 id="name">Reymon Ariban</h2>
                        <p id="pay"></p>
                        <p id="totalamm">dasfadsf</p>
                        <a class="btn btn-sm btn-info" id="view-pr" download> See Proof </a>

                        <table class="table" id="pick-table">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th >Total</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="bdfdf">

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <input type="number" id="amma">
                        <button class="btn btn-primary" onclick="print()">Print Receipt</button>
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        <button type="submit" class="btn btn-success" id="confirm_pickup"> Confirm</button>
                        <!-- <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> -->
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.0/sweetalert2.all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
<script>
let cuid;

function print()    
        {

                var ammo = document.getElementById('amma').value;


                if(ammo > 0){

                    var recieptprint = window.open("productreciept.php?id="+cuid+"&amount="+ammo, 'Print')
                    recieptprint.addEventListener('load', function(){
                    recieptprint.print();
                
            }, true);
                }
                else{
                    Swal.fire({
                            icon: 'error',
                            title: 'Please input cash amount',
                            showConfirmButton: true,
                            allowOutsideClick: true
                        })
                }

          
            }

        $('.btn-sm').click(function() {

            $('#bdfdf').innerHTML = "";


            var _thisid = this.getAttribute('customer');


            $.ajax({
                dataType: 'script',
                url: "setpickup.php",
                type: "GET",
                data: {
                    'cid': _thisid
                }

            }).done(function(result) {
                var json = JSON.parse(result);
                var status = json[0].pstat;
                document.getElementById('pay').textContent = 'Status: ' + status;
                var pr = json[0]['proof'];
                document.getElementById('view-pr').setAttribute('href', "proof/"+pr);
                let alltotal = [];
                for (let i = 0; i < json.length; i++) {
                    alltotal.push(parseFloat(json[i]['total']));
                }
                let sum = 0;
                for (let k = 0; k < alltotal.length; k++) {
                    sum += alltotal[k];
                }
                if (status != "PAID") {
                    document.getElementById('totalamm').innerHTML = "Amount to pay: ₱ " + new Intl.NumberFormat().format(sum);
                    $('#totalamm').show();
                    $('#view-pr').hide();
                } else {
                    document.getElementById('totalamm').innerHTML = "Amount paid: ₱ " + new Intl.NumberFormat().format(sum);

                    $('#totalamm').show();
                    $('#view-pr').show();
                    document.getElementById('amma').value = sum;
                    $('#amma').hide();

                }

                document.getElementById('name').innerHTML = json[0]['custname'];
                document.getElementById('name').setAttribute("data-custid", json[0].custid);

                cuid = json[0]['custid'];


                const template = document.querySelector("#rows-template");

                const parent = document.querySelector("#pick-table tbody");

                $('#pick-table tbody').empty();

                for (let i = 0; i < json.length; i++) {

                    //clone the template
                    let clone = template.content.cloneNode(true);

                    clone.querySelector(".pname").innerHTML = json[i].product_name;
                    clone.querySelector(".price").innerHTML = json[i].price;
                    clone.querySelector(".qty").innerHTML = json[i].quantity;
                    clone.querySelector(".total").innerHTML = json[i].total;
                    clone.querySelector(".stat").innerHTML = json[i].status;

                    //apppend
                    parent.append(clone);
                }




            });


        });


        $('#confirm_pickup').click(function() {
            var _thisid = document.getElementById('name').getAttribute('data-custid');


            $.ajax({
                dataType: 'text',
                url: "payment.php",
                type: "POST",
                data: {
                    'cid': _thisid,
                    'payment_method': 'confirm_pickup'
                }
            }).done(function(result) {

                if (result == 0) {

                    Swal.fire({
                            icon: 'success',
                            title: 'Confirmed',
                            showConfirmButton: false,
                            timer: 1500,
                            allowOutsideClick: false
                        }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    // console.log(result);
                                    window.location.reload();
                                }
                            })
                } else {
                        console.log(result);
                    Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong',
                            showConfirmButton: false,
                            timer: 1000,
                            allowOutsideClick: false
                        }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $('#pickup').modal('hide');

                                    // window.location.reload();
                                }
                            })
                }
            });


        });
    </script>
     <style>
        @media print {}
        
        #pay,
                #totalamm {
                    font-size: 14px;
                    color: black;
                    text-align: center;

                }

                #name {
                    font-size: 20px;
                    color: black;
                }
                html {
    scroll-behavior: smooth;
}

html ::-webkit-scrollbar {
    width: 0;
    background-color: #111d2c;
    cursor: pointer;
}
    </style>

<?php
session_start();
require 'config.php';
if (empty($_SESSION['TYPE'])) {
    if ($_SESSION['TYPE'] != "ADMIN") {
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />

    <title>Rapair Transaction | Trans-Master APARORS</title>
    <link rel="shortcut icon" href="pictures/logo.png" type="image/x-icon">
</head>

<div class="modal fade" id="modalReceipt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Receipt And Labor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <label for="laborinput">Labor</label>
                    <input class="form-control" type="text" name="labor-input" id="laborinput">

                    <br>

                    <label for="cashinput">Cash</label>
                    <input class="form-control" type="text" name="cash-input" id="cashinput">

                    <br>
                    <label for="changeinput">Change</label>
                    <input class="form-control" type="text"  name="change" id="changeinput" disabled>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Confirm and Print</button>
            </div>
        </div>
    </div>
</div>


<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-danger">
        <h1 class="navbar-brand ps-3">TRANS-MASTER</h1>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
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
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class='fas fa-user-friends'></i></div>
                            List of Account
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="List_admin.php">Admin Account</a>
                                <a class="nav-link" href="List_customer.php">Customer Account</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="List_employee.php">
                            <div class="sb-nav-link-icon"><i class='fa fa-users'></i></div>
                            List of Employee
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseInventory" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class='fa fa-list'></i></div>
                            INVENTORY
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseInventory" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="List_product.php">Product available</a>
                                <a class="nav-link" href="List_sold.php">Product Sold</a>
                            </nav>
                        </div>
                        <hr>
                        <a class="nav-link collapsed text-light" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapsetransaction" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon text-light"><i class='fa-solid fa-list-check'></i></div>
                            TRANSACTION
                            <div class="sb-sidenav-collapse-arrow text-light"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsetransaction" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="List_product_transaction.php">Product Transaction</a>
                                <a class="nav-link text-light" href="List_repair_transaction.php">Repair Transaction</a>
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
                $sql = "SELECT * from users WHERE customer_id =" . $_SESSION['Id'];
                $query = $con->query($sql);
                while ($row = $query->fetch_assoc()) {
                    ?>
                    <div class="sb-sidenav-footer">
                        <div class="small ">Logged in as: <b class="text-light">
                                <?php echo $row['username']; ?>
                            </b></div>
                    </div>
                <?php } ?>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-3">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Repair Transaction
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Brand</th>
                                        <th>Vehicle Type</th>
                                        <th>Year Model</th>
                                        <th>Service</th>
                                        <th>Date Reserved</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    require 'config.php';

                                    $allrepair = "SELECT CONCAT(users.firstname,' ',users.middlename,' ',users.lastname) as fullname, `vehicle_brand`,`year_model`,`vehicle_type`,`service_type`,`reserve_date`,`reserve_time`, repair_reservation.status ,`id`,cpnumber,cus_id FROM repair_reservation
                                                INNER JOIN users ON repair_reservation.cus_id = users.customer_id WHERE repair_reservation.status = 'pending' ";

                                    $result = mysqli_query($con, $allrepair);

                                    while ($rows = mysqli_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $rows['fullname'] ?>
                                            </td>
                                            <td>
                                                <?php echo $rows['vehicle_brand'] ?>
                                            </td>
                                            <td>
                                                <?php echo $rows['vehicle_type'] ?>
                                            </td>
                                            <td>
                                                <?php echo $rows['year_model'] ?>
                                            </td>
                                            <td>
                                                <?php echo $rows['service_type'] ?>
                                            </td>
                                            <td>
                                                <?php echo $rows['reserve_date'] ?>
                                            </td>
                                            <td>
                                                <?php echo $rows['reserve_time'] ?>
                                            </td>
                                            <td>

                                                <a class="btn btn-info btn-sm"
                                                    href="sendsms.php?cp=<?php echo $rows['cpnumber'] ?>.&type=start"> Start
                                                    SMS </a>
                                                <a class="btn btn-primary btn-sm"
                                                    href="sendsms.php?cp=<?php echo $rows['cpnumber'] ?>.&type=done"> Finish
                                                    SMS </a>
                                                <a class="btn btn-success btn-sm" href="checkout.php?id=<?php echo $rows['id']?>&cusname=<?php echo $rows['fullname'] ?>"
                                                id="doneCheck"> DONE </a>
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



    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
<style>
    #a {
        color: black;
        text-decoration: none;
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
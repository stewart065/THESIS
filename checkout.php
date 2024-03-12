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
     <title>Repair Payment Transaction | Trans-Master APARORS</title>
    <link rel="shortcut icon" href="pictures/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />

</head>



<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-danger">
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
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
                        <div class="sb-sidenav-menu-heading ">Core</div>
                        <a class="nav-link " href="Dashboard.php">
                            <div class="sb-nav-link-icon "><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
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
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            List of Employee
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseInventory" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
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
                            <div class="sb-nav-link-icon text-light"><i class="fas fa-columns"></i></div>
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
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Inquires
                        </a>
                        <a class="nav-link" href="List_reviews.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
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
                <div class="container-fluid px-4 m-3">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Payment Transaction
                        </div>
                        <div class="card-body row">
                            <div class="col-6">
                                <div class="container">
                                    <label for="laborinput">Labor</label>
                                    <input class="form-control" type="number" name="labor-input" id="laborinput">

                                    <br>

                                    <label for="cashinput">Cash</label>
                                    <input class="form-control" type="number" name="cash-input" id="cashinput">

                                    <br>
                                    <label for="changeinput">Change</label>
                                    <input class="form-control" type="number" name="change" id="changeinput" disabled>

                                    <br>
                                    <button class="btn btn-success" id="confirmbtn"
                                        data-trid="<?php echo $_GET['id']; ?>">Confirm</button>
                                </div>
                            </div>
                            <div class="col-6">

                                <div class="card-body border" id="div_receipt" style="text-align: center;">
                                    <h3 style="text-align: center;" >Transmaster</h3>
                                    <h5 style="text-align: center;">
                                        <?php echo "Customer Name: " . $_GET['cusname']; ?>
                                    </h5>

                                    <div class="container mt-4 text-center" style="text-align: center;">
                                        <p style="text-align: center;" id="labor"></p>
                                        <p style="text-align: center;" id="cash"></p>
                                        <p style="text-align: center;" id="change"></p>

                                    </div>
                                    <p  style="text-align: center;" id="datee">Date</p>

                                </div>

                                <button class="btn btn-success mt-4" hidden id="print_re">Print</button>

                            </div>
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

    <script>

        const date = new Date();
        document.getElementById("datee").textContent = date;

        $("#confirmbtn").click(function () {


            if ($("#laborinput").val() != "" && $("#cashinput").val() != "" && $("#changeinput").val() != "" && $("#changeinput").val() >= 0) {


                var laborinput = "Labor Bill: " + $("#laborinput").val();

                var cashinput = "Cash: " + $("#cashinput").val();

                var changeinput = "Change: " + $("#changeinput").val();


                var thisid = $(this).data("trid");


            $.ajax({
                dataType: 'text',
                url: "finishservice.php",
                type: "POST",
                data: {
                    'cid': thisid,
                }
            }).done(function(result) {

                if (result == 0) {

                    Swal.fire({
                            icon: 'success',
                            title: 'Confirmed',
                            text: "You can print receipt",
                            showConfirmButton: true,
                            allowOutsideClick: true
                        })
                } 
            });
            
                document.getElementById("labor").textContent = laborinput;
                document.getElementById("cash").textContent = cashinput;
                document.getElementById("change").textContent = changeinput;
                document.getElementById("print_re").hidden = false;
            }
            else {
                Swal.fire({
                    title: 'Missing Info',
                    icon: 'error',
                    text: 'Fill in the details to Confirm',
                    showConfirmButton: true,

                })
            }

        });

        $("#laborinput").change(function () {

            var laborinput = $(this).val();

            var cashinput = $("#cashinput").val();

            var change = document.getElementById("changeinput").value = cashinput - laborinput;


        });


        $("#cashinput").change(function () {

            var cashinput = $(this).val();

            var laborinput = $("#laborinput").val();

            var change = document.getElementById("changeinput").value = cashinput - laborinput;

        });


        $("#print_re").click(function () {
            printDiv();
        });

        function printDiv() {
            var divContents = document.getElementById("div_receipt").innerHTML;
            var a = window.open('', '', 'height=800, width=600');
            a.document.write('<html>');
            a.document.write("<head> <style> #div_receipt{ border: 1px black solid; } </style> </head>");
            a.document.write('<body ><br>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();


            window.location.replace("List_repair_transaction.php");
        }



    </script>
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
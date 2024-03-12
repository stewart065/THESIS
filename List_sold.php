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
    
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/datatables.min.css">
    
        
        <title>Sold Product List | Trans-Master APARORS</title>
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
                            <a class="nav-link" href="Dashboard.php">
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
                            <a class="nav-link collapsed text-light" href="#" data-bs-toggle="collapse" data-bs-target="#collapseInventory" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon text-light"><i class='fa fa-list'></i></div>
                                INVENTORY
                                <div class="sb-sidenav-collapse-arrow text-light"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseInventory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="List_product.php">Product available</a>
                                    <a class="nav-link text-light" href="List_sold.php">Product Sold</a>
                                </nav>
                            </div>
                            <hr>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsetransaction" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class='fa-solid fa-list-check'></i></div>
                                TRANSACTION
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsetransaction" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="List_product_transaction.php">Product Transaction</a>
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
                    <div class="container-fluid px-4 mt-3">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Sold Products Table
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product name</th>
                                            <th>Brand</th>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <th>Price</th>  
                                            <th>Total</th>  
                                            <th>Date</th>  
                                            <th>Action</th>  
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        <?php
                                            $sql = "SELECT soldid, product_name,brand,category.category_name,qty,price,total,Date FROM sold_items 
                                            INNER JOIN product ON product.product_id = sold_items.pid 
                                            INNER JOIN category ON category.category_id = product.category_name";
                                            $res = $con->query($sql);
                                            if (!$res) {
                                                echo 'error';
                                            }
                                            while ($row = mysqli_fetch_object($res)) {
                                            $id = $row->soldid;
                                            $pid = $row->product_name;
                                            $brand = $row->brand;
                                            $cat = $row->category_name;
                                            $qty = $row->qty;
                                            $price = $row->price;
                                            $total = $row->total;
                                            $Date = $row->Date;
                                        ?>   
                                        <tr>
                                            <td><?php echo $pid; ?> </td>
                                            <td><?php echo $brand; ?> </td>
                                            <td><?php echo $cat; ?> </td>
                                            <td><?php echo $qty; ?> </td>
                                            <td><?php echo "₱ ". number_format($price,2)?> </td>
                                            <td><?php echo "₱ ". number_format($total,2) ?> </td> 
                                            <td><?php echo $Date; ?> </td>
                                            <td>
                                                <button type="submit" class="btn btn-danger btn-sm delsold" id="<?php echo $id; ?>"><i class='fas fa-trash'></i></button>
                                            </td>
                                        </tr> 
                                        <?php }?>   
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <!-- <script src="js/datatables-simple-demo.js"></script> -->
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/datatables.min.js"></script>
        <script src="js/pdfmake.min.js"></script>
        <script src="js/vfs_fonts.js"></script>

      
      <script>
      // =============  Data Table - (Start) ================= //

$(document).ready(function(){
    
    var table = $('#example').DataTable({
        buttons:['excel', 'pdf', 'print']
        
        // buttons:['copy', 'csv', 'excel', 'pdf', 'print']
        
    });
    
    
    table.buttons().container()
    .appendTo('#example_wrapper .col-md-6:eq(0)');

});

// =============  Data Table - (End) ================= //
      </script>
<script>
                    //script for deleting data
                    $(document).on('click','.delsold', function(){
                    var id = $(this).attr('id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to delete this!",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) =>{
                        if (result.isConfirmed) {
                            $.ajax({
                                url:'sold.php',
                                type:'POST',
                                data: {id:id},
                                success: function(data){
                                    Swal.fire({
                                        title:'success',
                                        icon:'success',
                                        text:'Deleted successfully!',
                                        showConfirmButton: false,
                                        timer:1000,
                                    }).then(()=>{
                                        window.location.reload();
                                    })
                                }
                            })
                        }
                    })
                })
</script>
    </body>
</html>
<style>
html {
    scroll-behavior: smooth;
}

html ::-webkit-scrollbar {
    width: 0;
    background-color: #111d2c;
    cursor: pointer;
}






/* ==== Data table  = Start ===== */

.card-body{
   background: #fff;
    padding: 15px;
    box-shadow: 1px 3px 5px #aaa;
    border-radius: 5px;
}

.card-body .btn{
    padding: 5px 10px;
    margin: 10px 3px 10px 0;
}

</style>


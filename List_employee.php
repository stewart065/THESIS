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
        
        <title>Employee List | Trans-Master APARORS</title>
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
                            <a class="nav-link text-light" href="List_employee.php">
                                <div class="sb-nav-link-icon text-light"><i class='fa fa-users'></i></div>
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
                          <h5>  <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item" ><a  href="" >Employee</a></li>
                                <li class="breadcrumb-item"><a id="a" href="List_position.php">Position</a></li>
                            </ol>  </h5>
                        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#employee_add_modal">
                        <i class="fa-solid fa-user-plus"></i> Employee
                        </button>
                        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#add_salary_modal">
                        <i class="fa-solid fa-circle-plus"></i> Salary
                        </button>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               Employee's Table
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th> Profile</th>
                                            <th> Fullname</th>
                                            <th> Adddress</th>
                                            <th> Birthdate</th>
                                            <th> Gender</th>
                                            <th>CP No.</th>  
                                            <th>Email</th> 
                                            <th>Position</th> 
                                            <th>Salary</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                  $recent=0;
                    $display = mysqli_query($con,"SELECT * FROM employee");   
                ?>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($display)){ ?>
                        <tr>
                            <td><img src="profiles/<?php echo $row['employee_profile'];?>" alt="" style="height: 50px; width:50px; "></th>
                            <td> <?php echo $row['employee_firstname'];?> <?php echo $row['employee_middlename'];?> 
                            <?php echo $row['employee_lastname'];?></td>
                            <td> <?php echo $row['employee_barangay'];?>
                            <?php echo $row['employee_municipality'];?>
                            <?php echo $row['employee_province'];?></td>
                            <td> <?php echo $row['employee_birthdate'];?></td>
                            <td> <?php echo $row['employee_gender'];?></td>
                            <td> <?php echo $row['employee_cpnumber'];?></td>
                            <td> <?php echo $row['employee_email'];?></td>
                            <?php   
                
                                $category="";
                                $r=0;
                                $display2 = mysqli_query($con,"SELECT * FROM position WHERE position_id=".$row['employee_position']);   
                                ?>
                                <?php while($row2 = mysqli_fetch_assoc($display2)){ ?>
                                <?php $r++; $category=$row2['position_name']; ?>
                                <?php }?>
                                <?php if($r>0){?>
                                <td> <?php echo $category; ?></td>
                                <?php }else{ ?>
                                <td> <?php echo "N/A"; ?></td>
                                <?php } ?>
                            <td> <?php echo $row['employee_salary'];?></td>
                            
                            <td>
                                <button type="submit" class="btn btn-primary  btn-sm updatemployee" value="<?= $row['employee_id'];?>"><i class='fas fa-edit'></i></button>
                                <button type="submit" class="btn btn-danger btn-sm deletemployee" value="<?= $row['employee_id'];?>"><i class='fas fa-trash'></i></button>
                            </td>
                        </tr>
                        <?php $recent=$row['employee_id'];  }?>    

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <!-- add -->
        <div class="modal fade" id="employee_add_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content"> 
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add new employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action='employee-crud.php' autocomplete="off" enctype="multipart/form-data" id="form" method="POST">
                        <div class="modal-body">
                            <div class="row mb-4">
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Firstname</label>
                                    <input type="text" name="fname"  placeholder="Enter firstname" class=" form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Middlename</label>
                                    <input type="text" name="mname"  placeholder="Enter middlename" class=" form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Lastname</label>
                                    <input type="text" name="lname" placeholder="Enter lastname" class=" form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Barangay</label>
                                    <input type="text" name="brgy"  placeholder="Enter barangay" class=" form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Municipality</label>
                                    <input type="text" name="muni"  placeholder="Enter municipality" class=" form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Province</label>
                                    <input type="text" name="prov"  placeholder="Enter province" class=" form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Birthdate</label>
                                    <input type="date" name="birth"  class=" form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Gender</label>
                                    <select  class="form-control" name="gend">
                                        <option selected disabled>Select Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Cellphone Number</label>
                                    <input type="number" name="cp" placeholder="Enter cp number"  class="form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Email</label>
                                    <input type="email" name="mail"  placeholder="Enter email address" class="form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Position</label>
                                    <select class="form-control" name="post" id="">
                                        <option selected disabled>Select Position</option>
                                        <?php
                                            $display = mysqli_query($con,"SELECT * FROM position");   
                                            while($row = mysqli_fetch_assoc($display)){
                                        ?>     
                                        <option value="<?php echo $row['position_id']; ?>"> <?php echo $row['position_name']; ?> </option>
                                        <?php } ?>
                                    </select>     
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Salary</label>
                                    <input type="number" name="salar" min="397" placeholder="Enter salary" class=" form-control" />
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label" for="firstName">Image</label>
                                    <input type="file" accept=".jpg,.jpeg,.png" name="profpic"  class=" form-control" />
                                </div>
                            </div> 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" value="submit" class="btn btn-primary" >add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- update -->
        <div class="modal fade" id="employee_update_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content"> 
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update employee's inforamtion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action='employee-crud.php' autocomplete="off" enctype="multipart/form-data" id="updateform" method="POST">
                        <div class="modal-body">
                            <div class="row mb-4">
                                <input type="hidden"  name="em_id" id="em_id" >
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Firstname</label>
                                    <input type="text" name="f_name" id="first_name" placeholder="Enter firstname" class=" form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Middlename</label>
                                    <input type="text" name="m_name" id="middle_name" placeholder="Enter middlename" class=" form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Lastname</label>
                                    <input type="text" name="l_name" id="last_name" placeholder="Enter lastname" class=" form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">barangay</label>
                                    <input type="text"name="b_rgy" id="bara_ngay" placeholder="Enter barangay" class="form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Municipality</label>
                                    <input type="text" name="m_lty" id="munici_pality" placeholder="Enter municipality" class=" form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Province</label>
                                    <input type="text" name="p_rv" id="pro_vince" placeholder="Enter province" class=" form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Birthdate</label>
                                    <input type="date"  name="b_date" id="birth_date" placeholder="Enter birthdate"class=" form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Gender</label>
                                    <select  class="form-control"  name="g_dr" id="gen_der">
                                        <option selected disabled>Select Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Cellphone number</label>
                                    <input type="number"  name="c_p" id="cp_number" placeholder="Enter cp number" class=" form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Email</label>
                                    <input type="email"  name="ma_il" id="e_mail" placeholder="Enter email address" class=" form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Position</label>
                                    <select class="form-control" name="pst" id="po_st" >
                                        <option selected disabled>- - Select Positon - -</option>
                                        <?php
                                            $display = mysqli_query($con,"SELECT * FROM position"); 
                                            while($row = mysqli_fetch_assoc($display)){ ?>       
                                            <option value="<?php echo $row['position_id']; ?>"> <?php echo $row['position_name']; ?> </option>
                                        <?php 
                                            } 
                                        ?>
                                    </select>  
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="firstName">Salary</label>
                                    <input type="number"  name="slry" id="sa_lary"  min="397" placeholder="Enter salary" class="form-control" />
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label" for="firstName">Image</label>
                                    <input type="file" accept=".jpg,.jpeg,.png"  name="uppic" id="up_pic"  class=" form-control" />
                                </div>
                            </div> 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" value="submit" class="btn btn-primary" >Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
         <!-- add salary-->
         <div class="modal fade" id="add_salary_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content"> 
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Additional Salary</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action='employee-crud.php' autocomplete="off" enctype="multipart/form-data" id="salary" method="POST">
                        <div class="modal-body">
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label class="form-label" for="firstName">Employee name</label>
                                    <select class="form-control" name="em_sal" id="">
                                        <option selected disabled>Select Employee</option>
                                        <?php 
                                            $display = mysqli_query($con,"SELECT * FROM employee");   
                                            while($row = mysqli_fetch_assoc($display)){
                                        ?>       
                                        <option value="<?php echo $row['employee_id']; ?>"> <?php echo $row['employee_firstname']; ?> <?php echo $row['employee_lastname']; ?> </option>
                                        <?php 
                                            }
                                         ?>
                                    </select>   
                                </div>
                                <div class="col-sm-12">
                                    <label class="form-label" for="firstName">Add Salary</label>
                                    <input type="number" min="250" name="sal" id="sary" placeholder="Enter add on salary" class=" form-control" />
                                </div>
                            </div> 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" value="submit" class="btn btn-primary" >add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- update -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.0/sweetalert2.all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
<style>
    #a{
        color:black;
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
<script>
        // FOR ADD INVENTORY
    $(document).on('submit', '#form', function (e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        formData.append("add_employee", true);
    
        $.ajax({
            type: "POST",
            url: "employee-crud.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {                    
            var res = jQuery.parseJSON(response);
                if(res.status == 422) {
                    Swal.fire(
                        'Ooops error!',
                        'please fill up the blank',
                        'error'
                    )
        
                }
                else if(res.status == 200){
        
                    Swal.fire({
                        title:'success',
                        text:'Added successfully',
                        icon:'success',
                        timer:'1000',
                        showConfirmButton:false,
                    }).then(()=>{
                    window.location.reload();
                    })
        
                } 
                else if(res.status == 500) {
                    alert(res.message);
                }
            }
        });
        
    });


     // FOR VIEW Employee MODAL

     $(document).on('click', '.updatemployee', function () {

        var em_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "employee-crud.php?em_id=" + em_id,
            success: function (response) {
    
                var res = jQuery.parseJSON(response);
                if(res.status == 404)
                {
                    Swal.fire(
                        'Ooops error!',
                        'please fill up the blank',
                        'error'
                    )
                }
                else if(res.status == 200){
    
                    $('#em_id').val(res.data.employee_id);
                    $('#first_name').val(res.data.employee_firstname);
                    $('#middle_name').val(res.data.employee_middlename);
                    $('#last_name').val(res.data.employee_lastname);
                    $('#bara_ngay').val(res.data.employee_barangay);
                    $('#munici_pality').val(res.data.employee_municipality);
                    $('#pro_vince').val(res.data.employee_province);
                    $('#birth_date').val(res.data.employee_birthdate);
                    $('#gen_der').val(res.data.employee_gender);
                    $('#cp_number').val(res.data.employee_cpnumber);
                    $('#e_mail').val(res.data.employee_email);
                    $('#po_st').val(res.data.employee_position);
                    $('#sa_lary').val(res.data.employee_salary); 
                    $('#employee_update_modal').modal('show');
                }
            }
        });
    });    

// FOR UPDATE PRODUCT MODAL
$(document).on('submit', '#updateform', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("employee_update", true);

    $.ajax({
        type: "POST",
        url: "employee-crud.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                Swal.fire(
                'Something went wrong!',
                'please fill up the blank',
                'error'
                )

            }
            else if(res.status == 200){

                Swal.fire({
                title:'success',
                text:'Update successfully',
                icon:'success',
                timer:'1000',
                showConfirmButton:false,
            }).then(()=>{
            window.location.reload();
            })
            }else if(res.status == 500) {
                alert(res.message);
            }
        }
    });

}); 

// FOR DELETE CATEGORY
$(document).on('click', '.deletemployee', function (e) {
    e.preventDefault();

    Swal.fire({
        title: 'Are you sure?',
        text: "You wan't be able to delete this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {

            var em_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "employee-crud.php",
            data: {
                'delete_employee': true,
                'em_id': em_id
            },
            success: function (response) {
                Swal.fire({
                    title: 'Success',
                    icon: 'success',
                    text:'Your data has been deleted.',
                    showConfirmButton:false,
                    timer:'1000',
                }).then(()=>{
                    window.location.reload();
                })

                var res = jQuery.parseJSON(response);
                if(res.status == 500) {

                   Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    })
                }else{
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);

                    $('#table_id').load(location.href + " #table_id");
                }
            }
        });                  
        }
    })          
});



// ADD salary

$(document).on('submit', '#salary', function (e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    formData.append("add_salary", true);

    $.ajax({
        type: "POST",
        url: "employee-crud.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {                    
        var res = jQuery.parseJSON(response);
        
            if(res.status == 422) {
                Swal.fire(
                    'Ooops error!',
                    'please fill up the blank',
                    'error'
                )
    
            }
            else if(res.status == 200){
    
                Swal.fire({
                    title:'success',
                    text:'Added  successfully',
                    icon:'success',
                    timer:'1000',
                    showConfirmButton:false,
                }).then(()=>{
                window.location.reload();
                })
    
            } 
            else if(res.status == 500) {
                alert(res.message);
            }
        }
    });
    
});
</script>

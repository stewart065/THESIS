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
    
        <title>Product List | Trans-Master APARORS</title>
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
                                <div class="sb-nav-link-icon "><i class='fa fa-users'></i></div>
                               List of Employee
                            </a>
                            <a class="nav-link collapsed text-light" href="#" data-bs-toggle="collapse" data-bs-target="#collapseInventory" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon text-light"><i class='fa fa-list'></i></div>
                                INVENTORY
                                <div class="sb-sidenav-collapse-arrow text-light"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseInventory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link text-light" href="List_product.php">Product available</a>
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
                        <h5><ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="">Product</a></li>
                            <li class="breadcrumb-item active" ><a id="a"  href="List_category.php">Category</a></li>
                        </ol></h5>
                        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#product_add_modal">
                        <i class="fa-solid fa-circle-plus"></i> Product
                        </button>
                        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#stock_add_modal">
                        <i class="fa-solid fa-circle-plus"></i> Stock's
                        </button>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Product Table
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Product Image</th>
                                            <th>Product name</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Description</th>
                                            <th>Stock</th>
                                            <th>Price</th>  
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $recent=0;
                                            $display = mysqli_query($con,"SELECT * FROM product;");  
                                            while($row = mysqli_fetch_assoc($display)){
                                        ?>
                                        <tr>
                                            <td><img src="product_image/<?php echo $row['image'];?>" alt="" style="height: 50px; width:50px; "></th>
                                            <td><?php echo $row['product_name']; ?></td>
                                            <?php
                                    
                                                $category="";
                                                $r=0;
                                                $display2 = mysqli_query($con,"SELECT * FROM category WHERE category_id=".$row['category_name']);   
                                            ?>
                                            <?php while($row2 = mysqli_fetch_assoc($display2)){ ?>
                                            <?php $r++; $category=$row2['category_name']; ?>
                                            <?php }?>
                                            <?php if($r>0){?>
                                            <td> <?php echo $category; ?></td>
                                            <?php }else{ ?>
                                            <td> <?php echo "N/A"; ?></td>
                                            <?php } ?>
                                            <td><?php echo $row['brand']; ?></td>
                                            <td><?php echo $row['description']; ?></td>
                                            <td><?php echo $row['quantity']; ?></td>
                                            <td>₱<?php echo $row['price']; ?></td>
                                            <td>
                                                <button type="submit" class="btn btn-primary  btn-sm updateproduct" value="<?= $row['product_id'];?>"><i class='fas fa-edit'></i></button>
                                                <button type="submit" class="btn btn-danger btn-sm deleteproduct" value="<?= $row['product_id'];?>"><i class='fas fa-trash'></i></button>
                                            </td>
                                        </tr>
                                        <?php $recent=$row['product_id'];  }?>   
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <!-- add products-->
        <div class="modal fade" id="product_add_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content"> 
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add new product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action='inventory-crud.php' autocomplete="off" enctype="multipart/form-data" id="form" method="POST">
                        <div class="modal-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label" for="firstName">Product Name</label>
                                    <input type="text" name="prodanme"  placeholder="Enter product name"class=" form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="firstName">Category</label>
                                    <select class="form-control" name="cat">
                                        <option selected disabled>Select Category</option>
                                        <?php  $display = mysqli_query($con,"SELECT * FROM category");   
                                        while($row = mysqli_fetch_assoc($display)){ ?>       
                                        <option value="<?php echo $row['category_id']; ?>"> <?php echo $row['category_name']; ?> </option>
                                        <?php } ?>
                                    </select>  
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="firstName">Brand</label>
                                    <input type="text" name="brand"  placeholder="Enter product brand" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="firstName">Quantity</label>
                                    <input type="number" name="quan"  placeholder="Enter quantity" class=" form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="firstName">Price</label>
                                    <input type="number" name="price" placeholder="Enter price" class=" form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="firstName">image</label>
                                    <input type="file"  accept=".jpg,.jpeg,.png"   class="form-control" name="image">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="firstName">Description</label>
                                    <textarea class="form-control" id="prodesc"  name="prodesc" rows="3" placeholder="Description"></textarea>
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
         <!-- update products-->
         <div class="modal fade" id="product_update_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content"> 
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update product information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action='inventory-crud.php' autocomplete="off" enctype="multipart/form-data" id="productform_update" method="POST">
                        <div class="modal-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <input type="hidden" name="prodid" id="prod_id" >
                                    <label class="form-label" for="firstName">Product name</label>
                                    <input type="text" name="pro_name" id="prod_name" placeholder="Enter product name" class=" form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="firstName">Category</label>
                                    <select class="form-control" name="catname" id="cat_name">
                                        <option selected disabled>Select Category</option>
                                        <?php  $display = mysqli_query($con,"SELECT * FROM category");   
                                        while($row = mysqli_fetch_assoc($display)){ ?>       
                                        <option value="<?php echo $row['category_id']; ?>"> <?php echo $row['category_name']; ?> </option>
                                        <?php } ?>
                                    </select>  
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="firstName">Brand</label>
                                    <input type="text" name="bra_nd"  id="prod_brand" placeholder="Enter product brand" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="firstName">Quantity</label>
                                    <input type="number" name="qu_an" id="prod_quan" placeholder="Enter quantity" class=" form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="firstName">Price</label>
                                    <input type="number" name="pri_ce" id="prod_price"  placeholder="Enter price" class=" form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="firstName">image</label>
                                    <input type="file"  accept=".jpg,.jpeg,.png"  name="ima_ge" id="prod_img" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="firstName">Description</label>
                                    <textarea class="form-control"  name="proddesc" id="prod_desc" rows="3" placeholder="Description"></textarea>
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
        <!-- add stock -->
        <div class="modal fade" id="stock_add_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content"> 
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Additional stock</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action='inventory-crud.php' autocomplete="off" enctype="multipart/form-data" id="stock" method="POST">
                        <div class="modal-body">
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label class="form-label" for="firstName">Product name</label>
                                    <select class="form-control" name="prodStock" id="">
                                        <option selected disabled>Select Product</option>
                                        <?php 
                                            $display = mysqli_query($con,"SELECT * FROM product");   
                                            while($row = mysqli_fetch_assoc($display)){ 
                                        ?>       
                                        <option value="<?php echo $row['product_id']; ?>"> <?php echo $row['product_name']; ?> </option>
                                        <?php } ?>
                                    </select>  
                                </div>
                                <div class="col-sm-12">
                                    <label class="form-label" for="firstName">Stock</label>
                                    <input type="number" name="quantity" id="prodname" placeholder="Enter add on stock" class=" form-control" />
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
 $(document).on('submit', '#form', function (e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        formData.append("add_product", true);
    
        $.ajax({
            type: "POST",
            url: "inventory-crud.php",
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


     // FOR VIEW INVENTORY MODAL

     $(document).on('click', '.updateproduct', function () {

        var prodid = $(this).val();
        //alert(prodid);
        $.ajax({
            type: "GET",
            url: "inventory-crud.php?prod_id=" + prodid,
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
    
                    $('#prod_id').val(res.data.product_id);
                    $('#prod_name').val(res.data.product_name); 
                    $('#cat_name').val(res.data.category_name); 
                    $('#prod_brand').val(res.data.brand); 
                    $('#prod_quan').val(res.data.quantity); 
                    $('#prod_desc').val(res.data.description); 
                    $('#prod_price').val(res.data.price); 
                   // $('#prod_img').val(res.data.image); 
                    $('#product_update_modal').modal('show');
                }
            }
        });
    });

// FOR UPDATE PRODUCT MODAL


$(document).on('submit', '#productform_update', function (e) {
    
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_product", true);

    $.ajax({
        type: "POST",
        url: "inventory-crud.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            // alert("adf");
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                Swal.fire(
                'Something went wrong!',
                'please fill up the blank',
                'error'
                )

            }else if(res.status == 200){

                Swal.fire({
                title:'success',
                text:'Update successfully',
                icon:'success',
                timer:'1000',
                showConfirmButton:false,
            }).then(()=>{
            window.location.reload();
            })

                $('#product_update_modal').modal('hide');
                $('#updateform')[0].reset();

                $('#table_id').load(location.href + " #table_id");

            }else if(res.status == 500) {
                alert(res.message);
            }
        }
    });

});    
  
// FOR DELETE CATEGORY
$(document).on('click', '.deleteproduct', function (e) {
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

            var prod_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "inventory-crud.php",
            data: {
                'delete_prod': true,
                'prod_id': prod_id
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

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });                  
        }
    })          
});


// ADD STOCK

$(document).on('submit', '#stock', function (e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    formData.append("add_stock", true);

    $.ajax({
        type: "POST",
        url: "inventory-crud.php",
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
                $('#stock_add_modal').modal('hide');
                $('#stock')[0].reset();
                alertify.set('notifier','position', 'top-right'); 
                $('#table_id').load(location.href + "#table_id");
    
            } 
            else if(res.status == 500) {
                alert(res.message);
            }
        }
    });
    
});
</script>

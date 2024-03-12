<?php
session_start();
require 'config.php';
if (empty($_SESSION['TYPE'])) {
  if($_SESSION['TYPE'] != "CUSTOMER" )
  {
  header("Location: login.php");
  exit();
  }
}


if (isset($_POST['update_qty'])) {
    $qty = $_POST['quan'];
    $cid = $_POST['cart_id'];
    $sql = "UPDATE productcart set qty = '$qty' where id = '$cid' ";
    $res = mysqli_query($con, $sql);
    if ($res) {
        header('Location: Home-cart.php');
    } else {
        echo $sql;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <title>Product Cart | Trans-Master APARORS</title>
    <link rel="shortcut icon" href="pictures/logo.png" type="image/x-icon">
</head> 
<nav class="navbar navbar-expand-lg navbar-light sticky-top" id="topbar">
    <div class="container-fluid text-white">
        <!-- <a class="navbar-brand" href="#">Transmaster</a> -->
        <h4 class="fw-bold">TRANS-MASTER</h4>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
      
        <!-- Left Element -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class=" me-auto mb-2 mb-lg-0">
                <form class="d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            </ul> 
        </div>
        <div class="collapse navbar-collapse ariban" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 m-auto">
                <li  ><a href="Home.php" class="nav-link fw-bold ariban">Home</a></li>
                <li class="dropdown">
                    <a class="nav-link ariban fw-bold dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">       
                    Reservation
                    </a>
                    <ul class="dropdown-menu justify-content-left ">
                        <li> <a href="Home_product_reservation.php"><button class="dropdown-item" type="button">Product</button></a></li>
                        <li> <a href="Home_repair_reservation.php"><button class="dropdown-item" type="button">Repair</button></a></li>
                    </ul>
                </li>
                <li > <a href="Home_rate.php" class="nav-link fw-bold ariban"> To rate</a></li>
                <li > <a href="Home_rated_product.php" class="nav-link fw-bold ariban">Reviews</a></li>
            </ul>
        </div>
        <div class="collapse navbar-collapse ariban " id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mr-2">
                <li><a href="Home-cart.php" class="nav-link ariban" ><i class="fa-solid fa-cart-shopping"></i></a></li>
                <li > <a href="Home-inquire.php" class="nav-link ariban"><i class="fa-solid fa-message"></i></a></li>
                <li class="dropdown">
                    <a class="nav-link ariban fw-bold dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">       
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    </a>
                    <ul class="dropdown-menu justify-content-left ">
                        <li> <a href="Home_history_product.php"><button class="dropdown-item" type="button">Product</button></a></li>
                        <li> <a href="Home_history_repair.php"><button class="dropdown-item" type="button">Repair</button></a></li>
                    </ul>
                </li>
                <?php              
                  $sql ="SELECT concat (firstname,' ',lastname) as `name` , profile FROM users WHERE customer_id =".$_SESSION['Id'];  
                  $res = $con->query($sql);
                   if (!$res) {
                    echo 'error';
                   }
                 while ($row = mysqli_fetch_object($res)) { 
                      $uname = $row->name;
                     $profile = $row->profile;

                    ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle ariban eyy" id="navbarDropdown" href="#" role="button"
                     data-bs-toggle="dropdown" aria-expanded="false"> <img style="width:30px; height:30px;" 
                      class="rounded-circle"src="profiles/<?php echo $profile; ?>">
                      <?php echo $uname; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item text-dark" href="view-profile.php">My profile</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item text-dark" href="logout.php?logout'">Logout</a></li>
                    </ul>
                </li>
                <?php }?> 
            </ul>
        </div>
    </div>
</nav>
<body>

<div class="container-fluid mt-3">
    <div class="row px-md-4 px-2 pt-4 ">
        <div class="col-lg-8 mb-4   ">
            <p class="pb-2 fw-bold">Order</p>
            <div class="card">
                <div class="table-responsive px-md-4 px-2 pt-3 " style="height: 74vh; overflow-y: scroll;">
                    <table class="table table-borderless" >
                        <tbody>
                            <?php
                                require 'config.php';
                                $total_accumulated_price = 0;
                                $bid = $_SESSION['Id'];

                                $sql = "SELECT productcart.id as cart_id,  product.product_id as prod_id, product.quantity As quantity, product_name,price,SUM(qty) as qty, quantity, image FROM productcart  
                                        INNER JOIN product ON product.product_id = productcart.pid 
                                        where  customerid= '$bid' AND quantity != 0 GROUP BY product_name ";
                                $res = $con->query($sql);

                                if (!$res) {
                                    echo 'error';
                                }

                                while ($row = mysqli_fetch_object($res)) {

                                    $cid = $row->cart_id;
                                    $id = $row->prod_id;
                                    $img = $row->image;
                                    $name = $row->product_name;
                                    $stock = $row->quantity;
                                    $price = $row->price;
                                    $qty = $row->qty;
                                    $maxqty = $row->quantity;
                                    $total_price = $qty * $price;
                                    $total_accumulated_price = $total_accumulated_price + $total_price;
                            ?>
                            <tr class="border-bottom">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div> <img class="pic" src="product_image/<?php echo $img; ?>" alt=""> </div>
                                        <div class="ps-3 d-flex flex-column justify-content">
                                            <p class="fw-bold"><?php echo $name; ?><span class="ps-1"></p> <small class=" d-flex"> <span class=" text-muted"></span> </small> <small class=""> <span class=" text-muted">Stocks:</span> <span class=" fw-bold"><?php echo $stock; ?></span> </small>
                                        </div>
                                    </div>
                                </td>
                                    <td>
                                        <div class="d-flex">
                                            <p class="pe-3"><span class="red"><?php echo '₱ ' .
                                                                        number_format($total_price, 2); ?></span></p>
                                            <p class="text-muted text-decoration-line-through"><?php echo '₱ ' .
                                                                        number_format($price, 2); ?></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center"> <span class="pe-3 text-muted">Quantity</span> <span class="pe-5"> <?php echo $qty; ?></span>
                                                <input type="text" class="cartsid" name="cart_id" id="cart-id" value=" <?php echo $cid; ?>" hidden>
                                                <input type="text" name="prod_cart_id" id="prod_cart-id" value=" <?php echo $id; ?>" hidden>
                                        </div>
                                    </td>
                                <td>
                                    <div class="d-flex align-items-center"> <span class="pe- text-muted">
                                            <button class="btn btn-outline-primary edit_cart " data-valid="<?php echo $cid; ?>" data-maxqty="<?php echo $maxqty; ?>"><i class="fa fa-edit"> </i></button>
                                             <button class="btn btn-outline-danger deletecart" data-valid="<?php echo $cid; ?>"><i class="fa fa-trash"> </i></button>
                                   
                                    </div>
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
         <!-- Modal -->
        <div class="modal fade" id="cartmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Quantity</h5>
                    </div>
                    <form action='Home-cart.php' enctype="multipart/form-data" method="POST">
                        <div class="modal-body">
                            <input type="hidden" id="cartid" name="cart_id">
                            <div class="mb-3">
                                <label for="">Quantity</label>
                                <input type="number" min="1" name="quan" id="cart_quan"  class="form-control">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closecartmodal">Close</button>
                            <button type="submit" class="btn btn-primary" value="submit" name="update_qty">Update </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 payment-summary" >
            <p class="fw-bold pt-lg-0 pt-4 pb-2">Payment</p>
            <div class="card px-md-3 px-2 pt-4" >
                <!-- <div class="unregistered mb-4"> <span class="py-1">Registered account</span> </div> -->
                <div class="d-flex flex-column b-bottom" style="height: 61vh; overflow-y: scroll;">
                    <div class="d-flex justify-content-between py-3"> <small class="text-muted">Order Name</small>
                        <p>Quantity</p><p>Price</p>
                    </div>
                    <?php
        require 'config.php';
        $total_accumulated_price = 0;
        $bid = $_SESSION['Id'];

        $sql = "SELECT productcart.id as cart_id, product.product_id as prod_id, product_name,price,SUM(qty) as qty, quantity, image FROM productcart  
                INNER JOIN product ON product.product_id = productcart.pid
                where  customerid= '$bid' AND quantity != 0 GROUP BY product_name ";
        $res = $con->query($sql);

        if (!$res) {
            echo 'error';
        }

        while ($row = mysqli_fetch_object($res)) {

            $cid = $row->cart_id;
            $id = $row->prod_id;
            $img = $row->image;
            $name = $row->product_name;
            $price = $row->price;
            $qty = $row->qty;
            $maxqty = $row->quantity;
            $total_price = $qty * $price;
            $total_accumulated_price = $total_accumulated_price + $total_price;
        ?>
                    <div class="d-flex justify-content-between pb-3"> <small class="text-muted"><?php echo $name; ?></small>
                    <p ><?php echo $qty; ?></p> <p><?php echo '₱ ' . number_format($total_price, 2); ?></p>
                    </div>
                    <?php
        }
        ?>
                    <hr>
                    
                    <div class="d-flex justify-content-between"> <small class="text-muted">Total Amount</small>
                        
                        <p id="total-pay"><?php echo '₱ ' . number_format($total_accumulated_price, 2); ?></p>
                    </div>
      
                </div>
                <div class="btn btn-danger sale my-3" type="button"  id="btn-checkout"><span class="dark">Check out</span> </div>
            </div>
        </div>
    </div>
</div>

    <!-- Checkout Modal-->
    <div class="modal fade" id="checkout-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="checkout-modalLabel">PAYMENT METHOD</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="h5">Total Payment: <span id="paytotal"> <strong> 0000000 </strong> </span> </p>
                    <br>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="select-payment">
                        <option selected disabled>Select payment method</option>
                        <option value="counter">Over the counter</option>
                        <option value="online">Online payment <i>(Gcash)</i> </option>
                    </select>
                    <br>
                    <div class="container" id="on-div">
                        <p class="h5 text-center">Pay in this number: <br> Trans-Master </p>
                        <p class="h3 text-center">09127298757</p>
                        <div class="container text-center">
                            <img src="pictures/qrcode.jpg" class="img-fluid" id="wizardPicturePreview" title="">
                        </div>
                        <br>
                        <label for="proof">Attach Screenshot for Proof:</label>
                        <input type="file" id="proof" accept=".jpg, .jpeg, .png">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn" style=" background-color: #730F0F; color:white;" id="proceed-checkout">Proceed</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.0/sweetalert2.all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>

        $('#on-div').hide();

        $(document).on('click', '.edit_cart', function() {

            var cart_id = this.getAttribute('data-valid');
            var cart_qty = this.getAttribute('data-maxqty');

            // alert(cart_id);
          
            
            $('#cartmodal').modal('show');

            document.getElementById('cart_quan').setAttribute('max', cart_qty);
           
            document.getElementById('cartid').value = cart_id;
           
        });

        $('#closecartmodal').click(function() {
            $('#cartmodal').modal('hide');

        })
    </script>

    <script>
        // FOR DELETE CATEGORY
        $(document).on('click', '.deletecart', function(e) {

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

                    var cartid = this.getAttribute('data-valid');



                    $.ajax({
                        dataType: 'script',
                        url: "cart-crud.php",
                        type: "POST",
                        data: {
                            'delete_cart': 'hashh',
                            'prod_cart_id': cartid
                        }
                    }).done(function(result) {
                        if (result == 0) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted from cart',
                                showConfirmButton: false,
                                timer: 1500,
                                allowOutsideClick: false,
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    window.location.reload();
                                }
                            })



                        } else {
                            Swal.fire({
                                icon: 'errpr',
                                title: 'Something went wrong',
                                showConfirmButton: false,
                                timer: 1500,
                                allowOutsideClick: false,
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    window.location.reload();
                                }
                            })

                        }
                    });
                }
            })
        });





        $('#select-payment').on('change', function() {

            if (this.value == 'online') {
                $('#on-div').show();
            } else {
                $('#on-div').hide();

            }
        });

        $('#btn-checkout').click(function() {

            var tp = document.getElementById('total-pay').textContent;
            document.getElementById('paytotal').textContent = tp;
            $('#checkout-modal').modal('show');

        });


        $('#proceed-checkout').click(function() {

            var val = document.getElementById('select-payment').value;
            var tp = document.getElementById('paytotal').textContent.slice(2);
            var formdata = new FormData();

            var arr = document.getElementsByClassName('cartsid');
            var cids = [];

            for(let i= 0; i<=arr.length-1; i++){
           // console.log(arr[i].value);
             cids.push(arr[i].value);

            }


            var valcids = JSON.stringify(cids);



            if (val == 'online') {

                if ($('#proof').get(0).files.length != 0) {

                    var file_data = $('#proof').prop('files')[0]; //Fetch the file

                    formdata.append("payment_method", "online");
                    formdata.append("payment_amount", tp);
                    formdata.append("cids", valcids);
                    formdata.append('file', file_data);


                    $.ajax({
                        dataType: 'script',
                        url: "payment.php",
                        type: "POST",
                        data: formdata,
                        processData: false,
                        contentType: false
                    }).done(function(data2) {

                        if (data2 == '0') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Payment Sent',
                                showConfirmButton: false,
                                timer: 1000,
                                allowOutsideClick: false
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $('#checkout-modal').modal('hide');

                                    window.location.reload();
                                }
                            })

                        } else {
                            Swal.fire({
                            icon: 'error',
                            title: 'Please select different payment method',
                            showConfirmButton: true,
                            allowOutsideClick: true
                        })
                        }

                    });


                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Proof of Payment missing',
                        showConfirmButton: false,
                        timer: 1000,
                        allowOutsideClick: false
                    }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $('#checkout-modal').modal('hide');

                                    window.location.reload();
                                }
                            })
                }



            } else if (val == 'counter') {
                formdata = new FormData();
                formdata.append("payment_method", "counter");
                formdata.append("payment_amount", tp);
                formdata.append("cids", valcids);



                $.ajax({
                    dataType: 'script',
                    url: "payment.php",
                    type: "POST",
                    data: formdata,
                    processData: false,
                    contentType: false
                }).done(function(data2) {

                    console.log(data2);

                    if (data2 == '0') {
                        Swal.fire({
                            icon: 'success',
                            title: 'You can now proceed to pay in counter',
                            showConfirmButton: false,
                            timer: 1500,
                            allowOutsideClick: false
                        }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $('#checkout-modal').modal('hide');

                                    window.location.reload();
                                }
                            })

                    } else {


                        Swal.fire({
                            icon: 'error',
                            title: 'Please select different payment method',
                            showConfirmButton: true,
                            allowOutsideClick: true
                        })
                    }

                });
            }



        });
    </script>
</html>
<style>
      #topbar{
    background: radial-gradient(
    56.58% 56.58% at 50.09% 39.71%,
    #ed5450 27.08%,
    #bd1e2e 100%
  );
  }
    
    .eyy{
      font-size:10px;
    }

       .ariban{
        color:white;
    }
    .ariban li a:hover{
        color:white;
        border-bottom: 3px solid #00f;
    }

    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');

    .table-responsive::-webkit-scrollbar 
    {
        display: none;
    }
    .d-flex::-webkit-scrollbar 
    {
        display: none;
    }
        .order .card{position: relative;background: #fff;box-shadow: 0 0 15px rgba(0, 0, 0, .1)}
         .cart{line-height: 1}.icon{background-color: #eee;width: 40px;height: 40px;
         display: flex;justify-content: center;align-items: center;border-radius: 50%}
         .pic{width: 70px;height: 90px;border-radius: 5px}td{vertical-align: middle}
         .red{color: #fd1c1c;font-weight: 600}.b-bottom{border-bottom: 2px dotted black;padding-bottom: 20px}p{margin: 0px}table input{width: 40px;border: 1px solid #eee}input:focus{border: 1px solid #eee;outline: none}.round{background-color: #eee;height: 40px;width: 40px;border-radius: 50%;display: flex;align-items: center;justify-content: center}.payment-summary .unregistered{width: 100%;display: flex;align-items: center;justify-content: center;background-color: #eee;text-transform: uppercase;font-size: 14px}.payment-summary input{width: 100%;margin-right: 20px}

            .red{color: #fd1c1c}.del{width: 35px;height: 35px;object-fit: cover}.delivery .card{padding: 10px 5px}.option{position: relative;top: 50%;display: block;cursor: pointer;color: #888}.option input{display: none}.checkmark{position: absolute;top: 40%;left: -25px;height: 20px;width: 20px;background-color: #fff;border: 1px solid #ccc;border-radius: 50%}.option input:checked~.checkmark:after{display: block}.option .checkmark:after{content: "\2713";width: 10px;height: 10px;display: block;position: absolute;top: 30%;left: 50%;transform: translate(-50%, -50%) scale(0);transition: 200ms ease-in-out 0s}.option:hover input[type="radio"]~.checkmark{background-color: #f4f4f4}.option input[type="radio"]:checked~.checkmark{background: #ac1f32;color: #fff;transition: 300ms ease-in-out 0s}.option input[type="radio"]:checked~.checkmark:after{transform: translate(-50%, -50%) scale(1);color: #fff}
</style>
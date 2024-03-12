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
    <title>Product Reviews | Trans-Master APARORS</title>
    <link rel="shortcut icon" href="pictures/logo.png" type="image/x-icon">
</head>
<nav class="navbar navbar-expand-lg navbar-light sticky-top" id="topbar">
    <div class="container-fluid text-white">

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
<section style="background-color: #eee;">
  <div class="container py-5">
  <?php   
                        $cusid = $_SESSION['Id'];
                        $sql="SELECT  rated_id, product.product_id, product_name, quantity,category.category_name,price, description,image,rated_points,rate_status from rated_product 
                        INNER JOIN product ON product.product_id = rated_product.product_id 
                        INNER JOIN category ON category.category_id = product.category_name where  customer_id='$cusid' and rate_status = 'rated'";
                        $res = $con->query($sql);
                        if (!$res) {
                        echo 'error';
                        }   while ($row = mysqli_fetch_object($res)) {
                            
                            $id = $row->rated_id;
                            $prod = $row->product_id;
                            $img = $row->image;
                            $name = $row->product_name;
                            $description = $row->description;
                            $qty = $row->quantity;
                            $cat = $row->category_name;
                            $price = $row->price;
                            $total =  $qty*$price;
                            $rate =  $row->rated_points;
                            $stat =  $row->rate_status;


                            ?>
    <div class="row justify-content-center mb-3">
      <div class="col-md-12 col-xl-10">
        <div class="card shadow-0 border rounded-3">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                <div class="bg-image hover-zoom ripple rounded ripple-surface">
                  <img src="product_image/<?php echo $img; ?>"
                    class="w-100" style="height:200px; width:50px;"/>
                  <a href="#!">
                    <div class="hover-overlay">
                      <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-6">
                <h2 class="text-danger fw-bold"><?php echo $name; ?></h2>
                <div class="d-flex flex-row">
                 
                  <div class="text-warning mb-1 me-2 mt-2">  
                   <span><?php echo $rate; ?></span>
                    <i class="fa fa-star"></i>

                  </div>
                </div>
                <div class="mt-2 mb-0 text-muted small">
                  <span>Category:</span>
                  <span class="text-primary"> <?php echo $cat; ?> </span>
                </div>
                <p class="text-truncate mb-4  mt-3 mb-md-0">
                 Description: <?php echo $description; ?>
                  </p>
              </div>
              <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                <div class="d-flex flex-row align-items-center mb-1">
                  <h5 class="mb-1 me-1">₱<?php echo''.number_format($total, 2); ?></h5  >
                </div>
                <h6 class="text-dark">Price:  <span class="text-danger"><s>₱ <?php echo ''.number_format($price, 2); ?></s></span></h6>
                <h6 class="text-muted">Quantity: <?php echo $qty; ?></h6>
                <h6 class="text-success">Status: <?php echo $stat; ?></h6>
                <div class="d-flex flex-column">
                  <a href="Home-view-product.php?pid= <?php echo $prod; ?>" > <button class="btn btn-outline-danger btn-sm mt-5" type="button" style="width:100%;">
                  Details
                  </button>
                        </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
                        }
                                           
                    ?>
  </div>
</section>
</body>
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

</style>
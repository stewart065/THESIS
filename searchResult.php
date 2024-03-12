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
    <title>Search Result  | Trans-Master APARORS</title>
    <link rel="shortcut icon" href="pictures/logo.png" type="image/x-icon">
</head>
<body>
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
                <form class="d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="searchResult.php" method="GET">
                <div class="input-group">

              
                    <input class="form-control" type="text"  name="searchText" id="searchme" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button type="submit" name="search" value="Filter" class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
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
                <li > <a href="" class="nav-link ariban"><i class="fa-solid fa-message"></i></a></li>
                <li class="dropdown">
                    <a class="nav-link ariban fw-bold dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">       
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    </a>
                    <ul class="dropdown-menu justify-content-left ">
                        <li> <a href="Home_history_product.php"><button class="dropdown-item" type="button">Product</button></a></li>
                        <li><button class="dropdown-item" type="button">Repair</button></li>
                    </ul>
                </li>
                <?php              
                  $sql ="SELECT concat (firstname,' ',lastname) as `name` , profile FROM users WHERE customer_id =".$_SESSION['Id'];  
                  $search_result = $con->query($sql);
                   if (!$search_result) {
                    echo 'error';
                   }
                 while ($row = mysqli_fetch_object($search_result)) { 
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
                        <li><a class="dropdown-item text-dark" href="logout.php?logout">Logout</a></li>
                    </ul>
                </li>
                <?php }?> 
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid mt-3">

                <p class="text-left h4">Search results for <?php if(isset($_GET['searchText']))
                { echo $_GET['searchText']; } 
                ?></p>
    <div class="row row-cols-1 row-cols-md-6 g-2 g-md-3 mb-5">
    <?php

                  if(isset($_GET['searchText'])){
                    $ser = $_GET['searchText'];

             $sql = "SELECT product .product_id, product_name,price,quantity,sold,image, AVG(rated_product.rated_points) as rate_points  FROM product 
             LEFT JOIN rated_product ON product.product_id = rated_product.product_id 
             where product_name LIKE '%$ser%' AND quantity != 0 GROUP BY product_name ORDER BY rate_points DESC;";   
            $res  = $con->query($sql);
            if(!$res){
                echo "error";
            } 
            while ($row = mysqli_fetch_object($res)) {
            $prodid = $row->product_id;
            $img = $row->image;
            $name = $row->product_name;
            $qty = $row->quantity;
            $sold = $row->sold;
            $price = $row->price;
            $points = $row->rate_points;
            ?> 
        <a href="home_view_product.php?pid= <?php echo $prodid; ?>">
          <div class="col">
              <div class="border bg-light p-2 " id="card">
                  <div class="text-div">
                      <figure><img src="product_image/<?php echo $img; ?>" alt="" style="width:100%; height:200px;"></figure>
                      <p class=" text-danger fw-bold text-center"><?php echo $name; ?></p>
                      <div class="bg-light d-flex justify-content-between">
                      <div class=" text-warning">
                        <label for="" id="asd"><?php echo $points;?></label>
                        <i class="fa fa-star"></i>
                      </div>
                          <div class="text-muted">Sold:<span class="fw-bold"><?php echo $sold; ?></span></p></div>
                      </div>
                  </div>
              </div>
          </div>
        </a>
        <?php }} 
        else{

          header("Location: Home.php");
        }?>
    </div>
</div>


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- <footer class="text-center text-lg-start bg-dark  text-white">
  <section class="d-flex justify-content-center justify-content-lg-between p-4 ">
  </section>
  <section class="">
    <div class="container text-center text-md-start mt-3">
      <div class="row mt-3">
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            CEBU ROOSEVELT MEMORIAL COLLEGES 
          </h6>
          <p><i class="fas fa-home me-3"></i> 	San Vicente St., Bogo City, Cebu</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            crmc.enrollment@gmail.com
          </p>
          <p><i class="fas fa-phone me-3"></i> 	434-8488</p>
        </div>
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
          OUR PHOTOS
          </h6>
          <p>
          <img src="pictures/car.jpg" alt="" style="width:80px; height:80px;">
          </p>
          <p>
          <img src="pictures/car.jpg" alt="" style="width:80px; height:80px;">
          </p>
          <p>
          <img src="pictures/car.jpg" alt="" style="width:80px; height:80px;">
          </p>
        </div>
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
          Links
          </h6>
          <p>
            <a href="home.php" class="text-reset">Home</a>
          </p>
          <p>
            <a href="#!" class="text-reset">About Us</a>
          </p>
          <p>
            <a href="event.php" class="text-reset">Events</a>
          </p>
          <p>
            <a href="teachers.php" class="text-reset">Teachers</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Gallery</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Contact Us</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Others</a>
          </p>  
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <h6 class="text-uppercase fw-bold mb-4">Connect With Us:</h6>
            <div class="icon">
                <a class="btn btn-outline-success btn-floating m-1" href="https://web.facebook.com/CRMC.ElementaryInc" role="button">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="btn btn-outline-success btn-floating m-1" href="#!" role="button">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="btn btn-outline-success btn-floating m-1" href="crmc_elem8399@yahoo.com" role="button">
                    <i class="fab fa-google"></i>
                </a>
                <a class="btn btn-outline-success btn-floating m-1" href="#!" role="button">
                    <i class="fab fa-instagram"></i>
                </a>
            </div> 
        </div> 
      </div>
    </div>
  </section>
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    <a class="text-reset fw-bold" href="https://web.facebook.com/?_rdc=1&_rdr">CCS OJT</a>
  </div>
</footer> -->
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
 
  a{
    text-decoration:none; 
  }
       .ariban{
        color:white;
    }
    .ariban li a:hover{
        color:white;
        border-bottom: 3px solid #00f;
    }

</style>

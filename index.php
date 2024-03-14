<?php
session_start();
include 'config.php';

$sql = "SELECT COUNT(employee_id) as emnum FROM employee";
$res  = $con->query($sql);
if (!$res) {
  echo "error";
}
while ($row = mysqli_fetch_object($res)) {
  $num = $row->emnum;
}

$sql1 = "SELECT COUNT(customer_id) as user FROM users WHERE Type='Customer'";
$res  = $con->query($sql1);
if (!$res) {
  echo "error";
}
while ($row = mysqli_fetch_object($res)) {
  $user = $row->user;
}

$sql2 = "SELECT COUNT(product_id) as prod FROM product ";
$res  = $con->query($sql2);
if (!$res) {
  echo "error";
}
while ($row = mysqli_fetch_object($res)) {

  $prod = $row->prod;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="css/newStyleNavBar.css">

<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="css/owl.css">
<link rel="stylesheet" type="text/css" href="css/index.css">

  <title>Landing page | Trans-Master APARORS</title>
  <link rel="shortcut icon" href="pictures/logo.png" type="image/x-icon">
</head>

<nav class="navbar navbar-expand-lg " id="nav-top">
  <div class="container-fluid">
    <a class="navbar-brand text-light">
      <img src="pictures/logo.png" alt="" width="50" height="50" class="">
       <a style="text-decoration: none; color:white; font-size: 23px;" href="index.php"><b class="">TRANS-MASTER</b></a>
      
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mx-auto" style="font-size:18px;">
      </ul>


      <ul class="navbar-nav sm-icons mr-0">

        <li class="nav-item">
          <a class="nav-link text-white" href="index.php">Home</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-white" href="">About</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-white" href="">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="signup.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="login.php"> Login</a>
        </li>

      </ul>
    </div>
  </div>
</nav>

<body>

<div class="title-container">
<div class="homepage-img"><img class="img-bg" src="pictures/homepage-title-bg.jpg" alt=""></div>
<div class="label-title">
  <p class="trans-master">
    <span class="text-wrapper">Trans-Master</span>
    <span class="text-wrapper-2">Enterprises &amp; <br> Services Shop</span>
  </p>
</div>
<div class="label-sub">
  <p class="wrapper-sub">Qualified Autoparts and Products</p>
</div>


<a href="login.php"><button class="reserve-btn">Reserve Now</button></a>
</div>


<!-- --------------------end -->
<style>
  .hover-zoom:hover .custom-card-img {
      transform: scale(1.1); /* You can adjust the zoom level as needed */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Add more shadow on hover */
  }
  .hover-zoom .custom-card-img {
      transform: scale(0.8); /* Initial zoom-out level, adjust as needed */
  }
  </style>
  <div class="container-fluid mt-5">
    <!-- <p class="text-center text-danger">// OUR BEST PRODUCTS //</p> -->
    <h1 class="text-center text-danger mb-5"><b>Our Products</b></h1>
    <div class="row row-cols-1 row-cols-lg-5 g-2 g-lg-3">
      <?php
      $sql = "SELECT product .product_id, product_name,price,description,brand,quantity,sold,image, AVG(rated_product.rated_points) as rate_points  FROM product 
            LEFT JOIN rated_product ON product.product_id = rated_product.product_id 
            where  quantity != 0  OR rate_status = 'RATED'    GROUP BY product_name ORDER BY rate_points DESC LIMIT 5;";
      $res  = $con->query($sql);
      if (!$res) {
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
        $description = $row->description;
        $brand = $row->brand;
      ?>
        <a href="login.php?pid= <?php echo $prodid; ?>">
        <div class="col">
    <div class="card custom-card border-0 shadow-lg hover-zoom" style="background-color: rgba(169, 169, 169, 0.65);">
        <div class="img-container overflow-hidden">
            <img src="product_image/<?php echo $img; ?>" alt="<?php echo $name; ?>" class="card-img-top custom-card-img shadow" style="height: 200px; object-fit: cover; transition: transform 0.3s ease-in-out;">
        </div>
        <div class="card-body">
            <h4 class="card-title product-label" style="color: black;">Product: <?php echo $name;?></h4>
            <p class="card-text " style="color: black;">Brand: <?php echo $brand; ?></p>
            <p class="card-text product-description-label" style="color: black;">Description: <br> <?php echo $description; ?></p>
        </div>
        <div class="card-footer bg-red d-flex justify-content-between align-items-center shadow">
            <div class="rating text-warning">
                <label for="asd" class="fw-bold">Rating:</label>
                <span class="fw-bold"><?php echo $points; ?></span>
                <i class="fa fa-star"></i>
            </div>
            <div class="text-black">Sold: <span class="fw-bold"><?php echo $sold; ?></span></div>
        </div>
    </div>
</div>

        </a>
      <?php } ?>
    </div>
  </div>
  <br>
  <h1 class="text-center textmil text-danger mb-5"><b>Create Your Reservation</b></h1>
  <div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">

      <div class="row gx-5">
        <div class="col-lg-6 py-5">
          <div class="py-5">
            <h1 class="text-white fw-bold mb-4">Qualified Car Repair Service Provider</h1>
            <p class="text-white mb-0">We are a qualified car repair service shop with years of
              experience and a team of skilled technicians. From routine maintenance to complex repairs,
              we handle it all with precision and professionalism. Our commitment is to provide exceptional service,
              ensuring your vehicle's optimal performance and your complete satisfaction.
            </p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="bg-danger h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn" data-wow-delay="0.6s">
            <h1 class="text-white mb-4">Book For A Service</h1>
            <form>
              <div class="row g-3">
                <div class="col-12 col-sm-6">
                  <input type="text" class="form-control border-0" placeholder="Your Name" style="height: 55px;">
                </div>
                <div class="col-12 col-sm-6">
                  <input type="email" class="form-control border-0" placeholder="Your Email" style="height: 55px;">
                </div>
                <div class="col-12 col-sm-6">
                  <select class="form-select border-0" style="height: 55px;">
                    <option selected disabled>Choose...</option>
                    <option>Hatchback</option>
                    <option>Sedan</option>
                    <option>SUV</option>
                    <option>MUV</option>
                    <option>Coupe</option>
                    <option>Convertible</option>
                    <option>Pickup</option>
                    <option>Multicab</option>
                    <option>Truck</option>
                  </select>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="date" id="date1" data-target-input="nearest">
                    <input type="text" class="form-control border-0 datetimepicker-input" placeholder="Service Date" data-target="#date1" data-toggle="datetimepicker" style="height: 55px;">
                  </div>
                </div>
                <div class="col-12">
                  <textarea class="form-control border-0" placeholder="Special Request"></textarea>
                </div>
                <div class="col-12">
                  <a href="login.php" class="btn btn-primary w-100 py-3">Book Now</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section id="slider" class="w-100">
    <div class="container w-100">
      <h1 class="text-center text-danger ourStaffStyle"><b>OUR STAFF</b></h1>
      <div class="slider">
        <div class="owl-carousel">
          <?php
          $recent = 0;
          $display = mysqli_query($con, "SELECT employee_id, employee_profile, concat(employee_firstname,' ',employee_lastname) as name, employee_position FROM employee");
          while ($row = mysqli_fetch_assoc($display)) {
          ?>
            <div class="slider-card">
              <!-- <div class="d-flex justify-content-center align-items-center mb-1">
                <img src="profiles/<?php echo $row['employee_profile']; ?>" id="preImg">
              </div> -->

              <div class="container w-100">
                <div class="row">
                  <div class="col-3 containerForImage">
                    <img class="imageProfileContainer" src="profiles/<?php echo $row['employee_profile']; ?>" id="preImg">
                  </div>
                  <div class="col-6 containerForDetails">
                    <p class="text-center mt-1 employeeName"><?php echo $row['name']; ?></p>
                    <?php
                    $category = "";
                    $r = 0;
                    $display2 = mysqli_query($con, "SELECT * FROM position WHERE position_id=" . $row['employee_position']);
                    ?>
                    <?php while ($row2 = mysqli_fetch_assoc($display2)) { ?>
                      <?php $r++;
                      $category = $row2['position_name']; ?>
                    <?php } ?>
                    <?php if ($r > 0) { ?>
                      <h6 class="text-center mb-4 positionName"><?php echo $category; ?></h6>
                    <?php } else { ?>
                      <small> <?php echo "N/A"; ?></small>
                    <?php } ?>
                  </div>
                </div>
              </div>

            </div>
          <?php $recent = $row['employee_id'];
          } ?>
        </div>
      </div>
    </div>
  </section>
</body>
<footer class="bg-dark text-center text-white">
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <div class="me-5 d-none d-lg-block">
      <span>Get connected with us on social networks:</span>
    </div>
    <div>
      <a href="login.php" class="me-4 text-reset hover">
        <i class="fa fa-facebook-f"></i>
      </a>
      <a href="login.php" class="me-4 text-reset hover">
        <i class="fa fa-twitter"></i>
      </a>
      <a href="login.php" class="me-4 text-reset hover">
        <i class="fa fa-google"></i>
      </a>
      <a href="login.php" class="me-4 text-reset hover">
        <i class="fa fa-instagram"></i>
      </a>
      <a href="login.php" class="me-4 text-reset hover">
        <i class="fa fa-linkedin"></i>
      </a>
      <a href="login.php" class="me-4 text-reset hover">
        <i class="fa fa-github"></i>
      </a>
    </div>
  </section>
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <div class="row mt-3">
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4 text-danger">
            <img src="pictures/logo.png" alt="" width="40" height="40" class="d-inline-block align-text-top">
            TRANS-MASTER
          </h6>
          <p>
            Trans-master Enterprises and Service Shop, this establishment is one of the most famous for vehicle repair in Bogo City.
          </p>
        </div>
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            Services Offers
          </h6>
          <p>
            <a href="login.php" class="text-reset">Autoparts Product</a>
          </p>
          <p>
            <a href="login.php" class="text-reset">Aircon cleaning/repair</a>
          </p>
          <p>
            <a href="login.php" class="text-reset">Underchasis repair</a>
          </p>
          <p>
            <a href="login.php" class="text-reset">Change Oil</a>
          </p>
          <p>
            <a href="login.php" class="text-reset">Cold patch vulcanizing</a>
          </p>
        </div>
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            Other links
          </h6>
          <p>
            <a href="#!" class="text-reset">Pricing</a>
          </p>
          <p>
            <a href="login.php" class="text-reset">Blog</a>
          </p>
          <p>
            <a href="login.php" class="text-reset">Features</a>
          </p>
          <p>
            <a href="login.php" class="text-reset">Settings</a>
          </p>
          <p>
            <a href="login.php" class="text-reset">Help</a>
          </p>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <h6 class="text-uppercase fw-bold mb-4">Contact Details</h6>
          <p><i class="fa fa-home me-3"></i> National Highwayy, Bogo City, Cebu, Philippines, 6010</p>
          <p>
            <i class="fa fa-envelope me-3"></i>
            transmaster@gmail.com
          </p>
          <p><i class="fa fa-phone-square me-3" aria-hidden="true"></i> 09127298757</p>
          <p><i class="fa fa-phone me-3"></i> 09557324403</p>
        </div>
      </div>
    </div>
  </section>
  <hr>
  Maintenance by Reymon Ariban
  © 2023 Copyright:
  <a class="text-white" href="https://www.facebook.com/reymon.ariban">TRANS-MASTER-aparors.com</a>

</footer>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script> -->
<script src="js/owl.carousel.min.js"></script>
<script src="js/owl.js"></script>

</html>
<style>
  a {
    text-decoration: none;
  }


  .hover {
    text-decoration: none;
    padding: 8px;
  }

  .hover:hover {
    width: 50px;
    height: 50px;
    border-radius: 120px;
    background: radial-gradient(56.58% 56.58% at 50.09% 39.71%,
        #ed5450 27.08%,
        #bd1e2e 100%);
  }

  h2 {
    margin-top: 30px;
    margin-bottom: 30px;
    text-align: center;
  }

  #card {
    height: 340px;
  }

  .text-div {

    width: 100%;
    height: 40px;
    line-height: .5 !important;
    /* margin-top: 20px; */

  }

  .product-name {
    margin-top: 25px;
    font-size: 18px;
    font-weight: bold;
    height: 30px;
    width: 100%;
    line-height: normal;
    overflow: hidden;
    text-align: center;
  }

  .title {
    color: rgb(218, 91, 32);
    font-size: 12px;
    text-align: center;
  }

  figure {
    margin: 0;
    padding: 0;
    background: #fff;
    overflow: hidden;
  }

  .text-div img {
    -webkit-transform: scale(1);
    transform: scale(1);
    -webkit-transition: .3s ease-in-out;
    transition: .3s ease-in-out;
  }

  .text-div:hover img {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
  }

  .viewmore {
    border-radius: 18px;
    /* width:50%; */
    background-color: rgb(22, 141, 58);
    color: white;
  }

  .viewmore:hover {
    border-color: rgb(22, 141, 58);
    color: rgb(22, 141, 58);
    background-color: none;
  }


  #nav-top {
    background: radial-gradient(56.58% 56.58% at 50.09% 39.71%,
        #ed5450 27.08%,
        #bd1e2e 100%);
  }

  #logoname {
    color: white;
  }

  #ul-li {
    font-size: 18px;
  }


  .nav-item a:hover {
    color: white;
    border-bottom: 3px solid white;

  }

  .ourStaffStyle {
    font-family: "Montserrat", sans-serif !important;
  }

  .slider-card {
    height: 25vh;
    width: 100% !important;

    /* width: 100px; */
    font-family: "Montserrat", sans-serif !important;

    /* visibility: hidden !important; */

    background-color: white !important;
    border-radius: 25px !important;
  }

  .slider-card .employeeName .positionName {
    /* visibility: hidden !important; */
  }

  .imageProfileContainer {
    height: 100px !important;
    width: 100px !important;

    /* padding-top: 10px; */
    justify-content: center;
    text-align: center;

    margin-top: 25px;

    border-radius: 50% !important;
    opacity: 0.9 !important;

    overflow: hidden;
    /* Ensure the image stays within the circle */
    border: 5px solid white;
    /* Set your desired border color */
  }

  .slider .owl-item.active.center .slider-card {
    transform: scale(1.15);
    opacity: 1;
    background: #bd1e2e !important;
    color: #fff;

    /* visibility: visible !important; */

    filter: drop-shadow(16px 16px);
  }

  .slider .owl-item.active.center .slider-card .positionName {
    background-color: white;
    border-radius: 20px;
    color: black;
  }

  .containerForDetails {
    justify-content: center;
    text-align: center;

    margin-top: 25px;
    margin-left: 50px !important;
  }

  .employeeName {
    font-size: 27px;
  }

  .positionName {
    font-size: 13px;
  }

  /* @media screen and (min-width: 150%) {
    .employeeName {
    font-size: 10px;
  }

  .positionName {
    font-size: 10px;
  }
  } */
</style>
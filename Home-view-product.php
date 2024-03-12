<?php
    session_start();
    require 'config.php';
  
    if(isset($_GET['pid'])){

      $id = $_GET['pid'];
      $userid = $_SESSION['Id'];

      $sql = "SELECT product.*, category.category_name as cat FROM product INNER JOIN category on product.category_name = category.category_id where  product.product_id = ".$_GET['pid'];
      $sql = "SELECT *, 
      CASE when AVG(rated_product.rated_points) = 0.0 
          then 'NA'   
          else AVG(rated_product.rated_points)
          END
          as rate_points
          FROM product 
          INNER JOIN rated_product ON product.product_id = rated_product.product_id
           where product.product_id= '$id' AND rate_status = 'RATED'";      
      $res  = $con->query($sql);
      
                  if(!$res){
                      echo "error";
                  }
                  
                  while($row = mysqli_fetch_object($res)){
                          $id_prod = $row->product_id;
                          $name = $row->product_name;
                          $description = $row->description;
                          $price = $row->price;
                          $cat = $row->category_name;
                          $quantity = $row->quantity;    
                          $img = $row->image;    
                            $points = $row->rate_points;
                  }
              }
              else{
          header('Location:Home.php');
      
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
   
    <title>View Product | Trans-Master APARORS</title>
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
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
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
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <?php
                    $sql = "SELECT product_name,description, price, product.product_id, image FROM product  where quantity != 0 AND product.product_id = '$id_prod' ;";
                    $res  = $con->query($sql);
                    ?>
                    <div class="col-md-6">
                        <div class="images p-3 ">
                            <div class="text-center p-4 "> <img id="main-image" src="product_image/<?php  echo $img; ?>" width="250px" /> </div>
                            <!-- <div class="thumbnail text-center"> <img onclick="change_image(this)" src="https://i.imgur.com/Rx7uKd0.jpg" width="70"> <img onclick="change_image(this)" src="https://i.imgur.com/Dhebu4F.jpg" width="70"> </div> -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="d-flex justify-content-between align-items-center"> 
                            </div>
                            <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand">Ratings:<?php echo " ".number_format($points,1);?> <span class="fa fa-star checked"></span></span>
                                <h5 class="text-uppercase"><?php echo   $name; ?></h5>
                                <div class="price d-flex flex-row align-items-center"> <span class="act-price"><?php echo "₱ ". number_format($price,2);?></span>
                                    <!-- <div class="ml-2"> <small class="dis-price">$59</small> <span>40% OFF</span> </div> -->
                                   
                                </div>
                                <h6><?php
                                    $sq="SELECT * from category where category_id=".$cat;        
                                    $res  = $con->query($sq);
                                                
                                            while($row = mysqli_fetch_object($res)){
                                        echo ' Category: '. $row->category_name;
                                            }
                                    $cat; ?>
                                </h6>
                            </div>
                            <p class="about">Description: <?php echo   $description; ?>.</p>
                            <p class="about"><?php echo   'Available Stocks: '.$quantity;  ?></p>
                            <!-- <div class="sizes mt-5">
                                <h6 class="text-uppercase">Size</h6> <label class="radio"> <input type="radio" name="size" value="S" checked> <span>S</span> </label> <label class="radio"> <input type="radio" name="size" value="M"> <span>M</span> </label> <label class="radio"> <input type="radio" name="size" value="L"> <span>L</span> </label> <label class="radio"> <input type="radio" name="size" value="XL"> <span>XL</span> </label> <label class="radio"> <input type="radio" name="size" value="XXL"> <span>XXL</span> </label>
                            </div> -->
                            <form method="post">
                                <input type="text" class="prod-id" hidden value="" name="product_id">
                                <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping">Quantity</span>
                                <input type="number" id="typeNumber" class="form-control" min="1" max="<?php echo $quantity;?>" name="inputed" required/>
                                </div>                     
                                <div class="cart mt-4 align-items-center"> <button  type="submit" class="btn btn-danger text-uppercase mr-2 px-4" name="addtocart" id="addcart-button">Add to cart</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "config.php";
  $sqlgetall ="SELECT concat(firstname,' ',lastname) username, rated_points, `comment`, media FROM rated_product 
  INNER JOIN users ON users.customer_id = rated_product.customer_id WHERE rated_product.comment IS NOT NULL and media IS NOT NULL AND product_id = '$id' AND rate_status != 'pending'"; 
 $result = $con->query($sqlgetall);  
$numrows = mysqli_num_rows($result);
if($numrows != 0){
  ?>

  <div class="container" id="review-container">
    <p class="h4">Reviews</p>
    <hr> 
    <div class="container">
       <?php   
     while($row = mysqli_fetch_object($result)){
      ?>
      <div class="container" id="comment-div">
        <p class="h6">  <?php echo $row->username ;   ?></p>
        <p>

          <?php echo $row->rated_points; ?>
        <span class="fa fa-star checked"></span>
        </p>
        <p class="h7"> <?php echo $row->comment;   ?> </p>
            <div class="col" >
            <img src="comment_media/<?php echo $row->media;   ?> " alt="Media Image" class="image-show" style="width:100px; height:100px;">
          </div>
        <!-- <a  href="" class="view-comment">See full comment</a> -->
        <hr>                                       
      </div>
      <br>
       <?php
    }
  }
  ?>
    </div>
  </div>
</div>
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
.checked {
  color: orange;
}
</style>
<?php

if(isset($_POST['addtocart']))
{
$quan = $_POST['inputed'];

$sqlinsert = "INSERT INTO productcart (pid, qty, customerid) VALUES ('$id', '$quan', '$userid')";
$sqlresult = mysqli_query($con, $sqlinsert);

if($sqlresult)
{
  echo '<script>window.location.href = "Home.php";</script>';
}
}
 
?>
</body>
</html>
<style>
       .ariban{
        color:white;
    }
    .ariban li a:hover{
        color:white;
        border-bottom: 3px solid #00f;
    }

    /* body{
        background-color: #000
        } */
    .card{border:none}.product{background-color: #eee}.brand{font-size: 13px}.act-price{color:red;font-weight: 700}.dis-price{text-decoration: line-through}.about{font-size: 14px}.color{margin-bottom:10px}label.radio{cursor: pointer}label.radio input{position: absolute;top: 0;left: 0;visibility: hidden;pointer-events: none}label.radio span{padding: 2px 9px;border: 2px solid #ff0000;display: inline-block;color: #ff0000;border-radius: 3px;text-transform: uppercase}label.radio input:checked+span{border-color: #ff0000;background-color: #ff0000;color: #fff}.btn-danger{background-color: #ff0000 !important;border-color: #ff0000 !important}.btn-danger:hover{background-color: #da0606 !important;border-color: #da0606 !important}.btn-danger:focus{box-shadow: none}.cart i{margin-right: 10px}
</style>
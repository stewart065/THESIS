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
    
    <title>To Rate Product | Trans-Master APARORS</title>
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
<div class="container mt-4">
    <div class="row px-md-4 px-2 pt-4 ">
        <p class="pb-2 fw-bold">Write a review</p>
    <?php   
  
  $cusid = $_SESSION['Id'];
  
  $sql="SELECT  rated_id, product_name,CONCAT(firstname, lastname) AS name ,image,quantity,price, description from rated_product 
  INNER JOIN product ON product.product_id = rated_product.product_id
   INNER JOIN users ON users.customer_id = rated_product.customer_id
    where rated_product.customer_id= '$cusid' AND rate_status = 'pending'";
  $res = $con->query($sql);
  if (!$res) {
  echo 'error';
  }   while ($row = mysqli_fetch_object($res)) {
      
      $id = $row->rated_id;
      $cust = $row->name;
      $img = $row->image;
      $quantity = $row->quantity;
      $description = $row->description;
      $price = $row->price;
      $prodname = $row->product_name;

?>
        <div class="col-md-12 mb-2 ">
            <div class="card">
                <div class="table-responsive px-md-4 px-2 pt-3">
                        <table class="table table-borderless" id="table_id" >
                            <tbody>
                                
                                <tr >
                                <td hidden><?php echo $id; ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div> <img class="pic" src="product_image/<?php echo $img; ?>" alt=""> </div>
                                            <div class="ps-3 d-flex flex-column justify-content">
                                                <p class="fw-bold"><?php echo $prodname; ?><span class="ps-1"></p> <small class=" d-flex"> <span class=" text-muted"></span> </small> <small class=""> <span class=" text-muted">Stocks:</span> <span class=" fw-bold"><?php echo $quantity; ?></span> </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <p class="pe-3"><span class="red">₱ 492,522.00</span></p>
                                        </div>
                                    </td>
                                   
                                    <td>
                                        <div class="d-flex align-items-center">            
                                            <button class="btn btn-outline-danger rate"  rateprod="<?php echo $id ?>"id="btn-rate-modal" data-bs-toggle="modal" data-bs-target="#ModalRateForm">Rate</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
              
            </div>
        </div>
        <?php
                                    }
                                                    
                                ?>
    </div>
</div>
<div class="modal fade" id="ModalRateForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Write a review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="rating.php" class="review-form"  enctype="multipart/form-data" >
                        <input type="number" name="prodid" id="prodid"  hidden>
                        <input type="number" name="userid" id="userid" value="<?php echo $cusid?>" hidden>
                        
                            <div class="mb-3">
                                <fieldset class="rating" required id="field">
                                <input type="radio" id="star5" name="rating"  value="5"/><label for="star5" class="full" title="Awesome"></label>
                                <input type="radio" id="star4.5" name="rating"  value="4.5"/><label for="star4.5" class="half"></label>
                                <input type="radio" id="star4" name="rating"   value="4"/><label for="star4" class="full"></label>
                                <input type="radio" id="star3.5" name="rating"   value="3.5"/><label for="star3.5" class="half"></label>
                                <input type="radio" id="star3" name="rating"   value="3"/><label for="star3" class="full"></label>
                                <input type="radio" id="star2.5" name="rating"   value="2.5"/><label for="star2.5" class="half"></label>
                                <input type="radio" id="star2" name="rating" value="2"/><label for="star2" class="full"></label>
                                <input type="radio" id="star1.5" name="rating"  value="1.5"/><label for="star1.5" class="half"></label>
                                <input type="radio" id="star1" name="rating"   value="1"/><label for="star1" class="full"></label>
                                <input type="radio" id="star0.5" name="rating"   value="0.5"/><label for="star0.5" class="half"></label>

                                </fieldset>
                            </div>
                            <br>
                            <div class="mb-3">
                                <h6>Attach an image or video</h6>
                                <input type="file" name="review_files" class="form-control" id="media" accept=".jpg, .jpeg, .png, .mp4" required>
                            </div>
                            <div class="mb-3">        
                                <textarea  name="review_comment" id="comment" placeholder="Your comment here...."  rows="4"  maxlength="200" required></textarea>                </div>
                                <div class="mb-3">
                                <input type="submit" value="Send Review" name="submit" class="btn btn-danger">            
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>



$('#table_id').on('click', 'td .rate', function (e) {

var currentRow = $(this).closest("tr");

var id = currentRow.find("td:eq(0)").text();

document.getElementById('prodid').value = id;


//alert(data);
});


</script>
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
         .red{color: #fd1c1c;font-weight: 600}.b-bottom{border-bottom: 2px dotted black;padding-bottom: 20px}p{margin: 0px}table input{width: 40px;border: 1px solid #eee}input:focus{border: 1px solid #eee;outline: none}.round{background-color: #eee;height: 40px;width: 40px;border-radius: 50%;display: flex;align-items: center;justify-content: center}.payment-summary .unregistered{width: 100%;display: flex;align-items: center;justify-content: center;background-color: #eee;text-transform: uppercase;font-size: 14px}.payment-summary input{width: 100%;margin-right: 20px}.payment-summary .sale{width: 100%;background-color: #e9b3b3;text-transform: uppercase;font-size: 12px;display: flex;justify-content: center;align-items: center;padding: 5PX 0}.red{color: #fd1c1c}.del{width: 35px;height: 35px;object-fit: cover}.delivery .card{padding: 10px 5px}.option{position: relative;top: 50%;display: block;cursor: pointer;color: #888}.option input{display: none}.checkmark{position: absolute;top: 40%;left: -25px;height: 20px;width: 20px;background-color: #fff;border: 1px solid #ccc;border-radius: 50%}.option input:checked~.checkmark:after{display: block}.option .checkmark:after{content: "\2713";width: 10px;height: 10px;display: block;position: absolute;top: 30%;left: 50%;transform: translate(-50%, -50%) scale(0);transition: 200ms ease-in-out 0s}.option:hover input[type="radio"]~.checkmark{background-color: #f4f4f4}.option input[type="radio"]:checked~.checkmark{background: #ac1f32;color: #fff;transition: 300ms ease-in-out 0s}.option input[type="radio"]:checked~.checkmark:after{transform: translate(-50%, -50%) scale(1);color: #fff}
         @import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css);


.rating-wrap{


	max-width: 480px;
	margin: auto;
	padding: 15px;
	box-shadow: 0 0 3px 0 rgba(0,0,0,.2);
	text-align: center;
}

.center{
	width: 162px; 
	margin: auto;
}

.center form{
	width: 100%;
	display: flex;
}


#rating-value{	
	width: 110px;
	margin: 40px auto 0;
	padding: 10px 5px;
	text-align: center;
	box-shadow: inset 0 0 2px 1px rgba(46,204,113,.2);
}

/*styling star rating*/
.rating{
	border: none;
	float: left;
}

.rating > input{
	display: none;
}

.rating > label:before{
	content: '\f005';
	font-family: FontAwesome;
	margin: 5px;
	font-size: 1.5rem;
	display: inline-block;
	cursor: pointer;
}

.rating > .half:before{
	content: '\f089';
	position: absolute;
	cursor: pointer;
}


.rating > label{
	color: #ddd;
	float: right;
	cursor: pointer;
}

.rating > input:checked ~ label,
.rating:not(:checked) > label:hover, 
.rating:not(:checked) > label:hover ~ label{
	color: #fffb21;
}

.rating > input:checked + label:hover,
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label,
.rating > input:checked ~ label:hover ~ label{
	color: #fffb21;
}


.review-form{
width: 100%;
height: fit-content;
display: block;
margin: 0 auto;
background-color: rgb(246, 246, 246);
padding: 5px;
border-radius: 5px;
border: .5px rgb(224, 224, 224) solid;
}

.review-form h5,h6{
float: left;

}

.mb-3:first-child{

width: 100%;

}

#comment{

width: 100%;
height: 100px;

}

#comment:focus{
  outline:none;
}
</style>
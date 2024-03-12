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


if(isset($_POST['submit'])){

    $first_name = $_POST['firstname'];
    $middle_name = $_POST['middlename'];
    $last_name = $_POST['lastname'];
    $birth_date = $_POST['birthdate'];
    $gender = $_POST['gender']; 
    $cellphone_number = $_POST['cpnumber']; 
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $province = $_POST['province'];
    $email = $_POST['email'];
    $username =  $_POST['username'];
    $password =  $_POST['password'];
    $profilepic = $_FILES['profilepicture']['name'] ;
    $file_size =$_FILES['profilepicture']['size'];
    $file_tmp =$_FILES['profilepicture']['tmp_name'];
    $file_type=$_FILES['profilepicture']['type'] ;
    
 if(empty($profilepic))
 {
    $profile_update="UPDATE users SET firstname ='$first_name',middlename='$middle_name', 
    lastname='$last_name',birthdate='$birth_date',gender='$gender',cpnumber='$cellphone_number', barangay='$barangay',
     municipality='$municipality', province='$province', email='$email',username='$username', pass_word= '$password',type='Customer' WHERE customer_id =".$_SESSION['Id'];  
 }
 else{
    $profile_update="UPDATE users SET profile ='$profilepic',firstname ='$first_name',middlename='$middle_name', 
    lastname='$last_name',birthdate='$birth_date',gender='$gender',cpnumber='$cellphone_number', barangay='$barangay',
    municipality='$municipality', province='$province', email='$email',username='$username', pass_word= '$password',type='Customer' WHERE customer_id =".$_SESSION['Id'];  
 }
       $res = mysqli_query($con, $profile_update);
 
       if($res){
         move_uploaded_file($file_tmp,"profiles/".$profilepic);
           header("Location: view-profile.php");
       }
       else{
       echo 'error';
       }   
 }
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>View Profile | Trans-Master APARORS</title>
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
                <form class="d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="Home.php" method="post">
                <div class="input-group">
                    <input class="form-control" type="text"  name="valueToSearch" id="searchme" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
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
                        <li><a class="dropdown-item text-dark" href="logout.php?logout'">Logout</a></li>
                    </ul>
                </li>
                <?php }?> 
            </ul>
        </div>
    </div>
</nav>
    <!-- -------------------- -->
 
    <div class="container rounded bg-white mt-5">
        
            <form action="" autocomplete="off" id="form" enctype="multipart/form-data" method="post">
            <?php              
       
            $select = mysqli_query($con,"SELECT * FROM users WHERE customer_id =".$_SESSION['Id']);   
        ?>
            <?php while($row = mysqli_fetch_assoc($select)){ ?>
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5 picture-src" src="profiles/<?php echo $row['profile'];?> "id="wizardPicturePreview" style="width:300px; height:300px;">
                     <input type="file" name="profilepicture" accept=".jpg,.jpeg,.png" id="wizard_picture" hidden>
                    <span class="font-weight-bold" id="name"><?php echo $row['firstname'];?>
                     <?php echo $row['lastname'];?></span>
                     <span class="text-black-50" id="mail"><?php echo $row['email'];?></span>
                     <span  id="add"><?php echo $row['barangay'];?>, <?php echo $row['municipality'];?>, <?php echo $row['province'];?></span>
                </div>
               
            </div>
           
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">    
                        <!-- <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                            <a href="user-page.php"><h6>Back to home</h6></a>
                        </div> -->
                        <h6 class="text-right text-danger" onclick="edit()" id="edit" style="cursor:pointer;">Edit Profile</h6>
                    </div>
                    <div class="row mt-2">
                      
                        <div class="col-md-4">
                            <label for="">First Name</label>
                            
                            <input type="text" class="form-control" name="firstname" id="fname" placeholder="First Name"  value="<?php echo $row['firstname'];?>" disabled>
                            
                        </div>
                        <div class="col-md-4">
                            <label for="">Middle Name</label>
                            <input type="text" class="form-control" name="middlename" id="mname" placeholder="Middle Name" value="<?php echo $row['middlename'];?>" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" name="lastname" id="lname"  placeholder="Last Name" value="<?php echo $row['lastname'];?>" disabled>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="">Birth Date</label>
                            <input type="date" class="form-control" name="birthdate" id="bday" value="<?php echo $row['birthdate'];?>" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Gender</label>
                            <select  class="form-control" name="gender" id="gender" disabled>
                                <option selected disabled>Gender</option>
                                <?php
                                $male = "";
                                $female = "";
                                
                                if($row['gender'] == "Male") {
                                    $male = "selected";
                                }
                                else
                                {
                                    $female = "selected";
                                }
                                
                                ?>
                                <option value = "male" <?php echo $male; ?>>Male</option>
                                <option value = "female" <?php echo $female; ?> >Female</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Cellphone number</label>
                            <input type="number" class="form-control" name="cpnumber" id="cpnum" placeholder="Cellphone number" value="<?php echo $row['cpnumber'];?>" disabled>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="">Barangay</label>
                            <input type="text" class="form-control"name="barangay"  id="barangay" placeholder="Barangay" value="<?php echo $row['barangay'];?>" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Municipality</label>
                            <input type="text" class="form-control" name="municipality" id="municipality" placeholder="Municipality" value="<?php echo $row['municipality'];?>" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Province</label>
                            <input type="text" class="form-control" name="province" id="province" placeholder="Province" value="<?php echo $row['province'];?>" disabled>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <label for="">Email Address </label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="<?php echo $row['email'];?>" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" id="uname" placeholder="Username" value="<?php echo $row['username'];?>" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="">Password</label>
                            <input type="text" class="form-control" name="password" id="pws" placeholder="Password" value="<?php echo $row['pass_word'];?>" disabled>
                        </div>
                    </div>
                    <div class="mt-5 text-right">
                        <button class="btn profile-button btn-outline-dark" type="button" id="cancel" hidden>Cancel</button>
                        <a href="view-profile.php">
                            
                            <button class="btn btn-outline-danger profile-button" id="save" type="submit" name="submit" value="submit" hidden >Save Changes</button>
                        </a>
                    </div>
                </div>
                            </form>
            </div>
        </div>
        <?php }?>  
    </div>
    <script src="js/edit-profile.js"></script>
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

        #container::-webkit-scrollbar 
        {
        display: none;
        }

    </style>
    <script>
        $(document).ready(function(){
        // Prepare the preview for profile picture
            $("#wizard_picture").change(function(){
            readURL(this);
            });
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                    reader.onload = function (e) {
                $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
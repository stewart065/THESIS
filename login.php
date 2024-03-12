<?php
    session_start();
    include 'config.php';

    if (isset($_POST['submit'])) {

        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $user_name = validate($_POST['Username']);
        $password = validate($_POST['Password']);

        if (empty($user_name) && empty($password)) {
            header("Location: login.php?error= username and password is required");
            exit();
        }else if(empty($user_name)){
            header("Location: login.php?error= username is required");
            exit();
        }
        else if(empty($password)){
            header("Location: login.php?error=Password is required");   
            exit();
        }  
        else{
            $sql = "SELECT * FROM `users` WHERE username='$user_name' AND pass_word='$password'";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['username'] === $user_name && $row['pass_word'] === $password) {
                    $_SESSION['user_name'] = $row['username'];
                    $_SESSION['TYPE']="CUSTOMER";
                    $_SESSION['Id'] = $row['customer_id'];
                    if($row['Type']=='Customer'){
               
                        header("Location:Home.php");             
                    }
                    else{
                        $_SESSION['TYPE']="ADMIN";
                        header("Location:Dashboard.php");  
                    }
                        exit();
                }           
            } 
            else{

                header("Location: login.php?error=Incorect username  or password");
                exit(); 
            }
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | Trans-Master APARORS</title>
    <link rel="shortcut icon" href="pictures/logo.png" type="image/x-icon">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
</head>
  <body>
 
<section class="vh-100 bg">
    <div class="container py-5 h-100" >
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong box">
                    <form action="" autocomplete="off" enctype="multipart/form-data" method="post">
                        <div class="card-body p-5 text-center">
                            <h3 > <img src="pictures/logo.png"
                            alt="Login image" style="height:150px; width:150px;"></h3>
                        
                            <div class="input-group mb-4">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i> </span>
                                <input type="text" class="form-control form-control-lg" name="Username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group mb-4">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                <input type="text" class="form-control form-control-lg" name="Password" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <?php if (isset($_GET['error'])) { ?>
     		                    <p class="error" style="color:red;"><?php echo $_GET['error']; ?></p>
     	                    <?php } ?>

                            <div class="row mb-4">
                                <div class="col d-flex justify-content-center">
                                    <!-- Checkbox -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="form2Example31" />
                                        <label class="form-check-label" for="form2Example31"> Remember me </label>
                                    </div>
                                </div>

                                <div class="col">
                                <!-- Simple link -->
                                <a href="#!">Forgot password?</a>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-lg " type="submit" name="submit" value="submit" style="width:100%;">Login</button>
                           
                            <div class="col justify-content-center mt-2">
                                  <!-- Simple link -->
                                <a id="already" href="#!">You don't have already account?</a>
                                <a href="signup.php">Sign up!</a>
                                <a href="index.php">Cancel</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<style>

    body, html {
        height: 100%;
        margin: 0;
    }

    .bg {
        background-image: url("pictures/wallpaper.png");
        height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .box{
        background-color: white;
        border-radius: 1rem;
        opacity: 0.7;

    }
    a:link {
        text-decoration: none;
    }
    #already{
        text-decoration: none;
        color:black;
    }
</style>
</body>
</html>
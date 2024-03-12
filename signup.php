<?php

session_start();

require 'config.php';

if(isset($_POST['submit'])){

   $first_name = $_POST['first_name'];
   $middle_name = $_POST['middle_name'];
   $last_name = $_POST['last_name'];
   $birth_date = $_POST['birth_date'];
   $genders = $_POST['gender']; 
   $cellphone_number = $_POST['cp_number']; 
   $barangay = $_POST['bara_ngay'];
   $municipality = $_POST['munici_pality'];
   $province = $_POST['pro_vince'];
   $email = $_POST['em_ail'];
   $username =  $_POST['user_name'];
   $password =  $_POST['pass_word'];
   $profilepic = $_FILES['profile_picture']['name'] ;
   $file_size =$_FILES['profile_picture']['size'];
   $file_tmp =$_FILES['profile_picture']['tmp_name'];
   $file_type=$_FILES['profile_picture']['type'] ;


      $sql_insert_user = "INSERT INTO users (profile, firstname,middlename, lastname,birthdate,gender,cpnumber, barangay, municipality, province, email,username, pass_word, Type) 
      VALUES( '$profilepic','$first_name', '$middle_name','$last_name', '$birth_date', '$genders', '$cellphone_number', '$barangay', '$municipality', '$province','$email','$username', '$password', 'Customer')";
      $res = mysqli_query($con, $sql_insert_user);

      if($res){
        move_uploaded_file($file_tmp,"profiles/".$profilepic);
          header("Location: login.php");
      }
      else{
      echo 'error';
      }   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
     
  <title>Sign up | Trans-Master APARORS</title>
    <link rel="shortcut icon" href="pictures/logo.png" type="image/x-icon">
 
</head>
<body>

    <div class="login-page bg-light">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-lg-10 offset-lg-1 ">
                    <div class=" shadow rounded background">
                        <div class="row">
                            <div class="col-md-5 d-none d-md-block">
                                <div class="form-right h-100 text-white text-center pt-3">
                                    <img src="pictures/logo.png"
                                    alt="Login image" style="height:400px; width:400px;">
                                </div>
                            </div>
                            <div class="col-md-7 pe-0" style="height: 95vh; overflow-y: scroll;" id="container">
                                <div class="form-left h-100 py-5 px-5">
                                    <form action="" autocomplete="off" enctype="multipart/form-data" method="post"class="row">
                                        <div class="picture-container">
                                            <div class="picture">
                                                <img src="pictures/profile.png" class="picture-src" id="wizardPicturePreview" title="">
                                                <input type="file"name="profile_picture" accept=".jpg,.jpeg,.png" id="wizard-picture"  class="" required>
                                            </div>
                                            <span  class="">Choose Picture</span>
                                        </div>
                                        <div class="col-md-4">
                                          <label class="form-label">First Name</label>
                                          <input type="text" name="first_name" placeholder="Enter firstname" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                          <label class="form-label">Middle Name</label>
                                          <input type="text" name="middle_name" placeholder="Enter middlename" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                          <label class="form-label">Last Name</label>
                                          <input type="text" name="last_name" placeholder="Enter lastname" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Barangay</label>
                                            <input type="text" name="bara_ngay" placeholder="Enter barangay" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Municipality</label>
                                            <input type="text" name="munici_pality" placeholder="Enter municipality" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Province</label>
                                            <input type="text" name="pro_vince" placeholder="Enter province" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                          <label class="form-label">Birthdate</label>
                                          <input type="Date" name="birth_date" placeholder="Enter birthdate" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                          <label class="form-label">Gender</label>
                                            <select  class="form-control" name="gender"required>
                                                <option selected disabled>Gender</option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Cellphone No.</label>
                                            <input type="number" name="cp_number" placeholder="Cellphone No." class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" name="em_ail" placeholder="Enter email address" class="form-control" requiredrequired>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="user_name" placeholder="Create username" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Password</label>
                                            <input type="text" name="pass_word" placeholder="Create password" class="form-control" required>
                                        </div>
                                        <div class="col-md-12">
                                          <br>
                                          <button class="btn btn-primary form-control" type="submit" name="submit" value="submit">Register</button>
                                        </div>
                                        <div class="col text-center mt-2 text-center">
                                            <!-- Simple link -->
                                            <a id="already" href="#!">You  have already account!</a>
                                            <a href="login.php">Sign in!</a>
                                            <a href="login.php">Cancel</a>
                                        </div>
                                    </form>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
</body>
</html>
<style>
       #container::-webkit-scrollbar 
        {
        display: none;
        }
       #already{
        text-decoration: none;
        color:black;
    }
    a {
    text-decoration: none;
}
.login-page {
    width: 100%;
    height: 100vh;
    display: inline-block;
    display: flex;
    align-items: center;
}
.form-right i {
    font-size: 100px;
}
/* .background {
        background-image: url("pictures/a.jpg");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        
    } */

    /* .background{
        background-color: black;
        border-radius: 1rem;
        opacity: 0.5;

    } */
   /*Profile Pic Start*/
.picture-container{
    
    position: relative;
    cursor: pointer;
    text-align: center;
}
.picture{
    width: 110px;
    height: 110px;
    background-color:#FFFFFF;
    border: 4px solid #CCCCCC;
    color: #FFFFFF;
    border-radius: 50%;
    margin: 0px auto;
    overflow: hidden;
    transition: all 0.2s;
    -webkit-transition: all 0.2s;
    text-align: center;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px; 
}
.picture:hover{
    border-color: #2ca8ff;
}
.content.ct-wizard-green .picture:hover{
    border-color: #05ae0e;
}
.content.ct-wizard-blue .picture:hover{
    border-color: #3472f7;
}
.content.ct-wizard-orange .picture:hover{
    border-color: #ff9500;
}
.content.ct-wizard-red .picture:hover{
    border-color: #ff3b30;
}
.picture input[type="file"] {
    cursor: pointer;
    display: block;
    height: 100%;
    left: 0;
    opacity: 0 !important;
    position: absolute;
    top: 0;
    width: 100%;
}

.picture-src{
    width: 100%;
    
}

    </style>
    <script>
        $(document).ready(function(){
        // Prepare the preview for profile picture
            $("#wizard-picture").change(function(){
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
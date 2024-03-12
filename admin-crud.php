<?php
    session_start();
    require 'config.php';

        //--------- ADD ADMIN ---------->
    if(isset($_POST['add_admin'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($username ==NULL || $password == NULL)
        {
            $res = [
                'status' => 422,
                'message' => 'All fields are mandatory'
            ];
            echo json_encode($res);
            return;
        }
    
        
        $sql_insert_user = "INSERT INTO users (username ,pass_word, Type) VALUES( '$username','$password', 'Admin')";
        $result = mysqli_query($con, $sql_insert_user);

        if($result)
        {
            $res = [
                'status' => 200,
                'message' => 'Admin  Created Successfully'
            ];
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 500,
                'message' => 'Admin Not Created'
            ];
            echo json_encode($res);
            return;
        }
    }
           //--------- VIEW ADMIN FORM ---------->
           if(isset($_GET['admin_id']))
           {
               $admin_id = mysqli_real_escape_string($con, $_GET['admin_id']);
           
               $query = "SELECT * FROM users WHERE customer_id='$admin_id'";
               $query_run = mysqli_query($con, $query);
           
               if(mysqli_num_rows($query_run) == 1)
               {
                   $admin = mysqli_fetch_array($query_run);
           
                   $res = [
                       'status' => 200,
                       'message' => 'Admin Fetch Successfully by id',
                       'data' => $admin
                   ];
                   echo json_encode($res);
                   return;
               }
               else
               {
                   $res = [
                       'status' => 404,
                       'message' => 'Admin Id Not Found'
                   ];
                   echo json_encode($res);
                   return;
               }
           }
      //--------- UPDATE ADMIN ---------->
      if(isset($_POST['update_admin'])){

        $adminID = $_POST['adminid'];
        $username = $_POST['uname'];
        $password = $_POST['pword'];

        if($username ==NULL || $password == NULL)
        {
            $res = [
                'status' => 422,
            ];
            echo json_encode($res);
            return;
        }
    
        
        $sql_update_user = "UPDATE users SET username ='$username', pass_word ='$password' WHERE customer_id='$adminID' ";
        $result = mysqli_query($con, $sql_update_user);

        if($result)
        {
            $res = [
                'status' => 200,
            ];
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 500,
            ];
            echo json_encode($res);
            return;
        }
    }
     //--------- DELETE ADMIN ---------->
     if(isset($_POST['delete_admin']))
     {
             $admin_id = mysqli_real_escape_string($con, $_POST['admin_id']);
     
             $query = "DELETE FROM users WHERE customer_id='$admin_id'";
             $query_run = mysqli_query($con, $query);
     
         if($query_run)
         {
             $res = [
                 'status' => 200,
                 'message' => 'Student Deleted Successfully'
             ];
             echo json_encode($res);
             return;
         }
         else
         {
             $res = [
                 'status' => 500,
                 'message' => 'Student Not Deleted'
             ];
             echo json_encode($res);
             return;
         }
     }  
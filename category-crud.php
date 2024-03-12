<?php
    session_start();
    require 'config.php';

//--------- ADD ADMIN ---------->
    if(isset($_POST['add_category'])){
        
        $cat_name = $_POST['cat_name'];

        if($cat_name ==NULL)
        {
            $res = [
                'status' => 422,
            ];
            echo json_encode($res);
            return;
        }
    
        
        $sql_insert_category = "INSERT INTO category (category_name) VALUES( '$cat_name')";
        $result = mysqli_query($con, $sql_insert_category);

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

      //--------- VIEW ADMIN FORM ---------->
      if(isset($_GET['cat_id']))
      {
          $cat_id = mysqli_real_escape_string($con, $_GET['cat_id']);
      
          $query = "SELECT * FROM category WHERE category_id='$cat_id'";
          $query_run = mysqli_query($con, $query);
      
          if(mysqli_num_rows($query_run) == 1)
          {
              $admin = mysqli_fetch_array($query_run);
      
              $res = [
                  'status' => 200,
                  'data' => $admin
              ];
              echo json_encode($res);
              return;
          }
          else
          {
              $res = [
                  'status' => 404,
              ];
              echo json_encode($res);
              return;
          }
      }


      //--------- UPDATE CATEGROY ---------->
      if(isset($_POST['update_category'])){

        $catid = $_POST['catid'];
        $cat_name = $_POST['cat_name'];

        if($cat_name ==NULL)
        {
            $res = [
                'status' => 422,
            ];
            echo json_encode($res);
            return;
        }
    
        
        $sql_update_user = "UPDATE category SET category_name ='$cat_name'WHERE category_id='$catid' ";
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
              if(isset($_POST['delete_cat']))
              {
                      $cat_id = mysqli_real_escape_string($con, $_POST['cat_id']);
              
                      $query = "DELETE FROM category WHERE category_id='$cat_id'";
                      $query_run = mysqli_query($con, $query);
              
                  if($query_run)
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
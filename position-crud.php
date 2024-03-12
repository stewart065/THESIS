<?php
    session_start();
    require 'config.php';

//--------- ADD ADMIN ---------->
    if(isset($_POST['add_position'])){
        
        $post_name = $_POST['post_name'];

        if($post_name ==NULL)
        {
            $res = [
                'status' => 422,
            ];
            echo json_encode($res);
            return;
        }
    
        
        $sql_insert_position = "INSERT INTO position (position_name) VALUES( '$post_name')";
        $result = mysqli_query($con, $sql_insert_position);

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
  
      //--------- VIEW POSITION FORM ---------->
      if(isset($_GET['post_id']))
      {
          $cat_id = mysqli_real_escape_string($con, $_GET['post_id']);
      
          $query = "SELECT * FROM position WHERE position_id='$cat_id'";
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
      
      //--------- UPDATE POSITON ---------->
      if(isset($_POST['update_position'])){

        $postid = $_POST['postid'];
        $post_name = $_POST['post_name'];

        if($post_name ==NULL)
        {
            $res = [
                'status' => 422,
                'message' => 'All fields are mandatory'
            ];
            echo json_encode($res);
            return;
        }
    
        
        $sql_update_user = "UPDATE position SET position_name ='$post_name'WHERE position_id='$postid' ";
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

                  //--------- DELETE POSITION  ---------->
                  if(isset($_POST['delete_post']))
                  {
                          $post_id = mysqli_real_escape_string($con, $_POST['post_id']);
                  
                          $query = "DELETE FROM position WHERE position_id='$post_id'";
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
      
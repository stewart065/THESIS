<?php
    session_start();
    require 'config.php';

//--------- ADD EMPLOYEE ---------->

if(isset($_POST['add_employee'])){
 
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $brgy = $_POST['brgy'];
    $muni = $_POST['muni'];
    $prov = $_POST['prov'];

    $birth=NULL;
    if(isset($_POST['birth'])){
    $birth = $_POST['birth'];}

    $gender=NULL;
    if(isset($_POST['gend'])){
    $gender = $_POST['gend'];}

    $cp = $_POST['cp'];
    $mail = $_POST['mail'];

    $post=NULL;
    if(isset($_POST['post'])){
    $post = $_POST['post'];}

    $salar = $_POST['salar'];
    
    $location='profiles/';
    $target="profiles/".basename($_FILES['profpic']['name']);      
    //image code
     $image=$_FILES['profpic']['tmp_name'];
     $pic=$_FILES['profpic']['name'];

    if( $fname == NULL || $mname == NULL || $lname == NULL || $pic == NULL || $brgy ==NULL || $muni ==NULL || $prov ==NULL
    || $birth==NULL || $gender==NULL || $cp == NULL || $mail == NULL || $post==NULL || $salar == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    $sql_insert_category = "INSERT INTO employee (employee_profile,employee_firstname,employee_middlename,employee_lastname,
    employee_barangay,employee_municipality,employee_province,employee_birthdate,employee_gender,employee_cpnumber,employee_email,employee_position,employee_salary) 
    VALUES('$pic','$fname','$mname','$lname','$brgy','$muni','$prov','$birth','$gender','$cp','$mail','$post','$salar')";
    $result = mysqli_query($con, $sql_insert_category);


    if($result)
    {
        move_uploaded_file($image, $location.$pic);
        $res = [
            'status' => 200,
            'message' => 'product  Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'product Not Created'
        ];
        echo json_encode($res);
        return;
    }
}
    
       //--------- VIEW EMPLOYEE FORM ---------->
       if(isset($_GET['em_id']))
       {
           $prod_id = mysqli_real_escape_string($con, $_GET['em_id']);
       
           $query = "SELECT * FROM employee WHERE employee_id='$prod_id'";
           $query_run = mysqli_query($con, $query);
       
           if(mysqli_num_rows($query_run) == 1)
           {
               $admin = mysqli_fetch_array($query_run);
       
               $res = [
                   'status' => 200,
                   'message' => 'product Fetch Successfully by id',
                   'data' => $admin
               ];
               echo json_encode($res);
               return;
           }
           else
           {
               $res = [
                   'status' => 404,
                   'message' => 'product Id Not Found'
               ];
               echo json_encode($res);
               return;
           }
       }



      //--------- UPDATE EMPLOYEE ---------->
      if(isset($_POST['employee_update'])){

        $employID = $_POST['em_id'];
        $f_name = $_POST['f_name']; 
        $m_name = $_POST['m_name'];
        $l_name = $_POST['l_name'];
        $b_rgy = $_POST['b_rgy'];
        $m_lty = $_POST['m_lty'];
        $p_rv = $_POST['p_rv'];

          $bdate=null;
        if(isset($_POST['b_date'])){
        $bdate = $_POST['b_date'];}

        $gdr=null;
        if(isset($_POST['g_dr'])){
        $gdr = $_POST['g_dr'];}
        $c_p = $_POST['c_p'];
        $ma_il = $_POST['ma_il'];

        $pst=null;
        if(isset($_POST['pst'])){
        $pst = $_POST['pst'];}

        $slry = $_POST['slry'];

        $location='profiles/';
        $target="profiles/".basename($_FILES['uppic']['name']);      
         $image=$_FILES['uppic']['tmp_name'];
         $prof=$_FILES['uppic']['name'];


        if($f_name == NULL || $m_name == NULL || $l_name == NULL || $b_rgy == NULL || $m_lty == NULL || $p_rv == NULL
            || $bdate == NULL || $gdr==NULL || $c_p==NULL || $ma_il==NULL || $pst==NULL || $slry==NULL || $prof==NULL )
        {
            $res = [
                'status' => 422,
                'message' => 'All fields are mandatory'
            ];
            echo json_encode($res); 
            return;
        }
    
        
        $sql_update_user = "UPDATE employee SET  employee_profile='$prof', employee_firstname ='$f_name',employee_middlename ='$m_name',employee_lastname ='$l_name',
        employee_barangay ='$b_rgy',employee_municipality ='$m_lty',employee_province ='$p_rv',employee_birthdate ='$bdate',
        employee_gender='$gdr',employee_cpnumber='$c_p', employee_email='$ma_il',employee_position='$pst',employee_salary='$slry' WHERE employee_id='$employID'";
        $result = mysqli_query($con, $sql_update_user);

        if($result)
        {
            move_uploaded_file($image, $location.$prof);
            $res = [
                'status' => 200,
                'message' => 'Admin Created Successfully'
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

  //--------- DELETE ADMIN ---------->
  if(isset($_POST['delete_employee']))
  {
          $employ_id = mysqli_real_escape_string($con, $_POST['em_id']);
  
          $query = "DELETE FROM employee WHERE employee_id='$employ_id'";
          $query_run = mysqli_query($con, $query);
  
      if($query_run)
      {
          $res = [
              'status' => 200,
              'message' => 'Product Deleted Successfully'
          ];
          echo json_encode($res);
          return;
      }
      else
      {
          $res = [
              'status' => 500,
              'message' => 'Product Not Deleted'
          ];
          echo json_encode($res);
          return;
      }
  }       

  

   //--------- ADD STOCK ---------->
   if(isset($_POST['add_salary'])){
 
    $employ_nam= NULL;
    if(isset($_POST['em_sal'])){
    $employ_nam = $_POST['em_sal'];}

    $salary =$_POST['sal'];
 

    if($employ_nam == NULL || $salary == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $prodId=0;
    $current=0;
    $sql="SELECT * FROM employee WHERE employee_id=$employ_nam";
    $result1 = mysqli_query($con, $sql);
    while($row = mysqli_fetch_assoc($result1)){
        $prodId=$row['employee_id'];
        $current=$row['employee_salary'];
    }

    $new=$current+$salary;


    $sql_insert_category ="UPDATE employee set employee_salary=$new WHERE employee_id=".$prodId;
    $result = mysqli_query($con, $sql_insert_category);

    if($result)
    {
   
        $res = [
            'status' => 200,
            'message' => 'product  Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'product Not Created'
        ];
        echo json_encode($res);
        return;
    }
}
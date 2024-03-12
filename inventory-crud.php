<?php
    session_start();
    require 'config.php';

//--------- ADD ADMIN ---------->
    if(isset($_POST['add_product'])){
        
        $prodname = $_POST['prodanme'];

        $cat=NULL;
        if(isset($_POST['cat'])){
        $cat = $_POST['cat'];}

        $brand = $_POST['brand'];
        $quan = $_POST['quan'];
        $price = $_POST['price'];

        $location='product_image/';
        $target="product_image/".basename($_FILES['image']['name']);      
        //image code
        $img=$_FILES['image']['tmp_name'];
        $image=$_FILES['image']['name'];

        $prodesc = $_POST['prodesc'];
        
        if($prodname ==NULL || $cat == "" || $brand == "" || $quan == "" || $price == "" || $image == "" || $prodesc == "")
        {
            $res = [
                'status' => 422,
            ];
            echo json_encode($res);
            return;
        }
    
        
        $sql_insert_category = "INSERT INTO product (product_name,category_name,brand, `description`, quantity, price,`image`) 
        VALUES( '$prodname','$cat', '$brand', '$prodesc', '$quan', '$price', '$image' )";
        $result = mysqli_query($con, $sql_insert_category);

        if($result)
        {
            move_uploaded_file($img, $location.$image);
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

           //--------- VIEW PRODUCTS FORM ---------->
           if(isset($_GET['prod_id']))
           {
               $prod_id = mysqli_real_escape_string($con, $_GET['prod_id']);
           
               $query = "SELECT * FROM product WHERE product_id='$prod_id'";
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

 //--------- UPDATE PRODUCT ---------->
 if(isset($_POST['update_product'])){

    $prodid = $_POST['prodid'];
    $pro_name = $_POST['pro_name'];

    $catname=NULL;
    if(isset($_POST['catname'])){
    $catname = $_POST['catname'];}

    $bra_nd = $_POST['bra_nd'];
    $qu_an = $_POST['qu_an'];
    $pri_ce = $_POST['pri_ce'];

    $location='product_image/';
    $target="product_image/".basename($_FILES['ima_ge']['name']);      
    $img=$_FILES['ima_ge']['tmp_name'];
    $image=$_FILES['ima_ge']['name'];

    $proddesc = $_POST['proddesc'];


    if($pro_name ==NULL || $catname == NULL || $bra_nd == NULL || $qu_an == NULL ||
     $pri_ce == NULL || $proddesc== NULL)
    {
        $res = [
            'status' => 422,
        ];
        echo json_encode($res);
        return;
    }

    
    $sql = "UPDATE product SET product_name ='$pro_name', category_name='$catname', brand='$bra_nd',
     `description`='$proddesc', quantity='$qu_an', price='$pri_ce', `image`='$image' WHERE product_id='$prodid' ";
    $result = mysqli_query($con, $sql);

    if($result)
    {
        move_uploaded_file($img, $location.$image);
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


  //--------- DELETE PRODUCTS ---------->
  if(isset($_POST['delete_prod']))
  {
          $prod_id = mysqli_real_escape_string($con, $_POST['prod_id']);
  
          $query = "DELETE FROM product WHERE product_id='$prod_id'";
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
     if(isset($_POST['add_stock'])){


        $product_nam= NULL;
        if(isset($_POST['prodStock'])){
        $product_nam = $_POST['prodStock'];}
        $quantity =$_POST['quantity'];
     

        if($product_nam == NULL || $quantity == NULL)
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
        $sql="SELECT * FROM product WHERE product_id=$product_nam";
        $result1 = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($result1)){
            $prodId=$row['product_id'];
            $current=$row['quantity'];
        }

        $new=$current+$quantity;

        $sql_insert_category ="UPDATE product set quantity=$new WHERE product_id=".$prodId;
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
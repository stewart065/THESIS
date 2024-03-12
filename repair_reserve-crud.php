<?php
session_start();
require 'config.php';



$cusid = $_SESSION['Id'];

//--------- ADD repair ---------->
if (isset($_POST['add_repair'])) {


    $appointdate = NULL;
    if (isset($_POST['date'])) {
        $appointdate = $_POST['date'];
    }

    $appointmenttime = NULL;
    if (isset($_POST['time'])) {
        $appointmenttime = $_POST['time'];
    }

    $brand = $_POST['brand'];
    $model = $_POST['model'];

    $vtype = NULL;
    if (isset($_POST['vtype'])) {
        $vtype = $_POST['vtype'];
    }

    $stype = NULL;
    if (isset($_POST['stype'])) {
        $stype = $_POST['stype'];
    }


    if ($appointdate == NULL || $appointmenttime == NULL || $brand == NULL || $model == NULL || $vtype == NULL || $stype == NULL) {
        $res = [
            'status' => 422,
        ];
        echo json_encode($res);
        return;

    }

    $roundtime = substr($appointmenttime, 0, 2);

    $checksched = "SELECT * FROM repair_reservation where reserve_date = '$appointdate' AND reserve_time LIKE '$roundtime%'";

    $schedresult = mysqli_query($con, $checksched);

    if (mysqli_num_rows($schedresult) == 0) {



        $sql_insert_category = "INSERT INTO repair_reservation (reserve_date,reserve_time,vehicle_brand,year_model,vehicle_type,service_type,cus_id) 
            VALUES('$appointdate','$appointmenttime','$brand','$model','$vtype','$stype','$cusid' )";

        $result = mysqli_query($con, $sql_insert_category);

        if ($result) {
            $res = [
                'status' => 200,
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
            ];
            echo json_encode($res);
            return;
        }

    } else {
        $res = [
            'status' => 911,
        ];
        echo json_encode($res);
        return;
    }


}


//--------- VIEW REPAIR RESERVATION FORM ---------->
if (isset($_GET['re_sid'])) {
    $rep_id = mysqli_real_escape_string($con, $_GET['re_sid']);

    $query = "SELECT * FROM repair_reservation WHERE id='$rep_id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $repair = mysqli_fetch_array($query_run);
        $res = [
            'status' => 200,
            'data' => $repair
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
        ];
        echo json_encode($res);
        return;
    }
}

//--------- VIEW REPAIR RESERVATION FORM ---------->
if (isset($_POST['update_repair'])) {

    $repid = $_POST['resid'];

    $update = NULL;
    if (isset($_POST['update'])) {
        $update = $_POST['update'];
    }

    $uptime = NULL;
    if (isset($_POST['uptime'])) {
        $uptime = $_POST['uptime'];
    }


    $upbrand = $_POST['upbrand'];
    $upmodel = $_POST['upmodel'];

    $upvtype = NULL;
    if (isset($_POST['upvtype'])) {
        $upvtype = $_POST['upvtype'];
    }

    $upstype = NULL;
    if (isset($_POST['upstype'])) {
        $upstype = $_POST['upstype'];
    }


    if ($update == NULL || $uptime == NULL || $upbrand == NULL || $upmodel == NULL || $upvtype == NULL || $upstype == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $roundtime = substr($uptime, 0, 2);

    $checksched = "SELECT * FROM repair_reservation where reserve_date = '$update' AND reserve_time LIKE '$roundtime%' AND id != '$repid'";

    $schedresult = mysqli_query($con, $checksched);

    if (mysqli_num_rows($schedresult) == 0) {


    $sql_update_user = "UPDATE repair_reservation SET reserve_date ='$update', reserve_time='$uptime'
    ,vehicle_brand='$upbrand',year_model='$upmodel', vehicle_type='$upvtype', service_type='$upstype'
     WHERE id='$repid' ";
    $result = mysqli_query($con, $sql_update_user);

    if ($result) {
        $res = [
            'status' => 200,
            'message' => 'Admin Created Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Admin Not Created'
        ];
        echo json_encode($res);
        return;
    }
}
else{
   
        $res = [
            'status' => 911,
        ];
        echo json_encode($res);
        return;
    
}
}


































//user type
if (isset($_REQUEST['id'])) {
    $repid = $_REQUEST['id'];
    $sql = "DELETE FROM repair_reservation WHERE id ='$repid'";
    $query = $con->query($sql);
}
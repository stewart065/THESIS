<?php
session_start();
require 'config.php';
if (empty($_SESSION['TYPE'])) {
  if ($_SESSION['TYPE'] != "CUSTOMER") {
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

  <title>Repair Reservation | Trans-Master APARORS</title>
  <link rel="shortcut icon" href="pictures/logo.png" type="image/x-icon">
</head>
<nav class="navbar navbar-expand-lg navbar-light sticky-top" id="topbar">
  <div class="container-fluid text-white">
    <!-- <a class="navbar-brand" href="#">Transmaster</a> -->
    <h4 class="fw-bold">TRANS-MASTER</h4>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
        <li><a href="Home.php" class="nav-link fw-bold ariban">Home</a></li>
        <li class="dropdown">
          <a class="nav-link ariban fw-bold dropdown-toggle" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Reservation
          </a>
          <ul class="dropdown-menu justify-content-left ">
            <li> <a href="Home_product_reservation.php"><button class="dropdown-item" type="button">Product</button></a>
            </li>
            <li> <a href="Home_repair_reservation.php"><button class="dropdown-item" type="button">Repair</button></a>
            </li>
          </ul>
        </li>
        <li> <a href="Home_rate.php" class="nav-link fw-bold ariban"> To rate</a></li>
        <li> <a href="Home_rated_product.php" class="nav-link fw-bold ariban">Reviews</a></li>
      </ul>
    </div>
    <div class="collapse navbar-collapse ariban " id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mr-2">
        <li><a href="Home-cart.php" class="nav-link ariban"><i class="fa-solid fa-cart-shopping"></i></a></li>
        <li> <a href="Home-inquire.php" class="nav-link ariban"><i class="fa-solid fa-message"></i></a></li>
        <li class="dropdown">
          <a class="nav-link ariban fw-bold dropdown-toggle" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fa-solid fa-clock-rotate-left"></i>
          </a>
          <ul class="dropdown-menu justify-content-left ">
            <li> <a href="Home_history_product.php"><button class="dropdown-item" type="button">Product</button></a></li>
            <li> <a href="Home_history_repair.php"><button class="dropdown-item" type="button">Repair</button></a></li>
          </ul>
        </li>
        <?php
        $sql = "SELECT concat (firstname,' ',lastname) as `name` , profile FROM users WHERE customer_id =" . $_SESSION['Id'];
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
                class="rounded-circle" src="profiles/<?php echo $profile; ?>">
              <?php echo $uname; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item text-dark" href="view-profile.php">My profile</a></li>
              <li><hr class="dropdown-divider" /></li>
              <li><a class="dropdown-item text-dark" href="logout.php?logout'">Logout</a></li>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>

<body>
  <section class="h-100 gradient-custom">
    <div class="container py-5">
      <button type="button" class="btn btn-primary sticky " data-bs-toggle="modal" data-bs-target="#repair_add_modal">
        Create Reservation
      </button>
      <div class="row d-flex justify-content-center my-4">
        <?php
        $cusid = $_SESSION['Id'];
        $sql = "SELECT  CONCAT(firstname, lastname) AS name ,id, reserve_date, reserve_time, vehicle_brand, year_model, vehicle_type,service_type,repair_reservation.status
                 from repair_reservation INNER JOIN users ON users.customer_id = repair_reservation.cus_id  where cus_id = '$cusid'  ORDER BY repair_reservation.status DESC";

        $res = $con->query($sql);
        if (!$res) {
          echo 'error';
        }

        while ($row = mysqli_fetch_object($res)) {

          $rid = $row->id;
          $date = $row->reserve_date;
          $time = $row->reserve_time;
          $brand = $row->vehicle_brand;
          $model = $row->year_model;
          $vtype = $row->vehicle_type;
          $stype = $row->service_type;
          $status = $row->status;

          ?>
          <div class="col-md-4">
            <div class="card mb-4">
              <div class="card-header py-3">
                <h5 class="mb-0"> Status: <span class="text-danger">
                    <?php echo $status; ?>
                  </span></h5>
              </div>
              <div class="card-body">
                <ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                    Date:
                    <?php echo $date; ?>
                    <span> Time:
                      <?php echo $time; ?>
                    </span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                    Vehicle brand:
                    <span>
                      <?php echo $brand; ?>
                    </span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                    Year Model:
                    <span>
                      <?php echo $model; ?>
                    </span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                    Vehicle Type:
                    <span>
                      <?php echo $vtype; ?>
                    </span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                    Service Type:
                    <span>
                      <?php echo $stype; ?>
                    </span>
                  </li>
                </ul>
                <hr>
                <div class="d-flex justify-content-center">
               
                  <button type="button" class="btn btn-primary updaterepair btn-md me-2" 
                  <?php  
                  if($status == "Finished"){
                    echo "hidden";
                  }
                  ?>  id="<?php echo $rid; ?> ">
                    Update
                  </button>
                
                  <button type="button" class="btn btn-danger deleterepair "   <?php  
                  if($status == "Finished"){
                    echo "hidden";
                  }
                  ?>  id="<?php echo $rid; ?> ">
                    Cancel
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
  <!-- modal add -->
  <div class="modal fade " id="repair_add_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="repair_UPDATE_modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="repair_UPDATE_modalLabel">Create Reservation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action='repair_reserve-crud.php' autocomplete="off" enctype="multipart/form-data" id="form" method="post">
          <div class="modal-body row g-3">
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Date</label>
              <input type="date" class="form-control" name="date" id="inputDate">
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label" >Time</label>
              <input type="time" class="form-control" name="time" id="inputTime4">
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Vehicle brand</label>
              <input type="text" class="form-control" placeholder="Enter vehicle brand" name="brand" id="inputPassword5">
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Year model</label>
              <input type="text" class="form-control" placeholder="Enter year model" name="model" id="inputPassword6">
            </div>
            <div class="col-md-6">
              <label for="inputState" class="form-label">Vehicle Type</label>
              <select id="inputState" class="form-select" name="vtype">
                <option selected disabled>Select vehicle type</option>
                <option>Hatchback</option>
                <option>Sedan</option>
                <option>SUV</option>
                <option>MUV</option>
                <option>Coupe</option>
                <option>Convertible</option>
                <option>Pickup</option>
                <option>Multicab</option>
                <option>Truck</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="inputState" class="form-label">Service Type</label>
              <select id="inputState" class="form-select" name="stype">
                <option selected disabled>Choose...</option>
                <option>Under chasis</option>
                <option>Air Cleaner</option>
                <option>Steering and Suspension</option>
                <option>Tires and Alignment</option>
                <option>Change oil</option>
                <option>Vulcanize</option>
              </select>
            </div>

            <label>Services Offerd</label>
            <div class="col-md-4 text-muted">
              <label class="form-check-label" for="car">Air Cleaner</label>
            </div>
            <div class="col-md-4 text-muted">
              <label class="form-check-label" for="pickup">Pick-Up TrucK</label>
            </div>
            <div class="col-md-4 text-muted">
              <label class="form-check-label" for="Electrical">Electrical Systems</label>
            </div>
            <div class="col-md-4 text-muted">
              <label class="form-check-label" for="suv">Engine</label>
            </div>
            <div class="col-md-4 text-muted">
              <label class="form-check-label" for="Suspension">Steering and Suspension</label>
            </div>
            <div class="col-md-4 text-muted">
              <label class="form-check-label" for="Alignment">Tires and Alignment</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-primary">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- modal update -->
  <div class="modal fade " id="repair_update_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="repair_UPDATE_modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="repair_UPDATE_modalLabel">Update Reservation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action='repair_reserve-crud.php' autocomplete="off" enctype="multipart/form-data" id="update_form"
          method="post">
          <div class="modal-body row g-3">
            <input type="text" name="resid" id="res_id" hidden>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Date</label>
              <input type="date" class="form-control" name="update" id="da_te">
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Time</label>
              <input type="time" class="form-control" name="uptime" id="ti_me">
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Vehicle brand</label>
              <input type="text" class="form-control" name="upbrand" id="bra_nd">
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Year model</label>
              <input type="text" class="form-control" name="upmodel" id="year_model">
            </div>
            <div class="col-md-6">
              <label for="inputState" class="form-label">Vehicle Type</label>
              <select class="form-select" name="upvtype" id="v_type">
                <option selected disabled>Choose...</option>
                <option>Hatchback</option>
                <option>Sedan</option>
                <option>SUV</option>
                <option>MUV</option>
                <option>Coupe</option>
                <option>Convertible</option>
                <option>Pickup</option>
                <option>Multicab</option>
                <option>Truck</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="inputState" class="form-label">Service Type</label>
              <select class="form-select" name="upstype" id="s_type">
                <option selected disabled>Choose...</option>
                <option>Under chasis</option>
                <option>Air Cleaner</option>
                <option>Steering and Suspension</option>
                <option>Tires and Alignment</option>
                <option>Change oil</option>
                <option>Vulcanize</option>
              </select>
            </div>

            <label>Services Offerd</label>
            <div class="col-md-4 text-muted">
              <label class="form-check-label" for="car">Air Cleaner</label>
            </div>
            <div class="col-md-4 text-muted">
              <label class="form-check-label" for="pickup">Pick-Up TrucK</label>
            </div>
            <div class="col-md-4 text-muted">
              <label class="form-check-label" for="Electrical">Electrical Systems</label>
            </div>
            <div class="col-md-4 text-muted">
              <label class="form-check-label" for="suv">Engine</label>
            </div>
            <div class="col-md-4 text-muted">
              <label class="form-check-label" for="Suspension">Steering and Suspension</label>
            </div>
            <div class="col-md-4 text-muted">
              <label class="form-check-label" for="Alignment">Tires and Alignment</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.0/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</html>
<style>
  #topbar {
    background: radial-gradient(56.58% 56.58% at 50.09% 39.71%,
        #ed5450 27.08%,
        #bd1e2e 100%);
  }

  .eyy {
    font-size: 10px;
  }

  .ariban {
    color: white;
  }

  .ariban li a:hover {
    color: white;
    border-bottom: 3px solid #00f;
  }
</style>
<script>

  $(document).on('submit', '#form', function (e) {

    e.preventDefault();

    var formData = new FormData(this);
    formData.append("add_repair", true);

    $.ajax({
      type: "POST",
      url: "repair_reserve-crud.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {

        var res = jQuery.parseJSON(response);
        if (res.status == 422) {
          Swal.fire(
            'Ooops error!',
            'please fill up the blank',
            'error'
          )

        }
        else if (res.status == 200) {

          Swal.fire({
            title: 'success',
            text: 'Reapir Reservation successfully',
            icon: 'success',
            timer: '1000',
            showConfirmButton: false,
          }).then(() => {
            window.location.reload();
          })
          $('#repair_add_modal').modal('hide');
          $('#form')[0].reset();
          alertify.set('notifier', 'position', 'top-right');
          $('#table_id').load(location.href + "#table_id");

        }
        else if (res.status == 500) {
          alert(res.message);
        }
        else if (res.status == 911) {
          Swal.fire({
            title: 'Date and Time is already booked',
            text: 'Please select another date and time',
            icon: 'info',
            timer: '5000',
            showConfirmButton: false,
            allowOutsideClick: false,
          })
      }
    }});

  });



  // FOR VIEW REPAIR RESERVATION MODAL
  $(document).on('click', '.updaterepair', function () {
    var rep_id = $(this).attr('id');
    $.ajax({
      type: "GET",
      url: "repair_reserve-crud.php?re_sid=" + rep_id,
      success: function (response) {

        var res = jQuery.parseJSON(response);
        if (res.status == 404) {
          Swal.fire(
            'Ooops error!',
            'please fill up the blank',
            'error'
          )
        }
        else if (res.status == 200) {

          $('#res_id').val(res.data.id);
          $('#da_te').val(res.data.reserve_date);
          $('#ti_me').val(res.data.reserve_time);
          $('#bra_nd').val(res.data.vehicle_brand);
          $('#year_model').val(res.data.year_model);
          $('#v_type').val(res.data.vehicle_type);
          $('#s_type').val(res.data.service_type);
          $('#repair_update_modal').modal('show');
        }
      }
    });
  });

  // FOR UPDATE REPAIR RESERVATION
  $(document).on('submit', '#update_form', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_repair", true);

    $.ajax({
      type: "POST",
      url: "repair_reserve-crud.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {

        var res = jQuery.parseJSON(response);
        if (res.status == 422) {
          Swal.fire(
            'Something went wrong!',
            'please fill up the blank',
            'error'
          )

        } else if (res.status == 200) {

          Swal.fire({
            title: 'success',
            text: 'Added position successfully',
            icon: 'success',
            timer: '1000',
            showConfirmButton: false,
          }).then(() => {
            window.location.reload();
          })

        } else if (res.status == 500) {
          alert(res.message);
        }
        else if (res.status == 911) {
          Swal.fire({
            title: 'Date and Time is already booked',
            text: 'Please select another date and time',
            icon: 'info',
            timer: '5000',
            showConfirmButton: false,
            allowOutsideClick: false,
          })
      }
      }
    });

  });

  //script for deleting data
  $(document).on('click', '.deleterepair', function () {
    var id = $(this).attr('id');
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to delete this!",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'repair_reserve-crud.php',
          type: 'POST',
          data: { id: id },
          success: function (data) {
            Swal.fire({
              title: 'success',
              icon: 'success',
              text: 'Deleted successfully!',
              showConfirmButton: false,
              timer: 1000,
            }).then(() => {
              window.location.reload();
            })
          }
        })
      }
    })
  })




  $('#inputTime4').change(function() {
    var time = $(this).val();


    if(time > "07:00"  ){
          if(time <= "15:00"){
          }
          else{
            alertNotAvailable();
          }
    }
    else{
      alertNotAvailable();
    }

});


$('#ti_me').change(function() {
    var time = $(this).val();


    if(time > "07:00"  ){
          if(time <= "15:00"){
          }
          else{
            alertNotAvailable();
          }
    }
    else{
      alertNotAvailable();
    }

});





function alertNotAvailable(){
  Swal.fire({
              title: 'Time not available',
              icon: 'error',
              text: '7:00 am to 3:00 pm is acceptable',
              showConfirmButton: false,
              timer: 3000,
              allowOutsideClick: false,
            }).then(() => {
              document.getElementById('ti_me').value = "";
            })
}




$('#inputDate').change(function() {
    var datere = new Date ($(this).val());


    if(datere.getDay() != 0){



    }
    else{
      Swal.fire({
              title: 'Date not available',
              icon: 'error',
              text: 'Monday to Saturday is acceptable',
              showConfirmButton: false,
              timer: 3000,
              allowOutsideClick: false,
            }).then(() => {
              document.getElementById('inputDate').value = "";
            })
    }

});



$('#da_te').change(function() {
    var datere = new Date ($(this).val());


    if(datere.getDay() != 0){



    }
    else{
      Swal.fire({
              title: 'Date not available',
              icon: 'error',
              text: 'Monday to Saturday is acceptable',
              showConfirmButton: false,
              timer: 3000,
              allowOutsideClick: false,
            }).then(() => {
              document.getElementById('da_te').value = "";
            })
    }

});
</script>
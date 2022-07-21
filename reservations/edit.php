<?php
    include "../config/url.php";
    include "../config/connect.php";
    include '../functions.php';
    $currentPage="reservations";

    if(isset($_GET['reservation_id'])){
      $reservation_id=$_GET['reservation_id'];
    }else{
      header('location:../index.php');
      exit;
    }

    $reservation=getReservationByID($reservation_id);
    $date_from=$reservation['date_from'];
    $date_to=$reservation['date_to'];
    $price=$reservation['price'];
    $vehicle_id=$reservation['vehicle_id'];
    $client_id=$reservation['client_id'];

    $div_class_name="d-none";
    $message='';
    if(isset($_GET['err'])&&$_GET['err']==1){
      $div_class_name="";
      $message="Please fill out all fields!";
    }
    if(isset($_GET['err'])&&$_GET['err']==2){
        $div_class_name="";
        $message="This vehicle is not available at choosen period of time!";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Car rental | Reservations</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php include '../components/sidebar.php' ?>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit reservation</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12 alert alert-danger <?=$div_class_name?>">
            <?=$message?>
          </div>
        </div>

        <form action="./update.php" method="post">
            <div class="row">
                <input type="hidden" name="reservation_id" value="<?=$reservation_id?>">
                <div class="col-4">
                    <label for="date_from">Date from:</label>
                    <input type="date" name="date_from" id="date_from" class="form-control" value="<?=$date_from?>">
                </div>
                <div class="col-4">
                    <label for="date_to">Date to:</label>
                    <input type="date" name="date_to" id="date_to" class="form-control" value="<?=$date_to?>">
                    </div>
                <div class="col-4">
                    <label for="price">Price:</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-control" value="<?=$price?>">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-6"><h4>Select vehicle:</h4></div>
                <div class="col-5 offset-1"><h4>Select client:</h4></div>
            </div>
            <div class="row">
                <div class="col-6">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Registration number</th>
                                <th>Year</th>
                                <th>Manufacturer</th>
                                <th>Model</th>
                                <th>Class</th>
                                <th>Choose</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $vehicles=getAllVehicles();
                                while($row=mysqli_fetch_assoc($vehicles)){
                                    $v_id=$row['v_id'];
                                    $registration_number=$row['registration_number'];
                                    $year=$row['year'];
                                    $manufacturer_name=$row['manufacturer_name'];
                                    $model_name=$row['model_name'];
                                    $class_name=$row['class_name'];
                                    $checked="";
                                    if($v_id==$vehicle_id){
                                        $checked="checked";
                                    }
                                    echo "<tr>
                                            <td>$registration_number</td>
                                            <td>$year</td>
                                            <td>$manufacturer_name</td>
                                            <td>$model_name</td>
                                            <td>$class_name</td>
                                            <td><input type=\"radio\" name=\"vehicle\" id=\"vehicle\" value=\"$v_id\" $checked></td>
                                        </tr>";
                                }

                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-5 offset-1">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Country</th>
                                <th>Passport number</th>
                                <th>Choose</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $clients=getAllClients();
                                while($row=mysqli_fetch_assoc($clients)){
                                    $c_id=$row['id'];
                                    $name=$row['first_name']." ".$row['last_name'];
                                    $country=$row['country_name'];
                                    $passport_number=$row['passport_number'];
                                    $checked1="";
                                    if($c_id==$client_id){
                                        $checked1="checked";
                                    }
                                    echo "<tr>
                                            <td>$name</td>
                                            <td>$country</td>
                                            <td>$passport_number</td>
                                            <td><input type=\"radio\" name=\"client\" id=\"client\" value=\"$c_id\" $checked1></td>
                                        </tr>";
                                }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <button class="btn btn-success">Update reservation</button>
                </div>
            </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
</body>
</html>

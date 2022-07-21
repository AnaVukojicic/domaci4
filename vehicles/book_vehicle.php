<?php
    include "../config/url.php";
    include "../config/connect.php";
    include '../functions.php';
    $currentPage="vehicles";

    if(isset($_GET['vehicle_id'])){
      $vehicle_id=$_GET['vehicle_id'];
    }else{
      header('location:../vehicles.php');
      exit;
    }

    $vehicle=getVehicleByID($vehicle_id);
    $registration_number=$vehicle['registration_number'];
    $manufacturer_name=$vehicle['manufacturer_name'];
    $model_name=$vehicle['model_name'];
    $class_name=$vehicle['class_name'];
    $year=$vehicle['year'];

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
  <title>Car rental | Vehicles</title>

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
            <h1 class="m-0">Book vehicle</h1>
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

        <form action="./save_reservation.php" method="post">
            <div class="row mt-3">
                <div class="col-12"><h4>Vehicle's information:</h4></div>
            </div>
            <div class="row mt-3">
                <div class="col-3">
                    <input type="hidden" name="vehicle_id" value="<?=$vehicle_id?>">
                    <label for="registration_number">Registration number:</label>
                    <input disabled type="text" id="registration_number" name="registration_number" class="form-control"value="<?=$registration_number?>">
                </div>
                <div class="col-3">
                    <label for="year">Year:</label>
                    <input disabled type="number" id="year" name="year" class="form-control"value="<?=$year?>">
                </div>
                <div class="col-6">
                    <label for="class_name">Class name:</label>
                    <input disabled type="text" id="class_name" name="class_name" class="form-control" value="<?=$class_name?>">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="manufacturer_name">Manufacturer name:</label>
                    <input disabled type="text" id="manufacturer_name" name="manufacturer_name" class="form-control" value="<?=$manufacturer_name?>">
                </div>
                <div class="col-6">
                    <label for="model_name">Model name:</label>
                    <input disabled type="text" id="model_name" name="model_name" class="form-control" value="<?=$model_name?>">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12"><h4>Clients's information:</h4></div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <label for="client">Choose client:</label>
                    <select name="client" id="client" class="form-control" onchange="fillClientsInfo()">
                    <option selected disabled value="">Choose client</option>
                        <?php
                        
                            $clients=getAllClients();
                            while($row=mysqli_fetch_assoc($clients)){
                                $client_id=$row['id'];
                                $client_name=$row['last_name']." ".$row['first_name'];
                                $client_passport_number=$row['passport_number'];
                                $client_country=$row['country_name'];
                                echo "<option value=\"$client_id\">$client_name</option>";
                            }

                        ?>
                    </select>
                </div>
                <div class="col-3">
                    <label for="passport_number">Passport number:</label>
                    <input type="text" name="passport_number" id="passport_number" class="form-control" disabled>
                </div>
                <div class="col-3">
                    <label for="country">Country:</label>
                    <input type="text" name="country" id="country" class="form-control" disabled>        
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12"><h4>Other information:</h4></div>
            </div>
            <div class="row mt-5">
                <div class="col-4">
                    <label for="date_from">Date from:</label>
                    <input type="date" name="date_from" id="date_from" class="form-control" >
                </div>
                <div class="col-4">
                    <label for="date_to">Date to:</label>
                    <input type="date" name="date_to" id="date_to" class="form-control" >        
                </div>
                <div class="col-4">
                    <label for="price">Price:</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-control">        
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <button class="btn btn-success float-left">Create reservation</button>
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

<script>

    async function fillClientsInfo(){
        let client_id=document.getElementById('client').value;
        let response=await fetch('./get_clients_info.php?client_id='+client_id);
        let responseJSON=await response.json();
        let client=responseJSON[0];
        document.getElementById('passport_number').value=client.passport_number;
        document.getElementById('country').value=client.country_name;
    }

</script>

</body>
</html>

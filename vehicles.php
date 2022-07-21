<?php
    include "./config/url.php";
    include "./config/connect.php";
    include "./functions.php";
    $currentPage="vehicles";
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
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include './components/sidebar.php' ?>
  
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
            <h1 class="m-0">Vehicles</h1>
          </div><!-- /.col -->
          <div class="col-6">
            <a href="./vehicles/create.php" class="btn btn-primary float-right">Add new vehicle</a>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <table class="table table-hover table-dark">
                  <thead>
                      <tr class='bg-secondary'>
                          <th>Registration number</th>
                          <th>Year</th>
                          <th>Manufacturer</th>
                          <th>Model</th>
                          <th>Class</th>
                          <th>Details-Photos</th>
                          <th>Update</th>
                          <th>Delete</th>
                          <th>Book</th>
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
                            echo "<tr>
                                    <td>$registration_number</td>
                                    <td>$year</td>
                                    <td>$manufacturer_name</td>
                                    <td>$model_name</td>
                                    <td>$class_name</td>
                                    <td><a href=\"./vehicles/details.php?vehicle_id=$v_id\" class='btn btn-outline-info'>Details</a></td>
                                    <td><a href=\"./vehicles/edit.php?id=$v_id\" class='btn btn-outline-warning'>Edit</a></td>
                                    <td><button class='btn btn-outline-danger' data-toggle=\"modal\" onclick=\"displayModalMessages('$registration_number',$v_id)\" data-target=\"#deleteModal\">Delete</button></td>
                                    <td><a href=\"./vehicles/book_vehicle.php?vehicle_id=$v_id\" class=\"btn btn-danger\">Book vehicle</a></td>
                                    </tr>";
                          }

                      ?>
                  </tbody>
              </table>

              <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete vehicle</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p id="messageParagraph">

                      </p>
                    </div>
                    <div class="modal-footer" id="modal_buttons">
                      
                    </div>
                  </div>
                </div>
              </div>

            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<script>
  function displayModalMessages(reg_num,id){
    document.getElementById('messageParagraph').innerHTML="Are you sure you want to delete vehicle: "+reg_num;
    document.getElementById('modal_buttons').innerHTML=`<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                        <a href="./vehicles/delete.php?id=${id}" class="btn btn-primary">Yes</a>`;
  }
</script>

</body>
</html>
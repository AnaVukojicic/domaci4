<?php
    include "./config/url.php";
    include "./config/connect.php";
    include "./functions.php";
    $currentPage="reservations";
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
            <h1 class="m-0">Reservations</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <a href="./vehicles.php" class="btn btn-primary float-right">Add new reservation</a>
          </div><!-- /.col -->
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
              <thead class="bg-secondary">
                <tr>
                  <th>Vehicle</th>
                  <th>Client</th>
                  <th>Date from</th>
                  <th>Date to</th>
                  <th>Price</th>
                  <th>Details</th>
                  <th>Edit</th>
                  <th>Cancel</th>
                </tr>
              </thead>
              <tbody>
                <?php
                
                  $reservations=getAllReservations();
                  while($row=mysqli_fetch_assoc($reservations)){
                    $reservation_id=$row['id'];
                    $date_from=$row['date_from'];
                    $date_to=$row['date_to'];
                    $price=$row['price'];
                    $vehicle=$row['registration_number'].": ".$row['manufacturer_name']." ".$row['model_name'];
                    $client=$row['first_name']." ".$row['last_name']." - ".$row['passport_number'];
                    $canceled=$row['is_canceled'];
                    
                    $class_row="";
                    $class_btn="btn-outline-danger";
                    $btn_text="Cancel";
                    $data_target="#cancelReservation";
                    $edit_class="";
                    if($canceled==true){
                      $class_row="bg-danger";
                      $class_btn="disabled btn-dark";
                      $btn_text="Canceled";
                      $data_target="";
                      $edit_class="d-none";
                    }

                    echo "<tr class=\"$class_row\">
                            <td>$vehicle</td>
                            <td>$client</td>
                            <td>$date_from</td>
                            <td>$date_to</td>
                            <td>$price &euro;</td>
                            <td><a href=\"./reservations/details.php?reservation_id=$reservation_id\" class=\"btn btn-outline-info $edit_class\">Details</a></td>
                            <td><a href=\"./reservations/edit.php?reservation_id=$reservation_id\" class=\"btn btn-outline-warning $edit_class\">Edit</a></td>
                            <td><button data-toggle=\"modal\" onclick=\"displayModalMessages($reservation_id)\" data-target=\"$data_target\" class=\"btn $class_btn\">$btn_text</button></td>
                          </tr>";
                  }

                ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="modal fade" id="cancelReservation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancel reservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p id="messageParagraph">
                  Are you sure you want to cancel reservation?
                </p>
              </div>
              <div class="modal-footer" id="modal_buttons">
                
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
  function displayModalMessages(id){
    document.getElementById('modal_buttons').innerHTML=`<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                        <a href="./reservations/cancel_reservation.php?reservation_id=${id}" class="btn btn-primary">Yes</a>`;
  }
</script>

</body>
</html>

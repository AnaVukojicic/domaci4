<?php
    include "./config/url.php";
    include "./config/connect.php";
    include './functions.php';
    $currentPage="manufacturers_models";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Car rental | Manufacturers Models</title>

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
          <div class="col-sm-5 offset-1">
            <h1 class="m-0">Manufacturers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <h1 class="m-0">Models</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-3">
          <div class="col-5 offset-1">
            <a href="./manufacturers_models/create_manufacturer.php" class="btn btn-primary float-left">Add new manufacturer</a>
          </div>
          <div class="col-5">
            <a href="./manufacturers_models/create_model.php" class="btn btn-primary float-left">Add new model</a>
          </div>
        </div>
        <div class="row">
            <div class="col-4 offset-1">
                <table class="table table-dark table-hover">
                  <thead class="bg-secondary">
                      <tr>
                          <th>Manufacturer name</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php

                        $manufacturers=getAllManufacturers();
                        while($m=mysqli_fetch_assoc($manufacturers)){
                          $manufacturer_id=$m['id'];
                          $manufacturer_name=$m['name'];
                          $type="manufacturer";
                          echo "<tr>
                                <td>".$manufacturer_name."</td>
                                <td><a href=\"./manufacturers_models/edit_manufacturer.php?manufacturer_id=".$manufacturer_id."\" class=\"btn btn-outline-warning\">Edit</a></td>
                                <td><button class=\"btn btn-outline-danger\" data-toggle=\"modal\" onclick=\"fillModal('".$manufacturer_name."',".$manufacturer_id.",'".$type."')\" data-target=\"#deleteModal\">Delete</button></td>
                              </tr>";
                        }
                        
                      ?>
                  </tbody>
                </table>
            </div>

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p id="msgParagraph"></p>
                  </div>
                  <div class="modal-footer" id="modalButtons">
                    
                  </div>
                </div>
              </div>
            </div>

            <div class="col-5 offset-1">
              <table class="table table-dark table-hover">
                  <thead class="bg-secondary">
                      <tr>
                          <th>Manufacturer name</th>
                          <th>Model name</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php

                      $models=getAllModels();
                      while($model=mysqli_fetch_assoc($models)){
                        $model_id=$model['id'];
                        $manufacturer_name=$model['manufacturer_name'];
                        $model_name=$model['name'];
                        $type='model';
                        echo "<tr>
                              <td>".$manufacturer_name."</td>
                              <td>".$model_name."</td>
                              <td><a href=\"./manufacturers_models/edit_model.php?model_id=".$model_id."\" class=\"btn btn-outline-warning\">Edit</a></td>
                              <td><button class=\"btn btn-outline-danger\" data-toggle=\"modal\" onclick=\"fillModal('".$model_name."',".$model_id.",'".$type."')\" data-target=\"#deleteModal\">Delete</button></td>
                            </tr>";
                      }

                    ?>
                  </tbody>
                </table>
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
  function fillModal(name,id,type){
    let url='';
    if(type=='manufacturer'){
      url=`./manufacturers_models/delete_manufacturer.php?manufacturer_id=${id}`;
    }
    if(type=='model'){
      url=`./manufacturers_models/delete_model.php?model_id=${id}`;
    }
      
    document.getElementById('msgParagraph').innerHTML=`Are you sure you want to delete ${name}`;
    document.getElementById('modalButtons').innerHTML=`<button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                            <a href="${url}" type="button" class="btn btn-primary">YES</a>`
  }
</script>

</body>
</html>

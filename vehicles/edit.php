<?php

    include '../config/connect.php';
    include '../config/url.php';
    include '../functions.php';
    $currentPage="vehicles";

    if(isset($_GET['id'])){
        $vehicle_id=$_GET['id'];
    }else{
        header('location:../vehicles.php');
        exit;
    }

    $res=getVehicleByID($vehicle_id);
    if(!$res){
        header('location:../vehicles.php');
        exit;
    }

    $registration_number=$res['registration_number'];
    $class_id=$res['class_id'];
    $manufacturer_id=$res['manufacturer_id'];
    $model_id=$res['model_id'];
    $year=$res['year'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Car rental | Edit vehicles</title>

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
            <h1 class="m-0">Edit vehicle</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
        <?php
            $errClass="d-none";
            $errMsg="";
            if(isset($_GET['err']) && $_GET['err']=='1'){
                $errClass="";
                $errMsg.="Please fill out all fields! ";
            }
            // if(isset($_GET['err']) && $_GET['err']=='2'){
            //     $errClass="";
            //     $errMsg.="Please check if you have inserted any images!";
            // }
        ?>

       
        <div class="row">
            <div class="col-12 alert alert-danger <?=$errClass?>">
                <?=$errMsg?>
            </div>
        </div>

        <form action="./update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$vehicle_id?>">
            <div class="row">
                <div class="col-6">
                    <label for="registration_number">Registration number:</label>
                    <input type="text" name="registration_number" id="registration_number" class="form-control" 
                        pattern="[A-Z]{4}[0-9]{3}" placeholder="PGHK003" value="<?=$registration_number?>">
                </div>
                <div class="col-6">
                    <label for="class">Class:</label>
                    <select name="class" id="class" class="form-control">
                        <?php

                            $res=getAllClasses();
                            while($row=mysqli_fetch_assoc($res)){
                                $classID=$row['id'];
                                $className=$row['name'];
                                $selected="";
                                if($classID==$class_id){
                                    $selected="selected";
                                }
                                echo "<option value=\"$classID\" $selected>$className</option>";
                            }

                        ?>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <label for="manufacturer">Manufacturer:</label>
                    <select name="manufacturer" id="manufacturer" class="form-control" onchange="loadModels()">
                            <?php

                                $res=getAllManufacturers();
                                while($row=mysqli_fetch_assoc($res)){
                                    $manufacturerID=$row['id'];
                                    $manufacturerName=$row['name'];
                                    $selected="";
                                    if($manufacturerID==$manufacturer_id){
                                        $selected="selected";
                                    }
                                    echo "<option value=\"$manufacturerID\" $selected>$manufacturerName</option>";   
                                }

                            ?>
                    </select>
                </div>
                <div class="col-6">
                <label for="model">Model:</label>
                    <select name="model" id="model" class="form-control">
                        <?php

                            $res=getAllModels();
                            while($row=mysqli_fetch_assoc($res)){
                                $modelID=$row['id'];
                                $modelName=$row['name'];
                                $selected="";
                                if($modelID==$model_id){
                                    $selected="selected";
                                    echo "<option value=\"$modelID\" $selected>$modelName</option>";
                                }
                                
                            }

                        ?>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <label for="year">Year:</label>
                    <input type="number" id="year" class="form-control" name="year" value="<?=$year?>">
                </div>
                <div class="col-6">
                    <label class="d-block" for="images">Images:</label>
                    <input type="file" id="images" name="images[]" multiple class="form-control">
                </div>

            </div>
            <div class="row mt-5">
                <div class="col-2">
                    <button class="btn btn-success btn-block">Save changes</button>
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

    async function loadModels(){
        let manufacturerID=document.getElementById('manufacturer').value;
        let response=await fetch("./getModels.php?manufacturer_id="+manufacturerID);
        let responseJSON=await response.json();
        let modelsHTML="";
        responseJSON.forEach(model=>{
            modelsHTML+=`<option value="${model.id}">${model.name}</option>`;
        });
        document.getElementById('model').innerHTML=modelsHTML;

    }    

</script>

</body>
</html>
<?php

    include '../config/connect.php';
    include '../functions.php';

    $registration_number=getInputs($_POST,'registration_number');
    $year=getInputs($_POST,'year');
    $class_id=getInputs($_POST,'class');
    $manufacturer_id=getInputs($_POST,'manufacturer');
    $model_id=getInputs($_POST,'model');


    if($registration_number==false || $year==false ||$class_id==false || $manufacturer_id==false || $model_id==false){
        header('location:./create.php?err=1');
        exit;
    }

    $sqlTransaction=mysqli_query($db_connection,"BEGIN;");

    $res=insertVehicle($registration_number,$year,$class_id,$manufacturer_id,$model_id);

    if($res){
        $upload_dir="uploads/";
        $allowed_extensions=['png','jpg','jpeg'];
        $vehicle_id=mysqli_insert_id($db_connection);
        $errImg=false;

        if(isset($_FILES) && count($_FILES)>0){
            foreach($_FILES['images']['error'] as $err){
                if($err!=0){
                    $sqlTransaction=mysqli_query($db_connection,"ROLLBACK;");
                    header('location:./create.php?err=2');
                    exit;
                }
            }
            foreach($_FILES['images']['name'] as $key=>$file_name){
                $path=uploadFile($allowed_extensions,$upload_dir,$file_name,$_FILES['images']['tmp_name'][$key],1);
                $sqlImg="INSERT INTO images(path,vehicle_id) VALUES('$path',$vehicle_id)";
                $resImg=mysqli_query($db_connection,$sqlImg);
                if(!$resImg){
                    $sqlTransaction=mysqli_query($db_connection,"ROLLBACK;");
                    $errImg=true;
                    break;
                }
            }
            if(!$errImg){
                $sqlTransaction=mysqli_query($db_connection,"COMMIT;");
            }
        }else{
            $sqlTransaction=mysqli_query($db_connection,"ROLLBACK;");
            header('location:./create.php?err=CouldNotLoadFiles');
            exit;
        }

        header('location:../vehicles.php');
        exit;
    }else{
        $sqlTransaction=mysqli_query($db_connection,"ROLLBACK;");
        header('location:./create.php?msg=Error');
        exit;
    }
?>
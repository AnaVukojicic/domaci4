<?php

    include '../config/connect.php';
    include '../functions.php';

    if(isset($_GET['class_id'])){
        $class_id=$_GET['class_id'];
    }else{
        header('location:../vehicle_classes.php?msg=ErrorDeleting');
        exit;
    }

    $res=deleteClass($class_id);

    if(!$res){
        header('location:../vehicle_classes.php?msg=ErrorDeleting');
        exit;
    }else{
        header('location:../vehicle_classes.php');
        exit;
    }
?>
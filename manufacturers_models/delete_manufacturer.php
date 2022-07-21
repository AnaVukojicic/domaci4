<?php

    include '../config/connect.php';
    include '../functions.php';

    if(isset($_GET['manufacturer_id'])){
        $manufacturer_id=$_GET['manufacturer_id'];
    }else{
        header('location:../manufacturers_models.php?msg=ErrorDeleting');
        exit;
    }

    $res=deleteManufacturer($manufacturer_id);

    if(!$res){
        header('location:./manufacturers_models.php?msg=ErrorDeleting');
        exit;
    }else{
        header('location:../manufacturers_models.php');
        exit;
    }
?>
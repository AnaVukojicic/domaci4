<?php

    include '../config/connect.php';
    include '../functions.php';

    $name=getInputs($_POST,'name');

    if($name==false){
        header('location:./create_manufacturer.php?err=1');
        exit;
    }

    $res=saveManufacturer($name);

    if(!$res){
        header('location:./create_manufacturer.php?msg=ErrorCreating');
        exit;
    }else{
        header('location:../manufacturers_models.php');
        exit;
    }
?>
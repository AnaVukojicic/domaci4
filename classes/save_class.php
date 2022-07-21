<?php

    include '../config/connect.php';
    include '../functions.php';

    $name=getInputs($_POST,'name');

    if($name==false){
        header('location:../vehicle_classes.php?err=1');
        exit;
    }

    $res=saveClass($name);

    if(!$res){
        header('location:../vehicle_classes.php?msg=ErrorCreating');
        exit;
    }else{
        header('location:../vehicle_classes.php');
        exit;
    }
?>
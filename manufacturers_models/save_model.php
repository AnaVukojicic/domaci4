<?php

    include '../config/connect.php';
    include '../functions.php';

    $name=getInputs($_POST,'name');
    $manufacturer_id=getInputs($_POST,'manufacturer');

    if($name==false){
        header('location:./create_model.php?err=1');
        exit;
    }

    $res=saveModel($name,$manufacturer_id);

    if(!$res){
        header('location:./create_model.php?msg=ErrorCreating');
        exit;
    }else{
        header('location:../manufacturers_models.php');
        exit;
    }
?>
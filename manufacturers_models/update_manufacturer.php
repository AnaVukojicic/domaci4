<?php

    include '../config/connect.php';
    include '../functions.php';

    $id=getInputs($_POST,'id');
    $name=getInputs($_POST,'name');

    if($name==false){
        header('location:./edit_manufacturer.php?manufacturer_id='.$id.'&err=1');
        exit;
    }

    $res=updateManufacturer($id,$name);

    if(!$res){
        header('location:./edit_manufacturer.php?manufacturer_id='.$id.'&msg=ErrorUpdating');
        exit;
    }else{
        header('location:../manufacturers_models.php');
        exit;
    }
?>
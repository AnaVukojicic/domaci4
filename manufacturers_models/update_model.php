<?php

    include '../config/connect.php';
    include '../functions.php';

    $id=getInputs($_POST,'id');
    $name=getInputs($_POST,'name');
    $manufacturer_id=getInputs($_POST,'manufacturer');

    if($name==false){
        header('location:./edit_model.php?model_id='.$id.'&err=1');
        exit;
    }

    $res=updateModel($id,$name,$manufacturer_id);

    if(!$res){
        header('location:./edit_model.php?model_id='.$id.'&msg=ErrorUpdating');
        exit;
    }else{
        header('location:../manufacturers_models.php');
        exit;
    }
?>
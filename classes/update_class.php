<?php

    include '../config/connect.php';
    include '../functions.php';

    $id=getInputs($_POST,'id');
    $name=getInputs($_POST,'name');

    if($name==false){
        header('location:./edit_class.php?class_id='.$id.'&err=1');
        exit;
    }

    $res=updateClass($id,$name);

    if(!$res){
        header('location:./edit_class.php?class_id='.$id.'&msg=ErrorUpdating');
        exit;
    }else{
        header('location:../vehicle_classes.php');
        exit;
    }
?>
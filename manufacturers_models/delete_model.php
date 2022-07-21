<?php

    include '../config/connect.php';
    include '../functions.php';

    if(isset($_GET['model_id'])){
        $model_id=$_GET['model_id'];
    }else{
        header('location:../manufacturers_models.php?msg=ErrorDeleting');
        exit;
    }

    $res=deleteModel($model_id);

    if(!$res){
        header('location:../manufacturers_models.php?msg=ErrorDeleting');
        exit;
    }else{
        header('location:../manufacturers_models.php');
        exit;
    }
?>
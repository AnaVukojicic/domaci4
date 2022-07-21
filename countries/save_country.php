<?php

    include '../config/connect.php';
    include '../functions.php';

    $name=getInputs($_POST,'name');

    if($name==false){
        header('location:../countries.php?err=1');
        exit;
    }

    $res=saveCountry($name);

    if(!$res){
        header('location:../countries.php?msg=ErrorCreating');
        exit;
    }else{
        header('location:../countries.php');
        exit;
    }
?>
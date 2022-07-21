<?php

    include '../config/connect.php';
    include '../functions.php';

    if(isset($_GET['country_id'])){
        $country_id=$_GET['country_id'];
    }else{
        header('location:../countries.php?msg=ErrorDeleting');
        exit;
    }

    $res=deleteCountry($country_id);

    if(!$res){
        header('location:../countries.php?msg=ErrorDeleting');
        exit;
    }else{
        header('location:../countries.php');
        exit;
    }
?>
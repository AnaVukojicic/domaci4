<?php

    include '../config/connect.php';
    include '../functions.php';

    $first_name=getInputs($_POST,'first_name');
    $last_name=getInputs($_POST,'last_name');
    $country_id=getInputs($_POST,'country');
    $passport_number=getInputs($_POST,'passport_number');

    if($first_name==false || $last_name==false || $country_id==false || $passport_number==false){
        header('location:./create_client.php?err=1');
        exit;
    }

    $res=saveClient($first_name,$last_name,$country_id,$passport_number);

    if(!$res){
        header('location:./create_client.php?msg=ErrorCreating');
        exit;
    }else{
        header('location:../clients.php');
        exit;
    }
?>
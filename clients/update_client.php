<?php

    include '../config/connect.php';
    include '../functions.php';

    $id=getInputs($_POST,'id');
    $first_name=getInputs($_POST,'first_name');
    $last_name=getInputs($_POST,'last_name');
    $country_id=getInputs($_POST,'country');
    $passport_number=getInputs($_POST,'passport_number');

    if($first_name==false || $last_name==false || $country_id==false || $passport_number==false){
        header('location:./edit_client.php?client_id='.$id.'&err=1');
        exit;
    }

    $res=updateClient($id,$first_name,$last_name,$country_id,$passport_number);

    if(!$res){
        header('location:./edit_client.php?client_id='.$id.'&msg=ErrorUpdating');
        exit;
    }else{
        header('location:../clients.php');
        exit;
    }
?>
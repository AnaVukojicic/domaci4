<?php

    include '../config/connect.php';
    include '../functions.php';

    $vehicle_id=getInputs($_POST,'vehicle_id');
    $client_id=getInputs($_POST,'client');
    $date_from=getInputs($_POST,'date_from');
    $date_to=getInputs($_POST,'date_to');
    $price=getInputs($_POST,'price');

    if($vehicle_id==false || $client_id==false || $date_from==false || $date_to==false || $price==false){
        header('location:./book_vehicle.php?vehicle_id='.$vehicle_id.'&err=1');
        exit;
    }

    $res=checkIfAvailable($vehicle_id,$date_from,$date_to);
    $row=mysqli_fetch_assoc($res);
    if($row){
        header('location:./book_vehicle.php?vehicle_id='.$vehicle_id.'&err=2');
        exit;
    }

    $res=saveReservation($date_from,$date_to,$price,$client_id,$vehicle_id);

    if(!$res){
        header('location:./index.php?msg=ErrorCreating');
        exit;
    }else{
        header('location:../index.php');
        exit;
    }
?>
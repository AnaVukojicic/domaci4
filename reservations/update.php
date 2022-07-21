<?php

    include '../config/connect.php';
    include '../functions.php';

    $id=getInputs($_POST,'reservation_id');
    $vehicle_id=getInputs($_POST,'vehicle');
    $client_id=getInputs($_POST,'client');
    $price=getInputs($_POST,'price');
    $date_from=getInputs($_POST,'date_from');
    $date_to=getInputs($_POST,'date_to');

    if($vehicle_id==false || $client_id==false || $price==false || $date_from==false || $date_to==false){
        header('location:./edit.php?reservation_id='.$id.'&err=1');
        exit;
    }

    $res=checkIfAvailableEdit($id,$vehicle_id,$date_from,$date_to);
    $row=mysqli_fetch_assoc($res);
    if($row){
        header('location:./edit.php?reservation_id='.$id.'&err=2');
        exit;
    }

    $res=updateReservation($date_from,$date_to,$price,$client_id,$vehicle_id,$id);

    if(!$res){
        header('location:./edit.php?reservation='.$id.'&msg=ErrorUpdating');
        exit;
    }else{
        header('location:../index.php');
        exit;
    }
?>
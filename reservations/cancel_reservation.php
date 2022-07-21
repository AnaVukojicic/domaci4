<?php

    include '../config/connect.php';
    include '../functions.php';

    if(isset($_GET['reservation_id'])){
        $reservation_id=$_GET['reservation_id'];
    }else{
        header('location:../index.php?msg=Error');
        exit;
    }

    $sql="UPDATE reservations SET is_canceled=true WHERE id=$reservation_id";
    $res=mysqli_query($db_connection,$sql);

    if(!$res){
        header('location:../index.php?msg=ErrorCanceling');
        exit;
    }else{
        header('location:../index.php');
        exit;
    }

?>
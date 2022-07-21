<?php

    include '../config/connect.php';
    include '../functions.php';

    if(isset($_GET['client_id'])){
        $client_id=$_GET['client_id'];
    }else{
        header('location:../clients.php?msg=ErrorDeleting');
        exit;
    }

    $res=deleteClient($client_id);

    if(!$res){
        header('location:../clients.php?msg=ErrorDeleting');
        exit;
    }else{
        header('location:../clients.php');
        exit;
    }
?>
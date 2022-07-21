<?php

    include '../config/connect.php';
    include '../functions.php';

    if(isset($_GET['client_id'])){
        $client_id=$_GET['client_id'];
    }else{
        echo json_encode([]);
    }

    $client=[];
    $client[]=getClientByID($client_id);
    echo json_encode($client);

?>
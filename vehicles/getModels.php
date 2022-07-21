<?php

    include '../config/connect.php';

    if(isset($_GET['manufacturer_id'])){
        $manufacturer_id=$_GET['manufacturer_id'];
    }else{
        echo json_encode([]);
    }

    $arr=[];
    $sql="SELECT * FROM models WHERE manufacturer_id=$manufacturer_id ORDER BY name";
    $res=mysqli_query($db_connection,$sql);
    while($row=mysqli_fetch_assoc($res)){
        $arr[]=$row;
    }
    echo json_encode($arr);

?>
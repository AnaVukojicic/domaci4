<?php

    include '../config/connect.php';
    include '../functions.php';

    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }else{
        header('location:../vehicles.php?msg=Error');
        exit;
    }

    $transaction=mysqli_query($db_connection,'BEGIN;');

    $query="SELECT path FROM images WHERE vehicle_id=$id";
    $images_res=mysqli_query($db_connection,$query);

    $res1=deleteImagesForVehicle($id);
    
    while($image=mysqli_fetch_assoc($images_res)['path']){
        $unlink=unlink('../'.$image);
        if(!$unlink){
            $transaction=mysqli_query($db_connection,'ROLLBACK;');
            exit;
        }
    }

    $res=deleteVehicle($id);

    if(!$res || !$res1){
        $transaction=mysqli_query($db_connection,'ROLLBACK;');
        header('location:../vehicles.php?msg=ErrorDeletingVehicle');
        exit;
    }else{
        $transaction=mysqli_query($db_connection,'COMMIT;');
        header('location:../vehicles.php');
        exit;
    }

?>
<?php

    include '../config/connect.php';
    include '../functions.php';

    $id=getInputs($_POST,'id');
    $name=getInputs($_POST,'name');

    if($name==false){
        header('location:./edit_country.php?country_id='.$id.'&err=1');
        exit;
    }

    $res=updateCountry($id,$name);

    if(!$res){
        header('location:./edit_country.php?country_id='.$id.'&msg=ErrorUpdating');
        exit;
    }else{
        header('location:../countries.php');
        exit;
    }
?>
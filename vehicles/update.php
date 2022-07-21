<?php

    include '../config/connect.php';
    include '../functions.php';

    $id=getInputs($_POST,'id');
    $registration_number=getInputs($_POST,'registration_number');
    $class_id=getInputs($_POST,'class');
    $manufacturer_id=getInputs($_POST,'manufacturer');
    $model_id=getInputs($_POST,'model');
    $year=getInputs($_POST,'year');

    if($registration_number==false || $class_id==false || $manufacturer_id==false || $model_id==false || $year==false){
        header('location:./edit.php?vehicle_id='.$id.'&err=1');
        exit;
    }

    $sqlTransaction=mysqli_query($db_connection,"BEGIN;");

    $res=updateVehicle($registration_number,$year,$class_id,$manufacturer_id,$model_id,$id);

    if($res){
        $upload_dir="uploads/";
        $allowed_extensions=['png','jpg','jpeg'];
        $errImg=false;

        //Ako doda nove fotografije uzmi ih i sacuvaj inace ostavi stare
        if(isset($_FILES) && count($_FILES)>0){
            //Ako nema dodatih ostavlja stare:
            $no_photos=true;
            foreach($_FILES['images']['error'] as $err){
                if($err==0){
                    $no_photos=false;
                }
            }
            if($no_photos==true){
                $sqlTransaction=mysqli_query($db_connection,"COMMIT;");
                header('location:../vehicles.php');
                exit;
            }

            //Obrisi stare fotografije:
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
            if(!$res1){
                $transaction=mysqli_query($db_connection,'ROLLBACK;');
                header('location:./edit.php?msg=ErrorDeletingOldPhotos');
                exit;
            }

            //Dodaj nove fotografije:
            foreach($_FILES['images']['name'] as $key=>$file_name){
                $path=uploadFile($allowed_extensions,$upload_dir,$file_name,$_FILES['images']['tmp_name'][$key],1);
                $sqlImg="INSERT INTO images(path,vehicle_id) VALUES('$path',$id)";
                $resImg=mysqli_query($db_connection,$sqlImg);
                if(!$resImg){
                    $sqlTransaction=mysqli_query($db_connection,"ROLLBACK;");
                    $errImg=true;
                    break;
                }
            }
            if(!$errImg){
                $sqlTransaction=mysqli_query($db_connection,"COMMIT;");
            }
        }

        header('location:../vehicles.php');
        exit;
    }else{
        $sqlTransaction=mysqli_query($db_connection,"ROLLBACK;");
        header('location:./edit.php?msg=Error');
        exit;
    }


    // $res=update($id,$first_name,$last_name,$country_id,$passport_number);

    // if(!$res){
    //     header('location:./edit_client.php?client_id='.$id.'&msg=ErrorUpdating');
    //     exit;
    // }else{
    //     header('location:../clients.php');
    //     exit;
    // }
?>
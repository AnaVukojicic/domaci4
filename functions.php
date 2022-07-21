<?php

    function getInputs($array,$key){
        if(isset($array[$key]) && $array[$key]!=""){
            return $array[$key];
        }else{
            return false;
        }
    }

    function uploadFile($allowed_extensions,$upload_dir,$client_filename,$tmp_name,$depth=0){
        $new_filename=uniqid();
        $client_extension=explode('.',$client_filename);
        $client_extension=end($client_extension);
        if(!in_array($client_extension,$allowed_extensions)){
            exit("Cannot upload files with unalowed extensions");
        }
        $new_file_name=$new_filename.".".$client_extension;
        $tmp_path=$tmp_name;
        $new_file_path=$upload_dir.$new_file_name;
        if(!copy($tmp_path,getDots($depth).$new_file_path)){
            exit("Error uploading file");
        }
        return $new_file_path;
    }

    function getDots($depth){
        $dots="";
        while($depth>0){
            $dots.="../";
            $depth--;
        }
        return $dots;
    }



    function getAllManufacturers(){
        global $db_connection;
        $sql="SELECT * FROM manufacturers ORDER BY name";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function getManufacturerByID($id){
        global $db_connection;
        $sql="SELECT * FROM manufacturers WHERE id=$id";
        $res=mysqli_query($db_connection,$sql);
        return mysqli_fetch_assoc($res);
    }

    function updateManufacturer($id,$name){
        global $db_connection;
        $sql="UPDATE manufacturers SET name='$name' WHERE id=$id";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function deleteManufacturer($id){
        global $db_connection;
        $sql="DELETE FROM manufacturers WHERE id=$id";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function saveManufacturer($name){
        global $db_connection;
        $sql="INSERT INTO manufacturers(name) VALUES('$name')";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }


    function getAllModels(){
        global $db_connection;
        $sql="SELECT models.*,manufacturers.name AS manufacturer_name FROM models 
                JOIN manufacturers ON models.manufacturer_id=manufacturers.id ORDER BY manufacturers.name";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function saveModel($name,$manufacturer_id){
        global $db_connection;
        $sql="INSERT INTO models(name,manufacturer_id) VALUES('$name',$manufacturer_id)";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function deleteModel($id){
        global $db_connection;
        $sql="DELETE FROM models WHERE id=$id";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function getModelByID($id){
        global $db_connection;
        $sql="SELECT models.*,manufacturers.name AS manufacturer_name,manufacturers.id as manufacturer_id FROM models 
                JOIN manufacturers ON models.manufacturer_id=manufacturers.id WHERE models.id=$id";
        $res=mysqli_query($db_connection,$sql);
        return mysqli_fetch_assoc($res);
    }

    function updateModel($id,$name,$manufacturer_id){
        global $db_connection;
        $sql="UPDATE models SET name='$name', manufacturer_id=$manufacturer_id WHERE id=$id";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }


    function getAllClasses(){
        global $db_connection;
        $sql="SELECT * FROM classes";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function saveClass($name){
        global $db_connection;
        $sql="INSERT INTO classes(name) VALUES('$name')";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function getClassByID($id){
        global $db_connection;
        $sql="SELECT * FROM classes WHERE id=$id";
        $res=mysqli_query($db_connection,$sql);
        return mysqli_fetch_assoc($res);
    }

    function updateClass($id,$name){
        global $db_connection;
        $sql="UPDATE classes SET name='$name' WHERE id=$id";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function deleteClass($id){
        global $db_connection;
        $sql="DELETE FROM classes WHERE id=$id";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }


    function getAllCountries(){
        global $db_connection;
        $sql="SELECT * FROM countries ORDER BY name";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function saveCountry($name){
        global $db_connection;
        $sql="INSERT INTO countries(name) VALUES('$name')";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function getCountryByID($id){
        global $db_connection;
        $sql="SELECT * FROM countries WHERE id=$id";
        $res=mysqli_query($db_connection,$sql);
        return mysqli_fetch_assoc($res);
    }

    function updateCountry($id,$name){
        global $db_connection;
        $sql="UPDATE countries SET name='$name' WHERE id=$id";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function deleteCountry($id){
        global $db_connection;
        $sql="DELETE FROM countries WHERE id=$id";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function getAllClients(){
        global $db_connection;
        $sql="SELECT clients.*,countries.name AS country_name FROM clients JOIN countries ON clients.country_id=Countries.id ORDER BY last_name";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function saveClient($first_name,$last_name,$country_id,$passport_number){
        global $db_connection;
        $sql="INSERT INTO clients(first_name,last_name,country_id,passport_number) VALUES('$first_name','$last_name',$country_id,'$passport_number')";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function getClientByID($id){
        global $db_connection;
        $sql="SELECT clients.*,countries.name AS country_name FROM clients 
            JOIN countries ON clients.country_id=countries.id WHERE clients.id=$id";
        $res=mysqli_query($db_connection,$sql);
        return mysqli_fetch_assoc($res);
    }

    function updateClient($id,$first_name,$last_name,$country_id,$passport_number){
        global $db_connection;
        $sql="UPDATE clients SET first_name='$first_name', last_name='$last_name', country_id=$country_id, 
            passport_number='$passport_number' WHERE id=$id";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function deleteClient($id){
        global $db_connection;
        $sql="DELETE FROM clients WHERE id=$id";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }


    function getAllVehicles(){
        global $db_connection;
        $sql="SELECT v.id AS v_id, v.registration_number,v.year,m.name AS manufacturer_name,md.name AS model_name,
            c.name AS class_name FROM vehicles v 
            JOIN manufacturers m ON v.manufacturer_id=m.id 
            JOIN models md ON md.id=v.model_id 
            JOIN classes c ON c.id=v.class_id
            ORDER BY m.name ASC";
         $res=mysqli_query($db_connection,$sql);
         return $res;
    }

    function getVehicleByID($id){
        global $db_connection;
        $sql="SELECT v.registration_number,v.year,v.class_id,v.manufacturer_id,v.model_id,
            m.name AS manufacturer_name,md.name AS model_name,
            c.name AS class_name FROM vehicles v 
            JOIN manufacturers m ON v.manufacturer_id=m.id 
            JOIN models md ON md.id=v.model_id 
            JOIN classes c ON c.id=v.class_id
            WHERE v.id=$id";
        $res=mysqli_query($db_connection,$sql);
        return mysqli_fetch_assoc($res);
    }

    function insertVehicle($registration_number,$year,$class_id,$manufacturer_id,$model_id){
        global $db_connection;
        $sql="INSERT INTO vehicles(registration_number,year,class_id,manufacturer_id,model_id) 
        VALUES('$registration_number',$year,$class_id,$manufacturer_id,$model_id)";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function updateVehicle($registration_number,$year,$class_id,$manufacturer_id,$model_id,$id){
        global $db_connection;
        $sql="UPDATE vehicles SET registration_number='$registration_number',year='$year',class_id='$class_id',
            manufacturer_id=$manufacturer_id,model_id=$model_id
            WHERE id=$id";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function deleteVehicle($id){
        global $db_connection;
        $sql="DELETE FROM vehicles WHERE id=$id";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function deleteImagesForVehicle($vehicle_id){
        global $db_connection;
        $sql="DELETE FROM images WHERE vehicle_id=$vehicle_id";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function saveReservation($date_from,$date_to,$price,$client_id,$vehicle_id){
        global $db_connection;
        $sql="INSERT INTO reservations(date_from,date_to,price,client_id,vehicle_id) VALUES('$date_from','$date_to','$price',$client_id,$vehicle_id)";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function checkIfAvailable($vehicle_id,$date_from,$date_to){
        $new_date_from=date('Y-m-d',strtotime($date_from));
        $new_date_to=date('Y-m-d',strtotime($date_to));
        global $db_connection;
        $sql="SELECT * FROM reservations WHERE vehicle_id=$vehicle_id 
            AND (('$new_date_from' BETWEEN date_from AND date_to) OR ('$new_date_to' BETWEEN date_from AND date_to))
            AND is_canceled=false";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }


    function getAllReservations(){
        global $db_connection;
        $sql="SELECT r.*,v.registration_number AS registration_number,m.name AS manufacturer_name,md.name AS model_name,
            c.first_name AS first_name,c.last_name AS last_name,c.passport_number AS passport_number 
            FROM reservations r JOIN vehicles v ON r.vehicle_id=v.id 
            JOIN manufacturers m ON v.manufacturer_id=m.id
            JOIN models md ON v.model_id=md.id
            JOIN clients c ON r.client_id=c.id";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function getReservationByID($reservation_id){
        global $db_connection;
        $sql="SELECT * FROM reservations WHERE id=$reservation_id";
        $res=mysqli_query($db_connection,$sql);
        return mysqli_fetch_assoc($res);
    }

    function checkIfAvailableEdit($id,$vehicle_id,$date_from,$date_to){
        $new_date_from=date('Y-m-d',strtotime($date_from));
        $new_date_to=date('Y-m-d',strtotime($date_to));
        global $db_connection;
        $sql="SELECT * FROM reservations WHERE vehicle_id=$vehicle_id 
            AND (('$new_date_from' BETWEEN date_from AND date_to) OR ('$new_date_to' BETWEEN date_from AND date_to))
            AND is_canceled=false AND NOT id=$id";
        $res=mysqli_query($db_connection,$sql);
        return $res;
    }

    function updateReservation($date_from,$date_to,$price,$client_id,$vehicle_id,$id){
        global $db_connection;
        $sql="UPDATE reservations SET date_from='$date_from',date_to='$date_to',price='$price',client_id=$client_id,vehicle_id=$vehicle_id
            WHERE id=$id";
        $res=mysqli_query($db_connection,$sql);
        return mysqli_fetch_assoc($res);
    }
?>
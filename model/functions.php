<?php

require("conexion.php");

if (isset($_POST["login"])) {
    if (validateLogin() != null) {
        header('Location:../admin/home_admin.php?info=1');
    } else {
        header('Location:../admin/login.php?info=1');
    }
}

if (isset($_POST['newMarker'])) {
    newMarker();
    header('Location: ../admin/home_admin.php');
}

if (isset($_POST['saveEntity'])) {
    saveEntity();
    header('Location: ../admin/home_admin.php');
}

if (isset($_POST['saveCountryCenterPoint'])) {
    saveCountryCenterPoint();
    header('Location: ../admin/home_admin.php');
}

function saveCountryCenterPoint(){
    $con = Conexion::getConnection();
    $queryEntity = "UPDATE basic_data SET latitude = '" . $_POST['latitude'] . "', longitude = '" . $_POST['longitude'] . "', zoom = " . $_POST['zoom'] . " WHERE id = 1";                    
    $con->query($queryEntity);    
}

function saveEntity(){
    $con = Conexion::getConnection();
    $queryEntity = "UPDATE basic_data SET entity = '" . $_POST['entity'] . "' WHERE id = 1";                
    $con->query($queryEntity);    
}
function newMarker()
{
    $con = Conexion::getConnection();
    $queryMarker = "INSERT INTO entity_markers (item_name, latitude, longitude)VALUES ('" . $_POST['item_name'] . "'," . $_POST['latitude'] . "," . $_POST['longitude'] . ")";
    $con->query($queryMarker);    
    
}

function getAllMarkers(){
    $con = Conexion::getConnection();
    $queryUser = "SELECT * FROM entity_markers";
    $result = $con->query($queryUser);
    return $result;
}
function validateLogin()
{
    $con = Conexion::getConnection();
    $queryUser = "SELECT * FROM users WHERE username='" . $_POST['username'] . "' AND password='" . $_POST['password'] . "'";
    $result = $con->query($queryUser);
    if ($result != null) {
        if ($result->num_rows > 0) {
            print_r($result);
            return $result;
        }
    } else {
        return null;
    }
}

function getBasicData()
{
    $con = Conexion::getConnection();
    $queryUser = "SELECT * FROM basic_data WHERE id=1";
    $result = $con->query($queryUser);
    return $result->fetch_assoc();
}

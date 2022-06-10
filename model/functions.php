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

if (isset($_POST['saveWebsiteData'])) {
    saveWebsiteData();
    header('Location: ../admin/home_admin.php');
}
if (isset($_GET['edit_marker'])) {
    header('Location: ../admin/home_admin.php?edit_marker_functions=1&id='.$_GET['id']);
}

if (isset($_POST['delete_marker'])) {
    deleteMarker($_POST['markerId_delete']);
    header('Location: ../admin/home_admin.php');
}


function deleteMarker($id)
{
    $con = Conexion::getConnection();
    $queryMarker = "DELETE FROM entity_markers WHERE id=" . $id;
    $con->query($queryMarker);
}

function getMarkerDataById($id)
{
    $con = Conexion::getConnection();
    $queryMarker = "SELECT * FROM entity_markers WHERE id=".$id;
    $result = $con->query($queryMarker);
    return $result->fetch_assoc();
}

function editMarker()
{
    $con = Conexion::getConnection();
    $queryMarker = "UPDATE entity_markers SET item_name = '".$_POST['item_name']."', latitude = '".$_POST['latitude']."', longitude = '".$_POST['longitude']."' WHERE id=" . $_POST['id'];
    $con->query($queryMarker);
}

function saveWebsiteData()
{
    $con = Conexion::getConnection();
    $queryEntity = "UPDATE website_data SET name = '" . $_POST['name'] . "', main_title = '" . $_POST['main_title'] . "', subtitle = '" . $_POST['subtitle'] . "', use_policy = '" . $_POST['use_policy'] . "', copyright = '" . $_POST['copyright'] . "', youtube_link = '" . $_POST['youtube_link'] . "', facebook_link = '" . $_POST['facebook_link'] . "', twitter_link = '" . $_POST['twitter_link'] . "' WHERE code = 'web1'";
    $con->query($queryEntity);
}


function saveCountryCenterPoint()
{
    $con = Conexion::getConnection();
    $queryEntity = "UPDATE basic_data SET country_name = '" . $_POST['country_name'] . "', latitude = '" . $_POST['latitude'] . "', longitude = '" . $_POST['longitude'] . "', zoom = " . $_POST['zoom'] . " WHERE code = 'data1'";
    $con->query($queryEntity);
}

function saveEntity()
{
    $con = Conexion::getConnection();
    $queryEntity = "UPDATE basic_data SET entity = '" . $_POST['entity'] . "' WHERE code = 'data1'";
    $con->query($queryEntity);
}
function newMarker()
{
    $con = Conexion::getConnection();
    $queryMarker = "INSERT INTO entity_markers (item_name, latitude, longitude)VALUES ('" . $_POST['item_name'] . "'," . $_POST['latitude'] . "," . $_POST['longitude'] . ")";
    //echo $queryMarker;
    $con->query($queryMarker);
}

function getAllMarkers()
{
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
    $queryUser = "SELECT * FROM basic_data WHERE code='data1'";
    $result = $con->query($queryUser);
    return $result->fetch_assoc();
}

function getWebsiteData()
{
    $con = Conexion::getConnection();
    $queryUser = "SELECT * FROM website_data WHERE code='web1'";
    $result = $con->query($queryUser);
    return $result->fetch_assoc();
}

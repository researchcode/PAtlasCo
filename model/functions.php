<?php

require("conexion.php");

if (isset($_POST["login"])) {
    if (validateLogin() != null) {
        header('Location:../admin/home_admin.php?info=1');
    } else {
        header('Location:../admin/login.php?info=1');
    }
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

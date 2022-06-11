<?php
if (!defined('CONFIG_PATH')) {
    define('CONFIG_PATH', '../');
}

if (!defined('CSS_PATH')) {
    define('CSS_PATH', '../css/');
}

require_once( CSS_PATH . "../config.php");

class Conexion
{
    public static function getConnection()
    {
        $conector = new mysqli(HOST, USER, PASSWORD, DATABASE);
        if (mysqli_connect_errno()) {
            echo "Conexion error.";
        }
        return $conector;
    }
}
?>

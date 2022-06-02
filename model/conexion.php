<?php
if (!defined('CONFIG_PATH')) {
    define('CONFIG_PATH', '../');
}

require_once(CONFIG_PATH . "config.php");

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

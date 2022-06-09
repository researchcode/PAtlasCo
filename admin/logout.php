<?php

if (!defined('CSS_PATH')) {
    define('CSS_PATH', '../css/');
}

session_start();
if (isset($_SESSION['user_user'])) {
    unset($_SESSION['user_user']);
    header('Location: ../admin/login.php');
} 

if (isset($_SESSION['admin_admin'])) {
    unset($_SESSION['admin_admin']);
    header('Location: ../admin/login.php');
}
?>
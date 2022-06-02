<?php

class Functions{
    public $con = Conexion::getConnection();
    function validateLogin(){
        
        $queryViaje = "SELECT * FROM users WHERE username=" . $_POST['username'] . "AND password=" . $_POST['password'];
        $result = $this->con->query($queryViaje);
        if ($result->num_rows > 0) {
            return $result;
        }
        return null;
    }
}
?>
<?php
function conectar() {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }
    return $conexion;
}

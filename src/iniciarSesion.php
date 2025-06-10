<?php
require_once 'conexion.php';

function iniciarSesion($usuario, $contraseña) {
    $conexion = conectar();

    $stmt = $conexion->prepare("SELECT num_doc, pass FROM registro WHERE num_doc = ?");
    $stmt->bind_param("i", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hash);
        $stmt->fetch();
        if (password_verify($contraseña, $hash)) {
            return $id;
        }
    }

    return false;
}

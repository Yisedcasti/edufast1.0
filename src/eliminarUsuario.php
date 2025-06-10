<?php
require_once 'conexion.php';

function eliminarUsuario($id) {
    $conexion = conectar();

    $stmt = $conexion->prepare("DELETE FROM registro WHERE num_doc = ?");
    $stmt->bind_param("i", $id);
    $resultado = $stmt->execute();

    $stmt->close();
    $conexion->close();
    return $resultado;
}

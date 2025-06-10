<?php
require_once 'conexion.php';

function registrarUsuario($datos) {
    $conexion = conectar();

    $stmt = $conexion->prepare("INSERT INTO registro (
        num_doc, tipo_doc, nombres, apellidos, celular, telefono, direccion, correo, pass, rol_id_rol, jornada_id_jornada
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $hash = password_hash($datos['pass'], PASSWORD_DEFAULT);

    $stmt->bind_param("ssssssssssi",
        $datos['num_doc'],
        $datos['tipo_doc'],
        $datos['nombres'],
        $datos['apellidos'],
        $datos['celular'],
        $datos['telefono'],
        $datos['direccion'],
        $datos['correo'],
        $hash,
        $datos['rol_id_rol'],
        $datos['jornada_id_jornada']
    );

    $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();
    return $resultado;
}

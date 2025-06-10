<?php
require_once 'conexion.php';

function actualizarUsuario($id, $datos) {
    $conexion = conectar();

    $stmt = $conexion->prepare("UPDATE registro SET 
        tipo_doc = ?, 
        nombres = ?, 
        apellidos = ?, 
        celular = ?, 
        telefono = ?, 
        direccion = ?, 
        correo = ?, 
        pass = ?, 
        rol_id_rol = ?, 
        jornada_id_jornada = ? 
        WHERE num_doc = ?");

    $hash = password_hash($datos['pass'], PASSWORD_DEFAULT);

    $stmt->bind_param("sssssssssii",
        $datos['tipo_doc'],
        $datos['nombres'],
        $datos['apellidos'],
        $datos['celular'],
        $datos['telefono'],
        $datos['direccion'],
        $datos['correo'],
        $hash,
        $datos['rol_id_rol'],
        $datos['jornada_id_jornada'],
        $id
    );

    $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();
    return $resultado;
}

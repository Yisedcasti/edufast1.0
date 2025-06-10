<?php
function registrarLogro($datos) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("INSERT INTO logro (
    id_logro,
nombre_logro,
descripcion_logro,
grado_id_grado,
materia_id_materia) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issii", $datos['id_logro'], $datos['nombre_logro'], $datos['descripcion_logro'], $datos['grado_id_grado'], $datos['materia_id_materia']);
    return $stmt->execute();
}

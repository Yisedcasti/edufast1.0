<?php
function actualizarLogro($id, $datos) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("UPDATE logro SET nombre_logro = ?, descripcion_logro = ?, grado_id_grado = ?, materia_id_materia = ? WHERE id_logro = ?");
    $stmt->bind_param("ssiii", $datos['nombre_logro'], $datos['descripcion_logro'], $datos['grado_id_grado'], $datos['materia_id_materia'], $id);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }
    return $stmt->execute();
}

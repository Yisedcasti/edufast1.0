<?php
function eliminarAsistencia($id) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("DELETE FROM asistencia WHERE id_asistencia = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

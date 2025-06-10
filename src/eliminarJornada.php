<?php
function eliminarJornada($id) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("DELETE FROM jornada WHERE id_jornada = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

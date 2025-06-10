<?php
function eliminarMateria($id) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("DELETE FROM materia WHERE id_materia = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

<?php
function eliminarActividad($id) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("DELETE FROM actividad WHERE id_actividad = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

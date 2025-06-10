<?php
function eliminarLogro($id) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("DELETE FROM logro WHERE id_logro = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

<?php
function eliminarNota($id) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("DELETE FROM nota WHERE id_nota = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

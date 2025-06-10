<?php
function actualizarMateria($id, $datos) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("UPDATE materia SET materia = ?, area_id_area = ? WHERE id_materia = ?");
    $stmt->bind_param("ssi", $datos['materia'], $datos['area_id_area'],$id);
    return $stmt->execute();
}

<?php
function registrarMateria($datos) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("INSERT INTO materia (materia, area_id_area) VALUES (?, ?)");
    $stmt->bind_param("si", $datos['materia'], $datos['area_id_area']);
    return $stmt->execute();
}

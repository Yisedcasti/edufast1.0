<?php
function registrarJornada($datos) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("INSERT INTO jornada (jornada, hora_inicio, hora_final) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $datos['jornada'], $datos['hora_inicio'], $datos['hora_final']);
    return $stmt->execute();
}

<?php
function actualizarJornada($id, $datos) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("UPDATE jornada SET jornada = ?, hora_inicio = ?, hora_final = ? WHERE id_jornada = ?");
    $stmt->bind_param("sssi", $datos['jornada'], $datos['hora_inicio'], $datos['hora_final'], $id);
    return $stmt->execute();
}

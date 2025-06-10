<?php
function registrarNota($datos) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("INSERT INTO nota (fecha_nota, nota, matricula_id_matricula, actividad_id_actividad) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $datos['fecha_nota'], $datos['nota'], $datos['matricula_id_matricula'], $datos['actividad_id_actividad']);
    return $stmt->execute();
}

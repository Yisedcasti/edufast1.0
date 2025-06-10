<?php
function registrarActividad($datos) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("INSERT INTO actividad 
        (nombre_act, descripcion, fecha_entrega, docente_has_materia_docente_id_docente, logro_grado_id_grado, logro_id_logro, logro_materia_id_materia)
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sssiiii",
        $datos['nombre_act'],
        $datos['descripcion'],
        $datos['fecha_entrega'],
        $datos['docente_has_materia_docente_id_docente'],
        $datos['logro_grado_id_grado'],
        $datos['logro_id_logro'],
        $datos['logro_materia_id_materia']
    );
    return $stmt->execute();
}

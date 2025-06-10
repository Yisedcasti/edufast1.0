<?php
function actualizarActividad($id, $datos) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("UPDATE actividad SET 
        nombre_act = ?, 
        descripcion = ?, 
        fecha_entrega = ?, 
        docente_has_materia_docente_id_docente = ?, 
        logro_grado_id_grado = ?, 
        logro_id_logro = ?, 
        logro_materia_id_materia = ?
        WHERE id_actividad = ?");
    $stmt->bind_param(
        "sssiiiii",
        $datos['nombre_act'],
        $datos['descripcion'],
        $datos['fecha_entrega'],
        $datos['docente_has_materia_docente_id_docente'],
        $datos['logro_grado_id_grado'],
        $datos['logro_id_logro'],
        $datos['logro_materia_id_materia'],
        $id
    );
    return $stmt->execute();
}

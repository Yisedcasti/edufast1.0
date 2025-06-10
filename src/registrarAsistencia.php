<?php
function registrarAsistencia($datos) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("INSERT INTO asistencia (
fecha_asistencia,
asistencia,
matricula_id_matricula,
matricula_grado_id_grado,
matricula_cursos_id_cursos,
matricula_estudiante_id_estudiante,
matricula_estudiante_registro_num_doc,
matricula_estudiante_registro_rol_id_rol,
matricula_estudiante_registro_jornada_id_jornada) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiissss", $datos['fecha_asistencia'], $datos['asistencia'], $datos['matricula_id_matricula'], $datos['matricula_grado_id_grado'], $datos['matricula_cursos_id_cursos'], $datos['matricula_estudiante_id_estudiante'], $datos['matricula_estudiante_registro_num_doc'], $datos['matricula_estudiante_registro_rol_id_rol'], $datos['matricula_estudiante_registro_jornada_id_jornada']);
    return $stmt->execute();
}

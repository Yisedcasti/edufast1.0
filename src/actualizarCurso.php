<?php
function actualizarCurso($id, $datos) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $curso = $conexion->real_escape_string($datos['curso']);
    $grado = (int)$datos['grado_id_grado'];

    return $conexion->query("UPDATE cursos SET curso = '$curso', grado_id_grado = $grado WHERE id_cursos = $id");
}

<?php
function registrarCurso($datos) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $curso = $conexion->real_escape_string($datos['curso']);
    $grado = (int)$datos['grado_id_grado'];

    return $conexion->query("INSERT INTO cursos (curso, grado_id_grado) VALUES ('$curso', $grado)");
}

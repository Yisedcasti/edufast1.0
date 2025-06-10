<?php
function eliminarCurso($id) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    return $conexion->query("DELETE FROM cursos WHERE id_cursos = $id");
}

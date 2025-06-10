<?php
function actualizarGrado($id, $datos) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $nivel = $conexion->real_escape_string($datos['nivel_educativo']);
    $grado = $conexion->real_escape_string($datos['grado']);
    return $conexion->query("UPDATE grado SET nivel_educativo = '$nivel', grado = '$grado' WHERE id_grado = $id");
}

<?php
function registrarGrado($datos) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $nivel = $conexion->real_escape_string($datos['nivel_educativo']);
    $grado = $conexion->real_escape_string($datos['grado']);
    return $conexion->query("INSERT INTO grado (nivel_educativo, grado) VALUES ('$nivel', '$grado')");
}

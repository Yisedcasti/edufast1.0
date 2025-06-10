<?php
function eliminarGrado($id) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    return $conexion->query("DELETE FROM grado WHERE id_grado = $id");
}

<?php
function registrarNoticia($datos) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("INSERT INTO public_noticias (titulo, info, registro_num_doc) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $datos['titulo'], $datos['info'], $datos['registro_num_doc']);
    return $stmt->execute();
}

<?php
function eliminarNoticia($id) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("DELETE FROM public_noticias WHERE id_noticia = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

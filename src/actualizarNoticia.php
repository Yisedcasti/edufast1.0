<?php
function actualizarNoticia($id, $datos) {
    $conexion = new mysqli("localhost", "root", "", "edufast");
    $stmt = $conexion->prepare("UPDATE public_noticias SET titulo = ?, info = ?, registro_num_doc = ? WHERE id_noticia = ?");
    $stmt->bind_param("ssii", $datos['titulo'], $datos['info'], $datos['registro_num_doc'], $id);
    return $stmt->execute();
}

<?php
include "Conexion.php"; 
$sentencia = $base_de_datos->query(" SELECT materia.*, grado.*, area.*
FROM materia
INNER JOIN grado ON materia.grado_id_grado = grado.id_grado
INNER JOIN area ON materia.area_id_area = area.id_area
ORDER BY area.nombre_area ASC;  
;");

$materias = $sentencia->fetchAll(PDO::FETCH_OBJ);
$grados = $base_de_datos->query("SELECT * FROM grado")->fetchAll(PDO::FETCH_ASSOC);
$areas = $base_de_datos->query("SELECT * FROM area")->fetchAll(PDO::FETCH_ASSOC);

?>
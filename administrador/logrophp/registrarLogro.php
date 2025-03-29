<?php
if(!isset($_POST["id_logro"]) || !isset($_POST["nombre_logro"]) || !isset($_POST["descrip_logro"]) || !isset($_POST["id_materia"])) exit();
include_once"conexion.php";
$id_logro=$_POST["id_logro"];
$nombre_logro=$_POST["nombre_logro"];
$descrip_logro=$_POST["descrip_logro"];
$id_materia=$_POST["id_materia"];

$consultar = $base_de_datos->prepare("SELECT 
        grado_id_grado, 		
		area_id_area
FROM materia WHERE id_materia = ?");
$consultar->execute([$id_materia]);
$resultado = $consultar->fetch(PDO::FETCH_ASSOC);

if (!$resultado) {
    exit("No se encontró información para este docente.");
}

$area_id_area  = $resultado['area_id_area'];

$sentencia = $base_de_datos->prepare("INSERT INTO logro (
        id_logro,
        nombre_logro, 
        descripcion_logro, 
        materia_id_materia,
        materia_grado_id_grado, 		
		materia_area_id_area ) VALUES (?,?,?,?,?,?)");
$resultado =  $sentencia->execute([$id_logro ,
$nombre_logro,
$descrip_logro,
$id_materia,
$grado_id_grado,
$area_id_area ]);
if($resultado === TRUE){  header("Location: logros.php?status=success");
	exit();
}
else {  header("Location: logros.php?status=success");
	exit();
}
?>
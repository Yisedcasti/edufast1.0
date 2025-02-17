<?php
include_once "../configuracion/conexion.php";

// Realiza la consulta a la base de datos
try {
 // Obtener los grados de la base de datos
 $gradosSql = "SELECT * FROM grado";
 $gradosStmt = $base_de_datos->prepare($gradosSql);
 $gradosStmt->execute();
 $grados = $gradosStmt->fetchAll(PDO::FETCH_ASSOC);
 
 // Verifica si la consulta devuelve resultados
 if ($grados === false || count($grados) == 0) {
     echo "No se encontraron grados en la base de datos.";
 } else {
     echo "Se encontraron " . count($grados) . " grados.";
 }
 
 
 // Obtener los cursos de la base de datos
 $cursosSql = "SELECT *  FROM cursos";
 $cursosStmt = $base_de_datos->prepare($cursosSql);
 $cursosStmt->execute();
 $cursos = $cursosStmt->fetchAll(PDO::FETCH_ASSOC);
    
    $jornadas = $base_de_datos->query("SELECT * FROM jornada")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<?php
require_once "../configuracion/conexion.php";

try {
    $id_materia = $_GET['id'];

    $sentencia = $base_de_datos->prepare("
        SELECT logro.*, materia.*, grado.*
        FROM logro
        INNER JOIN materia ON materia.id_materia = logro.materia_id_materia
        INNER JOIN grado ON grado.id_grado = logro.grado_id_grado
        WHERE materia.id_materia = :id_materia
    ");
    
    $sentencia->execute([':id_materia' => $id_materia]);
    $logros = $sentencia->fetchAll(PDO::FETCH_OBJ);

    $materias = $base_de_datos->query("SELECT * FROM materia")->fetchAll(PDO::FETCH_ASSOC);

    $grados = $base_de_datos->query("SELECT * FROM grado")->fetchAll(PDO::FETCH_ASSOC);

    if (empty($logros)) {
        header("Location: ../vistas/logros.php?status=error");
        exit();
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<?php
require_once '../configuracion/conexion.php';
date_default_timezone_set('America/Bogota');

// Validar que se recibieron los datos necesarios
if (
    !isset($_POST['id_nota']) ||
    !isset($_POST['actividad_id_actividad']) ||
    !isset($_POST['nota'])
) {
    header("Location: ../notas.php?status=error");
    exit;
}

$id_nota = $_POST['id_nota'];
$actividad_id = $_POST['actividad_id_actividad'];
$nota = $_POST['nota'];
$fecha_nota = date('Y-m-d');

// Obtener el id_estudiante antes de actualizar
$stmtEst = $base_de_datos->prepare(
    "SELECT estudiante.id_estudiante
     FROM nota
     INNER JOIN matricula ON matricula.id_matricula = nota.matricula_id_matricula
     INNER JOIN estudiante ON estudiante.id_estudiante = matricula.estudiante_id_estudiante
     WHERE nota.id_nota = ?"
);
$stmtEst->execute([$id_nota]);
$estudiante = $stmtEst->fetchColumn();

try {
    $stmt = $base_de_datos->prepare(
        "UPDATE nota 
         SET fecha_nota = ?, nota = ?, actividad_id_actividad = ?
         WHERE id_nota = ?"
    );
    $resultado = $stmt->execute([
        $fecha_nota,
        $nota,
        $actividad_id,
        $id_nota
    ]);

    if ($resultado) {
        header("Location: ../notas.php?id_estudiante=$estudiante&status=success");
        exit;
    } else {
        header("Location: ../notas.php?id_estudiante=$estudiante&status=error");
        exit;
    }
} catch (Exception $e) {
    header("Location: ../notas.php?id_estudiante=$estudiante&status=error");
    exit;
}
?>
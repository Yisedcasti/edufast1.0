<?php
require_once '../configuracion/conexion.php';

// Validar que se recibió el id_nota
if (!isset($_GET['id_nota'])) {
    header("Location: ../notas.php?status=error");
    exit;
}

$id_nota = $_GET['id_nota'];

// Obtener el id_estudiante antes de eliminar
$stmtEst = $base_de_datos->prepare(
    "SELECT estudiante.id_estudiante
     FROM nota
     INNER JOIN matricula ON matricula.id_matricula = nota.matricula_id_matricula
     INNER JOIN estudiante ON estudiante.id_estudiante = matricula.estudiante_id_estudiante
     WHERE nota.id_nota = ?"
);
$stmtEst->execute([$id_nota]);
$id_estudiante = $stmtEst->fetchColumn();

try {
    $stmt = $base_de_datos->prepare("DELETE FROM nota WHERE id_nota = ?");
    $resultado = $stmt->execute([$id_nota]);

    if ($resultado) {
        header("Location: ../notas.php?id_estudiante=$id_estudiante&status=success");
        exit;
    } else {
        header("Location: ../notas.php?id_estudiante=$id_estudiante&status=error");
        exit;
    }
} catch (Exception $e) {
    header("Location: ../notas.php?id_estudiante=$id_estudiante&status=error");
    exit;
}
?>
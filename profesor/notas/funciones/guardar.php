<?php
require_once '../configuracion/conexion.php';
date_default_timezone_set('America/Bogota');

// Validar que se recibieron los datos necesarios
if (
    !isset($_POST['curso']) ||
    !isset($_POST['actividad']) ||
    !isset($_POST['estudiantes']) ||
    !isset($_POST['notas'])
) {
    header("Location: ../listado.php?status=error");
    exit;
}

$actividad_id = $_POST['actividad'];
$estudiantes = $_POST['estudiantes'];
$notas = $_POST['notas'];
$fecha_nota = date('Y-m-d');

// Guardar cada nota
try {
    $base_de_datos->beginTransaction();

    foreach ($estudiantes as $i => $id_estudiante) {
        $nota = $notas[$i];

        // Buscar la matrícula del estudiante para el curso seleccionado
        $stmt = $base_de_datos->prepare(
            "SELECT id_matricula FROM matricula WHERE estudiante_id_estudiante = ? AND cursos_id_cursos = ? LIMIT 1"
        );
        $stmt->execute([$id_estudiante, $_POST['curso']]);
        $matricula = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$matricula) {
            // Si no hay matrícula, omitir este estudiante
            continue;
        }

        $matricula_id = $matricula['id_matricula'];

        // Insertar la nota
        $insert = $base_de_datos->prepare(
            "INSERT INTO nota (fecha_nota, nota, matricula_id_matricula, actividad_id_actividad)
             VALUES (?, ?, ?, ?)"
        );
        $insert->execute([
            $fecha_nota,
            $nota,
            $matricula_id,
            $actividad_id
        ]);
    }

    $base_de_datos->commit();
    header("Location: ../listado.php?status=success");
    exit;
} catch (Exception $e) {
    $base_de_datos->rollBack();
    header("Location: ../listado.php?status=error");
    exit;
}
?>
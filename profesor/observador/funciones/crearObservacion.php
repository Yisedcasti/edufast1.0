<?php
require_once '../configuracion/conexion.php';

// Validar que los campos requeridos estén presentes
if (
    !isset($_POST['fechaCompromiso']) ||
    !isset($_POST['Observacion']) ||
    !isset($_POST['Compromiso']) ||
    !isset($_POST['nombre']) ||
    !isset($_POST['estudiante_id_estudiante'])
) {
    exit("Faltan datos requeridos.");
}

// Recoger datos del formulario
$fechaCompromiso = $_POST['fechaCompromiso'];
$observacion = $_POST['Observacion'];
$compromiso = $_POST['Compromiso'];
$nombre_docente = $_POST['nombre'];
$firma_alumno = null;
$estudiante_id_estudiante = $_POST['estudiante_id_estudiante'];

// Obtener datos adicionales del estudiante
try {
    $consultar = $base_de_datos->prepare("SELECT 
        registro_num_doc,
        registro_rol_id_rol,
        registro_jornada_id_jornada
        FROM estudiante
        WHERE id_estudiante = ? ");
    $consultar->execute([$estudiante_id_estudiante]);
    $resultado = $consultar->fetch(PDO::FETCH_ASSOC);

    if (!$resultado) {
        exit("No se encontró información para este estudiante.");
    }

    $estudiante_registro_num_doc = $resultado['registro_num_doc'];
    $estudiante_registro_rol_id_rol = $resultado['registro_rol_id_rol'];
    $estudiante_registro_jornada_id_jornada = $resultado['registro_jornada_id_jornada'];

    // Obtener el id del observador (puedes ajustar esto según tu lógica)
    // Por ejemplo, si el observador es el docente actual:
    $observador_id_observador = $_SESSION['id_observador'] ?? null;
    if (!$observador_id_observador) {
        // Si no tienes el id_observador en sesión, ajusta esta parte según tu lógica
        $observador_id_observador = 1; // Valor por defecto o consulta
    }

    // Insertar la observación
    $sentencia = $base_de_datos->prepare("INSERT INTO observacion (
        fechaCompromiso,
        observacion,
        compromiso,
        nombre_docente,
        firma_alumno,
        observador_id_observador,
        estudiante_id_estudiante,
        estudiante_registro_num_doc,
        estudiante_registro_rol_id_rol,
        estudiante_registro_jornada_id_jornada
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $resultado = $sentencia->execute([
        $fechaCompromiso,
        $observacion,
        $compromiso,
        $nombre_docente,
        $firma_alumno,
        $observador_id_observador,
        $estudiante_id_estudiante,
        $estudiante_registro_num_doc,
        $estudiante_registro_rol_id_rol,
        $estudiante_registro_jornada_id_jornada
    ]);

    if ($resultado === TRUE) {
        header("Location: ../vistas/observador.php?num_doc=" . urlencode($estudiante_registro_num_doc) . "&status=success");
        exit;
    } else {
        echo ("Error al insertar la observación");
        exit;
    }
} catch (PDOException $e) {
    echo 'Los datos no fueron insertados correctamente: ' . $e->getMessage();
}
?>
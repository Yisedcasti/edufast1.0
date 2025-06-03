<?php
include_once "../configuracion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_actividad = $_POST['id_actividad'];
    $nom_act = $_POST['nom_actividad'];
    $descripcion = $_POST['descrip_actividad'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $codigo_logro = $_POST['codigo_logro'];
    $docente_has_materia = $_POST['docente_has_materia'];

    try {
        // Consultar grado y materia del logro
        $consultar = $base_de_datos->prepare("SELECT grado_id_grado, materia_id_materia FROM logro WHERE id_logro = ?");
        $consultar->execute([$codigo_logro]);
        $resultado = $consultar->fetch(PDO::FETCH_ASSOC);

        if (!$resultado) {
            exit("No se encontró información para este logro.");
        }

        $logro_grado_id_grado = $resultado['grado_id_grado'];
        $logro_materia_id_materia = $resultado['materia_id_materia'];

        // Actualizar la actividad
        $sql = "UPDATE actividad SET 
                    nombre_act = ?, 
                    descripcion = ?, 
                    fecha_entrega = ?, 
                    docente_has_materia_docente_id_docente = ?, 
                    logro_grado_id_grado = ?, 
                    logro_id_logro = ?, 
                    logro_materia_id_materia = ?
                WHERE id_actividad = ?";
        
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([
            $nom_act,
            $descripcion,
            $fecha_entrega,
            $docente_has_materia,
            $logro_grado_id_grado,
            $codigo_logro,
            $logro_materia_id_materia,
            $id_actividad
        ]);

        header("Location: actividad.php?status=success");
        exit();

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>

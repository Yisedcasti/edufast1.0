<?php
include_once "../configuracion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_act = $_POST['nom_act'];
    $descripcion = $_POST['descripcion'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $codigo_logro = $_POST['codigo_logro'];
    $docente_has_materia = $_POST['docente_has_materia'];

    try {
        $consultar = $base_de_datos->prepare("SELECT  
        grado_id_grado,
        materia_id_materia
        FROM logro WHERE id_logro = ?");
        $consultar->execute([$codigo_logro]);
        $resultado = $consultar->fetch(PDO::FETCH_ASSOC);

        if (!$resultado) {
            exit("No se encontró información para este logro.");
        }

        $logro_grado_id_grado= $resultado['grado_id_grado'];
        $logro_materia_id_materia= $resultado['materia_id_materia'];
        
        $sql = "INSERT INTO actividad (
        nombre_act,
        descripcion, 
        fecha_entrega, 
        docente_has_materia_docente_id_docente,
	    logro_grado_id_grado, 
        logro_id_logro,
        logro_materia_id_materia) 
        VALUES (?,?,?,?,?,?,?)";
        
        $stmt = $base_de_datos->prepare($sql);

        // Ejecutamos la inserción
        $stmt->execute([
            $nom_act,
            $descripcion,
            $fecha_entrega,
            $docente_has_materia,
            $logro_grado_id_grado,
            $codigo_logro,
            $logro_materia_id_materia
        ]);

        header("Location: actividad.php?status=success");

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>

<?php
include_once "conexion.php";



try {
    $id_logro = $_GET['id'];

    $sentencia = $base_de_datos->prepare(" SELECT actividad.*, logro.*, materia.*, registro.*, docente.*
           FROM actividad 
            INNER JOIN logro ON actividad.logro_id_logro = logro.id_logro 
            INNER JOIN materia ON actividad.logro_materia_id_materia  = materia.id_materia
            INNER JOIN docente_has_materia AS dm ON actividad.docente_has_materia_docente_id_docente = dm.docente_id_docente
            INNER JOIN docente ON dm.docente_id_docente = docente.id_docente
            INNER JOIN registro ON docente.registro_num_doc = registro.num_doc
            Where actividad.logro_id_logro = :id_logro

    ");
    $sentencia->execute([':id_logro' => $id_logro]);
    $actividades = $sentencia->fetchAll(PDO::FETCH_OBJ);
    if (empty($actividades)) {
        header("Location: ../vistas/actividad.php?status=error");
        exit();
    }
    $logros = $base_de_datos->query("SELECT * FROM logro")->fetchAll(PDO::FETCH_ASSOC);
    $sentencia2 = $base_de_datos->prepare("SELECT *
    FROM registro
    INNER JOIN docente AS d ON registro.num_doc = d.registro_num_doc
    INNER JOIN docente_has_cursos AS dc ON d.id_docente = dc.docente_id_docente
    INNER JOIN cursos AS c ON dc.cursos_id_cursos = c.id_cursos
    INNER JOIN docente_has_materia AS dm ON d.id_docente = dm.docente_id_docente
    INNER JOIN materia ON dm.materia_id_materia = materia.id_materia
    LEFT JOIN logro ON logro.materia_id_materia = materia.id_materia
    WHERE logro.id_logro = :id_logro");
$sentencia2->execute([':id_logro' => $id_logro]);
$profesores = $sentencia2->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<?php
require_once "configuracion/conexion.php";
try {
    $estudiante = $_GET['id_estudiante'];
    // Consulta principal: Obtener notas con detalles del estudiante, curso, materia y actividad
    $sentencia = $base_de_datos->prepare("SELECT * FROM nota
        INNER JOIN matricula ON matricula.id_matricula = nota.matricula_id_matricula
        INNER JOIN cursos ON cursos.id_cursos = matricula.cursos_id_cursos
        INNER JOIN estudiante ON estudiante.id_estudiante = matricula.estudiante_id_estudiante
        INNER JOIN registro ON registro.num_doc = estudiante.registro_num_doc
        INNER JOIN actividad ON actividad.id_actividad = nota.actividad_id_actividad
        INNER JOIN logro ON logro.id_logro = actividad.logro_id_logro
        INNER JOIN materia ON materia.id_materia = logro.materia_id_materia
        WHERE estudiante.id_estudiante = :id_estudiante
        ORDER BY cursos.curso, materia.materia, actividad.nombre_act
    ");
    $sentencia->bindParam(':id_estudiante', $estudiante, PDO::PARAM_INT);
    $sentencia->execute();
    $notas = $sentencia->fetchAll(PDO::FETCH_OBJ);

    $actividades = $base_de_datos->query("SELECT * FROM actividad")->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

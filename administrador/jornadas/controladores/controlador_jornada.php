<?php
require_once "../configuracion/conexion.php";
require_once "../modelo/jornadaModelo.php";

$modelo = new JornadaModelo($base_de_datos);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accion = $_POST["accion"] ?? '';
    $id = $_POST["id_jornada"] ?? null;
    $jornada = $_POST["jornada"] ?? '';
    $hora_inicio = $_POST["hora_inicio"] ?? '';
    $hora_final = $_POST["hora_final"] ?? '';

    $resultado = false;

    switch ($accion) {
        case "crear":
            $resultado = $modelo->crear($jornada, $hora_inicio, $hora_final);
            break;
        case "actualizar":
            $resultado = $modelo->actualizar($id, $jornada, $hora_inicio, $hora_final);
            break;
        case "eliminar":
            $resultado = $modelo->eliminar($id);
            break;
        default:
            header("Location: ../vistas/jornadas.php?status=invalid_action");
            exit();
    }

    if ($resultado) {
        header("Location: ../vistas/jornadas.php?status=success");
    } else {
        header("Location: ../vistas/jornadas.php?status=error");
    }
    exit();
}

?>

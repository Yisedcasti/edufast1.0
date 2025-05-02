<?php
try {
    include_once "../configuracion/conexion.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $accion = $_POST["accion"] ?? '';
        $id_jornada = $_POST["id_jornada"] ?? null;
        $jornada = $_POST["jornada"] ?? '';
        $hora_inicio = $_POST["hora_inicio"] ?? '';
        $hora_final = $_POST["hora_final"] ?? '';

        switch ($accion) {
            case 'crear':
                $sentencia = $base_de_datos->prepare("
                    INSERT INTO jornada (jornada, hora_inicio, hora_final) 
                    VALUES (?, ?, ?)
                ");
                $resultado = $sentencia->execute([$jornada, $hora_inicio, $hora_final]);
                break;

            case 'actualizar':
                $sentencia = $base_de_datos->prepare("
                    UPDATE jornada 
                    SET jornada = ?, hora_inicio = ?, hora_final = ? 
                    WHERE id_jornada = ?
                ");
                $resultado = $sentencia->execute([$jornada, $hora_inicio, $hora_final, $id_jornada]);
                break;

            case 'eliminar':
                $sentencia = $base_de_datos->prepare("DELETE FROM jornada WHERE id_jornada = ?");
                $resultado = $sentencia->execute([$id_jornada]);
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
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
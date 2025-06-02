<?php
try {
    include_once "../configuracion/conexion.php";
    include_once "../modelo/Grado.php"; 

    $gradoModelo = new grado($base_de_datos); 

    // Verificamos si es una solicitud POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibimos los valores del formulario
        $accion = $_POST["accion"] ?? '';
        $id_grado = $_POST["id_grado"] ?? null;
        $nivel_educativo = $_POST["nivel_educativo"] ?? '';
        $grado = $_POST["grado"] ?? '';
        // Validación: 

        // Procesamos la acción según el tipo de solicitud (crear, actualizar, eliminar)
        switch ($accion) {
            case 'crear':
                if (empty($nivel_educativo) || empty($grado)) {
                    // Si algún campo está vacío, redirigimos al usuario con un mensaje de error
                    header("Location: ../vistas/grados.php?status=error&message=" . urlencode("Todos los campos son obligatorios."));
                    exit();
                }
                // Intentamos crear la jornada
                $resultado = $gradoModelo->crear($nivel_educativo, $grado);
                break;

            case 'actualizar':
                // Intentamos actualizar la jornada
                if (empty($nivel_educativo) || empty($grado)) {
                    // Si algún campo está vacío, redirigimos al usuario con un mensaje de error
                    header("Location: ../vistas/grados.php?status=error&message=" . urlencode("Todos los campos son obligatorios."));
                    exit();
                }
                $resultado = $gradoModelo->actualizar($id_grado, $nivel_educativo,$grado);
                break;

            case 'eliminar':
                // Intentamos eliminar la jornada
                $resultado = $gradoModelo->eliminar($id_grado);
                break;

            default:
                // Si la acción no es válida, redirigimos con mensaje de error
                header("Location: ../vistas/grados.php?status=error&message=" . urlencode("Acción no válida."));
                exit();
        }

        // Verificamos el resultado de la operación
        if ($resultado === true) {
            // Si la operación fue exitosa, redirigimos a la vista con mensaje de éxito
            header("Location: ../vistas/grados.php?status=success");
        } else {
            // Si hubo un error, redirigimos con mensaje de error y el detalle del error
            header("Location: ../vistas/grados.php?status=error&message=" . urlencode($resultado));
        }
        exit();
    }

} catch (PDOException $e) {
    // Capturamos cualquier error de base de datos y lo mostramos en la vista
    header("Location: ../vistas/grados.php?status=error&message=" . urlencode("Error en la base de datos: " . $e->getMessage()));
    exit();
} catch (Exception $e) {
    // Capturamos cualquier otro error que no sea de base de datos
    header("Location: ../vistas/grados.php?status=error&message=" . urlencode("Error inesperado: " . $e->getMessage()));
    exit();
}
?>
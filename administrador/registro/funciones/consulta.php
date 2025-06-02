<?php
include_once "../configuracion/Conexion.php";

// Inicializa las variables
$id_rol = null;
$registros = [];

try {
    if (isset($_GET['id_rol']) && is_numeric($_GET['id_rol'])) {
        $id_rol = $_GET['id_rol'];

        // Accede directamente al num_doc del usuario autenticado
        $usuario_actual = $_SESSION['user'];

        // Consulta que excluye al usuario actual
        $sentencia = $base_de_datos->prepare(" 
            SELECT * FROM registro 
            WHERE rol_id_rol = :id_rol AND num_doc != :usuario_actual
        ");
        $sentencia->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $sentencia->bindParam(':usuario_actual', $usuario_actual, PDO::PARAM_STR);
        $sentencia->execute();
        $registros = $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    if (!$id_rol) {
        echo "Parámetros 'id_rol' no válidos o ausentes.";
        exit();
    }

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}
?>

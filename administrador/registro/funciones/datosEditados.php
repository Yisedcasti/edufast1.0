<?php
include_once "../configuracion/Conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num_doc = $_POST['num_doc'];
    $rol_id_rol = $_POST['rol_id_rol'];

    try {
        $sentencia = $base_de_datos->prepare("UPDATE registro SET rol_id_rol = :rol_id_rol WHERE num_doc = :num_doc");
        $sentencia->bindParam(':rol_id_rol', $rol_id_rol, PDO::PARAM_INT);
        $sentencia->bindParam(':num_doc', $num_doc, PDO::PARAM_STR);
        $sentencia->execute();

         header("Location: ../view/principal_re.php?status=success");;
        exit();
    } catch (PDOException $e) {
        echo "Error al actualizar el rol: " . $e->getMessage();
    }
}
?>

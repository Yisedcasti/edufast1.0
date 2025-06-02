<?php 
require '../configuracion/conexion.php';

$num_doc = $_POST['num_doc'];

try {
    $base_de_datos->beginTransaction();


    // Eliminar  en "grado"
    $sqlRegistro = "DELETE FROM registro WHERE num_doc = :num_doc";
    $stmtRegistro = $base_de_datos->prepare($sqlRegistro);
    $stmtRegistro->execute([':num_doc' => $num_doc]);


    $base_de_datos->commit();
    header("Location: ../view/principal_re.php?status=success");
    exit();

} catch (Exception $e) {

    $base_de_datos->rollBack();

    header("Location: ../vistas/grados.php?error=" . urlencode($e->getMessage()));
    exit(); 
}
?>

<?php
require_once'../config/database.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $num_doc = $_POST['num_doc'];
    $tipo_doc =$_POST['tipo_doc'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $celular = $_POST['celular'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    if (!$num_doc || !$tipo_doc || !$nombres || !$appelidos || !$celular || !$telefono || !$direccion || !$correo || !$contraseña) {
        echo json_encode(['error' => 'Faltan datos']);
        exit;
        }
        $hashedpassword - password_hash($password, PASSWORD_BCRYPT);
        
        try{
            $stmt = $pdo->prepare("INSERT INTO registro (num_doc, tipo_doc, nombres, apellidos, celular, telefono, direccion, correo, contraseña) VALUES (:num_doc, :tipo_doc, :nombres, :apellidos, :celular, :telefono, :direccion, :correo, :pass)");
            $stmt->execute(['num_doc' => $num_doc, 'tipo_doc' => $tipo_doc, 'nombres' => $nombres, 'apellidos' => $apellidos, 'celular' => $celular, 'telefono' => $telefono, 'direccion' => $direccion, 'correo' => $correo, 'contraseña' => $hashedpassword ]);
        }
        catch(PDOException $e){
            echo json_encode(['error' => 'ocurrio un error al instentar registrar el usuario']);
            exit();
        }
}
?>
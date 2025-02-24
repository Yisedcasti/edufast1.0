<?php
 require_once '../config/database.php';
 require_once '../vendor/autoload.php';

use Firebase\JWT\JWT;

$config = require '../config/clave.php';
$SECRET_KEY = $config['SECRET_KEY'];

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $num_doc = $_POST['num_doc'];
    $contraseña = $_POST['contraseña'];

    if(!$num_doc || !$contraseña){
        echo json_encode(array("error" => "Faltan Datos"));
        exit;
    }
        $stmt = $pdo->prepare("SELECT * FROM registro WHERE num_doc = :num_doc");
        $stmt->execute('num_doc', $num_doc);
        $user = $stmt->fetch(PDO ::FETCH_ASSOC);
    
        if($user && password_verify($contraseña, $user['contraseña'])){
            $payload - [
             "num_doc" => $user['num_doc'],
             "rol" => $user['rol_id_rol'],
             "exp" => time() + 3600
            ];

            $jwt = JWT::encode($payload, $SECRET_KEY, 'HS256');

            echo json_encode(['token' => $jwt]);
    
            } else {
                echo json_encode(['error' => "Credenciales incorrectas"]);
            }

    }
 


?>
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
    
}

?>
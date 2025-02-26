<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../config/database.php';
require_once '../vendor/autoload.php';

use Firebase\JWT\JWT;

$config = require '../config/clave.php';
$SECRET_KEY = $config['SECRET_KEY'];

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $num_doc = $_POST['num_doc'] ?? null;
    $contraseña = $_POST['contraseña'] ?? null;

    if (!$num_doc || !$contraseña) {
        echo json_encode(["error" => "Faltan datos"]);
        exit;
    }

    // Obtener datos del usuario desde la base de datos
    $stmt = $pdo->prepare("SELECT * FROM registro WHERE num_doc = :num_doc");
    $stmt->execute(['num_doc' => $num_doc]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($contraseña, $user['pass'])) {
        // Definir el payload del JWT
        $payload = [
            "num_doc" => $user['num_doc'],
            "rol" => $user['rol_id_rol'],
            "exp" => time() + 3600 // Token válido por 1 hora
        ];

        $jwt = JWT::encode($payload, $SECRET_KEY, 'HS256');

        // Guardar el token en una sesión
        session_start();
        $_SESSION['jwt'] = $jwt;
        $_SESSION['rol'] = $user['rol_id_rol'];

        // Redireccionar según el rol del usuario
        switch ($user['rol_id_rol']) {
            case 1:
                header("Location: ../../administrador/pag_principal.php"); // Página para administradores
                break;
            case 2:
                header("Location: ../profesor/inicio.php"); // Página para profesores
                break;
            case 3:
                header("Location: ../estudiante/inicio.php"); // Página para estudiantes
                break;
            case 4:
                header("Location: ../estudiante/inicio.php"); // Página para estudiantes
                break;
            case 5:
                header("Location: ../estudiante/inicio.php"); // Página para estudiantes
                break;
            case 6:
                header("Location: ../estudiante/inicio.php"); // Página para estudiantes
                break;
            default:
                header("Location: ../default.php"); // Página por defecto si no hay un rol válido
                break;
        }
        exit;

    } else {
        echo json_encode(['error' => "Credenciales incorrectas"]);
    }
}
?>

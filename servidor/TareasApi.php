<?php
require_once ("TareasDB.php");

class TareasAPI {
    private $db;

    public function  __construct() {
        $this->db = new TareasDB();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            
            $user = $data['user'] ?? '';
            $pass = $data['pass'] ?? '';
            
            if (empty($user) || empty($pass)) {
                $this->response(400, "error", "Usuario y contraseña son requeridos.");
                return;
            }

            // Llamar a la función de logeo de TareasDB
            $loginResult = $this->db->logeo($user, $pass);

            if ($loginResult['status'] === 'success') {
                $this->response(200, "success", [
                    'role' => $loginResult['role'],
                    'idUser' => $loginResult['idUser'],
                    'message' => $loginResult['message']
                ]);
            } else {
                $this->response(401, "error", $loginResult['message']);
            }
        }
    }

    private function response($statusCode, $status, $data) {
        header("Content-Type: application/json");
        http_response_code($statusCode);
        echo json_encode([
            'status' => $status,
            'data' => $data
        ]);
        exit();
    }
}

$api = new TareasAPI();
$api->login();
?>

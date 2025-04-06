<?php
namespace Controllers;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Models\Usuario;
use Config\Database;
use Config\Clave;

class AuthController {
    private $usuarioModel;

    public function __construct(){
        global $conn;
        $this->usuarioModel = new Usuario($conn);
    }

    private function jsonResponse($status, $message , $data = []){
        echo json_encode(array_merge(['status' => $status, 'message' => $message],  $data));
    }

    public function verificarToken(){
        $authHeader = apache_request_headers()['Authorization'] ?? null;
        if (!$authHeader){
            http_response_code(401);
            $this->jsonResponse('error' , 'Token no proporcionado');
            exit;
        }
        try{
            return JWT::decode(str_replace('Bearer ' , '', $authHeader, new Key(Clave::SECRET_KEY, Clave::JWT_HASH)));
        } catch (Exception $e){
            http_response_code(401);
            $this->jsonResponse('error' , 'Token invalido :' . $e->getMessage());
            exit;
        }
    }

    public function login($data){
        $usuario = $this->usuarioModel->inicioSesion(['num_doc' => trim($data['num_doc']), 'pass' => trim($data['pass'])]);
        if(!$usuario){
            $this->jsonResponse('error' , 'Credenciales incorrectas');
            return;
        }
        $payload = [
            'iss' => '/',
            'aud' => 'localhost',
            'iat' => time(),
            'exp' => time() + 3600,
            'data' => [ //Aqui pueden trasportar los datos importante del usuario com oun session
                'num_doc' => $usuario['num_doc']
            ]
        ];
        $this->jsonResponse('success', 'Credenciales correctas' , ['token' => JWT::encode($payload, Clave::SECRET_KEY, Clave::JWT_HASH)]);
    }

    public function registrar(){

    }

    public function actualizarPerfil($data){
        $decoded = $this->verificarToken();

        $resultado = $this->usuarioModel->actualizarPerfil($data, $decoded->data->num_doc);
        $this->jsonResponse($resultado ? 'success' : 'error' , $resultado ? 'Perfil actualizado correctamente' : 'No se pudo actualizar el perfil');

    }

}


?>
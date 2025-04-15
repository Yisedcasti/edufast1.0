<?php
namespace edufast\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use edufast\Models\Usuario;
use Config\Database;
use edufast\Clave;
 
class AuthController {
    private $usuarioModel;

    public function __construct(){
        $database = new Database();  // Instanciamos la clase Database
        $conn = $database->getConnection();  // Obtenemos la conexión
        $this->usuarioModel = new Usuario($conn);  // Pasamos la conexión al modelo
    }
    

    private function jsonResponse($status, $message , $data = []){
        echo json_encode(array_merge(['status' => $status, 'message' => $message],  $data));
    }

    public function verificarToken(){
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
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
        // Valida los campos recibidos
        if (empty($data['num_doc']) || empty($data['pass'])) {
            http_response_code(400);
            $this->jsonResponse('error', 'Los campos "num_doc" y "pass" son obligatorios.');
            return;
        }
    
        // Verifica las credenciales
        $usuario = $this->usuarioModel->inicioSesion(['num_doc' => trim($data['num_doc']), 'pass' => trim($data['pass'])]);
        if (!$usuario) {
            $this->jsonResponse('error', 'Credenciales incorrectas');
            return;
        }
    
        $payload = [
            'iss' => '/', 
            'aud' => 'localhost', // Audiencia
            'iat' => time(), 
            'exp' => time() + 3600, 
            'data' => [ 
                'num_doc' => $usuario['num_doc']
            ]
        ];
    
        $this->jsonResponse('success', 'Credenciales correctas', ['token' => JWT::encode($payload, Clave::SECRET_KEY, Clave::JWT_HASH)]);
    }
    
    public function registrarse($data) {
        $requeridos = ['id_rol', 'tipo_doc', 'num_doc', 'nombres', 'apellidos', 'celular', 'correo', 'pass'];
        foreach ($requeridos as $campo) {
            if (empty($data[$campo])) {
                http_response_code(400);
                $this->jsonResponse('error', "El campo '$campo' es obligatorio.");
                return;
            }
        }
        $data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);
    
        $registro = $this->usuarioModel->registrarse($data);
        if ($registro) {
            http_response_code(201);
            $this->jsonResponse('success', 'Usuario registrado correctamente.');
        } else {
            http_response_code(500);
            $this->jsonResponse('error', 'No se pudo registrar el usuario.');
        }
    }
    
    public function actualizarPerfil($data){
        $decoded = $this->verificarToken();

        $resultado = $this->usuarioModel->actualizarPerfil($data, $decoded->data->num_doc);
        $this->jsonResponse($resultado ? 'success' : 'error' , $resultado ? 'Perfil actualizado correctamente' : 'No se pudo actualizar el perfil');

    }

}


?>
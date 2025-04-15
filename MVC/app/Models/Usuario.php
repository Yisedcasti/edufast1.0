<?php
namespace edufast\Models;

use PDO;
use PDOException;
use edufast\Config\Database;

class Usuario {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function registrarse($data){
        try {
            $this->conn->beginTransaction();
    
            // Extraer datos desde $data
            $id_rol = $data['id_rol'];
            $tipo_doc = $data['tipo_doc'];
            $num_doc = $data['num_doc'];
            $nombre = $data['nombres'];
            $apellido = $data['apellidos'];
            $celular = $data['celular'];
            $telefono = $data['telefono'];
            $direccion = $data['direccion'];
            $correo = $data['correo'];
            $hashed_password = password_hash($data['pass'], PASSWORD_BCRYPT);
            $jornada_id_jornada = 1;
    
            // Verifica los datos antes de la inserción
            var_dump($id_rol, $tipo_doc, $num_doc, $nombre, $apellido, $celular, $telefono, $direccion, $correo, $hashed_password, $jornada_id_jornada);
            
            $sql = $this->conn->prepare("
                INSERT INTO registro (
                    rol_id_rol, tipo_doc, num_doc, nombres, apellidos, celular,
                    telefono, direccion, correo, pass, jornada_id_jornada
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
    
            $stmt = $sql->execute([
                $id_rol, $tipo_doc, $num_doc, $nombre, $apellido,
                $celular, $telefono, $direccion, $correo, $hashed_password, $jornada_id_jornada
            ]);
    
            if ($stmt) {
                $this->conn->commit();
                return json_encode(['message' => 'Usuario registrado correctamente']);
            } else {
                // Ver si la ejecución falla
                return json_encode(['message' => 'Error al ejecutar el INSERT']);
            }
    
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return json_encode(['message' => 'Error al registrar: ' . $e->getMessage()]);
        }
    }
    

    // Aquí puedes seguir con los demás métodos

    public function inicioSesion($data){
        $stmt = $this->conn->prepare("SELECT * FROM registro WHERE num_doc = :num_doc");
            $stmt->execute(['num_doc' => $data['num_doc']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($pass, $user['pass'])) {
                // Definir el payload del JWT
                $payload = [
                    "num_doc" => $user['num_doc'],
                    "rol" => $user['rol_id_rol'],
                    "nombres" => $user['nombres'],
                    "apellidos" => $user['apellidos'],
                    "exp" => time() + 3600 // Token válido por 1 hora
                ];

                $jwt = JWT::encode($payload, $SECRET_KEY, 'HS256');

                // Guardar el token en una sesión
                session_start();
                $_SESSION['jwt'] = $jwt;
                $_SESSION['user'] = $user['num_doc'];
                $_SESSION['rol'] = $user['rol_id_rol'];
                $_SESSION['nombres'] = $user['nombres'];
                $_SESSION['apellidos'] = $user['apellidos'];

        } else {
            echo json_encode(['error' => "Credenciales incorrectas"]);
        }
            
            
        }

    public function actualizarPerfil($data, $num_doc){
                // Lógica pendiente
    }
}
?>

<?php
require_once("conexion.php");

class TareasDB {
    private $db;

    public function __construct() {
        $this->db = new Conexion();
    } 

    // Método para obtener un usuario por su ID
    public function obtenerUsuarioPorId($userId) {
        $query = "SELECT * FROM registro WHERE num_doc = ?";
    
        $stmt = $this->db->mysqli->prepare($query);
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta: " . $this->db->mysqli->error);
        }

        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $usuario = null;
        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
        }

        $stmt->close();
        return $usuario;
    }

    // Método de inicio de sesión
    public function logeo($user, $pass) {
        $stmt = $this->db->mysqli->prepare("SELECT * FROM registro WHERE num_doc = ?");
        if (!$stmt) {
            throw new Exception("Error en la consulta SQL: " . $this->db->mysqli->error);
        }

        // Buscar al usuario por el número de documento
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $stmt->close();

        if (!$usuario) {
            // Si no se encuentra el usuario
            return ['status' => 'error', 'message' => 'Usuario no encontrado'];
        }

        // Verificar la pass con password_verify
        if (password_verify($pass, $usuario['pass'])) {
            // Iniciar sesión del usuario
            session_start();  // Asegurarse de que la sesión esté iniciada

            $_SESSION['userId'] = $usuario['num_doc'];
            $_SESSION['user'] = $usuario['nombres'];
            $_SESSION['usera'] = $usuario['apellidos'];
            $_SESSION['rol'] = $usuario['rol_id_rol'];

            // Retornar éxito y los datos del usuario
            return [
                'status' => 'success',
                'role' => $_SESSION['rol'],
                'idUser' => $_SESSION['userId'],
                'message' => 'Login exitoso'
            ];
        }

        // Si la pass es incorrecta
        return ['status' => 'error', 'message' => 'pass incorrecta'];
    }
}
?>

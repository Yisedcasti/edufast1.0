<?php
namespace Modelo;
use PDO;
use PDOException;
use Config\Database;

class Usuario {
    private $db;
    public function __construct($db){
        $this->db = $db;
    }

    public function registraar($data){
        try{
            $this->db->beginTransaction()
            $sql = $db->prepare("INSERT INTO registro (rol_id_rol, tipo_doc, num_doc, nombres, apellidos, celular, telefono, direccion, correo, foto_perfil, pass, jornada_id_jornada) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
            $stmt = $sql->execute([$id_rol, $tipo_doc, $num_doc, $nombre, $apellido, $celular, $telefono, $direccion, $correo, $foto_perfil_new_name, $hashed_password, $jornada_id_jornada]);    
            $this->db->commit();
            return json_encode(['message' => 'Usuario registrado Correctamnete']);
        } catch (PDOException $e){
            $this->db->rollBack();
            return json_encode(['message' => 'Error al registrar ' . $e->getMessage()]);
        }
    }

    public function inicioSesion($data){
        
    }

}



?>
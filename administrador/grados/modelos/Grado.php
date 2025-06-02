<?php
include_once "../configuracion/conexion.php";
class grado {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }  

    // Crear una nuevo grado
    public function crear($nivel_educativo, $grado) {
        $stmt = $this->db->prepare("INSERT INTO grado (nivel_educativo, grado) VALUES (?, ?)");
        return $stmt->execute([$nivel_educativo, $grado]);
    }

    // Actualizar un grado existente
    public function actualizar($id, $nivel_educativo, $grado) {
        $stmt = $this->db->prepare("UPDATE grado SET nivel_educativo=?, grado=? WHERE id_grado=?");
        return $stmt->execute([$nivel_educativo, $grado, $id]);
    }

    // Eliminar una grado
    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM grado WHERE id_grado=?");
        return $stmt->execute([$id]);
    }

    // Obtener todas los grados
    public function obtenerGrados() {
        $stmt = $this->db->prepare("SELECT * FROM grado");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
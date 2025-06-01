<?php
include_once "../configuracion/conexion.php";
class Jornada {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Crear una nueva jornada
    public function crear($jornada, $hora_inicio, $hora_final) {
        $stmt = $this->db->prepare("INSERT INTO jornada (jornada, hora_inicio, hora_final) VALUES (?, ?, ?)");
        return $stmt->execute([$jornada, $hora_inicio, $hora_final]);
    }

    // Actualizar una jornada existente
    public function actualizar($id, $jornada, $hora_inicio, $hora_final) {
        $stmt = $this->db->prepare("UPDATE jornada SET jornada=?, hora_inicio=?, hora_final=? WHERE id_jornada=?");
        return $stmt->execute([$jornada, $hora_inicio, $hora_final, $id]);
    }

    // Eliminar una jornada
    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM jornada WHERE id_jornada=?");
        return $stmt->execute([$id]);
    }

    // Obtener todas las jornadas
    public function obtenerJornadas() {
        $stmt = $this->db->prepare("SELECT * FROM jornada");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

<?php
class JornadaModelo {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function obtenerTodas() {
        $stmt = $this->db->query(" SELECT * FROM jornada WHERE id_jornada <> 1 ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($jornada, $hora_inicio, $hora_final) {
        $sql = "INSERT INTO jornada (jornada, hora_inicio, hora_final) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$jornada, $hora_inicio, $hora_final]);
    }

    public function actualizar($id, $jornada, $hora_inicio, $hora_final) {
        $sql = "UPDATE jornada SET jornada = ?, hora_inicio = ?, hora_final = ? WHERE id_jornada = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$jornada, $hora_inicio, $hora_final, $id]);
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM jornada WHERE id_jornada = ?");
        return $stmt->execute([$id]);
    }
}

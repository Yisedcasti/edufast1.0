<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/registrarJornada.php';
require_once __DIR__ . '/../src/actualizarJornada.php';
require_once __DIR__ . '/../src/eliminarJornada.php';

class JornadaTest extends TestCase
{
    private $conexion;
    private $idInsertado;

    protected function setUp(): void {
        $this->conexion = new mysqli("localhost", "root", "", "edufast");
        // Limpiar si ya existe una jornada con el mismo nombre
        $this->conexion->query("DELETE FROM jornada WHERE jornada = 'Test Jornada'");
    }

    public function testRegistro() {
        $datos = [
            'jornada' => 'Test Jornada',
            'hora_inicio' => '07:00:00',
            'hora_final' => '13:00:00'
        ];

        $this->assertTrue(registrarJornada($datos));

        $query = $this->conexion->query("SELECT * FROM jornada WHERE jornada = 'Test Jornada'");
        $row = $query->fetch_assoc();
        $this->assertNotEmpty($row);
        $this->idInsertado = $row['id_jornada'];
    }

    public function testActualizar() {
        // Insertar primero
        $this->conexion->query("INSERT INTO jornada (jornada, hora_inicio, hora_final) VALUES ('Test Jornada', '07:00:00', '13:00:00')");
        $id = $this->conexion->insert_id;

        $datosActualizados = [
            'jornada' => 'Jornada Actualizada',
            'hora_inicio' => '08:00:00',
            'hora_final' => '14:00:00'
        ];

        $this->assertTrue(actualizarJornada($id, $datosActualizados));

        $query = $this->conexion->query("SELECT * FROM jornada WHERE id_jornada = $id");
        $row = $query->fetch_assoc();
        $this->assertEquals('Jornada Actualizada', $row['jornada']);
    }

    public function testEliminar() {
        // Insertar primero
        $this->conexion->query("INSERT INTO jornada (jornada, hora_inicio, hora_final) VALUES ('Test Jornada', '07:00:00', '13:00:00')");
        $id = $this->conexion->insert_id;

        $this->assertTrue(eliminarJornada($id));

        $query = $this->conexion->query("SELECT * FROM jornada WHERE id_jornada = $id");
        $this->assertEquals(0, $query->num_rows);
    }
}

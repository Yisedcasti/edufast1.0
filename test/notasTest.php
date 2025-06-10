<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/registrarNota.php';
require_once __DIR__ . '/../src/eliminarNota.php';

class NotasTest extends TestCase
{
    private $conexion;

    protected function setUp(): void {
        $this->conexion = new mysqli("localhost", "root", "", "edufast");
        $this->conexion->query("DELETE FROM nota WHERE fecha_nota = '2025-06-10' AND matricula_id_matricula = 4 AND actividad_id_actividad = 1");
    }

    public function testRegistro() {
        $datos = [
            'fecha_nota' => '2025-06-10',
            'nota' => '4.5',
            'matricula_id_matricula' => 4,
            'actividad_id_actividad' => 1
        ];

        $this->assertTrue(registrarNota($datos));

        $query = $this->conexion->query("SELECT * FROM nota WHERE fecha_nota = '2025-06-10' AND matricula_id_matricula = 4 AND actividad_id_actividad = 1");
        $row = $query->fetch_assoc();
        $this->assertNotEmpty($row);
    }


    public function testEliminar() {
        $this->conexion->query("INSERT INTO nota (fecha_nota, nota, matricula_id_matricula, actividad_id_actividad) 
                                VALUES ('2025-06-10', '3.8', 4, 1)");
        $id = $this->conexion->insert_id;

        $this->assertTrue(eliminarNota($id));

        $query = $this->conexion->query("SELECT * FROM nota WHERE id_nota = $id");
        $this->assertEquals(0, $query->num_rows);
    }
}

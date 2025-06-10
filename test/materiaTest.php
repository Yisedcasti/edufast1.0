<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/registrarMateria.php';
require_once __DIR__ . '/../src/actualizarMateria.php';
require_once __DIR__ . '/../src/eliminarMateria.php';

class MateriaTest extends TestCase
{
    private $conexion;
    private $idInsertado;

    protected function setUp(): void {
        $this->conexion = new mysqli("localhost", "root", "", "edufast");
        // Limpiar si ya existe una jornada con el mismo nombre
        $this->conexion->query("DELETE FROM materia WHERE materia = 'Español'");
    }

    public function testRegistro() {
        $datos = [
            'materia' => 'Fisica',
            'area_id_area' => 1
        ];

        $this->assertTrue(registrarMateria($datos));

        $query = $this->conexion->query("SELECT * FROM materia WHERE materia = 'Fisica'");
        $row = $query->fetch_assoc();
        $this->assertNotEmpty($row);
        $this->idInsertado = $row['id_materia'];
    }

    public function testActualizar() {
        $this->conexion->query("INSERT INTO materia (materia,area_id_area) VALUES ('materia_test', '1')");
        $id = $this->conexion->insert_id;

        $datosActualizados = [
            'materia' => 'Materia Actualizada',
            'area_id_area' => 1,
        ];

        $this->assertTrue(actualizarMateria($id, $datosActualizados));

        $query = $this->conexion->query("SELECT * FROM materia WHERE id_materia = $id");
        $row = $query->fetch_assoc();
        $this->assertEquals('Materia Actualizada', $row['materia']);
    }

    public function testEliminar() {
        // Insertar primero
        $this->conexion->query("INSERT INTO materia (materia, area_id_area) VALUES ('Test materia', '3')");
        $id = $this->conexion->insert_id;

        $this->assertTrue(eliminarMateria($id));

        $query = $this->conexion->query("SELECT * FROM materia WHERE id_materia = $id");
        $this->assertEquals(0, $query->num_rows);
    }
}

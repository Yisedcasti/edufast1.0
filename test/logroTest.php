<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/registrarLogro.php';
require_once __DIR__ . '/../src/actualizarLogro.php';
require_once __DIR__ . '/../src/eliminarLogro.php';

class LogroTest extends TestCase
{
    private $conexion;

    protected function setUp(): void {
        $this->conexion = new mysqli("localhost", "root", "", "edufast");
        // Limpiar cualquier rastro previo
        $this->conexion->query("DELETE FROM logro WHERE id_logro IN (103, 104, 108)");
    }

    public function testRegistro() {
        $datos = [
            'id_logro' => 104,
            'nombre_logro' => 'Test logro',
            'descripcion_logro' => 'Descripción del logro de prueba',
            'grado_id_grado' => 1,
            'materia_id_materia' => 1
        ];

        $this->assertTrue(registrarLogro($datos));

        $query = $this->conexion->query("SELECT * FROM logro WHERE id_logro = 104");
        $row = $query->fetch_assoc();
        $this->assertNotEmpty($row);
    }

    public function testActualizar() {
        // Insertar primero
        $this->conexion->query("INSERT INTO logro (id_logro, nombre_logro, descripcion_logro, grado_id_grado, materia_id_materia)
                                VALUES (103, 'Test logro', 'Descripción del logro de prueba', 1, 1)");
        $id = 103;

        $datosActualizados = [
            'nombre_logro' => 'Logro Actualizado',
            'descripcion_logro' => 'Descripción actualizada del logro',
            'grado_id_grado' => 1,
            'materia_id_materia' => 1
        ];

        $this->assertTrue(actualizarLogro($id, $datosActualizados));

        $query = $this->conexion->query("SELECT * FROM logro WHERE id_logro = $id");
        $row = $query->fetch_assoc();
        $this->assertEquals('Logro Actualizado', $row['nombre_logro']);
    }

    public function testEliminar() {
        $this->conexion->query("INSERT INTO logro (id_logro, nombre_logro, descripcion_logro, grado_id_grado, materia_id_materia)
                                VALUES (108, 'Test logro', 'Descripción del logro de prueba', 1, 1)");
        $id = 108;

        $this->assertTrue(eliminarLogro($id));

        $query = $this->conexion->query("SELECT * FROM logro WHERE id_logro = $id");
        $this->assertEquals(0, $query->num_rows);
    }
}

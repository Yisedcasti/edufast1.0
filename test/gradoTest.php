<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/registrarGrado.php';
require_once __DIR__ . '/../src/actualizarGrado.php';
require_once __DIR__ . '/../src/eliminarGrado.php';

class GradoTest extends TestCase
{
    private $conexion;
    private $idGrado;

    protected function setUp(): void {
        $this->conexion = new mysqli("localhost", "root", "", "edufast");
        // Limpiar registros con mismo grado para evitar duplicados
        $this->conexion->query("DELETE FROM grado WHERE grado = '5-TEST'");
    }

    public function testRegistroGrado() {
        $datos = [
            'nivel_educativo' => 'Primaria',
            'grado' => '5-TEST'
        ];

        $this->assertTrue(registrarGrado($datos));

        $query = $this->conexion->query("SELECT * FROM grado WHERE grado = '5-TEST'");
        $row = $query->fetch_assoc();
        $this->assertNotEmpty($row);
        $this->idGrado = $row['id_grado'];
    }

    public function testActualizarGrado() {
        registrarGrado(['nivel_educativo' => 'Primaria', 'grado' => '5-TEST']);

        $query = $this->conexion->query("SELECT id_grado FROM grado WHERE grado = '5-TEST'");
        $row = $query->fetch_assoc();
        $id = $row['id_grado'];

        $datosActualizados = [
            'nivel_educativo' => 'Secundaria',
            'grado' => '10-TEST'
        ];

        $this->assertTrue(actualizarGrado($id, $datosActualizados));

        $verificar = $this->conexion->query("SELECT * FROM grado WHERE id_grado = $id");
        $actualizado = $verificar->fetch_assoc();

        $this->assertEquals('10-TEST', $actualizado['grado']);
    }

    public function testEliminarGrado() {
        registrarGrado(['nivel_educativo' => 'Primaria', 'grado' => '5-TEST']);

        $query = $this->conexion->query("SELECT id_grado FROM grado WHERE grado = '5-TEST'");
        $row = $query->fetch_assoc();
        $id = $row['id_grado'];

        $this->assertTrue(eliminarGrado($id));

        $verificar = $this->conexion->query("SELECT * FROM grado WHERE id_grado = $id");
        $this->assertEquals(0, $verificar->num_rows);
    }
}

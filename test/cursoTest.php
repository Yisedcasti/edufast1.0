<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/registrarCurso.php';
require_once __DIR__ . '/../src/actualizarCurso.php';
require_once __DIR__ . '/../src/eliminarCurso.php';

class CursoTest extends TestCase
{
    private $conexion;
    private $idCurso;
    private $idGrado;

    protected function setUp(): void {
        $this->conexion = new mysqli("localhost", "root", "", "edufast");

        // Insertar grado de prueba
        $this->conexion->query("INSERT INTO grado (nivel_educativo, grado) VALUES ('Primaria', '5-TEST')");
        $this->idGrado = $this->conexion->insert_id;

        // Limpiar curso si ya existe
        $this->conexion->query("DELETE FROM cursos WHERE curso = 'A-TEST' AND grado_id_grado = {$this->idGrado}");
    }

    protected function tearDown(): void {
        // Eliminar curso y grado de prueba al final
        $this->conexion->query("DELETE FROM cursos WHERE grado_id_grado = {$this->idGrado}");
        $this->conexion->query("DELETE FROM grado WHERE id_grado = {$this->idGrado}");
    }

    public function testRegistrarCurso() {
        $datos = [
            'curso' => 'A-TEST',
            'grado_id_grado' => $this->idGrado
        ];

        $this->assertTrue(registrarCurso($datos));

        $query = $this->conexion->query("SELECT * FROM cursos WHERE curso = 'A-TEST' AND grado_id_grado = {$this->idGrado}");
        $row = $query->fetch_assoc();
        $this->assertNotEmpty($row);
        $this->idCurso = $row['id_cursos'];
    }

    public function testActualizarCurso() {
        registrarCurso(['curso' => 'A-TEST', 'grado_id_grado' => $this->idGrado]);

        $query = $this->conexion->query("SELECT id_cursos FROM cursos WHERE curso = 'A-TEST' AND grado_id_grado = {$this->idGrado}");
        $row = $query->fetch_assoc();
        $id = $row['id_cursos'];

        $datosActualizados = [
            'curso' => 'B-EDITADO',
            'grado_id_grado' => $this->idGrado
        ];

        $this->assertTrue(actualizarCurso($id, $datosActualizados));

        $verificar = $this->conexion->query("SELECT * FROM cursos WHERE id_cursos = $id");
        $actualizado = $verificar->fetch_assoc();
        $this->assertEquals('B-EDITADO', $actualizado['curso']);
    }

    public function testEliminarCurso() {
        registrarCurso(['curso' => 'C-DELETE', 'grado_id_grado' => $this->idGrado]);

        $query = $this->conexion->query("SELECT id_cursos FROM cursos WHERE curso = 'C-DELETE' AND grado_id_grado = {$this->idGrado}");
        $row = $query->fetch_assoc();
        $id = $row['id_cursos'];

        $this->assertTrue(eliminarCurso($id));

        $verificar = $this->conexion->query("SELECT * FROM cursos WHERE id_cursos = $id");
        $this->assertEquals(0, $verificar->num_rows);
    }
}

<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/registrarActividad.php';
require_once __DIR__ . '/../src/actualizarActividad.php';
require_once __DIR__ . '/../src/eliminarActividad.php';

class ActividadTest extends TestCase
{
    private $conexion;

    protected function setUp(): void {
        $this->conexion = new mysqli("localhost", "root", "", "edufast");
        $this->conexion->query("DELETE FROM actividad WHERE nombre_act IN ('Actividad Test', 'Actividad Actualizada', 'Actividad Eliminar')");
    }

    public function testRegistro() {
        $datos = [
            'nombre_act' => 'Actividad Test',
            'descripcion' => 'Descripción de la actividad',
            'fecha_entrega' => '2025-06-10',
            'docente_has_materia_docente_id_docente' => 1,
            'logro_grado_id_grado' => 11,
            'logro_id_logro' => 1002,
            'logro_materia_id_materia' => 8
        ];

        $this->assertTrue(registrarActividad($datos));

        $query = $this->conexion->query("SELECT * FROM actividad WHERE nombre_act = 'Actividad Test'");
        $row = $query->fetch_assoc();
        $this->assertNotEmpty($row);
    }

    public function testActualizar() {
        $this->conexion->query("INSERT INTO actividad (nombre_act, descripcion, fecha_entrega, docente_has_materia_docente_id_docente, logro_grado_id_grado, logro_id_logro, logro_materia_id_materia)
                                VALUES ('Actividad Test', 'Descripción original', '2025-06-10', 1, 11, 1002, 8)");
        $id = $this->conexion->insert_id;

        $datosActualizados = [
            'nombre_act' => 'Actividad Actualizada',
            'descripcion' => 'Descripción actualizada',
            'fecha_entrega' => '2025-06-15',
            'docente_has_materia_docente_id_docente' => 1,
            'logro_grado_id_grado' => 11,
            'logro_id_logro' => 1002,
            'logro_materia_id_materia' => 8
        ];

        $this->assertTrue(actualizarActividad($id, $datosActualizados));

        $query = $this->conexion->query("SELECT * FROM actividad WHERE id_actividad = $id");
        $row = $query->fetch_assoc();
        $this->assertEquals('Actividad Actualizada', $row['nombre_act']);
    }

    public function testEliminar() {
        $this->conexion->query("INSERT INTO actividad (nombre_act, descripcion, fecha_entrega, docente_has_materia_docente_id_docente, logro_grado_id_grado, logro_id_logro, logro_materia_id_materia)
                                VALUES ('Actividad Eliminar', 'Descripción', '2025-06-10', 1, 11, 1002, 8)");
        $id = $this->conexion->insert_id;

        $this->assertTrue(eliminarActividad($id));

        $query = $this->conexion->query("SELECT * FROM actividad WHERE id_actividad = $id");
        $this->assertEquals(0, $query->num_rows);
    }
}

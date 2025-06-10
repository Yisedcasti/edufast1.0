<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/registrarUsuario.php';
require_once __DIR__ . '/../src/actualizarUsuario.php';
require_once __DIR__ . '/../src/eliminarUsuario.php';
require_once __DIR__ . '/../src/iniciarSesion.php';

class RegistroTest extends TestCase
{
    private $conexion;
    private $documento = 481512238;

    protected function setUp(): void {
        $this->conexion = new mysqli("localhost", "root", "", "edufast");
        $this->conexion->query("DELETE FROM registro WHERE num_doc = {$this->documento}");
    }

    public function testRegistro() {
        $datos = $this->getDatosBase();
        $this->assertTrue(registrarUsuario($datos));

        $query = $this->conexion->query("SELECT * FROM registro WHERE num_doc = {$this->documento}");
        $row = $query->fetch_assoc();
        $this->assertNotEmpty($row);
    }

    public function testActualizar() {
        registrarUsuario($this->getDatosBase()); // Asegurar existencia

        $datosActualizados = [
            'tipo_doc' => 'CC',
            'nombres' => 'Juanito',
            'apellidos' => 'Pérez Actualizado',
            'celular' => '3009876543',
            'telefono' => '7654321',
            'direccion' => 'Calle Verdadera 321',
            'correo' => 'juanito_actualizado@example.com',
            'pass' => 'nuevo123',
            'rol_id_rol' => 3,
            'jornada_id_jornada' => 2
        ];

        $this->assertTrue(actualizarUsuario($this->documento, $datosActualizados));

        // Verificar que se actualizó
        $query = $this->conexion->query("SELECT nombres FROM registro WHERE num_doc = {$this->documento}");
        $row = $query->fetch_assoc();
        $this->assertEquals('Juanito', $row['nombres']);
    }

    public function testLogin() {
        // Registrar y actualizar para usar nueva contraseña
        registrarUsuario($this->getDatosBase());

        actualizarUsuario($this->documento, [
            'tipo_doc' => 'CC',
            'nombres' => 'Juanito',
            'apellidos' => 'Pérez Actualizado',
            'celular' => '3009876543',
            'telefono' => '7654321',
            'direccion' => 'Calle Verdadera 321',
            'correo' => 'juanito_actualizado@example.com',
            'pass' => 'nuevo123',
            'rol_id_rol' => 3,
            'jornada_id_jornada' => 2
        ]);

        $resultado = iniciarSesion($this->documento, 'nuevo123');
        $this->assertEquals($this->documento, $resultado);
    }

    public function testEliminar() {
        registrarUsuario($this->getDatosBase());

        $this->assertTrue(eliminarUsuario($this->documento));

        $query = $this->conexion->query("SELECT * FROM registro WHERE num_doc = {$this->documento}");
        $this->assertEquals(0, $query->num_rows);
    }

    private function getDatosBase(): array {
        return [
            'num_doc' => $this->documento,
            'tipo_doc' => 'CC',
            'nombres' => 'Juan',
            'apellidos' => 'Pérez',
            'celular' => '3001234567',
            'telefono' => '1234567',
            'direccion' => 'Calle Falsa 123',
            'correo' => 'juan_test@example.com',
            'pass' => '123456',
            'rol_id_rol' => 2,
            'jornada_id_jornada' => 1
        ];
    }
}

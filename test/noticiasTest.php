<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/registrarNoticia.php';
require_once __DIR__ . '/../src/actualizarNoticia.php';
require_once __DIR__ . '/../src/eliminarNoticia.php';

class PublicNoticiasTest extends TestCase
{
    private $conexion;

    protected function setUp(): void {
        $this->conexion = new mysqli("localhost", "root", "", "edufast");
        $this->conexion->query("DELETE FROM public_noticias WHERE titulo = 'Noticia Test'");
    }

    public function testRegistro() {
        $datos = [
            'titulo' => 'Noticia Test',
            'info' => 'Contenido de la noticia',
            'registro_num_doc' => 123456789
        ];

        $this->assertTrue(registrarNoticia($datos));

        $query = $this->conexion->query("SELECT * FROM public_noticias WHERE titulo = 'Noticia Test'");
        $row = $query->fetch_assoc();
        $this->assertNotEmpty($row);
    }

    public function testActualizar() {
        $this->conexion->query("INSERT INTO public_noticias (titulo, info, registro_num_doc) VALUES ('Noticia Test', 'Original', 123456789)");
        $id = $this->conexion->insert_id;

        $datos = [
            'titulo' => 'Noticia Actualizada',
            'info' => 'Nueva descripción',
            'registro_num_doc' => 123456789
        ];

        $this->assertTrue(actualizarNoticia($id, $datos));

        $query = $this->conexion->query("SELECT * FROM public_noticias WHERE id_noticia = $id");
        $row = $query->fetch_assoc();
        $this->assertEquals('Noticia Actualizada', $row['titulo']);
    }

    public function testEliminar() {
        $this->conexion->query("INSERT INTO public_noticias (titulo, info, registro_num_doc) VALUES ('Noticia Test', 'Desc', 123456789)");
        $id = $this->conexion->insert_id;

        $this->assertTrue(eliminarNoticia($id));

        $query = $this->conexion->query("SELECT * FROM public_noticias WHERE id_noticia = $id");
        $this->assertEquals(0, $query->num_rows);
    }
}

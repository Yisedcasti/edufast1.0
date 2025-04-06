<?php
namespace Controllers;
use Models\Jornada;
use Config\Database;

class JornadaController {
    private $jornadaModel;

    public function __construct(){
        global $conn;
        $this->jornaModel = new Jornada($conn);
    }

    public function jsonResponse($status, $message , $data = []){
        echo json_encode(array_merge(['status' => $status, 'message' => $message], $data));
    }

    public function obtenerJornada(){

    }

    public function actualizarJornada(){

    }

    public function eliminarJornada(){

    }
    public function crearJornada(){
        
    }
}


?>

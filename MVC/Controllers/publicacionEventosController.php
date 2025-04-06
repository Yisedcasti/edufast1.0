<?php
namespace Controllers;
use Models\Eventos;
use Config\Database;

class publicacionEventosController{
    private $eventosModel;

    public function __constuct(){
        global $coon;
        $this->eventosModel = new Eventos($conn);
    }

    public function obtenerPublicacionDeEventos(){
        $this->jsonResponse('Eventos', $this->noticiasModel->obtenerPublicacionDeEventos());
    }


}
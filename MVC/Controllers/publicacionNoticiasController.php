<?php
namespace Controllers;
use Models\Noticias;
use Config\Database;

class publicacionNoticiasController{
    private $noticiasModel;

    public function __construct(){
        global $conn;
        $this->noticiasModel = new Noticias($conn);
    }
    
    private function jsonResponse($status , $message , $data = []){
        echo json_encode(array_merge(['status' => $status , 'message' => $message] , $data));
    }

    public function obtenerPublicacionDeNoticias(){
        $this->jsonResponse('Noticias', $this->noticiasModel->obtenerPublicacionDeNoticias());
    }


}
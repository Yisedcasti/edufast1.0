<?php
namespace Models;
use PDO;
use PDOException;
use Config\Database;

class Noticias {
    private $conn;
    
    public function __construct($conn){
        $this->conn = $conn;
    }

    public function obtenerNoticias(){
        $sentencia = $base_de_datos->prepare(" SELECT * FROM public_noticias 
                                            INNER JOIN registro ON registro.num_doc = Public_noticias.registro_num_doc");
    $sentencia->execute();
$publicacionesNoticias = $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

}
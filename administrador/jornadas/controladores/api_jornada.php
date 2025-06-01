<?php 
// Headers necesarios
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Manejar preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Incluir archivos necesarios
try {
    include_once "../configuracion/conexion.php";
    include_once "../modelo/Jornadas.php";
} catch (Exception $e) {
    echo json_encode(['error' => 'Error al incluir archivos: ' . $e->getMessage()]);
    exit;
}

// Verificar que las clases existan
if (!class_exists('Jornada')) {
    echo json_encode(['error' => 'La clase Jornada no existe']);
    exit;
}

try {
    $jornadaModelo = new Jornada($base_de_datos);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error al conectar con la base de datos: ' . $e->getMessage()]);
    exit;
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        try {
            $jornadas = $jornadaModelo->obtenerJornadas();
            echo json_encode($jornadas ? $jornadas : []);
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error al obtener jornadas: ' . $e->getMessage()]);
        }
        break;
        
    case 'POST':
        try {
            $input = file_get_contents('php://input');
            $data = json_decode($input, true);
            
            if (!$data) {
                echo json_encode(['success' => false, 'error' => 'Datos JSON inválidos']);
                break;
            }
            
            if (!isset($data['jornada']) || !isset($data['hora_inicio']) || !isset($data['hora_final'])) {
                echo json_encode(['success' => false, 'error' => 'Faltan datos requeridos']);
                break;
            }
            
            $resultado = $jornadaModelo->crear($data['jornada'], $data['hora_inicio'], $data['hora_final']);
            echo json_encode(['success' => $resultado]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Error al crear: ' . $e->getMessage()]);
        }
        break;
        
    case 'PUT':
        try {
            $input = file_get_contents('php://input');
            $data = json_decode($input, true);
            
            if (!$data) {
                echo json_encode(['success' => false, 'error' => 'Datos JSON inválidos']);
                break;
            }
            
            if (!isset($data['id_jornada']) || !isset($data['jornada']) || !isset($data['hora_inicio']) || !isset($data['hora_final'])) {
                echo json_encode(['success' => false, 'error' => 'Faltan datos requeridos']);
                break;
            }
            
            $resultado = $jornadaModelo->actualizar($data['id_jornada'], $data['jornada'], $data['hora_inicio'], $data['hora_final']);
            echo json_encode(['success' => $resultado]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Error al actualizar: ' . $e->getMessage()]);
        }
        break;
        
    case 'DELETE':
        try {
            $input = file_get_contents('php://input');
            $data = json_decode($input, true);
            
            if (!$data || !isset($data['id_jornada'])) {
                echo json_encode(['success' => false, 'error' => 'ID de jornada requerido']);
                break;
            }
            
            $resultado = $jornadaModelo->eliminar($data['id_jornada']);
            echo json_encode(['success' => $resultado]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Error al eliminar: ' . $e->getMessage()]);
        }
        break;
        
    default:
        echo json_encode(['error' => 'Método no permitido']);
        break;
}
?>
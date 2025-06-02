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

try {
    include_once "../configuracion/conexion.php";
    include_once "../modelos/Grado.php";
} catch (Exception $e) {
    echo json_encode(['error' => 'Error al incluir archivos: ' . $e->getMessage()]);
    exit;
}
 
// Verificar que las clases existan
if (!class_exists('grado')) {
    echo json_encode(['error' => 'La clase grado no existe']);
    exit;
}

try {
    $gradoModelo = new grado($base_de_datos);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error al conectar con la base de datos: ' . $e->getMessage()]);
    exit;
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        try {
            $grados = $gradoModelo->obtenerGrados();
            echo json_encode($grados ? $grados : []);
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error al obtener grados: ' . $e->getMessage()]);
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
            
            if (!isset($data['nivel_educativo']) || !isset($data['grado'])) {
                echo json_encode(['success' => false, 'error' => 'Faltan datos requeridos']);
                break;
            }
            
            $resultado = $gradoModelo->crear($data['nivel_educativo'], $data['grado']);
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
            
            if (!isset($data['id_grado']) || !isset($data['nivel_educativo']) || !isset($data['grado'])) {
                echo json_encode(['success' => false, 'error' => 'Faltan datos requeridos']);
                break;
            }
            
            $resultado = $gradoModelo->actualizar($data['id_grado'], $data['nivel_educativo'], $data['grado']);
            echo json_encode(['success' => $resultado]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Error al actualizar: ' . $e->getMessage()]);
        }
        break;
        
    case 'DELETE':
        try {
            $input = file_get_contents('php://input');
            $data = json_decode($input, true);
            
            if (!$data || !isset($data['id_grado'])) {
                echo json_encode(['success' => false, 'error' => 'ID de grado requerido']);
                break;
            }
            
            $resultado = $gradoModelo->eliminar($data['id_grado']);
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
<?php
require_once '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\key;

$config = require '../config/clave.php';
$SECRET_KEY = $config['SECRET_KEY'];

$headers = getallheaders();
$authHeader = $headers['Authorization'] ?? '';

if(!$authHeader || !preg_match('/Bearner\s(\s+)/', $authHeader, $matches))
{
    
}
?>

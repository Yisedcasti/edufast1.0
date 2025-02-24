<?php
session_start();
if(!isset($_SESSION['user'])){
    header('lacation:../src/protected.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login con Jwt</title>
</head>
<body>
    
<h2>Iniciar sesion</h2>
<form action="login.php" method="post">
<input type="number" name="num_doc" placeholder="numero de documento" required>
<input type="password" name="contraseña" placeholder="contraseña" required>
<button type="submit">Ingresar</button>
</form>

<h2>Registro</h2>
<form action="register.php" method="POST">
    <input type="text">
</form>
</body>
</html>
<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: ../src/protected.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login con Jwt</title>
</head>
<body>
    
<h2>Iniciar sesion</h2>
<form action="login.php" method="POST">
<input type="number" name="num_doc" placeholder="numero de documento" required>
<input type="password" name="contraseña" placeholder="contraseña" required>
<button type="submit">Ingresar</button>
</form>


</body>

</html>

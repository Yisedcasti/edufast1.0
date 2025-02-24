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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
<form action="register.php" method="post" >
            <div class="form-group">
                <span class="label">Rol</span>
                <select name="id_rol" id="id_rol"  class="input" required>
                    <option selected disabled></option>
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?= $rol['id_rol'] ?>"><?= $rol['rol'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="hidden" name="jornada_id_jornada" value="2">
            <div class="form-group">
                <span class="label">Tipo de documento</span>
                <select name="tipo_doc" id="tipo_doc" class="input"  required>
                    <option selected disabled></option>
                    <option value="TI">Tarjeta Identidad</option>
                    <option value="CC">Cédula Ciudadana</option>
                    <option value="CE">Cédula Extranjera</option>
                    <option value="RC">Registro Civil</option>
                </select>
            </div>
            <div class="form-group">
                <span class="label">Nº documento</span>
                <input name="num_doc" oninput="validarTiempoReal(this)" maxlength="10" data-length="10" id="num_doc" type="number" class="input"  required>
                <div id="error" style="color: red; display: none;">El número debe tener exactamente 10 dígitos.</div>

            </div>
            <div class="form-group">
                <span class="label">Nombre completo</span>
                <input name="nombre" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" id="nombre" type="text"  class="input" required>
            </div>
            <div class="form-group">
                <span class="label">Apellido completo</span>
                <input name="apellido" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" id="apellido" type="text" class="input"  required>
            </div>
            <div class="form-group">
                <span class="label">Celular</span>
                <input name="celular" oninput="validarTiempoReal(this)" 
                maxlength="10" data-length="10" id="celular" type="number"  class="input" required>
                <div id="error" style="color: red; display: none;">El número debe tener exactamente 10 dígitos.</div>
            </div>
            <div class="form-group">
                <span class="label">Telefono</span>
                <input name="telefono" oninput="validarTiempoReal(this)" 
                maxlength="7" data-length="7" id="Telefono" type="number"  class="input" required>
                <div id="error_1" style="color: red; display: none;">El número debe tener exactamente 7 dígitos.</div>

            </div>
            <div class="form-group">
                <span class="label">Direccion</span>
                <input name="direccion" id="direccion" type="text"  class="input" required>
            </div>
            <div class="form-group">
                <span class="label">Correo</span>
                <input name="correo" id="correo" type="email" class="input"  required>
            </div>
            <div class="form-group">
                <span class="label">foto_perfil</span>
                <input name="foto_perfil" id="foto_perfil" type="file" class="input"  required>
            </div>
            <div class="form-group">
                <span class="label">Contraseña</span>
                <input name="contraseña" id="password" type="password" class="input"  required>
                <div id="error-password"></div>
            </div>
            <div class="button">
                <input type="submit" value="registrar">
            </div>

        </form>
</body>

<script src="../java/pass.js"></script>
    <script src="../java/alertas.js"></script>
    <script src="../java/validaciones.js"></script>
</html>

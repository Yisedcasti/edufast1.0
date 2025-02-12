<?php
session_start();
require_once 'servidor/TareasDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tareasDB = new TareasDB();
    
    $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
    $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

    if (!empty($user) && !empty($pass)) {
        if ($tareasDB->logeo($user, $pass)) {
            // Asegurarse de que $_SESSION['rol'] tiene un valor válido
            if (isset($_SESSION['rol'])) {
                // Redirigir según el rol
                if ($_SESSION['rol'] == 1) {  // Aquí se comparan solo los valores, sin importar el tipo
                    header("Location: pag_principal.php");
                    exit();
                } elseif ($_SESSION['rol'] == 2) {
                    header("Location: user/mascotas.php");
                    exit();
                } else {
                    header("Location: error.php");
                    exit();
                }
            } else {
                $error_message = "Rol no definido.";
            }
        } else {
            $error_message = "Usuario o contraseña incorrectos.";
        }
    } else {
        $error_message = "Por favor, completa todos los campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/inicio2.css">
    <title>Login</title>
</head>

<body>
    <header class="navbar navbar-expand-lg bg-body-tertiary containernav shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand fw-bold text-success d-flex align-items-center gap-2" href="#">
                <img src="../imagenes/logo.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
                <span class="text-white">EDUFAST</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto fs-5">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link active" href="../index.php">Index</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="registro.php">Registrarse</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main class="main-container">
        <div class="container mt-5 d-flex justify-content-center p-3">
            <form method="POST" class="col-md-6">
                <h1 class="text-center">Inicio de sesión</h1>

                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="user" class="form-label ps-3"><b>Usuario:</b></label>
                    <input type="text" class="form-control" name="user" placeholder="Ingresa tu usuario" required>
                    <small class="form-text">Asegúrate de introducir el usuario correcto.</small>
                </div>

                <div class="mb-3">
                    <label for="pass" class="form-label ps-3"><b>Contraseña:</b></label>
                    <input type="password" class="form-control" name="pass" placeholder="Ingresa tu contraseña" required>
                    <small class="form-text">Asegúrate de introducir la contraseña correcta.</small>
                </div>

                <div class="text-end">
                    <a class="olvido" href="#">¿Olvidaste tu contraseña?</a>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4">Iniciar sesión</button>
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>

<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Debes iniciar sesión para acceder a esta página.";
    header('Location: ../src/protected.php');
    exit;
}
include "../funciones/consultarLogro.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../../../css/stylsrec.css"/>
    <title>Página Principal</title>
</head>

<body>
    <style>
        .container {
            font-family: serif;
            font-size: 17px;
        }

        .card {
            background: linear-gradient(to bottom right, #8FB8DE, #A4C3B2);
        }
    </style>
    <div class="d-flex" id="wrapper">
        <div class="listado" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST</div>
            <div class="list-group list-group-flush my-3">
                <a href="../publicaciones/vistas/publicaciones_crear.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Publicaciones</a>
                <a href="../jornadas/vistas/jornadas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Jornadas</a>
                <a href="../grados/vistas/grados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Grados</a>
                <a href="../observador/vistas/alumnos.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Observadores</a>
                <a href="../materiaphp/materia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Materias</a>
                <a href="../actividad/actividad.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Actividades</a>
                <a href="../asistencia/listados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Asistencias</a>
                <a href="../notas/notas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Notas</a>
                <a href="../Boletin/view/boletin.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Boletin</a>
                <a href="../pag_principal.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Principal</a>            </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Bienvenido</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $_SESSION['nombres']; ?> <?php echo $_SESSION['apellidos']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../../cerrar.php">Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container mt-5">
            <?php
 if (isset($_GET['status'])) {
  if ($_GET['status'] == 'success') {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="autoCloseAlert">
              ¡Accion realizada exitosamente!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
  } elseif ($_GET['status'] == 'error') {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="autoCloseAlert">
              No se encontraron logros para esta.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
  }
}

if (isset($_GET['error']) && $_GET['error'] == 'sin_logros') {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            alert('No hay logros disponibles para esta materia.');
        });
    </script>";
}
?>

                <div class="row">
                    <main class="main-container">
                        <section class="container">
                            <h1 class="title text-center mb-5">LOGROS</h1>
                            <section class="row">
                                <?php foreach ($logros as $logro): ?>
                                    <section class="col-lg-4 col-md-12 col-sm-8 col-12 mb-4">
                                        <section class="card">
                                            <section class="card-body">
                                                <div class="card-color">
                                                    <p class="card-text text-left"><a class="list-group-item-action text-dark" href="../../actividad/actividad.php?id=<?php echo htmlspecialchars($logro->id_logro); ?>">codigo : <?php echo htmlspecialchars($logro->id_logro); ?></a> <h5 class="text-center"> Nombre : <?php echo htmlspecialchars($logro->nombre_logro); ?></h5></p>
                                                    <p class="card-text text-left"> <?php echo htmlspecialchars($logro->descripcion_logro); ?></p>
                                                    <p class="card-text text-left"> Materia : <?php echo htmlspecialchars($logro->materia); ?></p><p class="text-left"> Grado : <?php echo htmlspecialchars($logro->grado); ?></p>
                                                </div>
                                            </section>
                                             <div class="d-flex justify-content-between">

                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#confirmarModal<?php echo $logro->id_logro ?>">
                <i class="fas fa-trash-alt"></i></button>
<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#actualizarModal<?php echo $logro->id_logro ?>">
    <i class="fas fa-edit"></i>
</button>

            </div>
                                        </section>
                                    </section>
                                <?php endforeach; ?>
                                
                            <div class="d-flex justify-content-center mb-4">
            <a class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#crear">Crear Logro</a>
        </div>

        <!-- Modal para crear logro -->
         <?php foreach ($logros as $logro): ?>
<div class="modal fade" id="crear" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tituloformulario" aria-hidden="true">
<?php if (!empty($mensaje)): ?>
        <div class="alert <?= $claseAlerta; ?> alert-dismissible fade show" role="alert">
            <?= $mensaje; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloformulario">Crear Logro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2>Crear Logro</h2>
                <form action="../funciones/registrarLogro.php" method="POST">
                    <div class="form-group">
                        <label for="actividad">numero del logro</label>
                        <input type="number" class="form-control" id="id_logro" name="id_logro" required>
                    </div>
                    <div class="form-group">
                        <label for="descrip_actividad">Nombre del logro</label>
                        <input type="text" class="form-control" id="nombre_logro" name="nombre_logro" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_entrega">Descripcion del logro</label>
                        <input type="date" class="form-control" id="fecha_entrega" name="descrip_logro" required>
                    </div>
                    <div class="form-group">
                        <label for="codigo_logro">Materia</label>
                         <input type="text" id="id_materia"  class="form-control text-center"  name="id_materia" value="<?php echo htmlspecialchars($logro->materia); ?>" readonly>
                         <input type="hidden" id="id_materia" name="id_materia" value="<?php echo $logro->materia_id_materia ?> " readonly>
                    </div>
                  <div class="form-group">
                     <label for="codigo_logro">Grados</label>
    <select class="form-control" name="grado_id_grado" id="grado_id_grado" required>
        <?php foreach ($grados as $grado): ?>
            <option value="<?= $grado['id_grado'] ?>">
                <?= htmlspecialchars($grado['grado']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

                    <div class="modal-footer m-3 justify-content-center">
                        <button type="submit" class="btn btn-dark">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>


<?php foreach($logros as $logro): ?>
    <div class="modal fade" id="confirmarModal<?php echo $logro->id_logro ?>" tabindex="-1" role="dialog" aria-labelledby="confirmarModalLabel<?php echo $logro->id_logro ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmarModalLabel<?php echo $logro->id_logro ?>">Confirmar Eliminación <?php echo $logro->nombre_logro ?> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este logro ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="../funciones/eliminarlogro.php">
                        <input type="hidden" name="id_logro" value="<?php echo $logro->id_logro ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php foreach ($logros as $logro): ?>
    <!-- Modal para editar logro -->
    <div class="modal fade" id="actualizarModal<?= $logro->id_logro ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tituloEditar<?= $logro->id_logro ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloEditar<?= $logro->id_logro ?>">Editar Logro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="../funciones/actualizar.php" method="POST">
                        <input type="hidden" name="id_logro" value="<?= $logro->id_logro ?>">

                        <div class="form-group mb-3">
                            <label for="nombre_logro">Nombre del logro</label>
                            <input type="text" class="form-control" name="nombre_logro" value="<?= htmlspecialchars($logro->nombre_logro) ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="descrip_logro">Descripción del logro</label>
                            <input type="text" class="form-control" name="descrip_logro" value="<?= htmlspecialchars($logro->descripcion_logro) ?>" required>
                        </div>

                       <div class="form-group mb-3">
                            <label for="materia_id_materia">Materia</label>
                            <select class="form-control" name="id_materia" required>
                                <?php foreach ($materias as $materia): ?>
                                    <option value="<?= $materia['id_materia'] ?>" <?= $materia['id_materia'] == $logro->materia_id_materia ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($materia['materia']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="grado_id_grado">Grado</label>
                            <select class="form-control" name="grado_id_grado" required>
                                <?php foreach ($grados as $grado): ?>
                                    <option value="<?= $grado['id_grado'] ?>" <?= $grado['id_grado'] == $logro->grado_id_grado ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($grado['grado']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

                        </section>
                    </main>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer-bottom bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">©2024 codeOpacity. Designed by <span>EDUFAST</span></p>
        <div class="socials d-flex justify-content-center mt-2">
            <a href="https://www.facebook.com/cedid.sanpablo.3?locale=es_LA" class="text-white mx-2"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/plumapaulista/" class="text-white mx-2"><i class="fab fa-instagram"></i></a>
            <a href="https://x.com/Cedidsanpablo" class="text-white mx-2"><i class="fab fa-twitter"></i></a>
            <a href="mailto:cedidsanpablobosa7@educacionbogota.edu.co" class="text-white mx-2"><i class="fab fa-google"></i></a>
        </div>
    </footer>
                                                        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../js/nav.js"></script>
</body>

</html>

<?php 
include "consultarcurso.php";

session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Debes iniciar sesión para acceder a esta página.";
    header('Location: ../../src/protected.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../../../css/stylsadm.css"/>
    <title>Pagina Principal</title>
</head>
<style>
.shadow{
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px !important;
        }
    .alert-success{
        background-color:#dcfce7;
        color:#016630;
    }
    .alert-danger{
        background-color:#ffc9c9;
        color:#9f0712;
    }
</style>
<body>
    <div class="d-flex" id="wrapper">
    <div class="listado" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST</div>
            <div class="list-group list-group-flush my-3">
                <a href="../../registro/view/principal_re.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Registros</a>
                <a href="../../publicaciones/vistas/publicaciones_crear.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Publicaciones</a>
                <a href="../../jornadas/vistas/jornadas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Jornadas</a>
                <a href="../../grados/vistas/grados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Grados</a>
                <a href="../../materiaphp/vistas/materia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Materias</a>
                <a href="../../dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Principal</a>
                 </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
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
                            <li><a class="dropdown-item" href="../../../cerrar.php">Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <a href="../../../manual/manual.php" title="Ayuda" style="text-decoration: none; color: #007BFF;">
  <i class="fas fa-question-circle"></i> Ayuda
</a>
            </nav>
            <?php
 if (isset($_GET['status'])) {
  if ($_GET['status'] == 'success') {
      echo '<div class="alert alert-success border-0 alert-dismissible fade show" role="alert" id="autoCloseAlert">
             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20" class="me-2">
  <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
</svg>
 ¡Accion realizada exitosamente!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
  } elseif ($_GET['status'] == 'error') {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="autoCloseAlert">
              Algo salió mal. Por favor verifique los datos y vuelva a intentarlo.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
  }
}
?>
			<div class="mt-5">
                <div class="row">
                    <div class="col-md-12 text-center">
                    <main class="main-container">
        <h1 class="text-dark mt-2 mb-5">Cursos Existentes</h1>
        <div class="container">
  <?php 
  $gradoActual = null; // Varaible que rastrea el grado actual
  foreach ($cursos as $curso) : 
    if ($gradoActual !== $curso->grado) {
      if ($gradoActual !== null) {  // Cerrar la fila anterior si no es la primera
        echo '</div>'; // Cierra la fila de Bootstrap
      }
      $gradoActual = $curso->grado;
      echo '<div class="row mb-3">'; // Inicia una nueva fila para el nuevo grado
    }
  ?>
      <div class="col-auto">
        <div class="card text-bg-light mb-3" style="max-width: 8rem;">
          <div class="card-header"><b> Grado: </b><?php echo htmlspecialchars($curso->grado); ?></div>
          <div class="card-body">
            <p class="card-text text-center"><b> Curso:</b><br><?php echo htmlspecialchars($curso->curso); ?></p>
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#actualizar<?= $curso->id_cursos ?>">
              <i class="fas fa-edit"></i>
            </button>
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#eliminarModal<?= $curso->id_cursos ?>">
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>
        </div>
      </div>
  <?php endforeach; ?>
  </div> <!-- Cerrar la última fila -->
</div>



        <!-- Botón Crear  -->
        <div class="d-flex justify-content-center mb-4">
            <a class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#crear">Crear Curso</a>
        </div>

        <!-- Modal Crear -->
        <?php foreach ($grados as $curso): ?>
        <div class="modal fade" id="crear" tabindex="-1" aria-labelledby="crearLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearLabel">Crear Curso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="formulario" action="../controlador/curso_controlador.php" method="POST">
                            <section class="mb-3">
                            <input type="hidden" name="action" value="crear">
                                <label for="curso">Ingrese curso</label>
                                <input type="number" name="curso" class="form-control" required>
                            </section>
                            <section class="mb-3">
                                <label for="Grado">Grado:</label>
                                <input type="text" id="grado"  class="form-control text-center"  name="grado" value="<?php echo htmlspecialchars($curso->grado); ?>" readonly>
                                <input type="hidden" id="grado_id_grado" name="grado_id_grado" value="<?php echo $curso->id_grado ?> " readonly>
                            </section>
                            <section class="text-center">
                                <input type="submit" value="Enviar" class="btn btn-primary">
                            </section>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        

        <!-- Modal Actualizar -->
        <?php foreach($cursos as $curso): ?>
        <div class="modal fade" id="actualizar<?= $curso->id_cursos ?>" tabindex="-1" aria-labelledby="actualizarLabel<?= $curso->id_cursos ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="actualizarLabel<?= $curso->id_cursos ?>">Actualizar Curso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="formulario" action="../controlador/curso_controlador.php" method="POST">
                            <section class="mb-3">
                            <input type="hidden" name="action" value="actualizar">
                                <label for="curso">Curso</label>
                                <input type="number" name="curso" class="form-control text-center" value="<?php echo htmlspecialchars($curso->curso); ?>" required>
                            </section>
                            <section class="mb-3">
                                <label for="grado">Grado</label>
                                <input type="text" id="grado"  class="form-control text-center"  name="grado" value="<?php echo htmlspecialchars($curso->grado); ?>" readonly>
                                <input type="hidden" id="grado_id_grado" name="grado_id_grado" value="<?php echo $curso->grado_id_grado ?> " readonly>
                            </section>
                            <section class="text-center">
                                <input type="submit" value="Actualizar" class="btn btn-primary">
                            </section>
                            <input type="hidden" name="id_cursos" value="<?= $curso->id_cursos ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <!-- Modal Eliminar -->
        <?php foreach($cursos as $curso): ?>
        <div class="modal fade" id="eliminarModal<?= $curso->id_cursos ?>" tabindex="-1" aria-labelledby="eliminarModalLabel<?= $curso->id_cursos ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eliminarModalLabel<?= $curso->id_curso ?>">Eliminar Curso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Está seguro que desea eliminar el curso <b><?= htmlspecialchars($curso->curso) ?></b>? Esta acción no se puede deshacer.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form method="POST" action="../controlador/curso_controlador.php">
                        <input type="hidden" name="action" value="eliminar">
                            <input type="hidden" name="id_cursos" value="<?= $curso->id_cursos ?>">
                            <input type="hidden" id="grado_id_grado" name="grado_id_grado" value="<?php echo $curso->grado_id_grado ?> " readonly>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </main>
        </div>
                </div>
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
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>


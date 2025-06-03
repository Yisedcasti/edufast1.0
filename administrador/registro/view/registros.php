
<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Debes iniciar sesión para acceder a esta página.";
    header('Location: ../src/protected.php');
    exit;
}
include_once "../funciones/consulta.php";
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
<body>
    <div class="d-flex" id="wrapper">

        <div class="listado" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST</div>
            <div class="list-group list-group-flush my-3">
                <a href="principal_re.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Registros</a>
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
                    <i class="fas fa-align-left fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Bienvenid@</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                               <i class="fas fa-user me-2"></i><?php echo $_SESSION['nombres']; ?> <?php echo $_SESSION['apellidos']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../../../admin/cerrar.php">Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

			<div class="container mt-5">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="mb-3">Registros</h1>
                        <div class="table-responsive">
                        <table class="table table-hover rounded shadow table-bordered table-striped">
                        <thead>    
                        <tr>
                            <th>Numero de Documento</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Celular</th>
                            <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><?php foreach ($registros as $registro) : ?>
                                <td class="text-center"><?php echo $registro->num_doc; ?></td>
                                <td class="text-center"><?php echo $registro->nombres?></td>
                                <td class="text-center"><?php echo $registro->apellidos?></td>
                                <td class="text-center"><?php echo $registro->celular?></td>
                                <td class="text-center">
                        <a class="text-primary" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#actualizar<?php echo $registro->num_doc ?>">Modificar rol</a>
                        </td>
                                <td class="actions">
                        <a class="text-danger" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#confirmarModal<?php echo $registro->num_doc ?>">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    </tbody>
                        </table>
                    </div>
                    </div>
        </div>
        <!---Modal de actualizar--->
        <div class="modal fade" id="actualizar<?php echo $registro->num_doc ?>" tabindex="-1" aria-labelledby="actualizarLabel<?php echo $registro->num_doc ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../funciones/datosEditados.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="actualizarLabel<?php echo $registro->num_doc ?>">Editar Rol</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="num_doc" value="<?php echo $registro->num_doc ?>">

          <div class="mb-3">
            <label for="rol_id_rol<?php echo $registro->num_doc ?>" class="form-label">Rol</label>
            <select name="rol_id_rol" id="rol_id_rol<?php echo $registro->num_doc ?>" class="form-select" required>
              <option value="">Seleccione un rol</option>
              <?php foreach ($roles as $rol): ?>
                <option value="<?php echo $rol->id_rol; ?>" <?php if ($rol->id_rol == $registro->rol_id_rol) echo 'selected'; ?>>
                  <?php echo htmlspecialchars($rol->rol); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

        <!---Modal de eliminar--->
        <?php foreach($registros as $registro): ?>
    <div class="modal fade" id="confirmarModal<?php echo $registro->num_doc ?>" tabindex="-1" role="dialog" aria-labelledby="confirmarModalLabel<?php echo $registro->num_doc ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmarModalLabel<?php echo $registro->num_doc ?>">Confirmar Eliminación </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="../funciones/eliminar.php">
                        <input type="hidden" name="num_doc" value="<?php echo $registro->num_doc ?>">
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
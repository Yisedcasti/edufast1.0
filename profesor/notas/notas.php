<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Debes iniciar sesión para acceder a esta página.";
    header('Location: ../src/protected.php');
    exit;
}
include_once "consultaAlumno.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../../css/notas.css"/>
    <link rel="stylesheet" href="../../css/nav.css"/>
    <title>Grados</title>
</head> 

<body>
    <div class="d-flex" id="wrapper">
    <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST</div>
            <div class="list-group list-group-flush my-3">
            
                <a href="../registro/view/perfil.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">perfil</a>
                <a href="../asistencia/listados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Asistencia</a>
                <a href="../Materiaphp/materia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Materias</a>
                <a href="../observador/vistas/alumnos.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Observadores</a>
                <a href="listado.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Notas</a>
                <a href="../dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Principal</a>  
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
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $_SESSION['nombres']; ?> <?php echo $_SESSION['apellidos']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../../admin/cerrar.php">Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

			<div class="container mt-5">
                <div class="row">
                <main class="main-container">
        <section class="container">
            <h2>Notas Existentes</h2>
            
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">Materia</th>
                        <th class="text-center">Actividad</th>
                        <th class="text-center">Logro</th>
                        <th class="text-center">Nota</th>
                        <th class="text-center">Fecha Nota</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($notas as $nota) : ?>
                    <tr>
                        <td class="text-center"><?php echo $nota->materia ?></td>
                        <td class="text-center"><?php echo $nota->nombre_act ?></td>
                        <td class="text-center"><?php echo $nota->nombre_logro ?></td>
                        <td class="text-center"><?php echo $nota->nota ?></td>
                        <td class="text-center"><?php echo $nota->fecha_nota ?></td>
                        <td class="text-center">
                            <button 
            type="button" 
            class="btn btn-sm btn-warning btn-abrir-modal"
            data-bs-toggle="modal"
            data-bs-target="#modalActualizarNota"
            data-id_nota="<?php echo $nota->id_nota; ?>"
            data-actividad="<?php echo $nota->actividad_id_actividad; ?>"
            data-nota="<?php echo $nota->nota; ?>"
        >Actualizar</button>
                            <a href="funciones/eliminar.php?id_nota=<?php echo $nota->id_nota; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta nota?');">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
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

    <!-- Modal Actualizar Nota -->
<div class="modal fade" id="modalActualizarNota" tabindex="-1" aria-labelledby="modalActualizarNotaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formActualizarNota" method="POST" action="funciones/actualizar.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalActualizarNotaLabel">Actualizar Nota</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_nota" id="modal_id_nota">
          <div class="mb-3">
            <label for="modal_actividad" class="form-label">Actividad</label>
            <select class="form-select" name="actividad_id_actividad" id="modal_actividad" required>
              <option value="">Seleccione una actividad</option>
              <?php foreach ($actividades as $actividad): ?>
                <option value="<?= $actividad['id_actividad'] ?>"><?= htmlspecialchars($actividad['nombre_act']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="modal_nota" class="form-label">Nota</label>
            <input type="number" class="form-control" name="nota" id="modal_nota" min="0" max="5" step="0.1" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Fin Modal Actualizar Nota -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };

document.querySelectorAll('.btn-abrir-modal').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('modal_id_nota').value = this.getAttribute('data-id_nota');
        document.getElementById('modal_actividad').value = this.getAttribute('data-actividad');
        document.getElementById('modal_nota').value = this.getAttribute('data-nota');
    });
});
    </script>
</body>

</html>

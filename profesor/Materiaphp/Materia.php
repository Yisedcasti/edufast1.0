<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Debes iniciar sesión para acceder a esta página.";
    header('Location: ../src/protected.php');
    exit;
}
include "consulta.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../../css/nav.css"/>
    <title>Pagina Principal</title>
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
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST
            </div>
            <div class="list-group list-group-flush my-3">

            </div>
                
                <a href="../registro/view/perfil.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">perfil</a>
                <a href="../asistencia/listados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Asistencia</a>
                <a href="../observador/vistas/alumnos.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Observadores</a>
                <a href="../notas/listado.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Notas</a>
                <a href="../dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Principal</a>  
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

            <main class="main-container">
            <?php
 if (isset($_GET['status'])) {
  if ($_GET['status'] == 'success') {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="autoCloseAlert">
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
                <section class="container ms-1">
                    <h1 class="title text-center text-white mb-5">Materias</h1>

                    <?php
                    $areaActual = null;
                    foreach ($materias as $materia):
                        if ($areaActual !== $materia->nombre_area) {
                            if ($areaActual !== null) {
                                echo '</section>';
                            }
                            $areaActual = $materia->nombre_area;
                            echo '<section class="row mb-3">';
                            echo '<h3 class="col-12 text-center mb-3">' . htmlspecialchars($materia->nombre_area) . '</h3>';
                        }
                        ?> 

                        <section class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                            <div class="card mb-3" style="max-width: 18rem;">
                                <h4 class="card-header text-center"><?php echo htmlspecialchars($materia->nombre_area); ?>
                                </h4>
                                <div class="card-body">
                                    <h5 class="card-title"><a  class=" list-group-item list-group-item-action " href="../logrophp/vistas/logros.php?id=<?php echo htmlspecialchars($materia->id_materia)?>"><?php echo htmlspecialchars($materia->materia); ?></a></h5>

                                </div>
                            </div>
                        </section>

                    <?php endforeach; ?>

                </section> 
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
            <a href="https://www.facebook.com/cedid.sanpablo.3?locale=es_LA" class="text-white mx-2"><i
                    class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/plumapaulista/" class="text-white mx-2"><i
                    class="fab fa-instagram"></i></a>
            <a href="https://x.com/Cedidsanpablo" class="text-white mx-2"><i class="fab fa-twitter"></i></a>
            <a href="mailto:cedidsanpablobosa7@educacionbogota.edu.co" class="text-white mx-2"><i
                    class="fab fa-google"></i></a>
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
        document.getElementById("docente_info").addEventListener("change", function () {
            var selectedOption = this.options[this.selectedIndex];
            var numDoc = selectedOption.value;
            var idDocente = selectedOption.getAttribute("data-especialidad");

            document.getElementById("docente_registro_num_doc").value = numDoc;
            document.getElementById("docente_id_docente").value = idDocente;
        });
    </script>
</body>

</html>
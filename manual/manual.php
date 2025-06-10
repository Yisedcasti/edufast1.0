<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="manual.css"/>
    <title>Manual del usuario</title>
</head>
<body>
<section class="row bg-dark m-5 rounded-4 shadow border-black">
    <div class="d-flex rounded-4" id="wrapper">

        <div class="listado rounded-4" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST</div>
            <div class="list-group my-3">
                <a href="#introduccion" class="list-group-item bg-transparent second-text fw-bold">
                    <i class="fas fa-home me-2"></i>Introducción
                </a>
                <a href="#registro" class="list-group-item bg-transparent second-text fw-bold">
                    <i class="fas fa-user-plus me-2"></i>Registro
                </a>
                <a href="#jornadas" class="list-group-item bg-transparent second-text fw-bold">
                    <i class="fas fa-clock me-2"></i>Jornadas
                </a>
                <a href="#grados" class="list-group-item bg-transparent second-text fw-bold">
                    <i class="fas fa-graduation-cap me-2"></i>Grados
                </a>
                <a href="#cursos" class="list-group-item bg-transparent second-text fw-bold">
                     <i class="fas fa-graduation-cap me-2"></i>Cursos
                </a>
                <a href="#observador" class="list-group-item bg-transparent second-text fw-bold">
                    <i class="fas fa-eye me-2"></i>Observador
                </a>
                <a href="#materias" class="list-group-item bg-transparent second-text fw-bold">
                    <i class="fas fa-book me-2"></i>Mateias
                </a>
                <a href="#notas" class="list-group-item bg-transparent second-text fw-bold">
                    <i class="fas fa-sticky-note me-2"></i>Notas
                </a>
                <a href="#actividad" class="list-group-item bg-transparent second-text fw-bold">
                    <i class="fas fa-chart-line me-2"></i>Actividad
                </a>
            </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 fw-bold text-uppercase">MANUAL DE USUARIO</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>

            <div class="container mt-5 mb-4">
                <!-- Sección Introducción -->
                <div id="introduccion" class="row">
                    <div class="col-md-12 text-left">
                        <h1 class="mb-4 text-center">Introducción</h1>
                        <p class="lead">
                            Bienvenido al Manual del Usuario de nuestro sistema. Este recurso ha sido diseñado para ayudarte a comprender, utilizar y sacar el mayor provecho posible de todas las funcionalidades disponibles.<br> 
                            Aquí encontrarás una guía clara y visual que te acompañará paso a paso en cada una de las secciones del sistema, mediante explicaciones detalladas y videos prácticos. El manual está organizado de forma que puedas acceder rápidamente a la información que necesitas, sin importar si eres un usuario nuevo o ya tienes experiencia
                        </p>
                    </div>
                    <div class="text-center my-5">
                        <video controls class="rounded shadow" width="640">
                            <source src="introduccion.mp4" type="video/mp4">
                            Tu navegador no soporta el video.
                        </video>
                    </div>
                </div>

                <!-- Sección Registro -->
                <div id="registro" class="row mt-5 pt-5">
                    <div class="col-md-12 text-center">
                        <h1 class="mb-4">Registro</h1>
                        <p class="lead">
                           En el módulo de registro de usuarios, se debe completar un formulario con los siguientes campos obligatorios: rol, tipo de documento, número de documento, nombre, apellido, celular, dirección, correo electrónico y contraseña; además, se incluyen los campos de teléfono y foto de perfil, los cuales son opcionales. Es fundamental que la información registrada sea precisa, ya que el acceso al sistema se realiza ingresando el número de documento y la contraseña proporcionada durante el registro. A continuación, se muestra un video con el paso a paso del procedimiento.
                        </p>
                    </div>
                    <div class="text-center my-5">
                        <video controls class="rounded shadow" width="640">
                            <source src="registro.mp4" type="video/mp4">
                            Tu navegador no soporta el video.
                        </video>
                    </div>
                </div>

                <!-- Sección Jornadas -->
                <div id="jornadas" class="row mt-5 pt-5">
                    <div class="col-md-12 text-center">
                        <h1 class="mb-4">Jornadas</h1>
                        <p class="lead">
                           En el módulo de jornadas se encuentra un formulario con los campos: nombre de la jornada, hora de inicio y hora de finalización. Este formulario solo está disponible para los usuarios con rol de coordinador, administrador y rector, quienes podrán crear y gestionar las jornadas. El rol de secretaria únicamente podrá visualizar las jornadas existentes, mientras que los profesores y estudiantes podrán ver, desde su perfil, la jornada que tienen asignada. A continuación, se presenta un video que explica el funcionamiento de este módulo paso a paso.
                        </p>
                    </div>
                    <div class="text-center my-5">
                        <video controls class="rounded shadow" width="640">
                            <source src="videos/introduccion.mp4" type="video/mp4">
                            Tu navegador no soporta el video.
                        </video>
                    </div>
                </div>

                <!-- Sección Grados -->
                <div id="grados" class="row mt-5 pt-5">
                     <div class="col-md-12 text-center">
                        <h1 class="mb-4 ">Grados</h1>
                        <p class="lead">
                            En el módulo de grado se encuentra un formulario que permite seleccionar el nivel educativo correspondiente y, con base en él, escoger los grados que pertenecen a dicho nivel. Este formulario está disponible para los usuarios con permisos de gestión, mientras que los estudiantes podrán visualizar el grado que tienen asignado desde la sección de su perfil. A continuación, se muestra un video con el procedimiento detallado de este módulo.
                        </p>
                    </div>
                    <div class="text-center my-5">
                        <video controls class="rounded shadow" width="640">
                            <source src="videos/introduccion.mp4" type="video/mp4">
                            Tu navegador no soporta el video.
                        </video>
                    </div>
                </div>

                <!-- Más contenido para demostrar el scroll -->
                <div id="cursos" class="row mt-5 pt-5">
                <div class="col-md-12 text-center">
                        <h1 class="mb-4">Cursos</h1>
                        <p class="lead">
                           En el módulo de cursos se encuentra un formulario que permite seleccionar previamente el grado al que pertenece el curso y, posteriormente, registrar el número o nombre del curso correspondiente. Este formulario está disponible para los usuarios con permisos de gestión, mientras que los estudiantes podrán visualizar el curso que tienen asignado desde la sección de su perfil. A continuación, se muestra un video con el procedimiento detallado de este módulo.
                        </p>
                    </div>
                    <div class="text-center my-5">
                        <video controls class="rounded shadow" width="640">
                            <source src="videos/introduccion.mp4" type="video/mp4">
                            Tu navegador no soporta el video.
                        </video>
                    </div>
                </div>

                <div id="observador" class="row mt-5 pt-5">
                    <div class="col-md-12 text-center">
                        <h1 class="mb-4">Observador</h1>
                        <p class="lead">

                           En el módulo del observador, los estudiantes deben diligenciar en primer lugar un formulario con la información de sus familiares y acudiente, incluyendo datos relevantes como nombres, contacto y relación con el estudiante. Esta información es fundamental para el seguimiento académico y personal, y será visible únicamente para los usuarios que cuenten con los permisos correspondientes. A continuación, se presenta un video que muestra cómo completar correctamente este formulario.

                        </p>
                    </div>
                    <div class="text-center my-5">
                        <video controls class="rounded shadow" width="640">
                            <source src="videos/introduccion.mp4" type="video/mp4">
                            Tu navegador no soporta el video.
                        </video>
                    </div>
                </div>

                <div id="materias" class="row mt-5 pt-5">
                    <div class="col-md-12 text-center">
                        <h1 class="mb-4">Materias</h1>
                        <p class="lead">

                            En el módulo de materias se encuentra un formulario con dos campos: nombre de la materia y el área a la que será asignada. Este formulario está disponible para los usuarios con permisos de gestión. Por su parte, los estudiantes podrán visualizar únicamente las materias correspondientes a su grado, mientras que los profesores verán las materias que les hayan sido asignadas. A continuación, se presenta un video explicativo con el paso a paso de este proceso.

                        </p>
                    </div>
                    <div class="text-center my-5">
                        <video controls class="rounded shadow" width="640">
                            <source src="videos/introduccion.mp4" type="video/mp4">
                            Tu navegador no soporta el video.
                        </video>
                    </div>
                </div>

                <div id="notas" class="row mt-5 pt-5">
                   <div class="col-md-12 text-center">
                        <h1 class="mb-4">Notas</h1>
                        <p class="lead">
                            En el módulo de notas, el profesor encontrará una tabla donde podrá registrar las notas correspondientes a cada estudiante según la materia asignada. Los demás roles, excepto el administrador, podrán visualizar las notas registradas, mientras que el estudiante solo tendrá acceso para consultar sus propias calificaciones desde su perfil. A continuación, se muestra un video con el procedimiento detallado para el uso de este módulo.
                        </p>
                    </div>
                    <div class="text-center my-5">
                        <video controls class="rounded shadow" width="640">
                            <source src="videos/introduccion.mp4" type="video/mp4">
                            Tu navegador no soporta el video.
                        </video>
                    </div>
                </div>

                <div id="actividad" class="row mt-5 pt-5 mb-5">
                    <div class="col-md-12 text-center">
                        <h1 class="mb-4">Actividades</h1>
                        <p class="lead">
                           En el módulo de actividades, el profesor encontrará un formulario que debe completar con los siguientes campos: nombre de la actividad, descripción, fecha de entrega, materia a la que está dirigida y el logro al que hace referencia. Esta información será visible para los estudiantes a quienes esté asignada la actividad, permitiéndoles dar seguimiento a sus tareas. A continuación, se presenta un video explicativo sobre cómo utilizar este módulo.
                           
                        </p>
                    </div>
                    <div class="text-center my-5">
                        <video controls class="rounded shadow" width="640">
                            <source src="videos/introduccion.mp4" type="video/mp4">
                            Tu navegador no soporta el video.
                        </video>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
        el.classList.toggle("toggled");
    };

    // Smooth scroll para los enlaces del sidebar
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
</body>
</html>
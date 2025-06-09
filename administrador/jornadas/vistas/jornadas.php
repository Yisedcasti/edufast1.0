<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Debes iniciar sesión para acceder a esta página.";
    header('Location: ../src/protected.php');
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
    <title>jornadas</title>
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

            <div class="container mt-5 ms-4">
                <div class="row">
                    <main class="container ">
                        <h1 class="text-center mb-4">Gestión de Jornadas</h1>
                        <div id="alertas"></div>
                        <div id="jornadas-lista" class="row justify-content-center"></div>
                        <div class="d-flex justify-content-center ">
                            <button class="btn btn-dark mb-4 Regular" type="button" data-bs-toggle="modal" data-bs-target="#crear">Crear Jornada</button>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL CREAR -->
    <div class="modal fade" id="crear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear jornada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formCrearJornada" class="formulario">
                        <section class="jornada">
                            <label for="jornada">Jornada</label>
                            <select class="form-select" name="jornada" id="crear_jornada" required>
                                <option value="Mañana">Mañana</option>
                                <option value="Tarde">Tarde</option>
                                <option value="Noche">Noche</option>
                                <option value="Unica">Unica</option>
                            </select>
                        </section>
                        <section class="row">
                            <section class="time col">
                                <label for="hora_inicio">Hora de Inicio:</label>
                                <input class="form-control" type="time" id="crear_hora_inicio" name="hora_inicio" required>
                            </section>
                            <section class="time col">
                                <label for="hora_final">Hora Final:</label>
                                <input class="form-control" type="time" id="crear_hora_final" name="hora_final" required>
                            </section>
                        </section>
                        <section class="mt-2">
                            <input type="submit" class="btn btn-dark" value="Crear">
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Container para modales dinámicos -->
    <div id="modales-container"></div>

    <footer class="footer-bottom bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">©2024 codeOpacity. Designed by <span>EDUFAST</span></p>
        <div class="socials d-flex justify-content-center mt-2">
            <a href="https://www.facebook.com/cedid.sanpablo.3?locale=es_LA" class="text-white mx-2"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/plumapaulista/" class="text-white mx-2"><i class="fab fa-instagram"></i></a>
            <a href="https://x.com/Cedidsanpablo" class="text-white mx-2"><i class="fab fa-twitter"></i></a>
            <a href="mailto:cedidsanpablobosa7@educacionbogota.edu.co" class="text-white mx-2"><i class="fab fa-google"></i></a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Prueba diferentes rutas posibles para la API
    const API_URL = '../controladores/api_jornada.php';
    
    // Función para probar la conexión con la API
    function probarConexionAPI() {
        console.log('Probando conexión con:', API_URL);
        fetch(API_URL)
            .then(response => {
                console.log('Respuesta recibida:', response.status, response.statusText);
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                return response.text();
            })
            .then(data => {
                console.log('Datos recibidos:', data);
                try {
                    JSON.parse(data);
                    console.log('✅ API funcionando correctamente');
                } catch (e) {
                    console.log('⚠️ La respuesta no es JSON válido:', data);
                }
            })
            .catch(error => {
                console.error('❌ Error de conexión:', error);
                mostrarAlerta('danger', 'Error de conexión con la API: ' + error.message);
            });
    }

    // Mostrar alertas
    function mostrarAlerta(tipo, mensaje) {
        const alertas = document.getElementById('alertas');
        alertas.innerHTML = `<div class="alert alert-${tipo} alert-dismissible rounded-sm fs-5 border-0 fade show" role="alert">
            ${mensaje}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
        setTimeout(() => { alertas.innerHTML = ''; }, 5000);
    }

    // Función para manejar errores de fetch
    function manejarError(error) {
        console.error('Error:', error);
        mostrarAlerta('danger', 'Error de conexión. Verifica tu conexión a internet.');
    }

    // Cargar jornadas y renderizar tarjetas y modales
    function cargarJornadas() {
        console.log('Intentando cargar jornadas desde:', API_URL);
        fetch(API_URL)
            .then(res => {
                console.log('Respuesta:', res.status, res.statusText);
                if (!res.ok) {
                    throw new Error(`HTTP ${res.status}: ${res.statusText}`);
                }
                return res.json();
            })
            .then(jornadas => {
                const lista = document.getElementById('jornadas-lista');
                const modalesContainer = document.getElementById('modales-container');
                
                // Limpiar contenido existente
                lista.innerHTML = '';
                modalesContainer.innerHTML = '';

                if (!Array.isArray(jornadas) || jornadas.length === 0) {
                    lista.innerHTML = '<div class="col-12 text-center"><p>No hay jornadas registradas</p></div>';
                    return;
                }

                jornadas.forEach(jornada => {
                    // Crear tarjeta
                    const tarjeta = document.createElement('div');
                    tarjeta.className = 'col-md-4 mb-3';
                    tarjeta.innerHTML = `
                        <div class="card Regular shadow" style="width: 18rem;">
                            <img src="../../../imagenes/mañana.jpg" width="140px" class="rounded d-bloc mt-4 ms-5 me-4" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">Jornada</h5>
                                <p class="text-center">${jornada.jornada}</p>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="text-center border-right-thin separator">${jornada.hora_inicio}</td>
                                            <td class="text-center">${jornada.hora_final}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center border-end">Inicio</td>
                                            <td class="text-center">Fin</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-dark Regular" data-bs-toggle="modal" data-bs-target="#actualizar${jornada.id_jornada}">Actualizar</button>
                                    <button class="btn btn-danger ms-3 Regular" data-bs-toggle="modal" data-bs-target="#confirmarModal${jornada.id_jornada}">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    `;
                    lista.appendChild(tarjeta);

                    // Crear modales
                    crearModales(jornada, modalesContainer);
                });
            })
            .catch(manejarError);
    }

    // Función para crear modales dinámicos
    function crearModales(jornada, container) {
        // Modal Actualizar
        const modalActualizar = document.createElement('div');
        modalActualizar.className = 'modal fade';
        modalActualizar.id = `actualizar${jornada.id_jornada}`;
        modalActualizar.setAttribute('tabindex', '-1');
        modalActualizar.setAttribute('aria-hidden', 'true');
        modalActualizar.innerHTML = `
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Actualizar jornada</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="formulario" id="formActualizar${jornada.id_jornada}">
                            <section class="jornada">
                                <label>Jornadas</label>
                                <select class="form-select mb-2" name="jornada" required>
                                    <option value="Mañana" ${jornada.jornada == 'Mañana' ? 'selected' : ''}>Mañana</option>
                                    <option value="Tarde" ${jornada.jornada == 'Tarde' ? 'selected' : ''}>Tarde</option>
                                    <option value="Noche" ${jornada.jornada == 'Noche' ? 'selected' : ''}>Noche</option>
                                    <option value="Unica" ${jornada.jornada == 'Unica' ? 'selected' : ''}>Unica</option>
                                </select>
                            </section>
                            <div class="row">
                                <section class="time col">
                                    <label for="hora_inicio">Hora de Inicio:</label>
                                    <input class="form-control mb-2" type="time" name="hora_inicio" value="${jornada.hora_inicio}" required>
                                </section>
                                <section class="time col">
                                    <label for="hora_final">Hora Final:</label>
                                    <input class="form-control mb-2" type="time" name="hora_final" value="${jornada.hora_final}" required>
                                </section>
                            </div>
                            <section>
                                <input type="submit" class="btn btn-dark" value="Actualizar">
                            </section>
                        </form>
                    </div>
                </div>
            </div>
        `;
        container.appendChild(modalActualizar);

        // Modal Eliminar
        const modalEliminar = document.createElement('div');
        modalEliminar.className = 'modal fade';
        modalEliminar.id = `confirmarModal${jornada.id_jornada}`;
        modalEliminar.setAttribute('tabindex', '-1');
        modalEliminar.setAttribute('aria-hidden', 'true');
        modalEliminar.innerHTML = `
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar Eliminación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas eliminar la jornada "${jornada.jornada}"?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="btnEliminar${jornada.id_jornada}">Eliminar</button>
                    </div>
                </div>
            </div>
        `;
        container.appendChild(modalEliminar);

        // Asignar eventos después de crear los modales
        asignarEventos(jornada);
    }

    // Función para asignar eventos a los modales
    function asignarEventos(jornada) {
        // Evento para actualizar
        const formActualizar = document.getElementById(`formActualizar${jornada.id_jornada}`);
        if (formActualizar) {
            formActualizar.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const data = {
                    id_jornada: jornada.id_jornada,
                    jornada: formData.get('jornada'),
                    hora_inicio: formData.get('hora_inicio'),
                    hora_final: formData.get('hora_final')
                };

                fetch(API_URL, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                })
                .then(res => {
                    if (!res.ok) throw new Error('Error en la respuesta del servidor');
                    return res.json();
                })
                .then(resp => {
                    if (resp.success) {
                        mostrarAlerta('success', 'Jornada actualizada correctamente');
                        cargarJornadas();
                        // Cerrar modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById(`actualizar${jornada.id_jornada}`));
                        if (modal) modal.hide();
                    } else {
                        mostrarAlerta('danger', 'Error al actualizar la jornada');
                    }
                })
                .catch(manejarError);
            });
        }

        // Evento para eliminar
        const btnEliminar = document.getElementById(`btnEliminar${jornada.id_jornada}`);
        if (btnEliminar) {
            btnEliminar.addEventListener('click', function() {
                fetch(API_URL, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({id_jornada: jornada.id_jornada})
                })
                .then(res => {
                    if (!res.ok) throw new Error('Error en la respuesta del servidor');
                    return res.json();
                })
                .then(resp => {
                    if (resp.success) {
                        mostrarAlerta('success', 'Jornada eliminada correctamente');
                        cargarJornadas();
                        // Cerrar modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById(`confirmarModal${jornada.id_jornada}`));
                        if (modal) modal.hide();
                    } else {
                        mostrarAlerta('danger', 'Error al eliminar la jornada');
                    }
                })
                .catch(manejarError);
            });
        }
    }

    // Inicializar después de que el DOM esté listo
    document.addEventListener('DOMContentLoaded', function() {
        // Probar conexión con la API primero
        probarConexionAPI();
        
        // Cargar jornadas al inicio
        setTimeout(() => cargarJornadas(), 1000);

        // Evento para crear jornada
        const formCrear = document.getElementById('formCrearJornada');
        if (formCrear) {
            formCrear.addEventListener('submit', function(e) {
                e.preventDefault();
                const data = {
                    jornada: document.getElementById('crear_jornada').value,
                    hora_inicio: document.getElementById('crear_hora_inicio').value,
                    hora_final: document.getElementById('crear_hora_final').value
                };

                fetch(API_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                })
                .then(res => {
                    if (!res.ok) throw new Error('Error en la respuesta del servidor');
                    return res.json();
                })
                .then(resp => {
                    if (resp.success) {
                        mostrarAlerta('success', 'Jornada creada correctamente');
                        cargarJornadas();
                        formCrear.reset();
                        // Cerrar modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('crear'));
                        if (modal) modal.hide();
                    } else {
                        mostrarAlerta('danger', 'Error al crear la jornada');
                    }
                })
                .catch(manejarError);
            });
        }

        // Sidebar toggle
        const toggleButton = document.getElementById("menu-toggle");
        const wrapper = document.getElementById("wrapper");
        if (toggleButton && wrapper) {
            toggleButton.addEventListener('click', function() {
                wrapper.classList.toggle("toggled");
            });
        }
    });
    </script>
    <script src="../java/validaciones.js"></script>
</body>
</html>
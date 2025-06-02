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
    <link rel="stylesheet" href="../../../css/grados.css"/>
    <link rel="stylesheet" href="../../../css/stylsadm.css"/>
    <title>Grados</title>
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
                <a href="../../publicaciones/vistas/publicaciones_crear.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Publicaciones</a>
                <a href="../../jornadas/vistas/jornadas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Jornadas</a>
                <a href="../../materiaphp/vistas/materia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Materias</a>
                <a href="../../pag_principal.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Principal</a>
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
            </nav>

            <div class="container mt-5">
                <div class="row">
                    <main class="main-container">
                        <section class="container">
                            <h2 class="mb-4">Grados Existentes</h2>
                            <div id="alertas"></div>
                            <table class="table shadow ">
                                <thead>
                                    <tr>
                                        <th class="text-center ">Grado</th>
                                        <th class="text-center ">Nivel educativo</th>
                                        <th class="text-center " colspan="2">Accion</th>
                                    </tr>
                                </thead>
                                <tbody id="grados-tbody">
                                    <!-- JS renderiza aquí -->
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mb-4">
                                <button class="btn btn-dark Regular shadow" type="button" data-bs-toggle="modal" data-bs-target="#crear">Crear Grado</button>
                            </div>
                        </section>

                        <!-- Modal Crear -->
                        <div class="modal fade" id="crear" tabindex="-1" aria-labelledby="crearLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title title-center" id="crearLabel">Crear Grado</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formCrearGrado" class="formulario">
                                            <div class="mb-3">
                                                <label class="form-label d-block">Seleccione el nivel educativo</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="Primaria" value="Primaria" name="nivel_educativo" required>
                                                    <label class="form-check-label" for="Primaria">Primaria</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="Bachillerato" value="Bachillerato" name="nivel_educativo" required>
                                                    <label class="form-check-label" for="Bachillerato">Bachillerato</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label d-block">Seleccione los grados</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="cero" value="0°" name="grado[]">
                                                    <label class="form-check-label" for="cero">0º</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="primero" value="1°" name="grado[]">
                                                    <label class="form-check-label" for="primero">1º</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="segundo" value="2°" name="grado[]">
                                                    <label class="form-check-label" for="segundo">2º</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="tercero" value="3°" name="grado[]">
                                                    <label class="form-check-label" for="tercero">3º</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="cuarto" value="4°" name="grado[]">
                                                    <label class="form-check-label" for="cuarto">4º</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="quinto" value="5°" name="grado[]">
                                                    <label class="form-check-label" for="quinto">5º</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="sexto" value="6°" name="grado[]">
                                                    <label class="form-check-label" for="sexto">6º</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="septimo" value="7°" name="grado[]">
                                                    <label class="form-check-label" for="septimo">7º</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="octavo" value="8°" name="grado[]">
                                                    <label class="form-check-label" for="octavo">8º</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="noveno" value="9°" name="grado[]">
                                                    <label class="form-check-label" for="noveno">9º</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="decimo" value="10°" name="grado[]">
                                                    <label class="form-check-label" for="decimo">10º</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="once" value="11°" name="grado[]">
                                                    <label class="form-check-label" for="once">11º</label>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <input type="submit" value="Enviar" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modales dinámicos de actualizar y eliminar se generan por JS -->
                        <div id="modales-container"></div>
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
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const API_URL = '../controladores/api_grados.php';

        function mostrarAlerta(tipo, mensaje) {
            const alertas = document.getElementById('alertas');
            alertas.innerHTML = `<div class="alert alert-${tipo} alert-dismissible rounded-sm fs-5 border-0 fade show" role="alert">
                ${mensaje}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
            setTimeout(() => { alertas.innerHTML = ''; }, 4000);
        }

        function renderGrados(grados) {
            const tbody = document.getElementById('grados-tbody');
            tbody.innerHTML = '';
            document.getElementById('modales-container').innerHTML = '';
            grados.forEach(grado => {
                tbody.innerHTML += `
                    <tr>
                        <td class="text-center">${grado.grado}</td>
                        <td class="text-center">${grado.nivel_educativo}</td>
                        <td class="actions">
                            <button class="text-primary btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#actualizar${grado.id_grado}">Actualizar</button>
                        </td>
                        <td class="actions">
                            <button class="text-danger btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#confirmarModal${grado.id_grado}">Eliminar</button>
                        </td>
                    </tr>
                `;

                // Modal Actualizar
                document.getElementById('modales-container').insertAdjacentHTML('beforeend', `
                <div class="modal fade" id="actualizar${grado.id_grado}" tabindex="-1" aria-labelledby="actualizarLabel${grado.id_grado}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="actualizarLabel${grado.id_grado}">Actualizar Grado</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="formActualizarGrado" data-id="${grado.id_grado}">
                                    <div class="mb-3">
                                        <label class="form-label d-block">Nivel educativo</label>
                                        <select class="form-control" name="nivel_educativo" required>
                                            <option value="Primaria" ${grado.nivel_educativo === 'Primaria' ? 'selected' : ''}>Primaria</option>
                                            <option value="Bachillerato" ${grado.nivel_educativo === 'Bachillerato' ? 'selected' : ''}>Bachillerato</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label d-block">Grado</label>
                                        <select class="form-control" name="grado" required>
                                            <option value="0°" ${grado.grado === '0°' ? 'selected' : ''}>0º</option>
                                            <option value="1°" ${grado.grado === '1°' ? 'selected' : ''}>1º</option>
                                            <option value="2°" ${grado.grado === '2°' ? 'selected' : ''}>2º</option>
                                            <option value="3°" ${grado.grado === '3°' ? 'selected' : ''}>3º</option>
                                            <option value="4°" ${grado.grado === '4°' ? 'selected' : ''}>4º</option>
                                            <option value="5°" ${grado.grado === '5°' ? 'selected' : ''}>5º</option>
                                            <option value="6°" ${grado.grado === '6°' ? 'selected' : ''}>6º</option>
                                            <option value="7°" ${grado.grado === '7°' ? 'selected' : ''}>7º</option>
                                            <option value="8°" ${grado.grado === '8°' ? 'selected' : ''}>8º</option>
                                            <option value="9°" ${grado.grado === '9°' ? 'selected' : ''}>9º</option>
                                            <option value="10°" ${grado.grado === '10°' ? 'selected' : ''}>10º</option>
                                            <option value="11°" ${grado.grado === '11°' ? 'selected' : ''}>11º</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer mt-3 justify-content-center">
                                        <button type="submit" class="btn btn-dark">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                `);

                // Modal Eliminar
                document.getElementById('modales-container').insertAdjacentHTML('beforeend', `
                <div class="modal fade" id="confirmarModal${grado.id_grado}" tabindex="-1" aria-labelledby="confirmarModalLabel${grado.id_grado}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmarModalLabel${grado.id_grado}">Confirmar Eliminación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que deseas eliminar este registro?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger btnEliminarGrado" data-id="${grado.id_grado}">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
                `);
            });

            // Asignar eventos a formularios de actualización
            document.querySelectorAll('.formActualizarGrado').forEach(form => {
                form.onsubmit = function(e) {
                    e.preventDefault();
                    const id = form.getAttribute('data-id');
                    const data = {
                        id_grado: id,
                        nivel_educativo: form.nivel_educativo.value,
                        grado: form.grado.value
                    };
                    fetch(API_URL, {
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(data)
                    })
                    .then(res => res.json())
                    .then(resp => {
                        if (resp.success) {
                            mostrarAlerta('success', 'Grado actualizado correctamente');
                            cargarGrados();
                            var modal = bootstrap.Modal.getInstance(document.getElementById('actualizar' + id));
                            if (modal) modal.hide();
                        } else {
                            mostrarAlerta('danger', resp.error || 'Error al actualizar el grado');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        mostrarAlerta('danger', 'Error de conexión');
                    });
                };
            });

            // Asignar eventos a botones de eliminar
            document.querySelectorAll('.btnEliminarGrado').forEach(btn => {
                btn.onclick = function() {
                    const id = btn.getAttribute('data-id');
                    fetch(API_URL, {
                        method: 'DELETE',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id_grado: id })
                    })
                    .then(res => res.json())
                    .then(resp => {
                        if (resp.success) {
                            mostrarAlerta('success', 'Grado eliminado correctamente');
                            cargarGrados();
                            var modal = bootstrap.Modal.getInstance(document.getElementById('confirmarModal' + id));
                            if (modal) modal.hide();
                        } else {
                            mostrarAlerta('danger', resp.error || 'Error al eliminar el grado');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        mostrarAlerta('danger', 'Error de conexión');
                    });
                };
            });
        }

        function cargarGrados() {
            fetch(API_URL)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        renderGrados(data.grados);
                    } else {
                        mostrarAlerta('danger', 'Error al cargar los grados');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    mostrarAlerta('danger', 'Error de conexión');
                });
        }

        // Formulario crear grado
        document.getElementById('formCrearGrado').onsubmit = function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const nivelEducativo = formData.get('nivel_educativo');
            const gradosSeleccionados = formData.getAll('grado[]');

            if (gradosSeleccionados.length === 0) {
                mostrarAlerta('danger', 'Debe seleccionar al menos un grado');
                return;
            }

            // Crear promesas para cada grado seleccionado
            const promesas = gradosSeleccionados.map(grado => {
                return fetch(API_URL, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        nivel_educativo: nivelEducativo,
                        grado: grado
                    })
                });
            });

            Promise.all(promesas)
                .then(responses => Promise.all(responses.map(res => res.json())))
                .then(results => {
                    const exitosos = results.filter(r => r.success).length;
                    const fallidos = results.filter(r => !r.success);
                    
                    if (exitosos > 0) {
                        mostrarAlerta('success', `${exitosos} grado(s) creado(s) correctamente`);
                        this.reset();
                        cargarGrados();
                        var modal = bootstrap.Modal.getInstance(document.getElementById('crear'));
                        if (modal) modal.hide();
                    }
                    
                    if (fallidos.length > 0) {
                        const errores = fallidos.map(f => f.error).join(', ');
                        mostrarAlerta('danger', `Errores: ${errores}`);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    mostrarAlerta('danger', 'Error de conexión');
                });
        };

        // Funcionalidad del menú lateral
        const menuToggle = document.getElementById('menu-toggle');
        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                document.getElementById('wrapper').classList.toggle('toggled');
            });
        }
        cargarGrados();
    });
    </script>
</body>
</html>
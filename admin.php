<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración y Bodega | Autopartes "Don Pancho"</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

    <!-- NAVBAR DINÁMICO DEL PANEL -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-warning" href="#"><i class="fa-solid fa-boxes-stacked me-2"></i>Don Pancho | Panel Bodega</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarAdmin">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fa-solid fa-list-check me-1"></i> Control de Inventario</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center text-white gap-3">
                    <!-- Renderizado dinámico desde la sesión PHP -->
                    <span class="small"><i class="fa-solid fa-user-gear text-warning me-1"></i> Usuario: <strong>Alejandro M.</strong> (<span class="badge bg-warning text-dark">Admin</span>)</span>
                    <a href="logout.php" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-right-from-bracket me-1"></i>Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-4 py-4">

        <!-- CABECERA Y BOTÓN DE REGISTRO -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3 border-bottom pb-3">
            <div>
                <h2 class="fw-bold m-0"><i class="fa-solid fa-warehouse me-2 text-primary"></i>Gestión de Inventario de Repuestos</h2>
                <p class="text-muted m-0 small">Administración CRUD de catálogo, stock y fotografías de autopartes.</p>
            </div>
            <div>
                <button type="button" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#modalRegistro">
                    <i class="fa-solid fa-plus-circle me-1"></i> Registrar Nueva Autoparte
                </button>
            </div>
        </div>

        <!-- FILTROS Y BÚSQUEDA DE INVENTARIO -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-6 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" class="form-control" placeholder="Buscar por código, nombre o marca...">
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <select class="form-select">
                            <option value="">Todas las Categorías</option>
                            <option value="frenos">Frenos y Suspensión</option>
                            <option value="motor">Motor y Transmisión</option>
                            <option value="electrico">Sistema Eléctrico</option>
                            <option value="fluidos">Fluidos y Lubricantes</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-dark w-100">Filtrar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- TABLA DE CONTROL DE INVENTARIO -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle m-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Imagen</th>
                                <th>Código / SKUs</th>
                                <th>Nombre del Repuesto</th>
                                <th>Categoría</th>
                                <th>Marca / Compatibilidad</th>
                                <th>Precio (LPS)</th>
                                <th>Stock</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Fila de ejemplo 1 -->
                            <tr>
                                <td>
                                    <img src="https://via.placeholder.com/60" alt="Foto Repuesto" class="rounded border" width="50" height="50" style="object-fit: cover;">
                                </td>
                                <td><span class="badge bg-secondary">REP-00102</span></td>
                                <td class="fw-bold">Pastillas de Freno Cerámicas</td>
                                <td><span class="badge bg-info text-dark">Frenos y Suspensión</span></td>
                                <td>Toyota Hilux (2016-2022)</td>
                                <td class="fw-bold text-success">L. 1,250.00</td>
                                <td><span class="badge bg-success">24 unids</span></td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditar" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar" title="Eliminar"><i class="fa-solid fa-trash-can"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Fila de ejemplo 2 (Stock bajo) -->
                            <tr>
                                <td>
                                    <img src="https://via.placeholder.com/60" alt="Foto Repuesto" class="rounded border" width="50" height="50" style="object-fit: cover;">
                                </td>
                                <td><span class="badge bg-secondary">REP-00455</span></td>
                                <td class="fw-bold">Filtro de Aceite Sintético</td>
                                <td><span class="badge bg-warning text-dark">Fluidos y Lubricantes</span></td>
                                <td>Nissan Frontier D22</td>
                                <td class="fw-bold text-success">L. 320.00</td>
                                <td><span class="badge bg-danger">3 unids (Bajo)</span></td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditar" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar" title="Eliminar"><i class="fa-solid fa-trash-can"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- MODAL 1: REGISTRO DE NUEVA AUTOPARTE -->
    <div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="modalRegistroLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold" id="modalRegistroLabel"><i class="fa-solid fa-plus-circle me-2"></i>Registrar Nueva Autoparte</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="procesar_guardar.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nombre del Repuesto</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Ej: Bujía de Iridio" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Categoría</label>
                            <select class="form-select" name="categoria_id" required>
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="1">Frenos y Suspensión</option>
                                <option value="2">Motor y Transmisión</option>
                                <option value="3">Sistema Eléctrico</option>
                                <option value="4">Fluidos y Lubricantes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Marca / Vehículo Compatible</label>
                            <input type="text" class="form-control" name="compatibilidad" placeholder="Ej: Honda Civic 2018+" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Precio (LPS)</label>
                            <input type="number" step="0.01" class="form-control" name="precio" placeholder="0.00" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Stock Inicial</label>
                            <input type="number" class="form-control" name="stock" placeholder="0" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Especificaciones / Descripción</label>
                            <textarea class="form-control" name="descripcion" rows="2" placeholder="Detalles técnicos de la autoparte..."></textarea>
                        </div>
                        <!-- Subida segura de archivos (JPG/PNG/WEBP) -->
                        <div class="col-12">
                            <label class="form-label fw-bold">Fotografía del Repuesto (JPG, PNG, WEBP)</label>
                            <input type="file" class="form-control" name="imagen" accept=".jpg,.jpeg,.png,.webp" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success fw-bold"><i class="fa-solid fa-floppy-disk me-1"></i> Guardar Repuesto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL 2: EDICIÓN DINÁMICA DE AUTOPARTE -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="modalEditarLabel"><i class="fa-solid fa-pen-to-square me-2"></i>Editar Autoparte</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="procesar_actualizar.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="102">
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nombre del Repuesto</label>
                            <input type="text" class="form-control" name="nombre" value="Pastillas de Freno Cerámicas" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Categoría</label>
                            <select class="form-select" name="categoria_id" required>
                                <option value="1" selected>Frenos y Suspensión</option>
                                <option value="2">Motor y Transmisión</option>
                                <option value="3">Sistema Eléctrico</option>
                                <option value="4">Fluidos y Lubricantes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Marca / Vehículo Compatible</label>
                            <input type="text" class="form-control" name="compatibilidad" value="Toyota Hilux (2016-2022)" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Precio (LPS)</label>
                            <input type="number" step="0.01" class="form-control" name="precio" value="1250.00" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Stock</label>
                            <input type="number" class="form-control" name="stock" value="24" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Reemplazar Fotografía (Opcional)</label>
                            <input type="file" class="form-control" name="imagen" accept=".jpg,.jpeg,.png,.webp">
                            <span class="form-text text-muted">Dejar en blanco si no deseas cambiar la imagen actual.</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary fw-bold"><i class="fa-solid fa-arrows-rotate me-1"></i> Actualizar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL 3: CONFIRMACIÓN DE ELIMINACIÓN -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold" id="modalEliminarLabel"><i class="fa-solid fa-triangle-exclamation me-2"></i>Confirmar Eliminación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar la autoparte <strong class="text-danger">"Pastillas de Freno Cerámicas"</strong>?</p>
                    <p class="small text-muted m-0">Esta acción deshabilitará el repuesto del catálogo visualizable por los clientes.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="procesar_eliminar.php" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="102">
                        <button type="submit" class="btn btn-danger fw-bold"><i class="fa-solid fa-trash-can me-1"></i> Sí, Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
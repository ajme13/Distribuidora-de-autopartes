<?php

declare(strict_types = 1);
require_once __DIR__.'/include/index.php';
require_once 'operaciones.php';

$conexion = new ConexionBD();
$pdo = $conexion->conectar();
$repuestos = $conexion = [];
if($pdo !== null){
    $repo = new Repuestos($pdo);
    $repuestos = $repo->listar();
}

if($pdo !== null){
    $repo = new Repuestos($pdo);
    $repuestos = $repo->listar2();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $accion = $_POST['accion'] ?? '';
    if($accion === 'eliminar'){
        $repo -> eliminar((int)$_POST['id']);
        header("Location: admin.php");
        exit;
    }

    if($accion === 'crear'){
        $repo -> crear((string)$_POST['nombre'],(string)$_POST['categoria'], (float)$_POST['precio'],(int)$_POST['stock'], (string)$_POST['marca'], (string)$_POST['fotografia']);
        header("Location: admin.php");
        exit;
    }

    if($accion === 'actualizar'){
        $id             =(int)($_POST['id'] ?? 0);
        $precio         =(float)($_POST['precio'] ?? 0.0);
        $stock          =(int)($_POST['stock'] ?? 0);
        $marca          =(string)($_POST['marca'] ?? 0);
        $fotografia     =(string)($_POST['fotografia'] ?? 0);
        $categoria      =(string)($_POST['categoria'] ?? 0);
        $nombre   =trim((string)($_POST['nombre'] ?? ''));
        $repo -> actualizar($id, $precio, $stock, $nombre, $marca, $categoria, $fotografia);
        header("Location: admin.php");
        exit;
    }
}

?>

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
                            <?php foreach($repuestos as $rep): ?> 
                            <tr>
                                <td>
                                    <img src="img/<?= $rep['fotografia'] ?>.jpg" alt="Foto Repuesto" class="rounded border" width="50" height="50" style="object-fit: cover;">
                                </td>
                                <td><span class="badge bg-secondary"><?= $rep['id'] ?></span></td>
                                <td class="fw-bold"><?= $rep['nombre'] ?></td>
                                <td><span class="badge bg-info text-dark"><?= $rep['categoria'] ?></span></td>
                                <td><?= $rep['marca'] ?></td>
                                <td class="fw-bold text-success">L. <?= $rep['precio'] ?></td>
                                <td><span class="badge bg-success"><?= $rep['stock'] ?> unids</span></td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">

                                        <button type="button" 
                                            class="btn-editar"
                                            data-id="<?= $rep['id'] ?>"
                                            data-nombre="<?= $rep['nombre'] ?>"
                                            data-precio="<?= $rep['precio'] ?>"
                                            data-stock="<?= $rep['stock'] ?>"
                                            data-marca="<?= $rep['marca'] ?>"
                                            data-categoria="<?= $rep['categoria'] ?>"
                                        >Editar
                                        </button>
                                        
                                        
                                        <form method="POST" action="admin.php" onsubmit="return confirm('Desea Eliminar el Producto');">
                                            <input type="hidden" name="accion" value="eliminar">
                                            <input type="hidden" name="id" value="<?=$rep['id'] ?>">
                                            <button type="submit">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <?php endforeach; ?>
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

                <form action="admin.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body row g-3">
                        <div class="col-md-6">

                            <input type="hidden" name="accion" value="crear">
                            <label class="form-label fw-bold">Nombre del Repuesto</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Ej: Bujía de Iridio" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Categoría</label>
                            <select class="form-select" name="categoria" required>
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="Frenos y Suspensión">Frenos y Suspensión</option>
                                <option value="Motor y Transmisión">Motor y Transmisión</option>
                                <option value="Sistema Eléctrico">Sistema Eléctrico</option>
                                <option value="Fluidos y Lubricantes">Fluidos y Lubricantes</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Marca / Vehículo Compatible</label>
                            <input type="text" class="form-control" name="marca" placeholder="Ej: Honda Civic 2018+" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Precio (LPS)</label>
                            <input type="number" step="0.01" class="form-control" name="precio" placeholder="0.00" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Stock Inicial</label>
                            <input type="number" class="form-control" name="stock" placeholder="0" required>
                        </div>
                        
                        <!-- Subida segura de archivos (JPG/PNG/WEBP) -->
                        <div class="col-12">
                            <label class="form-label fw-bold">Fotografía del Repuesto (JPG, PNG, WEBP)</label>
                            <input type="file" class="form-control" name="fotografia" accept=".jpg,.jpeg,.png,.webp">
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

    <dialog id="modalEditar">
    <h2>Actualizar Producto</h2>
    <form method="POST" action="admin.php">
        <input type="hidden" name="accion" value="actualizar">
        <input type="hidden" name="id" id="edit_id">

        <label class="form-label fw-bold">Nombre del Repuesto</label>
        <input type="text" name="nombre" id="edit_nombre"><br><br>

        <label class="form-label fw-bold">Categoría</label>
        <select class="form-select" name="categoria" id="edit_categoria">
            <option value="Frenos y Suspensión" selected>Frenos y Suspensión</option>
            <option value="Motor y Transmisión">Motor y Transmisión</option>
            <option value="Sistema Eléctrico">Sistema Eléctrico</option>
            <option value="Fluidos y Lubricantes">Fluidos y Lubricantes</option>
        </select><br><br>

        <label class="form-label fw-bold">Marca / Vehículo Compatible</label>
        <input type="text" class="form-control" name="marca" id="edit_marca"><br><br>

        <label class="form-label fw-bold">Precio (LPS)</label>
        <input type="number" step="0.01" class="form-control" name="precio" id="edit_precio"> <br><br>

        <label class="form-label fw-bold">Stock</label>
        <input type="number" class="form-control" name="stock" id="edit_stock"> <br><br>


        <button type="submit">Actualizar Cambios</button>
        <button type="button" onclick="document.getElementById('modalEditar').close();">Cancelar</button>
    </form>
</dialog>

    

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
    const modalEditar = document.getElementById('modalEditar');
    document.querySelectorAll('.btn-editar').forEach(boton => {
        boton.addEventListener('click', () => {
            const id = boton.dataset.id;
            const nombre = boton.dataset.nombre;
            const precio = boton.dataset.precio;
            const stock = boton.dataset.stock;
            const marca = boton.dataset.marca;
            const categoria = boton.dataset.categoria;

            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_precio').value = precio;
            document.getElementById('edit_stock').value = stock;
            document.getElementById('edit_marca').value = marca;
            document.getElementById('edit_categoria').value = categoria;
            modalEditar.showModal();

        });
    });
</script>
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

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autopartes & Repuestos "Don Pancho" | Portal de Clientes</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero-banner {
            background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url('https://images.unsplash.com/photo-1486006920555-c77dce18193b?q=80&w=1200') center/cover no-repeat;
            color: white;
            padding: 80px 0;
        }
        .brand-badge {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <!-- NAVBAR DINÁMICA -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-warning" href="#"><i class="fa-solid fa-gear me-2"></i>Don Pancho</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="#inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#catalogo">Catálogo</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kit-tuneup">Arma tu Kit Tune-Up</a></li>
                    <li class="nav-item"><a class="nav-link" href="#facturacion">Checkout SAR</a></li>
                    <li class="nav-item"><a class="nav-link" href="#sucursales">Sucursales</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <!-- Si está logueado, sustituir por el nombre del usuario / rol -->
                    <a href="login.php" class="btn btn-outline-light btn-sm"><i class="fa-solid fa-right-to-bracket me-1"></i>Iniciar Sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO BANNER INSTITUCIONAL -->
    <header id="inicio" class="hero-banner text-center mb-5">
        <div class="container">
            <h1 class="display-4 fw-bold text-warning">Expertos en Repuestos Genuinos y Compatibles</h1>
            <p class="lead">Distribución de piezas de alta calidad para vehículos japoneses, coreanos y americanos.</p>
            <a href="#catalogo" class="btn btn-warning btn-lg mt-3 fw-bold">Explorar Catálogo</a>
        </div>
    </header>

    <div class="container">

        <!-- MARCAS VEHICULARES ALIADAS -->
        <section class="mb-5 text-center">
            <h5 class="text-uppercase text-muted fw-bold mb-3">Marcas Compatibles</h5>
            <div class="d-flex justify-content-center flex-wrap gap-3">
                <span class="brand-badge"><i class="fa-solid fa-car me-1"></i> Toyota</span>
                <span class="brand-badge"><i class="fa-solid fa-car me-1"></i> Nissan</span>
                <span class="brand-badge"><i class="fa-solid fa-car me-1"></i> Honda</span>
                <span class="brand-badge"><i class="fa-solid fa-car me-1"></i> Hyundai</span>
                <span class="brand-badge"><i class="fa-solid fa-truck-pickup me-1"></i> Isuzu</span>
                <span class="brand-badge"><i class="fa-solid fa-car me-1"></i> Ford</span>
            </div>
        </section>

        <!-- VITRINA / CATÁLOGO DINÁMICO -->
        <section id="catalogo" class="mb-5">
            <h2 class="fw-bold border-bottom pb-2 mb-4"><i class="fa-solid fa-boxes-stacked me-2"></i>Catálogo Destacado</h2>
            <!-- Grid de Productos (Renderizado dinámico PHP/DB) -->
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach($repuestos as $rep): ?>>
                <!-- Ejemplo de Tarjeta de Producto -->
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img style="height: 200px; width: 200px" src="img/<?= $rep['fotografia'] ?>.jpg" class="card-img-top" alt="Pastillas de Freno Cerámicas">
                        <div class="card-body">
                            <span class="badge bg-secondary mb-2"><?= $rep['categoria'] ?></span>
                            <h5 class="card-title fw-bold"><?= $rep['nombre'] ?></h5>
                            <h4 class="text-primary fw-bold">L. <?= $rep['precio'] ?></h4>
                            <h4 class="text-primary fw-bold"><?= $rep['marca'] ?></h4>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <button class="btn btn-dark w-100"><i class="fa-solid fa-cart-plus me-2"></i>Agregar al Carrito</button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- COTIZADOR INTERACTIVO "ARMA TU KIT TUNE-UP" -->
        <section id="kit-tuneup" class="mb-5 p-4 bg-light rounded border shadow-sm">
            <h2 class="fw-bold text-dark mb-3"><i class="fa-solid fa-wrench text-warning me-2"></i>Arma tu Kit de Mantenimiento Preventivo / Tune-Up</h2>
            <p class="text-muted">Personaliza tu kit de afinamiento y obtén un cálculo instantáneo.</p>

            <form id="formKitTuneUp" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Tipo de Vehículo</label>
                    <select class="form-select" required>
                        <option value="">Seleccione...</option>
                        <option value="sedan">Sedán</option>
                        <option value="suv">SUV</option>
                        <option value="pickup">Pick-Up 4x4</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Marca del Vehículo</label>
                    <select class="form-select" required>
                        <option value="">Seleccione...</option>
                        <option value="toyota">Toyota</option>
                        <option value="nissan">Nissan</option>
                        <option value="honda">Honda</option>
                        <option value="hyundai">Hyundai</option>
                        <option value="isuzu">Isuzu</option>
                        <option value="ford">Ford</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Viscosidad de Aceite</label>
                    <select class="form-select" required>
                        <option value="5w30">5W-30 Sintético</option>
                        <option value="10w30">10W-30 Semi-Sintético</option>
                        <option value="20w50">20W-50 Mineral</option>
                    </select>
                </div>

                <div class="col-12 mt-4">
                    <label class="form-label fw-bold">Adicionales / Repuestos Adicionales:</label>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="bujias">
                                <label class="form-check-label" for="bujias">Bujías de Iridio (+L. 800.00)</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="pastillas">
                                <label class="form-check-label" for="pastillas">Pastillas Cerámicas (+L. 1,200.00)</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="inyectores">
                                <label class="form-check-label" for="inyectores">Limpiador de Inyectores (+L. 250.00)</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="frenos">
                                <label class="form-check-label" for="frenos">Líquido de Frenos Dot4 (+L. 180.00)</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="refrigerante">
                                <label class="form-check-label" for="refrigerante">Refrigerante / Coolant 50/50 (+L. 350.00)</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-end mt-3">
                    <button type="button" class="btn btn-warning fw-bold"><i class="fa-solid fa-calculator me-2"></i>Calcular Kit</button>
                </div>
            </form>
        </section>

        <!-- MÓDULO CHECKOUT & FACTURACIÓN FISCAL SAR -->
        <section id="facturacion" class="mb-5">
            <h2 class="fw-bold border-bottom pb-2 mb-4"><i class="fa-solid fa-file-invoice-dollar me-2"></i>Checkout y Facturación Fiscal SAR</h2>
            
            <form action="procesar_factura.php" method="POST" class="card shadow-sm p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombreCliente" class="form-label fw-bold">Nombre o Razón Social</label>
                        <input type="text" class="form-control" id="nombreCliente" name="nombre_cliente" required>
                    </div>
                    <div class="col-md-3">
                        <label for="rtn" class="form-label fw-bold">RTN (Fiscal SAR)</label>
                        <input type="text" class="form-control" id="rtn" name="rtn" placeholder="08011990000000" pattern="[0-9]{14}" title="Ingrese un RTN válido de 14 dígitos" required>
                    </div>
                    <div class="col-md-3">
                        <label for="telefono" class="form-label fw-bold">Teléfono de Contacto</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="9999-9999" required>
                    </div>

                    <div class="col-md-6">
                        <label for="flete" class="form-label fw-bold">Modalidad de Flete / Entrega</label>
                        <select class="form-select" id="flete" name="flete" required>
                            <option value="0.00">Retiro en Mostrador (L. 0.00)</option>
                            <option value="50.00">Envío Moto Express (L. 50.00)</option>
                            <option value="180.00">Flete en Camioncito (L. 180.00)</option>
                        </select>
                    </div>

                    <!-- Resumen del Desglose Fiscal -->
                    <div class="col-12 bg-light p-3 rounded border mt-4">
                        <h5 class="fw-bold mb-3">Resumen de la Factura</h5>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Subtotal:</span>
                            <span id="subtotal">L. 0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1 text-success">
                            <span>Descuento Aplicado (Automático):</span>
                            <span id="descuento">- L. 0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Flete:</span>
                            <span id="costoFlete">L. 0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>ISV (15%):</span>
                            <span id="isv">L. 0.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fs-5 fw-bold text-dark">
                            <span>Total a Pagar:</span>
                            <span id="totalPagar">L. 0.00</span>
                        </div>
                    </div>

                    <div class="col-12 text-end mt-3">
                        <button type="submit" class="btn btn-success btn-lg fw-bold"><i class="fa-solid fa-check-circle me-2"></i>Generar Factura Digital Correlativa</button>
                    </div>
                </div>
            </form>
        </section>

        <!-- DIRECTORIO DE SUCURSALES -->
        <section id="sucursales" class="mb-5">
            <h2 class="fw-bold border-bottom pb-2 mb-4"><i class="fa-solid fa-store me-2"></i>Nuestras Sucursales Física</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100 border-0 bg-light shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold text-primary"><i class="fa-solid fa-location-dot me-2"></i>Tegucigalpa</h5>
                            <p class="mb-1"><strong>Toncontín:</strong> Frente a Comercial Larach.</p>
                            <p class="mb-0"><strong>Suyapa:</strong> Blvd. Suyapa, contiguo a Banco LAFISE.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 border-0 bg-light shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold text-primary"><i class="fa-solid fa-location-dot me-2"></i>San Pedro Sula</h5>
                            <p class="mb-0"><strong>Barrio Medina:</strong> 7 Calle, 3 y 4 Avenida S.O.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 border-0 bg-light shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold text-primary"><i class="fa-solid fa-location-dot me-2"></i>La Ceiba</h5>
                            <p class="mb-0"><strong>Carretera CA-13:</strong> Frente a Gasolinera Uno.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- PIE DE PÁGINA -->
    <footer class="bg-dark text-white py-4 mt-5 border-top border-warning">
        <div class="container text-center text-md-start">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="fw-bold text-warning">Autopartes & Repuestos "Don Pancho"</h5>
                    <p class="small text-muted mb-0">Líderes en repuestos originales y de reemplazo directo para el parque vehicular en Honduras.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="small mb-1">&copy; 2026 Autopartes Don Pancho. Todos los derechos reservados.</p>
                    <p class="small text-muted mb-0">Facturación adaptada bajo las normativas del SAR.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
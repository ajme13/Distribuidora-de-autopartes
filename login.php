<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Autopartes "Don Pancho"</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-login {
            max-width: 420px;
            width: 100%;
            border: none;
            border-top: 4px solid #ffc107;
        }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center">
        <div class="card card-login shadow-lg p-4 rounded">
            <div class="text-center mb-4">
                <a href="index.php" class="text-decoration-none text-dark">
                    <h3 class="fw-bold text-dark"><i class="fa-solid fa-gear text-warning me-2"></i>Don Pancho</h3>
                </a>
                <p class="text-muted small">Panel Administrativo y Bodega</p>
            </div>

            <!-- Alerta para mensajes de error de autenticación (Renderizado dinámico mediante PHP) -->
            <!-- 
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i>Usuario, contraseña o rol incorrectos.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            -->

            <form action="procesar_login.php" method="POST">
                <!-- CAMPO: USUARIO -->
                <div class="mb-3">
                    <label for="usuario" class="form-label fw-bold">Usuario</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user text-muted"></i></span>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su usuario" required autofocus>
                    </div>
                </div>

                <!-- CAMPO: CLAVE -->
                <div class="mb-3">
                    <label for="clave" class="form-label fw-bold">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock text-muted"></i></span>
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="••••••••" required>
                    </div>
                </div>

                <!-- CAMPO: ROL -->
                <div class="mb-4">
                    <label for="rol" class="form-label fw-bold">Rol de Acceso</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user-shield text-muted"></i></span>
                        <select class="form-select" id="rol" name="rol" required>
                            <option value="" disabled selected>Seleccione un rol...</option>
                            <option value="admin">Administrador (Admin)</option>
                            <option value="bodeguero">Bodeguero (Bodega)</option>
                        </select>
                    </div>
                </div>

                <!-- BOTÓN SUBMIT -->
                <button type="submit" class="btn btn-dark w-100 fw-bold py-2">
                    <i class="fa-solid fa-right-to-bracket me-2"></i>Iniciar Sesión
                </button>
            </form>

            <div class="text-center mt-4 border-top pt-3">
                <a href="index.php" class="text-secondary small text-decoration-none">
                    <i class="fa-solid fa-arrow-left me-1"></i>Volver al Portal de Clientes
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
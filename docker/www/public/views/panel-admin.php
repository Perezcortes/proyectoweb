<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel-administrador</title>
    <link rel="stylesheet" href="../css/panel-admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="header bg-dark text-white text-center p-3">
        <h1>Administrador</h1>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white active" aria-current="page" href="./panel-admin.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#" id="usuarios-link">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Roles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Reportes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Configuración</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div id="inicio-content">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h2>Bienvenido al Panel de Administración</h2>
                    </div>
                    <button class="btn btn-primary mb-3">Agregar Nuevo Usuario</button>
                </div>
                <div id="usuarios-content" style="display: none;">
                    <h2 class="mt-3">Usuarios</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Fila incluida para estructura -->
                                <tr>
                                    <td colspan="4" class="text-center">No hay datos disponibles</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybIVzCMsgSIsPphlGxUSKek/lrFuIdvQLrjTGcmgiG4iJOi1z" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93qYOR4wKjc5Y5ad+SI3CZYWbHdMol+UHVyK8OOlYkKbiwaI4KqcJereHjaGRx" crossorigin="anonymous"></script>
    <script src="../js/panel-admin.js"></script>
</body>
</html>

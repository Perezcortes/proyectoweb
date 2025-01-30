<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel-administrador</title>
    <link rel="stylesheet" href="../css/panel-admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
</head>

<body>
    <header class="header bg-dark text-white d-flex justify-content-between align-items-center p-3">
        <h1>Administrador</h1>
        <button id="logoutButton" class="logout-btn">Cerrar Sesión</button>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white active" aria-current="page" href="#" id="inicio-link">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#" id="usuarios-link">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#" id="producto-link">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Tatuadores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#" id="inventario-link">Inventario</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div id="inicio-content">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h2>Bienvenido al Panel de Administración</h2>
                    </div>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">Agregar Nuevo Usuario</button>
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
                                    <th>Fecha de Creación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se llenarán los datos de los usuarios -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="producto-content" style="display: none;">
                    <h2 class="mt-3">Productos</h2>
                    <button class="noselect">
                        <span class="text">Agregar</span>
                        <span class="icon">
                            <svg viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg"></svg>
                            <span class="buttonSpan">+</span>
                        </span>
                    </button>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre del Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Categoría</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se llenarán los datos del inventario -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- Modal para agregar un nuevo usuario -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Agregar Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correo" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="pin" class="form-label">PIN</label>
                            <input type="password" class="form-control" id="pin" name="pin" placeholder="PIN" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Rol</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="admin">Administrador</option>
                                <option value="tatoo">Tatuador</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para agregar un nuevo producto -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Agregar Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="productName" name="productName" placeholder="Nombre del Producto" required>
                        </div>
                        <div class="mb-3">
                            <label for="productQuantity" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="productQuantity" name="productQuantity" placeholder="Cantidad" required>
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Descripción</label>
                            <textarea class="form-control" id="productDescription" name="productDescription" placeholder="Descripción" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Precio" required>
                        </div>
                        <div class="mb-3">
                            <label for="productCategory" class="form-label">Categoría</label>
                            <select class="form-control" id="productCategory" name="productCategory" required>
                                <option value="Material para tatuar">Material para tatuar</option>
                                <option value="Material para perforar">Material para perforar</option>
                                <option value="Piezas para perforacion">Piezas para perforación</option>
                                <option value="Productos para sustancias">Productos para sustancias</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Imagen del Producto</label>
                            <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../js/panel-admin.js"></script>
</body>

</html>
﻿<!DOCTYPE html>
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
                <!-- Sección de Inventario -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

                <div id="inventario-content" style="display:none;">
                    <h2 class="mt-3">Inventario Deja Vu Body Art</h2>
                    <div class="folders-container">
                        <div class="folder-container" data-category="Material para tatuar">
                            <div class="folder">
                                <div class="top"></div>
                                <div class="bottom"></div>
                            </div>
                            <div class="title">Inventario<br>Material para tatuar</div>
                        </div>
                        <div class="folder-container" data-category="Material para perforar">
                            <div class="folder">
                                <div class="top"></div>
                                <div class="bottom"></div>
                            </div>
                            <div class="title">Inventario<br>Material para perforar</div>
                        </div>
                        <div class="folder-container" data-category="Piezas para perforacion">
                            <div class="folder">
                                <div class="top"></div>
                                <div class="bottom"></div>
                            </div>
                            <div class="title">Inventario<br>Piezas para perforaciones</div>
                        </div>
                        <div class="folder-container" data-category="Productos para sustancias">
                            <div class="folder">
                                <div class="top"></div>
                                <div class="bottom"></div>
                            </div>
                            <div class="title">Inventario<br>Sábanas, blunts etc.</div>
                        </div>
                    </div>
                    <div id="product-table-container" style="display:none;">
                        <button id="back-button">Volver</button>
                        <button id="download-button" class="container-btn-file">
                            <svg
                                fill="#fff"
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 50 50">
                                <path
                                    d="M28.8125 .03125L.8125 5.34375C.339844 
                    5.433594 0 5.863281 0 6.34375L0 43.65625C0 
                    44.136719 .339844 44.566406 .8125 44.65625L28.8125 
                    49.96875C28.875 49.980469 28.9375 50 29 50C29.230469 
                    50 29.445313 49.929688 29.625 49.78125C29.855469 49.589844 
                    30 49.296875 30 49L30 1C30 .703125 29.855469 .410156 29.625 
                    .21875C29.394531 .0273438 29.105469 -.0234375 28.8125 .03125ZM32 
                    6L32 13L34 13L34 15L32 15L32 20L34 20L34 22L32 22L32 27L34 27L34 
                    29L32 29L32 35L34 35L34 37L32 37L32 44L47 44C48.101563 44 49 
                    43.101563 49 42L49 8C49 6.898438 48.101563 6 47 6ZM36 13L44 
                    13L44 15L36 15ZM6.6875 15.6875L11.8125 15.6875L14.5 21.28125C14.710938 
                    21.722656 14.898438 22.265625 15.0625 22.875L15.09375 22.875C15.199219 
                    22.511719 15.402344 21.941406 15.6875 21.21875L18.65625 15.6875L23.34375 
                    15.6875L17.75 24.9375L23.5 34.375L18.53125 34.375L15.28125 
                    28.28125C15.160156 28.054688 15.035156 27.636719 14.90625 
                    27.03125L14.875 27.03125C14.8125 27.316406 14.664063 27.761719 
                    14.4375 28.34375L11.1875 34.375L6.1875 34.375L12.15625 25.03125ZM36 
                    20L44 20L44 22L36 22ZM36 27L44 27L44 29L36 29ZM36 35L44 35L44 37L36 37Z"></path>
                            </svg>
                            Descargar Excel
                        </button>
                        <h2>Productos</h2>
                        <table id="product-table" class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se llenará la tabla con los productos -->
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
                            <!-- Input file oculto -->
                            <input type="file" class="form-control d-none" id="productImage" name="productImage" accept="image/*" required>

                            <!-- Botón personalizado que activa el input file -->
                            <button type="button" id="customFileBtn" class="custom-file-btn">
                                <svg
                                    aria-hidden="true"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        stroke-width="2"
                                        stroke="#ffffff"
                                        d="M13.5 3H12H8C6.34315 3 5 4.34315 5 6V18C5 19.6569 6.34315 21 8 21H11M13.5 3L19 8.625M13.5 3V7.625C13.5 8.17728 13.9477 8.625 14.5 8.625H19M19 8.625V11.8125"
                                        stroke-linejoin="round"
                                        stroke-linecap="round"></path>
                                    <path
                                        stroke-linejoin="round"
                                        stroke-linecap="round"
                                        stroke-width="2"
                                        stroke="#ffffff"
                                        d="M17 15V18M17 21V18M17 18H14M17 18H20"></path>
                                </svg>
                                Agregar Imagen
                            </button>

                            <!-- Barra de progreso (inicialmente oculta) -->
                            <div class="progress mt-2" style="height: 20px; display: none;" id="progressContainer">
                                <div id="uploadProgressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%; background-color: green;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    0%
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Registrar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para Editar Producto -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm" enctype="multipart/form-data">
                        <input type="hidden" id="editProductId" name="id_producto">

                        <div class="mb-3">
                            <label for="editProductName" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="editProductName" name="nombre" placeholder="Nombre del Producto" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductQuantity" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="editProductQuantity" name="cantidad" placeholder="Cantidad" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductDescription" class="form-label">Descripción</label>
                            <textarea class="form-control" id="editProductDescription" name="descripcion" placeholder="Descripción" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editProductPrice" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="editProductPrice" name="precio" placeholder="Precio" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductCategory" class="form-label">Categoría</label>
                            <select class="form-control" id="editProductCategory" name="categoria" required>
                                <option value="Material para tatuar">Material para tatuar</option>
                                <option value="Material para perforar">Material para perforar</option>
                                <option value="Piezas para perforacion">Piezas para perforación</option>
                                <option value="Productos para sustancias">Productos para sustancias</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../js/panel-admin.js"></script>
</body>

</html>
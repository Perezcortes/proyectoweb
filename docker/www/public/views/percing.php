<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deja Vu - Perforaciones</title>
    <link rel="icon" type="image/png" href="../img/dj1.png">

    <link rel="stylesheet" href="../css/percing.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Flatpickr CSS calendario -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Bootstrap JS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap Bundle JS (con Popper incluido) -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/contenido_percing.js"></script>
</head>

<style>
     .modal-content {
  background-color: #181617 !important; /* Color de fondo */
  color: white !important; /* Color del texto */
}

 .modal-header {
  background-color: #181617 !important;
  border-bottom: 2px solid #E07FAB !important;
}

 .modal-footer {
  background-color: #181617 !important;
  border-top: 2px solid #E07FAB !important;
}


</style>

<body class="fondo">
    <!--nav bar, se mestra el logo de la empresa y el titulo de la pag en la que se encuentra-->
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <a class="navbar-brand" href="../index.php">
            <!--imagen de la empresa-->
            <img src="../img/dj3.jpeg" alt="Logo" width="60" height="50" class="d-inline-block align-text-center">
            Deja Vu
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!--nombre de la pag en la que se encuentra el usuario-->
            <ul class="navbar-nav ml-auto "><!--ml-auto define un margen a la isquierda automatico-->
                <li class="nav-item ">
                    <h2>Perforaciones</h2>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./productos.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./login.php">Contacto</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="d-flex justify-content-between align-items-center w-100">
        <!-- Buscador alineado a la derecha -->
        <div class="buscador ms-auto">
            <form class="form">
                <label for="search">
                    <input required="" autocomplete="off" placeholder="Filtrar contenido" id="search" type="text">
                    <div class="icon">
                        <svg stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="swap-on">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linejoin="round"
                                stroke-linecap="round"></path>
                        </svg>
                        <svg stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="swap-off">
                            <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-linejoin="round" stroke-linecap="round"></path>
                        </svg>
                    </div>
                    <button type="reset" class="close-btn">
                        <svg viewBox="0 0 20 20" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </label>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registra tu cita </h1>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="Email" class="col-form-label">Correo electronico:</label>
                            <input id="Email" type="text" class="form-control" name="email" required>
                          <label  class="col-form-label-sm">*El correo electronioco debe estra prebiamente registrado*</label>
                        </div>
                        <div class="mb-3">
                            <label for="Nombre" class="col-form-label">Nombre del cliente:</label>
                            <input id="Nombre" type="text" class="form-control" name="nombre" required>
                        </div>
                        <!--calendario-->
                        <div class="mb-3">
                            <label for="datepicker" class="col-form-label">Fecha de la cita:</label>
                            <input id="datepicker" type="text" class="border border-gray-300 rounded-md p-2 w-64 mt-2"
                                name="fecha" required>
                        </div>
                        
                        <!-- Reloj -->
                        <div class="mb-3">
                            
                        <p id="selectHour" class="text-primary" style="cursor: pointer;" onclick="toggleHours()">Hora de la cita:</p>
                        <input type="hidden" id="hiddenHour" name="hora">
                        <div id="hourButtons" class="d-none">
                          
                        </div>
                    </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-info" id="liveToastBtn">Reservar cita</button>

                 
                </div>
            </div>
        </div>
    </div>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
                        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="me-auto">Deja vu</strong>
                                <small>¡Atencion!</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast"
                                    aria-label="Close"></button>
                            </div>
                            <div class="toast-body " >
                                Tu cita fue registrada con exito c:.
                            </div>
                        </div>
                    </div>
    <!--contenido  de la pag-->
    <div class="container mt-4">
    <!-- Contenedor donde se insertarán las tarjetas o el detalle -->
    <div id="contenido">
        <div class="row  g-3" id="card-container">
            <!-- Aquí se insertarán dinámicamente las tarjetas con JavaScript -->
        </div>
    </div>
</div>
    <!-- Incluir el Footer -->
    <?php include './footer.php'; ?>
    <script src="../js/citas_percing.js"></script>
</body>

</html>
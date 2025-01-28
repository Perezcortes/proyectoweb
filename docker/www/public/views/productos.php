<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deja Vu - Perforaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/productos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

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
                    <h2>Productos</h2>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Contenido de Productos -->

    <div class="container text-center my-5">

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="../img/arete.jpeg" class="card-img-top" alt="Aretes">
                    <div class="card-body">
                        <h5 class="card-title">Aretes</h5>
                        <p class="card-text">$88.00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="../img/pipa.jpeg" class="card-img-top" alt="Pipas">
                    <div class="card-body">
                        <h5 class="card-title">Pipas</h5>
                        <p class="card-text">$88.00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="../img/kit.jpeg" class="card-img-top" alt="Materiales">
                    <div class="card-body">
                        <h5 class="card-title">Materiales</h5>
                        <p class="card-text">$88.00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="../img/expansores.jpeg" class="card-img-top" alt="Expansores">
                    <div class="card-body">
                        <h5 class="card-title">Expansores</h5>
                        <p class="card-text">$88.00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="../img/cartucho.jpg" class="card-img-top" alt="Cartuchos">
                    <div class="card-body">
                        <h5 class="card-title">Cartuchos</h5>
                        <p class="card-text">$88.00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="../img/canala.jpg" class="card-img-top" alt="Canales">
                    <div class="card-body">
                        <h5 class="card-title">Canales</h5>
                        <p class="card-text">$88.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link">Anterior</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Siguiente</a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Incluir el Footer -->
    <?php include './footer.php'; ?>
    <script src="../js/percing.js"></script>
</body>

</html>
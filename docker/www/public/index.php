﻿<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deja Vu Body Art</title>
    <link rel="icon" type="image/png" href="../img/dj1.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <!-- Logo -->
        <a class="navbar-brand" href="./index.php">
            <img src="./img/dj1.png" width="90" height="85" alt="logo" class="d-inline-block align-top">
        </a>

        <!-- Botón para pantallas pequeñas (menú hamburguesa) -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú colapsable -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="./views/citas.php">Citas</a></li>
                <li class="nav-item"><a class="nav-link" href="./views/tatuadores.php">Tatuadores</a></li>
                <li class="nav-item"><a class="nav-link" href="./views/productos.php">Productos</a></li>
                <li class="nav-item"><a class="nav-link" href="./views/percing.php">Perforaciones</a></li>
            </ul>
        </div>

        <!-- Botón de Iniciar Sesión -->
        <button class="btn btn-outline-primary" type="button" onclick="window.location.href='./views/login.php';"
            aria-label="Iniciar sesión o registrarse">
            <i class="fas fa-user"></i> Iniciar Sesión
        </button>
    </nav>

    <!-- Main Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6">
                <h2><i class="fas fa-tattoo"></i> Bienvenido a Deja Vu</h2>
                <p>Somos un estudio dedicado a la creación de tatuajes únicos y personalizados para cada cliente. Visítanos para descubrir nuestros trabajos y el talento de nuestros tatuadores.</p>
            </div>
            <div class="col-lg-6">
                <!-- Carousel -->
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./img/dj1.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/dj2.jpeg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/dj3.jpeg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sección de información -->
        <div class="container mt-5 informacion">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="image-container">
                        <img src="./img/dresan.jpeg" class="img-fluid" alt="Descripción de la imagen">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3>Conócenos</h3>
                    <p>Este es el texto que deseas agregar al lado derecho de la imagen. Aquí puedes incluir cualquier información relevante.</p>
                </div>
            </div>
        </div>

        <!-- Google Maps Section -->
        <div class="mt-5">
            <h4><i class="fas fa-map-marker-alt" style="color:rgb(182, 57, 57);"></i> Nuestra Ubicación</h4>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d237.41614413402652!2d-97.77431233043416!3d17.80774894498163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c601fac43b78af%3A0xbe09588f27b5fe6b!2zRMOpasOhIFZ1!5e0!3m2!1ses-419!2smx!4v1737342145274!5m2!1ses-419!2smx"
                style="width: 100%; height: 450px; border: 0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

    </div>

    <div class="whatsapp-chat">
        <span>Chat</span>
        <a href="https://wa.me/529531447499" target="_blank">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    </div>
    <!-- Incluir el Footer -->
    <?php include './views/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
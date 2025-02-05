﻿<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tatuadores</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/tatuadores.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Navbar de Bootstrap -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <a class="navbar-brand" href="#">Tatuadores</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">Volver</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" id="searchBar" placeholder="Buscar"
                    aria-label="Buscar">
                <button class="btn btn-outline-success my-2 my-sm-0" type="button" id="searchButton">Buscar</button>
            </form>
        </div>
    </nav>

    <div id="results"></div>

    <div class="container mt-5">
        <!-- Título del equipo de tatuadores -->
        <div class="text-center mb-5">
            <h1 id="main-title">Tatuadores</h1>
        </div>
        <div class="row align-items-center">
            <!-- Contenedor de imagen -->
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="../img/tatuadores.png" class="img-fluid rounded" alt="Tatuadores">
            </div>
            <!-- Contenedor de texto -->
            <div class="col-md-6 text-container">
                <p>
                    Nuestro equipo de tatuadores profesionales cuenta con expertos en diversos estilos como: Blackwork,
                    Tradicional, Línea Fina, Geométrico, Ornamental, Realismo y Neo Tradicional hasta Lettering y
                    Realismo. Ya sea que estés buscando una pieza pequeña y sencilla o un diseño grande y elaborado,
                    nuestros artistas trabajarán contigo para crear el tatuaje perfecto.
                </p>
                <h2 id="team-section-title">CONOCE A NUESTRO EQUIPO DE TATUADORES:</h2>
            </div>
        </div>
    </div>

    <!-- Secciones de Tatuadores -->
    <div class="container mt-5">
        <div class="row">
            <!-- Sección de Tatuador -->
            <div class="col-md-4 artist-section">
                <!-- Nombre y Red Social -->
                <div class="artist-header" id="tatuador-andres-villagomez">
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <!-- Carrusel de imágenes -->
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="../img/dj1.png" alt="Tatuaje 1"></div>
                        <div class="swiper-slide"><img src="../img/dj2.jpeg" alt="Tatuaje 2"></div>
                        <div class="swiper-slide"><img src="../img/dj3.jpeg" alt="Tatuaje 3"></div>
                        <div class="swiper-slide"><img src="../img/dresan.jpeg" alt="Tatuaje 4"></div>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <!-- Repite esta sección para otros tatuadores -->
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <!-- Sección de Tatuador -->
            <div class="col-md-4 artist-section">
                <!-- Nombre y Red Social -->
                <div class="artist-header">
                    <span class="artist-name">Andres Villagomez</span>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <!-- Carrusel de imágenes -->
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="../img/dj1.png" alt="Tatuaje 1"></div>
                        <div class="swiper-slide"><img src="../img/dj2.jpeg" alt="Tatuaje 2"></div>
                        <div class="swiper-slide"><img src="../img/dj3.jpeg" alt="Tatuaje 3"></div>
                        <div class="swiper-slide"><img src="../img/dresan.jpeg" alt="Tatuaje 4"></div>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <!-- Repite esta sección para otros tatuadores -->
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <!-- Sección de Tatuador -->
            <div class="col-md-4 artist-section">
                <!-- Nombre y Red Social -->
                <div class="artist-header">
                    <span class="artist-name">Andres Villagomez</span>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <!-- Carrusel de imágenes -->
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="../img/dj1.png" alt="Tatuaje 1"></div>
                        <div class="swiper-slide"><img src="../img/dj2.jpeg" alt="Tatuaje 2"></div>
                        <div class="swiper-slide"><img src="../img/dj3.jpeg" alt="Tatuaje 3"></div>
                        <div class="swiper-slide"><img src="../img/dresan.jpeg" alt="Tatuaje 4"></div>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <!-- Repite esta sección para otros tatuadores -->
        </div>
    </div>
    <!-- Incluir el Footer -->
    <?php include './footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!--Íconos FontAwesome-->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="../js/tatuadores.js"></script> <!-- Enlace al archivo JavaScript externo -->
</body>

</html>
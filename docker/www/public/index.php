<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deja Vu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="./css/index.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Deja Vu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
            </ul>
        </div>
        <ul class="navbar-nav d-inline-block float-right">
            <li class="nav-item">
            <a class="btn btn-primary" href="./views/login.html">Iniciar sesión</a>
            </li>
        </ul>
    </nav>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./img/DejaVu.png" class="d-block w-100" alt="...">
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
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
        </a>
    </div>

    <footer id="footer-container"
        style="background-color: #212529; color: #ffffff; padding: 40px 0; font-family: Arial, sans-serif; width: 100%; box-sizing: border-box;">
        <div style="max-width: 1200px; margin: auto; display: flex; justify-content: space-between; flex-wrap: wrap;">
            <!-- Sección de enlaces -->
            <div style="flex: 1; margin: 10px; min-width: 150px;">
                <h5 style="font-size: 16px; margin-bottom: 15px;">Section</h5>
                <ul style="list-style: none; padding: 0;">
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Home</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Features</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Pricing</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">FAQs</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">About</a></li>
                </ul>
            </div>

            <div style="flex: 1; margin: 10px; min-width: 150px;">
                <h5 style="font-size: 16px; margin-bottom: 15px;">Section</h5>
                <ul style="list-style: none; padding: 0;">
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Home</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Features</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Pricing</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">FAQs</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">About</a></li>
                </ul>
            </div>

            <div style="flex: 1; margin: 10px; min-width: 150px;">
                <h5 style="font-size: 16px; margin-bottom: 15px;">Section</h5>
                <ul style="list-style: none; padding: 0;">
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Home</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Features</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Pricing</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">FAQs</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">About</a></li>
                </ul>
            </div>

            <!-- Sección de suscripción -->
            <div class="col-md-5 offset-md-1 mb-3">
                <h5 style="font-size: 16px; margin-bottom: 15px;">Suscribete y recibe promociones</h5>
                <p style="color: #adb5bd; margin-bottom: 15px;">Resumen mensual de nuestras novedades más interesantes.</p>
                <form
                    style="display: inline; align-items: center; background-color: #212529; padding: 10px; border-radius: 5px;">
                    <input type="email" class="subscribe-input" placeholder="Email address"
                        style="padding: 10px; border: none; background-color: #495057; color: #fff; border-radius: 3px; min-width: 0; width: 250px;">
                    <button type="button"
                        style="background-color: #0d6efd; color: #fff; border: 3px; padding: 10px 20px; border-radius: 3px; cursor: pointer;">Subscribe</button>
                </form>
            </div>
        </div>

        <!-- Línea divisoria -->
        <hr style="border: 0.5px solid #495057; margin: 30px 0;">

        <!-- Pie de página -->
        <div
            style="max-width: 1200px; margin: auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
            <p style="margin: 0; color: #adb5bd;">© 2025 Deja Vu Body Art. Todos los derechos reservados.</p>
            <div>
                <!-- Iconos de redes sociales -->
                <a href="#" style="color: #adb5bd; margin: 0 20px; text-decoration: none;" aria-label="WhatsApp">
                    <i class="fab fa-whatsapp fa-lg"></i>
                </a>
                <a href="#" style="color: #adb5bd; margin: 0 20px; text-decoration: none;" aria-label="Facebook">
                    <i class="fab fa-facebook fa-lg"></i>
                </a>
                <a href="#" style="color: #adb5bd; margin: 0 20px; text-decoration: none;" aria-label="Instagram">
                    <i class="fab fa-instagram fa-lg"></i>
                </a>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
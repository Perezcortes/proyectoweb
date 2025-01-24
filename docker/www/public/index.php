<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deja Vu Body Art</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        
        <!-- Logo -->
        <a class="navbar-brand" href="./index.php">
            <img src="./img/dj1.png" width="90" height="85" alt="logo" class="d-inline-block align-top">
        </a>
        <!-- NavBar -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="#">Citas</a></li>
                <li class="nav-item"><a class="nav-link" href="./views/tatuadores.html">Tatuadores</a></li>
                <li class="nav-item"><a class="nav-link" href="./views/productos.html">Productos</a></li>
                <li class="nav-item"><a class="nav-link" href="./views/percing.html">Perforaciones</a></li>
            </ul>
        </div>
        <!-- Login/Register Button -->
        <button class="btn btn-outline-primary" type="button" onclick="window.location.href='./views/login.html';" aria-label="Iniciar sesión o registrarse">
            <i class="fas fa-user"></i> Iniciar Sesión
            <br>ó<br>Registrarse
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

    <footer id="footer-container"
        style="background-color: #212529; color: #ffffff; padding: 40px 0; font-family: Arial, sans-serif; width: 100%; box-sizing: border-box;">
        <div style="max-width: 1200px; margin: auto; display: flex; justify-content: space-between; flex-wrap: wrap;">
            <!-- Sección de enlaces -->
            <div style="flex: 1; margin: 10px; min-width: 150px;">
                <h5 style="font-size: 16px; margin-bottom: 15px;">Servicios</h5>
                <ul style="list-style: none; padding: 0;">
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Tatuajes</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Piercings</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Removemos tatuajes</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Microdermal</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Expanciones</a></li>
                </ul>
            </div>

            <div style="flex: 1; margin: 10px; min-width: 150px;">
                <h5 style="font-size: 16px; margin-bottom: 15px;">Material</h5>
                <ul style="list-style: none; padding: 0;">
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Maquinas de tatuar</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Cartuchos</a></li>
                    <li><a href="#" style="color: #adb5bd; text-decoration: none;">Productos</a></li>
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
            <p style="margin: 0; color:rgb(222, 124, 5);">© 2025 Deja Vu Body Art. Todos los derechos reservados.</p>
            <div>
                <!-- Iconos de redes sociales -->
                <a href="https://wa.me/529531447499" style="color:rgb(35, 205, 46); margin: 0 25px; text-decoration: none;" aria-label="WhatsApp">
                    <i class="fab fa-whatsapp fa-lg"></i>
                </a>
                <a href="https://www.facebook.com/share/15h4Lz3Dzw/" style="color:rgb(29, 121, 214); margin: 0 25px; text-decoration: none;" aria-label="Facebook">
                    <i class="fab fa-facebook fa-lg"></i>
                </a>
                <a href="https://www.instagram.com/andres_dresan?igsh=MWd1ejdqOW5oeTV1eQ==" style="color:rgb(227, 17, 171); margin: 0 25px; text-decoration: none;" aria-label="Instagram">
                    <i class="fab fa-instagram fa-lg"></i>
                </a>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
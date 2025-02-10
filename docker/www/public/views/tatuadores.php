<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tatuadores</title>
    <link rel="icon" type="image/png" href="../img/dj1.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/tatuadores.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Navbar de Bootstrap -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <a class="navbar-brand" href="../index.php"> 
             <img src="../img/dj1.png" alt="Logo" width="60" height="50" class="d-inline-block align-text-center">
        Deja Vu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto    "><!--ml-auto define un margen a la isquierda automatico-->
                <li class="text-center  ">
                    <h1>Tatuadores</h1>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" id="searchBar" placeholder="Buscar"
                    aria-label="Buscar">
                <button class="btn btn-outline-success my-2 my-sm-0" type="button" id="searchButton">Buscar</button>
            </form>
        </div>
    </nav>

    
    <div class="container mt-5">
        <!-- Contenedor de imagen -->
        <div class="col-md-12 mb-3"> 
            <img src="../img/tatuadores.png" class="img-fluid mb-3" alt="Tatuadores">
            <h6 class="text-start" >
                Nuestro equipo de tatuadores profesionales cuenta con expertos en diversos estilos como: Blackwork,
                Tradicional, Línea Fina, Geométrico, Ornamental, Realismo y Neo Tradicional hasta Lettering y
                Realismo. Ya sea que estés buscando una pieza pequeña y sencilla o un diseño grande y elaborado,
                nuestros artistas trabajarán contigo para crear el tatuaje perfecto.
            </h6>
        </div>
        
        <div class="row text-start">
            
            <h2 id="team-section-title">CONOCE A NUESTRO EQUIPO DE TATUADORES:</h2>
        <!-- </div> -->
    </div>
    <div id="results"></div>
</div>


    <div id="card-container"></div>
</div>


    <!-- Incluir el Footer -->
    <?php include './footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!--Íconos FontAwesome-->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- <script src="../js/tatuadores.js"></script> Enlace al archivo JavaScript externo -->
    <script src="../js/tatuadores.js?v=<?php echo time(); ?>"></script>

</body>

</html>
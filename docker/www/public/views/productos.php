<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deja Vu Body Art</title>
    <link rel="icon" type="image/png" href="../img/dj1.png">
    <link rel="stylesheet" href="../css/productos.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="../views/productos.php">Deja Vu Body Art</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Inicio</a>
                </li>
            </ul>
            <form class="form-inline ml-auto">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </div>
    </nav>

    <!-- Página principal -->
    <main id="main-page">
        <header class="main-header">
            <div class="header-content">
                <h1>¿Qué estás buscando?</h1>
                <h2>Deja Vu Body Art</h2>
            </div>
        </header>
        <section class="info-section">
            <p class="custom-font">Haz clic en la sección que deseas ver los productos o puedes buscar algo específico en la barra de búsqueda.</p>
        </section>
        <section class="cards-section">
            <div class="card-cat" onclick="showSection('tatuar', 'Material para tatuar')">
                <img src="../img/tatuajes.png" alt="Material para tatuar">
                <h3>Material para tatuar</h3>
            </div>
            <div class="card-cat" onclick="showSection('perforar', 'Material para perforar')">
                <img src="../img/perfos.avif" alt="Material para perforar">
                <h3>Material para perforar</h3>
            </div>
            <div class="card-cat" onclick="showSection('piezas', 'Piezas para perforacion')">
                <img src="../img/piezas.webp" alt="Piezas para perfos">
                <h3>Piezas para perfos</h3>
            </div>
            <div class="card-cat" onclick="showSection('sustancias', 'Productos para sustancias')">
                <img src="../img/sustancias.avif" alt="Pipas, sabanas, etc.">
                <h3>Pipas, sabanas, etc.</h3>
            </div>
        </section>
    </main>

    <!-- Secciones de productos -->
    <section id="tatuar" class="product-section" style="display: none;">
        <h2>Material para tatuar</h2>
        <div class="productos"></div>
        <button onclick="showMainPage()">Volver</button>
    </section>
    <section id="perforar" class="product-section" style="display: none;">
        <h2>Material para perforar</h2>
        <div class="productos"></div>
        <button onclick="showMainPage()">Volver</button>
    </section>
    <section id="piezas" class="product-section" style="display: none;">
        <h2>Piezas para perfos</h2>
        <div class="productos"></div>
        <button onclick="showMainPage()">Volver</button>
    </section>
    <section id="sustancias" class="product-section" style="display: none;">
        <h2>Pipas, sabanas, etc.</h2>
        <div class="productos"></div>
        <button onclick="showMainPage()">Volver</button>
    </section>
    <!-- Modal para los resultados de busqueda -->
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Resultados de búsqueda</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Aquí se insertarán los resultados de la búsqueda -->
                </div>
            </div>
        </div>
    </div>


    <?php include './footer.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/seccion-productos.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Citas</title>
    <link rel="icon" type="image/png" href="../img/dj1.png">
    <link rel="stylesheet" href="../css/citas.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Navbar Fijo -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container position-relative">
            <!-- Imagen fuera del texto -->
            <div class="navbar-image-container">
                <img src="../img/dj2.jpeg" alt="Logo" class="navbar-external-image">
            </div>
            <a class="navbar-brand" href="#">Agenda tu cita</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/tatuadores.php">Tatuadores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://wa.me/529531447499">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal (Formulario) -->
    <main class="mt-5 pt-5" id="cita-form">
        <div class="container">
            <!-- Sección Principal del Formulario -->
            <form>
                <h2 class="text-center">¡Agenda hoy!</h2>

                <label for="nombre">Nombre(s):</label>
                <input type="text" id="nombre" name="nombre" />

                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" />

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" />

                <label for="whatsapp">Whatsapp:</label>
                <div class="whatsapp-input d-flex flex-wrap">
                    <select id="codigo_pais" name="codigo_pais">
                        <option value="+52">🇲🇽 +52</option>
                    </select>
                    <input type="text" id="whatsapp" name="whatsapp" />
                </div>

                <label for="tipo_cita">Tipo de cita:</label>
                <select id="tipo_cita" name="tipo_cita" onchange="updateForm(this.value)">
                    <option value="Elegir">Elegir</option>
                    <option value="Tatuaje">Tatuaje</option>
                    <option value="Perforacion">Perforación</option>
                    <option value="Cotizar">Cotizar</option>
                    <option value="Otro">Otro</option>
                </select>

                <!-- Sección Tatuaje -->
                <div id="seccion_tatuaje" class="additional-section" style="display:none;">
                    <h2>Describe tu tatuaje</h2>
                    <label for="tamano_tatuaje">Tamaño del tatuaje:</label>
                    <select id="tamano_tatuaje" name="tamano_tatuaje">
                        <option value="5-10">5-10 cms</option>
                        <option value="otro">Otro (especificar)</option>
                    </select>
                    <input type="text" id="otro_tamano" name="otro_tamano" placeholder="Ingresa la medida en cms" />

                    <label for="parte_cuerpo">Parte del cuerpo:</label>
                    <select id="parte_cuerpo" name="parte_cuerpo">
                        <option value="brazo">Brazo</option>
                        <option value="otra">Otro (especificar)</option>
                    </select>
                    <input type="text" id="otra_parte" name="otra_parte" placeholder="Especificar parte del cuerpo" />

                    <label for="descripcion_tatuaje">Descripción del tatuaje:</label>
                    <textarea id="descripcion_tatuaje" name="descripcion_tatuaje"></textarea>
                </div>

                <!-- Sección Perforación -->
                <div id="seccion_perforacion" class="additional-section" style="display:none;">
                    <h2>Describe tu perforación</h2>
                    <label for="parte_perforacion">Parte del cuerpo:</label>
                    <select id="parte_perforacion" name="parte_perforacion">
                        <option value="oreja">Oreja</option>
                        <option value="otra">Otro (especificar)</option>
                    </select>
                    <input type="text" id="otra_parte_perforacion" name="otra_parte_perforacion" placeholder="Especificar parte del cuerpo" />

                    <label for="material">Material:</label>
                    <select id="material" name="material">
                        <option value="acero_quirurgico">Acero quirúrgico</option>
                    </select>

                    <label for="descripcion_perforacion">Descripción (opcional):</label>
                    <textarea id="descripcion_perforacion" name="descripcion_perforacion"></textarea>
                </div>

                <!-- Sección Otro -->
                <div id="seccion_otro" class="additional-section" style="display:none;">
                    <label for="otro_tipo_cita">Especificar tipo de cita:</label>
                    <input type="text" id="otro_tipo_cita" name="otro_tipo_cita" />

                    <label for="descripcion_otra">Descripción de la cita:</label>
                    <textarea id="descripcion_otra" name="descripcion_otra"></textarea>
                </div>

                <!-- Sección Cotizar -->
                <div id="seccion_cotizacion" class="additional-section" style="display:none;">
                    <h2>Detalles para cotizar</h2>
                    <label for="tipo_servicio">Tipo de servicio:</label>
                    <select id="tipo_servicio" name="tipo_servicio" onchange="toggleOtherService(this.value)">
                        <option value="Tatuaje">Tatuaje</option>
                        <option value="Otro">Otro (especificar)</option>
                    </select>

                    <div id="contenedor_otro_servicio" style="display:none;">
                        <label for="otro_servicio">Especificar servicio:</label>
                        <input type="text" id="otro_servicio" name="otro_servicio" />
                    </div>

                    <label for="descripcion_cotizacion">Descripción detallada:</label>
                    <textarea id="descripcion_cotizacion" name="descripcion_cotizacion"></textarea>

                    <label for="fecha">Fecha preferente:</label>
                    <input type="date" id="fecha" name="fecha" />

                    <label for="hora">Hora aproximada:</label>
                    <input type="time" id="hora" name="hora" />
                </div>
                <label for="date">Elegir fecha y hora:</label>
                <input type="date" id="date" name="date" />
                <input type="time" id="time" name="time" />

                <div class="center-container">
                    <label class="custum-file-upload" for="file">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24">
                                <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                <g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill=""
                                        d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                </g>
                            </svg>
                        </div>
                        <div class="text">
                            <span>Click to upload image</span>
                        </div>
                        <input type="file" id="file" />
                    </label>
                </div>

                <button class="btn-form" type="submit">Agendar</button>
            </form>
        </div>
    </main>

    <!-- Pie de Página -->
    <?php include './footer.php'; ?>

    <!-- Scripts de jQuery, Popper y Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/citas.js"></script>
</body>

</html>
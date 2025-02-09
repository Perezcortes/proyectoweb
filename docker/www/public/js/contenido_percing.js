document.addEventListener("DOMContentLoaded", function () {
    cargarDatos(); // Cargar todos los datos al inicio

    document.getElementById("search").addEventListener("input", function (event) {
        let searchTerm = event.target.value.trim();
        cargarDatos(searchTerm);
    });
});

function cargarDatos(search = "") {
    let url = "../models/contenido_percing.php";
    if (search) {
        url += `?search=${encodeURIComponent(search)}`;
    }

    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error("Error en la respuesta del servidor");
            }
            return response.json();
        })
        .then(data => {
            console.log("Datos recibidos:", data);
            mostrarDatos(data);
        })
        .catch(error => {
            console.error("Error al cargar los datos:", error);
        });
}

function mostrarDatos(datos) {
    let contenido = document.getElementById("card-container");

    if (!contenido) {
        console.error("Error: No se encontró el contenedor con id 'card-container'");
        return;
    }

    contenido.innerHTML = "";

    if (datos.message) {
        contenido.innerHTML = `<p class="text-center text-danger">${datos.message}</p>`;
        return;
    }

    datos.forEach(item => {
        let card = `
            <div class="custom-card m-3" style="width: 18rem;">
            <h5 class="titulo">${item.nombre}</h5>
                <img src="../img/${item.imagen}" class="card-img-top" alt="${item.nombre}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <p class="card-text">${item.descripcion}</p>
                    <button class="btn btn-outline-primary ver-mas" data-nombre="${item.nombre}" 
                        data-imagen="${item.imagen}" 
                        data-descripcion="${item.descripcion}" 
                        data-joyeria="${item.joyeria}" 
                        data-cicatrizacion="${item.cicatrizacion}" 
                        data-dolor="${item.dolor}">
                       Ver más 
                    </button>
                </div>
            </div>
        `;
        contenido.innerHTML += card;
    });

    document.querySelectorAll(".ver-mas").forEach(boton => {
        boton.addEventListener("click", function () {
            let nombre = this.getAttribute("data-nombre");
            let imagen = this.getAttribute("data-imagen");
            let descripcion = this.getAttribute("data-descripcion");
            let joyeria = this.getAttribute("data-joyeria");
            let cicatrizacion = this.getAttribute("data-cicatrizacion");
            let dolor = this.getAttribute("data-dolor");

            mostrarDetalle(nombre, imagen, descripcion, joyeria, cicatrizacion, dolor);
        });
    });
}
function mostrarDetalle(nombre, imagen, descripcion, joyeria, cicatrizacion, dolor) {
    let contenido = document.getElementById("contenido");

    contenido.innerHTML = `
        <div class="detalle-container bg-dark text-white p-4">
            <h1 class="titulo_principal">${nombre}</h1>
            <p class="text-light">Actualmente, es de los piercings más populares entre las personas que deciden hacerse uno por primera vez y quizá sea el comienzo de una forma de adueñarte de tu propio cuerpo.</p>
            
            <div class="row">
                <div class="col-md-6">
                    <img src="../img/${imagen}" class="img-fluid" alt="${nombre}" style="max-height: 400px; object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <h4 class="titulo">Descripción</h4>
                    <p>${descripcion}</p>
                    
                    <h4 class="titulo">Tipo de joyería recomendada</h4>
                    <p>${joyeria}</p>
                    
                    <h4 class="titulo">Tiempo de cicatrización</h4>
                    <p>${cicatrizacion}</p>
                    
                    <h4 class="titulo">Índice de dolor</h4>
                    <p>${dolor}/10</p>
                </div>
            </div>

            <div class="boton">
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" data-bs-whatever="@mdo">Agendar cita</button>
                    <button class="btn  btn-outline-info" id="btn-volver">Volver</button>
                <a class="btn btn-outline-success" href="https://web.whatsapp.com/" role="button">WhatsApp</a>
                
            
                </div>

            
        </div>
    `;

    document.getElementById("btn-volver").addEventListener("click", function () {
        location.reload(); // Recargar la página para volver a la vista de las tarjetas
    });
}
document.addEventListener("DOMContentLoaded", function () {
    cargarTatuadores();

    document.getElementById("searchButton").addEventListener("click", function () {
        let searchTerm = document.getElementById("searchBar").value.trim();
        if (searchTerm === "") {
            cargarTatuadores(); // Si el campo está vacío, recargar todos los tatuadores
        } else {
            buscarTatuador(searchTerm);
        }
    });

    function cargarTatuadores() {
        fetch("../controllers/ControllerTatuador.php")
            .then(response => response.json())
            .then(data => renderizarTatuadores(data))
            .catch(error => console.error("Error al cargar los tatuadores:", error));
    }

    function buscarTatuador(searchTerm) {
        fetch(`../controllers/ControllerTatuador.php?search=${encodeURIComponent(searchTerm)}`)
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById("results");

                if (data.length === 0) {
                    Swal.fire({
                        icon: "error",
                        title: "No encontrado",
                        text: `No se encontró ningún tatuador con el nombre "${searchTerm}".`,
                    });
                } else {
                    container.innerHTML = ""; // 🔥 Limpiar pantalla y mostrar solo el resultado
                    renderizarTatuadores(data);
                }
            })
            .catch(error => console.error("Error al buscar el tatuador:", error));
    }

    function renderizarTatuadores(data) {
        const container = document.getElementById("results");
        container.innerHTML = ""; // 🔥 Limpiar contenido previo

        data.forEach(tatuador => {
            const imagenes = tatuador.portafolio.split("/");

            const tatuadorHTML = `
                <div class="container mt-5">
                    <div class="custom-card">
                        <div class="card-header d-flex align-items-center">
                            <img src="../img/${tatuador.foto_perfil}" alt="Avatar" class="avatar">
                            <div class="user-info">
                                <h5 class="nombre">${tatuador.nombre}</h5>
                                <p>${tatuador.correo}</p>
                            </div>
                            <div class="social-icons ml-auto">
                                ${tatuador.facebook ? `<a href="${tatuador.facebook}" target="_blank"><i class="fab fa-facebook-f"></i></a>` : ""}
                                ${tatuador.instagram ? `<a href="${tatuador.instagram}" target="_blank"><i class="fab fa-instagram"></i></a>` : ""}
                                <a href="#"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>

                        <!-- Contenido con imagen grande y texto -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Carrusel de imágenes -->
                                    <div class="swiper-container main-carousel">
                                        <div class="swiper-wrapper">
                                            ${imagenes.map(img => `<div class="swiper-slide"><img src="../img/${img}" class="img-fluid ampliable" alt="Imagen de ${tatuador.nombre}"></div>`).join('')}
                                        </div>
                                        <div class="swiper-pagination"></div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex flex-column justify-content-center">
                                    <h4 class="estilo">${tatuador.especialidad}</h4>
                                    <p class="descripcion">${tatuador.presentacion}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;

            container.innerHTML += tatuadorHTML;
        });

        // 🔥 Inicializar Swiper para la nueva lista de tatuadores
        new Swiper(".swiper-container", {
            slidesPerView: "auto",
            spaceBetween: 10,
            centeredSlides: false,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        // 🔥 Agregar evento para ampliar imágenes
        document.querySelectorAll(".swiper-slide img.ampliable").forEach((img) => {
            img.addEventListener("click", function () {
                var imageView = document.createElement("div");
                imageView.style.position = "fixed";
                imageView.style.top = "0";
                imageView.style.left = "0";
                imageView.style.width = "100%";
                imageView.style.height = "100%";
                imageView.style.backgroundColor = "rgba(0, 0, 0, 0.9)";
                imageView.style.display = "flex";
                imageView.style.alignItems = "center";
                imageView.style.justifyContent = "center";
                imageView.style.zIndex = "1000";

                // Imagen ampliada aún más grande
                var enlargedImg = document.createElement("img");
                enlargedImg.src = img.src;
                enlargedImg.style.maxWidth = "95%";
                enlargedImg.style.maxHeight = "95%";
                enlargedImg.style.borderRadius = "10px";
                enlargedImg.style.boxShadow = "0 0 20px rgba(255, 255, 255, 0.5)";
                enlargedImg.style.transition = "transform 0.3s ease";

                imageView.appendChild(enlargedImg);
                document.body.appendChild(imageView);

                // Cerrar la imagen al hacer clic
                imageView.addEventListener("click", function () {
                    document.body.removeChild(imageView);
                });
            });
        });
    }
});

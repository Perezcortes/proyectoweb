function showSection(sectionId) {
  // Ocultar la página principal
  document.getElementById("main-page").style.display = "none";
  // Mostrar la sección seleccionada
  document.getElementById(sectionId).style.display = "block";
}

function showMainPage() {
  // Ocultar todas las secciones de productos
  document.querySelectorAll(".product-section").forEach(function (section) {
    section.style.display = "none";
  });
  // Mostrar la página principal
  document.getElementById("main-page").style.display = "block";
}

function showSection(sectionId, category) {
  // Ocultar la página principal
  document.getElementById("main-page").style.display = "none";
  // Mostrar la sección seleccionada
  document.getElementById(sectionId).style.display = "block";

  // Cargar productos de la categoría seleccionada
  fetch(
    `../controllers/AccionProductos.php?category=${encodeURIComponent(
      category
    )}`
  )
    .then((response) => {
      if (!response.ok) {
        throw new Error("Error en la respuesta de la red");
      }
      return response.json();
    })
    .then((data) => {
      console.log("Productos recibidos:", data); // Mensaje de depuración
      const productContainer = document.querySelector(
        `#${sectionId} .productos`
      );
      productContainer.innerHTML = ""; // Limpiar productos existentes
      data.forEach((product) => {
        const productDiv = document.createElement("div");
        productDiv.classList.add("card");
        productDiv.innerHTML = `
                    <div class="card-img" style="background-image: url('../${product.imagen}');"></div>
                    <div class="card-info">
                        <p class="text-title">${product.nombre}</p>
                        <p class="text-body">${product.descripcion}</p>
                    </div>
                    <div class="card-footer">
                        <span class="text-title">$${product.precio}</span>
                        <div class="card-button">
                            <svg class="svg-icon" viewBox="0 0 20 20">
                                <path d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z"></path>
                                <path d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z"></path>
                                <path d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z"></path>
                            </svg>
                        </div>
                    </div>
                `;
        productContainer.appendChild(productDiv);
      });
    })
    .catch((error) => console.error("Error al cargar los productos:", error));
}

function showMainPage() {
  // Ocultar todas las secciones de productos
  document.querySelectorAll(".product-section").forEach(function (section) {
    section.style.display = "none";
  });
  // Mostrar la página principal
  document.getElementById("main-page").style.display = "block";
}

// Buscar productos
document
  .querySelector("form.form-inline")
  .addEventListener("submit", function (e) {
    e.preventDefault();
    const searchInput = document.querySelector(".form-control");
    const searchQuery = searchInput.value.trim();

    // Validar que el campo de búsqueda no esté vacío
    if (searchQuery === "") {
      Swal.fire({
        title: "Por favor ingresa tu búsqueda",
        icon: "warning",
        confirmButtonText: "OK"
      });
      return; // Salir de la función si no se ingresa nada
    }

    if (searchQuery !== "") {
      fetch(
        `../controllers/AccionProductos.php?search=${encodeURIComponent(
          searchQuery
        )}`
      )
        .then((response) => response.json())
        .then((data) => {
          if (data.products && data.products.length > 0) {
            showSearchResults(data.products);
            searchInput.value = ""; // Limpia el campo de búsqueda
          } else {
            // Mostrar una alerta de SweetAlert2 cuando no haya productos encontrados
            Swal.fire({
              title: "¡No se encontraron productos!",
              text: "Lo sentimos, pero no hemos podido encontrar ningún producto relacionado con tu búsqueda.",
              icon: "warning",
              confirmButtonText: "Volver a intentarlo",
            });
          }
        });
    }
  });

function showSearchResults(products) {
  let modalBody = document.querySelector("#searchModal .modal-body");
  modalBody.innerHTML = "";

  products.forEach((product) => {
    let productDiv = document.createElement("div");
    productDiv.classList.add("search-result");
    productDiv.innerHTML = `
            <div class="card">
                <img src="../${product.imagen}" alt="${product.nombre}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">${product.nombre}</h5>
                    <p class="card-text">${product.descripcion}</p>
                    <p class="card-text"><strong>Precio:</strong> $${product.precio}</p>
                    <button class="btn btn-primary ver-mas-btn" 
                        data-id="${product.id_producto}" 
                        data-category="${product.categoria}">
                        Ver más
                    </button>
                </div>
            </div>
        `;
    modalBody.appendChild(productDiv);
  });

  // Agregar eventos a los botones después de crearlos
  document.querySelectorAll(".ver-mas-btn").forEach((button) => {
    button.addEventListener("click", function () {
      let id = this.getAttribute("data-id");
      let category = this.getAttribute("data-category");
      console.log("Botón clickeado con ID:", id, "Categoría:", category);
      openProduct(id, category);
    });
  });

  $("#searchModal").modal("show");
}

function openProduct(id, category) {
    if (!id || id === "undefined") {
        console.error("Error: El ID del producto no es válido.");
        return;
    }

    // Cerrar el modal
    $('#searchModal').modal('hide');

    // Mapea las categorías a los IDs de las secciones
    const categoryMap = {
        "Material para tatuar": "tatuar",
        "Material para perforar": "perforar",
        "Piezas para perforacion": "piezas",
        "Productos para sustancias": "sustancias"
    };

    // Obtiene el ID de la sección correspondiente
    const sectionId = categoryMap[category];

    // Verifica si la categoría existe en el mapa
    if (sectionId) {
        // Llama a la función showSection para mostrar la sección correcta
        showSection(sectionId, category);
    } else {
        console.error("Error: No se encontró una sección para la categoría:", category);
    }

    console.log("ID del producto:", id);
    console.log("Categoría:", category);
}

document.addEventListener("DOMContentLoaded", function () {
  // Navegación y Secciones (LocalStorage)
  const inicioLink = document.getElementById("inicio-link");
  const usuariosLink = document.getElementById("usuarios-link");
  const productoLink = document.getElementById("producto-link"); // Enlace de productos
  const inventarioLink = document.getElementById("inventario-link"); // Enlace de inventario

  const inicioContent = document.getElementById("inicio-content");
  const usuariosContent = document.getElementById("usuarios-content");
  const productoContent = document.getElementById("producto-content"); // Contenido de productos
  const inventarioContent = document.getElementById("inventario-content"); // Contenido de inventario

  const activeSection = localStorage.getItem("activeSection");
  if (activeSection) {
    showSection(activeSection);
  } else {
    showSection("inicio"); // Mostrar sección de inicio por defecto
  }

  inicioLink.addEventListener("click", function (event) {
    event.preventDefault();
    showSection("inicio");
  });

  usuariosLink.addEventListener("click", async function (event) {
    event.preventDefault();
    showSection("usuarios");

    try {
      const response = await fetch(
        "../controllers/add_user.php?timestamp=" + new Date().getTime()
      );
      const text = await response.text();
      console.log("Respuesta del servidor (usuarios): ", text);
      const usuarios = JSON.parse(text);

      const tbody = usuariosContent.querySelector("tbody");
      tbody.innerHTML = ""; // Limpiar contenido anterior

      if (usuarios.length > 0) {
        usuarios.forEach((usuario) => {
          const row = document.createElement("tr");
          row.innerHTML = `
                    <td>${usuario.nombre}</td>
                    <td>${usuario.correo}</td>
                    <td>${usuario.rol}</td>
                    <td>${usuario.fecha_creacion}</td>
                    <td>
                        <button class='btn btn-warning btn-sm edit-btn' data-id='${usuario.id_usuario}' data-nombre='${usuario.nombre}' data-correo='${usuario.correo}' data-rol='${usuario.rol}'>Editar</button>
                        <button class='btn btn-danger btn-sm delete-btn' data-id='${usuario.id_usuario}'>Eliminar</button>
                    </td>
                `;
          tbody.appendChild(row);
        });

        // Asignar eventos a los botones después de cargarlos
        document.querySelectorAll(".edit-btn").forEach((btn) => {
          btn.addEventListener("click", openEditModal);
        });

        document.querySelectorAll(".delete-btn").forEach((btn) => {
          btn.addEventListener("click", deleteUser);
        });
      } else {
        tbody.innerHTML =
          "<tr><td colspan='5' class='text-center'>No hay datos disponibles</td></tr>";
      }
    } catch (error) {
      console.error("Error al cargar los usuarios:", error);
      const tbody = usuariosContent.querySelector("tbody");
      tbody.innerHTML =
        "<tr><td colspan='5' class='text-center'>Error al cargar los datos</td></tr>";
    }
  });

  productoLink.addEventListener("click", async function (event) {
    event.preventDefault();
    showSection("productos");

    productoLink.addEventListener("click", async function (event) {
      event.preventDefault();
      showSection("productos");

      try {
        const response = await fetch("../controllers/ProductoController.php");
        const products = await response.json();
        const tbody = productoContent.querySelector("tbody");
        tbody.innerHTML = "";
        if (products.length > 0) {
          products.forEach((product) => {
            const row = `<tr>
                                <td>${product.nombre}</td>
                                <td>${product.cantidad}</td>
                                <td>${product.precio}</td>
                                <td>${product.categoria}</td>
                                <td>${product.descripcion}</td>
                                <td>
                                  <button class='btn btn-warning btn-sm' data-product-id="${product.id_producto}">Editar</button>
                                  <button class="delete-btn btn btn-danger" data-id="${product.id_producto}">Eliminar</button>
                                </td>
                             </tr>`;
            tbody.innerHTML += row;
          });

          // Agregar event listener para los botones de edición
          const editButtons = tbody.querySelectorAll(".btn-warning");
          editButtons.forEach((button) => {
            button.addEventListener("click", function () {
              const productId = button.getAttribute("data-product-id");
              loadProductForEditing(productId);
            });
          });

          // Agregar event listener para los botones de eliminación
          const deleteButtons = tbody.querySelectorAll(".delete-btn");
          deleteButtons.forEach((button) => {
            button.addEventListener("click", async function () {
              const productId = button.getAttribute("data-id");

              // Mostrar el SweetAlert para confirmar la eliminación
              const result = await Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esta acción!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar",
              });

              if (result.isConfirmed) {
                // Enviar solicitud de eliminación
                try {
                  const deleteResponse = await fetch(
                    `../controllers/AccionProductos.php?delete_id=${productId}`
                  );
                  const deleteResult = await deleteResponse.json();

                  if (deleteResult.success) {
                    Swal.fire({
                      title: "Producto Eliminado",
                      text: deleteResult.message,
                      icon: "success",
                    }).then(() => {
                      window.location.reload(); // Recargar la página para actualizar la lista de productos
                    });
                  } else {
                    Swal.fire({
                      title: "Error",
                      text: deleteResult.message,
                      icon: "error",
                    });
                  }
                } catch (error) {
                  console.error("Error al eliminar el producto:", error);
                  Swal.fire({
                    title: "Error",
                    text: "Hubo un error al intentar eliminar el producto.",
                    icon: "error",
                  });
                }
              }
            });
          });
        } else {
          tbody.innerHTML =
            "<tr><td colspan='6' class='text-center'>No hay productos disponibles</td></tr>";
        }
      } catch (error) {
        console.error("Error al cargar los productos:", error);
        const tbody = productoContent.querySelector("tbody");
        tbody.innerHTML =
          "<tr><td colspan='6' class='text-center'>Error al cargar los datos</td></tr>";
      }
    });
  });

  inventarioLink.addEventListener("click", function (event) {
    event.preventDefault();
    showSection("inventario");
  });

  function showSection(section) {
    inicioContent.style.display = "none";
    usuariosContent.style.display = "none";
    productoContent.style.display = "none";
    inventarioContent.style.display = "none";

    switch (section) {
      case "usuarios":
        usuariosContent.style.display = "block";
        break;
      case "productos":
        productoContent.style.display = "block";
        break;
      case "inventario":
        inventarioContent.style.display = "block";
        break;
      default:
        inicioContent.style.display = "block";
    }
    // Guardar sección activa en localStorage
    localStorage.setItem("activeSection", section);
  }

  // ==========================
  // Cerrar Sesión
  // ==========================
  document
    .getElementById("logoutButton")
    .addEventListener("click", function () {
      Swal.fire({
        title: "Cerrar Sesión",
        text: "¿Estás seguro de que deseas cerrar sesión?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, cerrar sesión",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "../index.php";
        }
      });
    });

  // Manejo del Formulario para Agregar Usuarios
  const addUserForm = document.getElementById("addUserForm");
  addUserForm.addEventListener("submit", async function (event) {
    event.preventDefault();

    const formData = new FormData(addUserForm);
    const email = formData.get("email");

    if (!email.endsWith("@dejaVu.com")) {
      showUserErrorAlert("Correo con formato incorrecto. Intenta de nuevo.");
      return;
    }

    try {
      const response = await fetch("../controllers/add_user.php", {
        method: "POST",
        body: formData,
      });

      const text = await response.text();
      console.log("Respuesta del servidor (usuarios): ", text);
      const result = JSON.parse(text);
      handleAddUserResponse(result.result);
    } catch (error) {
      console.error("Error al agregar el usuario:", error);
      showUserErrorAlert(
        "Hubo un problema al procesar la solicitud. Inténtalo de nuevo más tarde."
      );
    }
  });

  function handleAddUserResponse(result) {
    switch (result) {
      case "success":
        Swal.fire({
          title: "Usuario Agregado",
          text: "El nuevo usuario ha sido agregado exitosamente.",
          icon: "success",
          confirmButtonText: "Aceptar",
        }).then(() => {
          localStorage.setItem("activeSection", "usuarios");
          window.location.reload();
        });
        break;
      case "duplicate_email":
        showUserErrorAlert(
          "El correo electrónico ya está registrado. Intenta con otro."
        );
        break;
      case "duplicate_username":
        showUserErrorAlert(
          "El nombre de usuario ya está registrado. Intenta con otro."
        );
        break;
      case "short_password":
        showUserErrorAlert("La contraseña debe tener al menos 8 caracteres.");
        break;
      case "invalid_pin":
        showUserErrorAlert("El PIN debe tener entre 4 y 8 caracteres.");
        break;
      case "error":
        showUserErrorAlert(
          "Hubo un error al agregar el usuario. Inténtalo de nuevo más tarde."
        );
        break;
      default:
        showUserErrorAlert(
          "Ocurrió un error inesperado. Inténtalo nuevamente."
        );
    }
  }

  function showUserErrorAlert(message) {
    Swal.fire({
      title: "Error",
      text: message,
      icon: "error",
      confirmButtonText: "Aceptar",
    }).then(() => {
      addUserForm.reset();
      const modalElement = document.getElementById("addUserModal");
      const modalInstance = bootstrap.Modal.getInstance(modalElement);
      if (modalInstance) {
        modalInstance.hide();
      }
    });
  }

  document
    .getElementById("addUserModal")
    .addEventListener("hidden.bs.modal", () => {
      addUserForm.reset();
    });

  // Función para eliminar usuario
  async function deleteUser(event) {
    const userId = event.target.getAttribute("data-id");
    console.log("ID del usuario a eliminar:", userId); // línea para depurar

    const confirmDelete = await Swal.fire({
      title: "¿Estás seguro?",
      text: "No podrás recuperar este usuario.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
    });

    if (confirmDelete.isConfirmed) {
      try {
        const response = await fetch("/controllers/add_user.php", {
          method: "DELETE",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: new URLSearchParams({ id: userId }), // Enviar el ID del usuario
        });

        // Verifica que la respuesta sea correcta
        if (!response.ok) {
          throw new Error("Error al eliminar usuario: " + response.statusText);
        }

        // Espera a que la respuesta esté disponible como JSON
        const result = await response.json();

        // Muestra el mensaje correspondiente según el resultado
        if (result.result === "success") {
          Swal.fire("Éxito", "Usuario eliminado correctamente", "success");
        } else {
          Swal.fire(
            "Error",
            result.message || "No se pudo eliminar el usuario.",
            "error"
          );
        }
      } catch (error) {
        console.error("Error al eliminar usuario:", error);
        Swal.fire("Error", "Hubo un problema con la solicitud.", "error");
      }
    }
  }

  //Funcion para editar usuarios
  document.addEventListener("DOMContentLoaded", function () {
    let originalData = {}; // Variable única para almacenar datos originales

    // Eventos para botones de edición
    document.querySelectorAll(".edit-btn").forEach((button) => {
        button.addEventListener("click", function (event) {
            openEditModal(event);
        });
    });

    // Manejo del formulario
    document.getElementById("editUserForm").addEventListener("submit", function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        const jsonData = Object.fromEntries(formData.entries()); // Método más limpio

        if (!hasChanges(jsonData)) {
            Swal.fire("Sin cambios", "No se realizaron modificaciones.", "info");
            return;
        }

        Swal.fire({
            title: "¿Guardar cambios?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, guardar"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("../controllers/update_user.php", {
                    method: "PUT",
                    body: JSON.stringify(jsonData),
                    headers: { "Content-Type": "application/json" }
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.result === "success") {
                        Swal.fire("Éxito", "Usuario actualizado.", "success").then(() => location.reload());
                    } else {
                        Swal.fire("Error", data.message || "Error al actualizar", "error");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire("Error", "Error en la conexión", "error");
                });
            }
        });
    });

    // Función para abrir el modal
    function openEditModal(event) {
        const button = event.target.closest(".edit-btn");
        originalData = {
            id_usuario: button.getAttribute("data-id"),
            username: button.getAttribute("data-nombre"),
            email: button.getAttribute("data-correo"),
            role: button.getAttribute("data-rol"),
            password: button.getAttribute("data-password") || "", // Campos opcionales
            pin: button.getAttribute("data-pin") || ""
        };

        // Llenar formulario
        document.getElementById("editUserId").value = originalData.id_usuario;
        document.getElementById("editUsername").value = originalData.username;
        document.getElementById("editEmail").value = originalData.email;
        document.getElementById("editRole").value = originalData.role;

        // Mostrar modal
        new bootstrap.Modal(document.getElementById("editUserModal")).show();
    }

    // Función de comparación
    function hasChanges(newData) {
        return (
            newData.username !== originalData.username ||
            newData.email !== originalData.email ||
            newData.role !== originalData.role ||
            (newData.password && newData.password !== originalData.password) ||
            (newData.pin && newData.pin !== originalData.pin)
        );
    }
});

  // Definir la función globalmente
  function openEditModal(event) {
    const userId = event.target.getAttribute("data-id");
    const userName = event.target.getAttribute("data-nombre");
    const userEmail = event.target.getAttribute("data-correo");
    const userRole = event.target.getAttribute("data-rol");

    document.getElementById("editUserId").value = userId;
    document.getElementById("editUsername").value = userName;
    document.getElementById("editEmail").value = userEmail;
    document.getElementById("editRole").value = userRole;

    const editModal = new bootstrap.Modal(
      document.getElementById("editUserModal")
    );
    editModal.show();
  }

  // Manejo del Formulario para Agregar Productos
  document.querySelector(".noselect").addEventListener("click", function () {
    const addProductModal = new bootstrap.Modal(
      document.getElementById("addProductModal")
    );
    addProductModal.show();
  });

  const addProductForm = document.getElementById("addProductForm");
  addProductForm.addEventListener("submit", async function (event) {
    event.preventDefault();

    const formData = new FormData(addProductForm);

    try {
      const response = await fetch("../controllers/ProductoController.php", {
        method: "POST",
        body: formData,
      });

      const text = await response.text();
      console.log("Respuesta del servidor (productos): ", text);
      const result = JSON.parse(text);
      handleAddProductResponse(result.result);
    } catch (error) {
      console.error("Error al agregar el producto:", error);
      showProductErrorAlert(
        "Hubo un problema al procesar la solicitud. Inténtalo de nuevo más tarde."
      );
    }
  });

  function handleAddProductResponse(result) {
    switch (result) {
      case "success":
        Swal.fire({
          title: "Producto Agregado",
          text: "El nuevo producto ha sido agregado exitosamente.",
          icon: "success",
          confirmButtonText: "Aceptar",
        }).then(() => {
          localStorage.setItem("activeSection", "productos");
          window.location.reload();
        });
        break;
      case "error":
        showProductErrorAlert(
          "Hubo un error al agregar el producto. Inténtalo de nuevo más tarde."
        );
        break;
      default:
        showProductErrorAlert(
          "Ocurrió un error inesperado. Inténtalo nuevamente."
        );
    }
  }

  function showProductErrorAlert(message) {
    Swal.fire({
      title: "Error",
      text: message,
      icon: "error",
      confirmButtonText: "Aceptar",
    }).then(() => {
      addProductForm.reset();
      const modalElement = document.getElementById("addProductModal");
      const modalInstance = bootstrap.Modal.getInstance(modalElement);
      if (modalInstance) {
        modalInstance.hide();
      }
    });
  }

  document
    .getElementById("addProductModal")
    .addEventListener("hidden.bs.modal", () => {
      addProductForm.reset();
    });

  // ==========================
  // Botón Personalizado para Subir Imagen y Simulación de Barra de Progreso
  // ==========================

  // Al hacer clic en el botón personalizado, se dispara el input file oculto
  document
    .getElementById("customFileBtn")
    .addEventListener("click", function () {
      document.getElementById("productImage").click();
    });

  // Cuando se selecciona un archivo, se muestra la barra de progreso (simulada)
  document
    .getElementById("productImage")
    .addEventListener("change", function () {
      const progressContainer = document.getElementById("progressContainer");
      const progressBar = document.getElementById("uploadProgressBar");

      // Si no se seleccionó ningún archivo (por ejemplo, se canceló), ocultar la barra de progreso y salir
      if (this.files.length === 0) {
        progressContainer.style.display = "none";
        resetProgressBar();
        return;
      }

      // Mostrar la barra de progreso
      progressContainer.style.display = "block";

      // Inicializar la barra de progreso
      let progress = 0;
      progressBar.style.width = progress + "%";
      progressBar.setAttribute("aria-valuenow", progress);
      progressBar.textContent = progress + "%";

      // Simulación de progreso rápido (ya que solo es una imagen)
      const interval = setInterval(() => {
        progress += 20; // Incremento del 20% cada 100ms
        if (progress >= 100) {
          progress = 100;
          clearInterval(interval);
        }
        progressBar.style.width = progress + "%";
        progressBar.setAttribute("aria-valuenow", progress);
        progressBar.textContent = progress + "%";
      }, 100);
    });

  // Función para reiniciar la barra de progreso
  function resetProgressBar() {
    const progressBar = document.getElementById("uploadProgressBar");
    progressBar.style.width = "0%";
    progressBar.setAttribute("aria-valuenow", 0);
    progressBar.textContent = "0%";
  }

  // ==========================
  // Al cerrar el modal, reiniciamos y ocultamos la barra de progreso
  // ==========================
  document
    .getElementById("addProductModal")
    .addEventListener("hidden.bs.modal", function () {
      const progressContainer = document.getElementById("progressContainer");
      progressContainer.style.display = "none";
      resetProgressBar();
    });
});

// Función para cargar el producto a editar
async function loadProductForEditing(productId) {
  try {
    const response = await fetch(
      `../controllers/AccionProductos.php?id_producto=${productId}`
    );
    const product = await response.json();

    if (product && !product.error) {
      // Cargar los datos del producto en el formulario
      document.getElementById("editProductId").value = product.id_producto;
      document.getElementById("editProductName").value = product.nombre;
      document.getElementById("editProductQuantity").value = product.cantidad;
      document.getElementById("editProductPrice").value = product.precio;
      document.getElementById("editProductCategory").value = product.categoria;
      document.getElementById("editProductDescription").value =
        product.descripcion;

      // Abrir el modal para editar
      const editProductModal = new bootstrap.Modal(
        document.getElementById("editProductModal")
      );
      editProductModal.show();
    } else {
      Swal.fire({
        title: "Error",
        text: product.error ? product.error : "Producto no encontrado",
        icon: "error",
        confirmButtonText: "Aceptar",
      });
    }
  } catch (error) {
    console.error("Error al cargar el producto para editar:", error);
    Swal.fire({
      title: "Error",
      text: "Hubo un problema al cargar los datos del producto. Inténtalo de nuevo más tarde.",
      icon: "error",
      confirmButtonText: "Aceptar",
    });
  }
}

// Manejo del formulario de edición
const editProductForm = document.getElementById("editProductForm");
editProductForm.addEventListener("submit", async function (event) {
  event.preventDefault();

  // Crear un FormData para enviar los datos del formulario
  const formData = new FormData(editProductForm);

  try {
    // Confirmación antes de realizar la actualización
    const result = await Swal.fire({
      title: "¿Estás seguro?",
      text: "¿Deseas actualizar este producto?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, actualizar",
      cancelButtonText: "Cancelar",
    });

    if (result.isConfirmed) {
      // Enviar la solicitud de actualización
      const response = await fetch("../controllers/AccionProductos.php", {
        method: "POST",
        body: formData,
      });

      const resultData = await response.json();

      if (resultData.success) {
        Swal.fire({
          title: "Producto Actualizado",
          text: "El producto ha sido actualizado exitosamente.",
          icon: "success",
          confirmButtonText: "Aceptar",
        }).then(() => {
          window.location.reload();
        });
      } else {
        Swal.fire({
          title: "Error",
          text:
            resultData.message ||
            "Hubo un problema al actualizar el producto. Inténtalo de nuevo más tarde.",
          icon: "error",
          confirmButtonText: "Aceptar",
        });
      }
    }
  } catch (error) {
    console.error("Error al actualizar el producto:", error);
    Swal.fire({
      title: "Error",
      text: "Hubo un problema al procesar la solicitud. Inténtalo de nuevo más tarde.",
      icon: "error",
      confirmButtonText: "Aceptar",
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const foldersContainer = document.querySelector(".folders-container");
  const folders = document.querySelectorAll(".folder-container");
  const productTableContainer = document.getElementById(
    "product-table-container"
  );
  const backButton = document.getElementById("back-button");
  const downloadButton = document.getElementById("download-button");
  const productTableBody = document.querySelector("#product-table tbody");

  folders.forEach((folder) => {
    folder.addEventListener("click", async function () {
      const category = this.getAttribute("data-category");

      // Ocultar los folders
      foldersContainer.style.display = "none";

      // Mostrar el contenedor de la tabla de productos
      productTableContainer.style.display = "block";

      // Limpiar la tabla antes de llenarla con nuevos datos
      productTableBody.innerHTML = '<tr><td colspan="3">Cargando...</td></tr>';

      try {
        const response = await fetch(
          `../controllers/AccionProductos.php?category=${encodeURIComponent(
            category
          )}`
        );
        const products = await response.json();

        // Limpiar la tabla antes de llenarla
        productTableBody.innerHTML = "";

        if (products.length > 0) {
          products.forEach((product) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                          <td>${product.nombre}</td>
                          <td>${product.cantidad} Piezas</td>
                          <td>$${product.precio} Unitario</td>
                      `;
            productTableBody.appendChild(row);
          });
        } else {
          productTableBody.innerHTML =
            '<tr><td colspan="3">No hay productos disponibles</td></tr>';
        }
      } catch (error) {
        console.error("Error al cargar los productos:", error);
        productTableBody.innerHTML =
          '<tr><td colspan="3">Error al cargar los productos</td></tr>';
      }
    });
  });

  // Funcionalidad del botón de volver
  backButton.addEventListener("click", function () {
    // Ocultar el contenedor de la tabla de productos
    productTableContainer.style.display = "none";
    // Mostrar los folders
    foldersContainer.style.display = "flex";
  });

  // Funcionalidad del botón de descarga
  downloadButton.addEventListener("click", function () {
    const wb = XLSX.utils.book_new(); // Crear un nuevo libro de Excel
    const ws_data = [
      ["Deja Vu Body Art"], // Título
      ["Nombre", "Cantidad", "Precio"], // Cabecera de la tabla
    ];

    // Recorrer las filas de la tabla y agregar los datos al array ws_data
    productTableBody.querySelectorAll("tr").forEach((row) => {
      const rowData = [];
      row.querySelectorAll("td").forEach((cell) => {
        rowData.push(cell.textContent);
      });
      ws_data.push(rowData);
    });

    const ws = XLSX.utils.aoa_to_sheet(ws_data); // Convertir el array a una hoja de Excel

    // Agregar estilos a las celdas
    const headerStyle = {
      font: { bold: true, color: { rgb: "FFFFFF" } },
      fill: { fgColor: { rgb: "4CAF50" } },
    };

    // Aplicar el estilo a la cabecera
    ["A2", "B2", "C2"].forEach((cell) => {
      ws[cell].s = headerStyle;
    });

    // Aplicar el estilo al título
    ws["A1"].s = {
      font: { bold: true, color: { rgb: "000000" }, sz: 14 },
      alignment: { horizontal: "center" },
    };

    // Merge cells para el título
    ws["!merges"] = [{ s: { r: 0, c: 0 }, e: { r: 0, c: 2 } }];

    XLSX.utils.book_append_sheet(wb, ws, "Productos"); // Agregar la hoja al libro

    // Descargar el archivo Excel
    XLSX.writeFile(wb, "inventario_productos.xlsx");
  });
});

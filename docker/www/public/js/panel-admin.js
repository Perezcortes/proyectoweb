﻿document.addEventListener("DOMContentLoaded", function () {
  const usuariosLink = document.getElementById("usuarios-link");
  const productoLink = document.getElementById("producto-link"); // Selecciona el enlace del producto
  const inicioContent = document.getElementById("inicio-content");
  const usuariosContent = document.getElementById("usuarios-content");
  const productoContent = document.getElementById("producto-content"); // Selecciona el contenido del producto

  usuariosLink.addEventListener("click", async function (event) {
    event.preventDefault();

    inicioContent.style.display = "none";
    usuariosContent.style.display = "block";

    try {
      const response = await fetch(
        "../controllers/add_user.php?timestamp=" + new Date().getTime()
      );
      const text = await response.text(); // Obtener el texto de la respuesta para depuración
      console.log("Respuesta del servidor: ", text); // Mostrar la respuesta en la consola
      const usuarios = JSON.parse(text); // Parsear el texto como JSON

      const tbody = usuariosContent.querySelector("tbody");
      tbody.innerHTML = ""; // Limpiar el contenido anterior

      if (usuarios.length > 0) {
        usuarios.forEach((usuario) => {
          const row = `<tr>
                                    <td>${usuario.nombre}</td>
                                    <td>${usuario.correo}</td>
                                    <td>${usuario.rol}</td>
                                    <td>${usuario.fecha_creacion}</td>
                                    <td><button class='btn btn-danger btn-sm'>Eliminar</button></td>
                                 </tr>`;
          tbody.innerHTML += row;
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
    inicioContent.style.display = "none";
    usuariosContent.style.display = "none"; // Oculta el contenido de los usuarios cuando se selecciona "producto"
    productoContent.style.display = "block";
  });

  // Manejar clic en el botón Cerrar Sesión
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

  // Manejar envío del formulario para agregar usuarios
  const addUserForm = document.getElementById("addUserForm");
  addUserForm.addEventListener("submit", async function (event) {
    event.preventDefault();

    const formData = new FormData(addUserForm);
    const email = formData.get("email");

    if (!email.endsWith("@dejaVu.com")) {
      showErrorAlert("Correo con formato incorrecto. Intenta de nuevo.");
      return;
    }

    try {
      const response = await fetch("../controllers/add_user.php", {
        method: "POST",
        body: formData,
      });

      const text = await response.text(); // Obtener el texto de la respuesta para depuración
      console.log("Respuesta del servidor: ", text); // Mostrar la respuesta en la consola
      const result = JSON.parse(text); // Parsear el texto como JSON
      handleAddUserResponse(result.result);
    } catch (error) {
      console.error("Error al agregar el usuario:", error);
      showErrorAlert(
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
          window.location.reload();
        });
        break;
      case "duplicate_email":
        showErrorAlert(
          "El correo electrónico ya está registrado. Intenta con otro."
        );
        break;
      case "duplicate_username":
        showErrorAlert(
          "El nombre de usuario ya está registrado. Intenta con otro."
        );
        break;
      case "short_password":
        showErrorAlert("La contraseña debe tener al menos 8 caracteres.");
        break;
      case "invalid_pin":
        showErrorAlert("El PIN debe tener entre 4 y 8 caracteres.");
        break;
      case "error":
        showErrorAlert(
          "Hubo un error al agregar el usuario. Inténtalo de nuevo más tarde."
        );
        break;
      default:
        showErrorAlert("Ocurrió un error inesperado. Inténtalo nuevamente.");
    }
  }

  function showErrorAlert(message) {
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

  // Evento para cerrar el modal y reiniciar el formulario
  document
    .getElementById("addUserModal")
    .addEventListener("hidden.bs.modal", () => {
      addUserForm.reset();
    });
});

// Manejar clic en el botón "Agregar Producto"
document.querySelector(".noselect").addEventListener("click", function () {
  const addProductModal = new bootstrap.Modal(
    document.getElementById("addProductModal")
  );
  addProductModal.show();
});

// Manejar envío del formulario para agregar producto
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
    console.log("Respuesta del servidor: ", text);
    const result = JSON.parse(text);
    handleAddProductResponse(result.result);
  } catch (error) {
    console.error("Error al agregar el producto:", error);
    showErrorAlert(
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
        window.location.reload();
      });
      break;
    case "error":
      showErrorAlert(
        "Hubo un error al agregar el producto. Inténtalo de nuevo más tarde."
      );
      break;
    default:
      showErrorAlert("Ocurrió un error inesperado. Inténtalo nuevamente.");
  }
}

function showErrorAlert(message) {
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

// Evento para cerrar el modal y reiniciar el formulario
document
  .getElementById("addProductModal")
  .addEventListener("hidden.bs.modal", () => {
    addProductForm.reset();
  });

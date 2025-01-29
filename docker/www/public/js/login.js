document.addEventListener("DOMContentLoaded", () => {
  // Animaciones
  document
    .getElementById("register")
    .addEventListener("click", () =>
      document.getElementById("container").classList.add("right-panel-active")
    );
  document
    .getElementById("login")
    .addEventListener("click", () =>
      document
        .getElementById("container")
        .classList.remove("right-panel-active")
    );

  // Función general de validación
  function showValidation(input, message, isValid = false) {
    const formControl = input.parentElement;
    formControl.className = `form-control ${isValid ? "success" : "error"}`;
    formControl.querySelector("small").innerText = isValid ? "" : message;
  }

  // Validación de correo
  function validateEmail(input, errorElement) {
    const emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    const isValid = emailRegex.test(input.value);
    showValidation(input, isValid ? "" : "*Email no es válido", isValid);
    errorElement.textContent = isValid ? "" : "*Email no es válido";
    return isValid;
  }

  // Validación de longitud
  function validateLength(input, minLength, maxLength) {
    const isValid =
      input.value.length >= minLength && input.value.length <= maxLength;
    showValidation(
      input,
      isValid
        ? ""
        : `*${
            input.id.charAt(0).toUpperCase() + input.id.slice(1)
          } debe tener entre ${minLength} y ${maxLength} caracteres`,
      isValid
    );
    return isValid;
  }

  // Verificar si los campos están vacíos
  function checkRequired(inputArr) {
    let isValid = true;
    inputArr.forEach((input) => {
      const fieldName =
        input.placeholder ||
        input.id.charAt(0).toUpperCase() + input.id.slice(1);
      if (input.value.trim() === "") {
        showValidation(input, `*${fieldName} es requerido`);
        isValid = false;
      } else {
        showValidation(input, "", true);
      }
    });
    return isValid;
  }
});

// Registro
document
  .getElementById("reload-button")
  .addEventListener("click", async function (event) {
    event.preventDefault();
    const registerForm = document.querySelector(
      "form[action='../register.php']"
    );
    const formData = new FormData(registerForm);

    try {
      const response = await fetch(registerForm.action, {
        method: "POST",
        body: formData,
      });

      const result = await response.text();
      console.log(result); // Mostrar la respuesta

      if (result.includes("Registro exitoso")) {
        Swal.fire({
          title: "¡Registro exitoso!",
          icon: "success",
          confirmButtonText: "Aceptar",
        }).then(() => {
          window.location.href = "../views/login.php"; // Redirigir a login
        });
      } else {
        Swal.fire({
          title: "Error",
          text: result,
          icon: "error",
          confirmButtonText: "Intentar de nuevo",
        });
      }
    } catch (error) {
      console.error("Error al registrar:", error);
      Swal.fire({
        title: "Error",
        text: "Hubo un problema con el registro. Inténtalo nuevamente más tarde.",
        icon: "error",
        confirmButtonText: "Aceptar",
      });
    }
  });

  //Iniciar sesion
  document.addEventListener("DOMContentLoaded", () => {
    document
      .getElementById("loginButton")
      .addEventListener("click", async function (event) {
        event.preventDefault();
  
        const loginForm = document.getElementById("loginForm");
        const formData = new FormData(loginForm);
  
        try {
          const response = await fetch("../login.php", {
            method: "POST",
            body: formData,
          });
  
          const result = await response.text();
          console.log(result);
  
          if (result.trim() === "admin_login") {
            Swal.fire({
              title: "Bienvenido Admin",
              text: "Redirigiendo al panel de administración...",
              icon: "success",
              confirmButtonText: "Aceptar",
            }).then(() => {
              window.location.href = "../views/login-admin.php";
            });
          } else if (result.trim() === "user_login") {
            Swal.fire({
              title: "Inicio de sesión exitoso",
              icon: "success",
              confirmButtonText: "Aceptar",
            }).then(() => {
              window.location.href = "../index.php";
            });
          } else {
            Swal.fire({
              title: "Error",
              text: result,
              icon: "error",
              confirmButtonText: "Reintentar",
            });
          }
        } catch (error) {
          console.error("Error al iniciar sesión:", error);
          Swal.fire({
            title: "Error",
            text: "Hubo un problema al procesar la solicitud. Inténtalo de nuevo más tarde.",
            icon: "error",
            confirmButtonText: "Aceptar",
          });
        }
      });
  });
  
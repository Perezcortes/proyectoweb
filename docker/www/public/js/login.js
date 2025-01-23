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

        const result = await response.text(); // Cambiado a .text() para recibir texto plano
        console.log(result); // Mostrar la respuesta

        if (result.includes("Registro exitoso")) {
          alert(result); // Mostrar mensaje de éxito
          window.location.href = "../views/login.html"; // Redirigir
        } else {
          alert(result); // Mostrar mensaje de error
        }
      } catch (error) {
        console.error("Error al registrar:", error);
        alert("Hubo un problema con el registro.");
      }
    });

    document
    .getElementById("loginButton")
    .addEventListener("click", async function (event) {
      event.preventDefault(); // Evita que el formulario se envíe por defecto
  
      // Obtener el formulario
      const loginForm = document.getElementById("loginForm");
  
      // Crear un objeto FormData con los datos del formulario
      const formData = new FormData(loginForm);
  
      try {
        // Realizar la solicitud POST a login.php
        const response = await fetch("http://localhost:8086/login.php", {
          method: "POST",
          body: formData,
        });
  
        // Obtener el resultado como texto
        const result = await response.text();
        console.log(result); // Para depuración
  
        if (result.trim() === "Login exitoso.") {
          console.log("Redirigiendo a index.php...");
          alert("Inicio de sesión exitoso.");
          window.location.href = "../index.php";
        } else {
          // Mostrar el mensaje de error si las credenciales son incorrectas
          alert(result);
        }
      } catch (error) {
        console.error("Error al iniciar sesión:", error);
        alert(
          "Hubo un problema al procesar la solicitud. Inténtalo de nuevo más tarde."
        );
      }
    });
  
});

    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("loginButton").addEventListener("click", async function (event) {
            event.preventDefault();

            const loginForm = document.getElementById("loginForm");
            const formData = new FormData(loginForm);

            try {
                const response = await fetch("../controllers/AdminController.php", {
                    method: "POST",
                    body: formData,
                });

                const result = await response.text();

                if (result.trim() === "admin_login") {
                    Swal.fire({
                        title: "Bienvenido",
                        text: "Redirigiendo al panel de administración...",
                        icon: "success",
                        confirmButtonText: "Aceptar",
                    }).then(() => {
                        window.location.href = "../views/panel-admin.php";
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
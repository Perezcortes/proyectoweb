document.addEventListener('DOMContentLoaded', function () {
    const usuariosLink = document.getElementById('usuarios-link');
    const inicioContent = document.getElementById('inicio-content');
    const usuariosContent = document.getElementById('usuarios-content');

    usuariosLink.addEventListener('click', function(event) {
        event.preventDefault();  // Evita que el enlace se comporte de manera predeterminada

        inicioContent.style.display = 'none';
        usuariosContent.style.display = 'block';
    });
});

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("logoutButton").addEventListener("click", function () {
        Swal.fire({
            title: "Cerrar Sesión",
            text: "¿Estás seguro de que deseas cerrar sesión?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, cerrar sesión",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../index.php";
            }
        });
    });

    document.getElementById("usuarios-link").addEventListener("click", function () {
        document.getElementById("inicio-content").style.display = "none";
        document.getElementById("usuarios-content").style.display = "block";
    });
});

//Modal para agregar usuario con rol
document.addEventListener("DOMContentLoaded", () => {
    const addUserForm = document.getElementById("addUserForm");

    document.getElementById("addUserForm").addEventListener("submit", async function (event) {
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

            const result = await response.text();

            switch (result.trim()) {
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
                    showErrorAlert("El correo electrónico ya está registrado. Intenta con otro.");
                    break;
                case "duplicate_username":
                    showErrorAlert("El nombre de usuario ya está registrado. Intenta con otro.");
                    break;
                case "short_password":
                    showErrorAlert("La contraseña debe tener al menos 8 caracteres.");
                    break;
                case "invalid_pin":
                    showErrorAlert("El PIN debe tener entre 4 y 8 caracteres.");
                    break;
                case "error":
                    showErrorAlert("Hubo un error al agregar el usuario. Inténtalo de nuevo más tarde.");
                    break;
                default:
                    showErrorAlert("Ocurrió un error inesperado. Inténtalo nuevamente.");
            }
        } catch (error) {
            console.error("Error al agregar el usuario:", error);
            showErrorAlert("Hubo un problema al procesar la solicitud. Inténtalo de nuevo más tarde.");
        }
    });

    function showErrorAlert(message) {
        Swal.fire({
            title: "Error",
            text: message,
            icon: "error",
            confirmButtonText: "Aceptar",
            showCancelButton: true,
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.cancel) {
                addUserForm.reset();
            }
        });
    }
});

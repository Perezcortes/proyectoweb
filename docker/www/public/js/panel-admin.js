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


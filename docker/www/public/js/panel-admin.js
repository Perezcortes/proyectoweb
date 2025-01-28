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

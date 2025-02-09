document.addEventListener("DOMContentLoaded", function () {
    function cargarRoles() {
        // Realiza una solicitud AJAX al controlador para obtener los roles
        fetch('../controllers/add_user.php?roles=1', {
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            const rolesContent = document.getElementById("rolesContent");
            rolesContent.innerHTML = '';

            data.forEach(usuario => {
                let rol = '';
                switch (usuario.rol) {
                    case 'admin':
                        rol = 'Administrador';
                        break;
                    case 'tatoo':
                        rol = 'Tatuador';
                        break;
                    default:
                        rol = 'Usuario';
                }

                rolesContent.innerHTML += `
                    <tr>
                        <td>${usuario.nombre}</td>
                        <td>${rol}</td>
                    </tr>
                `;
            });
        })
        .catch(error => {
            console.error('Error al cargar roles:', error);
        });
    }

    // Agregar evento de clic a la tarjeta de comentarios
    document.getElementById("commentsCard").addEventListener("click", function () {
        // Ocultar el contenido de inicio y mostrar la sección de comentarios
        document.getElementById("inicio-content").style.display = "none";
        document.getElementById("commentsSection").style.display = "block";

        // Aquí puedes agregar la lógica para cargar los comentarios de Google Maps
        // Por ahora, mostraré un ejemplo de comentarios estáticos
        const commentsContent = document.getElementById("commentsContent");
        commentsContent.innerHTML = `
            <div class="comment">
                <p><strong>Usuario 1:</strong> Excelente servicio y ambiente.</p>
            </div>
            <div class="comment">
                <p><strong>Usuario 2:</strong> Muy profesionales y amables.</p>
            </div>
            <div class="comment">
                <p><strong>Usuario 3:</strong> Recomiendo este lugar al 100%.</p>
            </div>
        `;
    });

    // Agregar evento de clic al botón de volver de la sección de comentarios
    document.getElementById("backButtonComments").addEventListener("click", function () {
        // Mostrar el contenido de inicio y ocultar la sección de comentarios
        document.getElementById("inicio-content").style.display = "block";
        document.getElementById("commentsSection").style.display = "none";
    });

    // Agregar evento de clic a la tarjeta de roles
    document.getElementById("rolesCard").addEventListener("click", function () {
        // Ocultar el contenido de inicio y mostrar la sección de roles
        document.getElementById("inicio-content").style.display = "none";
        document.getElementById("rolesSection").style.display = "block";

        // Cargar roles desde la base de datos
        cargarRoles();
    });

    // Agregar evento de clic al botón de volver de la sección de roles
    document.getElementById("backButtonRoles").addEventListener("click", function () {
        // Mostrar el contenido de inicio y ocultar la sección de roles
        document.getElementById("inicio-content").style.display = "block";
        document.getElementById("rolesSection").style.display = "none";
    });

    // Agregar evento de clic a la tarjeta de inventario
    document.getElementById("inventoryCard").addEventListener("click", function () {
        // Ocultar el contenido de inicio y mostrar la sección de inventario
        document.getElementById("inicio-content").style.display = "none";
        document.getElementById("inventorySection").style.display = "block";

        // Cargar productos con campos específicos
        cargarProductosCampos();
    });

    // Agregar evento de clic al botón de volver de la sección de inventario
    document.getElementById("backButtonInventory").addEventListener("click", function () {
        // Mostrar el contenido de inicio y ocultar la sección de inventario
        document.getElementById("inicio-content").style.display = "block";
        document.getElementById("inventorySection").style.display = "none";
    });

    function cargarProductosCampos() {
        fetch('../controllers/AccionProductos.php?fields=1', {
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            const inventoryContent = document.getElementById("inventoryContent");
            inventoryContent.innerHTML = '';

            data.forEach(product => {
                inventoryContent.innerHTML += `
                    <tr>
                        <td>${product.nombre}</td>
                        <td>${product.cantidad}</td>
                        <td>${product.precio}</td>
                        <td>${product.categoria}</td>
                    </tr>
                `;
            });
        })
        .catch(error => {
            console.error('Error al cargar los productos:', error);
        });
    }
});

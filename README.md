# Proyecto Web con PHP, MySQL, Apache y Docker

## Descripción
Este proyecto es una aplicación web desarrollada con PHP y MySQL para el negocio denominado Deja Vu Body Art, ejecutándose sobre un servidor Apache dentro de un contenedor Docker. Su propósito es automatizar tareas diarias, permitiendo a los usuarios realizar citas y cotizaciones, conocer el trabajo de los tatuadores y su estilo. Para el administrador, permite gestionar clientes e inventarios de productos, además de realizar acciones de actualización y edición.

## Características Principales
- **📡 Arquitectura Cliente-Servidor**: Implementada con PHP en el backend y HTML, CSS y JavaScript en el frontend.
- **📌 Uso de MVC**: Patrón de diseño arquitectónico que separa la lógica de una aplicación en tres componentes principales para mejorar la organización, mantenibilidad y escalabilidad del código.
- **👥 Gestión de Usuarios y Clientes**: Permite agregar, modificar, eliminar clientes y asignar roles.
- **📅 Administración de cotizaciones y citas**: Manejo de citas y solicitudes de información para otros servicios que se ofrecen.
- **🔒 Seguridad Mejorada**: Uso de hashing de contraseñas, validaciones de entrada y protección contra inyecciones SQL.
- **🐳 Dockerización**: Implementado dentro de un entorno Docker para facilitar la configuración y despliegue.
- **🗄️ Gestión de Base de Datos**: Utiliza MySQL para almacenar información estructurada de clientes, citas, productos y usuarios.
- **🔄 Manejo de versiones**: Se utilizó Git con gestión a través de Sourcetree.

## Tecnologías Utilizadas
- **⚙️ Backend**: PHP 8+
- **🛢️ Base de Datos**: MySQL 8+
- **🌐 Servidor Web**: Apache
- **🎨 Frontend**: HTML, CSS, JavaScript
- **📦 Gestión de Dependencias**: Composer
- **🐳 Virtualización**: Docker y Docker Compose
- **🛠️ Herramientas de Administración**: phpMyAdmin
- **🔄 Control de Versiones**: Git con manejo a través de Sourcetree

## Instalación y Configuración
### Requisitos Previos
Asegúrate de tener instalados:
- Docker y Docker Compose
- Git

### Pasos de Instalación
1. Clona este repositorio:
   ```sh
   git clone https://github.com/Perezcortes/proyectoweb.git
   cd proyectoweb
   ```
2. Copia el archivo de configuración de entorno:
   ```sh
   cp .env.example .env
   ```
   Edita `.env` con las credenciales de tu base de datos si es necesario.

3. Construye y ejecuta los contenedores con Docker Compose:
   ```sh
   docker-compose up -d
   ```

4. Accede a la aplicación en tu navegador en:
   ```
   http://localhost
   ```

5. Si necesitas acceder a phpMyAdmin, usa:
   ```
   http://localhost:8080
   ```

## Uso de la Aplicación
### Creación de un Usuario
1. Ingresa a la aplicación.
2. Navega a la sección de "Iniciar Sesión" y completa los datos.
3. Inicia sesión con las credenciales creadas.

### Gestión de Pedidos
1. Accede al panel de administración.
2. Agrega nuevos paquetes o modifica los existentes.
3. Visualiza el historial de pedidos y entrega.

## Seguridad Implementada
- 🔑 Hashing de contraseñas con `password_hash()`.
- 🛡️ Validaciones de entrada para prevenir inyecciones SQL y ataques XSS.
- 👤 Autenticación y autorización de usuarios basada en roles.
- 🔒 Manejo seguro de sesiones.

## 📂 Estructura del Proyecto
```
📂 proyectoweb/
 ├── 📄 README.md
 ├── 📂 docker/
 │   ├── 📄 Dockerfile
 │   ├── 📄 docker-compose.yml
 │   └── 📂 www/
 │       ├── 📂 public/
 │       │   ├── 📄 index.php
 │       │   ├── 📄 login.php
 │       │   ├── 📄 register.php
 │       │   ├── 📂 config/
 │       │   │   └── 📄 database.php
 │       │   ├── 📂 controllers/
 │       │   │   ├── 📄 AccionProductos.php
 │       │   │   ├── 📄 AdminController.php
 │       │   │   ├── 📄 AuthController.php
 │       │   │   ├── 📄 ProductoController.php
 │       │   │   ├── 📄 TatuadorController.php
 │       │   │   └── 📄 add_user.php
 │       │   ├── 📂 css/
 │       │   │   ├── 🎨 index.css
 │       │   │   ├── 🎨 login-admin.css
 │       │   │   ├── 🎨 panel-admin.css
 │       │   │   ├── 🎨 productos.css
 │       │   │   └── 🎨 tatuadores.css
 │       │   ├── 📂 img/
 │       │   ├── 📂 js/
 │       │   │   ├── 📜 admin-login.js
 │       │   │   ├── 📜 index.js
 │       │   │   ├── 📜 login.js
 │       │   │   ├── 📜 panel-admin.js
 │       │   │   ├── 📜 productos.js
 │       │   │   └── 📜 tatuadores.js
 │       │   ├── 📂 models/
 │       │   │   ├── 📄 AccionesProductos.php
 │       │   │   ├── 📄 add_product.php
 │       │   │   ├── 📄 add_user.php
 │       │   │   ├── 📄 admin.php
 │       │   │   ├── 📄 modeloTatuador.php
 │       │   │   └── 📄 user.php
 │       │   └── 📂 views/
 │       │       ├── 📄 footer.php
 │       │       ├── 📄 login-admin.php
 │       │       ├── 📄 login.php
 │       │       ├── 📄 panel-admin.php
 │       │       ├── 📄 productos.php
 │       │       └── 📄 tatuadores.php
```

## Contribución
Si deseas contribuir, sigue estos pasos:
1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature/nueva-feature`).
3. Realiza los cambios y haz un commit (`git commit -m 'Agregada nueva funcionalidad'`).
4. Sube los cambios (`git push origin feature/nueva-feature`).
5. Abre un Pull Request en GitHub.

## Licencia
Este proyecto está bajo la licencia MIT. Puedes ver más detalles en el archivo `LICENSE`.

## Contacto
Si tienes alguna pregunta o sugerencia, no dudes en contactarme a través de 9531447499a@gmail.com o creando un issue en este repositorio.

## Creado por:
Jose Perez y Yamil Morales


# Proyecto Web con PHP, MySQL, Apache y Docker

## Descripción
Este proyecto es una aplicación web desarrollada con PHP y MySQL, ejecutándose sobre un servidor Apache dentro de un contenedor Docker. Su propósito es gestionar compras en línea, permitiendo a los usuarios realizar pedidos, administrar clientes y gestionar entregas de manera eficiente.

## Características Principales
- **Arquitectura Cliente-Servidor**: Implementada con PHP en el backend y HTML, CSS y JavaScript en el frontend.
- **Gestión de Usuarios y Clientes**: Permite agregar, modificar y eliminar clientes.
- **Administración de Pedidos y Entregas**: Manejo de órdenes de compra y seguimiento de entregas.
- **Seguridad Mejorada**: Uso de hashing de contraseñas, validaciones de entrada y protección contra inyecciones SQL.
- **Dockerización**: Implementado dentro de un entorno Docker para facilitar la configuración y despliegue.
- **Gestión de Base de Datos**: Utiliza MySQL para almacenar información estructurada de clientes, pedidos y paquetes.

## Tecnologías Utilizadas
- **Backend**: PHP 8+
- **Base de Datos**: MySQL 8+
- **Servidor Web**: Apache
- **Frontend**: HTML, CSS, JavaScript
- **Gestión de Dependencias**: Composer
- **Virtualización**: Docker y Docker Compose
- **Herramientas de Administración**: phpMyAdmin

## Instalación y Configuración
### Requisitos Previos
Asegúrate de tener instalados:
- Docker y Docker Compose
- Git

### Pasos de Instalación
1. Clona este repositorio:
   ```sh
   git clone https://github.com/tu-usuario/tu-repositorio.git
   cd tu-repositorio
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
2. Navega a la sección de "Registro" y completa los datos.
3. Inicia sesión con las credenciales creadas.

### Gestión de Pedidos
1. Accede al panel de administración.
2. Agrega nuevos paquetes o modifica los existentes.
3. Visualiza el historial de pedidos y entrega.

## Seguridad Implementada
- Hashing de contraseñas con `password_hash()`.
- Validaciones de entrada para prevenir inyecciones SQL y ataques XSS.
- Autenticación y autorización de usuarios basada en roles.
- Manejo seguro de sesiones.

## Estructura del Proyecto
```
📂 tu-repositorio
├── 📂 src
│   ├── 📂 controllers
│   ├── 📂 models
│   ├── 📂 views
│   ├── 📂 config
│   ├── index.php
├── 📂 database
│   ├── init.sql
├── 📂 docker
│   ├── Dockerfile
│   ├── docker-compose.yml
├── 📂 public
│   ├── css
│   ├── js
│   ├── img
├── .env.example
├── README.md
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
Si tienes alguna pregunta o sugerencia, no dudes en contactarme a través de [tu-email@ejemplo.com] o creando un issue en este repositorio.


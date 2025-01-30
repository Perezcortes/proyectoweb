<?php
require '../models/add_user.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim(htmlspecialchars($_POST['username']));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = trim($_POST['password']);
    $pin = trim($_POST['pin']);
    $role = trim(htmlspecialchars($_POST['role']));

    try {
        $user = new User();
        $result = $user->addUser($username, $email, $password, $pin, $role);
        echo $result;
    } catch (Exception $e) {
        echo 'error';
        error_log('Error en el servidor: ' . $e->getMessage());
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $user = new User();
        $usuarios = $user->readUsuarios();

        error_log("Usuarios recuperados: " . print_r($usuarios, true)); // Depuración

        if (count($usuarios) > 0) {
            foreach ($usuarios as $usuario) {
                echo "<tr>
                        <td>{$usuario['nombre']}</td>
                        <td>{$usuario['correo']}</td>
                        <td>{$usuario['rol']}</td>
                        <td>{$usuario['fecha_creacion']}</td>
                        <td>
                            <button class='btn btn-danger btn-sm'>Eliminar</button>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='text-center'>No hay datos disponibles</td></tr>";
        }
    } catch (Exception $e) {
        echo "<tr><td colspan='5' class='text-center'>Error al cargar los datos</td></tr>";
        error_log('Error en el servidor: ' . $e->getMessage());
    }
}

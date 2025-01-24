<?php
header('Content-Type: application/json');

// Activar registro de errores para depuración
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/php-error.log'); // Ruta del archivo de log
error_reporting(E_ALL); // Reportar todos los errores

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Obtener datos del formulario
        $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : null;
        $fecha = isset($_POST["fecha"]) ? trim($_POST["fecha"]) : null;
        $hora = isset($_POST["hora"]) ? trim($_POST["hora"]) : null;

        // Validar los datos
        if (empty($email) || empty($nombre) || empty($fecha) || empty($hora)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        // Conectar a la base de datos
        $baseDir = dirname(__DIR__) . '/';
        include_once $baseDir . 'config/database.php';

        $database = new Database();
        $db = $database->getConnection();

        if ($db === null) {
            throw new Exception("Error al conectar a la base de datos.");
        }

        // Insertar la cita en la base de datos
        $query = "INSERT INTO citas (email, nombre, fecha, hora) VALUES (:email, :nombre, :fecha, :hora)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->bindParam(":hora", $hora);

        if ($stmt->execute()) {
            // Respuesta de éxito
            echo json_encode([
                "success" => true,
                "message" => "Cita registrada con éxito."
            ]);
        } else {
            throw new Exception("No se pudo registrar la cita.");
        }
    } else {
        throw new Exception("Método de solicitud no válido.");
    }
} catch (Exception $e) {
    // Registrar el error en el log
    error_log($e->getMessage());

    // Respuesta de error en JSON
    http_response_code(500); // Código de error HTTP
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
?>

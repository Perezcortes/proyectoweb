<?php
header('Content-Type: application/json');

// Activar registro de errores para depuración
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/php-error.log'); // Ruta del archivo de log
error_reporting(E_ALL); // Reportar todos los errores
ini_set('display_errors', 0); // No mostrar errores en producción

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Obtener datos del formulario
        $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : null;
        $fecha = isset($_POST["fecha"]) ? trim($_POST["fecha"]) : null;

        // Validar los datos
        if (empty($email) || empty($nombre) || empty($fecha)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        // Validar formato de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El formato del correo electrónico no es válido.");
        }

        // Validar formato de fecha con DateTime
        $date = DateTime::createFromFormat('Y-m-d', $fecha);
        if (!$date || $date->format('Y-m-d') !== $fecha) {
            throw new Exception("El formato de la fecha no es válido. Use el formato YYYY-MM-DD.");
        }

        // Conectar a la base de datos
        $baseDir = dirname(__DIR__) . '/';
        $databaseFile = $baseDir . 'config/database.php';

        if (!file_exists($databaseFile)) {
            throw new Exception("El archivo de configuración de la base de datos no existe.");
        }

        include_once $databaseFile;

        $database = new Database();
        $db = $database->getConnection();

        if ($db === null) {
            throw new Exception("Error al conectar a la base de datos.");
        }

        // Validar si el correo ya tiene una cita en la misma fecha (opcional)
        $checkQuery = "SELECT COUNT(*) as count FROM citas WHERE email = :email AND fecha = :fecha";
        $checkStmt = $db->prepare($checkQuery);
        $checkStmt->bindParam(":email", $email);
        $checkStmt->bindParam(":fecha", $fecha);
        $checkStmt->execute();

        $row = $checkStmt->fetch(PDO::FETCH_ASSOC);
        if ($row['count'] > 0) {
            throw new Exception("Ya existe una cita registrada para este correo electrónico en la fecha especificada.");
        }

        // Insertar la cita en la base de datos
        $query = "INSERT INTO citas (email, nombre, fecha) VALUES (:email, :nombre, :fecha)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":fecha", $fecha);

        if ($stmt->execute()) {
            // Respuesta de éxito
            echo json_encode([
                "success" => true,
                "message" => "Cita registrada con éxito."
            ]);
        } else {
            $errorInfo = $stmt->errorInfo(); // Captura del error SQL
            error_log("Error al insertar cita: " . $errorInfo[2]);
            throw new Exception("No se pudo registrar la cita. Por favor, inténtelo de nuevo más tarde.");
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

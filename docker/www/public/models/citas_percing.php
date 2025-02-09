<?php
header('Content-Type: application/json');

// Activar registro de errores para depuración
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/php-error.log');
error_reporting(E_ALL);
ini_set('display_errors', 0);

try {
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

    //  OBTENER HORAS OCUPADAS (GET Request)
    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["fecha"])) {
        $fecha = trim($_GET["fecha"]);

        // Validar el formato de fecha
        $date = DateTime::createFromFormat('Y-m-d', $fecha);
        if (!$date || $date->format('Y-m-d') !== $fecha) {
            throw new Exception("El formato de la fecha no es válido. Use el formato YYYY-MM-DD.");
        }

        // Consultar las horas ocupadas para la fecha dada
        $query = "SELECT hora FROM citas WHERE fecha = :fecha";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->execute();

        $ocupadas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ocupadas[] = $row["hora"];
        }

        echo json_encode(["success" => true, "ocupadas" => $ocupadas]);
        exit;
    }

    //  REGISTRAR UNA CITA (POST Request)
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

        // Validar formato de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El formato del correo electrónico no es válido.");
        }

        // Validar formato de fecha
        $date = DateTime::createFromFormat('Y-m-d', $fecha);
        if (!$date || $date->format('Y-m-d') !== $fecha) {
            throw new Exception("El formato de la fecha no es válido. Use el formato YYYY-MM-DD.");
        }

        // Validar si ya existe una cita en la misma fecha y hora
        $checkQuery = "SELECT COUNT(*) as count FROM citas WHERE fecha = :fecha AND hora = :hora";
        $checkStmt = $db->prepare($checkQuery);
        $checkStmt->bindParam(":fecha", $fecha);
        $checkStmt->bindParam(":hora", $hora);
        $checkStmt->execute();

        $row = $checkStmt->fetch(PDO::FETCH_ASSOC);
        if ($row['count'] > 0) {
            throw new Exception("Ya existe una cita registrada en la fecha y hora especificada.");
        }

        // Insertar la nueva cita en la base de datos
        $query = "INSERT INTO citas (email, nombre, fecha, hora) VALUES (:email, :nombre, :fecha, :hora)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->bindParam(":hora", $hora);

        if ($stmt->execute()) {
            echo json_encode([
                "success" => true,
                "message" => "Cita registrada con éxito."
            ]);
        } else {
            $errorInfo = $stmt->errorInfo();
            error_log("Error al insertar cita: " . $errorInfo[2]);
            throw new Exception("No se pudo registrar la cita. Inténtelo nuevamente.");
        }

        exit;
    }

    throw new Exception("Método de solicitud no válido.");

} catch (Exception $e) {
    error_log($e->getMessage());

    // Respuesta de error en JSON
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}

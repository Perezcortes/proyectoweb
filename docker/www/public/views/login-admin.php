<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/login-admin.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-box text-center">
            <h1>Hola, Admin!</h1>
            <form id="loginForm">
                <div class="form-group">
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                </div>
                <div class="form-group">
                    <input type="password" name="pin" class="form-control" placeholder="PIN" required>
                </div>
                <button type="submit" id="loginButton" class="btn btn-primary btn-block">Iniciar Sesión</button>
            </form>
        </div>
    </div>
    <script src="../js/admin-login.js"></script>
</body>
</html>

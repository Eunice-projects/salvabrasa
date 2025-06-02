<?php
include 'assets/config/conexion.php';
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);

    $conexion = conectar();

    // Verificar si el correo ya está registrado
    $verificar = $conexion->prepare("SELECT * FROM usuarios WHERE email = ?");
    $verificar->bind_param("s", $email);
    $verificar->execute();
    $resultado = $verificar->get_result();

    if ($resultado->num_rows > 0) {
        $mensaje = "Este correo ya está registrado.";
    } else {
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, email, clave) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $email, $clave);

        if ($stmt->execute()) {
            // Redirige al login con mensaje de éxito
            header("Location: login.php?exito=1");
            exit();
        } else {
            $mensaje = "Error al registrar usuario.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Registro de Usuario</h2>
        <?php if (!empty($mensaje)) echo "<p class='mensaje'>$mensaje</p>"; ?>
        <form method="POST" action="">
            <input type="text" name="nombre" placeholder="Nombre completo" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="clave" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
    </div>
</body>
</html>
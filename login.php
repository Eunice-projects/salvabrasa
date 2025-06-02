<?php
session_start();
include 'assets/config/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $clave = $_POST['clave'];

    $conexion = conectar();
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        if (password_verify($clave, $usuario['clave'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            header("Location: i.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <style>
    body {
        background: linear-gradient(135deg, #1a1a1a 0%, #45413c 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
    }
    .login-container {
        background: #101010;
        padding: 40px 30px 30px 30px;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(168, 123, 7, 0.20);
        width: 340px;
        position: relative;
        animation: fadeIn 1s;
        border: 2px solid #b28a1a;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px);}
        to { opacity: 1; transform: translateY(0);}
    }
    .login-container h2 {
        margin-bottom: 22px;
        text-align: center;
        color: #b28a1a;
        letter-spacing: 1px;
    }
    .login-container form {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .input-wrapper {
        width: 100%;
        position: relative;
        margin-bottom: 0;
    }
    .input-wrapper input[type="email"],
    .input-wrapper input[type="password"] {
        width: 100%;
        padding: 12px 42px 12px 14px;
        border: 1.5px solid #b28a1a;
        border-radius: 10px;
        background: #222;
        color: #fff;
        font-size: 17px;
        transition: border 0.2s, background 0.2s;
        outline: none;
        box-sizing: border-box;
        display: block;
    }
    .input-wrapper input:focus {
        border-color: #a87b07;
        background: #2c2c2c;
    }
    ::placeholder {
        color: #bdbdbd;
        opacity: 1;
    }
    .toggle-password {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #b28a1a;
        font-size: 20px;
        user-select: none;
        transition: color 0.2s;
        z-index: 2;
    }
    .toggle-password:hover {
        color: #fff;
    }
    .login-container button[type="submit"] {
        background: linear-gradient(90deg, #b28a1a 60%, #a87b07 100%);
        color: #fff;
        border: none;
        padding: 12px 0;
        border-radius: 7px;
        font-size: 17px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.25s;
        margin-top: 5px;
        position: relative;
        letter-spacing: 1px;
        box-shadow: 0 2px 10px #0003;
    }
    .login-container button[type="submit"]:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }
    .login-container p {
        margin-top: 20px;
        text-align: center;
        color: #bdbdbd;
    }
    .login-container a {
        color: #b28a1a;
        text-decoration: none;
        transition: text-decoration 0.2s;
    }
    .login-container a:hover {
        text-decoration: underline;
    }
    .error {
        background: #fff3cd;
        color: #856404;
        border-radius: 5px;
        padding: 10px 14px;
        margin-bottom: 15px;
        text-align: center;
        opacity: 0;
        animation: showError 0.7s forwards;
        border: 1px solid #ffeeba;
    }
    @keyframes showError {
        from { opacity: 0; transform: translateY(-20px);}
        to { opacity: 1; transform: translateY(0);}
    }
    .loader {
        border: 3px solid #f3f3f3;
        border-top: 3px solid #b28a1a;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        animation: spin 0.8s linear infinite;
        position: absolute;
        left: 50%;
        top: 50%;
        margin: -11px 0 0 -11px;
        display: none;
        z-index: 2;
    }
    @keyframes spin {
        0% { transform: rotate(0deg);}
        100% { transform: rotate(360deg);}
    }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="" id="loginForm" autocomplete="off">
            <div class="input-wrapper">
                <input type="email" name="email" placeholder="Correo electrónico" required>
            </div>
            <div class="input-wrapper">
                <input type="password" name="clave" id="clave" placeholder="Contraseña" required>
                <span class="toggle-password" id="togglePassword" title="Mostrar/ocultar contraseña">&#128065;</span>
            </div>
            <button type="submit" id="loginBtn">Entrar</button>
            <div class="loader" id="loader"></div>
        </form>
        <p>¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
    </div>
    <script>
    // Mostrar/Ocultar contraseña
    document.getElementById('togglePassword').addEventListener('click', function () {
        const clave = document.getElementById('clave');
        if (clave.type === "password") {
            clave.type = "text";
            this.style.color = "#fff";
        } else {
            clave.type = "password";
            this.style.color = "#b28a1a";
        }
    });

    // Loader al enviar el formulario
    const form = document.getElementById('loginForm');
    const btn = document.getElementById('loginBtn');
    const loader = document.getElementById('loader');
    form.addEventListener('submit', function(){
        btn.disabled = true;
        loader.style.display = 'block';
    });
    </script>
</body>
</html>
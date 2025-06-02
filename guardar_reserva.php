<?php
session_start();
include 'assets/config/conexion.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'no_login']);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_usuario = $_SESSION['usuario_id'];
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $fecha_hora = trim($_POST['fecha_hora'] ?? '');
    $personas = intval($_POST['personas'] ?? 0);
    $comentarios = trim($_POST['comentarios'] ?? '');
    $asiento = ''; // Puedes modificarlo si usas selección de asiento

    // Validación básica
    if ($nombre == "" || $correo == "" || $telefono == "" || $fecha_hora == "" || $personas <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Datos inválidos o incompletos.']);
        exit();
    }

    $conexion = conectar();

    $stmt = $conexion->prepare("INSERT INTO reservas 
        (id_usuario, fecha, personas, asiento, nombre, correo, telefono, comentarios) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("isisssss", $id_usuario, $fecha_hora, $personas, $asiento, $nombre, $correo, $telefono, $comentarios);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'nombre' => $nombre,
            'fecha_hora' => $fecha_hora,
            'personas' => $personas
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }
} else {
    echo json_encode(['status' => 'unauthorized']);
}
?>
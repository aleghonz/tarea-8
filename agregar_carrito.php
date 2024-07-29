<?php
session_start();
require_once 'funciones.php';

// Protección CSRF
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php"); // Redirigir si no es una solicitud POST
    exit();
}

if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    echo json_encode(['error' => 'Solicitud no válida (CSRF)']);
    exit();
}

// Validación del paquete_id
$paqueteId = filter_input(INPUT_POST, 'paquete_id', FILTER_VALIDATE_INT);
if (!$paqueteId) {
    echo json_encode(['error' => 'ID de paquete inválido']);
    exit();
}

// Verificar si el paquete existe (opcional pero recomendado)
$paquetes = obtenerPaquetes();
$paqueteExiste = false;
foreach ($paquetes as $paquete) {
    if ($paquete['id'] == $paqueteId) {
        $paqueteExiste = true;
        break;
    }
}

if (!$paqueteExiste) {
    echo json_encode(['error' => 'El paquete no existe']);
    exit();
}

// Agregar o actualizar el paquete en el carrito
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_SESSION['carrito'][$paqueteId])) {
    $_SESSION['carrito'][$paqueteId]++; // Incrementar cantidad si ya existe
} else {
    $_SESSION['carrito'][$paqueteId] = 1; // Agregar nuevo paquete con cantidad 1
}

// Redirigir de vuelta a index.php (o a la página del carrito)
header("Location: index.php"); 
exit();

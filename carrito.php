<?php
session_start();
require_once 'funciones.php';

// Protección CSRF
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Error: Solicitud no válida.");
    }
}

// Manejo de la eliminación de items del carrito
if (isset($_POST['eliminar_paquete'])) {
    $paqueteId = filter_input(INPUT_POST, 'paquete_id', FILTER_VALIDATE_INT);
    if ($paqueteId && isset($_SESSION['carrito'][$paqueteId])) {
        unset($_SESSION['carrito'][$paqueteId]);
    }
}

// Calcular el total del carrito
$total = 0;
if (isset($_SESSION['carrito'])) {
    $paquetes = obtenerPaquetes(); // Obtener todos los paquetes
    foreach ($_SESSION['carrito'] as $paqueteId => $cantidad) {
        $paquete = array_filter($paquetes, function($p) use ($paqueteId) { return $p['id'] == $paqueteId; });
        $paquete = reset($paquete); // Obtener el primer (y único) elemento del array filtrado
        if ($paquete) {
            $precio = isset($paquete['precio_oferta']) ? $paquete['precio_oferta'] : $paquete['precio'];
            $total += $precio * $cantidad;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agencia de Viajes - Carrito de Compras</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Tu Carrito de Compras</h1>
        <a href="index.php">Volver a la página principal</a>
    </header>

    <main>
        <?php if (empty($_SESSION['carrito'])): ?>
            <p>Tu carrito está vacío.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Paquete</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['carrito'] as $paqueteId => $cantidad): ?>
                        <?php 
                            $paquete = array_filter($paquetes, function($p) use ($paqueteId) { return $p['id'] == $paqueteId; });
                            $paquete = reset($paquete);
                        ?>
                        <?php if ($paquete): ?>
                            <tr>
                                <td><?= htmlspecialchars($paquete['nombre']) ?></td>
                                <td>$<?= htmlspecialchars(number_format($paquete['precio'], 0, ',', '.')) ?></td>
                                <td><?= $cantidad ?></td>
                                <td>$<?= htmlspecialchars(number_format($paquete['precio'] * $cantidad, 0, ',', '.')) ?></td>
                                <td>
                                    <form method="POST" action="">
                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                        <input type="hidden" name="paquete_id" value="<?= $paqueteId ?>">
                                        <button type="submit" name="eliminar_paquete">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total:</td>
                        <td colspan="2">$<?= htmlspecialchars(number_format($total, 0, ',', '.')) ?></td>
                    </tr>
                </tfoot>
            </table>
        <?php endif; ?>
    </main>
</body>
</html>

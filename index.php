<?php
session_start();
require_once 'funciones.php';

// Protección CSRF
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Error: Solicitud no válida.");
    }
} else {
    // Generar token CSRF para el formulario (si no es POST)
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Extensión de Sesión Basada en Actividad
if (isset($_SESSION['ultima_actividad'])) {
    $tiempo_inactividad = time() - $_SESSION['ultima_actividad'];
    if ($tiempo_inactividad > 120) { // 2 minutos en segundos
        session_destroy();
        header("Location: index.php"); // Redirigir al inicio de sesión
        exit();
    }
}
$_SESSION['ultima_actividad'] = time();


function getRegionesDisponibles($paquetes) {
    $regiones = [];
    foreach ($paquetes as $paquete) {
        if (!in_array($paquete['region'], $regiones)) {
            $regiones[] = $paquete['region'];
        }
    }
    return $regiones;
}

function getTiposDePaquete($paquetes) {
    $tipos = [];
    foreach ($paquetes as $paquete) {
        if (!in_array($paquete['tipo'], $tipos)) {
            $tipos[] = $paquete['tipo'];
        }
    }
    return $tipos;
}
$paquetes = obtenerPaquetes();
$regionesDisponibles = getRegionesDisponibles($paquetes);
$tiposDePaquete = getTiposDePaquete($paquetes);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Agencia de Viajes - Paquetes Turísticos por Chile</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <header>
        <h1>Descubre Chile: Nuestros Paquetes Turísticos</h1>
        <a href="carrito.php" class="ver-carrito">Carrito (<span id="cantidad-carrito"><?php echo isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0; ?></span>)</a>
    </header>

    <main>
        <?php if (empty($paquetes)): ?>
            <p class="error-message">No hay paquetes disponibles en este momento.</p>
        <?php else: ?>
            <section class="filtros">
                <div class="filtro-region">
                    <label for="filtro-region">Filtrar por Región:</label>
                    <select id="filtro-region">
                        <option value="">Todas las Regiones</option>
                        <?php foreach ($regionesDisponibles as $region): ?>
                            <option value="<?= htmlspecialchars($region) ?>"><?= htmlspecialchars($region) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filtro-tipo">
                    <label for="filtro-tipo">Filtrar por Tipo:</label>
                    <select id="filtro-tipo">
                        <option value="">Todos los Tipos</option>
                        <?php foreach ($tiposDePaquete as $tipo): ?>
                            <option value="<?= htmlspecialchars($tipo) ?>"><?= htmlspecialchars($tipo) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </section>

            <section class="paquetes">
                <?php foreach ($paquetes as $paquete): ?>
                    <article class="paquete" data-region="<?= htmlspecialchars($paquete['region']) ?>" data-tipo="<?= htmlspecialchars($paquete['tipo']) ?>">
                        <img src="<?= htmlspecialchars($paquete['imagen']) ?>" alt="<?= htmlspecialchars($paquete['nombre']) ?>">
                        <div class="paquete-info">
                            <h3><?= htmlspecialchars($paquete['nombre']) ?></h3>
                            <p class="region">Región: <?= htmlspecialchars($paquete['region']) ?></p>
                            <p class="tipo">Tipo: <?= htmlspecialchars($paquete['tipo']) ?></p>
                            <p class="precio">
                                <?php if (isset($paquete['precio_oferta'])): ?>
                                    Antes: <span class="precio-anterior">$<?= htmlspecialchars(number_format($paquete['precio'], 0, ',', '.')) ?></span>
                                    Ahora: $<?= htmlspecialchars(number_format($paquete['precio_oferta'], 0, ',', '.')) ?>
                                <?php else: ?>
                                    $<?= htmlspecialchars(number_format($paquete['precio'], 0, ',', '.')) ?>
                                <?php endif; ?>
                            </p>
                            <p class="descripcion"><?= htmlspecialchars($paquete['descripcion']) ?></p>
                            <ul class="incluye">
                                <?php foreach ($paquete['incluye'] as $item): ?>
                                    <li><?= htmlspecialchars($item) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php if (isset($paquete['duracion'])): ?>
                                <p class="duracion">Duración: <?= htmlspecialchars($paquete['duracion']) ?></p>
                            <?php endif; ?>
                            <form method="POST" action="agregar_carrito.php">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                <input type="hidden" name="paquete_id" value="<?= $paquete['id'] ?>">
                                <button type="submit" class="agregar-carrito">Agregar al Carrito</button>
                            </form>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</body>
</html>

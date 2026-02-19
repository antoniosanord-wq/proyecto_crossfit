<?php
// 1. EL CANDADO: Iniciamos sesión y comprobamos si es admin
session_start();

if (!isset($_SESSION['admin_logeado']) || $_SESSION['admin_logeado'] !== true) {
    // Si no es admin, lo mandamos al login
    header("Location: index.html");
    exit();
}

// 2. CONEXIÓN A LA BASE DE DATOS
// Incluimos tu archivo de conexión 
include('php/conexion.php');

// 3. CONSULTA DE PAGOS
// Traemos los pagos ordenados por fecha más reciente
$sql = "SELECT * FROM pagos ORDER BY fecha DESC";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel Admin - Gestión de Pagos</title>
    <link rel="stylesheet" href="css/styles.css?v=1">
</head>

<body class="body-dashboard">


    <nav class="barra-navegacion">
        <div class="logo"><strong>WOD</strong>Cross <img src="img/logo.png" alt="logo"></div>
        <div class="enlaces">
            <a href="competiciones.php" onclick="">COMPETICIONES</a>
            <a href="mi_progreso.php" onclick="competiciones()">MI PROGRESO</a>

            <a href="index.html" class="boton-salir">SALIR</a>
        </div>
    </nav>

    <header class="header-admin_pagos">
        <h1>Panel de Administración: Pagos</h1>
        <p>Bienvenido: <?php echo $_SESSION['usuario']; ?></p>
    </header>

    <hr>

    <table class="table-admin_pagos">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario (Email)</th>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($pago = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?php echo $pago['id']; ?></td>
                    <td><?php echo $pago['email_usuario']; ?></td>
                    <td><?php echo $pago['fecha']; ?></td>
                    <td><?php echo $pago['concepto']; ?></td>
                    <td><?php echo $pago['cantidad']; ?>€</td>
                    <td>
                        <strong><?php echo $pago['estado']; ?></strong>
                    </td>
                    <td>
                        <a href="editar_pagos.php?id=<?php echo $pago['id']; ?>">✏️ Editar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>

</html>
<?php
// 1. Iniciamos sesión y conectamos a la base de datos
session_start();
include('php/conexion.php');

// 2. Seguridad: Si no está logueado, al registro
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// 3. Obtenemos el email del usuario de la sesión
$email_usuario = $_SESSION['usuario'];

// 4. Consultamos los pagos del usuario (el más reciente primero)
$query_pagos = mysqli_query($conexion, "SELECT * FROM pagos WHERE email_usuario = '$email_usuario' ORDER BY fecha DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Pagos - WODCross</title>
    <link rel="stylesheet" href="css/styles.css?v=1.1">
</head>
<body >
    
    <nav class="barra-navegacion">
        <div class="logo"><strong>WOD</strong>Cross <img src="img/logo.png" alt="logo"></div>
        <div class="enlaces">
            <a href="dashboard.php">VOLVER AL PANEL</a>
        </div>
    </nav><br><br><br>

    <div class="contenedor-pagos">
        <div class="tarjeta seccion-pagos">
            <h2 class="h2-pagos">Historial de Pagos</h2>

            <table class="tabla-pagos">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Concepto</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($query_pagos) > 0) {
                        while ($pago = mysqli_fetch_assoc($query_pagos)) {
                            // Definimos una clase según el estado para el CSS
                            $claseEstado = ($pago['estado'] == 'Pagado') ? 'estado-pagado' : 'estado-pendiente';
                            
                            echo "<tr>";
                            echo "<td>" . date("d/m/Y", strtotime($pago['fecha'])) . "</td>";
                            echo "<td>" . $pago['concepto'] . "</td>";
                            echo "<td>" . $pago['cantidad'] . "€</td>";
                            echo "<td><span class='$claseEstado'>" . $pago['estado'] . "</span></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='sin-datos'>No se han encontrado registros de pagos.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
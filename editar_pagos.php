<?php
session_start();
include('php/conexion.php');

// 1. PROCESAR LA ACTUALIZACIÓN 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {

    $id = $_POST['id'];
    $concepto = $_POST['concepto'];
    $cantidad = $_POST['cantidad'];
    $estado = $_POST['estado'];

    // SQL DIRECTO (Sin complicaciones)
    $sql_update = "UPDATE pagos SET concepto='$concepto', cantidad='$cantidad', estado='$estado' WHERE id_pago='$id'";

    if (mysqli_query($conexion, $sql_update)) {
        header("Location: admin_pagos.php?msj=editado");

        exit();
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}

// 2. CARGAR LOS DATOS (Para que se vea el formulario)
$id_a_buscar = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);

if ($id_a_buscar) {
    $id_limpio = mysqli_real_escape_string($conexion, $id_a_buscar);
    $resultado = mysqli_query($conexion, "SELECT * FROM pagos WHERE id_pago = '$id_limpio'");
    $pago = mysqli_fetch_assoc($resultado);
}

if (!$pago) {
    die("No encuentro el pago con ID: " . $id_a_buscar);
}
?>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>WODCross - Editar Pago</title>
    <link rel="stylesheet" href="css/styles.css?v=1">
</head>

<body>
    <nav class="barra-navegacion">
        <div class="logo"><strong>WOD</strong>Cross <img src="img/logo.png" alt="logo"></div>
        <div class="enlaces">
            <a href="admin_pagos.php" class="activo">INICIO</a>
            <a href="index.html" class="boton-salir">SALIR</a>
        </div>
    </nav>

    <div class="cabecera-editar_pagos">
        <h2>Modificar Pago usuario con id: #<?php echo $pago['id']; ?></h2>
        <p>Usuario: <?php echo $pago['email_usuario']; ?></p>
    </div>

    <form class="form-editar_pagos" method="POST" action="">

        <input type="hidden" name="id" value="<?php echo $pago['id']; ?>">

        <label>Concepto:</label><br>
        <input type="text" name="concepto" value="<?php echo $pago['concepto']; ?>" required><br><br>

        <label>Cantidad (€):</label><br>
        <input type="number" step="0.01" name="cantidad" value="<?php echo $pago['cantidad']; ?>" required><br><br>

        <label>Estado del pago:</label><br>
        <select name="estado">
            <option value="Pendiente" <?php if ($pago['estado'] == 'Pendiente') echo 'selected'; ?>>Pendiente</option>
            <option value="Pagado" <?php if ($pago['estado'] == 'Pagado') echo 'selected'; ?>>Pagado</option>
            <option value="Rechazado" <?php if ($pago['estado'] == 'Rechazado') echo 'selected'; ?>>Rechazado</option>
        </select><br><br>


        <button type="submit">GUARDAR CAMBIOS</button>
        <br><br>
        <a href="admin_pagos.php">Volver atrás sin guardar</a>
    </form>

</body>

</html>
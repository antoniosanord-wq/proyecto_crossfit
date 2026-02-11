<?php
// 1. EL CANDADO: Usamos la misma lógica que en mi admin_pagos.php
session_start();

if (!isset($_SESSION['admin_logeado']) || $_SESSION['admin_logeado'] !== true) {
    header("Location: index.html");
    exit();
}

// 2. CONEXIÓN
include('php/conexion.php');

// 3. PROCESAR LA ACTUALIZACIÓN (Cuando pulsas el botón de guardar)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pago = mysqli_real_escape_string($conexion, $_POST['id_pago']);
    $concepto = mysqli_real_escape_string($conexion, $_POST['concepto']);
    $cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
    $estado = mysqli_real_escape_string($conexion, $_POST['estado']);

    $sql_update = "UPDATE pagos SET concepto='$concepto', cantidad='$cantidad', estado='$estado' WHERE id_pago='$id_pago'";

    if (mysqli_query($conexion, $sql_update)) {
        // Si todo va bien, volvemos al panel principal
        header("Location: admin_pagos.php?msj=editado");
        exit();
    } else {
        echo "Error al actualizar: " . mysqli_error($conexion);
    }
}

// 4. CARGAR LOS DATOS ACTUALES DEL PAGO
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conexion, $_GET['id']);
    $sql_pago = "SELECT * FROM pagos WHERE id_pago = '$id'";
    $resultado = mysqli_query($conexion, $sql_pago);
    $pago = mysqli_fetch_assoc($resultado);

    if (!$pago) {
        die("Pago no encontrado en la base de datos.");
    }
} else {
    // Si alguien entra aquí sin un ID en la URL, lo devolvemos al panel
    header("Location: admin_pagos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>WODCross - Editar Pago</title>
</head>
<body>

    <h2>Modificar Pago #<?php echo $pago['id_pago']; ?></h2>
    <p>Usuario: <?php echo $pago['email_usuario']; ?></p>

    <form method="POST" action="editar_pago.php">
        
        <input type="hidden" name="id_pago" value="<?php echo $pago['id_pago']; ?>">

        <label>Concepto:</label><br>
        <input type="text" name="concepto" value="<?php echo $pago['concepto']; ?>" required><br><br>

        <label>Cantidad (€):</label><br>
        <input type="number" step="0.01" name="cantidad" value="<?php echo $pago['cantidad']; ?>" required><br><br>

        <label>Estado del pago:</label><br>
        <select name="estado">
            <option value="Pendiente" <?php if($pago['estado'] == 'Pendiente') echo 'selected'; ?>>Pendiente</option>
            <option value="Pagado" <?php if($pago['estado'] == 'Pagado') echo 'selected'; ?>>Pagado</option>
            <option value="Rechazado" <?php if($pago['estado'] == 'Rechazado') echo 'selected'; ?>>Rechazado</option>
        </select><br><br>

        <button type="submit">GUARDAR CAMBIOS</button>
        <br><br>
        <a href="admin_pagos.php">Volver atrás sin guardar</a>
    </form>

</body>
</html>
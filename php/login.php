<?php
// 1. Conectamos con la base de datos
include('conexion.php');

// 2. Iniciamos sesión
session_start();

// 3. Recogemos los datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// --- NUEVA PARTE: COMPROBAR SI ES ADMINISTRADOR ---
// Buscamos en tu tabla 'administrador' (asumiendo que la columna se llama usuario o email)
$consulta_admin = "SELECT * FROM administrador WHERE usuario = '$email' AND password = '$password'";
$resultado_admin = mysqli_query($conexion, $consulta_admin);

if (mysqli_num_rows($resultado_admin) > 0) {
    // Si es admin, creamos sesión especial y mandamos a la gestión de pagos
    $_SESSION['admin_logeado'] = true;
    $_SESSION['usuario'] = $email;
    header("Location: ../admin_pagos.php");
    exit();
} 
// --- FIN PARTE ADMINISTRADOR ---

// 4. Si no fue admin, buscamos si es un usuario normal (Atleta)
$consulta = "SELECT * FROM usuarios WHERE email = '$email' AND password = '$password'";
$resultado = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($resultado) > 0) {
    $_SESSION['usuario'] = $email;
    header("Location: ../dashboard.php");
    exit();
} else {
    // Si no es ninguno de los dos
    echo "<h1>Error en el acceso</h1>";
    echo "<p>El correo o la contraseña son incorrectos.</p>";
    echo "<a href='../index.html'>Volver al Login</a>";
}

// 6. Cerramos la conexión
mysqli_close($conexion);
?>
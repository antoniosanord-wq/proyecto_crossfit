<?php
include('conexion.php');

// Recoger los datos del formulario
$nombre   = $_POST['nombre'];
$email    = $_POST['email'];
$password = $_POST['password'];
$peso     = $_POST['peso'];
$altura   = $_POST['altura'];
$edad     = $_POST['edad'];

// 1. Comprobar si el email ya existe para no duplicar
$comprobar = "SELECT * FROM usuarios WHERE email = '$email'";
$resultado = mysqli_query($conexion, $comprobar);

if (mysqli_num_rows($resultado) > 0) {
    echo "<script>alert('Ese correo ya está registrado'); window.location.href='../registro.html';</script>";
} else {
    // 2. Insertar el nuevo usuario
    $sql = "INSERT INTO usuarios (nombre, email, password, peso, altura, edad) 
            VALUES ('$nombre', '$email', '$password', '$peso', '$altura', '$edad')";

    if (mysqli_query($conexion, $sql)) {
        echo "<script>alert('¡Registro con éxito! Ya puedes entrar.'); window.location.href='../index.html';</script>";
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>
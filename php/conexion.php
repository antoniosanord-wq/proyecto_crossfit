<?php
// Este archivo sirve para conectar mi web con la base de datos de XAMPP
$host = "localhost";
$user = "root";    // Usuario por defecto de XAMPP
$pass = "";        // Contraseña por defecto 
$db   = "box_crossfit"; // El nombre que le puse en phpMyAdmin

// Creamos la conexión
$conexion = mysqli_connect($host, $user, $pass, $db);

// Si falla, nos avisa con un mensaje
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
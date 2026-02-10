<?php
// 1. Conectamos con la base de datos
include('conexion.php');

// 2. Iniciamos sesión para que la web "recuerde" quién ha entrado
session_start();

// 3. Recogemos el email y la contraseña que el usuario escribió en el index.html
$email = $_POST['email'];
$password = $_POST['password'];

// 4. Buscamos en la base de datos si existe ese usuario
$consulta = "SELECT * FROM usuarios WHERE email = '$email' AND password = '$password'";
$resultado = mysqli_query($conexion, $consulta);

// 5. Comprobamos si la consulta ha devuelto alguna fila
if (mysqli_num_rows($resultado) > 0) {
    // Si existe, guardamos el email en una variable de sesión
    $_SESSION['usuario'] = $email;
    
    
    // El '../' significa "sal de la carpeta php y busca el archivo fuera"
    header("Location: ../dashboard.php");
    exit();
} else {
    // Si los datos son incorrectos, mostramos un error y un botón para volver
    echo "<h1>Error en el acceso</h1>";
    echo "<p>El correo o la contraseña son incorrectos.</p>";
    echo "<a href='../index.html'>Volver al Login</a>";
}

// 6. Cerramos la conexión para que el servidor descanse
mysqli_close($conexion);
?>
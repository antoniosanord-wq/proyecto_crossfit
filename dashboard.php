<?php
session_start();
include('php/conexion.php');

if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

$email_usuario = $_SESSION['usuario'];
$sql = "SELECT * FROM usuarios WHERE email = '$email_usuario'";
$query = mysqli_query($conexion, $sql);
$datos = mysqli_fetch_assoc($query);

// --- COOKIE ---
// Guardamos el nombre del usuario por 30 días 
// Usamos $datos['nombre']
setcookie("nombre_atleta", $datos['nombre'], time() + (86400 * 30), "/");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WodCross - Dashboard</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/styles.css?v=1">
</head>
<body class="body-dashboard">
    <nav class="barra-navegacion">
        <div class="logo"><strong>WOD</strong>Cross <img src="img/logo.png" alt="logo"></div>
        <div class="enlaces">
            <a href="dashboard.php" class="activo">INICIO</a>
            <a href="reservas.php" onclick="mostrarReservas()">RESERVAS</a>
            <a href="competiciones.php" onclick="">COMPETICIONES</a>
            <a href="mi_progreso.php" onclick="competiciones()">MI PROGRESO</a>
            <a href="pagos.php">MIS PAGOS</a>
            <a href="index.html" class="boton-salir">SALIR</a>
        </div>
    </nav>

    <div class="contenedor-principal">
        <header class="cabecera-bienvenida">
            <h1>¡Bienvenid@!, <strong><?php echo $datos['nombre']; ?></strong></h1>
        </header><br><br><br>

        <div id="contenido-principal" class="panel-control">
            <a href="reservas.php" onclick="mostrarReservas()" class="tarjeta-enlace">
                <section class="tarjeta seccion-unica">
                    <h2>Reservas</h2>
                    <p class="p-tarjetas-letras">Gestiona tus clases y horarios.</p>
                </section>
            </a>

             <a href="competiciones.php" class="tarjeta-enlace">
                <section class="tarjeta seccion-unica">
                    <h2>Competiciones</h2>
                    <p class="p-tarjetas-letras">Ver competiciones disponibles</p>
                </section>
            </a>
            

            <a href="mi_progreso.php" class="tarjeta-enlace">
                <section class="tarjeta seccion-unica">
                    <h2>Mi Progreso</h2>
                    <p class="p-tarjetas-letras">Ver progreso</p>
                   
                </section>
            </a>

            <a href="pagos.php" class="tarjeta-enlace">
                <section class="tarjeta seccion-unica">
                    <h2>Mis Pagos</h2>
                    <p class="p-tarjetas-letras">Estado de suscripción y recibos.</p>
                </section>
            </a>

           
        </div>
        
        <div id="seccion-reservas-detallada" style="display:none;">
            </div>
    </div>

    <?php if (!isset($_COOKIE['aceptado'])): ?>
    <div id="banner-cookies" class="cookie-banner">
        <p>¿Aceptas las cookies para tu entrenamiento? 🏋️‍♂️</p>
        <button onclick="aceptarCookie()" class="btn-aceptar">ACEPTAR</button>
        <button onclick="rechazarCookie()" class="btn-rechazar">RECHAZAR</button>
    </div>
<?php endif; ?>

     <?php include('php/footer.php'); ?>

    <script src="js/script.js"></script>
</body>
</html>
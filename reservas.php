<?php
session_start();
include('php/conexion.php')
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservas - WODCross</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="body-dashboard"> <nav class="barra-navegacion">
        <div class="logo"><strong>WOD</strong>Cross <img src="img/logo.png" alt="logo"></div>
        <div class="enlaces">
            <a href="dashboard.php">VOLVER AL PANEL</a>
        </div>
    </nav>

  <div class="contenedor-principal">
    <header class="cabecera-bienvenida">
        <h1>Reserva tu <strong>Clase</strong></h1>
    </header>

    <div class="selector-dias">
        <?php 
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        foreach ($dias as $dia) {
            echo "<button class='boton-dia' onclick='seleccionarDia(\"$dia\", this)'>$dia</button>";
        }
        ?>
    </div>


    <div id="contenedor-horarios" class="cuadricula-horarios">
        <p style="color: #666;" class="selecciona-dia">Selecciona un día para ver las horas disponibles...</p>
    </div>
</div>

  <?php include('php/footer.php'); ?>
  
   <script src="js/script.js"></script>
</body>
</html>
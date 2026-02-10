<?php
session_start();
include('php/conexion.php'); // Verifica que la carpeta sea 'php'

if (!isset($_SESSION['usuario'])) {
    header("Location: registro.html");
    exit();
}

$email_usuario = $_SESSION['usuario'];

// --- 1. ACTUALIZAR DATOS ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // IMPORTANTE: Asegúrate de que los names del HTML coincidan (back_squat con _)
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $snatch = $_POST['snatch'];
    $clean_jerk = $_POST['clean_jerk'];
    $back_squat = $_POST['back_squat']; 
    $front_squat = $_POST['front_squat'];
    $deadlift = $_POST['deadlift'];

    $update_sql = "UPDATE usuario SET 
                   peso='$peso', altura='$altura', 
                   snatch='$snatch', clean_jerk='$clean_jerk', 
                   back_squat='$back_squat', front_squat='$front_squat', 
                   deadlift='$deadlift' 
                   WHERE email = '$email_usuario'";
    
    mysqli_query($conexion, $update_sql);
    // Recargamos para ver los cambios aplicados
    header("Location: mi_progreso.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Progreso - CrossFit</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css?v=1.1">
</head>
<body>
      <nav class="barra-navegacion">
        <div class="logo"><strong>WOD</strong>Cross <img src="img/logo.png" alt="logo"></div>
        <div class="enlaces">
            <a href="dashboard.php">VOLVER AL PANEL</a>
        </div>
    </nav>

   <header class="cabecera-mi-progreso">
            <h1>Mi <Strong>Progreso</Strong></h1>
</header><br><br><br>
 


   <div class="contenedor-principal">
    
     <form action="mi_progreso.php" method="POST">
        <div class="panel-control">
            
            <div class="tarjeta seccion-unica" >
                <h2 class="h2-biometria">Biometría</h2>
                <div class="input-biometria">
                    <label>Peso Corporal (kg)</label>
                    <input type="number" step="0.1" name="peso" value="<?php echo $datos['peso']; ?>" >
                </div>
                <div class="input-biometria">
                    <label>Altura (cm)</label>
                    <input type="number" name="altura" value="<?php echo $datos['altura']; ?>">
                </div>
                
                  <button type="submit" class="boton-reservar-hora">ACTUALIZAR DATOS</button>
            </div>

            <div class="tarjeta seccion-unica">
                <h2 class="h2-marcas">Mis Marcas (RM)</h2>
                <div class="input-marcas">
                    <label>Snatch</label>
                    <input type="number" step="0.1" name="snatch" placeholder="Snatch" value="<?php echo $datos['snatch']; ?>">
                     <label>C&J</label>
                    <input type="number" step="0.1" name="clean_jerk" placeholder="C&J" value="<?php echo $datos['clean_jerk']; ?>">
                     <label>Back-squat</label>
                    <input type="number" step="0.1" name="back_squat" placeholder="back_squat" value="<?php echo $datos['back_squat']; ?>">
                     <label>Front-Squat</label>
                    <input type="number" step="0.1" name="front_squat" placeholder="front_squat" value="<?php echo $datos['front_squat']; ?>">
                     <label>Deadlift</label>
                    <input type="number" step="0.1" name="deadlift" placeholder="deadlift" value="<?php echo $datos['deadlift']; ?>">
                </div>
                <button type="submit" class="boton-reservar-hora">ACTUALIZAR MARCAS</button>
            </div>

        </div>
    </form>
</div>

</body>
</html>


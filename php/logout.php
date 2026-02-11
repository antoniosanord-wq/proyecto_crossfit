<?php
session_start();    // Conecta con la sesión actual
session_unset();    // Vacía las variables (borra quién es el usuario)
session_destroy();  // Destruye la sesión en el servidor

// Redirige al login real (tu index.html)
header("Location: ../index.html");
exit();
?>
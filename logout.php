<?php
session_start(); // Iniciar la sesión
$_SESSION = array(); // Limpiar todas las variables de sesión

// Destruir la sesión.
session_destroy();

// Puedes enviar una respuesta JSON para confirmar el cierre de sesión
echo json_encode(["status" => "success"]);
?>

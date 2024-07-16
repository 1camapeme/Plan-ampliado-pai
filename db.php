<?php
session_start();


// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'db_prueba');



$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
  or
  die(mysqli_error($mysqli));

?>
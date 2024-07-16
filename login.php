<?php

include("db.php");

$correo = $_POST['correo'];
$Contrasena = $_POST['Contrasena'];
if($correo==""|| $Contrasena==""){
    echo "Por favor, rellena todos los campos.";

}else{
    $correo = $conn->real_escape_string($correo);
$query = "SELECT * FROM usuariologin WHERE Documento = '$correo'";

$result = $conn->query($query);


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($Contrasena === $row['Contrasena']) {
        $_SESSION['usuario'] = $row['Documento']; // O cualquier otra información del usuario que necesites
        $_SESSION['logueado'] = true;
        echo 'success'; // Indica éxito
    } else {
        echo "La contraseña no es correcta.";
    }
} else {
    echo "No se encontró el correo.";
}
    
}

$conn->close();
?>

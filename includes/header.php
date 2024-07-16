<!DOCTYPE html>
<html lang="en">

<head>
  <!-- basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <!-- site metas -->
  <title>PAI</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- bootstrap css -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- style css -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="boton.css">
  <!-- Responsive-->
  <link rel="stylesheet" href="css/responsive.css">
  <!-- fevicon -->
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
  <!-- Tweaks for older IEs-->
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  <!-- owl stylesheets -->
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
    media="screen">

  <script src="ruta/a/tu/javascript.js" defer></script>
  <link rel="stylesheet" href="estilo.css">
  <link rel="stylesheet" href="fech.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">

  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap-responsive.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.js"></script>


  <!-- Incluir CSS de Bootstrap DatePicker -->
<link rel="stylesheet" href="path/to/bootstrap-datepicker.css">



<!-- Incluir JS de jQuery y Bootstrap DatePicker -->
<script src="path/to/jquery.min.js"></script>
<script src="path/to/bootstrap-datepicker.js"></script>










  <style>
    .pagination-container {
      display: flex;
      flex-wrap: nowrap;
      overflow-x: auto;
    }
  </style>

  <style>
    .table-wrapper-scroll-x {
      overflow-x: auto;

    }

    .table-container {
      max-height: 700px;
      /* Establece la altura máxima según tus preferencias */
      overflow-y: auto;
      /* Agrega desplazamiento vertical si es necesario */
      overflow-x: auto;
      overflow-y: auto;
      /* Habilitar la barra de desplazamiento vertical en el cuerpo */
      scrollbar-color: #D8D8D8;
      /* Cambiar el color de la barra de desplazamiento (solo en navegadores basados en WebKit) */
      border: slategrey solid;


    }

    .table-container table {
      width: 100%;
      /* Asegura que la tabla ocupe el 100% del contenedor */
      width: 5;
    }


    .table-container::-webkit-scrollbar {
      height: 5px;
      /* Ajustar la altura de la barra de desplazamiento */

    }

    .table-container::-webkit-scrollbar-thumb {
      background-color: #D8D8D8;
      /* Cambiar el color del pulgar de la barra de desplazamiento */
      width: 5;
    }

    .table thead {
      position: sticky;
      top: 0;
      background-color: #f5f5f5;
      /* Color de fondo del encabezado */
      z-index: 2;
      /* Asegurarse de que el encabezado esté sobre el contenido */
    }










    /* Estilos para el contenedor de superposición */
    #loading-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.8);
      /* Fondo semi-transparente blanco */
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    /* Estilos para el spinner */
    .spinner {
      border: 4px solid rgba(0, 0, 0, 0.1);
      border-top: 4px solid #3498db;
      /* Color del spinner */
      border-radius: 50%;
      width: 40px;
      height: 40px;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    /* Estilos para desactivar el fondo cuando se muestra el mensaje de carga */
    body.loading-overlay-active {
      overflow: hidden;
      position: fixed;
      width: 100%;
    }
  </style>

</head>
<!-- header section start -->
<head>

<style>
.tooltip {
  position: relative;
  display: inline-block;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  bottom: 100%;
  left: 50%;
  margin-left: -60px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style>
</head>

<div class="header_section" >
   <nav class="navbar navbar-expand-lg navbar-light bg-light "> 
      <div class="logo"><a href="index2.php" >
            <h1 class="health_taital"><img src="images/jeringas.png" style="width:60px; heigth:60px;">PAI</h1>
         </a></div>
      <button  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
         aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button >
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav mr-auto" style=" margin-left:0px; margin-right:0px;" >
         
            <li class="nav-item">
               <a class="nav-link" href="index2.php" >Inicio</a>
            </li>
            <li class="nav-item ">
               <a class="nav-link" href="index2.php#porfecha">Busqueda por fecha</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="index2.php#resultadototal">Conteo total</a>
            </li>
            


            <li class="nav-item" >
               <a class="nav-link" href="contact.php">Contáctanos</a>
            </li>
            <li class="nav-item">
              
            </li>

         </ul>
      </div>
      
      
      <a id="logoutButton" href="#" title="Cerrar sesión"><img src="images/puerta.png" style="width:60px; heigth:60px;"></a>
     </div>
      

   </nav>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    $('#logoutButton').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "logout.php", // Asegúrate de que la ruta al archivo logout.php es correcta
            success: function(response) {
                // Aquí manejas lo que sucede después de un cierre de sesión exitoso
                // Por ejemplo, redirigir al usuario a la página de inicio de sesión
                window.location.href = 'index.php';
            },
            error: function(xhr, status, error) {
                // Manejar errores de AJAX aquí
                console.error("Error al cerrar sesión: ", error);
            }
        });
    });
});
</script>

<!-- header section end -->
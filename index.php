<?php include("db.php"); 
if (isset($_SESSION['logueado']) && $_SESSION['logueado'] === true) {
   // Si el usuario ya ha iniciado sesión, redirígelo a la página principal o al dashboard
   header('Location: index2.php');
   exit;
}


?>

<?php include('includes/header.php'); ?>


<body>




   <div class="header_section">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <div class="logo"><a href="index.php">
               <h1 class="health_taital"><img src="images/jeringas.png" style="width:60px; heigth:60px;">PAI</h1>
            </a></div>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">

         </div>
      </nav>
   </div>






   <!-- header section start -->
   <div class="header_section">

      <div id="main_slider" class="carousel slide" data-ride="carousel">
         <div class="carousel-inner">
            <div class="carousel-item active">
               <div class="banner_section">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-6">
                           <h1 class="banner_taital">Bien<span style="color: #151515;">venido</span><br>
                           <span class="banner_text" style="color: #151515;">Inicia sesion</span></h1>
                          

                           <script>
                              function validarFormulario() {
                                 var correo = document.getElementById('correo').value;
                                 var palabraSecreta = document.getElementById('Contrasena').value;

                                 if (correo === "" || palabraSecreta === "") {
                                    alert("Por favor, rellena todos los campos.");
                                    return false; // Detiene el envío del formulario
                                 }

                                 // Aquí puedes agregar más validaciones según sea necesario

                                 return true; // Permite el envío del formulario
                              }
                           </script>


                           <form id="loginForm" method="POST">
                              <div class="form-group">
                                 <label for="correo">Nombre de Usuario</label>
                                 <input id="correo" name="correo" class="form-control" type="email"
                                    placeholder="Nombre de Usuario" required>
                              </div>
                              <div class="form-group">
                                 <label for="palabraSecreta">Contraseña</label>
                                 <input id="Contrasena" name="Contrasena" class="form-control" type="password"
                                    placeholder="Contraseña" required>
                              </div>
                             
                              <div class="alert-warning "id="errorMensaje" style=" text-align: center; color: red; display: none; heigth: 200px; width:100%; background-color:"></div>
                              <br>
                              <div class="btn_main">
                                 <div class="more_bt">
                                    <button style="background-color:#4bc5b8; color:#eef4f0;" type="button"
                                       class="form-control" id="loginButton">Entrar</button>
                                 </div>
                              </div>
                              

                           </form>



                        </div>
                        <div class="col-md-6">
                           <div class="image_1"><img src="images/img-1.png"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>


         </div>

      </div>
   </div>
   <!-- banner section end -->

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
      $(document).ready(function () {
         $('#loginButton').click(function (e) {

            
            e.preventDefault();
            var correo = $('#correo').val();
            var Contrasena = $('#Contrasena').val();
            $.ajax({
               type: "POST",
               url: "login.php",
               data: { correo: correo, Contrasena: Contrasena },
               success: function (response) {
                  // Aquí manejas la respuesta del servidor
                  if (response === 'success') {
                     window.location.href = 'index2.php'; // Redirigir si el inicio de sesión es exitoso
                  } else {
                    $("#errorMensaje").show().html(response); 
                  }
               }
            });
         });
      });
   </script>





   <!-- footer inicio -->
   <?php include('includes/fin.php'); ?>
   <!-- footer fin-->

   <!-- Javascript files-->
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="js/jquery-3.0.0.min.js"></script>
   <script src="js/plugin.js"></script>
   <!-- sidebar -->
   <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
   <script src="js/custom.js"></script>
   <!-- javascript -->
   <script src="js/owl.carousel.js"></script>
   <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</body>

</html>
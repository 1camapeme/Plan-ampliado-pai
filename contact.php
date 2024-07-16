<?php include("db.php"); ?>
<?php
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
   // Si no está logueado, redirige al usuario a la página de inicio de sesión
   header('Location: index.php');
   exit;
}

?>
<?php include('includes/header.php'); ?>
   
   <body>
     
   <?php include('includes/Menu.php'); ?>
      <!-- contact section start -->
      <div class="contact_section layout_padding margin_90">
         <div class="container">
            <h1 class="contact_taital">¿Como podemos ayudarte?</h1>
            <div class="news_section_2">
               <div class="row">
                  <div class="col-md-6">
                     <div class="icon_main">
                        <div class="icon_7"><img src="images/icon-7.png"></div>
                        <h4 class="diabetes_text">Asesoramiento sobre el proceso de vacunación. </h4>
                     </div>
                     <div class="icon_main">
                        <div class="icon_7"><img src="images/icon-5.png"></div>
                        <h4 class="diabetes_text">Vacunas incluidas en el PAI</h4>
                     </div>
                     <div class="icon_main">
                        <div class="icon_7"><img src="images/icon-6.png"></div>
                        <h4 class="diabetes_text">Seguimiento del proceso PAI</h4>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="contact_box">
                        <h1 class="book_text">FORMULARIO</h1>
                        <input type="text" class="Email_text" placeholder="NOMBRE" name="Name">
                        <input type="text" class="Email_text" placeholder="TEMA" name="Name">
                        <textarea class="massage-bt" placeholder="MENSAJE" rows="5" id="comment" name="Massage"></textarea>
                        <div class="send_bt"><a href="#">ENVIAR</a></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- contact section end -->
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
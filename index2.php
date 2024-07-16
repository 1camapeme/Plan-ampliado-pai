<?php include ("db.php"); ?>
<?php
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
   // Si no está logueado, redirige al usuario a la página de inicio de sesión
   header('Location: index.php');
   exit;
}

?>
<?php include ('includes/header.php'); ?>


<body onload="mostrarNombreArchivo();">

   <?php include ('includes/Menu.php'); ?>
   <!-- header section start -->
   <div class="header_section">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <!-- Mostrar el mensaje de carga -->
         <div id="loading-message" class="alert alert-info" style="display: none;">
            Importando archivo, por favor espere...
         </div>

         <!-- Mostrar el mensaje de carga con el spinner -->
         <div id="loading-overlay">
            <div class="spinner"></div>
            <div id="loading-message">Cargando, por favor espere...</div>
         </div>

      </nav>
      <!-- header section end -->
      <!-- banner section start -->
      <div id="main_slider" class="carousel slide" data-ride="carousel">
         <div class="carousel-inner">
            <div class="carousel-item active">
               <div class="banner_section">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-6">
                           <h1 class="banner_taital">Plan <span style="color: #151515;">PAI</span></h1>
                           <p class="banner_text">Programa Ampliado de Inmunizaciones </p>
                           <br>
                           <br>


                           <div class="row">
                              <div class="col-md-12">
                                 <!-- MESSAGES -->
                                 <?php if (isset($_SESSION['message'])) { ?>
                                    <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show"
                                       role="alert">
                                       <?= $_SESSION['message'] ?>
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <?php session_unset();
                                 } ?>



                                 <!---  carga del arechivo                      -->


                                 <div class="container-input miDiv" onmouseover="cambiarColor()">

                                    <form name="importa" method="post" action="save_task.php"
                                       enctype="multipart/form-data" onsubmit="showLoading()">
                                       <input type="file" name="excel" id="file-5" class="inputfile inputfile-5"
                                          onchange="mostrarNombreArchivo()" required />

                                       <label for="file-5">
                                          <figure style="border:solid; " class="mi">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile mi"
                                                width="20" height="17" viewBox="0 0 20 17">
                                                <path
                                                   d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z">
                                                </path>
                                             </svg>
                                          </figure>


                                          <span id="nombre-archivo" class="iborrainputfile color color1">Seleccionar
                                             archivo</span>
                                       </label>

                                       <div class="boton">
                                          <input type='submit' name='enviar' value="Importar" class="yo mi  ">
                                       </div>

                                       <input type="hidden" value="upload" name="action" />
                                    </form>



                                 </div>

                              </div>
                           </div>


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





   <?php
   // Definir la consulta SQL
   $sql = "SELECT

SUM(CASE WHEN dosis = 'Primera dosis' THEN 1 ELSE 0 END) AS PrimeraDosis,
   SUM(CASE WHEN dosis = 'Segunda dosis' THEN 1 ELSE 0 END) AS SegundaDosis,
   SUM(CASE WHEN dosis = 'Tercera dosis' THEN 1 ELSE 0 END) AS TerceraDosis,
   SUM(CASE WHEN dosis = 'Cuarta Dosis' THEN 1 ELSE 0 END) AS CuartaDosis,
   SUM(CASE WHEN dosis = 'Quinta Dosis' THEN 1 ELSE 0 END) AS QuintaDosis,
   SUM(CASE WHEN dosis = 'Refuerzo' THEN 1 ELSE 0 END) AS Refuerzo,
   SUM(CASE WHEN dosis = 'Primer Refuerzo' THEN 1 ELSE 0 END) AS PrimerRefuerzo,
   SUM(CASE WHEN dosis = 'Segundo Refuerzo' THEN 1 ELSE 0 END) AS SegundoRefuerzo,
   SUM(CASE WHEN dosis = 'Única' THEN 1 ELSE 0 END) AS Unica,
   SUM(CASE WHEN dosis = 'Única_0.5' THEN 1 ELSE 0 END) AS Unica05,
   SUM(CASE WHEN dosis = 'Única_0.25' THEN 1 ELSE 0 END) AS Unica025


 FROM
 (
   SELECT Pol_ina_Dosis AS dosis FROM esquemavacunacion
   UNION ALL
   SELECT Pol_Dosis AS dosis FROM esquemavacunacion
   UNION ALL
   SELECT Pen_Dosis AS dosis FROM esquemavacunacion
   UNION ALL
   SELECT Dpt_Dosis AS dosis FROM esquemavacunacion
   UNION ALL
   SELECT Rot_Dosis AS dosis FROM esquemavacunacion
   UNION ALL
   SELECT Neu_Dosis AS dosis FROM esquemavacunacion
   UNION ALL
   SELECT Srp_Dosis AS dosis FROM esquemavacunacion
   UNION ALL
   SELECT Sr_mul_Dosis AS dosis FROM esquemavacunacion
   UNION ALL
   SELECT Fie_ama_Dosis AS dosis FROM esquemavacunacion
   UNION ALL
   SELECT Hepa_a_ped_Dosis AS dosis FROM esquemavacunacion
   UNION ALL
   SELECT Vari_Dosis AS dosis FROM esquemavacunacion
   UNION ALL
   SELECT Toxoide_tet_Dosis AS dosis FROM esquemavacunacion
   UNION ALL
   SELECT Dtpa_adul_Dosis AS dosis FROM esquemavacunacion
   UNION ALL
   SELECT Influenza_Dosis AS dosis FROM esquemavacunacion
   UNION ALL
   SELECT Vp_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Anti_hum_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Hepat_b_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Penta_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Hexa_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Tetra_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Dpt_ace_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Tox_tet_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Rot_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Neu_con_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Neu_poli_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Tri_vir_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Var_tri_vir_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Fie_amar_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Hepa_a_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Hepa_a_y_b_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Vari_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Toxo_tet_dif_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Dpt_ace_adul_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Infl_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Vph_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Anti_prof_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Meni_con_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Fie_tifo_Dosis FROM esquemavacunacionii
   UNION ALL
   SELECT Her_zos_Dosis FROM esquemavacunacionii
 ) AS dosificaciones";

   // Preparar la consulta
   $stmt = mysqli_prepare($conn, $sql);
   // Comprobar si la preparación fue exitosa
   if (!$stmt) {
      die('Error al preparar la consulta: ' . mysqli_error($conn));
   }
   // Ejecutar la consulta
   mysqli_stmt_execute($stmt);
   // Vincular las variables de resultado
   mysqli_stmt_bind_result(
      $stmt,
      $PrimeraDosis,
      $SegundaDosis,
      $TerceraDosis,
      $CuartaDosis,
      $QuintaDosis,
      $Refuerzo,
      $PrimerRefuerzo,
      $SegundoRefuerzo,
      $Unica,
      $Unica05,
      $Unica025
   );


   ?>


   <!-- health section start -->
   <div id="porfecha" class="health_section layout_padding ">
      <div class="container">
         <h1 class="health_taital">Registro diario</h1>

         <div class="health_section layout_padding">
            <div class="row">



               <!-- resultados -->
               <div class="container">
                  <h1 class="health_text">Total de dosis por fecha</h1>
                  <form id="miFormulario" style=" margin:10px;">
                     <div class="row form-group">
                        <!-- Fecha inicial -->
                        <div class="col-sm">
                           <label for="start" style=" margin:10px;">Fecha inicial</label>
                           <input type="date" id="start" name="start" class="form-control" required>
                        </div>

                        <!-- Fecha final -->
                        <div class="col-sm">
                           <label for="end" style=" margin:10px;">Fecha final</label>
                           <input type="date" id="end" name="end" class="form-control" required>
                        </div>
                     </div>

                     <!-- Botón Consultar -->
                     <div class="row">
                        <div class="col-sm-12 d-flex justify-content-center mt-3">
                           <button type="submit" class="btn btn-primary">Consultar</button>
                        </div>
                     </div>


               </div>
               <div id="resultado" class=" table-responsive" style=" height: 10px; width: 100%; margin-top:20px;">
                  <!-- Los resultados de la consulta se mostrarán aquí -->


               </div>


               <div id="resultados" class=" table-responsive" style="font-size: 80%"
                  style=" height: 10px; width: 100%; margin-top:20px;">
                  <!-- Los resultados de la consulta se mostrarán aquí -->


               </div>





               <script>


                  document.getElementById('miFormulario').addEventListener('submit', function (e) {
                     e.preventDefault(); // Prevenir el comportamiento por defecto del formulario

                     const startDate = document.getElementById('start').value;
                     const endDate = document.getElementById('end').value;

                     const start = new Date(startDate);
                     const end = new Date(endDate);

                     if (end < start) {
                        alert("La fecha final debe ser mayor que la fecha inicial.");
                        return;
                     }

                     fetch('consultar_fechas.php', {
                        method: 'POST',
                        headers: {
                           'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ start: startDate, end: endDate }),
                     })
                        .then(response => response.json())
                        .then(data => {
                           if (data.length === 0) {
                              // Mostrar mensaje cuando no hay datos
                              document.getElementById('resultados').innerHTML = "<p>No se encontraron resultados para las fechas seleccionadas.</p>";

                              return;
                           }

                           // Asumiendo que tienes datos para mostrar, ajusta el tamaño aquí
                           document.getElementById('resultados').style.height = "800px"; // Restablece el tamaño para mostrar los datos
                           document.getElementById('resultados').innerHTML = "<button onclick='exportarTablaExcel()'>Exportar a Excel</button>";

                           let tableHTML = `
                           <button class="btn btn-primary" style="height:25px; width: 130px; font-size:100%;"onclick='exportarTablaExcel()'>Exportar a Excel</button>
                              <table id="tabla" class="table-hover" style="border-collapse: collapse; width: 100%; ">
                                 <tr style="font-size:90%">
                                    <th style="border: 1px solid #999993;">Tipo de Vacuna</th>
                                    <th style="border: 1px solid #999993;">Primera Dosis</th>
                                    <th style="border: 1px solid #999993;">Segunda Dosis</th>
                                    <th style="border: 1px solid #999993;">Tercera Dosis</th>
                                    
                                    <th style="border: 1px solid #999993;">Cuarta Dosis</th>
                                    <th style="border: 1px solid #999993;">Quinta Dosis</th>
                                    <th style="border: 1px solid #999993;">Refuerzo</th>
                                    <th style="border: 1px solid #999993;">Primer Refuerzo</th>
                                    <th style="border: 1px solid #999993;">Segundo Refuerzo</th>
                                    <th style="border: 1px solid #999993;">Única</th>
                                    <th style="border: 1px solid #999993;">Única 0.5</th>
                                    <th style="border: 1px solid #999993;">Única 0.25</th>
                                    <th style="border: 1px solid #999993;">Total</th>
                                 </tr>`;
                           let a3 = 0;
                           data.forEach((row) => {

                              let a1 = row.PrimeraDosis;
                              let a2 = parseInt(a1); // Convierte a1 a entero, asumiendo que es un valor numérico en forma de texto

                              // Verifica si a2 es un número para evitar sumar NaN en caso de que a1 no sea convertible a número
                              if (!isNaN(a2)) {
                                 a3 += a2; // Suma el valor de a2 al acumulador a3
                              }


                              if (row.TipoVacuna === "Anti_hum") {
                                 row.TipoVacuna = "Antirrábica  Humana";
                              }
                              if (row.TipoVacuna === "Anti_prof") {
                                 row.TipoVacuna = "Antirrábica profiláctica";
                              }
                              if (row.TipoVacuna === "Dpt") {
                                 row.TipoVacuna = "Difteria, Tos ferina y Tétanos";
                              }
                              if (row.TipoVacuna === "Dpt_ace") {
                                 row.TipoVacuna = "DPT Acelular pediatrico";
                              }
                              if (row.TipoVacuna === "Dpt_ace_adul") {
                                 row.TipoVacuna = "DPT Acelular adulto";
                              }
                              if (row.TipoVacuna === "Dtpa_adul") {
                                 row.TipoVacuna = "dTpa adulto";
                              }
                              if (row.TipoVacuna === "Fie_ama") {
                                 row.TipoVacuna = "Fiebre amarilla";
                              }
                              if (row.TipoVacuna === "Fie_amar") {
                                 row.TipoVacuna = "Fiebre amarill";
                              }
                              if (row.TipoVacuna === "Fie_tifo") {
                                 row.TipoVacuna = "Fiebre tifoidea";
                              }
                              if (row.TipoVacuna === "Hepat_b") {
                                 row.TipoVacuna = "Hepatitis B";
                              }
                              if (row.TipoVacuna === "Hepa_a") {
                                 row.TipoVacuna = "Hepatitis A";
                              }
                              if (row.TipoVacuna === "Hepa_a_ped") {
                                 row.TipoVacuna = "Hepatitis A pediátrica ";
                              }
                              if (row.TipoVacuna === "Her_zos") {
                                 row.TipoVacuna = "Herpes zoster";
                              }
                              if (row.TipoVacuna === "Hexa") {
                                 row.TipoVacuna = "Hexavalente(DPaT,HiB,HB,VPI)";
                              }
                              if (row.TipoVacuna === "Infl") {
                                 row.TipoVacuna = "Influenza";
                              }
                              if (row.TipoVacuna === "Influenza") {
                                 row.TipoVacuna = "Influenza";
                              }
                              if (row.TipoVacuna === "Meni_con") {
                                 row.TipoVacuna = "Meningococo conjugado";
                              }
                              if (row.TipoVacuna === "Neu") {
                                 row.TipoVacuna = "Neumococo";
                              }
                              if (row.TipoVacuna === "Neu_con") {
                                 row.TipoVacuna = "Neumococo conjugada";
                              }
                              if (row.TipoVacuna === "Neu_poli") {
                                 row.TipoVacuna = "Neumo polisacárido";
                              }
                              if (row.TipoVacuna === "Pen") {
                                 row.TipoVacuna = "Pentavalente";
                              }
                              if (row.TipoVacuna === "Penta") {
                                 row.TipoVacuna = "Pentavalente (DPaT,HiB,VPI)";
                              }
                              if (row.TipoVacuna === "Pol") {
                                 row.TipoVacuna = "Polio (Vacuna oral)";
                              }
                              if (row.TipoVacuna === "Pol_ina") {
                                 row.TipoVacuna = "Polio Inactivado (Vacuna inyectable)";
                              }
                              if (row.TipoVacuna === "Rot") {
                                 row.TipoVacuna = "Rotavirus (vacuna oral)";
                              }
                              if (row.TipoVacuna === "Srp") {
                                 row.TipoVacuna = "Triple viral - SRP";
                              }
                              if (row.TipoVacuna === "Sr_mul") {
                                 row.TipoVacuna = "Sarampión - Rubeola - SR Multidosis";
                              }

                              if (row.TipoVacuna === "Tetra") {
                                 row.TipoVacuna = "Tetravalente (DPaT,VPI)";
                              }
                              if (row.TipoVacuna === "Toxoide_tet") {
                                 row.TipoVacuna = "Toxoide tetánico y diftérico de Adulto";
                              }
                              if (row.TipoVacuna === "Toxo_tet_dif") {
                                 row.TipoVacuna = "Toxoide tetánico/diftérico adultos";
                              }
                              if (row.TipoVacuna === "Tox_tet") {
                                 row.TipoVacuna = "Toxoide tetánico y diftérico (TD) pediátrico";
                              }
                              if (row.TipoVacuna === "Tri_vir") {
                                 row.TipoVacuna = "Triple viral";
                              }
                              if (row.TipoVacuna === "Vari") {
                                 row.TipoVacuna = "Varicela ";
                              }
                              if (row.TipoVacuna === "Var_tri_vir") {
                                 row.TipoVacuna = "Varicela + Triple viral";
                              }
                              if (row.TipoVacuna === "Vp") {
                                 row.TipoVacuna = "VPH ";
                              }
                              if (row.TipoVacuna === "Vph") {
                                 row.TipoVacuna = "VPH ";
                              }

                              let PDosis = parseInt(row.PrimeraDosis);
                              let SDosis = parseInt(row.SegundaDosis);
                              let TDosis = parseInt(row.TerceraDosis);
                              let CDosis = parseInt(row.CuartaDosis);
                              let QDosis = parseInt(row.QuintaDosis);
                              let refuerzo = parseInt(row.Refuerzo);
                              let Prefuerzo = parseInt(row.PrimerRefuerzo);
                              let Srefuerzo = parseInt(row.SegundoRefuerzo);
                              let unica = parseInt(row.Unica);
                              let unica05 = parseInt(row.Unica_05);
                              let unica025 = parseInt(row.Unica_025);
                              let sumaTotal = PDosis + SDosis + TDosis + CDosis + QDosis + refuerzo + Prefuerzo + Srefuerzo +
                                 unica + unica05 + unica025;






                              tableHTML += `
                           <tr style="font-size:90%">
                              <td style="border: 1px solid #999993;">${row.TipoVacuna}</td>
                              <td style="border: 1px solid #999993;">${row.PrimeraDosis ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.SegundaDosis ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.TerceraDosis ?? "Sin resultado"}</td>
                              
                              <td style="border: 1px solid #999993;">${row.CuartaDosis ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.QuintaDosis ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.Refuerzo ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.PrimerRefuerzo ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.SegundoRefuerzo ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.Unica ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.Unica_05 ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.Unica_025 ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${sumaTotal ?? "Sin resultado"}</td>
                             
                             
                           </tr>`;
                           });
                           tableHTML += `</table>`;
                           document.getElementById('resultados').innerHTML = tableHTML;
                           // document.getElementById('resultados').innerHTML ="<button onclick='exportarTablaExcel()'>Exportar a Excel</button>";

                        })
                        .catch((error) => {
                           // Manejo de errores en la petición o en el procesamiento de la respuesta
                           console.error('Error:', error);
                           document.getElementById('resultados').innerHTML = "<p>¡No se suministraron vacunas en ese periodo de tiempo!</p>";
                           document.getElementById('resultados').style.height = "150px"; // Cambia el tamaño cuando no hay datos

                        });



                     fetch('consultar_total_fecha.php', {
                        method: 'POST',
                        headers: {
                           'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ start: startDate, end: endDate }),
                     })
                        .then(response => response.json())
                        .then(data => {
                           if (data.length === null) {
                              // Mostrar mensaje cuando no hay datos
                              document.getElementById('resultado').innerHTML = "<p>No se encontraron resultados para las fechas seleccionadas.</p>";

                              return;
                           }

                           // Asumiendo que tienes datos para mostrar, ajusta el tamaño aquí
                           document.getElementById('resultado').style.height = "100px"; // Restablece el tamaño para mostrar los datos


                           let tableHTML = `
                              <table class="table-hover"style="border-collapse: collapse; width: 100%;">
                                 <tr style="font-size:100%">
                                    
                                    <th style="border: 1px solid #999993;">Primera Dosis</th>
                                    <th style="border: 1px solid #999993;">Segunda Dosis</th>
                                    <th style="border: 1px solid #999993;">Tercera Dosis</th>
                                    
                                    <th style="border: 1px solid #999993;">Cuarta Dosis</th>
                                    <th style="border: 1px solid #999993;">Quinta Dosis</th>
                                    <th style="border: 1px solid #999993;">Refuerzo</th>
                                    <th style="border: 1px solid #999993;">Primer Refuerzo</th>
                                    <th style="border: 1px solid #999993;">Segundo Refuerzo</th>
                                    <th style="border: 1px solid #999993;">Única</th>
                                    <th style="border: 1px solid #999993;">Única 0.5</th>
                                    <th style="border: 1px solid #999993;">Única 0.25</th>
                                 </tr>`;
                           let a3 = 0;
                           data.forEach((row) => {



                              tableHTML += `
                           <tr style="font-size:100%">
                             
                              <td style="border: 1px solid #999993;">${row.PrimeraDosis ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.SegundaDosis ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.TerceraDosis ?? "Sin resultado"}</td>
                              
                              <td style="border: 1px solid #999993;">${row.CuartaDosis ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.QuintaDosis ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.Refuerzo ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.PrimerRefuerzo ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.SegundoRefuerzo ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.Unica ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.Unica_05 ?? "Sin resultado"}</td>
                              <td style="border: 1px solid #999993;">${row.Unica_025 ?? "Sin resultado"}</td>
                             
                           </tr>`;
                           });
                           tableHTML += `</table>`;
                           document.getElementById('resultado').innerHTML = tableHTML;
                        })
                        .catch((error) => {
                           // Manejo de errores en la petición o en el procesamiento de la respuesta
                           console.error('Error:', error);
                           //document.getElementById('resultado').innerHTML ="<button onclick='exportarTablaExcel()'>Exportar a Excel</button>";
                           document.getElementById('resultado').innerHTML = "<p>¡hola No se suministraron vacunas en ese periodo de tiempo!</p>";
                           document.getElementById('resultado').style.height = "10px"; // Cambia el tamaño cuando no hay datos



                        });








                  });


               </script>























            </div>



         </div>
      </div>
   </div>
   </div>
   <!-- health section end -->





   <!-- health section start -->
   <div id="resultadototal" class="health_section layout_padding "
      style=" height: 700px; width: 100%;  Background-color:#d0eef0;">
      <div class="container">
         <h1 class="health_taital">Total de Dosis suministradas</h1>

         <div class="health_section layout_padding">
            <div class="row">
               <div style=" height: 150px; width: 100%; margin-top:10px;" class=" table-responsive">


                  <!-- Los resultados de la consulta se mostrarán aquí -->
                  <table class="table table-bordered table-hover" style="border-collapse: collapse; width: 100%;
background-color: #ffffff;">
                     <tr style="font-size:90%">

                        <th style="border: 1px solid #999993;">Primera Dosis</th>
                        <th style="border: 1px solid #999993;">Segunda Dosis</th>
                        <th style="border: 1px solid #999993;">Tercera Dosis</th>

                        <th style="border: 1px solid #999993;">Cuarta Dosis</th>
                        <th style="border: 1px solid #999993;">Quinta Dosis</th>
                        <th style="border: 1px solid #999993;">Refuerzo</th>
                        <th style="border: 1px solid #999993;">Primer Refuerzo</th>
                        <th style="border: 1px solid #999993;">Segundo Refuerzo</th>
                        <th style="border: 1px solid #999993;">Única</th>
                        <th style="border: 1px solid #999993;">Única 0.5</th>
                        <th style="border: 1px solid #999993;">Única 0.25</th>




                     </tr>


                     <?php
                     // Obtener los resultados
                     if (mysqli_stmt_fetch($stmt)) {

                        ?>

                        <tr style="font-size:80%">


                           <td style="border: 1px solid #999993;">
                              <?php echo $PrimeraDosis; ?>
                           </td>
                           <td style="border: 1px solid #999993;">
                              <?php echo $SegundaDosis; ?>
                           </td>
                           <td style="border: 1px solid #999993;">
                              <?php echo $TerceraDosis; ?>
                           </td>
                           <td style="border: 1px solid #999993;">
                              <?php echo $CuartaDosis; ?>
                           </td>
                           <td style="border: 1px solid #999993;">
                              <?php echo $QuintaDosis; ?>
                           </td>
                           <td style="border: 1px solid #999993;">
                              <?php echo $Refuerzo; ?>
                           </td>
                           <td style="border: 1px solid #999993;">
                              <?php echo $PrimerRefuerzo; ?>
                           </td>
                           <td style="border: 1px solid #999993;">
                              <?php echo $SegundoRefuerzo; ?>
                           </td>
                           <td style="border: 1px solid #999993;">
                              <?php echo $Unica; ?>
                           </td>
                           <td style="border: 1px solid #999993;">
                              <?php echo $Unica05; ?>
                           </td>
                           <td style="border: 1px solid #999993;">
                              <?php echo $Unica025; ?>
                           </td>
                        </tr>
                     <?php } else { ?>
                        <p>No se encontraron resultados.</p>
                     <?php }
                     // Liberar el statement
                     mysqli_stmt_close($stmt);
                     ?>
                  </table>


               </div>
            </div>
         </div>
      </div>
   </div>


   <!-- health section start -->


   <button id="btnSubir">&#8679;</button>





   <script>
      // Cuando el usuario desplaza 20px desde la parte superior del documento, muestra el botón
      window.onscroll = function () { mostrarBotonSubir() };

      function mostrarBotonSubir() {
         if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("btnSubir").style.display = "block";
         } else {
            document.getElementById("btnSubir").style.display = "none";
         }
      }

      // Cuando el usuario hace clic en el botón, desplaza hacia el inicio de la página
      document.getElementById("btnSubir").onclick = function () { subirInicio() };

      function subirInicio() {
         document.body.scrollTop = 0; // Para Safari
         document.documentElement.scrollTop = 0; // Para Chrome, Firefox, IE y Opera
      }
   </script>

   <!---tabla exel-->
   <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
   <script>
      function exportarTablaExcel() {
         /* Obtiene la tabla HTML */
         let tabla = document.getElementById("tabla");
         /* Usa SheetJS para convertir de HTML a hoja de trabajo */
         let ws = XLSX.utils.table_to_sheet(tabla);
         /* Crea un libro de trabajo y añade la hoja de trabajo */
         let wb = XLSX.utils.book_new();
         XLSX.utils.book_append_sheet(wb, ws, "Hoja1");
         /* Guarda el archivo */
         XLSX.writeFile(wb, "Conteo-por-fecha.xlsx");
      }
   </script>












   <!-- footer inicio -->
   <?php include ('includes/fin.php'); ?>
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

   <!-- Script para mostrar el mensaje de carga -->
   <script>

      function showLoading() {
         document.getElementById('loading-overlay').style.display = 'flex';
         document.body.classList.add('loading-overlay-active');
      }

      function hideLoading() {
         document.getElementById('loading-overlay').style.display = 'none';
         document.body.classList.remove('loading-overlay-active');
      }
      /*mostrar mensaje de archivo seleccionado */
      function mostrarNombreArchivo() {
         var inputFile = document.getElementById('file-5');
         var nombreArchivoDiv = document.getElementById('nombre-archivo');

         if (inputFile.files.length > 0) {
            var nombreArchivo = inputFile.files[0].name;
            nombreArchivoDiv.innerHTML = 'Archivo seleccionado: ' + nombreArchivo;
            cambiarColor();
            function cambiarColor() {
               // Corregir el selector 'color1' a '.color1' y agregar comillas al color 'blue'
               document.querySelector('.color1').style.color = '#525555';
            }
         } else {
            nombreArchivoDiv.innerHTML = 'Sin archivos seleccionado';
         }
      }

      function cambiarColor() {
         document.querySelector('.miDiv');
      }

      function cambiarColor() {
         document.querySelector('.miDiv1', 'color');
      }   </script>


</body>

</html>
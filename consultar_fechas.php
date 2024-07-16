<?php

include("db.php");

// Leer los datos enviados mediante POST desde AJAX
$data = json_decode(file_get_contents("php://input"), true);
$startDate = $data['start'];
$endDate = $data['end'];

// Preparar y ejecutar la consulta actualizada
$query = "

SELECT
  TipoVacuna,
  SUM(CASE WHEN dosis LIKE 'Primera dosis' THEN 1 ELSE 0 END) AS PrimeraDosis,
  SUM(CASE WHEN dosis LIKE 'Segunda dosis' THEN 1 ELSE 0 END) AS SegundaDosis,
  SUM(CASE WHEN dosis LIKE 'Tercera dosis' THEN 1 ELSE 0 END) AS TerceraDosis,
  SUM(CASE WHEN dosis LIKE 'Refuerzo' THEN 1 ELSE 0 END) AS Refuerzo,
  SUM(CASE WHEN dosis LIKE 'Primer Refuerzo' THEN 1 ELSE 0 END) AS PrimerRefuerzo,
  SUM(CASE WHEN dosis LIKE 'Segundo Refuerzo' THEN 1 ELSE 0 END) AS SegundoRefuerzo,
  SUM(CASE WHEN dosis LIKE 'Única' THEN 1 ELSE 0 END) AS Unica,
  SUM(CASE WHEN dosis LIKE 'Única_0.5' THEN 1 ELSE 0 END) AS Unica_05,
  SUM(CASE WHEN dosis LIKE 'Única_0.25' THEN 1 ELSE 0 END) AS Unica_025,
  SUM(CASE WHEN dosis LIKE 'Cuarta dosis' THEN 1 ELSE 0 END) AS CuartaDosis,
  SUM(CASE WHEN dosis LIKE 'Quinta dosis' THEN 1 ELSE 0 END) AS QuintaDosis
FROM (

  SELECT  esquemavacunacion.Pol_ina_Dosis AS dosis, 'Pol_ina' AS TipoVacuna FROM esquemavacunacion
  INNER JOIN datosusuario ON esquemavacunacion.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacion.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacion.Pol_Dosis, 'Pol' AS TipoVacuna FROM esquemavacunacion
  INNER JOIN datosusuario ON esquemavacunacion.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacion.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacion.Pen_Dosis, 'Pen' AS TipoVacuna FROM esquemavacunacion
  INNER JOIN datosusuario ON esquemavacunacion.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacion.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacion.Dpt_Dosis, 'Dpt' AS TipoVacuna FROM esquemavacunacion
  INNER JOIN datosusuario ON esquemavacunacion.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacion.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacion.Rot_Dosis, 'Rot' AS TipoVacuna FROM esquemavacunacion
  INNER JOIN datosusuario ON esquemavacunacion.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacion.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacion.Neu_Dosis, 'Neu' AS TipoVacuna FROM esquemavacunacion
  INNER JOIN datosusuario ON esquemavacunacion.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacion.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacion.Srp_Dosis, 'Srp' AS TipoVacuna FROM esquemavacunacion
  INNER JOIN datosusuario ON esquemavacunacion.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacion.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacion.Sr_mul_Dosis, 'Sr_mul' AS TipoVacuna FROM esquemavacunacion
  INNER JOIN datosusuario ON esquemavacunacion.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacion.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacion.Fie_ama_Dosis, 'Fie_ama' AS TipoVacuna FROM esquemavacunacion
  INNER JOIN datosusuario ON esquemavacunacion.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacion.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacion.Hepa_a_ped_Dosis, 'Hepa_a_ped' AS TipoVacuna FROM esquemavacunacion
  INNER JOIN datosusuario ON esquemavacunacion.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacion.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacion.Vari_Dosis, 'Vari' AS TipoVacuna FROM esquemavacunacion
  INNER JOIN datosusuario ON esquemavacunacion.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacion.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacion.Toxoide_tet_Dosis, 'Toxoide_tet' AS TipoVacuna FROM esquemavacunacion
  INNER JOIN datosusuario ON esquemavacunacion.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacion.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacion.Dtpa_adul_Dosis, 'Dtpa_adul' AS TipoVacuna FROM esquemavacunacion
  INNER JOIN datosusuario ON esquemavacunacion.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacion.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacion.Influenza_Dosis, 'Influenza' AS TipoVacuna FROM esquemavacunacion
  INNER JOIN datosusuario ON esquemavacunacion.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacion.fechaAtencion BETWEEN ? AND ?
  UNION ALL

  SELECT  esquemavacunacionii.Vp_Dosis AS dosis, 'Vp' AS TipoVacuna FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Anti_hum_Dosis, 'Anti_hum' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Hepat_b_Dosis, 'Hepat_b' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Penta_Dosis, 'Penta' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Hexa_Dosis, 'Hexa' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Tetra_Dosis, 'Tetra' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Dpt_ace_Dosis, 'Dpt_ace' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Tox_tet_Dosis, 'Tox_tet' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Rot_Dosis, 'Rot' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Neu_con_Dosis, 'Neu_con' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Neu_poli_Dosis, 'Neu_poli' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Tri_vir_Dosis, 'Tri_vir' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Var_tri_vir_Dosis, 'Var_tri_vir' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  
  SELECT  esquemavacunacionii.Hepa_a_Dosis, 'Hepa_a' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Hepa_a_y_b_Dosis, 'Hepa_a_y_b' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Vari_Dosis, 'Vari' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Toxo_tet_dif_Dosis, 'Toxo_tet_dif' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Dpt_ace_adul_Dosis, 'Dpt_ace_adul' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  
  
  SELECT  esquemavacunacionii.Anti_prof_Dosis, 'Anti_prof' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Meni_con_Dosis, 'Meni_con' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Fie_tifo_Dosis, 'Fie_tifo' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
  UNION ALL
  SELECT  esquemavacunacionii.Her_zos_Dosis, 'Her_zos' FROM esquemavacunacionii
  INNER JOIN datosusuario ON esquemavacunacionii.documentoPaciente = datosusuario.documento
  WHERE esquemavacunacionii.fechaAtencion BETWEEN ? AND ?
) AS dosificaciones
GROUP BY TipoVacuna


";

$stmt = mysqli_prepare($conn, $query);
// Asegúrate de pasar las fechas dos veces por cada parte de la consulta que requiere el rango de fechas
mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss", $startDate, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate
, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate
, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate
, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate
, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate
, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate
, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate
, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate
, $endDate);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Devolver los resultados en formato JSON
if ($row = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
    echo json_encode($row);
} else {
    echo json_encode(array('error' => 'No se encontraron resultados.'));
}

// Cerrar conexión
mysqli_close($conn);
?>

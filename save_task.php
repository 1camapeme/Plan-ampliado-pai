<?php

include ('db.php');


extract($_POST);
$errores = 0; // Inicializar la variable $errores
$errores = 0; // Inicializar la variable $errores
if ($action == "upload") {
    $archivo = $_FILES['excel']['name'];
    $tipo = $_FILES['excel']['type'];
    $destino = "bak_" . $archivo;

    if (copy($_FILES['excel']['tmp_name'], $destino)) {
        echo "Archivo Cargado Con Éxito";
    } else {
        echo "Error Al Cargar el Archivo";
    }

    if (file_exists("bak_" . $archivo)) {
        require_once ('Classes/PHPExcel.php');
        require_once ('Classes/PHPExcel/Reader/Excel2007.php');

        try {
            $objReader = new PHPExcel_Reader_Excel2007();
            // Intenta cargar el archivo Excel
            $objPHPExcel = $objReader->load("bak_" . $archivo);

            // Comprueba si el archivo tiene al menos una hoja
            if ($objPHPExcel->getSheetCount() < 1) {
                throw new Exception('El documento no contiene ninguna hoja.');
            }

            $objPHPExcel->setActiveSheetIndex(1);
            $objFecha = new PHPExcel_Shared_Date();

            // Aquí sigue el resto de tu código de manejo del archivo Excel...
            // Asegúrate de que este código maneja correctamente el archivo Excel cargado

        } catch (Exception $e) {
            // Maneja la excepción mostrando un mensaje de alerta y redirigiendo
            echo "<script type='text/javascript'>
                    alert('El documento no tiene el formato correcto. ¡Vuelve a intentarlo!');
                    window.location.href = 'index.php';
                  </script>";
            exit;
        }

        

      


        if (!$conn) {
            die ('Error al conectar a la base de datos: ' . mysqli_connect_error());
        }

        for ($i = 3; $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue() != ""; $i++) {
            $Consecutivo = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();

            $fechaAtencionValue = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            if ($fechaAtencionValue === null || $fechaAtencionValue === '') {
                $fechaAtencion = null;
            } else {
                $fechaAtencion = ExcelToPHPDate($fechaAtencionValue);
            }


            $tipoIdentificacion = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $documento = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
            $pNombre = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
            $sNombre = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();

            $fechaNacimientoValue = $objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue();
            if ($fechaNacimientoValue === null || $fechaNacimientoValue === '') {
                $fechaNacimiento = null;
            } else {
                $fechaNacimiento = ExcelToPHPDate($fechaNacimientoValue);
            }



            $años = $objPHPExcel->getActiveSheet()->getCell('J' . $i)->getOldCalculatedValue();
            $años = is_numeric($años) ? $años : 0;


            $meses = $objPHPExcel->getActiveSheet()->getCell('K' . $i)->getOldCalculatedValue();
            $meses = is_numeric($meses) ? $meses : 0;
            $dias = $objPHPExcel->getActiveSheet()->getCell('L' . $i)->getOldCalculatedValue();
            $dias = is_numeric($dias) ? $dias : 0;
            $totalMeses = $objPHPExcel->getActiveSheet()->getCell('M' . $i)->getOldCalculatedValue();
            $totalMeses = is_numeric($totalMeses) ? $totalMeses : 0;


            $esquemaC = $objPHPExcel->getActiveSheet()->getCell('N' . $i)->getCalculatedValue();
            $sexo = $objPHPExcel->getActiveSheet()->getCell('O' . $i)->getCalculatedValue();
            $genero = $objPHPExcel->getActiveSheet()->getCell('P' . $i)->getCalculatedValue();

            $oSexual = $objPHPExcel->getActiveSheet()->getCell('Q' . $i)->getCalculatedValue();
            $eGesticion = $objPHPExcel->getActiveSheet()->getCell('R' . $i)->getCalculatedValue();
            $paisNacimiento = $objPHPExcel->getActiveSheet()->getCell('S' . $i)->getCalculatedValue();
            $estatusMigratorio = $objPHPExcel->getActiveSheet()->getCell('T' . $i)->getOldCalculatedValue();
            $lugarAtencionP = $objPHPExcel->getActiveSheet()->getCell('U' . $i)->getCalculatedValue();
            $regimenAfi = $objPHPExcel->getActiveSheet()->getCell('V' . $i)->getCalculatedValue();
            $aseguradora = $objPHPExcel->getActiveSheet()->getCell('W' . $i)->getCalculatedValue();

            $pEtnica = $objPHPExcel->getActiveSheet()->getCell('X' . $i)->getCalculatedValue();
            $desplazado = $objPHPExcel->getActiveSheet()->getCell('Y' . $i)->getCalculatedValue();
            $descapacitado = $objPHPExcel->getActiveSheet()->getCell('Z' . $i)->getCalculatedValue();
            $fallecido = $objPHPExcel->getActiveSheet()->getCell('AA' . $i)->getCalculatedValue();
            $vdcArmado = $objPHPExcel->getActiveSheet()->getCell('AB' . $i)->getCalculatedValue();
            $EstudianteA = $objPHPExcel->getActiveSheet()->getCell('AC' . $i)->getCalculatedValue();
            $PaisR = $objPHPExcel->getActiveSheet()->getCell('AD' . $i)->getCalculatedValue();
            $departamentoR = $objPHPExcel->getActiveSheet()->getCell('AE' . $i)->getCalculatedValue();
            $municipioR = $objPHPExcel->getActiveSheet()->getCell('AF' . $i)->getCalculatedValue();
            $localidad = $objPHPExcel->getActiveSheet()->getCell('AG' . $i)->getCalculatedValue();
            $Area = $objPHPExcel->getActiveSheet()->getCell('AH' . $i)->getCalculatedValue();
            $direccionN = $objPHPExcel->getActiveSheet()->getCell('AI' . $i)->getCalculatedValue();
            $telefonoF = $objPHPExcel->getActiveSheet()->getCell('AJ' . $i)->getCalculatedValue();
            $celular = $objPHPExcel->getActiveSheet()->getCell('AK' . $i)->getCalculatedValue();

            $email = $objPHPExcel->getActiveSheet()->getCell('AL' . $i)->getCalculatedValue();
            $aLLamadaT = $objPHPExcel->getActiveSheet()->getCell('AM' . $i)->getCalculatedValue();
            $aEnvioC = $objPHPExcel->getActiveSheet()->getCell('AN' . $i)->getCalculatedValue();

            $hsEventoAdverso = $objPHPExcel->getActiveSheet()->getCell('AO' . $i)->getCalculatedValue();
            $cualEventoAdverso = $objPHPExcel->getActiveSheet()->getCell('AP' . $i)->getCalculatedValue();
            $ha_presentado_reaccion = $objPHPExcel->getActiveSheet()->getCell('AQ' . $i)->getCalculatedValue();
            $cual_reaccion = $objPHPExcel->getActiveSheet()->getCell('AR' . $i)->getCalculatedValue();
            $condicion_usuaria = $objPHPExcel->getActiveSheet()->getCell('AS' . $i)->getCalculatedValue();

            $g_fecha_uMestruacionValue = $objPHPExcel->getActiveSheet()->getCell('AT' . $i)->getCalculatedValue();
            // / Verificar si la celda está vacía
            if ($g_fecha_uMestruacionValue === null || $g_fecha_uMestruacionValue === '') {
                $g_fecha_uMestruacion = ''; // O cualquier valor predeterminado que desees para una celda vacía
            } else {
                // La celda tiene un valor, conviértelo a formato de fecha
                $g_fecha_uMestruacion = ExcelToPHPDate($g_fecha_uMestruacionValue);
            }
            // Ahora $g_fecha_uMestruacion contendrá la fecha convertida o el valor predeterminado si la celda está vacía

            $SemanasGestación = $objPHPExcel->getActiveSheet()->getCell('AU' . $i)->getOldCalculatedValue();
            $SemanasGestación = is_numeric($SemanasGestación) ? $SemanasGestación : 0;


            if ($g_fecha_uMestruacionValue === null || $g_fecha_uMestruacionValue === '') {
                $FprobableParto = ''; // O cualquier valor predeterminado que desees para una celda vacía
            } else {
                // La celda tiene un valor, conviértelo a formato de fecha
                $g_fecha_uMestruacion = ExcelToPHPDate($g_fecha_uMestruacionValue);
                // Parsear la fecha inicial
                $fechaInicial = new DateTime($g_fecha_uMestruacion);
                // Sumar 280 días
                $fechaProbableParto = $fechaInicial->add(new DateInterval('P280D'));
                // Obtener la fecha en formato deseado
                $FprobableParto = $fechaProbableParto->format('Y-m-d');
            }


            $Con_usu_Cantidad_de_embarazos_previos = $objPHPExcel->getActiveSheet()->getCell('AW' . $i)->getCalculatedValue();
            $Dat_mad_Tipo_de_identificacion = $objPHPExcel->getActiveSheet()->getCell('BB' . $i)->getCalculatedValue();
            $Dat_mad_Numero_de_identificacion = $objPHPExcel->getActiveSheet()->getCell('BC' . $i)->getCalculatedValue();
            $Dat_mad_Primer_nombre = $objPHPExcel->getActiveSheet()->getCell('BD' . $i)->getCalculatedValue();
            $Dat_mad_Segundo_nombre = $objPHPExcel->getActiveSheet()->getCell('BE' . $i)->getCalculatedValue();

            $Dat_mad_Primer_apellido = $objPHPExcel->getActiveSheet()->getCell('BF' . $i)->getCalculatedValue();
            $Dat_mad_Segundo_apellido = $objPHPExcel->getActiveSheet()->getCell('BG' . $i)->getCalculatedValue();
            $Dat_mad_Correo_electrónico = $objPHPExcel->getActiveSheet()->getCell('BH' . $i)->getCalculatedValue();
            $Dat_mad_Indicativo_más_teléfono_fijo = $objPHPExcel->getActiveSheet()->getCell('BI' . $i)->getCalculatedValue();
            $Dat_mad_Celular = $objPHPExcel->getActiveSheet()->getCell('BJ' . $i)->getCalculatedValue();



            $Dat_mad_Regimen_de_afiliacion = $objPHPExcel->getActiveSheet()->getCell('BK' . $i)->getCalculatedValue();
            $Dat_mad_Pertenencia_etnica = $objPHPExcel->getActiveSheet()->getCell('BL' . $i)->getCalculatedValue();
            $Dat_mad_Desplazado = $objPHPExcel->getActiveSheet()->getCell('BM' . $i)->getCalculatedValue();
            $Dat_cui_Tipo_de_identificacion = $objPHPExcel->getActiveSheet()->getCell('BN' . $i)->getCalculatedValue();
            $Dat_cui_Numero_de_identificacion = $objPHPExcel->getActiveSheet()->getCell('BO' . $i)->getCalculatedValue();

            $Dat_cui_Primer_nombre = $objPHPExcel->getActiveSheet()->getCell('BP' . $i)->getCalculatedValue();
            $Dat_cui_Segundo_nombre = $objPHPExcel->getActiveSheet()->getCell('BQ' . $i)->getCalculatedValue();
            $Dat_cui_Primer_apellido = $objPHPExcel->getActiveSheet()->getCell('BR' . $i)->getCalculatedValue();
            $Dat_cui_Segundo_apellido = $objPHPExcel->getActiveSheet()->getCell('BS' . $i)->getCalculatedValue();
            $Dat_cui_Parentesco = $objPHPExcel->getActiveSheet()->getCell('BT' . $i)->getCalculatedValue();
            $Dat_cui_Correo_electronico = $objPHPExcel->getActiveSheet()->getCell('BU' . $i)->getCalculatedValue();
            $Dat_cui_Indicativo_mas_telefono_fijo = $objPHPExcel->getActiveSheet()->getCell('BV' . $i)->getCalculatedValue();
            $Dat_cui_Celular = $objPHPExcel->getActiveSheet()->getCell('BW' . $i)->getCalculatedValue();





            $Esq_vac_Tipo_de_carnet = $objPHPExcel->getActiveSheet()->getCell('BX' . $i)->getCalculatedValue();

            $Pol_ina_Dosis = $objPHPExcel->getActiveSheet()->getCell('CP' . $i)->getCalculatedValue();
            $Pol_ina_Lote = $objPHPExcel->getActiveSheet()->getCell('CQ' . $i)->getCalculatedValue();
            $Pol_ina_Jeringa = $objPHPExcel->getActiveSheet()->getCell('CR' . $i)->getCalculatedValue();
            $Pol_ina_Lote_jeringa = $objPHPExcel->getActiveSheet()->getCell('CS' . $i)->getCalculatedValue();
            $Pol_ina_Observacion = $objPHPExcel->getActiveSheet()->getCell('CT' . $i)->getCalculatedValue();

            $Pol_Dosis = $objPHPExcel->getActiveSheet()->getCell('CU' . $i)->getCalculatedValue();
            $Pol_Lote = $objPHPExcel->getActiveSheet()->getCell('CV' . $i)->getCalculatedValue();
            $Pol_Gotero = $objPHPExcel->getActiveSheet()->getCell('CW' . $i)->getCalculatedValue();

            $Pen_Dosis = $objPHPExcel->getActiveSheet()->getCell('CX' . $i)->getCalculatedValue();
            $Pen_Lote = $objPHPExcel->getActiveSheet()->getCell('CY' . $i)->getCalculatedValue();
            $Pen_Jeringa = $objPHPExcel->getActiveSheet()->getCell('CZ' . $i)->getCalculatedValue();
            $Pen_Lote_jeringa = $objPHPExcel->getActiveSheet()->getCell('DA' . $i)->getCalculatedValue();
            $Pen_Observacion = $objPHPExcel->getActiveSheet()->getCell('DB' . $i)->getCalculatedValue();

            $Dpt_Dosis = $objPHPExcel->getActiveSheet()->getCell('DG' . $i)->getCalculatedValue();
            $Dpt_Lote = $objPHPExcel->getActiveSheet()->getCell('DH' . $i)->getCalculatedValue();
            $Dpt_Jeringa = $objPHPExcel->getActiveSheet()->getCell('DI' . $i)->getCalculatedValue();
            $Dpt_Lote_jeringa = $objPHPExcel->getActiveSheet()->getCell('DJ' . $i)->getCalculatedValue();

            $Rot_Dosis = $objPHPExcel->getActiveSheet()->getCell('DS' . $i)->getCalculatedValue();
            $Rot_Lote = $objPHPExcel->getActiveSheet()->getCell('DT' . $i)->getCalculatedValue();

            $Neu_Tipo_neumococo = $objPHPExcel->getActiveSheet()->getCell('DU' . $i)->getCalculatedValue();
            $Neu_Dosis = $objPHPExcel->getActiveSheet()->getCell('DV' . $i)->getCalculatedValue();
            $Neu_Lote = $objPHPExcel->getActiveSheet()->getCell('DW' . $i)->getCalculatedValue();
            $Neu_Jeringa = $objPHPExcel->getActiveSheet()->getCell('DX' . $i)->getCalculatedValue();
            $Neu_Lote_jeringa = $objPHPExcel->getActiveSheet()->getCell('DY' . $i)->getCalculatedValue();

            $Srp_Dosis = $objPHPExcel->getActiveSheet()->getCell('DZ' . $i)->getCalculatedValue();
            $Srp_Lote = $objPHPExcel->getActiveSheet()->getCell('EA' . $i)->getCalculatedValue();
            $Srp_Jeringa = $objPHPExcel->getActiveSheet()->getCell('EB' . $i)->getCalculatedValue();
            $Srp_Lote_jeringa = $objPHPExcel->getActiveSheet()->getCell('EC' . $i)->getCalculatedValue();
            $Srp_Lote_diluyente = $objPHPExcel->getActiveSheet()->getCell('ED' . $i)->getCalculatedValue();

            $Sr_mul_Dosis = $objPHPExcel->getActiveSheet()->getCell('EE' . $i)->getCalculatedValue();
            $Sr_mul_Lote = $objPHPExcel->getActiveSheet()->getCell('EF' . $i)->getCalculatedValue();
            $Sr_mul_Jeringa = $objPHPExcel->getActiveSheet()->getCell('EG' . $i)->getCalculatedValue();
            $Sr_mul_Lote_jeringa = $objPHPExcel->getActiveSheet()->getCell('EH' . $i)->getCalculatedValue();
            $Sr_mul_Lote_diluyente = $objPHPExcel->getActiveSheet()->getCell('EI' . $i)->getCalculatedValue();

            $Fie_ama_Dosis = $objPHPExcel->getActiveSheet()->getCell('EJ' . $i)->getCalculatedValue();
            $Fie_ama_Lote = $objPHPExcel->getActiveSheet()->getCell('EK' . $i)->getCalculatedValue();
            $Fie_ama_Jeringa = $objPHPExcel->getActiveSheet()->getCell('EL' . $i)->getCalculatedValue();
            $Fie_ama_Lote_jeringa = $objPHPExcel->getActiveSheet()->getCell('EM' . $i)->getCalculatedValue();
            $Fie_ama_Lote_diluyente = $objPHPExcel->getActiveSheet()->getCell('EN' . $i)->getCalculatedValue();


            $Hepa_a_ped_Dosis = $objPHPExcel->getActiveSheet()->getCell('EO' . $i)->getCalculatedValue();
            $Hepa_a_ped_Lote = $objPHPExcel->getActiveSheet()->getCell('EP' . $i)->getCalculatedValue();
            $Hepa_a_ped_Jeringa = $objPHPExcel->getActiveSheet()->getCell('EQ' . $i)->getCalculatedValue();
            $Hepa_a_ped_Lote_jeringa = $objPHPExcel->getActiveSheet()->getCell('ER' . $i)->getCalculatedValue();

            $Vari_Dosis = $objPHPExcel->getActiveSheet()->getCell('ES' . $i)->getCalculatedValue();
            $Vari_Lote = $objPHPExcel->getActiveSheet()->getCell('ET' . $i)->getCalculatedValue();
            $Vari_Jeringa = $objPHPExcel->getActiveSheet()->getCell('EU' . $i)->getCalculatedValue();
            $Vari_Lote_jeringa = $objPHPExcel->getActiveSheet()->getCell('EV' . $i)->getCalculatedValue();
            $Vari_Lote_diluyente = $objPHPExcel->getActiveSheet()->getCell('EW' . $i)->getCalculatedValue();

            $Toxoide_tet_Dosis = $objPHPExcel->getActiveSheet()->getCell('EX' . $i)->getCalculatedValue();
            $Toxoide_tet_Lote = $objPHPExcel->getActiveSheet()->getCell('EY' . $i)->getCalculatedValue();
            $Toxoide_tet_Jeringa = $objPHPExcel->getActiveSheet()->getCell('EZ' . $i)->getCalculatedValue();
            $Toxoide_tet_Lote_jeringa = $objPHPExcel->getActiveSheet()->getCell('FA' . $i)->getCalculatedValue();

            $Dtpa_adul_Dosis = $objPHPExcel->getActiveSheet()->getCell('FB' . $i)->getCalculatedValue();
            $Dtpa_adul_Lote = $objPHPExcel->getActiveSheet()->getCell('FC' . $i)->getCalculatedValue();
            $Dtpa_adul_Jeringa = $objPHPExcel->getActiveSheet()->getCell('FD' . $i)->getCalculatedValue();
            $Dtpa_adul_Lote_jeringa = $objPHPExcel->getActiveSheet()->getCell('FE' . $i)->getCalculatedValue();

            $Influenza_Dosis = $objPHPExcel->getActiveSheet()->getCell('FF' . $i)->getCalculatedValue();
            $Influenza_Lote = $objPHPExcel->getActiveSheet()->getCell('FG' . $i)->getCalculatedValue();
            $Influenza_Jeringa = $objPHPExcel->getActiveSheet()->getCell('FH' . $i)->getCalculatedValue();
            $Influenza_Lote_jeringa = $objPHPExcel->getActiveSheet()->getCell('FI' . $i)->getCalculatedValue();
            $Influenza_Observacion = $objPHPExcel->getActiveSheet()->getCell('FJ' . $i)->getCalculatedValue();

            $Vp_Dosis = $objPHPExcel->getActiveSheet()->getCell('FK' . $i)->getCalculatedValue();
            $Vp_Lote = $objPHPExcel->getActiveSheet()->getCell('FL' . $i)->getCalculatedValue();
            $Vp_Jeringa = $objPHPExcel->getActiveSheet()->getCell('FM' . $i)->getCalculatedValue();
            $Vp_Lote_jeringa = $objPHPExcel->getActiveSheet()->getCell('FN' . $i)->getCalculatedValue();

            $Anti_hum_Dosis = $objPHPExcel->getActiveSheet()->getCell('FO' . $i)->getCalculatedValue();
            $Anti_hum_Lote = $objPHPExcel->getActiveSheet()->getCell('FP' . $i)->getCalculatedValue();
            $Anti_hum_Jeringa = $objPHPExcel->getActiveSheet()->getCell('FQ' . $i)->getCalculatedValue();
            $Anti_hum_Lote_jeringa = $objPHPExcel->getActiveSheet()->getCell('FR' . $i)->getCalculatedValue();
            $Anti_hum_Lote_diluyente = $objPHPExcel->getActiveSheet()->getCell('FS' . $i)->getCalculatedValue();
            $Anti_hum_Observacion = $objPHPExcel->getActiveSheet()->getCell('FT' . $i)->getCalculatedValue();

            $Hepat_b_Dosis = $objPHPExcel->getActiveSheet()->getCell('GO' . $i)->getCalculatedValue();
            $Hepat_b_Lote = $objPHPExcel->getActiveSheet()->getCell('GP' . $i)->getCalculatedValue();

            $Penta_Dosis = $objPHPExcel->getActiveSheet()->getCell('GQ' . $i)->getCalculatedValue();
            $Penta_Lote = $objPHPExcel->getActiveSheet()->getCell('GR' . $i)->getCalculatedValue();

            $Hexa_Dosis = $objPHPExcel->getActiveSheet()->getCell('GS' . $i)->getCalculatedValue();
            $Hexa_Lote = $objPHPExcel->getActiveSheet()->getCell('GT' . $i)->getCalculatedValue();

            $Tetra_Dosis = $objPHPExcel->getActiveSheet()->getCell('GU' . $i)->getCalculatedValue();
            $Tetra_Lote = $objPHPExcel->getActiveSheet()->getCell('GV' . $i)->getCalculatedValue();

            $Dpt_ace_Dosis = $objPHPExcel->getActiveSheet()->getCell('GW' . $i)->getCalculatedValue();
            $Dpt_ace_Lote = $objPHPExcel->getActiveSheet()->getCell('GX' . $i)->getCalculatedValue();

            $Tox_tet_Dosis = $objPHPExcel->getActiveSheet()->getCell('GV' . $i)->getCalculatedValue();
            $Tox_tet_Lote = $objPHPExcel->getActiveSheet()->getCell('GZ' . $i)->getCalculatedValue();

            $Rot_Dosis = $objPHPExcel->getActiveSheet()->getCell('HA' . $i)->getCalculatedValue();
            $Rot_Lote = $objPHPExcel->getActiveSheet()->getCell('HB' . $i)->getCalculatedValue();

            $Neu_con_Dosis = $objPHPExcel->getActiveSheet()->getCell('HC' . $i)->getCalculatedValue();
            $Neu_con_Lote = $objPHPExcel->getActiveSheet()->getCell('HD' . $i)->getCalculatedValue();

            $Neu_poli_Dosis = $objPHPExcel->getActiveSheet()->getCell('HE' . $i)->getCalculatedValue();
            $Neu_poli_Lote = $objPHPExcel->getActiveSheet()->getCell('HF' . $i)->getCalculatedValue();

            $Tri_vir_Dosis = $objPHPExcel->getActiveSheet()->getCell('HG' . $i)->getCalculatedValue();
            $Tri_vir_Lote = $objPHPExcel->getActiveSheet()->getCell('HH' . $i)->getCalculatedValue();

            $Var_tri_vir_Dosis = $objPHPExcel->getActiveSheet()->getCell('HI' . $i)->getCalculatedValue();
            $Var_tri_vir_Lote = $objPHPExcel->getActiveSheet()->getCell('HJ' . $i)->getCalculatedValue();

            $Fie_amar_Dosis = $objPHPExcel->getActiveSheet()->getCell('HK' . $i)->getCalculatedValue();
            $Fie_amar_Lote = $objPHPExcel->getActiveSheet()->getCell('HL' . $i)->getCalculatedValue();

            $Hepa_a_Dosis = $objPHPExcel->getActiveSheet()->getCell('HM' . $i)->getCalculatedValue();
            $Hepa_a_Lote = $objPHPExcel->getActiveSheet()->getCell('HN' . $i)->getCalculatedValue();

            $Hepa_a_y_b_Dosis = $objPHPExcel->getActiveSheet()->getCell('HO' . $i)->getCalculatedValue();
            $Hepa_a_y_b_Lote = $objPHPExcel->getActiveSheet()->getCell('HP' . $i)->getCalculatedValue();

            $Vari_Dosis = $objPHPExcel->getActiveSheet()->getCell('HQ' . $i)->getCalculatedValue();
            $Vari_Lote = $objPHPExcel->getActiveSheet()->getCell('HR' . $i)->getCalculatedValue();

            $Toxo_tet_dif_Dosis = $objPHPExcel->getActiveSheet()->getCell('HS' . $i)->getCalculatedValue();
            $Toxo_tet_dif_Lote = $objPHPExcel->getActiveSheet()->getCell('HT' . $i)->getCalculatedValue();

            $Dpt_ace_adul_Dosis = $objPHPExcel->getActiveSheet()->getCell('HU' . $i)->getCalculatedValue();
            $Dpt_ace_adul_Lote = $objPHPExcel->getActiveSheet()->getCell('HV' . $i)->getCalculatedValue();

            $Infl_Dosis = $objPHPExcel->getActiveSheet()->getCell('HW' . $i)->getCalculatedValue();
            $Infl_Lote = $objPHPExcel->getActiveSheet()->getCell('HX' . $i)->getCalculatedValue();

            $Vph_Dosis = $objPHPExcel->getActiveSheet()->getCell('HY' . $i)->getCalculatedValue();
            $Vph_Lote = $objPHPExcel->getActiveSheet()->getCell('HZ' . $i)->getCalculatedValue();

            $Anti_prof_Dosis = $objPHPExcel->getActiveSheet()->getCell('IA' . $i)->getCalculatedValue();
            $Anti_prof_Lote = $objPHPExcel->getActiveSheet()->getCell('IB' . $i)->getCalculatedValue();
            $Anti_prof_Observacion = $objPHPExcel->getActiveSheet()->getCell('IC' . $i)->getCalculatedValue();

            $Inmu_ant_tet_Numero_de_frascos_utilizados = $objPHPExcel->getActiveSheet()->getCell('ID' . $i)->getCalculatedValue();
            $Inmu_ant_tet_Lote = $objPHPExcel->getActiveSheet()->getCell('IE' . $i)->getCalculatedValue();
            $Inmu_ant_hep_b_Numero_de_frascos_utilizados = $objPHPExcel->getActiveSheet()->getCell('IF' . $i)->getCalculatedValue();


            $Inmu_ant_hep_b_Lote = $objPHPExcel->getActiveSheet()->getCell('IG' . $i)->getCalculatedValue();
            $Inmu_ant_hep_b_Observacion = $objPHPExcel->getActiveSheet()->getCell('IH' . $i)->getCalculatedValue();
            $Inmuno_anti_tet_Numero_de_frascos_utilizados = $objPHPExcel->getActiveSheet()->getCell('II' . $i)->getCalculatedValue();
            $Inmuno_anti_tet_Lote = $objPHPExcel->getActiveSheet()->getCell('IJ' . $i)->getCalculatedValue();
            $Anti_toxi_tet_Numero_de_frascos_utilizados = $objPHPExcel->getActiveSheet()->getCell('IK' . $i)->getCalculatedValue();
            $Anti_toxi_tet_Lote = $objPHPExcel->getActiveSheet()->getCell('IL' . $i)->getCalculatedValue();
            $Meni_con_Dosis = $objPHPExcel->getActiveSheet()->getCell('IM' . $i)->getCalculatedValue();
            $Meni_con_Lote = $objPHPExcel->getActiveSheet()->getCell('IN' . $i)->getCalculatedValue();
            $Fie_tifo_Dosis = $objPHPExcel->getActiveSheet()->getCell('IO' . $i)->getCalculatedValue();
            $Fie_tifo_Lote = $objPHPExcel->getActiveSheet()->getCell('IP' . $i)->getCalculatedValue();
            $Her_zos_Dosis = $objPHPExcel->getActiveSheet()->getCell('IQ' . $i)->getCalculatedValue();
            $Her_zos_Lote = $objPHPExcel->getActiveSheet()->getCell('IR' . $i)->getCalculatedValue();
            $Dat_vac_Responsable_nombre_del_vacunador = $objPHPExcel->getActiveSheet()->getCell('IS' . $i)->getCalculatedValue();
            $Dat_vac_El_registro_fue_ingresado_al_aplicativo_PAI = $objPHPExcel->getActiveSheet()->getCell('IT' . $i)->getCalculatedValue();
            $Dat_vac_Motivo_de_no_ingreso = $objPHPExcel->getActiveSheet()->getCell('IU' . $i)->getCalculatedValue();
            $Dat_vac_Observaciones = $objPHPExcel->getActiveSheet()->getCell('IV' . $i)->getCalculatedValue();

















            // Verificar si la celda en la columna "B" está vacía (también puedes verificar la columna "C")
            if ($tipoIdentificacion == "") {
                // Si ambas celdas están vacías, detener el ciclo
                break;
            }

            $_DATOS_EXCEL[$i]['Consecutivo'] = $Consecutivo;
            $_DATOS_EXCEL[$i]['fechaAtencion'] = $fechaAtencion;




            $_DATOS_EXCEL[$i]['tipoIdentificacion'] = $tipoIdentificacion;
            $_DATOS_EXCEL[$i]['documento'] = $documento;
            $_DATOS_EXCEL[$i]['pNombre'] = $pNombre;
            $_DATOS_EXCEL[$i]['sNombre'] = $sNombre;
            $_DATOS_EXCEL[$i]['fechaNacimiento'] = $fechaNacimiento;

            $_DATOS_EXCEL[$i]['años'] = $años;
            $_DATOS_EXCEL[$i]['meses'] = $meses;
            $_DATOS_EXCEL[$i]['dias'] = $dias;
            $_DATOS_EXCEL[$i]['totalMeses'] = $totalMeses;
            $_DATOS_EXCEL[$i]['esquemaC'] = $esquemaC;
            $_DATOS_EXCEL[$i]['sexo'] = $sexo;
            $_DATOS_EXCEL[$i]['genero'] = $genero;

            $_DATOS_EXCEL[$i]['oSexual'] = $oSexual;
            $_DATOS_EXCEL[$i]['eGesticion'] = $eGesticion;
            $_DATOS_EXCEL[$i]['paisNacimiento'] = $paisNacimiento;
            $_DATOS_EXCEL[$i]['estatusMigratorio'] = $estatusMigratorio;
            $_DATOS_EXCEL[$i]['lugarAtencionP'] = $lugarAtencionP;
            $_DATOS_EXCEL[$i]['regimenAfi'] = $regimenAfi;
            $_DATOS_EXCEL[$i]['aseguradora'] = $aseguradora;

            $_DATOS_EXCEL[$i]['pEtnica'] = $pEtnica;
            $_DATOS_EXCEL[$i]['desplazado'] = $desplazado;
            $_DATOS_EXCEL[$i]['descapacitado'] = $descapacitado;
            $_DATOS_EXCEL[$i]['fallecido'] = $fallecido;
            $_DATOS_EXCEL[$i]['vdcArmado'] = $vdcArmado;
            $_DATOS_EXCEL[$i]['EstudianteA'] = $EstudianteA;
            $_DATOS_EXCEL[$i]['PaisR'] = $PaisR;
            $_DATOS_EXCEL[$i]['departamentoR'] = $departamentoR;
            $_DATOS_EXCEL[$i]['municipioR'] = $municipioR;
            $_DATOS_EXCEL[$i]['localidad'] = $localidad;
            $_DATOS_EXCEL[$i]['Area'] = $Area;
            $_DATOS_EXCEL[$i]['direccionN'] = $direccionN;
            $_DATOS_EXCEL[$i]['telefonoF'] = $telefonoF;
            $_DATOS_EXCEL[$i]['celular'] = $celular;

            $_DATOS_EXCEL[$i]['email'] = $email;
            $_DATOS_EXCEL[$i]['aLLamadaT'] = $aLLamadaT;
            $_DATOS_EXCEL[$i]['aEnvioC'] = $aEnvioC;

            $_DATOS_EXCEL[$i]['hsEventoAdverso'] = $hsEventoAdverso;
            $_DATOS_EXCEL[$i]['cualEventoAdverso'] = $cualEventoAdverso;
            $_DATOS_EXCEL[$i]['ha_presentado_reaccion'] = $ha_presentado_reaccion;
            $_DATOS_EXCEL[$i]['cual_reaccion'] = $cual_reaccion;
            $_DATOS_EXCEL[$i]['condicion_usuaria'] = $condicion_usuaria;
            $_DATOS_EXCEL[$i]['g_fecha_uMestruacion'] = $g_fecha_uMestruacion;

            $_DATOS_EXCEL[$i]['SemanasGestación'] = $SemanasGestación;

            $_DATOS_EXCEL[$i]['FprobableParto'] = $FprobableParto;



            $_DATOS_EXCEL[$i]['Con_usu_Cantidad_de_embarazos_previos'] = $Con_usu_Cantidad_de_embarazos_previos;
            $_DATOS_EXCEL[$i]['Dat_mad_Tipo_de_identificacion'] = $Dat_mad_Tipo_de_identificacion;
            $_DATOS_EXCEL[$i]['Dat_mad_Numero_de_identificacion'] = $Dat_mad_Numero_de_identificacion;
            $_DATOS_EXCEL[$i]['Dat_mad_Primer_nombre'] = $Dat_mad_Primer_nombre;
            $_DATOS_EXCEL[$i]['Dat_mad_Segundo_nombre'] = $Dat_mad_Segundo_nombre;

            $_DATOS_EXCEL[$i]['Dat_mad_Primer_apellido'] = $Dat_mad_Primer_apellido;
            $_DATOS_EXCEL[$i]['Dat_mad_Segundo_apellido'] = $Dat_mad_Segundo_apellido;
            $_DATOS_EXCEL[$i]['Dat_mad_Correo_electrónico'] = $Dat_mad_Correo_electrónico;
            $_DATOS_EXCEL[$i]['Dat_mad_Indicativo_más_teléfono_fijo'] = $Dat_mad_Indicativo_más_teléfono_fijo;
            $_DATOS_EXCEL[$i]['Dat_mad_Celular'] = $Dat_mad_Celular;


            $_DATOS_EXCEL[$i]['Dat_mad_Regimen_de_afiliacion'] = $Dat_mad_Regimen_de_afiliacion;
            $_DATOS_EXCEL[$i]['Dat_mad_Pertenencia_etnica'] = $Dat_mad_Pertenencia_etnica;
            $_DATOS_EXCEL[$i]['Dat_mad_Desplazado'] = $Dat_mad_Desplazado;
            $_DATOS_EXCEL[$i]['Dat_cui_Tipo_de_identificacion'] = $Dat_cui_Tipo_de_identificacion;
            $_DATOS_EXCEL[$i]['Dat_cui_Numero_de_identificacion'] = $Dat_cui_Numero_de_identificacion;

            $_DATOS_EXCEL[$i]['Dat_cui_Primer_nombre'] = $Dat_cui_Primer_nombre;
            $_DATOS_EXCEL[$i]['Dat_cui_Segundo_nombre'] = $Dat_cui_Segundo_nombre;
            $_DATOS_EXCEL[$i]['Dat_cui_Primer_apellido'] = $Dat_cui_Primer_apellido;
            $_DATOS_EXCEL[$i]['Dat_cui_Segundo_apellido'] = $Dat_cui_Segundo_apellido;
            $_DATOS_EXCEL[$i]['Dat_cui_Parentesco'] = $Dat_cui_Parentesco;
            $_DATOS_EXCEL[$i]['Dat_cui_Correo_electronico'] = $Dat_cui_Correo_electronico;
            $_DATOS_EXCEL[$i]['Dat_cui_Indicativo_mas_telefono_fijo'] = $Dat_cui_Indicativo_mas_telefono_fijo;
            $_DATOS_EXCEL[$i]['Dat_cui_Celular'] = $Dat_cui_Celular;



            /*         esquema de vacunacion           */
            $_DATOS_EXCEL[$i]['Esq_vac_Tipo_de_carnet'] = $Esq_vac_Tipo_de_carnet;
            $_DATOS_EXCEL[$i]['Pol_ina_Dosis'] = $Pol_ina_Dosis;
            $_DATOS_EXCEL[$i]['Pol_ina_Lote'] = $Pol_ina_Lote;
            $_DATOS_EXCEL[$i]['Pol_ina_Jeringa'] = $Pol_ina_Jeringa;
            $_DATOS_EXCEL[$i]['Pol_ina_Lote_jeringa'] = $Pol_ina_Lote_jeringa;
            $_DATOS_EXCEL[$i]['Pol_ina_Observacion'] = $Pol_ina_Observacion;

            $_DATOS_EXCEL[$i]['Pol_Dosis'] = $Pol_Dosis;
            $_DATOS_EXCEL[$i]['Pol_Lote'] = $Pol_Lote;
            $_DATOS_EXCEL[$i]['Pol_Gotero'] = $Pol_Gotero;

            $_DATOS_EXCEL[$i]['Pen_Dosis'] = $Pol_Dosis;
            $_DATOS_EXCEL[$i]['Pen_Lote'] = $Pol_Lote;
            $_DATOS_EXCEL[$i]['Pen_Jeringa'] = $Pol_Gotero;
            $_DATOS_EXCEL[$i]['Pen_Lote_jeringa'] = $Pol_Dosis;
            $_DATOS_EXCEL[$i]['Pen_Observacion'] = $Pol_Lote;

            $_DATOS_EXCEL[$i]['Dpt_Dosis'] = $Dpt_Dosis;
            $_DATOS_EXCEL[$i]['Dpt_Lote'] = $Dpt_Lote;
            $_DATOS_EXCEL[$i]['Dpt_Jeringa'] = $Dpt_Jeringa;
            $_DATOS_EXCEL[$i]['Dpt_Lote_jeringa'] = $Dpt_Lote_jeringa;


            $_DATOS_EXCEL[$i]['Rot_Dosis'] = $Rot_Dosis;
            $_DATOS_EXCEL[$i]['Rot_Lote'] = $Rot_Lote;

            $_DATOS_EXCEL[$i]['Neu_Tipo_neumococo'] = $Neu_Tipo_neumococo;
            $_DATOS_EXCEL[$i]['Neu_Dosis'] = $Neu_Dosis;
            $_DATOS_EXCEL[$i]['Neu_Lote'] = $Neu_Lote;
            $_DATOS_EXCEL[$i]['Neu_Jeringa'] = $Neu_Jeringa;
            $_DATOS_EXCEL[$i]['Neu_Lote_jeringa'] = $Neu_Lote_jeringa;

            $_DATOS_EXCEL[$i]['Srp_Dosis'] = $Srp_Dosis;
            $_DATOS_EXCEL[$i]['Srp_Lote'] = $Srp_Lote;
            $_DATOS_EXCEL[$i]['Srp_Jeringa'] = $Srp_Jeringa;
            $_DATOS_EXCEL[$i]['Srp_Lote_jeringa'] = $Srp_Lote_jeringa;
            $_DATOS_EXCEL[$i]['Srp_Lote_diluyente'] = $Srp_Lote_diluyente;


            $_DATOS_EXCEL[$i]['Sr_mul_Dosis'] = $Sr_mul_Dosis;
            $_DATOS_EXCEL[$i]['Sr_mul_Lote'] = $Sr_mul_Lote;
            $_DATOS_EXCEL[$i]['Sr_mul_Jeringa'] = $Sr_mul_Jeringa;
            $_DATOS_EXCEL[$i]['Sr_mul_Lote_jeringa'] = $Sr_mul_Lote_jeringa;
            $_DATOS_EXCEL[$i]['Sr_mul_Lote_diluyente'] = $Sr_mul_Lote_diluyente;

            $_DATOS_EXCEL[$i]['Fie_ama_Dosis'] = $Fie_ama_Dosis;
            $_DATOS_EXCEL[$i]['Fie_ama_Lote'] = $Fie_ama_Lote;
            $_DATOS_EXCEL[$i]['Fie_ama_Jeringa'] = $Fie_ama_Jeringa;
            $_DATOS_EXCEL[$i]['Fie_ama_Lote_jeringa'] = $Fie_ama_Lote_jeringa;
            $_DATOS_EXCEL[$i]['Fie_ama_Lote_diluyente'] = $Fie_ama_Lote_diluyente;


            $_DATOS_EXCEL[$i]['Hepa_a_ped_Dosis'] = $Hepa_a_ped_Dosis;
            $_DATOS_EXCEL[$i]['Hepa_a_ped_Lote'] = $Hepa_a_ped_Lote;
            $_DATOS_EXCEL[$i]['Hepa_a_ped_Jeringa'] = $Hepa_a_ped_Jeringa;
            $_DATOS_EXCEL[$i]['Hepa_a_ped_Lote_jeringa'] = $Hepa_a_ped_Lote_jeringa;


            $_DATOS_EXCEL[$i]['Vari_Dosis'] = $Vari_Dosis;
            $_DATOS_EXCEL[$i]['Vari_Lote'] = $Vari_Lote;
            $_DATOS_EXCEL[$i]['Vari_Jeringa'] = $Vari_Jeringa;
            $_DATOS_EXCEL[$i]['Vari_Lote_jeringa'] = $Vari_Lote_jeringa;
            $_DATOS_EXCEL[$i]['Vari_Lote_diluyente'] = $Vari_Lote_diluyente;


            $_DATOS_EXCEL[$i]['Toxoide_tet_Dosis'] = $Toxoide_tet_Dosis;
            $_DATOS_EXCEL[$i]['Toxoide_tet_Lote'] = $Toxoide_tet_Lote;
            $_DATOS_EXCEL[$i]['Toxoide_tet_Jeringa'] = $Toxoide_tet_Jeringa;
            $_DATOS_EXCEL[$i]['Toxoide_tet_Lote_jeringa'] = $Toxoide_tet_Lote_jeringa;

            $_DATOS_EXCEL[$i]['Dtpa_adul_Dosis'] = $Dtpa_adul_Dosis;
            $_DATOS_EXCEL[$i]['Dtpa_adul_Lote'] = $Dtpa_adul_Lote;
            $_DATOS_EXCEL[$i]['Dtpa_adul_Jeringa'] = $Dtpa_adul_Jeringa;
            $_DATOS_EXCEL[$i]['Dtpa_adul_Lote_jeringa'] = $Dtpa_adul_Lote_jeringa;

            $_DATOS_EXCEL[$i]['Influenza_Dosis'] = $Influenza_Dosis;
            $_DATOS_EXCEL[$i]['Influenza_Lote'] = $Influenza_Lote;
            $_DATOS_EXCEL[$i]['Influenza_Jeringa'] = $Influenza_Jeringa;
            $_DATOS_EXCEL[$i]['Influenza_Lote_jeringa'] = $Influenza_Lote_jeringa;
            $_DATOS_EXCEL[$i]['Influenza_Observacion'] = $Influenza_Observacion;

            /*         esquema de vacunacion           */

            $_DATOS_EXCEL[$i]['Vp_Dosis'] = $Vp_Dosis;
            $_DATOS_EXCEL[$i]['Vp_Lote'] = $Vp_Lote;
            $_DATOS_EXCEL[$i]['Vp_Jeringa'] = $Vp_Jeringa;
            $_DATOS_EXCEL[$i]['Vp_Lote_jeringa'] = $Vp_Lote_jeringa;

            $_DATOS_EXCEL[$i]['Anti_hum_Dosis'] = $Anti_hum_Dosis;
            $_DATOS_EXCEL[$i]['Anti_hum_Lote'] = $Anti_hum_Lote;
            $_DATOS_EXCEL[$i]['Anti_hum_Jeringa'] = $Anti_hum_Jeringa;
            $_DATOS_EXCEL[$i]['Anti_hum_Lote_jeringa'] = $Anti_hum_Lote_jeringa;
            $_DATOS_EXCEL[$i]['Anti_hum_Lote_diluyente'] = $Anti_hum_Lote_diluyente;
            $_DATOS_EXCEL[$i]['Anti_hum_Observacion'] = $Anti_hum_Observacion;

            $_DATOS_EXCEL[$i]['Hepat_b_Dosis'] = $Hepat_b_Dosis;
            $_DATOS_EXCEL[$i]['Hepat_b_Lote'] = $Hepat_b_Lote;
            $_DATOS_EXCEL[$i]['Penta_Dosis'] = $Penta_Dosis;
            $_DATOS_EXCEL[$i]['Penta_Lote'] = $Penta_Lote;
            $_DATOS_EXCEL[$i]['Hexa_Dosis'] = $Hexa_Dosis;
            $_DATOS_EXCEL[$i]['Hexa_Lote'] = $Hexa_Lote;
            $_DATOS_EXCEL[$i]['Tetra_Dosis'] = $Tetra_Dosis;
            $_DATOS_EXCEL[$i]['Tetra_Lote'] = $Tetra_Lote;
            $_DATOS_EXCEL[$i]['Dpt_ace_Dosis'] = $Dpt_ace_Dosis;
            $_DATOS_EXCEL[$i]['Dpt_ace_Lote'] = $Dpt_ace_Lote;
            $_DATOS_EXCEL[$i]['Tox_tet_Dosis'] = $Tox_tet_Dosis;
            $_DATOS_EXCEL[$i]['Tox_tet_Lote'] = $Tox_tet_Lote;

            $_DATOS_EXCEL[$i]['Rot_Dosis'] = $Rot_Dosis;
            $_DATOS_EXCEL[$i]['Rot_Lote'] = $Rot_Lote;
            $_DATOS_EXCEL[$i]['Neu_con_Dosis'] = $Neu_con_Dosis;
            $_DATOS_EXCEL[$i]['Neu_con_Lote'] = $Neu_con_Lote;
            $_DATOS_EXCEL[$i]['Neu_poli_Dosis'] = $Neu_poli_Dosis;
            $_DATOS_EXCEL[$i]['Neu_poli_Lote'] = $Neu_poli_Lote;
            $_DATOS_EXCEL[$i]['Tri_vir_Dosis'] = $Tri_vir_Dosis;
            $_DATOS_EXCEL[$i]['Tri_vir_Lote'] = $Tri_vir_Lote;
            $_DATOS_EXCEL[$i]['Var_tri_vir_Dosis'] = $Var_tri_vir_Dosis;
            $_DATOS_EXCEL[$i]['Var_tri_vir_Lote'] = $Var_tri_vir_Lote;
            $_DATOS_EXCEL[$i]['Fie_amar_Dosis'] = $Fie_amar_Dosis;
            $_DATOS_EXCEL[$i]['Fie_amar_Lote'] = $Fie_amar_Lote;
            $_DATOS_EXCEL[$i]['Hepa_a_Dosis'] = $Hepa_a_Dosis;
            $_DATOS_EXCEL[$i]['Hepa_a_Lote'] = $Hepa_a_Lote;
            $_DATOS_EXCEL[$i]['Hepa_a_y_b_Dosis'] = $Hepa_a_y_b_Dosis;
            $_DATOS_EXCEL[$i]['Hepa_a_y_b_Lote'] = $Hepa_a_y_b_Lote;

            $_DATOS_EXCEL[$i]['Vari_Dosis'] = $Vari_Dosis;
            $_DATOS_EXCEL[$i]['Vari_Lote'] = $Vari_Lote;
            $_DATOS_EXCEL[$i]['Toxo_tet_dif_Dosis'] = $Toxo_tet_dif_Dosis;
            $_DATOS_EXCEL[$i]['Toxo_tet_dif_Lote'] = $Toxo_tet_dif_Lote;
            $_DATOS_EXCEL[$i]['Dpt_ace_adul_Dosis'] = $Dpt_ace_adul_Dosis;
            $_DATOS_EXCEL[$i]['Dpt_ace_adul_Lote'] = $Dpt_ace_adul_Lote;
            $_DATOS_EXCEL[$i]['Infl_Dosis'] = $Infl_Dosis;
            $_DATOS_EXCEL[$i]['Infl_Lote'] = $Infl_Lote;
            $_DATOS_EXCEL[$i]['Vph_Dosis'] = $Vph_Dosis;
            $_DATOS_EXCEL[$i]['Vph_Lote'] = $Vph_Lote;
            $_DATOS_EXCEL[$i]['Anti_prof_Dosis'] = $Anti_prof_Dosis;
            $_DATOS_EXCEL[$i]['Anti_prof_Lote'] = $Anti_prof_Lote;
            $_DATOS_EXCEL[$i]['Anti_prof_Observacion'] = $Anti_prof_Observacion;
            $_DATOS_EXCEL[$i]['Inmu_ant_tet_Numero_de_frascos_utilizados'] = $Inmu_ant_tet_Numero_de_frascos_utilizados;
            $_DATOS_EXCEL[$i]['Inmu_ant_tet_Lote'] = $Inmu_ant_tet_Lote;
            $_DATOS_EXCEL[$i]['Inmu_ant_hep_b_Numero_de_frascos_utilizados'] = $Inmu_ant_hep_b_Numero_de_frascos_utilizados;

            $_DATOS_EXCEL[$i]['Inmu_ant_hep_b_Lote'] = $Inmu_ant_hep_b_Lote;
            $_DATOS_EXCEL[$i]['Inmu_ant_hep_b_Observacion'] = $Inmu_ant_hep_b_Observacion;
            $_DATOS_EXCEL[$i]['Inmuno_anti_tet_Numero_de_frascos_utilizados'] = $Inmuno_anti_tet_Numero_de_frascos_utilizados;
            $_DATOS_EXCEL[$i]['Inmuno_anti_tet_Lote'] = $Inmuno_anti_tet_Lote;
            $_DATOS_EXCEL[$i]['Anti_toxi_tet_Numero_de_frascos_utilizados'] = $Anti_toxi_tet_Numero_de_frascos_utilizados;
            $_DATOS_EXCEL[$i]['Anti_toxi_tet_Lote'] = $Anti_toxi_tet_Lote;
            $_DATOS_EXCEL[$i]['Meni_con_Dosis'] = $Meni_con_Dosis;
            $_DATOS_EXCEL[$i]['Meni_con_Lote'] = $Meni_con_Lote;
            $_DATOS_EXCEL[$i]['Fie_tifo_Dosis'] = $Fie_tifo_Dosis;
            $_DATOS_EXCEL[$i]['Fie_tifo_Lote'] = $Fie_tifo_Lote;
            $_DATOS_EXCEL[$i]['Her_zos_Dosis'] = $Her_zos_Dosis;
            $_DATOS_EXCEL[$i]['Her_zos_Lote'] = $Her_zos_Lote;
            $_DATOS_EXCEL[$i]['Dat_vac_Responsable_nombre_del_vacunador'] = $Dat_vac_Responsable_nombre_del_vacunador;
            $_DATOS_EXCEL[$i]['Dat_vac_El_registro_fue_ingresado_al_aplicativo_PAI'] = $Dat_vac_El_registro_fue_ingresado_al_aplicativo_PAI;
            $_DATOS_EXCEL[$i]['Dat_vac_Motivo_de_no_ingreso'] = $Dat_vac_Motivo_de_no_ingreso;
            $_DATOS_EXCEL[$i]['Dat_vac_Observaciones'] = $Dat_vac_Observaciones;




        }







        foreach ($_DATOS_EXCEL as $campo => $valor) {
             // Insertar en la tabla 'datosusuario'
             $columnas_datosusuario = implode(',', array_keys($valor));
             $valores_datosusuario = implode("','", array_values($valor));
          

            $sql_datosusuario = "INSERT INTO datosusuario(Consecutivo,  tipoIdentificacion, documento, pNombre,
    sNombre, fechaNacimiento, años, meses, dias, totalMeses,
    esquemaC, sexo, genero, oSexual, eGesticion, paisNacimiento, 
    estatusMigratorio, lugarAtencionP, regimenAfi, aseguradora,
    pEtnica, desplazado, descapacitado, fallecido, vdcArmado,
    EstudianteA, PaisR, departamentoR, municipioR, localidad,
    Area, direccionN, telefonoF, celular, email, aLLamadaT, aEnvioC, hsEventoAdverso, cualEventoAdverso, ha_presentado_reaccion,
    cual_reaccion, condicion_usuaria,g_fecha_uMestruacion,SemanasGestación, FprobableParto, Con_usu_Cantidad_de_embarazos_previos,
    Dat_mad_Tipo_de_identificacion,Dat_mad_Numero_de_identificacion, Dat_mad_Primer_nombre,Dat_mad_Segundo_nombre
    ,Dat_mad_Primer_apellido, Dat_mad_Segundo_apellido,Dat_mad_Indicativo_más_teléfono_fijo, Dat_mad_Celular
    ,Dat_mad_Regimen_de_afiliacion, Dat_mad_Pertenencia_etnica, Dat_mad_Desplazado, Dat_cui_Tipo_de_identificacion
    ,Dat_cui_Numero_de_identificacion,Dat_cui_Primer_nombre,Dat_cui_Segundo_nombre,Dat_cui_Primer_apellido,Dat_cui_Segundo_apellido,
    Dat_cui_Parentesco, Dat_cui_Correo_electronico, Dat_cui_Indicativo_mas_telefono_fijo,
    Dat_cui_Celular
    
    
    
    ) 
    VALUES ('$valor[Consecutivo]', '$valor[tipoIdentificacion]', '$valor[documento]', '$valor[pNombre]',
    '$valor[sNombre]', '$valor[fechaNacimiento]', '$valor[años]', '$valor[meses]', '$valor[dias]', '$valor[totalMeses]', 
    '$valor[esquemaC]', '$valor[sexo]', '$valor[genero]', '$valor[oSexual]', '$valor[eGesticion]', '$valor[paisNacimiento]',
    '$valor[estatusMigratorio]', '$valor[lugarAtencionP]', '$valor[regimenAfi]', '$valor[aseguradora]', '$valor[pEtnica]',
    '$valor[desplazado]', '$valor[descapacitado]', '$valor[fallecido]', '$valor[vdcArmado]', '$valor[EstudianteA]',
    '$valor[PaisR]', '$valor[departamentoR]', '$valor[municipioR]', '$valor[localidad]', '$valor[Area]', '$valor[direccionN]',
    '$valor[telefonoF]', '$valor[celular]', '$valor[email]', '$valor[aLLamadaT]', '$valor[aEnvioC]', '$valor[hsEventoAdverso]', 
    '$valor[cualEventoAdverso]', '$valor[ha_presentado_reaccion]', '$valor[cual_reaccion]', '$valor[condicion_usuaria]', 
    '$valor[g_fecha_uMestruacion]',  '$valor[SemanasGestación]', '$valor[FprobableParto]', '$valor[Con_usu_Cantidad_de_embarazos_previos]',
    '$valor[Dat_mad_Tipo_de_identificacion]',  '$valor[Dat_mad_Numero_de_identificacion]',  '$valor[Dat_mad_Primer_nombre]'
    ,'$valor[Dat_mad_Segundo_nombre]','$valor[Dat_mad_Primer_apellido]','$valor[Dat_mad_Segundo_apellido]'
    ,'$valor[Dat_mad_Indicativo_más_teléfono_fijo]' ,'$valor[Dat_mad_Celular]', '$valor[Dat_mad_Regimen_de_afiliacion]'
    , '$valor[Dat_mad_Pertenencia_etnica]', '$valor[Dat_mad_Desplazado]', '$valor[Dat_cui_Tipo_de_identificacion]'
    , '$valor[Dat_cui_Numero_de_identificacion]',
    '$valor[Dat_cui_Primer_nombre]','$valor[Dat_cui_Segundo_nombre]','$valor[Dat_cui_Primer_apellido]'
    ,'$valor[Dat_cui_Segundo_apellido]','$valor[Dat_cui_Parentesco]','$valor[Dat_cui_Correo_electronico]'
    ,'$valor[Dat_cui_Indicativo_mas_telefono_fijo]','$valor[Dat_cui_Celular]'



    ) 
    ON DUPLICATE KEY UPDATE 
    Consecutivo = '$valor[Consecutivo]', tipoIdentificacion = '$valor[tipoIdentificacion]', 
    documento = '$valor[documento]', pNombre = '$valor[pNombre]', sNombre = '$valor[sNombre]', fechaNacimiento = '$valor[fechaNacimiento]', 
    años = '$valor[años]', meses = '$valor[meses]', dias = '$valor[dias]', totalMeses = '$valor[totalMeses]', 
    esquemaC = '$valor[esquemaC]', sexo = '$valor[sexo]', genero = '$valor[genero]', oSexual = '$valor[oSexual]', 
    eGesticion = '$valor[eGesticion]', paisNacimiento = '$valor[paisNacimiento]', estatusMigratorio = '$valor[estatusMigratorio]', 
    lugarAtencionP = '$valor[lugarAtencionP]', regimenAfi = '$valor[regimenAfi]', aseguradora = '$valor[aseguradora]', 
    pEtnica = '$valor[pEtnica]', desplazado = '$valor[desplazado]', descapacitado = '$valor[descapacitado]', fallecido = '$valor[fallecido]', 
    vdcArmado = '$valor[vdcArmado]', EstudianteA = '$valor[EstudianteA]', PaisR = '$valor[PaisR]', departamentoR = '$valor[departamentoR]', 
    municipioR = '$valor[municipioR]', localidad = '$valor[localidad]', Area = '$valor[Area]', direccionN = '$valor[direccionN]', 
    telefonoF = '$valor[telefonoF]', celular = '$valor[celular]', email = '$valor[email]', aLLamadaT = '$valor[aLLamadaT]', aEnvioC = '$valor[aEnvioC]'
    , hsEventoAdverso = '$valor[hsEventoAdverso]', cualEventoAdverso = '$valor[cualEventoAdverso]', ha_presentado_reaccion = '$valor[ha_presentado_reaccion]'
    , cual_reaccion = '$valor[cual_reaccion]', condicion_usuaria = '$valor[condicion_usuaria]', g_fecha_uMestruacion = '$valor[g_fecha_uMestruacion]',
    SemanasGestación = '$valor[SemanasGestación]', FprobableParto = '$valor[FprobableParto]',  Con_usu_Cantidad_de_embarazos_previos = '$valor[Con_usu_Cantidad_de_embarazos_previos]'
    , Dat_mad_Tipo_de_identificacion = '$valor[Dat_mad_Tipo_de_identificacion]',Dat_mad_Numero_de_identificacion = '$valor[Dat_mad_Numero_de_identificacion]'
    , Dat_mad_Primer_nombre = '$valor[Dat_mad_Primer_nombre]', Dat_mad_Segundo_nombre = '$valor[Dat_mad_Segundo_nombre]'
    , Dat_mad_Primer_apellido = '$valor[Dat_mad_Primer_apellido]' , Dat_mad_Segundo_apellido = '$valor[Dat_mad_Segundo_apellido]'
    ,Dat_mad_Indicativo_más_teléfono_fijo = '$valor[Dat_mad_Indicativo_más_teléfono_fijo]' ,Dat_mad_Celular = '$valor[Dat_mad_Celular]',
    Dat_mad_Regimen_de_afiliacion = '$valor[Dat_mad_Regimen_de_afiliacion]', Dat_mad_Pertenencia_etnica = '$valor[Dat_mad_Pertenencia_etnica]',
    Dat_mad_Desplazado = '$valor[Dat_mad_Desplazado]', Dat_cui_Tipo_de_identificacion = '$valor[Dat_cui_Tipo_de_identificacion]',
    Dat_cui_Numero_de_identificacion = '$valor[Dat_cui_Numero_de_identificacion]',
    Dat_cui_Primer_nombre = '$valor[Dat_cui_Primer_nombre]',
    Dat_cui_Segundo_nombre = '$valor[Dat_cui_Segundo_nombre]',
    Dat_cui_Primer_apellido = '$valor[Dat_cui_Primer_apellido]',
    Dat_cui_Segundo_apellido = '$valor[Dat_cui_Segundo_apellido]',
    Dat_cui_Parentesco = '$valor[Dat_cui_Parentesco]',
    Dat_cui_Correo_electronico = '$valor[Dat_cui_Correo_electronico]',
    Dat_cui_Indicativo_mas_telefono_fijo = '$valor[Dat_cui_Indicativo_mas_telefono_fijo]',
    Dat_cui_Celular = '$valor[Dat_cui_Celular]'

    ";


            $sql_datosusuario = rtrim($sql_datosusuario, ',');

            $result_datosusuario = mysqli_query($conn, $sql_datosusuario);
            if (!$result_datosusuario) {
                echo "Error al insertar o actualizar registro en datosusuario: " . $campo;
                $errores += 1;
            }




            // Insertar en la tabla 'esquemavacunacion'
           // Asumiendo que ya tienes los valores en $valor y una conexión a la base de datos en $conn
$documentoPaciente = mysqli_real_escape_string($conn, $valor['documento']);
$fechaAtencion = mysqli_real_escape_string($conn, $valor['fechaAtencion']);

// Construir la consulta INSERT con la subconsulta NOT EXISTS para verificar la existencia del registro
$sql_esquemavacunacion = "INSERT INTO esquemavacunacion (
documentoPaciente,fechaAtencion, Esq_vac_Tipo_de_carnet,Pol_ina_Dosis,
            Pol_ina_Lote,Pol_ina_Jeringa, Pol_ina_Lote_jeringa, Pol_ina_Observacion,Pol_Dosis,Pol_Lote,Pol_Gotero
            ,Pen_Dosis,Pen_Lote,Pen_Jeringa,Pen_Lote_jeringa,Pen_Observacion
            ,Dpt_Dosis,Dpt_Lote,Dpt_Jeringa,Dpt_Lote_jeringa, Rot_Dosis, Rot_Lote, Neu_Tipo_neumococo,
            Neu_Dosis, Neu_Lote, Neu_Jeringa, Neu_Lote_jeringa,Srp_Dosis, Srp_Lote, Srp_Jeringa, Srp_Lote_jeringa,
            Srp_Lote_diluyente,Sr_mul_Dosis,Sr_mul_Lote,Sr_mul_Jeringa,Sr_mul_Lote_jeringa,Sr_mul_Lote_diluyente
            ,Fie_ama_Dosis,Fie_ama_Lote,Fie_ama_Jeringa,Fie_ama_Lote_jeringa,Fie_ama_Lote_diluyente
            ,Hepa_a_ped_Dosis,Hepa_a_ped_Lote,Hepa_a_ped_Jeringa,Hepa_a_ped_Lote_jeringa
            ,Vari_Dosis, Vari_Lote, Vari_Jeringa, Vari_Lote_jeringa, Vari_Lote_diluyente,Toxoide_tet_Dosis,
            Toxoide_tet_Lote,Toxoide_tet_Jeringa,Toxoide_tet_Lote_jeringa, Dtpa_adul_Dosis,Dtpa_adul_Lote,Dtpa_adul_Jeringa
            ,Dtpa_adul_Lote_jeringa,Influenza_Dosis,Influenza_Lote,Influenza_Jeringa, Influenza_Lote_jeringa, Influenza_Observacion) 
SELECT '$documentoPaciente', '$fechaAtencion', 
 '$valor[Esq_vac_Tipo_de_carnet]', '$valor[Pol_ina_Dosis]'
             , '$valor[Pol_ina_Lote]', '$valor[Pol_ina_Jeringa]', '$valor[Pol_ina_Lote_jeringa]'
             , '$valor[Pol_ina_Observacion]'
             , '$valor[Pol_Dosis]', '$valor[Pol_Lote]', '$valor[Pol_Gotero]'
             , '$valor[Pen_Dosis]', '$valor[Pen_Lote]', '$valor[Pen_Jeringa]'
             , '$valor[Pen_Lote_jeringa]', '$valor[Pen_Observacion]'
             , '$valor[Dpt_Dosis]', '$valor[Dpt_Lote]', '$valor[Dpt_Jeringa]', '$valor[Dpt_Lote_jeringa]'
             , '$valor[Rot_Dosis]', '$valor[Rot_Dosis]' , '$valor[Neu_Tipo_neumococo]', '$valor[Neu_Dosis]'
             , '$valor[Neu_Lote]', '$valor[Neu_Jeringa]', '$valor[Neu_Lote_jeringa]'
             , '$valor[Srp_Dosis]', '$valor[Srp_Lote]', '$valor[Srp_Jeringa]'
             , '$valor[Srp_Lote_jeringa]', '$valor[Srp_Lote_diluyente]'
             , '$valor[Sr_mul_Dosis]', '$valor[Sr_mul_Lote]' , '$valor[Sr_mul_Jeringa]', '$valor[Sr_mul_Lote_jeringa]'
             , '$valor[Sr_mul_Lote_diluyente]'
             , '$valor[Fie_ama_Dosis]' , '$valor[Fie_ama_Lote]' , '$valor[Fie_ama_Jeringa]'
             , '$valor[Fie_ama_Lote_jeringa]' , '$valor[Fie_ama_Lote_diluyente]'
             , '$valor[Hepa_a_ped_Dosis]', '$valor[Hepa_a_ped_Lote]', '$valor[Hepa_a_ped_Jeringa]', '$valor[Hepa_a_ped_Lote_jeringa]'
             , '$valor[Vari_Dosis]' , '$valor[Vari_Lote]' , '$valor[Vari_Jeringa]'
             , '$valor[Vari_Lote_jeringa]' , '$valor[Vari_Lote_diluyente]'
             , '$valor[Toxoide_tet_Dosis]', '$valor[Toxoide_tet_Lote]', '$valor[Toxoide_tet_Jeringa]', '$valor[Toxoide_tet_Lote_jeringa]'   
             , '$valor[Dtpa_adul_Dosis]' , '$valor[Dtpa_adul_Lote]' , '$valor[Dtpa_adul_Jeringa]' , '$valor[Dtpa_adul_Lote_jeringa]' 
             , '$valor[Influenza_Dosis]' , '$valor[Influenza_Lote]' , '$valor[Influenza_Jeringa]' , '$valor[Influenza_Lote_jeringa]' 
             , '$valor[Influenza_Observacion]'  

        WHERE NOT EXISTS (
            SELECT 1 FROM esquemavacunacion WHERE documentoPaciente = '$documentoPaciente' AND fechaAtencion = '$fechaAtencion'
            )";

            $result_esquemavacunacion = mysqli_query($conn, $sql_esquemavacunacion);
            if (!$result_esquemavacunacion) {
                echo "Error al insertar registro en esquemavacunacion para documentoPaciente: $documentoPaciente y fechaAtencion: $fechaAtencion\n";
                $errores += 1;
            }


            // Insertar en la tabla 'esquemavacunacion'
            $sql_esquemavacunacionii = "INSERT INTO esquemavacunacionii (

                documentoPaciente,fechaAtencion,Vp_Dosis,Vp_Lote,Vp_Jeringa,Vp_Lote_jeringa,
                    Anti_hum_Dosis,Anti_hum_Lote,Anti_hum_Jeringa,Anti_hum_Lote_jeringa,Anti_hum_Lote_diluyente,Anti_hum_Observacion,
                    Hepat_b_Dosis,Hepat_b_Lote,Penta_Dosis,Penta_Lote,Hexa_Dosis,Hexa_Lote,Tetra_Dosis,Tetra_Lote,Dpt_ace_Dosis,Dpt_ace_Lote,
                    Tox_tet_Dosis,Tox_tet_Lote,Rot_Dosis, Rot_Lote,Neu_con_Dosis,Neu_con_Lote,Neu_poli_Dosis,Neu_poli_Lote,Tri_vir_Dosis,
                    Tri_vir_Lote,Var_tri_vir_Dosis,Var_tri_vir_Lote,Fie_amar_Dosis,Fie_amar_Lote,Hepa_a_Dosis,Hepa_a_Lote,Hepa_a_y_b_Dosis,
                    Hepa_a_y_b_Lote
                    
                    ,Vari_Dosis,Vari_Lote,Toxo_tet_dif_Dosis,Toxo_tet_dif_Lote,Dpt_ace_adul_Dosis,Dpt_ace_adul_Lote,Infl_Dosis,Infl_Lote,Vph_Dosis,
                    Vph_Lote,Anti_prof_Dosis,Anti_prof_Lote,Anti_prof_Observacion,Inmu_ant_tet_Numero_de_frascos_utilizados,Inmu_ant_tet_Lote,
                    Inmu_ant_hep_b_Numero_de_frascos_utilizados
        
                    ,Inmu_ant_hep_b_Lote,Inmu_ant_hep_b_Observacion,Inmuno_anti_tet_Numero_de_frascos_utilizados,Inmuno_anti_tet_Lote,Anti_toxi_tet_Numero_de_frascos_utilizados,
                    Anti_toxi_tet_Lote,Meni_con_Dosis,Meni_con_Lote,Fie_tifo_Dosis,Fie_tifo_Lote,Her_zos_Dosis,Her_zos_Lote,Dat_vac_Responsable_nombre_del_vacunador,
                    Dat_vac_El_registro_fue_ingresado_al_aplicativo_PAI,Dat_vac_Motivo_de_no_ingreso,Dat_vac_Observaciones
        
        
        ) 
        SELECT '$documentoPaciente', '$fechaAtencion'
                 ,'$valor[Vp_Dosis]','$valor[Vp_Lote]','$valor[Vp_Jeringa]','$valor[Vp_Lote_jeringa]'
                     ,'$valor[Anti_hum_Dosis]','$valor[Anti_hum_Lote]','$valor[Anti_hum_Jeringa]','$valor[Anti_hum_Lote_jeringa]','$valor[Anti_hum_Lote_diluyente]','$valor[Anti_hum_Observacion]'
                     
                     ,'$valor[Hepat_b_Dosis]','$valor[Hepat_b_Lote]','$valor[Penta_Dosis]','$valor[Penta_Lote]','$valor[Hexa_Dosis]','$valor[Hexa_Lote]'
                     ,'$valor[Tetra_Dosis]','$valor[Tetra_Lote]','$valor[Dpt_ace_Dosis]','$valor[Dpt_ace_Lote]','$valor[Tox_tet_Dosis]','$valor[Tox_tet_Lote]'
                     ,'$valor[Rot_Dosis]','$valor[Rot_Lote]','$valor[Neu_con_Dosis]','$valor[Neu_con_Lote]','$valor[Neu_poli_Dosis]','$valor[Neu_poli_Lote]','$valor[Tri_vir_Dosis]'
                     ,'$valor[Tri_vir_Lote]','$valor[Var_tri_vir_Dosis]','$valor[Var_tri_vir_Lote]','$valor[Fie_amar_Dosis]','$valor[Fie_amar_Lote]','$valor[Hepa_a_Dosis]'
                     ,'$valor[Hepa_a_Lote]','$valor[Hepa_a_y_b_Dosis]','$valor[Hepa_a_y_b_Lote]',
        
                     '$valor[Vari_Dosis]' ,'$valor[Vari_Lote]','$valor[Toxo_tet_dif_Dosis]','$valor[Toxo_tet_dif_Lote]'
                     ,'$valor[Dpt_ace_adul_Dosis]','$valor[Dpt_ace_adul_Lote]','$valor[Infl_Dosis]','$valor[Infl_Lote]','$valor[Vph_Dosis]','$valor[Vph_Lote]','$valor[Anti_prof_Dosis]'
                     ,'$valor[Anti_prof_Lote]','$valor[Anti_prof_Observacion]','$valor[Inmu_ant_tet_Numero_de_frascos_utilizados]','$valor[Inmu_ant_tet_Lote]'
                     ,'$valor[Inmu_ant_hep_b_Numero_de_frascos_utilizados]',
        
                     '$valor[Inmu_ant_hep_b_Lote]' ,'$valor[Inmu_ant_hep_b_Observacion]','$valor[Inmuno_anti_tet_Numero_de_frascos_utilizados]','$valor[Inmuno_anti_tet_Lote]'
                     ,'$valor[Anti_toxi_tet_Numero_de_frascos_utilizados]','$valor[Anti_toxi_tet_Lote]','$valor[Meni_con_Dosis]'
                     ,'$valor[Meni_con_Lote]','$valor[Fie_tifo_Dosis]','$valor[Fie_tifo_Lote]','$valor[Her_zos_Dosis]'
                     ,'$valor[Her_zos_Lote]','$valor[Dat_vac_Responsable_nombre_del_vacunador]','$valor[Dat_vac_El_registro_fue_ingresado_al_aplicativo_PAI]','$valor[Dat_vac_Motivo_de_no_ingreso]'
                     ,'$valor[Dat_vac_Observaciones]'
        
                WHERE NOT EXISTS (
                    SELECT 1 FROM esquemavacunacionii WHERE documentoPaciente = '$documentoPaciente' AND fechaAtencion = '$fechaAtencion'
                    )";
        
            $result_esquemavacunacionii = mysqli_query($conn, $sql_esquemavacunacionii);
            if (!$result_esquemavacunacionii) {
                echo "Error al insertar registro en esquemavacunacion: " . $campo;
                $errores += 1;
            }








        }

        unlink($destino);
    } else {
        echo "Necesitas primero importar el archivo";
    }

    $campo = $campo - 2;

    echo "<script>alert('ARCHIVO IMPORTADO CON ÉXITO, EN TOTAL $campo REGISTROS Y $errores ERRORES');</script>";
    echo "<script>window.location.href = 'index2.php';</script>";
    exit;
}

function ExcelToPHPDate($excelDate)
{
    $timestamp = PHPExcel_Shared_Date::ExcelToPHP($excelDate);
    return date('Y-m-d', $timestamp);
}

exit;
?>
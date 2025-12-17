<?php
session_start();

require_once("../db/DbListas.php");
require_once("../db/DbRegistroPersonas.php");
require_once("../funciones/Utilidades.php");
require_once '../funciones/PHPExcel/Classes/PHPExcel.php';


$listas = new DbListas();
$dbRegistroPersonas = new DbRegistroPersonas();
$utilidades = new Utilidades();

$tabla_conoce_incad=$listas->getListaDetalles(8);

//$opcion = $utilidades->str_decode($_POST["opcion"]);

function obtener_nombre_mes($mes){
    $nombre_mes = "";
    switch ($mes) {
        case "1": $nombre_mes = "Enero"; break;
        case "2": $nombre_mes = "Febrero"; break;
        case "3": $nombre_mes = "Marzo"; break;
        case "4": $nombre_mes = "Abril"; break;
        case "5": $nombre_mes = "Mayo"; break;
        case "6": $nombre_mes = "Junio"; break;
        case "7": $nombre_mes = "Julio"; break;
        case "8": $nombre_mes = "Agosto"; break;
        case "9": $nombre_mes = "Septiembre"; break;
        case "10": $nombre_mes = "Octubre"; break;
        case "11": $nombre_mes = "Noviembre"; break;
        case "12": $nombre_mes = "Diciembre"; break;
    }
    return $nombre_mes;
}

function cellColor($cells, $color) {
    global $objPHPExcel;
    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()
            ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array('rgb' => $color)
    ));
}



$estilo_bcf = array(
		    'font' => array(
		        'bold' => true,
		    ),
		    'alignment' => array(
		        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		    ),
		    'borders' => array(
		        'outline' => array(
		            'style' => PHPExcel_Style_Border::BORDER_THIN,
		        ),
		    ),
		);
	
	
	
	$estilo_b = array(
		    'borders' => array(
		        'top' => array(
		            'style' => PHPExcel_Style_Border::BORDER_THIN,
		        ),
		    ),
		);
		
	$estiloBordes=array('borders'=>array('outline'=>array('style'=>PHPExcel_Style_Border::BORDER_THIN,),),);	
	
	
	
	//Reporte de errores PHPExcel
	error_reporting(E_ALL);
	
	
	//Se crea el objeto PHPExcel
	
	$objPHPExcel = new PHPExcel();
	
	//Propiedades del documento
	
	$objPHPExcel->getProperties()->setCreator("INCAD")
                                    ->setLastModifiedBy("INCAD")
                                    ->setTitle("INCAD")
                                    ->setSubject("INCAD")
                                    ->setDescription("INCAD")
                                    ->setKeywords("INCAD")
                                    ->setCategory("INCAD");
        //BASE
        $tabla_registro = $_SESSION["excel_tabla_registro"];
        
        
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BA')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BB')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BC')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BD')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BE')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BF')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BG')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BH')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BI')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BJ')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BK')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BL')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BM')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BN')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BO')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BP')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BQ')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BR')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BS')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BT')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BU')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BV')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BW')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BX')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BY')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BZ')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CA')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CB')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CC')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CD')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CE')->setWidth(25);
        

		
		
        $objPHPExcel->getActiveSheet()                	
			 ->setCellValue('A1', 'nom_tipo_documento')
			 ->setCellValue('B1', 'documento_persona')
			 ->setCellValue('C1', 'lugar_documento')
			 ->setCellValue('D1', 'fecha_documento')
			 ->setCellValue('E1', 'nombre_persona')
			 ->setCellValue('F1', 'apellido_persona')
                         ->setCellValue('G1', 'nombre_completo')                        
			 ->setCellValue('H1', 'fecha_nacimiento')
                         ->setCellValue('I1', 'edad')
                         ->setCellValue('J1', 'grupo_edad')                        
                        
			 ->setCellValue('K1', 'lugar_nacimiento')
			 ->setCellValue('L1', 'nom_sexo')
			 ->setCellValue('M1', 'nom_tipo_sangre')
			 ->setCellValue('N1', 'tel_casa_persona')
			 ->setCellValue('O1', 'tel_movil_persona')
			 ->setCellValue('P1', 'email_persona')
			 ->setCellValue('Q1', 'nom_estado_civil')
			 ->setCellValue('R1', 'direccion_casa')
			 ->setCellValue('S1', 'ciudad_residencia')
			 ->setCellValue('T1', 'barrio_residencia')
			 ->setCellValue('U1', 'nom_estrato_persona')
			 ->setCellValue('V1', 'eps')
			 ->setCellValue('W1', 'nombre_contacto_1')
			 ->setCellValue('X1', 'telefono_contacto_1')
			 ->setCellValue('Y1', 'parentesco_contacto_1')
			 ->setCellValue('Z1', 'nombre_contacto_2')
			 ->setCellValue('AA1', 'telefono_contacto_2')
			 ->setCellValue('AB1', 'parentesco_contacto_2')
			 ->setCellValue('AC1', 'nombre_contacto_3')
			 ->setCellValue('AD1', 'telefono_contacto_3')
			 ->setCellValue('AE1', 'parentesco_contacto_3')
			 ->setCellValue('AF1', 'nombre_acudiente')
			 ->setCellValue('AG1', 'telefono_acudiente')
			 ->setCellValue('AH1', 'parentesco_acudiente')
			 ->setCellValue('AI1', 'nom_tipo_inscripcion')
			 ->setCellValue('AJ1', 'fecha_inscripcion')
                         ->setCellValue('AK1', 'mes_inscripcion')
                         ->setCellValue('AL1', 'anio_inscripcion')               
                
			 ->setCellValue('AM1', 'ultimo_estudio')
			 ->setCellValue('AN1', 'institucion_estudio')
			 ->setCellValue('AO1', 'nom_id_programa')
			 ->setCellValue('AP1', 'nom_jornada')
			 ->setCellValue('AQ1', 'nom_calendario_academico')
			 ->setCellValue('AR1', 'nom_unidad_negocio')
			 ->setCellValue('AS1', 'nom_programa_tecnico')
			 ->setCellValue('AT1', 'nom_practica_laboral')
			 ->setCellValue('AU1', 'valor_programa')
			 ->setCellValue('AV1', 'descuento')
			 ->setCellValue('AW1', 'valor_neto_pagar')
                         ->setCellValue('AX1', 'forma_pago')
			 ->setCellValue('AY1', 'entidad_financiera')
			 ->setCellValue('AZ1', 'cuota_inicial')
			 ->setCellValue('BA1', 'valor_financiar')
			 ->setCellValue('BB1', 'num_cuotas')
			 ->setCellValue('BC1', 'valor_cuota')
			 ->setCellValue('BD1', 'fecha_mensula_pago')
			 ->setCellValue('BE1', 'conoce_red_social')
			 ->setCellValue('BF1', 'conoce_fachada')
			 ->setCellValue('BG1', 'conoce_volante')
			 ->setCellValue('BH1', 'conoce_radio')
			 ->setCellValue('BI1', 'conoce_referido')
			 ->setCellValue('BJ1', 'conoce_rematricula')
			 ->setCellValue('BK1', 'referido_por')
			 ->setCellValue('BL1', 'nom_promotor')
                         ->setCellValue('BM1', 'nom_matriculado');	
        
        
        
				
				
            /* Agrega colores */
            cellColor('A1', 'B6D5FC');
            cellColor('B1', 'B6D5FC');
            cellColor('C1', 'B6D5FC');
            cellColor('D1', 'B6D5FC');
            cellColor('E1', 'B6D5FC');
            cellColor('F1', 'B6D5FC');
            cellColor('G1', 'B6D5FC');
            cellColor('H1', 'B6D5FC');
            cellColor('I1', 'B6D5FC');
            cellColor('J1', 'B6D5FC');
            cellColor('K1', 'B6D5FC');
            cellColor('L1', 'B6D5FC');
            cellColor('M1', 'B6D5FC');
            cellColor('N1', 'B6D5FC');
            cellColor('O1', 'B6D5FC');
            cellColor('P1', 'B6D5FC');
            cellColor('Q1', 'B6D5FC');
            cellColor('R1', 'B6D5FC');
            cellColor('S1', 'B6D5FC');
            cellColor('T1', 'B6D5FC');
            cellColor('U1', 'B6D5FC');
            cellColor('V1', 'B6D5FC');
            cellColor('W1', 'B6D5FC');
            cellColor('X1', 'B6D5FC');
            cellColor('Y1', 'B6D5FC');
            cellColor('Z1', 'B6D5FC');
            cellColor('AA1', 'B6D5FC');
            cellColor('AB1', 'B6D5FC');
            cellColor('AC1', 'B6D5FC');
            cellColor('AD1', 'B6D5FC');
            cellColor('AE1', 'B6D5FC');
            cellColor('AF1', 'B6D5FC');
            cellColor('AG1', 'B6D5FC');
            cellColor('AH1', 'B6D5FC');
            cellColor('AI1', 'B6D5FC');
            cellColor('AJ1', 'B6D5FC');
            cellColor('AK1', 'B6D5FC');
            cellColor('AL1', 'B6D5FC');
            cellColor('AM1', 'B6D5FC');
            cellColor('AN1', 'B6D5FC');
            cellColor('AO1', 'B6D5FC');
            cellColor('AP1', 'B6D5FC');
            cellColor('AQ1', 'B6D5FC');
            cellColor('AR1', 'B6D5FC');
            cellColor('AS1', 'B6D5FC');
            cellColor('AT1', 'B6D5FC');
            cellColor('AU1', 'B6D5FC');
            cellColor('AV1', 'B6D5FC');
            cellColor('AW1', 'B6D5FC');
            cellColor('AX1', 'B6D5FC');
            cellColor('AY1', 'B6D5FC');
            cellColor('AZ1', 'B6D5FC');
            cellColor('BA1', 'B6D5FC');
            cellColor('BB1', 'B6D5FC');
            cellColor('BC1', 'B6D5FC');
            cellColor('BD1', 'B6D5FC');
            cellColor('BE1', 'B6D5FC');
            cellColor('BF1', 'B6D5FC');
            cellColor('BG1', 'B6D5FC');
            cellColor('BH1', 'B6D5FC');
            cellColor('BI1', 'B6D5FC');
            cellColor('BJ1', 'B6D5FC');
            cellColor('BK1', 'B6D5FC');
            cellColor('BL1', 'B6D5FC');
            cellColor('BM1', 'B6D5FC');
            /*cellColor('BN1', 'B6D5FC');
            cellColor('BO1', 'B6D5FC');
            cellColor('BP1', 'B6D5FC');
            cellColor('BQ1', 'B6D5FC');
            cellColor('BR1', 'B6D5FC');
            cellColor('BS1', 'B6D5FC');
            cellColor('BT1', 'B6D5FC');
            cellColor('BU1', 'B6D5FC');
            cellColor('BV1', 'B6D5FC');
            cellColor('BW1', 'B6D5FC');
            cellColor('BX1', 'B6D5FC');
            cellColor('BY1', 'B6D5FC');
            cellColor('BZ1', 'B6D5FC');
            cellColor('CA1', 'B6D5FC');
            cellColor('CB1', 'B6D5FC');
            cellColor('CC1', 'B6D5FC');
            cellColor('CD1', 'B6D5FC');*/
            
        
	$contador = 2;
	
        foreach($tabla_registro as $value) {
            
            
            $tabla_edad_persona = $dbRegistroPersonas->CalcularEdadPersona($value['format_fecha_nacimiento'], $value['format_fecha_inscripcion']);
            $edad_anios = $tabla_edad_persona['anios'];
            $grupo_edad = $tabla_edad_persona['grupo_edad'];
            
            $mes_inscripcion = $value['mes_inscripcion'];
            $nom_mes_inscripcion = obtener_nombre_mes($mes_inscripcion);
            $anio_inscripcion = $value['anio_inscripcion'];
            
            
            $ultimo_estudio = $value['ultimo_estudio'];
            $nom_id_ultimo_estudio = $value['nom_id_ultimo_estudio'];

            if($ultimo_estudio==0){
                $ultimo_estudio = $nom_id_ultimo_estudio;
            }
            
            $entidad_financiera = $value['entidad_financiera'];
            $nom_id_entidad_financiera = $value['nom_id_entidad_financiera'];

            if($entidad_financiera == "NULL" || $entidad_financiera == 0){
                $entidad_financiera=$nom_id_entidad_financiera;    
            }
            
            $nom_forma_pago = $value['nom_id_forma_pago'];
            
            
            //
            $objPHPExcel->getActiveSheet()                    
                    
                         ->setCellValue('A' . $contador, $value['nom_tipo_documento'])
			 ->setCellValue('B' . $contador, $value['documento_persona'])
			 ->setCellValue('C' . $contador, $value['lugar_documento'])
			 ->setCellValue('D' . $contador, $value['fecha_documento'])
			 ->setCellValue('E' . $contador, $value['nombre_persona'])
			 ->setCellValue('F' . $contador, $value['apellido_persona'])                    
                         ->setCellValue('G' . $contador, $value['apellido_persona']." ".$value['nombre_persona'])                      
			 ->setCellValue('H' . $contador, $value['fecha_nacimiento'])
                         ->setCellValue('I' . $contador, $edad_anios)
                         ->setCellValue('J' . $contador, $grupo_edad)                    
                    
                    
			 ->setCellValue('K' . $contador, $value['lugar_nacimiento'])
			 ->setCellValue('L' . $contador, $value['nom_sexo'])
			 ->setCellValue('M' . $contador, $value['nom_tipo_sangre'])
			 ->setCellValue('N' . $contador, $value['tel_casa_persona'])
			 ->setCellValue('O' . $contador, $value['tel_movil_persona'])
			 ->setCellValue('P' . $contador, $value['email_persona'])
			 ->setCellValue('Q' . $contador, $value['nom_estado_civil'])
			 ->setCellValue('R' . $contador, $value['direccion_casa'])
			 ->setCellValue('S' . $contador, $value['ciudad_residencia'])
			 ->setCellValue('T' . $contador, $value['barrio_residencia'])
			 ->setCellValue('U' . $contador, $value['nom_estrato_persona'])
			 ->setCellValue('V' . $contador, $value['eps'])
			 ->setCellValue('W' . $contador, $value['nombre_contacto_1'])
			 ->setCellValue('X' . $contador, $value['telefono_contacto_1'])
			 ->setCellValue('Y' . $contador, $value['parentesco_contacto_1'])
			 ->setCellValue('Z' . $contador, $value['nombre_contacto_2'])
			 ->setCellValue('AA' . $contador, $value['telefono_contacto_2'])
			 ->setCellValue('AB' . $contador, $value['parentesco_contacto_2'])
			 ->setCellValue('AC' . $contador, $value['nombre_contacto_3'])
			 ->setCellValue('AD' . $contador, $value['telefono_contacto_3'])
			 ->setCellValue('AE' . $contador, $value['parentesco_contacto_3'])
			 ->setCellValue('AF' . $contador, $value['nombre_acudiente'])
			 ->setCellValue('AG' . $contador, $value['telefono_acudiente'])
			 ->setCellValue('AH' . $contador, $value['parentesco_acudiente'])
			 ->setCellValue('AI' . $contador, $value['nom_tipo_inscripcion'])
			 ->setCellValue('AJ' . $contador, $value['fecha_inscripcion'])
                         ->setCellValue('AK' . $contador, $nom_mes_inscripcion)
                         ->setCellValue('AL' . $contador, $anio_inscripcion)
			 ->setCellValue('AM' . $contador, $ultimo_estudio)                    
                    
			 ->setCellValue('AN' . $contador, $value['institucion_estudio'])
			 ->setCellValue('AO' . $contador, $value['nom_id_programa'])
			 ->setCellValue('AP' . $contador, $value['nom_jornada'])
			 ->setCellValue('AQ' . $contador, $value['nom_calendario_academico'])
			 ->setCellValue('AR' . $contador, $value['nom_unidad_negocio'])
			 ->setCellValue('AS' . $contador, $value['nom_programa_tecnico'])
			 ->setCellValue('AT' . $contador, $value['nom_practica_laboral'])
			 ->setCellValue('AU' . $contador, $value['valor_programa'])
			 ->setCellValue('AV' . $contador, $value['descuento'])
			 ->setCellValue('AW' . $contador, $value['valor_neto_pagar'])
                    
                         ->setCellValue('AX' . $contador, $nom_forma_pago)
                    
			 ->setCellValue('AY' . $contador, $entidad_financiera)
			 ->setCellValue('AZ' . $contador, $value['cuota_inicial'])
			 ->setCellValue('BA' . $contador, $value['valor_financiar'])
			 ->setCellValue('BB' . $contador, $value['num_cuotas'])
			 ->setCellValue('BC' . $contador, $value['valor_cuota'])
			 ->setCellValue('BD' . $contador, $value['fecha_mensula_pago'])
			 ->setCellValue('BE' . $contador, $value['conoce_red_social'])
			 ->setCellValue('BF' . $contador, $value['conoce_fachada'])
			 ->setCellValue('BG' . $contador, $value['conoce_volante'])
			 ->setCellValue('BH' . $contador, $value['conoce_radio'])
			 ->setCellValue('BI' . $contador, $value['conoce_referido'])
			 ->setCellValue('BJ' . $contador, $value['conoce_rematricula'])
			 ->setCellValue('BK' . $contador, $value['referido_por'])
			 ->setCellValue('BL' . $contador, $value['nom_promotor'])
                         ->setCellValue('BM' . $contador, $value['nom_tipo_matriculado']);			
             $contador++;
        }
		
		
		/*
		->setCellValue('AY1', 'incad_redes')
			 ->setCellValue('AZ1', 'incad_fachada')
			 ->setCellValue('BA1', 'incad_volantes')
			 ->setCellValue('BB1', 'incad_radio')
			 ->setCellValue('BC1', 'incad_referido')
			 ->setCellValue('BD1', 'incad_rematricula')
			 ->setCellValue('BE1', 'referido_por')
			 ->setCellValue('BF1', 'nom_promotor');	
		*/

	//Se renombra la hoja	
        $objPHPExcel->getActiveSheet()->setTitle("Base");
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet        
        $objPHPExcel->setActiveSheetIndex(0);        
        $nombreArchivo = "Base - INCAD";	

        // Redirect output to a client's web browser (Excel2007)
        /*
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
        header('Content-Disposition: attachment;filename="'.$nombreArchivo.'.xlsx"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
        ob_end_clean(); 
        $objWriter->save('php://output'); 
        */        
        $write = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $write->save('tmp/'.$nombreArchivo.'.xlsx');
        
        echo"<h3>Permitir ventanas emergentes para descargar el archivo</h3>";
            ?>
            <script id='ajax'>
                var url="tmp/<?php echo($nombreArchivo);?>.xlsx";    
                window.open(url);
            </script>

            <?php
            
            
            
        
        
        
        
        
        
        
        exit;
	

?>


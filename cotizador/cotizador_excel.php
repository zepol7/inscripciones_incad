<?php
session_start();

require_once("../db/DbListas.php");
require_once("../db/DbRegistroPersonas.php");
require_once("../funciones/Utilidades.php");
require_once '../funciones/PHPExcel/Classes/PHPExcel.php';


$listas = new DbListas();
$dbRegistroPersonas = new DbRegistroPersonas();
$utilidades = new Utilidades();



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
        $tabla_registro = $_SESSION["excel_tabla_listas_cotizador"];
        
        
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
        
		
		
        $objPHPExcel->getActiveSheet()                	
			 ->setCellValue('A1', 'fecha_cotizador')
			 ->setCellValue('B1', 'nombre_completo')
			 ->setCellValue('C1', 'tel_casa_persona')
			 ->setCellValue('D1', 'tel_movil_persona')
			 ->setCellValue('E1', 'email_persona')
			 ->setCellValue('F1', 'observaciones_cotiza')
                         ->setCellValue('G1', 'nombre_programa');	
				
            /* Agrega colores */
            cellColor('A1', 'B6D5FC');
            cellColor('B1', 'B6D5FC');
            cellColor('C1', 'B6D5FC');
            cellColor('D1', 'B6D5FC');
            cellColor('E1', 'B6D5FC');
            cellColor('F1', 'B6D5FC');
            cellColor('G1', 'B6D5FC');
            
        
	$contador = 2;
	
        foreach($tabla_registro as $value) {
            
            $objPHPExcel->getActiveSheet()                    
                    
                         ->setCellValue('A' . $contador, $value['fecha_cotizador'])
			 ->setCellValue('B' . $contador, $value['nombre_completo'])
			 ->setCellValue('C' . $contador, $value['tel_casa_persona'])
			 ->setCellValue('D' . $contador, $value['tel_movil_persona'])
			 ->setCellValue('E' . $contador, $value['email_persona'])
			 ->setCellValue('F' . $contador, $value['observaciones_cotiza'])                    
                         ->setCellValue('G' . $contador, $value['nombre_programa']);			
             $contador++;
        }
		

	//Se renombra la hoja	
        $objPHPExcel->getActiveSheet()->setTitle("Base");
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet        
        $objPHPExcel->setActiveSheetIndex(0);        
        $nombreArchivo = "Cotizaciones - INCAD";	

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


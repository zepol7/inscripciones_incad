<?php
session_start();

require_once("../db/DbListas.php");
require_once("../db/DbEmpresas.php");
require_once("../db/DbRegistroPersonas.php");
require_once("../funciones/Utilidades.php");
require_once '../funciones/PHPExcel/Classes/PHPExcel.php';


$listas = new DbListas();
$dbRegistroPersonas = new DbRegistroPersonas();
$utilidades = new Utilidades();
$dbEmpresas = new DbEmpresas();
$tabla_conoce_incad=$listas->getListaDetalles(8);

//$opcion = $utilidades->str_decode($_POST["opcion"]);

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
        $tabla_registro = $_SESSION["excel_tabla_empresas"];
        
        
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
        

		
		
        $objPHPExcel->getActiveSheet()                	
			 ->setCellValue('A1', 'id_empresa')
			 ->setCellValue('B1', 'nit_empresa')
			 ->setCellValue('C1', 'nombre_empresa')
			 ->setCellValue('D1', 'direccion_empresa')
			 ->setCellValue('E1', 'nombre_contacto')
			 ->setCellValue('F1', 'telefono1_contacto')
                         ->setCellValue('G1', 'nombre_contacto2')                        
			 ->setCellValue('H1', 'telefono2_contacto')
                         ->setCellValue('I1', 'email_contacto')
                         ->setCellValue('J1', 'email_contacto2')                  
                         ->setCellValue('K1', 'observaciones_empresa')
                         ->setCellValue('L1', 'nombre_programa');	
        
				
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
            
        
	$contador = 2;
        
	
        foreach($tabla_registro as $value) {
            
            $id_empresa = $value['id_empresa'];
            $nit_empresa = $value['nit_empresa'];
            $nombre_empresa = $value['nombre_empresa'];
            $direccion_empresa = $value['direccion_empresa'];
            $nombre_contacto = $value['nombre_contacto'];
            $telefono1_contacto = $value['telefono1_contacto'];
            $nombre_contacto2 = $value['nombre_contacto2'];
            $telefono2_contacto = $value['telefono2_contacto'];
            $email_contacto = $value['email_contacto'];
            $email_contacto2 = $value['email_contacto2'];
            $observaciones_empresa = $value['observaciones_empresa'];
            $id_usuario_crea = $value['id_usuario_crea'];
            $fecha_crea = $value['fecha_crea'];
            $id_usuario_mod = $value['id_usuario_mod'];
            $fecha_mod = $value['fecha_mod'];
            $nombre_programa = $value['nombre_programa'];

            
            
            //
            $objPHPExcel->getActiveSheet()                    
                    
                        ->setCellValue('A' . $contador, $value['id_empresa'])
                        ->setCellValue('B' . $contador, $value['nit_empresa'])
                        ->setCellValue('C' . $contador, $value['nombre_empresa'])
                        ->setCellValue('D' . $contador, $value['direccion_empresa'])
                        ->setCellValue('E' . $contador, $value['nombre_contacto'])
                        ->setCellValue('F' . $contador, $value['telefono1_contacto'])
                        ->setCellValue('G' . $contador, $value['nombre_contacto2'])
                        ->setCellValue('H' . $contador, $value['telefono2_contacto'])
                        ->setCellValue('I' . $contador, $value['email_contacto'])
                        ->setCellValue('J' . $contador, $value['email_contacto2'])
                        ->setCellValue('K' . $contador, $value['observaciones_empresa'])
                        ->setCellValue('L' . $contador, $value['nombre_programa']);			
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
        $nombreArchivo = "Base - INCAD - Empresas";	

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


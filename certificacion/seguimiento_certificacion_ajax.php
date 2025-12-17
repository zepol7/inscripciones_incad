<?php
session_start();

require_once("../funciones/get_idioma.php");
require_once("../funciones/Class_Barra_Progreso.php");
require_once("../db/DbRegistroPersonas.php");
require_once("../db/DbCertificacion.php");
require_once("../db/DbListas.php");
require_once("../db/DbPerfiles.php");
require_once("../funciones/Utilidades.php");
require_once("../funciones/Class_Combo_Box.php");
require_once("../principal/ContenidoHtml.php");
require_once("../funciones/Class_Generar_Clave.php");
require_once '../funciones/PHPExcel/Classes/PHPExcel.php';

$dbRegistroPersonas = new DbRegistroPersonas();
$dbListas = new DbListas();
$dbPefiles = new DbPerfiles();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
$dbCertificacion = new DbCertificacion();
$barra_progreso = new Barra_Progreso();

$combo = new Combo_Box();

$id_usuario = $_SESSION["idUsuario"];


function cellColor($objPHPExcel, $cells, $color) {
    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()
            ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array('rgb' => $color)
    ));
}



function exportar_hoja_calcula_certifica_estudiante($tabla_base){

    
    $objPHPExcel = new PHPExcel();
    
    
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

    //Propiedades del documento

    $objPHPExcel->getProperties()->setCreator("INCAD")
                                ->setLastModifiedBy("INCAD")
                                ->setTitle("INCAD")
                                ->setSubject("INCAD")
                                ->setDescription("INCAD")
                                ->setKeywords("INCAD")
                                ->setCategory("INCAD");
    //BASE
    $tabla_registro = $tabla_base;
        
        
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
        

    /*
    ->setCellValue('A1', 'Tipo Documento')
    ->setCellValue('B1', 'Documento')         
    ->setCellValue('C1', 'Nombre Estudiante')
    ->setCellValue('D1', 'Apellido Estudiante')
    ->setCellValue('E1', 'Teléfono casa')
    ->setCellValue('F1', 'Teléfono Movil')
    ->setCellValue('G1', 'Email')
    ->setCellValue('H1', 'Fecha inscripción')          
    ->setCellValue('I1', 'Jornada')
    ->setCellValue('J1', 'Unidad Negocio')
    ->setCellValue('K1', 'Calendario académico')
    ->setCellValue('L1', 'Programa')
    ->setCellValue('M1', 'Capacitado')
    ->setCellValue('N1', 'Opciones de Certificación')
    ->setCellValue('O1', 'Hoja de vida')
    ->setCellValue('P1', 'Coor Académica')
    ->setCellValue('Q1', 'Cartera')
    ->setCellValue('R1', 'Estado de Certificación')
    ->setCellValue('S1', 'Observación Estado de Certificación');
    */
		
    $objPHPExcel->getActiveSheet()                	
                ->setCellValue('A1', 'Tipo Documento')
                ->setCellValue('B1', 'Documento')
                ->setCellValue('C1', 'Nombre Estudiante')
                ->setCellValue('D1', 'Apellido Estudiante')
                ->setCellValue('E1', 'Teléfono casa')
                ->setCellValue('F1', 'Teléfono Movil')
                ->setCellValue('G1', 'Email')
                ->setCellValue('H1', 'Fecha inscripción')          
                ->setCellValue('I1', 'Jornada')
                ->setCellValue('J1', 'Unidad Negocio')
                ->setCellValue('K1', 'Calendario académico')
                ->setCellValue('L1', 'Programa')            
            
            
                ->setCellValue('M1', 'Estado Proceso')
                ->setCellValue('N1', 'Opciones de Certificación')
                ->setCellValue('O1', 'Empresa')
                
                ->setCellValue('P1', 'Fecha Inicio')
                ->setCellValue('Q1', 'Fecha Finalización')
                ->setCellValue('R1', 'Estado de Certificación')
                ->setCellValue('S1', 'Observación Estado de Certificación')
                ->setCellValue('T1', 'Capacitado')                     
                ->setCellValue('U1', 'Hoja de vida')
                ->setCellValue('V1', 'Coor Académica')
                ->setCellValue('W1', 'Cartera')
                ->setCellValue('X1', 'Carta de Presentacion')
                ->setCellValue('Y1', 'Contrato de Aprendizaje')
                ->setCellValue('Z1', 'Calificación')
                ->setCellValue('AA1', 'Certificación')
                ->setCellValue('AB1', 'Formato de Pasantia')
                ->setCellValue('AC1', 'Solicitud Académica')
                ->setCellValue('AD1', 'Certificacion Laboral')
                ->setCellValue('AE1', 'Estado Graduado');
    
    cellColor($objPHPExcel, 'A1', 'B6D5FC');
    cellColor($objPHPExcel, 'B1', 'B6D5FC');
    cellColor($objPHPExcel, 'C1', 'B6D5FC');
    cellColor($objPHPExcel, 'D1', 'B6D5FC');
    cellColor($objPHPExcel, 'E1', 'B6D5FC');
    cellColor($objPHPExcel, 'F1', 'B6D5FC');
    cellColor($objPHPExcel, 'G1', 'B6D5FC');
    cellColor($objPHPExcel, 'H1', 'CEF6F5');
    cellColor($objPHPExcel, 'I1', 'CEF6F5');
    cellColor($objPHPExcel, 'J1', 'CEF6F5');
    cellColor($objPHPExcel, 'K1', 'CEF6F5');
    cellColor($objPHPExcel, 'L1', 'CEF6F5');
    
    cellColor($objPHPExcel, 'M1', '04B486');
    cellColor($objPHPExcel, 'N1', '04B486');
    cellColor($objPHPExcel, 'O1', '04B486');
    
    cellColor($objPHPExcel, 'P1', '04B486');
    cellColor($objPHPExcel, 'Q1', '04B486');
    cellColor($objPHPExcel, 'R1', '04B486');
    cellColor($objPHPExcel, 'S1', '04B486');
    cellColor($objPHPExcel, 'T1', '01A9DB');
    cellColor($objPHPExcel, 'U1', '01A9DB');
    cellColor($objPHPExcel, 'V1', '01A9DB');
    cellColor($objPHPExcel, 'W1', '01A9DB');
    cellColor($objPHPExcel, 'X1', 'B6D5FC');
    cellColor($objPHPExcel, 'Y1', 'B6D5FC');
    cellColor($objPHPExcel, 'Z1', 'B6D5FC');
    cellColor($objPHPExcel, 'AA1', 'B6D5FC');
    cellColor($objPHPExcel, 'AB1', 'B6D5FC');
    cellColor($objPHPExcel, 'AC1', 'B6D5FC');
    cellColor($objPHPExcel, 'AD1', 'B6D5FC');
    cellColor($objPHPExcel, 'AE1', 'B6D5FC');
    
    $contador = 2;
	
        foreach($tabla_registro as $value) {
            
            //Estados certificacion
            @$cert_carta = $value['cert_carta'];
            @$cert_contrato = $value['cert_contrato'];
            @$cert_calificacion = $value['cert_calificacion'];
            @$cert_certificacion = $value['cert_certificacion'];
            @$cert_fecha_ini = $value['cert_fecha_ini'];
            @$cert_fecha_fin = $value['cert_fecha_fin'];
            @$cert_pasantia = $value['cert_pasantia'];
            @$cert_solicitud_academica = $value['cert_solicitud_academica'];
            @$cert_laboral = $value['cert_laboral'];
            
            @$nombre_empresa = $value['nombre_empresa'];
            
            @$estado_capacita = $value['estado_capacita'];
            
            if($nombre_empresa==""){
                $nombre_empresa="NO VINCULADO";
            }
                                
            //Estado de boton capacitacion y lista de productividad
            if($estado_capacita==1){
                $nom_capacita="Si";
            }
            else{
                $nom_capacita="No";
            }
            
            
            @$estado_grado = $value['estado_grado'];
            $val_estado_grado = "No";
            if($estado_grado == 1){
                $val_estado_grado = "Si";
            }
            
            
            @$observacion_profesor = $value['observacion_profesor'];
            @$fecha_hv = $value['fecha_hv'];
            @$ruta_archivo_hv = $value['ruta_archivo_hv'];

            if($ruta_archivo_hv!=""){
                $msg_hoja_vida = "Si";
            }
            else{
                $msg_hoja_vida = "No";
            }

            @$estado_coor_acade = $value['estado_coor_acade'];
            @$estado_coor_cartera = $value['estado_cartera'];

            $btn_academica="Pendiente";
            if($estado_coor_acade==1){
                $btn_academica="Pendiente";                                    
            }else if($estado_coor_acade==2){
                $btn_academica="Si";                                    
            }else if($estado_coor_acade==3){
                $btn_academica="No";                                    
            }

            $btn_cartera="Pendiente";
            if($estado_coor_cartera==1){
                $btn_cartera="Pendiente";                                    
            }else if($estado_coor_cartera==2){
                $btn_cartera="Si";                                    
            }else if($estado_coor_cartera==3){
                $btn_cartera="No";                                    
            }
            
            
            @$estado_productividad = $value['estado_productividad'];
            
            if($estado_productividad==53){//Contrato de Aprendizaje
                
                
                $check_carta="No";
                if($cert_carta==1){$check_carta="Si";}
                $check_contrato="No";
                if($cert_contrato==1){$check_contrato="Si";}
                $check_calificacion="No";
                if($cert_calificacion==1){$check_calificacion="Si";}
                $check_certificacion="No";
                if($cert_certificacion==1){$check_certificacion="Si";}
                
                $check_pasantia="N/A";
                $check_solicitud_academica="N/A";
                $check_laboral="N/A";  
                
            }
            else if($estado_productividad==54){//Pasantía
                
                $check_carta="No";
                if($cert_carta==1){$check_carta="Si";}
                $check_contrato="N/A";
                $check_calificacion="N/A";
                $check_certificacion="No";
                if($cert_certificacion==1){$check_certificacion="Si";}
                $check_pasantia="No";
                if($cert_pasantia==1){$check_pasantia="Si";}                
                $check_solicitud_academica="N/A";                
                $check_laboral="N/A";
            
            }
            else if($estado_productividad==55){//Vínculo Laboral
                
                
                $check_carta="N/A";                
                $check_contrato="N/A";                
                $check_calificacion="N/A";                
                $check_certificacion="N/A";               
                $check_pasantia="N/A";                               
                $check_solicitud_academica="No";
                if($cert_solicitud_academica==1){$check_solicitud_academica="Si";}                
                $check_laboral="No";
                if($cert_laboral==1){$check_laboral="Si";}
            
            }     
            
            
            @$id_estudiante_empresa = $value['id_estudiante_empresa'];
            if($id_estudiante_empresa == null){

                $estado_vinculado_empresa = "No Vinculado";
            }
            else{
                $estado_vinculado_empresa = "Vinculado";
            }
            
            
           
            $objPHPExcel->getActiveSheet()
            ->setCellValue('A' . $contador, $value['nom_tipo_documento'])
            ->setCellValue('B' . $contador, $value['documento_persona'])            
            ->setCellValue('C' . $contador, $value['apellido_persona'])
            ->setCellValue('D' . $contador, $value['nombre_persona'])          
            ->setCellValue('E' . $contador, $value['tel_casa_persona'])
            ->setCellValue('F' . $contador, $value['tel_movil_persona'])
            ->setCellValue('G' . $contador, $value['email_persona'])
            ->setCellValue('H' . $contador, $value['fecha_inscripcion'])
            ->setCellValue('I' . $contador, $value['nom_jornada'])
            ->setCellValue('J' . $contador, $value['nom_unidad_negocio'])
            ->setCellValue('K' . $contador, $value['nom_calendario_academico'])
            ->setCellValue('L' . $contador, $value['nom_id_programa'])
            
            ->setCellValue('M' . $contador, $estado_vinculado_empresa)
            ->setCellValue('N' . $contador, $value['nom_estado_productividad'])
            ->setCellValue('O' . $contador, $nombre_empresa)
                    
            ->setCellValue('P' . $contador, $value['fecha_ini'])
            ->setCellValue('Q' . $contador, $value['fecha_fin'])
                    
            ->setCellValue('R' . $contador, $value['nom_estado_certificacion'])
            ->setCellValue('S' . $contador, $value['observacion_estado_certificacion'])
            ->setCellValue('T' . $contador, $nom_capacita)            
            ->setCellValue('U' . $contador, $msg_hoja_vida)
            ->setCellValue('V' . $contador, $btn_academica)
            ->setCellValue('W' . $contador, $btn_cartera) 
            ->setCellValue('X' . $contador, $check_carta)
            ->setCellValue('Y' . $contador, $check_contrato)
            ->setCellValue('Z' . $contador, $check_calificacion)
            ->setCellValue('AA' . $contador, $check_certificacion)
            ->setCellValue('AB' . $contador, $check_pasantia)
            ->setCellValue('AC' . $contador, $check_solicitud_academica)
            ->setCellValue('AD' . $contador, $check_laboral)
            ->setCellValue('AE' . $contador, $val_estado_grado);            
             $contador++;
        }
		
	
        /*$objPHPExcel->getActiveSheet()->setTitle("Base");
        $objPHPExcel->setActiveSheetIndex(0);        
        $nombreArchivo = "Base - INCAD";	
        $write = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $write->save('tmp/'.$nombreArchivo.'.xlsx');*/
        
        
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle("Base");
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet        
        $objPHPExcel->setActiveSheetIndex(0);        

        //Se borra el reporte previamente generado por el usuario
        @unlink("../tmp/reporte_estudiantes_certifica_reportes.xlsx");			
        // Save Excel 2007 file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save("../tmp/reporte_estudiantes_certifica_reportes.xlsx");
		
	?>
		
            <br />
            <table class="modal_table" style="width:10px; margin: auto;" border="1">
            <thead>
                <tr>
                <td style="text-align: center;">            	
                <div style="width: 140px;" onclick="window.open('../tmp/reporte_estudiantes_certifica_reportes.xlsx','_blank');">
                    <div class="div_link_xls">&nbsp;</div>
                    <div style="text-align:center; font-size: 12px; font-weight: 600; cursor: pointer;">
                            <b>Exportar a <br />Hoja de calculo</b>
                    </div>
                </div>			
                </td>
                </tr>
            </thead>

            </table>
          <?php   
    
}



if (isset($_POST["hdd_numero_menu"])) {
    $tipo_acceso_menu = $contenido->obtener_permisos_menu($_POST["hdd_numero_menu"]);
}

$opcion = $_POST["opcion"];
if ($opcion != "5" && $opcion != "6") {
    header('Content-Type: text/xml; charset=UTF-8');
}



switch ($opcion) {
    case "1": //Listar Estudiantes
        
    	$combo = new Combo_Box();		
	$id_programa = $_POST["id_programa"];
        $jornada = $_POST["jornada"];        
        $calendario_academico = $_POST["calendario_academico"];
        $txt_busca_estudiante = $_POST["txt_busca_estudiante"];
        
        $val_cert_carta = $_POST["cert_carta"];
        $val_cert_contrato = $_POST["cert_contrato"]; 
        $val_cert_calificacion = $_POST["cert_calificacion"];
        $val_cert_certificacion = $_POST["cert_certificacion"];
        $val_cert_pasantia = $_POST["cert_pasantia"];
        $val_cert_solicitud_academica = $_POST["cert_solicitud_academica"];
        $val_cert_laboral = $_POST["cert_laboral"];
        
        $tabla_estudiantes = $dbCertificacion->getListaEstudiantesCertificacion($jornada, $id_programa, $calendario_academico, $txt_busca_estudiante, $val_cert_carta, $val_cert_contrato, $val_cert_calificacion, $val_cert_certificacion, $val_cert_pasantia, $val_cert_solicitud_academica, $val_cert_laboral);
        $tabla_programa = $dbListas->getItemListaDetalleEditable($id_programa);
        $nombre_programa = $tabla_programa['nombre_lista_editable_detalle'];
        
        $tabla_calendario = $dbListas->getItemListaDetalleEditable($calendario_academico);
        $nombre_calendario = $tabla_calendario['nombre_lista_editable_detalle'];        
        
        $tabla_perfiles = $dbPefiles->getNombrePerfil($_SESSION["idUsuario"]);
        
        ?>
        <br />
        <div class="row">
        <div class="col-md-12">
        <div class="table-responsive">
            <div id="paginador" class="centrar">
                <nav>
                    <ul class="pagination">
                    </ul>
                </nav>
            </div>
            <table class="table table-bordered paginated">
                <thead>
                    <tr><th colspan='12' style="text-align: center;">Listado de Estudiantes - <?php echo($nombre_programa." <br /> Calendario: ".$nombre_calendario);?> </th></tr>
                    <tr>
                        <th style="width:100px; text-align: center;">Documento</th>
                        <th style="width:200px; text-align: center;">Nombre Estudiante</th>
                        <th style="width:100px; text-align: center;">Fecha de Inscripci&oacute;n</th>
                        <th style="width:100px; text-align: center;">Tel&eacute;fonos de Contacto</th>
                        <th style="width:100px; text-align: center;">Empresa</th>
                        <th style="width:100px; text-align: center;">Opciones de Certificaci&oacute;n</th>
                        <th style="width:500px; text-align: center;">Etapas</th>
                        <th style="width:500px; text-align: center;">Graduado</th>
                    </tr>
                </thead>
                <?php
                $cantidad_registro = count($tabla_estudiantes);
                $i = 1;
                if ($cantidad_registro > 0) {
                    foreach ($tabla_estudiantes as $fila_estudiantes) {

                        //Datos de la inscripcion
                        @$id_academica = $fila_estudiantes['id_academica'];
                        @$fecha_inscripcion = $fila_estudiantes['fecha_inscripcion'];
                        @$estado_capacita = $fila_estudiantes['estado_capacita'];

                        //Estado de boton capacitacion y lista de productividad
                        if($estado_capacita==1){
                            $check_capacita="checked";
                            $combo_productiva="1";
                        }
                        else{
                            $check_capacita="";
                            $combo_productiva="0";                                    
                        }

                        @$estado_productividad = $fila_estudiantes['estado_productividad'];
                        @$observacion_profesor = $fila_estudiantes['observacion_profesor'];
                        @$fecha_hv = $fila_estudiantes['fecha_hv'];
                        @$ruta_archivo_hv = $fila_estudiantes['ruta_archivo_hv'];
                        @$estado_coor_acade = $fila_estudiantes['estado_coor_acade'];
                        @$estado_coor_cartera = $fila_estudiantes['estado_cartera'];

                        //Estados certificacion
                        @$cert_carta = $fila_estudiantes['cert_carta'];
                        @$cert_contrato = $fila_estudiantes['cert_contrato'];
                        @$cert_calificacion = $fila_estudiantes['cert_calificacion'];
                        @$cert_certificacion = $fila_estudiantes['cert_certificacion'];
                        @$cert_fecha_ini = $fila_estudiantes['cert_fecha_ini'];
                        @$cert_fecha_fin = $fila_estudiantes['cert_fecha_fin'];
                        @$cert_pasantia = $fila_estudiantes['cert_pasantia'];
                        @$cert_solicitud_academica = $fila_estudiantes['cert_solicitud_academica'];
                        @$cert_laboral = $fila_estudiantes['cert_laboral'];
                        
                        //Estado Graduado
                        @$ver_estado_grado = "";
                        @$estado_grado = $fila_estudiantes['estado_grado'];

                        $check_carta="";
                        if($cert_carta==1){$check_carta="checked";}
                        $check_contrato="";
                        if($cert_contrato==1){$check_contrato="checked";}
                        $check_calificacion="";
                        if($cert_calificacion==1){$check_calificacion="checked";}
                        $check_certificacion="";
                        if($cert_certificacion==1){$check_certificacion="checked";}
                        $check_pasantia="";
                        if($cert_pasantia==1){$check_pasantia="checked";}
                        $check_solicitud_academica="";
                        if($cert_solicitud_academica==1){$check_solicitud_academica="checked";}
                        $check_laboral="";
                        if($cert_laboral==1){$check_laboral="checked";}
                        
                        $check_graduado="";
                        if($estado_grado==1){$check_graduado="checked";}
                        

                        //Datos personales
                        @$id_persona = $fila_estudiantes['id_persona'];
                        @$nombre_persona = $fila_estudiantes['nombre_persona'];
                        @$documento_persona = $fila_estudiantes['documento_persona'];
                        @$apellido_persona = $fila_estudiantes['apellido_persona'];
                        @$tel_casa_persona = $fila_estudiantes['tel_casa_persona'];
                        @$tel_movil_persona = $fila_estudiantes['tel_movil_persona'];
                        @$email_persona = $fila_estudiantes['email_persona'];

                        $nombre_completo = $apellido_persona." ".$nombre_persona;
                        $telefonos = $tel_casa_persona." ".$tel_movil_persona;

                        //Datos Empresa
                        @$nombre_empresa = $fila_estudiantes['nombre_empresa'];
                        
                        if($nombre_empresa==""){
                            $nombre_empresa="<b>NO VINCULADO</b>";
                            $estado_productividad = 0;
                        }
                        
                        @$nombre_etapa_productividad = $fila_estudiantes['nombre_etapa_productividad'];
                        
                        
                        @$id_estudiante_empresa = $fila_estudiantes['id_estudiante_empresa'];
                        
                        if($id_estudiante_empresa == null){
                            
                            $estado_vinculado_empresa = "No Vinculado";
                        }
                        else{
                            $estado_vinculado_empresa = "Vinculado";
                        }
                        


                        ?>
                        <tr style="cursor:pointer;">
                            <td align="left"><?php echo $documento_persona; ?></td>
                            <td align="left"><?php echo $nombre_completo; ?></td>
                            <td align="left"><?php echo $fecha_inscripcion; ?></td>
                            <td align="left"><?php echo $telefonos; ?></td>
                            <td align="left"><?php echo $nombre_empresa; ?></td>
                            <td align="left"><?php echo $nombre_etapa_productividad; ?></td>
                            <td align="center"> 
                            <?php
                            
                            if($estado_productividad==53){//Contrato de Aprendizaje
                                
                                if($cert_carta == 1 && $cert_contrato == 1 && $cert_calificacion == 1 && $cert_certificacion == 1){
                                    $ver_estado_grado="";
                                }
                                else{
                                    $ver_estado_grado="disabled";
                                }
                                    
                                
                            ?>
                                <div class="form-group">
                                    <div class="col-md-3 form-group">
                                    <label for="">Carta</label>
                                    <input <?php echo($check_carta);?>  onchange="certificar_estados(<?php echo($id_academica);?>, 1)" class="class_capacita" id="id_carta_<?php echo($id_academica);?>" type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="default">
                                    <div id="div_carta_<?php echo($id_academica);?>"></div>
                                    </div> 

                                    <div class="col-md-3 form-group">
                                    <label for="">Contrato</label>
                                    <input <?php echo($check_contrato);?> onchange="certificar_estados(<?php echo($id_academica);?>, 2)" class="class_capacita" id="id_contrato_<?php echo($id_academica);?>" type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="default">
                                    <div id="div_contrato_<?php echo($id_academica);?>"></div>
                                    </div> 

                                    <div class="col-md-3 form-group">
                                    <label for="">Calificaci&oacute;n</label>
                                    <input <?php echo($check_calificacion);?>  onchange="certificar_estados(<?php echo($id_academica);?>, 3)" class="class_capacita" id="id_calificacion_<?php echo($id_academica);?>" type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="default">
                                    <div id="div_calificacion_<?php echo($id_academica);?>"></div>
                                    </div> 

                                    <div class="col-md-3 form-group">
                                    <label for="">Certificaci&oacute;n</label>
                                    <input <?php echo($check_certificacion);?>  onchange="certificar_estados(<?php echo($id_academica);?>, 4)" class="class_capacita" id="id_certificacion_<?php echo($id_academica);?>" type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="default">
                                    <div id="div_certificacion_<?php echo($id_academica);?>"></div>
                                    </div> 
                                    <div id="div_estados_certifica_<?php echo($id_academica);?>"></div>
                                </div>
                            <?php
                            }
                            else if($estado_productividad==54){//Pasantía
                                
                                if($cert_carta == 1 && $cert_pasantia == 1 && $cert_certificacion == 1){
                                    $ver_estado_grado="";
                                }
                                else{
                                    $ver_estado_grado="disabled";
                                }
                                
                            ?>
                                <div class="form-group">
                                    <div class="col-md-3 form-group">
                                    <label for="">Carta</label>
                                    <input <?php echo($check_carta);?>  onchange="certificar_estados(<?php echo($id_academica);?>, 1)" class="class_capacita" id="id_carta_<?php echo($id_academica);?>" type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="default">
                                    <div id="div_carta_<?php echo($id_academica);?>"></div>
                                    </div> 

                                    <div class="col-md-4 form-group">
                                    <label for="">Formato Pasantia </label>
                                    <input <?php echo($check_pasantia);?>  onchange="certificar_estados(<?php echo($id_academica);?>, 5)" class="class_capacita" id="id_pasantia_<?php echo($id_academica);?>" type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="default">
                                    <div id="div_pasantia_<?php echo($id_academica);?>"></div>
                                    </div> 

                                    <div class="col-md-3 form-group">
                                    <label for="">Certificaci&oacute;n</label>
                                    <input <?php echo($check_certificacion);?>  onchange="certificar_estados(<?php echo($id_academica);?>, 4)" class="class_capacita" id="id_certificacion_<?php echo($id_academica);?>" type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="default">
                                    <div id="div_certificacion_<?php echo($id_academica);?>"></div>
                                    </div> 
                                    <div id="div_estados_certifica_<?php echo($id_academica);?>"></div>
                                </div>
                            <?php    
                            }
                            else if($estado_productividad==55){//Vínculo Laboral
                                
                                if($cert_solicitud_academica == 1 && $cert_laboral == 1){
                                    $ver_estado_grado="";                                    
                                }
                                else{
                                    $ver_estado_grado="disabled";
                                }
                                
                            ?>
                                <div class="form-group">
                                    <div class="col-md-6 form-group">
                                    <label for="">Solicitud Acad&eacute;mica</label>
                                    <input <?php echo($check_solicitud_academica);?>  onchange="certificar_estados(<?php echo($id_academica);?>, 6)" class="class_capacita" id="id_sol_academica_<?php echo($id_academica);?>" type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="default">
                                    <div id="div_sol_academica_<?php echo($id_academica);?>"></div>
                                    </div> 

                                    <div class="col-md-6 form-group">
                                    <label for="">Certificaci&oacute;n Laboral</label>
                                    <input <?php echo($check_laboral);?>  onchange="certificar_estados(<?php echo($id_academica);?>, 7)" class="class_capacita" id="id_certificacion_lab_<?php echo($id_academica);?>" type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="default">
                                    <div id="div_certificacion_lab_<?php echo($id_academica);?>"></div>
                                    </div> 
                                    <div id="div_estados_certifica_<?php echo($id_academica);?>"></div>
                                </div>
                            <?php    
                            } else if($estado_productividad==0){ //Sin Vínculo Laboral
                            ?>
                                <div class="form-group">
                                    <div class="col-md-12 form-group">
                                    <label for=""><?php echo($nombre_empresa);?></label>
                                    </div> 
                                </div>
                            <?php    
                            }
                            ?>
                            </td>
                            <td align="center" style="width:5%;">
                                
                                <?php
                                if($estado_productividad == 0){
                                ?>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group">
                                        <label for=""><?php echo($nombre_empresa);?></label>
                                        </div> 
                                    </div>
                                <?php
                                }
                                else{
                                ?>
                                    <div class="form-group">
                                        <div class="col-md-12 form-group">
                                            <input <?php echo($check_graduado);?>  onchange="cambiar_estado_graduar(<?php echo($id_academica);?>)"  <?php echo($ver_estado_grado);?>  class="class_capacita" id="id_estado_grado_<?php echo($id_academica);?>" type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="danger" data-offstyle="default">
                                        <div id="div_estado_grado_<?php echo($id_academica);?>"></div>
                                        </div> 
                                        <div id="div_cambio_estado_grado_<?php echo($id_academica);?>"></div>
                                    </div>
                                <?php
                                }
                                ?>
                                
                                
                                
                                
                            </td>
                        </tr>
                        <?php    

                        $i = $i + 1;
                    }
                } else {
                    ?>
                    <tr>
                        <td align="center" colspan="11">No se encontraron datos</td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            
            <?php
            exportar_hoja_calcula_certifica_estudiante($tabla_estudiantes);
            ?>
            
            
        </div>
        </div>
        </div>

        <script id='ajax'>
            $('.class_capacita').bootstrapToggle();
            //<![CDATA[ 
            $(function () {
                $('.paginated', 'table').each(function (i) {
                    $(this).text(i + 1);
                });

                $('table.paginated').each(function () {
                    var currentPage = 0;
                    var numPerPage = 20;
                    var $table = $(this);
                    $table.bind('repaginate', function () {
                        $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
                    });
                    $table.trigger('repaginate');
                    var numRows = $table.find('tbody tr').length;
                    var numPages = Math.ceil(numRows / numPerPage);
                    var $pager = $('.pagination');
                    for (var page = 0; page < numPages; page++) {

                        $('<li><a href="#">' + (page + 1) + '</a></li>').bind('click', {
                            newPage: page
                        }, function (event) {
                            currentPage = event.data['newPage'];
                            $table.trigger('repaginate');
                            $(this).addClass('active').siblings().removeClass('active');

                        }).appendTo($pager);

                    }
                    $pager.appendTo('#paginador').find('li:first').addClass('active');
                });
            });
            //]]>
        </script>
        
        
        <br />
        <?php
        
            
    break;
	
	
    case "2": 
        $id_academica = $_POST["id_academica"];
        $val_resultado = $_POST["val_resultado"];
        $id_tipo = $_POST["id_tipo"];
        $resultado = $dbCertificacion->UpdateEstadoCertifica($id_academica, $val_resultado, $id_tipo);
    break;
	
	
    case "3": 
        ?>
        <!-- Modal -->
        <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            
            <?php
            @$titulo = $_POST["titulo"];
            @$funcion = $_POST["funcion"];
            ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo $titulo; ?></h4>
                    </div>
                    <div class="modal-body centrar">

                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="<?php echo $funcion; ?>;">Si</button>
                    </div>

                </div>
            </div>
        </div>
        <?php
    break;


     case "4": 
       
    break;
    
    
    case "5":
        
    
        
    break;


    case "6": 
        
       
    break;
    
    
    case "7": 
        
       
    break;


    case "8":
    
        
    break;
    
    
    case "9": 
        
       
        
    break;
    
    
    case "10":         
        
    break;

    case "11":         
        
    break;


    case "12":
    
        
    break;



    case "13":
    
        
    break;









	
	
		
		
	
	
	
	
	
}

?>
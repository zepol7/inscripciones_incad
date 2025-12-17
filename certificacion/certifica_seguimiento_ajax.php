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

function exportar_hoja_calcula_activar_estudiantes($tabla_base){

    
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


    //Se crea el objeto PHPExcel

    

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
                     ->setCellValue('M1', 'Opciones de Certificación')            
                     ->setCellValue('N1', 'Capacitado')                     
                     ->setCellValue('O1', 'Hoja de vida')
                     ->setCellValue('P1', 'Coor Académica')
                     ->setCellValue('Q1', 'Cartera')
                     ->setCellValue('R1', 'Estado de Certificación')
                     ->setCellValue('S1', 'Observación Estado de Certificación')
            
                     ->setCellValue('T1', 'Empresa')
                     ->setCellValue('U1', 'Fecha inicio')
                     ->setCellValue('V1', 'Fecha Finalización');
                     /*->setCellValue('W1', '')
                     ->setCellValue('X1', '')
                     ->setCellValue('Y1', '')
                     ->setCellValue('Z1', '')
                     ->setCellValue('AA1', '')
                     ->setCellValue('AB1', '')
                     ->setCellValue('AC1', '')
                     ->setCellValue('AD1', '')
                     ->setCellValue('AE1', '')
                     ->setCellValue('AF1', '')
                     ->setCellValue('AG1', '')
                     ->setCellValue('AH1', '')
                     ->setCellValue('AI1', '');	*/
				
				
        /* Agrega colores */
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
        cellColor($objPHPExcel, 'R1', '01A9DB');
        cellColor($objPHPExcel, 'S1', '01A9DB');
        cellColor($objPHPExcel, 'T1', '01A9DB');
        cellColor($objPHPExcel, 'U1', '01A9DB');
        cellColor($objPHPExcel, 'V1', '01A9DB');
        
        /*cellColor($objPHPExcel, 'T1', '01A9DB');
        cellColor($objPHPExcel, 'U1', 'B6D5FC');
        cellColor($objPHPExcel, 'V1', 'B6D5FC');
        cellColor($objPHPExcel, 'W1', 'B6D5FC');
        cellColor($objPHPExcel, 'X1', 'B6D5FC');
        cellColor($objPHPExcel, 'Y1', 'B6D5FC');
        cellColor($objPHPExcel, 'Z1', 'B6D5FC');
        cellColor($objPHPExcel, 'AA1', 'B6D5FC');*/
        
            
        
	$contador = 2;
	
        foreach($tabla_registro as $value) {
            
            
            
            @$estado_capacita = $value['estado_capacita'];
                                
            //Estado de boton capacitacion y lista de productividad
            if($estado_capacita==1){
                $nom_capacita="Si";
            }
            else{
                $nom_capacita="No";                
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
            ->setCellValue('M' . $contador, $value['nom_estado_productividad'])
            ->setCellValue('N' . $contador, $nom_capacita)            
            ->setCellValue('O' . $contador, $msg_hoja_vida)
            ->setCellValue('P' . $contador, $btn_academica)
            ->setCellValue('Q' . $contador, $btn_cartera)
            ->setCellValue('R' . $contador, $value['nom_estado_certificacion'])
            ->setCellValue('S' . $contador, $value['observacion_estado_certificacion'])
                    
            ->setCellValue('T' . $contador, $value['nombre_empresa'])
            ->setCellValue('U' . $contador, $value['format_fecha_ini'])
            ->setCellValue('V' . $contador, $value['format_fecha_fin']);
            
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
        @unlink("../tmp/reporte_estudiantes_reportes.xlsx");			
        // Save Excel 2007 file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save("../tmp/reporte_estudiantes_reportes.xlsx");
		
	?>
		
            <br />
            <table class="modal_table" style="width:10px; margin: auto;" border="1">
            <thead>
                <tr>
                <td style="text-align: center;">            	
                <div style="width: 140px;" onclick="window.open('../tmp/reporte_estudiantes_reportes.xlsx','_blank');">
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
        
        $estado_capacitacion = $_POST["estado_capacitacion"];
        $estado_productividad = $_POST["estado_productividad"];
        $estado_hoja_vida = $_POST["estado_hoja_vida"];
        $estado_academica = $_POST["estado_academica"];
        $estado_cartera = $_POST["estado_cartera"];
        $tabla_estudiantes = $dbCertificacion->getListaEstudiantes($jornada, $id_programa, $calendario_academico, $txt_busca_estudiante, $estado_capacitacion, $estado_productividad, $estado_hoja_vida, $estado_academica, $estado_cartera);
        $tabla_programa = $dbListas->getItemListaDetalleEditable($id_programa);
        $nombre_programa = $tabla_programa['nombre_lista_editable_detalle'];
        
        $tabla_calendario = $dbListas->getItemListaDetalleEditable($calendario_academico);
        $nombre_calendario = $tabla_calendario['nombre_lista_editable_detalle'];
        
        
        $tabla_perfiles = $dbPefiles->getNombrePerfil($_SESSION["idUsuario"]);
        $es_cartera_academica=0;
        
        foreach($tabla_perfiles as $fila_perfil){
            if($fila_perfil['id_perfil']==3){
                $es_cartera_academica=1;
                break;
            }
            if($fila_perfil['id_perfil']==4){
                $es_cartera_academica=1;
                break;
            }            
        }
        
        
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
                            <tr><th colspan='11' style="text-align: center;">Listado de Estudiantes - <?php echo($nombre_programa." <br /> Calendario: ".$nombre_calendario);?> </th></tr>
                            <tr>
                                <th style="width:5px; text-align: center;">-</th>
                                <th style="width:100px; text-align: center;">Documento</th>
                                <th style="width:200px; text-align: center;">Nombre Estudiante</th>
                                <th style="width:100px; text-align: center;">Fecha de Inscripci&oacute;n</th>
                                <th style="width:100px; text-align: center;">Tel&eacute;fonos de Contacto</th>
                                <th style="width:50px; text-align: center;">Jornada</th>
                                <th style="width:50px; text-align: center;">Calendario</th>
                                
                                <?php
                                if($es_cartera_academica == 0){
                                ?>
                                <!-- <th style="width:100px; text-align: center;">Capacitaci&oacute;n</th>-->
                                <th style="width:100px; text-align: center;">Opciones de Certificación</th>
                                <!-- <th style="width:100px; text-align: center;">Hoja de Vida</th> -->
                                <?php    
                                }
                                ?>                                
                                <th style="width:100px; text-align: center;">Acad&eacute;mica</th>
                                <th style="width:100px; text-align: center;">Cartera</th>
                                <th style="width:100px; text-align: center;">Estado Certificaci&oacute;n</th>
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
                                
                                //$estado_capacita = 1;
                               // echo ($estado_capacita);
                                
                                // echo ($estado_capacita);
                                                                
                                //Estado de boton capacitacion y lista de productividad
                                if($estado_capacita==1){
                                    $check_capacita="checked";
                                    $combo_productiva="1";
                                }
                                else{
                                    $check_capacita="";
                                    $combo_productiva="0";                                    
                                }
                                //Estado cargar HV
                                if($estado_capacita==1 && $combo_productiva > 0){
                                    $estado_cargar = "";
                                }
                                else{
                                    $estado_cargar = "disabled";
                                }                                
                                
                                @$estado_productividad = $fila_estudiantes['estado_productividad'];
                                @$observacion_profesor = $fila_estudiantes['observacion_profesor'];
                                @$fecha_hv = $fila_estudiantes['fecha_hv'];
                                @$ruta_archivo_hv = $fila_estudiantes['ruta_archivo_hv'];
                                
                                //Linea para desactivar el cargue de la hoja de vida                                
                                $ruta_archivo_hv ="N/A";
                                
                                if($ruta_archivo_hv!=""){
                                    $msg_hoja_vida = "Si";
                                }
                                else{
                                    $msg_hoja_vida = "No";
                                }
                                
                                
                                @$estado_coor_acade = $fila_estudiantes['estado_coor_acade'];
                                @$estado_coor_cartera = $fila_estudiantes['estado_cartera'];
                                
                                $btn_academica="Ver";
                                if($estado_coor_acade==1){
                                    $btn_academica="Ver";                                    
                                }else if($estado_coor_acade==2){
                                    $btn_academica="Si";                                    
                                }else if($estado_coor_acade==3){
                                    $btn_academica="No";                                    
                                }
                                
                                $btn_cartera="Ver";
                                if($estado_coor_cartera==1){
                                    $btn_cartera="Ver";                                    
                                }else if($estado_coor_cartera==2){
                                    $btn_cartera="Si";                                    
                                }else if($estado_coor_cartera==3){
                                    $btn_cartera="No";                                    
                                }
                                
                                $class_estado="";
                                $num_estado="0";
                                if($estado_coor_cartera>0){
                                    $class_estado="es_cartera";
                                    $num_estado="5";                                    
                                } else if($estado_coor_acade>0){
                                    $class_estado="es_academica";
                                    $num_estado="4";
                                } else if($ruta_archivo_hv != ""){
                                    $class_estado="es_hoja_vida";
                                    $num_estado="3";
                                } else if($estado_productividad > 0){
                                    $class_estado="es_productiva";
                                    $num_estado="2";
                                } else if($estado_capacita > 0){
                                    $class_estado="es_capacita";
                                    $num_estado="1";
                                }
                                
                                
                                //Estado ceritifcacion
                                @$estado_certificacion = $fila_estudiantes['estado_certificacion'];
                                @$nom_estado_certificacion = $fila_estudiantes['nom_estado_certificacion'];
                                
                                
                                
                                //Datos personales
                                @$id_persona = $fila_estudiantes['id_persona'];
                                @$nombre_persona = $fila_estudiantes['nombre_persona'];
                                @$documento_persona = $fila_estudiantes['documento_persona'];
                                @$apellido_persona = $fila_estudiantes['apellido_persona'];
                                @$tel_casa_persona = $fila_estudiantes['tel_casa_persona'];
                                @$tel_movil_persona = $fila_estudiantes['tel_movil_persona'];
                                @$email_persona = $fila_estudiantes['email_persona'];
                                @$nom_jornada = $fila_estudiantes['nom_jornada'];
                                @$nom_calendario_academico = $fila_estudiantes['nom_calendario_academico'];

                                $nombre_completo = $apellido_persona." ".$nombre_persona;
                                $telefonos = $tel_casa_persona." ".$tel_movil_persona;
                                
                                ?>
                                <tr style="cursor:pointer;">
                                    
                                    <td align="center">
                                        <i class="glyphicon glyphicon-certificate <?php echo($class_estado); ?>"><br /><?php echo($num_estado);?></i>
                                    </td>
                                    <td align="left"><?php echo $documento_persona; ?></td>
                                    <td align="left"><?php echo $nombre_completo; ?></td>
                                    <td align="left"><?php echo $fecha_inscripcion; ?></td>
                                    <td align="left"><?php echo $telefonos; ?></td>
                                    <td align="left"><?php echo $nom_jornada; ?></td>
                                    <td align="left"><?php echo $nom_calendario_academico; ?></td>
                                    <?php
                                    if($es_cartera_academica == 0){
                                    ?>
                                    
                                    <!--<td align="center">
                                        <div class="form-group">
                                        <input <?php echo($check_capacita);?>  onchange="capacitar_persona(<?php echo($id_academica);?>)" class="class_capacita" id="id_capacita_<?php echo($id_academica);?>" type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="default">
                                        </div> 
                                        <div id="div_capacita_<?php echo($id_academica);?>"></div>
                                    </td>-->
                                    <div id="div_capacita_<?php echo($id_academica);?>"></div>
                                    <td align="left">
                                      <?php 
                                      $combo->getComboDb('tipo_productividad_'.$id_academica, $estado_productividad, $dbListas->getListaDetalles(13), 'id_detalle, nombre_detalle', '--Seleccione--', 'seleccionar_productiva('.$id_academica.')', $combo_productiva, '', '', 'form-control');
                                      ?>
                                      <div id="div_productividad_<?php echo($id_academica);?>"></div>
                                    </td>
                                    <!--
                                    <td align="center">
                                        <button id="btn_subir_hv_<?php echo($id_academica);?>" type="button" <?php echo($estado_cargar);?> class="btn btn-info" onclick="form_cargar_hv(<?php echo($id_academica);?>, '<?php echo($id_persona);?>', '<?php echo($nombre_completo);?>')"><?php echo($msg_hoja_vida);?></button> 
                                    </td>-->
                                    <?php    
                                    }
                                    ?>                                    
                                    <td align="center">
                                        <button id="btn_validar_hv_<?php echo($id_academica);?>" type="button" <?php echo($estado_cargar);?> class="btn btn-warning btn_academica" onclick="form_validar(<?php echo($id_academica);?>, '<?php echo($id_persona);?>', '<?php echo($nombre_completo);?>', 1)"><?php echo($btn_academica);?></button> 
                                    </td>
                                    <td align="center">
                                        <button id="btn_validar_hv_<?php echo($id_academica);?>" type="button" <?php echo($estado_cargar);?> class="btn btn-warning btn_cartera" onclick="form_validar(<?php echo($id_academica);?>, '<?php echo($id_persona);?>', '<?php echo($nombre_completo);?>', 2)"><?php echo($btn_cartera);?></button> 
                                    </td>
                                    
                                    <td align="center">
                                        <h4 onclick="form_estado_certificacion(<?php echo($id_academica);?>, '<?php echo($id_persona);?>', '<?php echo($nombre_completo);?>')");"><span class="label label-info"><?php echo($nom_estado_certificacion);?></span></h4>
                                    </td>
                                    
                                    
                                </tr>
                                <?php    
                                
                                $i = $i + 1;
                                
                                
                                if ($estado_capacita==0){
                                    ?>                      
                                    <script id='ajax'>    
                                        capacitar_persona(<?php echo($id_academica);?>);   
                                    </script>
                                    <?php                                    
                                }
                                
                                
                            }
                        } else {
                            ?>
                            <tr>
                                <td align="center" colspan="13">No se encontraron datos</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <?php
                    exportar_hoja_calcula_activar_estudiantes($tabla_estudiantes);
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
        $resultado = $dbCertificacion->UpdateCapacitaRegistro($id_academica, $val_resultado);
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
        $id_academica = $_POST["id_academica"];
        $tipo_productiva = $_POST["tipo_productiva"];						
        $resultado = $dbCertificacion->UpdateEtapaProductiva($id_academica, $tipo_productiva);
        
        if($resultado==1){
        ?>
            <div class="alert alert-success" role="alert" id='exito_productiva' style="display: block; padding: 5px;">Guardado</div>
        <?php
        }
    break;
    
    
    case "5":
        
    ?>
    <!-- Modal -->
    <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <?php
        @$titulo = $_POST["titulo"];
        @$id_academica = $_POST["id_academica"];
        @$nombre_completo = $_POST["nombre_completo"];
        @$id_persona = $_POST["id_persona"];
        
        $tabla_academica=$dbRegistroPersonas->getPersonaAcademica($id_persona, $id_academica);
        
        if(count($tabla_academica)>0){
            @$observacion_profesor = $tabla_academica["observacion_profesor"];
            @$fecha_hv = $tabla_academica["format_fecha_hv"];
            @$ruta_archivo_hv = $tabla_academica["ruta_archivo_hv"];
            @$tipo_accion = 1;
        }
        else{
            @$observacion_profesor = "";
            @$fecha_hv = "";
            @$ruta_archivo_hv = "";
            @$tipo_accion = 0;
        }
        
        
        $estado_ver_file = 'none';
        $estado_up_file = '';
        $val_archivo = 1;
        if($ruta_archivo_hv != ''){
            $estado_ver_file = '';
            $estado_up_file = 'none';
            $val_archivo = 0;
        }
        
        
        ?>
        <input type="hidden" id="hdd_id_academica" name="hdd_id_academica" value="<?php echo($id_academica); ?>"></input>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo $titulo.": <b>".$nombre_completo; ?> </b></h4>
                </div>
                <div class="modal-body centrar">                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger contenedor_error" role="alert" id='contenedor_error_subir_hv'></div>
                            <div class="alert alert-success contenedor_exito" role="alert" id='contenedor_exito_subir_hv'></div>
                        </div>
                    </div>                    
                    
                <div class="modal-body centrar">
                    <div class="panel-body">
                    <div class="row"> 
                      <div class="form-group">  
                            <input type="hidden" id="hdd_val_archivo" name="hdd_val_archivo" value="<?php echo($val_archivo);?>" />
                            
                            <div id="input_subir_hv" style="display:<?php echo($estado_up_file);?>">
                            
                                <div class="col-md-9 " >
                                    <label for="archivo_hv">Seleccionar Hoja de Vida</label>
                                    <input type="file" class="form-control" id="archivo_hv" name="archivo_hv" accept=".pdf" />                                
                                    <div id="link_mod_hv" style="display:none">
                                    <a href="javaScript:cambiar_visible_hv(2)" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true" style="padding: 4px 16px;">Volver</a>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="fecha_hv">Fecha</label>
                                    <input type="text" class="form-control" name="fecha_hv" id="fecha_hv" placeholder="dd/mm/aaaa" value="<?php echo($fecha_hv);?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                                    
                                </div>
                                
                            </div>    
                            <br />
                            <div id="link_ver_hv" class="col-md-12 " style="display:<?php echo($estado_ver_file);?>">
                                <label for="txt_email">Descargar Hoja de Vida <br /> Fecha: <?php echo($fecha_hv);?></label>
                                <div>
                                <a href="<?php echo($ruta_archivo_hv);?>" target="blank" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" style="padding: 4px 16px;">Dercargar HV</a>
                                <a href="javaScript:cambiar_visible_hv(1)" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true" style="padding: 4px 16px;">Modificar</a>
                                </div>
                            </div>                          

                            <div class="col-md-12 ">
                                <label for="txt_email">Concepto del Profesor</label>
                                <textarea rows=5 class="form-control" name="observaciones_profesor" id="observaciones_profesor" placeholder="Observaciones" value="" onblur="trim_cadena(this); convertirAMayusculas(this);" ><?php echo($observacion_profesor);?></textarea>
                            </div>
                       </div>   
                    </div>  
                   </div>
                </div>                        
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="cargar_archivo_hv(<?php echo($tipo_accion);?>);" >Enviar</button>
                    <div id="d_guardar_arch_adjunto"></div>
                    <?php
                    $barra_progreso->get("d_barra_progreso_adj", "50%", false, 0);
                    ?>
                </div>
                

            </div>
        </div>
    </div>
    <?php     
        
    break;


    case "6": 
        
        $id_usuario = $_SESSION["idUsuario"];
        $id_academica = $_POST["id_academica"];
        $observaciones_profesor = $_POST["observaciones_profesor"];
        $fecha_hv = $_POST["fecha_hv"];
        
        $ind_resultado = $id_academica;
        //Se actualiza las observaciones del Profesor
        $dbCertificacion->Agregar_Observacion_Hv($id_academica, $observaciones_profesor);
        
        if ($id_academica > 0) {
            
            @$nombre_tmp = $_FILES["archivo_hv"]["tmp_name"];
            @$nombre_ori = $_FILES["archivo_hv"]["name"];

            //Se verifica que la extensión del archivo sea .csv o .txt
            $pos_aux = strrpos($nombre_ori, ".");

            //$ind_resultado = 0;
            if ($pos_aux !== false) {
                    $extension_arch = strtolower(substr($nombre_ori, $pos_aux + 1));

                    if ($extension_arch == "pdf") {
                        //Se asigna nombre al archivo
                        $nombre_arch = "archivos_hv/hoja_vida_".$id_academica.".pdf";

                        //Se copia el archivo
                        copy($nombre_tmp, $nombre_arch);
                        $dbCertificacion->Adjuntar_Hv($id_academica, $nombre_arch, $fecha_hv);
                    }else{
                        //La extensión del archivo no es pdf
                        $ind_resultado = -6;
                    }
            } else {
                //El archivo cargado no tiene extensión
                $ind_resultado = -7;
            }
            

        }
        ?>
        <!--<input type="hidden" id="hdd_id_hc_adjunto" value="<?php echo($id_academica); ?>" />-->
        <input type="hidden" id="hdd_resul_cargar_archivo" name="hdd_resul_cargar_archivo" value="<?php echo($ind_resultado); ?>" />
        <?php
    break;
    
    
    case "7": 
        
        $id_usuario = $_SESSION["idUsuario"];
        $id_academica = $_POST["id_academica"];
        $observaciones_profesor =  $utilidades->str_decode($_POST["observaciones_profesor"]);
        $ind_resultado = $id_academica;
        //Se actualiza las observaciones del Profesor
        $dbCertificacion->Agregar_Observacion_Hv($id_academica, $observaciones_profesor);        
        
        ?>
        <!--<input type="hidden" id="hdd_id_hc_adjunto" value="<?php echo($id_academica); ?>" />-->
        <input type="hidden" id="hdd_resul_cargar_archivo" name="hdd_resul_cargar_archivo" value="<?php echo($ind_resultado); ?>" />
        <?php
    break;


    case "8":
    ?>
    <!-- Modal -->
    <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <?php
        
        $tb_estados_validacion[0][0] = 2;
        $tb_estados_validacion[0][1] = "Validado";
        $tb_estados_validacion[1][0] = 3;
        $tb_estados_validacion[1][1] = "No validado";
        
        
        $tabla_perfiles = $dbPefiles->getNombrePerfil($_SESSION["idUsuario"]);
        $es_academica=0;
        $es_cartera=0;
        
        foreach($tabla_perfiles as $fila_perfil){
            if($fila_perfil['id_perfil']==3){
                $es_academica=1;
            }
            if($fila_perfil['id_perfil']==4){
                $es_cartera=1;
            }
            if($fila_perfil['id_perfil']==5 || $fila_perfil['id_perfil']==1){
                $es_cartera=2;
                $es_academica=2;
            }
        }
        
        
        @$titulo = $_POST["titulo"];
        @$id_academica = $_POST["id_academica"];
        @$nombre_completo = $_POST["nombre_completo"];
        @$id_persona = $_POST["id_persona"];
        
        $tabla_academica=$dbRegistroPersonas->getPersonaAcademica($id_persona, $id_academica);
        
        if(count($tabla_academica)>0){
            @$estado_coor_acade = $tabla_academica["estado_coor_acade"];
            @$observacion_coor_acade = $tabla_academica["observacion_coor_acade"];
            @$estado_cartera = $tabla_academica["estado_cartera"];
            @$observacion_cartera = $tabla_academica["observacion_cartera"];            
            @$tipo_accion = 1;
        }
        else{
            @$estado_coor_acade = "0";
            @$observacion_coor_acade = "";
            @$estado_cartera = "0";
            @$observacion_cartera = "";
            @$tipo_accion = 0;
        }
        
        ?>
        <input type="hidden" id="hdd_id_academica" name="hdd_id_academica" value="<?php echo($id_academica); ?>"></input>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo $titulo.": <b>".$nombre_completo; ?> </b></h4>
                </div>
                <div class="modal-body centrar">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger contenedor_error" role="alert" id='contenedor_error_validar'></div>
                            <div class="alert alert-success contenedor_exito" role="alert" id='contenedor_exito_validar'></div>
                        </div>
                    </div>                    
                    
                <div class="modal-body centrar">
                    <div class="panel-body">
                    <div class="row"> 
                      <div class="form-group">  
                            
                            
                        <div class="col-md-12 form-group " id="div_estado_coor_acade">
                            <div class="panel panel-info">
                            <div class="panel-body">    
                            <?php
                            if($es_academica==0){
                                switch ($estado_coor_acade) {
                                    case "0":
                                    ?>
                                    <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>
                                    <h3><span class="label label-default">No se ha Enviado a Coordicaci&oacute;n Acad&eacute;mica</span></h3>
                                    <?php
                                    break;
                                    case "1":     
                                    ?>
                                    <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>
                                    <h3><span class="label label-default">Esperando Validaci&oacute;n de Coordicaci&oacute;n Acad&eacute;mica</span></h3>
                                    <?php
                                    break;
                                    case "2":
                                    case "3":    
                                    ?>
                                    <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>                                    
                                    <textarea rows=5 class="form-control" disabled name="observacion_coor_acade" id="observacion_coor_acade" placeholder="Observaciones" value="" onblur="trim_cadena(this);" ><?php echo($observacion_coor_acade);?></textarea>
                                    <?php
                                    $combo->get('val_estado_academica', $estado_coor_acade, $tb_estados_validacion, '--Seleccione--', "", "disabled", "", "", 'form-control');
                                    break;
                                }
                            }
                            else if($es_academica==1){
                                switch ($estado_coor_acade) {
                                    case "0":
                                    ?>
                                    <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>
                                    <h3><span class="label label-default">No disponible para validar</span></h3>
                                    <?php
                                    break;
                                    case "1":
                                    case "2":
                                    case "3":
                                    ?>
        
                                    <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>
                                    <div class="form-group">  
                                        <div class="col-md-12 form-group">
                                            <textarea rows=5 class="form-control" name="observacion_coor_acade" id="observacion_coor_acade" placeholder="Observaciones" value="" onblur="trim_cadena(this);" ><?php echo($observacion_coor_acade);?></textarea>
                                        </div>
                                        <div class="col-md-12 form-group">
                                        <?php
                                        $combo->get('val_estado_academica', $estado_coor_acade, $tb_estados_validacion, '--Seleccione--', "", "", "", "", 'form-control');
                                        ?>
                                        </div>
                                        <div class="col-md-12 form-group">
                                        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="validar_academica(<?php echo($id_academica);?>);" >Enviar Validaci&oacute;n - Coo. Acad&eacute;mica</button>
                                        </div>                                        
                                        <div id="validar_coor_acade"></div>                                        
                                        
                                    </div>
                                    <br />
                                    <?php
                                    break;
                                }
                            } else if($es_academica==2){
                                switch ($estado_coor_acade) {
                                    case "0":
                                    ?>
                                    <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>
                                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="estado_validacion(<?php echo($id_academica);?>, 1, 'estado_coor_acade', 1);" >Enviar Acad&eacute;mica</button>
                                    <?php
                                    break;
                                    case "1":     
                                    ?>
                                    <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>
                                    <h3><span class="label label-default">Esperando Validaci&oacute;n de Coordicaci&oacute;n Acad&eacute;mica</span></h3>
                                    <?php
                                    break;
                                    case "2":
                                    case "3":
                                    ?>
                                    <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>                                    
                                    <textarea rows=5 class="form-control" disabled name="observacion_coor_acade" id="observacion_coor_acade" placeholder="Observaciones" value="" onblur="trim_cadena(this);" ><?php echo($observacion_coor_acade);?></textarea>
                                    <?php
                                    $combo->get('val_estado_academica', $estado_coor_acade, $tb_estados_validacion, '--Seleccione--', "", "disabled", "", "", 'form-control');
                                    break;
                                
                                }
                            }
                            ?>
                           </div>         
                           </div>         
                        </div>

                        <div class="col-md-12 form-group" id="div_estado_cartera">
                            <div class="panel panel-info">
                            <div class="panel-body">   
                            <?php
                            if($es_cartera==0){
                                
                                switch ($estado_cartera) {
                                    case "0":
                                    ?>
                                    <label>Validaci&oacute;n por parte de Cartera</label>
                                    <h3><span class="label label-default">No se ha Enviado a Cartera</span></h3>
                                    <?php
                                    break;
                                    case "1":     
                                    ?>
                                    <label>Validaci&oacute;n por parte de Cartera</label>
                                    <h3><span class="label label-default">Esperando Validaci&oacute;n de Cartera</span></h3>
                                    <?php
                                    break;
                                    case "2":
                                    case "3":
                                    ?>
                                    <label>Validaci&oacute;n por parte de Cartera</label>                                    
                                    <textarea rows=5 class="form-control" disabled name="observacion_cartera" id="observacion_cartera" placeholder="Observaciones" value="" onblur="trim_cadena(this);" ><?php echo($observacion_cartera);?></textarea>
                                    <?php
                                    $combo->get('val_estado_cartera', $estado_cartera, $tb_estados_validacion, '--Seleccione--', "", "disabled", "", "", 'form-control');                                    
                                    break;
                                }
                            
                                
                            } else if($es_cartera==1){
                            
                                
                                switch ($estado_cartera) {
                                    case "0":
                                    ?>
                                    <label>Validaci&oacute;n por parte de Cartera</label>
                                    <h3><span class="label label-default">No disponible para validar</span></h3>
                                    <?php
                                    break;
                                    case "1":
                                    case "2":
                                    case "3":    
                                    ?>
                                    <label>Validaci&oacute;n por parte de Cartera</label>
                                    <div class="form-group">  
                                        <div class="col-md-12 form-group">
                                            <textarea rows=5 class="form-control" name="observacion_cartera" id="observacion_cartera" placeholder="Observaciones" onblur="trim_cadena(this);" ><?php echo($observacion_cartera);?></textarea>
                                        </div>
                                        <div class="col-md-12 form-group">
                                        <?php
                                        $combo->get('val_estado_cartera', $estado_cartera, $tb_estados_validacion, '--Seleccione--', "", "", "", "", 'form-control');
                                        ?>
                                        </div>
                                        <div class="col-md-12 form-group">
                                        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="validar_cartera(<?php echo($id_academica);?>);" >Enviar Validaci&oacute;n - Cartera</button>                                        
                                        </div>                                        
                                        <div id="validar_cartera"></div>
                                        
                                        
                                        
                                    </div>
                                    <?php
                                    break;
                                }
                            } else if($es_cartera==2){
                                
                                switch ($estado_cartera) {
                                    case "0":
                                    ?>
                                    <label>Validaci&oacute;n por parte de Cartera</label>
                                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="estado_validacion(<?php echo($id_academica);?>, 1, 'estado_cartera', 2);" >Enviar Cartera</button>
                                    <?php
                                    break;
                                    case "1":     
                                    ?>
                                    <label>Validaci&oacute;n por parte de Cartera</label>
                                    <h3><span class="label label-default">Esperando Validaci&oacute;n de Cartera</span></h3>
                                    <?php
                                    break;
                                    case "2":
                                    case "3":    
                                    ?>
                                    <label>Validaci&oacute;n por parte de Cartera</label>                                    
                                    <textarea rows=5 class="form-control" disabled name="observacion_cartera" id="observacion_cartera" placeholder="Observaciones" value="" onblur="trim_cadena(this);" ><?php echo($observacion_cartera);?></textarea>
                                    <?php
                                    $combo->get('val_estado_cartera', $estado_cartera, $tb_estados_validacion, '--Seleccione--', "", "disabled", "", "", 'form-control');                                    
                                    break;
                                }
                                
                            }
                            
                            ?>
                            
                           </div>
                           </div>
                        </div>
                        
                       </div>   
                    </div>  
                   </div>
                </div>                        
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Volver</button>
                </div>

            </div>
        </div>
    </div>
    <?php     
        
    break;
    
    
    case "9": 
        
        $id_usuario = $_SESSION["idUsuario"];
        $id_academica = $_POST["id_academica"];
        $estado = $_POST["estado"];
        $campo = $_POST["campo"];
        $tipo_validacion = $_POST["tipo_validacion"];        
        //Se actualiza el estado de academica o cartera
        $ind_resultado = $dbCertificacion->Cambiar_Estados_Validacion($id_academica, $estado, $campo);                
        ?>
        <div class="panel panel-info">
        <div class="panel-body">      
    
    
        <input type="hidden" id="hdd_resul_validacion" name="hdd_resul_validacion" value="<?php echo($ind_resultado); ?>" />
        <?php        
        if($tipo_validacion==1){//Tipo validacion academica
            ?>
            <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>
            <h3><span class="label label-default">Esperando Validaci&oacute;n de Coordicaci&oacute;n Acad&eacute;mica</span></h3>
            <?php                
        }else if($tipo_validacion==2){//Tipo validacion cartera
            ?>
            <label>Validaci&oacute;n por parte de Cartera</label>
            <h3><span class="label label-default">Esperando Validaci&oacute;n de Cartera</span></h3>
            <?php
        }
        ?>
        </div>
        </div>    
        <?php
        
    break;
    
    
    case "10":         
        $id_usuario = $_SESSION["idUsuario"];
        $id_academica = $_POST["id_academica"];
        //$observacion_coor_acade = $_POST["observacion_coor_acade"];
        $observacion_coor_acade = $utilidades->str_decode($_POST["observacion_coor_acade"]);
        $estado_academica = $_POST["estado_academica"];
        
        $ind_resultado=0;
        //Se actualiza el estado de academica o cartera
        $ind_resultado = $dbCertificacion->Validar_Coo_Academica($id_academica, $observacion_coor_acade, $estado_academica);                
        ?>
        <input type="hidden" id="hdd_validacion_resultado" name="hdd_validacion_resultado" value="<?php echo($ind_resultado); ?>" />        
        <?php
    break;

    case "11":         
        $id_usuario = $_SESSION["idUsuario"];
        $id_academica = $_POST["id_academica"];
        //$observacion_coor_acade = $_POST["observacion_coor_acade"];
        $observacion_cartera = $utilidades->str_decode($_POST["observacion_cartera"]);
        $estado_cartera = $_POST["estado_cartera"];        
        
        $ind_resultado=0;
        //Se actualiza el estado de academica o cartera
        $ind_resultado = $dbCertificacion->Validar_Cartera($id_academica, $observacion_cartera, $estado_cartera);                
        ?>
        <input type="hidden" id="hdd_validacion_resultado" name="hdd_validacion_resultado" value="<?php echo($ind_resultado); ?>" />        
        <?php
    break;


    case "12":
    ?>
    <!-- Modal -->
    <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <?php
        
        $tb_estados_validacion[0][0] = 2;
        $tb_estados_validacion[0][1] = "Validado";
        $tb_estados_validacion[1][0] = 3;
        $tb_estados_validacion[1][1] = "No validado";
        
        
        $tabla_perfiles = $dbPefiles->getNombrePerfil($_SESSION["idUsuario"]);
        $es_academica=0;
        $es_cartera=0;
        
        foreach($tabla_perfiles as $fila_perfil){
            if($fila_perfil['id_perfil']==3){
                $es_academica=1;
            }
            if($fila_perfil['id_perfil']==4){
                $es_cartera=1;
            }
            if($fila_perfil['id_perfil']==5 || $fila_perfil['id_perfil']==1){
                $es_cartera=2;
                $es_academica=2;
            }
        }
        
        
        @$titulo = $_POST["titulo"];
        @$id_academica = $_POST["id_academica"];
        @$nombre_completo = $_POST["nombre_completo"];
        @$id_persona = $_POST["id_persona"];
        
        $tabla_academica=$dbRegistroPersonas->getPersonaAcademica($id_persona, $id_academica);
        
        if(count($tabla_academica)>0){
            @$estado_coor_acade = $tabla_academica["estado_coor_acade"];
            @$observacion_coor_acade = $tabla_academica["observacion_coor_acade"];
            @$estado_cartera = $tabla_academica["estado_cartera"];
            @$observacion_cartera = $tabla_academica["observacion_cartera"];            
            @$tipo_accion = 1;
        }
        else{
            @$estado_coor_acade = "0";
            @$observacion_coor_acade = "";
            @$estado_cartera = "0";
            @$observacion_cartera = "";
            @$tipo_accion = 0;
        }
        
        ?>
        <input type="hidden" id="hdd_id_academica" name="hdd_id_academica" value="<?php echo($id_academica); ?>"></input>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo $titulo.": <b>".$nombre_completo; ?> </b></h4>
                </div>
                <div class="modal-body centrar">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger contenedor_error" role="alert" id='contenedor_error_validar'></div>
                            <div class="alert alert-success contenedor_exito" role="alert" id='contenedor_exito_validar'></div>
                        </div>
                    </div>                    
                    
                <div class="modal-body centrar">
                    <div class="panel-body">
                    <div class="row"> 
                      <div class="form-group">  
                            
                            
                        <div class="col-md-12 form-group " id="div_estado_coor_acade">
                            <div class="panel panel-info">
                            <div class="panel-body">    
                            <?php
                            if($es_academica==0){
                                switch ($estado_coor_acade) {
                                    case "0":
                                    ?>
                                    <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>
                                    <h3><span class="label label-default">No se ha Enviado a Coordicaci&oacute;n Acad&eacute;mica</span></h3>
                                    <?php
                                    break;
                                    case "1":     
                                    ?>
                                    <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>
                                    <h3><span class="label label-default">Esperando Validaci&oacute;n de Coordicaci&oacute;n Acad&eacute;mica</span></h3>
                                    <?php
                                    break;
                                    case "2":
                                    case "3":    
                                    ?>
                                    <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>                                    
                                    <textarea rows=5 class="form-control" disabled name="observacion_coor_acade" id="observacion_coor_acade" placeholder="Observaciones" value="" onblur="trim_cadena(this);" ><?php echo($observacion_coor_acade);?></textarea>
                                    <?php
                                    $combo->get('val_estado_academica', $estado_coor_acade, $tb_estados_validacion, '--Seleccione--', "", "disabled", "", "", 'form-control');
                                    break;
                                }
                            }
                            else if($es_academica==1){
                                switch ($estado_coor_acade) {
                                    case "0":
                                    ?>
                                    <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>
                                    <h3><span class="label label-default">No disponible para validar</span></h3>
                                    <?php
                                    break;
                                    case "1":
                                    case "2":
                                    case "3":
                                    ?>
        
                                    <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>
                                    <div class="form-group">  
                                        <div class="col-md-12 form-group">
                                            <textarea rows=5 class="form-control" name="observacion_coor_acade" id="observacion_coor_acade" placeholder="Observaciones" value="" onblur="trim_cadena(this);" ><?php echo($observacion_coor_acade);?></textarea>
                                        </div>
                                        <div class="col-md-12 form-group">
                                        <?php
                                        $combo->get('val_estado_academica', $estado_coor_acade, $tb_estados_validacion, '--Seleccione--', "", "", "", "", 'form-control');
                                        ?>
                                        </div>
                                        <div class="col-md-12 form-group">
                                        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="validar_academica(<?php echo($id_academica);?>);" >Enviar Validaci&oacute;n - Coo. Acad&eacute;mica</button>
                                        </div>                                        
                                        <div id="validar_coor_acade"></div>                                        
                                        
                                    </div>
                                    <br />
                                    <?php
                                    break;
                                }
                            } else if($es_academica==2){
                                switch ($estado_coor_acade) {
                                    case "0":
                                    ?>
                                    <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>
                                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="estado_validacion(<?php echo($id_academica);?>, 1, 'estado_coor_acade', 1);" >Enviar Acad&eacute;mica</button>
                                    <?php
                                    break;
                                    case "1":     
                                    ?>
                                    <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>
                                    <h3><span class="label label-default">Esperando Validaci&oacute;n de Coordicaci&oacute;n Acad&eacute;mica</span></h3>
                                    <?php
                                    break;
                                    case "2":
                                    case "3":
                                    ?>
                                    <label>Validaci&oacute;n por parte de Coordicaci&oacute;n Acad&eacute;mica</label>                                    
                                    <textarea rows=5 class="form-control" disabled name="observacion_coor_acade" id="observacion_coor_acade" placeholder="Observaciones" value="" onblur="trim_cadena(this);" ><?php echo($observacion_coor_acade);?></textarea>
                                    <?php
                                    $combo->get('val_estado_academica', $estado_coor_acade, $tb_estados_validacion, '--Seleccione--', "", "disabled", "", "", 'form-control');
                                    break;
                                
                                }
                            }
                            ?>
                           </div>         
                           </div>         
                        </div>
                        
                       </div>   
                    </div>  
                   </div>
                </div>                        
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Volver</button>
                </div>

            </div>
        </div>
    </div>
    <?php     
        
    break;



    case "13":
    ?>
    <!-- Modal -->
    <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <?php
        
        $tb_estados_validacion[0][0] = 2;
        $tb_estados_validacion[0][1] = "Validado";
        $tb_estados_validacion[1][0] = 3;
        $tb_estados_validacion[1][1] = "No validado";
        
        
        $tabla_perfiles = $dbPefiles->getNombrePerfil($_SESSION["idUsuario"]);
        $es_academica=0;
        $es_cartera=0;
        
        foreach($tabla_perfiles as $fila_perfil){
            if($fila_perfil['id_perfil']==3){
                $es_academica=1;
            }
            if($fila_perfil['id_perfil']==4){
                $es_cartera=1;
            }
            if($fila_perfil['id_perfil']==5 || $fila_perfil['id_perfil']==1){
                $es_cartera=2;
                $es_academica=2;
            }
        }
        
        
        @$titulo = $_POST["titulo"];
        @$id_academica = $_POST["id_academica"];
        @$nombre_completo = $_POST["nombre_completo"];
        @$id_persona = $_POST["id_persona"];
        
        $tabla_academica=$dbRegistroPersonas->getPersonaAcademica($id_persona, $id_academica);
        
        if(count($tabla_academica)>0){
            @$estado_coor_acade = $tabla_academica["estado_coor_acade"];
            @$observacion_coor_acade = $tabla_academica["observacion_coor_acade"];
            @$estado_cartera = $tabla_academica["estado_cartera"];
            @$observacion_cartera = $tabla_academica["observacion_cartera"];            
            @$tipo_accion = 1;
        }
        else{
            @$estado_coor_acade = "0";
            @$observacion_coor_acade = "";
            @$estado_cartera = "0";
            @$observacion_cartera = "";
            @$tipo_accion = 0;
        }
        
        ?>
        <input type="hidden" id="hdd_id_academica" name="hdd_id_academica" value="<?php echo($id_academica); ?>"></input>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo $titulo.": <b>".$nombre_completo; ?> </b></h4>
                </div>
                <div class="modal-body centrar">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger contenedor_error" role="alert" id='contenedor_error_validar'></div>
                            <div class="alert alert-success contenedor_exito" role="alert" id='contenedor_exito_validar'></div>
                        </div>
                    </div>                    
                    
                <div class="modal-body centrar">
                    <div class="panel-body">
                    <div class="row"> 
                      <div class="form-group">  

                        <div class="col-md-12 form-group" id="div_estado_cartera">
                            <div class="panel panel-info">
                            <div class="panel-body">   
                            <?php
                            if($es_cartera==0){
                                
                                switch ($estado_cartera) {
                                    case "0":
                                    ?>
                                    <label>Validaci&oacute;n por parte de Cartera</label>
                                    <h3><span class="label label-default">No se ha Enviado a Cartera</span></h3>
                                    <?php
                                    break;
                                    case "1":     
                                    ?>
                                    <label>Validaci&oacute;n por parte de Cartera</label>
                                    <h3><span class="label label-default">Esperando Validaci&oacute;n de Cartera</span></h3>
                                    <?php
                                    break;
                                    case "2":
                                    case "3":
                                    ?>
                                    <label>Validaci&oacute;n por parte de Cartera</label>                                    
                                    <textarea rows=5 class="form-control" disabled name="observacion_cartera" id="observacion_cartera" placeholder="Observaciones" value="" onblur="trim_cadena(this);" ><?php echo($observacion_cartera);?></textarea>
                                    <?php
                                    $combo->get('val_estado_cartera', $estado_cartera, $tb_estados_validacion, '--Seleccione--', "", "disabled", "", "", 'form-control');                                    
                                    break;
                                }
                            
                                
                            } else if($es_cartera==1){
                            
                                
                                switch ($estado_cartera) {
                                    case "0":
                                    ?>
                                    <label>Validaci&oacute;n por parte de Cartera</label>
                                    <h3><span class="label label-default">No disponible para validar</span></h3>
                                    <?php
                                    break;
                                    case "1":
                                    case "2":
                                    case "3":    
                                    ?>
                                    <label>Validaci&oacute;n por parte de Cartera</label>
                                    <div class="form-group">  
                                        <div class="col-md-12 form-group">
                                            <textarea rows=5 class="form-control" name="observacion_cartera" id="observacion_cartera" placeholder="Observaciones" onblur="trim_cadena(this);" ><?php echo($observacion_cartera);?></textarea>
                                        </div>
                                        <div class="col-md-12 form-group">
                                        <?php
                                        $combo->get('val_estado_cartera', $estado_cartera, $tb_estados_validacion, '--Seleccione--', "", "", "", "", 'form-control');
                                        ?>
                                        </div>
                                        <div class="col-md-12 form-group">
                                        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="validar_cartera(<?php echo($id_academica);?>);" >Enviar Validaci&oacute;n - Cartera</button>                                        
                                        </div>                                        
                                        <div id="validar_cartera"></div>
                                    </div>
                                    <?php
                                    break;
                                }
                            } else if($es_cartera==2){
                                
                                switch ($estado_cartera) {
                                    case "0":
                                    ?>
                                    <label>Validaci&oacute;n por parte de Cartera</label>
                                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="estado_validacion(<?php echo($id_academica);?>, 1, 'estado_cartera', 2);" >Enviar Cartera</button>
                                    <?php
                                    break;
                                    case "1":     
                                    ?>
                                    <label>Validaci&oacute;n por parte de Cartera</label>
                                    <h3><span class="label label-default">Esperando Validaci&oacute;n de Cartera</span></h3>
                                    <?php
                                    break;
                                    case "2":
                                    case "3":    
                                    ?>
                                    <label>Validaci&oacute;n por parte de Cartera</label>                                    
                                    <textarea rows=5 class="form-control" disabled name="observacion_cartera" id="observacion_cartera" placeholder="Observaciones" value="" onblur="trim_cadena(this);" ><?php echo($observacion_cartera);?></textarea>
                                    <?php
                                    $combo->get('val_estado_cartera', $estado_cartera, $tb_estados_validacion, '--Seleccione--', "", "disabled", "", "", 'form-control');                                    
                                    break;
                                }
                                
                            }
                            
                            ?>
                            
                           </div>
                           </div>
                        </div>
                        
                       </div>   
                    </div>  
                   </div>
                </div>                        
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Volver</button>
                </div>

            </div>
        </div>
    </div>
    <?php     
        
    break;


    case "14": 
        ?>
        <!-- Modal -->
        <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            
            <?php
            @$titulo = $_POST["titulo"];
            @$id_academica = $_POST["id_academica"];
            @$nombre_completo = $_POST["nombre_completo"];
            @$id_persona = $_POST["id_persona"];
            
            $tabla_academica=$dbRegistroPersonas->getPersonaAcademica($id_persona, $id_academica);
        

            @$estado_certificacion = $tabla_academica["estado_certificacion"];
            @$observacion_estado_certificacion = $tabla_academica["observacion_estado_certificacion"];
            
            
            ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo $titulo.": <b>".$nombre_completo; ?> </b></h4>
                    </div>
                    <div class="modal-body centrar">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger contenedor_error" role="alert" id='contenedor_error_validar'></div>
                                <div class="alert alert-success contenedor_exito" role="alert" id='contenedor_exito_validar'></div>
                            </div>
                        </div>  
                        
                        <label>Observaci&oacute; Cambio de Estado</label>
                        <div class="form-group">  
                            <div class="col-md-12 form-group">
                                <textarea rows=5 class="form-control" name="observacion_estado_certificacion" id="observacion_estado_certificacion" placeholder="Observaciones" onblur="trim_cadena(this);" ><?php echo($observacion_estado_certificacion);?></textarea>
                            </div>
                            <div class="col-md-12 form-group">
                            <?php
                            $combo->getComboDb('val_estado_certificacion', $estado_certificacion, $dbListas->getListaEstadoCertificacion(), 'codigo_lista_editable_detalle, nombre_lista_editable_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>
                            </div>                            
                        </div>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="estado_certificacion(<?php echo($id_academica);?>);">Cambiar Estado</button>
                        
                        <div id="div_estado_certificacion"></div>
                        
                    </div>

                </div>
            </div>
        </div>
        <?php
    break;


    case "15":         
        $id_usuario = $_SESSION["idUsuario"];
        $id_academica = $_POST["id_academica"];
        $observacion_estado_certificacion = $utilidades->str_decode($_POST["observacion_estado_certificacion"]);
        $estado_certificacion = $_POST["estado_certificacion"];       
        
        $ind_resultado=0;
        $ind_resultado = $dbCertificacion->UpdateEstadoCertificacion($id_academica, $observacion_estado_certificacion, $estado_certificacion);                
        ?>
        <input type="hidden" id="hdd_estado_certificacon" name="hdd_estado_certificacon" value="<?php echo($ind_resultado); ?>" />        
        <?php
    break;









	
	
		
		
	
	
	
	
	
}

?>
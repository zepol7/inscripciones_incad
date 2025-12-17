<?php
session_start();

require_once("../funciones/get_idioma.php");
require_once("../funciones/Class_Barra_Progreso.php");
require_once("../db/DbRegistroPersonas.php");
require_once("../db/DbCertificacion.php");
require_once("../db/DbListas.php");
require_once("../db/DbPerfiles.php");
require_once("../db/DbEmpresas.php");

require_once("../funciones/Utilidades.php");
require_once("../funciones/Class_Combo_Box.php");
require_once("../principal/ContenidoHtml.php");
require_once("../funciones/Class_Generar_Clave.php");
require_once '../funciones/PHPExcel/Classes/PHPExcel.php';

$dbRegistroPersonas = new DbRegistroPersonas();
$dbListas = new DbListas();
$dbPefiles = new DbPerfiles();
$dbEmpresas = new DbEmpresas();
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

function exportar_hoja_calcula_seguimiento_estudiantes($tabla_base){

    
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
                     ->setCellValue('A1', 'Documento')
                     ->setCellValue('B1', 'Nombre Estudiante')         
                     ->setCellValue('C1', 'Fecha de Postulación')
                     ->setCellValue('D1', 'Teléfonos de contacto')
                     ->setCellValue('E1', 'Programa')
                     ->setCellValue('F1', 'Empresa')
                     ->setCellValue('G1', 'Estado Vinculación')
                     ->setCellValue('H1', 'Fecha Inicio')
                     ->setCellValue('I1', 'Fecha Fin');
                     /*->setCellValue('I1', 'Jornada')
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
                     ->setCellValue('V1', 'Fecha Finalización');*/
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
        /*cellColor($objPHPExcel, 'J1', 'CEF6F5');
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
        cellColor($objPHPExcel, 'V1', '01A9DB');*/
        
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
            
             //Datos de la inscripcion
            @$id_academica = $value['id_academica'];
            @$fecha_inscripcion = $value['fecha_inscripcion'];
            @$estado_capacita = $value['estado_capacita'];

            @$estado_productividad = $value['estado_productividad'];
            @$observacion_profesor = $value['observacion_profesor'];
            @$fecha_hv = $value['fecha_hv'];
            @$ruta_archivo_hv = $value['ruta_archivo_hv'];

            @$estado_coor_acade = $value['estado_coor_acade'];
            @$estado_cartera = $value['estado_cartera'];

            @$nom_id_programa = $value['nom_id_programa'];

            //Datos personales
            @$id_persona = $value['id_persona'];
            @$nombre_persona = $value['nombre_persona'];
            @$documento_persona = $value['documento_persona'];
            @$apellido_persona = $value['apellido_persona'];
            @$tel_casa_persona = $value['tel_casa_persona'];
            @$tel_movil_persona = $value['tel_movil_persona'];
            @$email_persona = $value['email_persona'];

            $nombre_completo = $apellido_persona." ".$nombre_persona;
            $telefonos = $tel_casa_persona." - ".$tel_movil_persona;

            //Datos empresas                               
            @$id_estudiante_empresa = $value['id_estudiante_empresa'];
            @$id_empresa = $value['id_empresa'];
            @$nombre_empresa = $value['nombre_empresa'];
            @$telefono1_contacto = $value['telefono1_contacto'];
            @$nombre_contacto = $value['nombre_contacto'];
            @$fecha_envio = $value['fecha_envio'];

            //Datos relacion empresa estudiante
            @$id_estado_vinculacion = $value['id_estado'];                            

            if($id_estado_vinculacion>0){
                $estado_vincular_hv = 1;
            }        
            
            $fecha_ini = $value['fecha_ini'];
            $fecha_fin = $value['fecha_fin'];
            
            $estado_vinculacion_persona = "";
            switch ($id_estado_vinculacion) {
                case "0":
                $estado_vinculacion_persona = "En proceso";
                break;
                case "1":     
                $estado_vinculacion_persona = "No vinculado";
                break;
                case "2":
                $estado_vinculacion_persona = "Vinculado";
                break;
            }
                                
            
            
            
            $objPHPExcel->getActiveSheet()
            ->setCellValue('A' . $contador, $documento_persona)
            ->setCellValue('B' . $contador, $nombre_completo)            
            ->setCellValue('C' . $contador, $fecha_envio)
            ->setCellValue('D' . $contador, $telefonos)            
            ->setCellValue('E' . $contador, $nom_id_programa)
            ->setCellValue('F' . $contador, $nombre_empresa)            
            ->setCellValue('G' . $contador, $estado_vinculacion_persona)
            ->setCellValue('H' . $contador, $fecha_ini)
            ->setCellValue('I' . $contador, $fecha_fin);
            
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
        @unlink("../tmp/reporte_seguimiento_estudiantes.xlsx");			
        // Save Excel 2007 file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save("../tmp/reporte_seguimiento_estudiantes.xlsx");
		
	?>
		
            <br />
            <table class="modal_table" style="width:10px; margin: auto;" border="1">
            <thead>
                <tr>
                <td style="text-align: center;">            	
                <div style="width: 140px;" onclick="window.open('../tmp/reporte_seguimiento_estudiantes.xlsx','_blank');">
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
        
        @$nombre_documento = $_POST["nombre_documento"];
    	$combo = new Combo_Box();		
	
        $tabla_estudiantes = $dbCertificacion->getListaEstudiantesActivos($nombre_documento);
        
        
        ?>
        <br />

        <div class="row">
            <div class="col-md-12">
                
                <div class="table-responsive">

                    <div id="paginador" class="centrar">
                        <nav>
                            <ul class="pagination"></ul>
                        </nav>
                    </div>

                    <table class="table table-bordered paginated">
                        <thead>
                            <tr><th colspan='5' style="text-align: center;">Listado de Estudiantes habilitados para enviar HV</th></tr>
                            <tr>
                                <th style="width:10%; text-align: center;">Documento</th>
                                <th style="width:15%; text-align: center;">Nombre Estudiante</th>
                                <th style="width:5%; text-align: center;">Fecha de Inscripci&oacute;n</th>
                                <th style="width:10%; text-align: center;">Tel&eacute;fonos de Contacto</th>
                                <th style="width:10%; text-align: center;">Programa</th>
                                
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
                                
                                @$estado_productividad = $fila_estudiantes['estado_productividad'];
                                @$observacion_profesor = $fila_estudiantes['observacion_profesor'];
                                @$fecha_hv = $fila_estudiantes['fecha_hv'];
                                @$ruta_archivo_hv = $fila_estudiantes['ruta_archivo_hv'];
                                
                                @$estado_coor_acade = $fila_estudiantes['estado_coor_acade'];
                                @$estado_cartera = $fila_estudiantes['estado_cartera'];
                                
                                @$nom_id_programa = $fila_estudiantes['nom_id_programa'];
                                
                                
                                
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
                                
                                ?>
                                <tr style="cursor:pointer;" onclick="cargar_estudiante(<?php echo $id_academica; ?>, <?php echo $id_persona; ?>, '<?php echo $nombre_completo; ?>');">
                                    <td align="left"><?php echo $documento_persona; ?></td>
                                    <td align="left"><?php echo $nombre_completo; ?></td>
                                    <td align="left"><?php echo $fecha_inscripcion; ?></td>
                                    <td align="left"><?php echo $telefonos; ?></td>
                                    <td align="left"><?php echo $nom_id_programa; ?></td>
                                </tr>
                                <?php    
                                
                                $i = $i + 1;
                            }
                        } else {
                            ?>
                            <tr>
                                <td align="center" colspan="5">No se encontraron datos</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
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
         @$id_academica = $_POST["id_academica"];
         @$id_persona = $_POST["id_persona"];
         $combo = new Combo_Box();		
	
        $tabla_registro = $dbRegistroPersonas->getRegistroPersona($id_academica, 0, 0);
        
        $documento_persona = $tabla_registro['documento_persona'];
        $lugar_documento = $tabla_registro['lugar_documento'];
        $fecha_documento = $tabla_registro['format_fecha_documento'];
        $nombre_persona = $tabla_registro['nombre_persona'];
        $apellido_persona = $tabla_registro['apellido_persona'];
        $fecha_nacimiento = $tabla_registro['format_fecha_nacimiento'];
        $lugar_nacimiento = $tabla_registro['lugar_nacimiento'];
        $tipo_sangre = $tabla_registro['nom_tipo_sangre'];
        $tel_casa_persona = $tabla_registro['tel_casa_persona'];
        $tel_movil_persona = $tabla_registro['tel_movil_persona'];
        $email_persona = $tabla_registro['email_persona'];
        $estado_civil = $tabla_registro['nom_estado_civil'];
        $direccion_casa = $tabla_registro['direccion_casa'];
        
        $tipo_inscripcion = $tabla_registro['nom_tipo_inscripcion'];
        $fecha_inscripcion = $tabla_registro['format_fecha_inscripcion'];
        $ultimo_estudio = $tabla_registro['ultimo_estudio'];
        $institucion_estudio = $tabla_registro['institucion_estudio'];
        $programa_incad = $tabla_registro['nom_id_programa'];
        $jornada_incad = $tabla_registro['nom_jornada'];

        $programa_tecnico = $tabla_registro['nom_programa_tecnico'];
        $practica_laboral = $tabla_registro['nom_practica_laboral'];

        $unidad_negocio = $tabla_registro['nom_unidad_negocio'];
        $calendario_academico = $tabla_registro['nom_calendario_academico'];
        
        ?>
        <input type="hidden" id="id_persona" id="id_persona" value="<?php echo($id_persona);?>">   
        <input type="hidden" id="id_academica" id="id_academica" value="<?php echo($id_academica);?>">      
        
        <div class="panel panel-default">
            <div class="panel-body">
                <p><b>Documento: </b><?php echo($documento_persona);?></p>
                <p><b>Programa: </b><?php echo($programa_incad);?></p>
                <p><b>Jornada: </b><?php echo($jornada_incad);?></p>
            </div>
        </div>
        <?php
        
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
        @$id_academica = $_POST["id_academica"];
        @$id_empresa = $_POST["id_empresa"];
        
        $tabla_estudiantes_empresas = $dbCertificacion->getListaEstudiantesEmpresas($id_academica, $id_empresa);
        
        ?>
        <div class="panel-body">
        <div class="form-group">
            
            <div class="table-responsive">

                <div id="paginador" class="centrar">
                    <nav>
                        <ul class="pagination">
                        </ul>
                    </nav>
                </div>

                <table class="table table-bordered paginated" style=" border: 1px;">
                    <thead>
                        <tr><th colspan='9' style="text-align: center;">Hojas de vida enviadas a empresas</th></tr>
                        <tr>
                            <th style="width:10%; text-align: center;">Documento</th>
                            <th style="width:15%; text-align: center;">Nombre Estudiante</th>
                            <th style="width:5%; text-align: center;">Fecha de Postulaci&oacute;n</th>
                            <!-- <th style="width:5%; text-align: center;">Fecha de Inscripci&oacute;n</th> -->
                            <th style="width:5%; text-align: center;">Tel&eacute;fonos de Contacto</th>
                            <th style="width:15%; text-align: center;">Programa</th>
                            <th style="width:15%; text-align: center;">Empresa</th>
                            <th colspan="2" style="width:15%; text-align: center;">Seguimiento</th>
                            <th style="width:10%; text-align: center;">Vincular</th>
                        </tr>
                    </thead>
                    <?php
                    $cantidad_registro = count($tabla_estudiantes_empresas);
                    $i = 1;
                    
                    $estado_vincular_hv = 0;
                    if ($cantidad_registro > 0) {
                        foreach ($tabla_estudiantes_empresas as $fila_registro) {

                            //Datos de la inscripcion
                            @$id_academica = $fila_registro['id_academica'];
                            @$fecha_inscripcion = $fila_registro['fecha_inscripcion'];
                            @$estado_capacita = $fila_registro['estado_capacita'];

                            @$estado_productividad = $fila_registro['estado_productividad'];
                            @$observacion_profesor = $fila_registro['observacion_profesor'];
                            @$fecha_hv = $fila_registro['fecha_hv'];
                            @$ruta_archivo_hv = $fila_registro['ruta_archivo_hv'];

                            @$estado_coor_acade = $fila_registro['estado_coor_acade'];
                            @$estado_cartera = $fila_registro['estado_cartera'];

                            @$nom_id_programa = $fila_registro['nom_id_programa'];

                            //Datos personales
                            @$id_persona = $fila_registro['id_persona'];
                            @$nombre_persona = $fila_registro['nombre_persona'];
                            @$documento_persona = $fila_registro['documento_persona'];
                            @$apellido_persona = $fila_registro['apellido_persona'];
                            @$tel_casa_persona = $fila_registro['tel_casa_persona'];
                            @$tel_movil_persona = $fila_registro['tel_movil_persona'];
                            @$email_persona = $fila_registro['email_persona'];

                            $nombre_completo = $apellido_persona." ".$nombre_persona;
                            $telefonos = $tel_casa_persona." ".$tel_movil_persona;
                            
                            //Datos empresas                               
                            @$id_estudiante_empresa = $fila_registro['id_estudiante_empresa'];
                            @$id_empresa = $fila_registro['id_empresa'];
                            @$nombre_empresa = $fila_registro['nombre_empresa'];
                            @$telefono1_contacto = $fila_registro['telefono1_contacto'];
                            @$nombre_contacto = $fila_registro['nombre_contacto'];
                            @$fecha_envio = $fila_registro['fecha_envio'];
                            
                            //Datos relacion empresa estudiante
                            @$id_estado_vinculacion = $fila_registro['id_estado'];                            
                            
                            if($id_estado_vinculacion>0){
                                $estado_vincular_hv = 1;
                            }                            

                            ?>
                            <tr style="cursor:pointer;">
                                <td align="left"><?php echo $documento_persona; ?></td>
                                <td align="left"><?php echo $nombre_completo; ?></td>
                                <td align="left"><?php echo $fecha_envio; ?></td>
                                <td align="left"><?php echo $telefonos; ?></td>
                                <td align="left"><?php echo $nom_id_programa; ?></td>
                                <td align="left"><?php echo $nombre_empresa; ?></td>
                                
                                <?php 
                                    //
                                    switch ($id_estado_vinculacion) {
                                        case "0":
                                        ?>
                                        <td align="center"><button id="btn_agregar_segui_<?php echo($id_estudiante_empresa);?>" type="button" class="btn btn-info" onclick="form_segumiento(<?php echo($id_empresa);?>, <?php echo($id_academica);?>, <?php echo($id_estudiante_empresa);?>, '<?php echo($nombre_empresa);?>', '<?php echo($nombre_completo);?>', 1)">Ver</button> </td>
                                        <td align="center"><button id="btn_agregar_segui_<?php echo($id_estudiante_empresa);?>" type="button" class="btn btn-info" onclick="form_segumiento(<?php echo($id_empresa);?>, <?php echo($id_academica);?>, <?php echo($id_estudiante_empresa);?>, '<?php echo($nombre_empresa);?>', '<?php echo($nombre_completo);?>', 2)">Nuevo</button> </td>
                                        <td align="center"><button id="btn_vincular_<?php echo($id_estudiante_empresa);?>" type="button" class="btn btn-danger" onclick="form_vincular(<?php echo($id_empresa);?>, <?php echo($id_academica);?>, <?php echo($id_estudiante_empresa);?>, '<?php echo($nombre_empresa);?>', '<?php echo($nombre_completo);?>')"  >Vincular</button> </td>
                                        <?php
                                        break;
                                        case "1":     
                                        ?>
                                        <td align="center" style=" width: 5%;" ><button id="btn_agregar_segui_<?php echo($id_estudiante_empresa);?>" type="button" class="btn btn-info" onclick="form_segumiento(<?php echo($id_empresa);?>, <?php echo($id_academica);?>, <?php echo($id_estudiante_empresa);?>, '<?php echo($nombre_empresa);?>', '<?php echo($nombre_completo);?>', 1)">Ver</button> </td>
                                        <td align="center" colspan="2"><div class="alert alert-danger" role="alert">No Vinculado</div> </td>
                                        <?php
                                        break;
                                        case "2":
                                        ?>
                                        <td align="center" style=" width: 5%;" ><button id="btn_agregar_segui_<?php echo($id_estudiante_empresa);?>" type="button" class="btn btn-info" onclick="form_segumiento(<?php echo($id_empresa);?>, <?php echo($id_academica);?>, <?php echo($id_estudiante_empresa);?>, '<?php echo($nombre_empresa);?>', '<?php echo($nombre_completo);?>', 1)">Ver</button> </td>
                                        <td align="center" colspan="2"> <div class="alert alert-success" role="alert"  onclick="form_vincular(<?php echo($id_empresa);?>, <?php echo($id_academica);?>, <?php echo($id_estudiante_empresa);?>, '<?php echo($nombre_empresa);?>', '<?php echo($nombre_completo);?>')" >Vinculado</div> </td>
                                        <?php                                        
                                        break;
                                    }
                                ?>
                            </tr>
                            <?php    

                            $i = $i + 1;
                        }
                    } else {
                        ?>
                        <tr>
                            <td align="center" colspan="9">No se han enviado hojas de vida</td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td colspan='9' style="text-align: center;">  
                            <?php
                            if($estado_vincular_hv==0){
                            ?>
                            <button type="button" id="btn_enviar_hv" class="btn btn-warning btn-lg" onclick="form_enviar_hv();">Vincular</button>
                            <?php
                            }
                            ?>
                                
                        </td>
                    </tr>    
                        
                        
                </table>
                
                <?php
                   exportar_hoja_calcula_seguimiento_estudiantes($tabla_estudiantes_empresas);
                ?>
                
                
            </div>

        </div>
        </div>
        
        <?php
        
        
    break;
    
    
    case "5":
        
    ?>
    <!-- Modal -->
    <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <?php
        
        @$titulo = $_POST["titulo"];
        ?>
        
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo $titulo; ?></h4>
                </div>
                <div class="modal-body centrar">                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger contenedor_error" role="alert" id='contenedor_error_estudiante'></div>
                            <div class="alert alert-success contenedor_exito" role="alert" id='contenedor_exito_estudiante'></div>
                        </div>
                    </div>                    
                    
                    <div class="modal-body centrar">
                        <div class="panel-body">
                        <div class="row"> 
                          <div class="form-group">  
                            <div class="col-md-9 " >
                                <label>Buscar por Nombre o Documento</label>
                                <input type="text" class="form-control" id="nombre_documento" name="nombre_documento" placeholder="Nombre o Documento" onblur="trim_cadena(this);" >  
                            </div>                          
                            <div class="col-md-3">                   
                               <br />   
                              <button type="button" class="btn btn-primary" onclick="validar_buscar_nombre_documento();" >Buscar</button>
                            </div>   
                          </div>   
                          <div id="div_lista_estudiantes"></div>  
                        </div>  
                       </div>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
    <?php     
        
    break;

    case "6": 
        
    ?>
    <!-- Modal -->
    <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <?php
        
        @$titulo = $_POST["titulo"];
        ?>
        
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo $titulo; ?></h4>
                </div>
                <div class="modal-body centrar">                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger contenedor_error" role="alert" id='contenedor_error_estudiante'></div>
                            <div class="alert alert-success contenedor_exito" role="alert" id='contenedor_exito_estudiante'></div>
                        </div>
                    </div>                    
                    
                    <div class="modal-body centrar">
                        <div class="panel-body">
                        <div class="row"> 
                          <div class="form-group">  
                            <div class="col-md-9 " >
                                <label>Buscar por Nombre o NIT de Empresa</label>
                                <input type="text" class="form-control" id="nombre_nit_empresa" name="nombre_nit_empresa" placeholder="Nombre o NIT de Empresa" onblur="trim_cadena(this);" >  
                            </div>                          
                            <div class="col-md-3">                   
                               <br />   
                              <button type="button" class="btn btn-primary" onclick="validar_buscar_nombre_empresa();" >Buscar</button>
                            </div>   
                          </div>   
                          <div id="div_lista_empresas"></div>  
                        </div>  
                       </div>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
    <?php         
        
        
    break;
    
    
    case "7": 
        @$nombre_nit_empresa = $_POST["nombre_nit_empresa"];
    	$combo = new Combo_Box();		
	
        $tabla_empresas = $dbCertificacion->getListaEmpresasActivas($nombre_nit_empresa);
        
        ?>
        <br />

        <div class="row">
            <div class="col-md-12">
                
                <div class="table-responsive">

                    <div id="paginador" class="centrar">
                        <nav>
                            <ul class="pagination"></ul>
                        </nav>
                    </div>

                    <table class="table table-bordered paginated">
                        <thead>
                            <tr><th colspan='4' style="text-align: center;">Listado de Empresas</th></tr>
                            <tr>
                                <th style="width:10%; text-align: center;">NIT</th>
                                <th style="width:15%; text-align: center;">Nombre Empresa</th>
                                <th style="width:10%; text-align: center;">Nombre Contacto</th>
                                <th style="width:10%; text-align: center;">Tel&eacute;fonos de Contacto</th>
                            </tr>
                        </thead>
                        <?php
                        $cantidad_registro = count($tabla_empresas);
                        $i = 1;
                        if ($cantidad_registro > 0) {
                            foreach ($tabla_empresas as $fila_empresa) {
                                
                                //Datos de la inscripcion
                                @$id_empresa = $fila_empresa['id_empresa'];
                                @$nit_empresa = $fila_empresa['nit_empresa'];
                                @$nombre_empresa = $fila_empresa['nombre_empresa'];
                                
                                @$nombre_contacto = $fila_empresa['nombre_contacto'];
                                @$telefono1_contacto = $fila_empresa['telefono1_contacto'];
                                
                                @$nombre_contacto2 = $fila_empresa['nombre_contacto2'];
                                @$telefono2_contacto = $fila_empresa['telefono2_contacto'];
                                
                                
                                ?>
                                <tr style="cursor:pointer;" onclick="cargar_empresa(<?php echo $id_empresa; ?>, '<?php echo $nombre_empresa; ?>');">
                                    <td align="left"><?php echo $nit_empresa; ?></td>
                                    <td align="left"><?php echo $nombre_empresa; ?></td>
                                    <td align="left"><?php echo $nombre_contacto; ?></td>
                                    <td align="left"><?php echo $telefono1_contacto; ?></td>
                                </tr>
                                <?php    
                                
                                $i = $i + 1;
                            }
                        } else {
                            ?>
                            <tr>
                                <td align="center" colspan="4">No se encontraron datos</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
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


    case "8":
    
        @$id_empresa = $_POST["id_empresa"];
        $combo = new Combo_Box();		
        
        $tabla_empresa = $dbEmpresas->getEmpresa($id_empresa);
        
        $id_empresa = $_POST['id_empresa'];            
        $nit_empresa = $tabla_empresa['nit_empresa'];
        $nombre_empresa = $tabla_empresa['nombre_empresa'];
        $direccion_empresa = $tabla_empresa['direccion_empresa'];
        $nombre_contacto = $tabla_empresa['nombre_contacto'];
        $nombre_contacto2 = $tabla_empresa['nombre_contacto2'];
        $telefono1_contacto = $tabla_empresa['telefono1_contacto'];
        $telefono2_contacto = $tabla_empresa['telefono2_contacto'];
        $email_contacto = $tabla_empresa['email_contacto'];
        $email_contacto2 = $tabla_empresa['email_contacto2'];
        $observaciones_empresa = $tabla_empresa['observaciones_empresa'];
        
        ?>
        <input type="hidden" id="id_empresa" id="id_empresa" value="<?php echo($id_empresa);?>">   
        
        <div class="panel panel-default">
            <div class="panel-body">
                <p><b>NIT: </b><?php echo($nit_empresa);?></p>
                <p><b>Nombre: </b><?php echo($nombre_empresa);?></p>
                <p><b>Contacto: </b><?php echo($nombre_contacto);?></p>
                <p><b>Tel&eacute;fonos: </b><?php echo($telefono1_contacto);?></p>
            </div>
        </div>
        <?php
        
        
        
    break;
    
    
    case "9": 
        
        ?>
        <!-- Modal -->
        <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            
            <?php
            @$id_empresa = $_POST["id_empresa"];
            @$id_academica = $_POST["id_academica"];
            @$nombre_empresa = $_POST["nombre_empresa"];
            @$nombre_estudiante = $_POST["nombre_estudiante"];
            
            $tabla_estudiantes_empresas = $dbCertificacion->getListaEstudiantesEmpresas($id_academica, $id_empresa);
            
            $cantidad_registro = count($tabla_estudiantes_empresas);
            
            ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="myModalLabel" style="text-align: center;"><b>Esta seguro de Enviar Hoja de vida</b></h3>
                        
                        <h4 class="modal-title" id="myModalLabel"><b>Estudiante:</b> <?php echo($nombre_estudiante);?></h4>
                        <h4 class="modal-title" id="myModalLabel"><b>Empresa:</b> <?php echo($nombre_empresa);?></h4>
                    </div>
                    
                    <div class="modal-body centrar">                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger contenedor_error" role="alert" id='contenedor_error_hv_empresa'></div>
                            <div class="alert alert-success contenedor_exito" role="alert" id='contenedor_exito_hv_empresa'></div>
                        </div>
                    </div>                    
                    
                    <div class="modal-body centrar">
                        <?php
                        if ($cantidad_registro > 0) {
                            
                        ?>
                        <div class="alert alert-success" role="alert">Ya existe una hoja de vida de esta estudiante para esta empresa</div>
                        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                        <?php

                        }
                        else{
                        ?>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" id="btn_enviar_hv_empresa" class="btn btn-primary" onclick="enviar_hv_empresa(<?php echo($id_academica);?>, <?php echo($id_empresa);?>);">Enviar HV</button>
                        <?php                            
                        }
                        ?>
                        
                    </div>
                    <div id="div_enviar_hv_empresa"></div>

                </div>
            </div>
        </div>
        <?php
        
       
        
    break;
    
    
    case "10": 
        $id_usuario = $_SESSION["idUsuario"];
        $id_academica = $_POST["id_academica"];
        $id_empresa = $_POST["id_empresa"];       
        $ind_resultado = $dbCertificacion->Enviar_HV_Empresa($id_academica, $id_empresa, $id_usuario);        
        
        ?>
        <input type="hidden" id="hdd_resul_enviar_hv" name="hdd_resul_enviar_hv" value="<?php echo($ind_resultado); ?>" />
        <?php
        
    break;

    case "11": 
    ?>
    <!-- Modal -->
    <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <?php
        
        @$titulo = $_POST["titulo"];
        @$id_empresa = $_POST["id_empresa"];
        @$id_academica = $_POST["id_academica"];
        @$id_estudiante_empresa = $_POST["id_estudiante_empresa"];
        @$nombre_empresa = $_POST["nombre_empresa"];
        @$nombre_estudiante = $_POST["nombre_estudiante"];
        @$tipo = $_POST["tipo"];
        ?>
        
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 style="text-align: center;" class="modal-title" id="myModalLabel"><b><?php echo $titulo; ?><b></h4>
                    <h5 class="modal-title" id="myModalLabel"><b>Empresa:</b><?php echo $nombre_empresa; ?></h5>
                    <h5 class="modal-title" id="myModalLabel"><b>Estudiante:</b><?php echo $nombre_estudiante; ?></h5>
                </div>
                <div class="modal-body centrar">   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger contenedor_error" role="alert" id='contenedor_error_segumiento'></div>
                            <div class="alert alert-success contenedor_exito" role="alert" id='contenedor_exito_segumiento'></div>
                        </div>
                    </div>                    
                    
                    <div class="modal-body centrar">
                        <div class="panel-body">
                        <div class="row"> 
                          <div class="form-group">  
                              
                            <?php
                            if($tipo==1){                                
                                $tabla_seguimientos = $dbCertificacion->Ver_Seguimiento_Empresa_Estudiante($id_academica, $id_empresa, $id_estudiante_empresa);
                                
                                foreach($tabla_seguimientos as $fila_segumiento){
                                    $observacion_seguimiento = $fila_segumiento['observacion_seguimiento'];
                                    $fecha_seguimiento = $fila_segumiento['fecha_seguimiento'];
                                ?>
                                  <div class="panel panel-default">
                                    <div class="panel-heading"><b>Fecha:</b> <?php echo($fecha_seguimiento);?></div>
                                    <div class="panel-body">
                                        <textarea rows=5 disabled class="form-control" name="observaciones_seguimiento" id="observaciones_seguimiento" placeholder="Observaciones" value="" onblur="trim_cadena(this);" ><?php echo($observacion_seguimiento);?></textarea>  
                                        
                                    </div>
                                  </div>
                                <?php
                                }
                            ?>    
                              
                               
                            <?php    
                            } else if($tipo==2){
                            ?>    
                               <div class="col-md-12 ">
                                    <label for="txt_email">Observaci&oacute;n</label>
                                    <textarea rows=5 class="form-control" name="observaciones_seguimiento" id="observaciones_seguimiento" placeholder="Observaciones" value="" onblur="trim_cadena(this);" ></textarea>
                                </div>
                                <div class="col-md-12 ">
                                    <button type="button" class="btn btn-primary" onclick="enviar_segumiento_empresas_estudiante(<?php echo($id_empresa);?>, <?php echo($id_academica);?>, <?php echo($id_estudiante_empresa);?>);" >Enviar</button>
                                </div>  
                                <div id="div_enviar_seguimiento"></div>    
                            <?php        
                            }
                            
                            ?>
                            
                            
                              
                          </div>   
                            
                          
                        </div>  
                       </div>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
    <?php    
        
    break;

    case "12": 
        $id_usuario = $_SESSION["idUsuario"];
       
        @$id_empresa = $_POST["id_empresa"];
        @$id_academica = $_POST["id_academica"];
        @$id_estudiante_empresa = $_POST["id_estudiante_empresa"];
        @$observaciones_seguimiento = $utilidades->str_decode($_POST["observaciones_seguimiento"]);
        
        $ind_resultado = $dbCertificacion->Enviar_Seguimiento_Empresa_Estudiante($id_academica, $id_empresa, $id_estudiante_empresa, $observaciones_seguimiento, $id_usuario);        
        
        ?>
        <input type="hidden" id="hdd_resul_seguimiento" name="hdd_resul_seguimiento" value="<?php echo($ind_resultado); ?>" />
        <?php
        
    break;



    case "13": 
    ?>
    <!-- Modal -->
    <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <?php
        
        @$titulo = $_POST["titulo"];
        @$id_empresa = $_POST["id_empresa"];
        @$id_academica = $_POST["id_academica"];
        @$id_estudiante_empresa = $_POST["id_estudiante_empresa"];
        @$nombre_empresa = $_POST["nombre_empresa"];
        @$nombre_estudiante = $_POST["nombre_estudiante"];
        
        
        $tabla_empresa_estudiante = $dbCertificacion->get_Empresa_Estudiante($id_estudiante_empresa);
        
        @$fecha_fin_contrato = $tabla_empresa_estudiante['format_fecha_fin'];
        @$fecha_ini_contrato = $tabla_empresa_estudiante['format_fecha_ini'];
        
        ?>
        
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 style="text-align: center;" class="modal-title" id="myModalLabel"><b><?php echo $titulo; ?><b></h4>
                    <h5 class="modal-title" id="myModalLabel"><b>Empresa:</b><?php echo $nombre_empresa; ?></h5>
                    <h5 class="modal-title" id="myModalLabel"><b>Estudiante:</b><?php echo $nombre_estudiante; ?></h5>
                </div>
                <div class="modal-body centrar">   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger contenedor_error" role="alert" id='contenedor_error_segumiento'></div>
                            <div class="alert alert-success contenedor_exito" role="alert" id='contenedor_exito_segumiento'></div>
                        </div>
                    </div>                    
                    
                    <div class="modal-body centrar">
                        <div class="panel-body">
                        <div class="row"> 
                          <div class="form-group">  
                            
                            <div class="col-md-6 form-group">
                                <label for="fecha_ini_contrato">Fecha de Inicio </label>
                                <input type="text" class="form-control" name="fecha_ini_contrato" id="fecha_ini_contrato" placeholder="dd/mm/aaaa" value="<?php echo $fecha_ini_contrato;?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                            </div>                    
                            <div class="col-md-6 form-group">
                                <label for="fecha_fin_contrato">Fecha de Finalizaci&oacute;n </label>
                                <input type="text" class="form-control" name="fecha_fin_contrato" id="fecha_fin_contrato" placeholder="dd/mm/aaaa" value="<?php echo $fecha_fin_contrato;?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                            </div>                    
                              
                              
                             <div class="col-md-12 ">
                                 <button type="button" class="btn btn-success btn-lg btn-block" onclick="vincular_empresas_estudiante(<?php echo($id_empresa);?>, <?php echo($id_academica);?>, <?php echo($id_estudiante_empresa);?>);" >Activar Vinculaci&oacute;n con Empresa</button>
                             </div>  
                             <div id="div_vincular_empresa"></div>    
                              
                          </div>   
                            
                          
                        </div>  
                       </div>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
    <?php    
        
    break;


    case "14": 
        $id_usuario = $_SESSION["idUsuario"];
       
        @$id_empresa = $_POST["id_empresa"];
        @$id_academica = $_POST["id_academica"];
        @$id_estudiante_empresa = $_POST["id_estudiante_empresa"];
        
        @$fecha_ini_contrato = $_POST["fecha_ini_contrato"];
        @$fecha_fin_contrato = $_POST["fecha_fin_contrato"];
        
        $ind_resultado = $dbCertificacion->Vincular_Empresa_Estudiante($id_academica, $id_empresa, $id_estudiante_empresa, $fecha_ini_contrato, $fecha_fin_contrato, $id_usuario);        
        
        ?>
        <input type="hidden" id="hdd_resul_vincular_seguimiento" name="hdd_resul_vincular_seguimiento" value="<?php echo($ind_resultado); ?>" />
        <?php
        
    break;

	
	
		
		
	
	
	
	
	
}

?>
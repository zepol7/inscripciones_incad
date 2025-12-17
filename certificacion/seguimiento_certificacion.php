<?php
session_start();

require_once("../db/DbVariables.php");
require_once("../db/DbUsuarios.php");
require_once("../db/DbPerfiles.php");
require_once("../db/DbListas.php");
require_once("../funciones/Utilidades.php");
require_once("../principal/ContenidoHtml.php");
require_once("../funciones/Class_Combo_Box.php");
require_once("../db/DbListas.php");
$variables = new Dbvariables();
$usuarios = new DbUsuarios();
$perfiles = new DbPerfiles();
$dbListas = new DbListas();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
$combo = new Combo_Box();
$dbListas = new DbListas();
$tipo_acceso_menu = $contenido->obtener_permisos_menu($_POST["hdd_numero_menu"]);


//variables
$titulo = $variables->getVariable(1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $titulo['valor_variable']; ?></title>
        <link href="../css/estilos_1.css" rel="stylesheet" type="text/css" />
        <link href="../css/bootstrap/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="../css/bootstrap/bootstrap-toggle.min.css" rel="stylesheet">

    </head>
    <body>
        <?php
        $contenido->validar_seguridad(0);
        $contenido->cabecera_html();
        
        $tb_estados_validacion[0][0] = 1;
        $tb_estados_validacion[0][1] = "Enviado";
        $tb_estados_validacion[1][0] = 2;
        $tb_estados_validacion[1][1] = "Validado";
        $tb_estados_validacion[2][0] = 3;
        $tb_estados_validacion[2][1] = "No validado";
        
        
        ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12 fondoAzul">
                    <ol class="breadcrumb">
                        <li>Proceso de Certificaci&oacute;n</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger contenedor_error" role="alert" id='contenedor_error'></div>
                    <div class="alert alert-success contenedor_exito" role="alert" id='contenedor_exito'></div>
                </div>
            </div>
            
            
            <div class="panel-group">
                <div class="panel panel-info">
                  <div class="panel-heading">Opciones de busqueda</div>
                  <div class="panel-body">
                      
                    <div class="form-group">
                        <div class="col-md-3 form-group">
                            <label for="">Programa Acad&eacute;mico INCAD</label>
                            <?php
                            $combo->getComboDb('id_programa', "", $dbListas->getListaProgramasProductivaTodos(4), 'id_listas_editable_detalle, nombre_lista_editable_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>                                        
                        </div>                       
                        <div class="col-md-3 form-group">
                            <label for="">Jornada *</label>
                            <?php
                            $combo->getComboDb('jornada', "", $dbListas->getListaDetallesEditabelTodos(3), 'id_listas_editable_detalle, nombre_lista_editable_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>                            
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Calendario Acad&eacute;mico</label>
                            <?php
                            $combo->getComboDb('calendario_academico', "", $dbListas->getListaDetallesEditabelTodos(2), 'id_listas_editable_detalle, nombre_lista_editable_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>
                        </div>
                        <div class="col-md-3 form-group">                   
                            <label for="">Nombre o Documento</label>
                            <input type="text" class="form-control" id="txt_busca_estudiante" name="txt_busca_estudiante" placeholder="Nombre o Documento" onblur="trim_cadena(this);" >   
                        </div>   
                    </div>
                  </div>
                </div>
                
                
                <!-- 
                cert_carta
                cert_contrato
                cert_calificacion
                cert_certificacion
                cert_fecha_ini
                cert-fecha_fin
                cert_pasantia
                cert_solicitud_academica
                cert_laboral                
                -->
                
                
                <div class="panel panel-warning">
                  <div class="panel-heading">Estados de Certificaci&oacute;n</div>
                  <div class="panel-body">
                      <div class="form-group">
                        <div class="col-md-2 form-group" >  
                            <i class="glyphicon glyphicon-certificate es_cert_carta">1</i><br />
                            <label for="">Carta de Presentaci&oacute;n</label>
                            <?php
                            $combo->getComboDb('cert_carta', "", $dbListas->getListaDetalles(11), 'id_detalle, nombre_detalle', '-Estado-', '', '', 'width: 100px;', '', 'form-control');
                            ?>
                        </div>                                    
                        <div class="col-md-3 form-group">
                            <i class="glyphicon glyphicon-certificate es_cert_contrato">2</i><br />
                            <label for="">Contrato de Aprendizaje</label>
                            <?php 
                            $combo->getComboDb('cert_contrato', "", $dbListas->getListaDetalles(11), 'id_detalle, nombre_detalle', '-Estado-', '', '', 'width: 100px;', '', 'form-control');
                            ?>
                        </div>
                        <div class="col-md-2 form-group">
                            <i class="glyphicon glyphicon-certificate es_cert_calificacion">3</i><br />
                            <label for="">Calificaci&oacute;n</label>
                            <?php
                            $combo->getComboDb('cert_calificacion', "", $dbListas->getListaDetalles(11), 'id_detalle, nombre_detalle', '-Estado-', '', '', 'width: 100px;', '', 'form-control');
                            ?>
                        </div>
                        <div class="col-md-2 form-group">
                            <i class="glyphicon glyphicon-certificate es_cert_certificacion">4</i><br />
                            <label for="">Certificaci&oacute;n</label>
                            <?php
                            $combo->getComboDb('cert_certificacion', "", $dbListas->getListaDetalles(11), 'id_detalle, nombre_detalle', '-Estado-', '', '', 'width: 100px;', '', 'form-control');
                            ?>
                        </div>
                        <div class="col-md-2 form-group">
                            <i class="glyphicon glyphicon-certificate es_cert_pasantia">5</i><br />
                            <label for="">Formato de Pasantia</label>
                            <?php
                            $combo->getComboDb('cert_pasantia', "", $dbListas->getListaDetalles(11), 'id_detalle, nombre_detalle', '-Estado-', '', '', 'width: 100px;', '', 'form-control');
                            ?>
                        </div>
                        
                          <div class="col-md-4 form-group">&nbsp;</div>  
                          
                        <div class="col-md-2 form-group">
                            <i class="glyphicon glyphicon-certificate es_cert_solicitud_academica">6</i><br />
                            <label for="">Solicitud Acad&eacute;mica</label>
                            <?php
                            $combo->getComboDb('cert_solicitud_academica', "", $dbListas->getListaDetalles(11), 'id_detalle, nombre_detalle', '-Estado-', '', '', 'width: 100px;', '', 'form-control');
                            ?>
                        </div>  
                          
                        <div class="col-md-2 form-group">
                            <i class="glyphicon glyphicon-certificate es_cert_laboral">7</i><br />
                            <label for="">Certificaci&oacute;n Laboral</label>
                            <?php
                            $combo->getComboDb('cert_laboral', "", $dbListas->getListaDetalles(11), 'id_detalle, nombre_detalle', '-Estado-', '', '', 'width: 100px;', '', 'form-control');
                            ?>
                        </div>    
                          
                          
                    </div>  
                  </div>
                </div>
                
                
                <div class="panel panel-default">
                    <div class="panel-body">
                         <div class="centrar">
                            <div class="col-md-12 form-group">
                                <button type="button" id="btn_crear_usuario" class="btn btn-success" onclick="validar_buscar(1);">Buscar Estudiantes</button>                                            
                            </div>
                        </div>   
                    </div>
                </div>
                
                
              </div>
            
            

            <div class="row">
                <div class="col-md-12">
                    <div id="principal_lista_estudiantes" style="width:110%; margin-left: -50px;" ></div>
                </div>
            </div>

        </div>
        <?php
        $contenido->footer();
        ?>

        <script type='text/javascript' src='../js/validaFecha.js'></script>
        <script type='text/javascript' src='../js/jquery.min.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.add.js'></script>
        <script type='text/javascript' src='../js/ajax.js'></script>
        <script type='text/javascript' src='../js/funciones.js'></script>
        <script type='text/javascript' src='seguimiento_certificacion_v1.2.js'></script>
        <script type='text/javascript' src='../js/bootstrap/bootstrap.js'></script>       
        <script src="../js/bootstrap/bootstrap-toggle.min.js"></script>
        
    </body>
</html>

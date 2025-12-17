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
                        <li>Activar Estudiantes</li>
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
                
                <div class="panel panel-warning">
                  <div class="panel-heading">Busqueda por tipos de estados</div>
                  <div class="panel-body">
                      <div class="form-group">
                        <div class="col-md-2 form-group">  
                            <!-- <span class="glyphicon glyphicon-certificate es_capacita"></span> -->
                            <i class="glyphicon glyphicon-certificate es_capacita">1</i>
                            <label for="">Capacitaci&oacute;n</label>
                            <?php
                            $combo->getComboDb('estado_capacitacion', "", $dbListas->getListaDetalles(11), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>
                        </div>                                    
                        <div class="col-md-4 form-group">
                            <!--<span class="glyphicon glyphicon-certificate es_productiva"></span>-->
                            <i class="glyphicon glyphicon-certificate es_productiva">2</i>
                            <label for="">Opciones de Certificaci&oacute;n</label>
                            <?php 
                            $combo->getComboDb('estado_productividad', "", $dbListas->getListaDetalles(13), 'id_detalle, nombre_detalle', '--Seleccione--', '', "", '', '', 'form-control');
                            ?>
                        </div>
                        <div class="col-md-2 form-group">
                            <!-- <span class="glyphicon glyphicon-certificate es_hoja_vida"></span> -->
                            <i class="glyphicon glyphicon-certificate es_hoja_vida">3</i>
                            <label for="">Hoja de vida</label>
                            <?php
                            $combo->getComboDb('estado_hoja_vida', "", $dbListas->getListaDetalles(11), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>
                        </div>
                        <div class="col-md-2 form-group">
                            <!-- <span class="glyphicon glyphicon-certificate es_academica"></span> -->
                            <i class="glyphicon glyphicon-certificate es_academica">4</i>
                            <label for="">Coor. Acad&eacute;mica</label>
                            <?php
                            $combo->get('estado_academica', "", $tb_estados_validacion, '--Seleccione--', "", "", "", "", 'form-control')
                            ?>
                        </div>
                        <div class="col-md-2 form-group">
                            <!-- <span class="glyphicon glyphicon-certificate es_cartera"></span> -->
                            <i class="glyphicon glyphicon-certificate es_cartera">5</i>
                            <label for="">Cartera</label>
                            <?php
                            $combo->get('estado_cartera', "", $tb_estados_validacion, '--Seleccione--', "", "", "", "", 'form-control')
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
        <script type='text/javascript' src='certifica_seguimiento_v1.2.js'></script>
        <script type='text/javascript' src='../js/bootstrap/bootstrap.js'></script>       
        <script src="../js/bootstrap/bootstrap-toggle.min.js"></script>
        
    </body>
</html>

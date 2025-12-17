<?php
session_start();

require_once("../db/DbVariables.php");
require_once("../db/DbUsuarios.php");
require_once("../db/DbListas.php");
require_once("../funciones/Utilidades.php");
require_once("../principal/ContenidoHtml.php");
require_once("../funciones/Class_Combo_Box.php");
$variables = new Dbvariables();
$usuarios = new DbUsuarios();
$dbListas = new DbListas();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
$combo = new Combo_Box();
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
    </head>
    <body>
        <?php
        $contenido->validar_seguridad(0);
        $contenido->cabecera_html();
        ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12 fondoAzul">
                    <ol class="breadcrumb">
                        <li>Cotizador</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger contenedor_error" role="alert" id='contenedor_error'></div>
                    <div class="alert alert-success contenedor_exito" role="alert" id='contenedor_exito'></div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Buscar</div>
                        
                        <div class="panel-body">                            
                            <div class="row form-group">
                                <div class="col-md-1 form-group">&nbsp;</div>
                                <div class="col-md-4">
                                    <label class="left inline">Buscar por Nombre o Tel&eacute;fonos</label>
                                    <input type="text" class="form-control" id="txt_busca_id" name="txt_busca_id" placeholder="Documento" >   
                                </div>
                                <div class="col-md-3">                   
                                    <label for="">Fecha de desde</label>
                                    <input type="text" class="form-control" name="fecha_cotizador_desde" id="fecha_cotizador_desde" placeholder="dd/mm/aaaa" value="" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                                </div>     
                                <div class="col-md-3">                   
                                    <label for="">Fecha de hasta</label>
                                    <input type="text" class="form-control" name="fecha_cotizador_hasta" id="fecha_cotizador_hasta" placeholder="dd/mm/aaaa" value="" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                                </div>     
                                
                            </div>       
                            
                            <div class="row form-group">
                                
                                <div class="col-md-5 form-group">&nbsp;</div>
                                
                                <div class="col-md-4">
                                    <button type="button" id="btn_crear_usuario" class="btn-lg btn-default" onclick="buscar_cotizacion();">Buscar</button>
                                    <button type="button" id="btn_crear_usuario" class="btn-lg btn-primary" onclick="ver_todos_cotizados();">Ver todos</button>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                        
                        
                    <div class="panel panel-primary">    
                        <div class="panel-heading">Cotizar</div>
                        <div class="panel-body">
                            <div class="row">
                                
                                <div class="col-md-3 form-group">&nbsp;</div>
                                <div class="col-md-2 form-group">
                                    <label class="left inline"><b>Seleccionar Programa </b></label>
                                </div>
                                <div class="col-md-4 form-group">                   
                                    <?php
                                    $combo->getComboDb('cmb_id_programa', '', $dbListas->getListaDetallesEditabel(4), 'id_listas_editable_detalle, nombre_lista_editable_detalle', '--Seleccione--', 'mostrar_form_cotizador(this)', '', '', '', 'form-control');
                                    ?>    
                                </div>
                                
                            </div>    
                                
                                
                             
                                
                            
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div id="principal_cotizador"></div>
                </div>

            </div>

        </div>
        <?php
        $contenido->footer();
        ?>


        <script type='text/javascript' src='../js/jquery.min.js'></script>
        <script type='text/javascript' src='../js/validaFecha.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.add.js'></script>
        <script type='text/javascript' src='../js/ajax.js'></script>
        <script type='text/javascript' src='../js/funciones.js'></script>
        <script type='text/javascript' src='cotizador.js'></script>
        <script type='text/javascript' src='../js/bootstrap/bootstrap.js'></script>
    </body>
</html>

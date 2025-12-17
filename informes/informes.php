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
                        <li>Administrar Listas</li>
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
                        <div class="panel-heading">Generar Informes General</div>
                        <div class="panel-body">
                            <form id="informe_base" name="informe_base">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label class="left inline"><b>Seleccionar Rango de Fechas</b></label>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="">Fecha Inicial  *</label>
                                        <input type="text" class="form-control" name="fecha_inicial" id="fecha_inicial" placeholder="dd/mm/aaaa" value="" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3'); ">
                                        
                                    </div>
                                    
                                    <div class="col-md-3 form-group">
                                        <label for="">Fecha Final  *</label>
                                        <input type="text" class="form-control" name="fecha_final" id="fecha_final" placeholder="dd/mm/aaaa" value="" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3'); ">
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <button type="button" id="btn_crear_usuario" class="btn btn-success" onclick="validar_informe();">Realizar Informe</button>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div id="principal_informe" ></div>
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
        <script type='text/javascript' src='informes_v1.1.js'></script>
        <script type='text/javascript' src='../js/bootstrap/bootstrap.js'></script>
    </body>
</html>

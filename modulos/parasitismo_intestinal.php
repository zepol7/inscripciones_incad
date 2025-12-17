<?php
session_start();
/*
  Pagina listado de usuarios, muestra los usuarios existentes, para modificar o crear uno nuevo
  Autor: Helio Ruber López - 16/09/2013
 */

require_once("../db/DbVariables.php");
require_once("../db/DbUsuarios.php");
require_once("../db/DbDepartamentos.php");
require_once("../db/DbListas.php");
require_once("../funciones/Utilidades.php");
require_once("../principal/ContenidoHtml.php");
require_once("../funciones/Class_Combo_Box.php");
require_once("../funciones/Button.php");

$variables = new Dbvariables();
$usuarios = new DbUsuarios();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
$combo = new Combo_Box();
$dbListas = new DbListas();
$dbDepartamentos = new DbDepartamentos();
$button = new Button();


$tipo_acceso_menu = $contenido->obtener_permisos_menu($_POST["hdd_numero_menu"]);
//variables
$titulo = $variables->getVariable(1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no">
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
                        <li>PARASITISMO INTESTINAL</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">Para ver el video tutorial sobre el manejo de este formulario de clic en el siguiente enlace: <a href="https://youtu.be/DbVS77SoaAY" target="_blank">https://youtu.be/DbVS77SoaAY</a></div>
                    <div class="alert alert-danger contenedor_error" role="alert" id='contenedor_error'></div>
                    <div class="alert alert-success contenedor_exito" role="alert" id='contenedor_exito'></div>
                </div>
            </div>


            <div class="panel panel-info">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="centrar">
                                <?php
                                $button->getButton(1, "FICHA DE CAPTURA DE INFORMACIÓN DE PARASITISMO INTESTINAL", "button", "", "btn btn-success", "crearFicha();");
                                ?>
                            </div>

                        </div>
                        <div class="col-md-6 form-group">
                            <div class="centrar">
                                <?php
                                $button->getButton(1, "MIS ENVIOS", "button", "", "btn btn-success", "listar_envios();");
                                ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div id="principal_parasitismoIntestinakl" ></div>
                <div id="hdd_imprimir_reporte"></div>
            </div>
        </div>	


        <?php
        $contenido->footer();
        ?>

        <script type='text/javascript' src='../js/jquery.min.js'></script>
        <script type='text/javascript' src='parasitismo_intestinal_v1.2.js'></script>
        <script type='text/javascript' src='../js/validaFecha.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.add.js'></script>
        <script type='text/javascript' src='../js/ajax.js'></script>
        <script type='text/javascript' src='../js/funciones.js'></script>
        <script type='text/javascript' src='../js/bootstrap/bootstrap.js'></script>
    </body>
</html>

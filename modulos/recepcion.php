<?php
session_start();
/*
  Pagina listado de usuarios, muestra los usuarios existentes, para modificar o crear uno nuevo
  Autor: Helio Ruber López - 16/09/2013
 */

require_once("../db/DbVariables.php");
require_once("../db/DbUsuarios.php");
require_once("../db/DbListas.php");
require_once("../funciones/Utilidades.php");
require_once("../principal/ContenidoHtml.php");
require_once("../funciones/Class_Combo_Box.php");
require_once("../db/DbMuestrasAguas.php");
require_once("../db/DbClasesMuestras.php");

$variables = new Dbvariables();
$usuarios = new DbUsuarios();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
$combo = new Combo_Box();
$dbListas = new DbListas();
$dbMuestrasAguas = new DbMuestrasAguas();
$dbClasesMuestras = new DbClasesMuestras();

$tipo_acceso_menu = $contenido->obtener_permisos_menu($_POST["hdd_numero_menu"]);
//variables
$titulo = $variables->getVariable(1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no">
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
                        <li>Recepción</li>
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
                    <div class="panel panel-success">
                        <div class="panel-heading">Buscar</div>
                        <div class="panel-body">

                            <div class="col-md-2 form-group">
                                <label class="left inline"># radicado</label>
                                <input type="number" class="form-control" id="txt_busca_cod" name="txt_busca_cod" placeholder="# radicado" onblur="trim_cadena(this);">   
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="left inline">Clase</label>
                                <?php
                                $combo->getComboDb('cmb_busca_clase', '', $dbClasesMuestras->getListaClasesMuestras(), 'id_clase_muestra, nombre_clase_muestra', '--Seleccione--', 'getTiposMuestrasFrmBuscar();', '', '', '', 'form-control');
                                ?>
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="left inline">Tipo</label>
                                <select id="cmb_busca_tipo" name="cmb_busca_tipo" class="form-control" >
                                    <option value="">--Seleccione--</option>
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="left inline">Fecha</label>

                                <input type="text" class="form-control" name="txt_busca_fecha" id="txt_busca_fecha" placeholder="Fecha" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">    
                            </div>
                            <div class="col-md-4 form-group">
                                </br>
                                <button type="button" id="btn_buscar_usuario" class="btn btn-default" onclick="frmBuscar();">Buscar</button>
                                <button type="button" id="btn_ver_todos" class="btn btn-primary" onclick="listar_recepciones();">Ver todos</button>
                                <?php
                                if ($tipo_acceso_menu == 2) {
                                    ?>
                                    <button type="button" id="btn_crear_acta" class="btn btn-success" onclick="recepcionar();">Recepcionar</button>
                                    <?php
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="principal_recepcion" ></div>
                    <div id="hdd_imprimir_reporte"></div>
                </div>
            </div>
        </div>
        <?php
        $contenido->footer();
        ?>
        <script type='text/javascript' src='../js/jquery.min.js'></script>
        <script type='text/javascript' src='recepcion_v1.51.js'></script>
        <script type='text/javascript' src='../js/validaFecha.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.add.js'></script>
        <script type='text/javascript' src='../js/ajax.js'></script>
        <script type='text/javascript' src='../js/funciones.js'></script>
        <script type='text/javascript' src='../js/bootstrap/bootstrap.js'></script>
    </body>
</html>

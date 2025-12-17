<?php
session_start();
/*
  Pagina listado de usuarios, muestra los usuarios existentes, para modificar o crear uno nuevo
  Autor: Helio Ruber LÃ³pez - 16/09/2013
 */

require_once("../db/DbVariables.php");
require_once("../db/DbUsuarios.php");
require_once("../db/DbEmpresas.php");
require_once("../db/DbListas.php");
require_once("../funciones/Utilidades.php");
require_once("../principal/ContenidoHtml.php");
require_once("../funciones/Class_Combo_Box.php");

$variables = new Dbvariables();
$usuarios = new DbUsuarios();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
$dbEmpresas = new DbEmpresas();

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
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
                        <li>Poligrafos de los Programas</li>
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
                        <div class="col-md-4 form-group">
                            <label for="">Programa Acad&eacute;mico INCAD *</label>
                            <?php
                            $combo->getComboDb('id_programa', "", $dbListas->getListaDetallesEditabelTodos(4), 'id_listas_editable_detalle, nombre_lista_editable_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>                                        
                        </div>                       
                        <div class="col-md-4 form-group">
                            <label for="">Jornada *</label>
                            <?php
                            $combo->getComboDb('jornada', "", $dbListas->getListaDetallesEditabelTodos(3), 'id_listas_editable_detalle, nombre_lista_editable_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>                            
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Calendario Acad&eacute;mico *</label>
                            <?php
                            $combo->getComboDb('calendario_academico', "", $dbListas->getListaDetallesEditabelTodos(2), 'id_listas_editable_detalle, nombre_lista_editable_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>
                        </div>                        
                    </div>
                  </div>
                </div>
                
                
                <div class="panel panel-default">
                    <div class="panel-body">
                         <div class="centrar">
                            <div class="col-md-12 form-group">
                                 <?php
                                if ($tipo_acceso_menu == 2) {
                                    ?>
                                    <button type="button" id="btn_crear_usuario" class="btn btn-success" onclick="validar_llamar_poligrafo();">Imprimir Polígrafo</button>
                                    
                                    
                                    
                                    <?php
                                }
                                ?>
                            </div>
                        </div>   
                    </div>
                </div>
                
                
              </div>
            
            

        </div>
        <?php
        $contenido->footer();
        ?>


        <script type='text/javascript' src='../js/jquery.min.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.add.js'></script>
        <script type='text/javascript' src='../js/ajax.js'></script>
        <script type='text/javascript' src='../js/funciones.js'></script>
        <script type='text/javascript' src='poligrafos_v1.1.js'></script>
        <script type='text/javascript' src='../js/bootstrap/bootstrap.js'></script>
    </body>
</html>

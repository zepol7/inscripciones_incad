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
$variables = new Dbvariables();
$usuarios = new DbUsuarios();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
$combo = new Combo_Box();
$dbListas = new DbListas();
$dbDepartamentos = new DbDepartamentos();

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
                        <li>Parasitosis Humana</li>
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
                <div class="panel-heading">Identificaci&oacute;n paciente</div>
                <div class="panel-body">
                	 <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="">Fecha notificaci&oacute;n *</label>
                            <input type="text" class="form-control" name="txt_fecha_noti" id="txt_fecha_noti" placeholder="dd/mm/aaaa" value="<?php //echo $txt_fecha_noti;?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Tipo documento *</label>
                            <?php
                            $combo->getComboDb('cmb_tipo_documento', '', $dbListas->getListaDetalles(6), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">N&uacute;mero de identificaci&oacute;n *</label>
                            <input type="text" class="form-control" name="txt_identificacion" id="txt_identificacion" placeholder="Identificaci&oacute;n" value="<?php //echo $txt_identificacion; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3 form-group">
                        	<label for="">Primer nombre *</label>
                            <input type="text" class="form-control" name="txt_primer_nombre" id="txt_primer_nombre" placeholder="Primer nombre" value="<?php //echo $txt_primer_nombre; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                        </div>
                        <div class="col-md-3 form-group">
                        	<label for="">Segundo nombre</label>
                            <input type="text" class="form-control" name="txt_segundo_nombre" id="txt_segundo_nombre" placeholder="Segundo nombre" value="<?php //echo $txt_segundo_nombre; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                        </div>
                        <div class="col-md-3 form-group">
                        	<label for="">Primer apellido *</label>
                            <input type="text" class="form-control" name="txt_primer_apellido" id="txt_primer_apellido" placeholder="Primer apellido" value="<?php //echo $txt_primer_apellido; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                        </div>
                        <div class="col-md-3 form-group">
                        	<label for="">Segundo apellido</label>
                            <input type="text" class="form-control" name="txt_segundo_apellido" id="txt_segundo_apellido" placeholder="Segundo apellido" value="<?php //echo $txt_segundo_apellido; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                        </div>
                    </div>   	
                    
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="">Sexo</label>
                            <?php
                            $combo->getComboDb('cmb_sexo', '', $dbListas->getListaDetalles(14), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Fecha de nacimiento </label>
                            <input type="text" class="form-control" name="txt_fecha_nac" id="txt_fecha_nac" placeholder="dd/mm/aaaa" value="<?php //echo $txt_fecha_noti;?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Departamento</label>
                            <?php
                            $lista_departamentos = $dbDepartamentos->getListaDepartamentosActivos();
                            $combo->getComboDb('cmb_departamento', '', $lista_departamentos, 'cod_dep, nom_dep', '--Seleccione--', 'getMunicipios()', '', '', '', 'form-control');
                            ?>
                        </div>
                        <div class="col-md-3 form-group">                        	
                            <label for="">Municipio</label>
                            <?php
                            $combo->getComboDb('cmb_municipio', '', '', '', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>
                        </div>
                    </div>  
                    
                    <div class="row">
                    	<div class="col-md-3 form-group">
                            <label for="">Sexo</label>
                            <?php
                            $combo->getComboDb('cmb_area', '', $dbListas->getListaDetalles(15), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>
                        </div>
                        <div class="col-md-9 form-group">
                        	<label for="">Direcci&oacute;n de residencia</label>
                            <input type="text" class="form-control" name="txt_direccion" id="txt_direccion" placeholder="Direcci&oacute;n" value="<?php //echo $txt_direccion; ?>" onblur="trim_cadena(this); convertirAMayusculas(this);">
                        </div>
                    </div>	
                   
                   <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="">Estrato socioecon&oacute;mico</label>
                            <?php
                            $combo->getComboDb('cmb_estrato', '', $dbListas->getListaDetalles(16), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">R&racute;gimen de salud </label>
                            <?php
                            $combo->getComboDb('cmb_regimen', '', $dbListas->getListaDetalles(17), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Ocupaci&oacute;n</label>
                            <?php
                            $combo->getComboDb('cmb_ocupacion', '', $dbListas->getListaDetalles(18), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>
                        </div>
                        <div class="col-md-3 form-group">                        	
                            <label for="">Pertenencia &eacute;tnica</label>
                            <?php
                            $combo->getComboDb('cmb_etnia', '', $dbListas->getListaDetalles(19), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                            ?>
                        </div>
                    </div>
                </div>
                </div>
            </div>    	
        		
        		
        		
        	</div>
        	
        	
        	<div class="row">
            	
        	<div class="col-md-12">
    		<div class="panel panel-primary">
                <div class="panel-heading">Datos cl&iacute;nicos</div>
                <div class="panel-body">
            	<div class="row">
                    <div class="col-md-3 form-group">
                        <label for="">Presenta diarrea?</label>
                        <?php
                        $combo->getComboDb('cmb_diarrea', '', $dbListas->getListaDetalles(20), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                        ?>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Hace cuánto?</label>
                        <input type="number" class="form-control" name="tiempo_diarrea" id="tiempo_diarrea" placeholder="Cuantos D&iacute;as" onblur="trim_cadena(this); convertirAMayusculas(this);">                        
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Cu&aacute;ntas deposiciones al d&iacute;a?</label>
                        <?php
                        $combo->getComboDb('cmb_deposiciones', '', $dbListas->getListaDetalles(21), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                        ?>
                    </div>
                    <div class="col-md-3 form-group">                        	
                        <label for="">Pertenencia &eacute;tnica</label>
                        <?php
                        $combo->getComboDb('cmb_etnia', '', $dbListas->getListaDetalles(19), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                        ?>
                    </div>
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
        <script type='text/javascript' src='parasitosis_humana_v1.1.js'></script>
        <script type='text/javascript' src='../js/validaFecha.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.add.js'></script>
        <script type='text/javascript' src='../js/ajax.js'></script>
        <script type='text/javascript' src='../js/funciones.js'></script>
        <script type='text/javascript' src='../js/bootstrap/bootstrap.js'></script>
    </body>
</html>

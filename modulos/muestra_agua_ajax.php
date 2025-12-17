<?php
session_start();
/*
  Pagina listado de usuarios, muestra los usuarios existentes, para modificar o crear uno nuevo
  Autor: Helio Ruber L�pez - 16/09/2013
 */

require_once("../db/DbUsuarios.php");
require_once("../db/DbListas.php");
require_once("../db/DbPerfiles.php");
require_once("../db/DbDepartamentos.php");
require_once("../db/DbMunicipios.php");
require_once("../funciones/Utilidades.php");
require_once("../funciones/Class_Combo_Box.php");
require_once("../funciones/Button.php");
require_once("../principal/ContenidoHtml.php");
require_once("../db/DbMuestrasAguas.php");

$dbUsuarios = new DbUsuarios();
$dbListas = new DbListas();
$dbPefiles = new DbPerfiles();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
$dbDepartamentos = new DbDepartamentos();
$dbMunicipios = new DbMunicipios();
$combo = new Combo_Box();
$dbMuestrasAguas = new DbMuestrasAguas();
$button = new Button();


$id_usuario = $_SESSION["idUsuario"];


if (isset($_POST["hdd_numero_menu"])) {
    $tipo_acceso_menu = $contenido->obtener_permisos_menu($_POST["hdd_numero_menu"]);
}

$opcion = $_POST["opcion"];
if ($opcion != "4" && $opcion != "6") {
    header('Content-Type: text/xml; charset=UTF-8');
}

switch ($opcion) {
    case "1":

        @$countFiles = $utilidades->limpiar_tags($_POST["countFiles"]);
        $fileName = $_FILES["file1"]["name"]; // The file name
        $fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
        $fileType = $_FILES["file1"]["type"]; // The type of file it is
        $fileSize = $_FILES["file1"]["size"]; // File size in bytes
        $fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true


        move_uploaded_file($fileTmpLoc, "upload/test_uploads/$fileName");
        echo $fileName;

        break;

    case "2": //Formulario de nueva acta
        $titulo_formulario = 'Acta de toma de muestras de agua';
        $txtSolicitante = "";
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading"><?php echo $titulo_formulario; ?></div>
                    <div class="panel-body">
                        <form id="frmActaMuestraAgua">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Solicitante</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Solicitante</label>
                                            <input type="text" class="form-control" name="txtSolicitante" id="txtSolicitante" placeholder="Solicitante" value="<?php echo $txtSolicitante; ?>" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Tel&eacute;fono</label>
                                            <input type="number" class="form-control" name="txt_tel_s" id="txt_tel_s" placeholder="Tel&eacute;fono" value="<?php //echo $txtSolicitante;                                                                                         ?>" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="">Direcci&oacute;n</label>
                                            <input type="text" class="form-control" name="txt_dir_s" id="txt_dir_s" placeholder="Direcci&oacute;n" value="<?php //echo $txtSolicitante;                                                                                         ?>" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                                        </div>
                                    </div>
                                </div>    
                            </div>

                            <div class="panel panel-primary">
                                <div class="panel-heading">EPSA y tipo de muestra</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Fecha de toma</label>
                                            <input type="text" class="form-control" name="txt_fecha_toma" id="txt_fecha_toma" placeholder="Fecha de toma" value="<?php //echo $txtSolicitante;                                                                                         ?>" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Hora de toma</label>
                                            <div class="row">
                                                <div class="col-md-4 ">
                                                    <input type="number" class="form-control" name="txt_hora_toma" id="txt_hora_toma" placeholder="Hora" maxlength="2" size="2">
                                                </div>
                                                <div class="col-md-4 ">
                                                    <input type="number" class="form-control" name="txt_min_toma" id="txt_min_toma" placeholder="Minutos" maxlength="2" size="2">
                                                </div>
                                                <div class="col-md-4">
                                                    <select id="cmb_periodo_toma" name="cmb_periodo_toma" class="form-control">
                                                        <option value="">Seleccione</option>
                                                        <option value="1">A.M.</option>
                                                        <option value="0">P.M.</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">¿Punto de toma de muestra concretado?</label>
                                            <select id="cmb_p_concretado" name="cmb_p_concretado" class="form-control" >
                                                <option value="">Seleccione</option>
                                                <option value="1">S&iacute;</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <div class="centrar">
                                                <br/>
                                                <?php
                                                $button->getButton(2, "Seleccionar E.P.S.A.", "button", "btn_editar", "btn btn-warning", "seleccionarEPSA();");
                                                ?>
                                            </div>  
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <input type="text" class="form-control" name="txt_epsa_s" id="txt_epsa_s" placeholder="Nombre EPSA" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <input type="text" class="form-control" name="txt_dir_epsa_s" id="txt_dir_epsa_s" placeholder="Direcci&oacute;n EPSA" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" name="txt_codigo_p_muestreo" id="txt_codigo_p_muestreo" placeholder="C&oacute;digo Punto de muestreo" onblur="trim_cadena(this);
                                                                    convertirAMayusculas(this);" maxlength="5" size="5">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="txt_p_muestreo" id="txt_p_muestreo" placeholder="Nombre Punto de muestreo" onblur="trim_cadena(this);
                                                                    convertirAMayusculas(this);">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="">Direcci&oacute;n punto toma</label>
                                            <input type="text" class="form-control" name="txt_dir_p_muestreo" id="txt_dir_p_muestreo" placeholder="Direcci&oacute;n punto toma" value="<?php //echo $txtSolicitante;                                                                                         ?>" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="">Fuente</label>
                                            <input type="text" class="form-control" name="txt_fuente_p_muestreo" id="txt_fuente_p_muestreo" placeholder="Fuente" value="<?php //echo $txtSolicitante;                                                                                         ?>" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 form-group">
                                            <label for="">Tipo de muestra</label>
                                            <?php
                                            $combo->getComboDb('cmb_tipo_muestra', '', $dbListas->getListaDetalles(8), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>    

                            <div class="panel panel-primary">
                                <div class="panel-heading">¿Compañ&oacute; alguien por parte de la EPSA?</div>
                                <div class="panel-body">    
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <select id="cmb_epsa_acompanante" name="cmb_epsa_acompanante" class="form-control" onchange="frmMuestraAguaEpsaAcompanante();">
                                                <option value=""> -- ¿Acompañ&oacute; alguien por parte de la EPSA?--</option>
                                                <option value="1">S&iacute;</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row tr-epsa-acompanante" style="display: none;">
                                        <div class="col-md-12 form-group">
                                            <label for="">Acompañado por parte de la empresa prestadora</label>
                                            <input type="text" class="form-control" name="txt_acomp_epsa" id="txt_acomp_epsa" placeholder="Acompañado por parte de la empresa prestadora" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                                        </div>
                                    </div>
                                    <div class="row tr-epsa-acompanante" style="display: none;">
                                        <div class="col-md-12 form-group">
                                            <label for="">Cargo</label>
                                            <input type="text" class="form-control" name="txt_acomp_cargo" id="txt_acomp_cargo" placeholder="Cargo" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="panel panel-primary">
                                <div class="panel-heading">An&aacute;lisis</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">An&aacute;lisis solicitado</label>
                                            <?php
                                            $combo->getComboDb('cmb_tipo_analisis', '', $dbListas->getListaDetalles(9), 'id_detalle, nombre_detalle', '--Seleccione--', 'frmMuestraAguaOtroAnalisisSolicitado();', '', '', '', 'form-control');
                                            ?>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            </br>
                                            <label for=""></label>
                                            <input type="text" class="form-control" name="txt_otro_tipo_analisis" id="txt_otro_tipo_analisis" placeholder="Otro" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Objeto del an&aacute;lisis</label>
                                            <?php
                                            $combo->getComboDb('cmb_objeto_analisis', '', $dbListas->getListaDetalles(10), 'id_detalle, nombre_detalle', '--Seleccione--', 'frmMuestraAguaOtroObjetoAnalisis();', '', '', '', 'form-control');
                                            ?>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            </br>
                                            <label for=""></label>
                                            <input type="text" class="form-control" name="txt_otro_objeto_analisis" id="txt_otro_objeto_analisis" placeholder="Otro" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        </br>
                                        <div class="col-md-12 form-group">
                                            <label for="">An&aacute;lisis del sitio</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="">Temperatura (°C)</label>
                                            <input type="number" class="form-control" name="txt_temp" id="txt_temp" placeholder="(°C)" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="">Color</label>
                                            <input type="text" class="form-control" name="txt_color" id="txt_color" placeholder="Color" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="">CL.R.L</label>
                                            <input type="number" class="form-control" name="txt_clrl" id="txt_clrl" placeholder="CL.R.L" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="">P.P.M</label>
                                            <input type="number" class="form-control" name="txt_ppm" id="txt_ppm" placeholder="P.P.M" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="">Aspecto</label>
                                            <input type="text" class="form-control" name="txt_aspecto" id="txt_aspecto" placeholder="Aspecto" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="">PH</label>
                                            <input type="number" class="form-control" name="txt_ph" id="txt_ph" placeholder="PH" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="">Otros</label>
                                            <input type="text" class="form-control" name="txt_otros_analisis" id="txt_otros_analisis" placeholder="Otros análisis" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="">Observaciones</label>
                                            <textarea class="form-control" rows="4" id="txt_observaciones_analisis" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>     

                            <div class="panel panel-primary">
                                <div class="panel-heading">Muestra</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $combo->getComboDb('cmb_muestra', '', $dbListas->getListaDetalles(11), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control');
                                            ?>
                                        </div>
                                    </div>

                                </div> 
                            </div>

                            <div class="panel panel-primary">
                                <div class="panel-heading">Acta física</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Seleccionar archivo</label>
                                            <input id="actaMuestraAgua" name="actaMuestraAgua" type="file">
                                        </div>
                                    </div>

                                </div> 
                            </div> 
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="centrar">
                                        <?php
                                        $button->getButton(2, "Enviar la muestra", "submit", "btn_editar", "btn btn-success", "crearActaMuestraAgua();");
                                        ?>
                                    </div>    
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <input id="hdd_resultado" type="hidden" />
        <div style="font-size: 11pt; text-align: left;padding: 10px;">
            <p class="bg-warning" style="padding: 0;margin: 0;">Muestra para an&aacute;lisis microbiol&oacute;gico m&iacute;nimo 250 ml. llenando hasta 3/4 partes de su capacidad.</p>
            <p class="bg-warning" style="padding: 0;margin: 0;">Recipiente estirilizado. An&aacute;lisis fisicoqu&iacute;mico m&iacute;nimo 1 Litro.</p>
            <p class="bg-warning" style="padding: 0;margin: 0;">El r&oacute;tulo debe ser INDELEBLE En el se registra toda la informaci&oacute;n en forma CLARA</p>
            <p class="bg-warning" style="padding: 0;margin: 0;">Recepci&oacute;n de muestras: Lunes. Martes y Mi&eacute;rcoles de 7:00 a.m. a 4:00 p.m.</p>
        </div>


        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">E.P.S.A. y puntos de muestreo</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="">Departamento *</label>
                                <?php
                                $combo->getComboDb('cmb_dep', '', $dbDepartamentos->getListaDepartamentosActivos(), 'cod_dep, nom_dep', '--Seleccione--', 'getMunicipiosFrmRecepcion();', '', '', '', 'form-control required');
                                ?>
                            </div>
                            <div class="col-md-3">
                                <label for="">Municipio *</label>
                                <?php
                                $combo->getComboDb('cmb_dep', '', $dbDepartamentos->getListaDepartamentosActivos(), 'cod_dep, nom_dep', '--Seleccione--', 'getMunicipiosFrmRecepcion();', '', '', '', 'form-control required');
                                ?>
                            </div>
                            <div class="col-md-3">
                                 <label for="">N.I.T.</label>
                                            <input type="text" class="form-control" name="txt_otros_analisis" id="txt_otros_analisis" placeholder="Otros análisis" onblur="trim_cadena(this);
                                                            convertirAMayusculas(this);">
                            </div>
                            <div class="col-md-3">
                                 <br/>
                                 <button type="button" class="btn btn-primary">BUSCAR</button>
                            </div>
                        </div>
                    </div>
                  
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <?php
        break;
    case "3": //Crear acta de muestra de agua
        @$txtSolicitante = $utilidades->limpiar_tags($_POST["txtSolicitante"]);
        @$txt_tel_s = $utilidades->limpiar_tags($_POST["txt_tel_s"]);
        @$txt_dir_s = $utilidades->limpiar_tags($_POST["txt_dir_s"]);
        @$txt_fecha_toma = $utilidades->limpiar_tags($_POST["txt_fecha_toma"]);
        @$txt_hora_toma = $utilidades->limpiar_tags($_POST["txt_hora_toma"]);
        @$txt_min_toma = $utilidades->limpiar_tags($_POST["txt_min_toma"]);
        @$cmb_periodo_toma = $utilidades->limpiar_tags($_POST["cmb_periodo_toma"]);
        @$txt_epsa_s = $utilidades->limpiar_tags($_POST["txt_epsa_s"]);
        @$cmb_p_concretado = $utilidades->limpiar_tags($_POST["cmb_p_concretado"]);
        @$txt_p_muestreo = $utilidades->limpiar_tags($_POST["txt_p_muestreo"]);
        @$txt_dir_p_muestreo = $utilidades->limpiar_tags($_POST["txt_dir_p_muestreo"]);
        @$txt_fuente_p_muestreo = $utilidades->limpiar_tags($_POST["txt_fuente_p_muestreo"]);
        @$cmb_epsa_acompanante = $utilidades->limpiar_tags($_POST["cmb_epsa_acompanante"]);
        @$cmb_tipo_analisis = $utilidades->limpiar_tags($_POST["cmb_tipo_analisis"]);
        @$cmb_objeto_analisis = $utilidades->limpiar_tags($_POST["cmb_objeto_analisis"]);
        @$txt_temp = $utilidades->limpiar_tags($_POST["txt_temp"]);
        @$txt_color = $utilidades->limpiar_tags($_POST["txt_color"]);
        @$txt_clrl = $utilidades->limpiar_tags($_POST["txt_clrl"]);
        @$txt_ppm = $utilidades->limpiar_tags($_POST["txt_ppm"]);
        @$txt_aspecto = $utilidades->limpiar_tags($_POST["txt_aspecto"]);
        @$txt_ph = $utilidades->limpiar_tags($_POST["txt_ph"]);
        @$txt_otros_analisis = $utilidades->limpiar_tags($_POST["txt_otros_analisis"]);
        @$cmb_muestra = $utilidades->limpiar_tags($_POST["cmb_muestra"]);
        @$txt_otro_tipo_muestra = NULL;
        @$txt_acomp_epsa = $utilidades->limpiar_tags($_POST['txt_acomp_epsa']);
        @$txt_acomp_cargo = $utilidades->limpiar_tags($_POST['txt_acomp_cargo']);
        @$txt_otro_tipo_analisis = $utilidades->limpiar_tags($_POST['txt_otro_tipo_analisis']);
        @$txt_otro_objeto_analisis = $utilidades->limpiar_tags($_POST['txt_otro_objeto_analisis']);
        @$txt_codigo_p_muestreo = $utilidades->limpiar_tags($_POST['txt_codigo_p_muestreo']);
        @$cmb_tipo_muestra = $utilidades->limpiar_tags($_POST['cmb_tipo_muestra']);
        @$txt_observaciones_analisis = $utilidades->limpiar_tags($_POST['txt_observaciones_analisis']);
        @$txt_dir_epsa_s = $utilidades->limpiar_tags($_POST['txt_dir_epsa_s']);
        @$idMuestra = $utilidades->limpiar_tags($_POST['idMuestra']);

        @$countFiles = $utilidades->limpiar_tags($_POST["countFiles"]);

        $rutaParaGuardar = '';
        /* Guarda en disco */
        if ($countFiles > 0) {
            $fileName = $_FILES["file1"]["name"]; // The file name
            $fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
            $fileType = $_FILES["file1"]["type"]; // The type of file it is
            $fileSize = $_FILES["file1"]["size"]; // File size in bytes
            $fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
            //$fileName = "Prueba.json";
            //echo $fileType;
            $year = date("Y");
            $mes = date("m");
            $dia = date("d");
            $ruta = '';

            $rand = rand(1, 100);

            /* Construye la ruta de almacenamineto */
            if (!is_dir('../uploads/' . $year)) {/* Año */
                mkdir('../uploads/' . $year, 0700);
            }
            if (!is_dir('../uploads/' . $year . '/' . $mes)) {/* Mes */
                mkdir('../uploads/' . $year . '/' . $mes, 0700);
            }
            if (!is_dir('../uploads/' . $year . '/' . $mes . "/" . $dia)) {/* Día */
                mkdir('../uploads/' . $year . '/' . $mes . "/" . $dia, 0700);
            }

            $rutaParaGuardar = 'uploads/' . $year . '/' . $mes . '/' . $dia . '/' . $idMuestra . "-" . $id_usuario . "-" . rand() . ".pdf";
            $ruta = '../' . $rutaParaGuardar;
            move_uploaded_file($fileTmpLoc, $ruta);
        }
        /* END */

        $rta = $dbMuestrasAguas->crearMuestraAgua($txtSolicitante, $txt_tel_s, $txt_dir_s, $txt_fecha_toma, $txt_hora_toma, $txt_min_toma, $cmb_periodo_toma, $txt_epsa_s, $cmb_p_concretado, $txt_p_muestreo, $txt_dir_p_muestreo, $txt_fuente_p_muestreo, $cmb_epsa_acompanante, $cmb_tipo_analisis, $cmb_objeto_analisis, $txt_temp, $txt_color, $txt_clrl, $txt_ppm, $txt_aspecto, $txt_ph, $txt_otros_analisis, $cmb_muestra, $txt_otro_tipo_muestra, $txt_acomp_epsa, $txt_acomp_cargo, $txt_otro_tipo_analisis, $txt_otro_objeto_analisis, $id_usuario, $txt_codigo_p_muestreo, $cmb_tipo_muestra, $txt_observaciones_analisis, $txt_dir_epsa_s, $idMuestra, $rutaParaGuardar);

        /* Elimina el archivo subido */
        if ($rta == -1) {
            @unlink($ruta);
        }
        /* END */
        echo $rta;
        break;
}
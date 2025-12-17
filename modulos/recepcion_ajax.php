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
require_once("../principal/ContenidoHtml.php");
require_once("../db/DbMuestrasAguas.php");
require_once("../db/DbClasesMuestras.php");
require_once("../db/DbTiposMuestras.php");
require_once("../db/DbMuestras.php");

$contenido = new ContenidoHtml();
$utilidades = new Utilidades();
$combo = new Combo_Box();
$dbDepartamentos = new DbDepartamentos();
$dbMunicipios = new DbMunicipios();
$dbMuestrasAguas = new DbMuestrasAguas();
$dbMuestras = new DbMuestras();
$dbListas = new DbListas();
$dbDepartamentos = new DbDepartamentos();
$dbClasesMuestras = new DbClasesMuestras();
$dbTiposMuestras = new DbTiposMuestras();

$id_usuario = $_SESSION["idUsuario"];

if (isset($_POST["hdd_numero_menu"])) {
    $tipo_acceso_menu = $contenido->obtener_permisos_menu($_POST["hdd_numero_menu"]);
}

$opcion = $_POST["opcion"];
if ($opcion != "4" && $opcion != "6") {
    header('Content-Type: text/xml; charset=UTF-8');
}

switch ($opcion) {
    case "1": //Listado de Muetsra recepcionadas
        $buscar = urldecode($_POST["buscar"]);

        if ($buscar == 0) {
            $tabla_muestras = $dbMuestras->getMuestrasRecepcionadas();
        } else {
            $codigo = urldecode($_POST["codigo"]);
            $clase = urldecode($_POST["clase"]);
            $tipo = urldecode($_POST["tipo"]);
            $fecha = urldecode($_POST["fecha"]);
            $tabla_muestras = $dbMuestras->buscarMuestrasRecepcionadas($codigo, $clase, $tipo, $fecha);
        }
        ?>
        <br />
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h4 class="bg-warning">Seleccione una fila de la tabla <strong>"Recepciones"</strong> para ver el reporte</h4>
                </div>

                <div class="table-responsive">

                    <div id="paginador" class="centrar">
                        <nav>
                            <ul class="pagination">
                            </ul>
                        </nav>
                    </div>

                    <table class="table table-striped table-bordered table-hover paginated">
                        <thead>
                            <tr><th colspan='7'><h4><strong>Recepciones</strong></h4></th></tr>
                        <tr>
                            <th style="width:5%;"># radicado</th>
                            <th style="width:25%;">Clase</th>
                            <th style="width:25%;">Tipo</th>
                            <th style="width:25%;">Departamento</th>
                            <th style="width:20%;">Municipio</th>
                            <th style="width:24%;">Enviado por</th>
                            <th style="width:20%;">Fecha</th>
                        </tr>
                        </thead>
                        <?php
                        $cantidad_registro = count($tabla_muestras);
                        $i = 1;
                        if ($cantidad_registro > 0) {
                            foreach ($tabla_muestras as $fila_muestra) {

                                @$idMuestra = $fila_muestra['id_muestras'];
                                @$departamento = $fila_muestra['nom_dep'];
                                @$municipio = $fila_muestra['nom_mun'];
                                @$muestra_por = $fila_muestra['nombre_usuario_crea'];
                                @$fecha = $fila_muestra['fecha_recepcion_muestra'];
                                @$clase = $fila_muestra['nombre_clase_muestra'];
                                @$tipo = $fila_muestra['nombre_tipo_muestra'];
                                ?>
                                <tr style="cursor:pointer;" onclick="visualizaMuestra('<?php echo $idMuestra; ?>');">
                                    <td align="center"><h4><span class="label label-default medium-10"><?php echo $idMuestra; ?></span></h4></td>
                                    <td align="left"><?php echo $clase; ?></td>
                                    <td align="left"><?php echo $tipo; ?></td>
                                    <td align="left"><?php echo $departamento; ?></td>
                                    <td align="left"><?php echo $municipio; ?></td>
                                    <td align="left"><?php echo $muestra_por; ?></td>
                                    <td align="center"><h5><?php echo $fecha; ?></h5></td>
                                </tr>
                                <?php
                                $i = $i + 1;
                            }
                        } else {
                            ?>
                            <tr>
                                <td align="center" colspan="7">No se encontraron datos</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <script id='ajax'>
            //<![CDATA[ 
            $(function () {
                $('.paginated', 'table').each(function (i) {
                    $(this).text(i + 1);
                });

                $('table.paginated').each(function () {
                    var currentPage = 0;
                    var numPerPage = 10;
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

    case "2": //
        ?>
        <br />
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Recepcionar muestra</div>
                    <div class="panel-body">
                        <form id="frmRecepcionar">
                            <div class="panel panel-warning">
                                <div class="panel-heading">Clase y muestra</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Clase de muestra *</label>
                                            <?php
                                            $combo->getComboDb('cmb_clase', '', $dbClasesMuestras->getListaClasesMuestras(), 'id_clase_muestra, nombre_clase_muestra', '--Seleccione--', 'getTiposMuestrasFrmRecepcion();', '', '', '', 'form-control required');
                                            ?>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Muestra *</label>

                                            <select id="cmb_tipo" name="cmb_tipo" class="form-control required">
                                                <option value="">--Seleccione--</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </br>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="">Departamento *</label>
                                    <?php
                                    $combo->getComboDb('cmb_dep', '', $dbDepartamentos->getListaDepartamentosActivos(), 'cod_dep, nom_dep', '--Seleccione--', 'getMunicipiosFrmRecepcion();', '', '', '', 'form-control required');
                                    ?>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Municipio *</label>
                                    <select id="cmb_mun" name="cmb_mun" class="form-control required">
                                        <option value="">--Seleccione--</option>

                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Vereda</label>
                                    <input type="text" class="form-control" name="txt_vereda" id="txt_vereda" placeholder="Vereda" onblur="trim_cadena(this);
                                                    convertirAMayusculas(this);">
                                </div>
                            </div>


                            <div id="adicionalesForm">
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Observaciones</label>
                                    <textarea class="form-control" rows="4" id="txt_observaciones" onblur="trim_cadena(this);
                                                    convertirAMayusculas(this);"></textarea>
                                </div>
                            </div>
                            </br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="centrar">
                                        <button type="submit" class="btn btn-success" id="btn_editar" nombre="btn_editar" onclick="validaRecepcionar();">Crear Recepción</button>
                                    </div>                                    
                                </div>
                            </div>
                        </form>
                        <div id="resultadoRecepcion"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;

    case "3"://Combo Tipo de Muestra
        @$id_clase_muestra = $utilidades->limpiar_tags($_POST["id_clase_muestra"]);
        $tiposMuestras = $dbTiposMuestras->getListaTiposMuestras($id_clase_muestra);
        $combo->getComboDb('cmb_tipo', '', $tiposMuestras, 'id_tipo_muestra, nombre_tipo_muestra', '--Seleccione--', '', '', '', '', 'form-control required');
        break;

    case "4"://Imprime el combo de Municipios
        @$cod_dep = $utilidades->limpiar_tags($_POST["cod_dep"]);
        $municipios = $dbMunicipios->getListaMunicipiosDepartamento($cod_dep);
        $combo->getComboDb('cmb_mun', '', $municipios, 'cod_mun_dane, nom_mun', '--Seleccione--', '', '', '', '', 'form-control required');
        break;

    case "5"://Modal, Confirmacion recepcionar
        ?>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

    case "6"://crea la recepción y la muestra
        @$clase_muestra = $utilidades->limpiar_tags($_POST["clase_muestra"]);
        @$tipo_muestra = $utilidades->limpiar_tags($_POST["tipo_muestra"]);
        @$cmb_dep = $utilidades->limpiar_tags($_POST["cmb_dep"]);
        @$cmb_mun = $utilidades->limpiar_tags($_POST["cmb_mun"]);
        @$vereda = $utilidades->limpiar_tags($_POST["vereda"]);
        @$observaciones = $utilidades->limpiar_tags($_POST["observaciones"]);

        $muestra = $dbMuestras->crearRecepcion($clase_muestra, $tipo_muestra, $cmb_dep, $cmb_mun, $vereda, $observaciones);
        //$muestra = '';
        /* Guarda datoa adicionales dependiendo de la clase de muestra */
        switch ($clase_muestra) {
            case 1://Guarda los campos requeridos para muestra de tipo agua
                @$tipoMuestra = $utilidades->limpiar_tags($_POST["tipoMuestraAgua"]);
                @$fechaToma = $utilidades->limpiar_tags($_POST["fechaToma"]);
                @$hora_toma = $utilidades->limpiar_tags($_POST["txt_hora_toma"]);
                @$min_toma = $utilidades->limpiar_tags($_POST["txt_min_toma"]);
                @$periodo_toma = $utilidades->limpiar_tags($_POST["cmb_periodo_toma"]);

                $muestraAgua = $dbMuestrasAguas->crearMuestraAgua(NULL, NULL, NULL, $fechaToma, $hora_toma, $min_toma, $periodo_toma, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $id_usuario, NULL, $tipoMuestra, NULL, NULL, $muestra, NULL);
                $muestraAgua == -1 ? $muestra = -3 : '';
                break;
        }

        echo $muestra;
        break;


    case "7":
        @$idMuestra = $utilidades->limpiar_tags($_POST["idMuestra"]);
        $tabla_muestras = $dbMuestras->getMuestra($idMuestra);
        $tabla_estados = $dbMuestras->getEstadosMuestra($idMuestra);
        ?>
        <br />
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Recepción:</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Código de recepción:</label>
                                <mark><?php echo $tabla_muestras['id_muestras']; ?></mark>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Recepcionado por:</label>
                                <mark><?php echo $tabla_muestras['nombre_usuario_crea']; ?></mark>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Fecha de recepcionado:</label>
                                <mark><?php echo $tabla_muestras['fecha_recepcion_muestra']; ?></mark>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="">Clase de muestra:</label>
                                <mark><?php echo $tabla_muestras['nombre_clase_muestra']; ?></mark>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Tipo de muestra:</label>
                                <mark><?php echo $tabla_muestras['nombre_tipo_muestra']; ?></mark>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Departamento:</label>
                                <mark><?php echo $tabla_muestras['nom_dep']; ?></mark>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Municipio:</label>
                                <mark><?php echo $tabla_muestras['nom_mun']; ?></mark>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Vereda:</label>
                                <mark><?php echo $tabla_muestras['vereda_muestra']; ?></mark>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="">Observaciones:</label>
                                <mark><?php echo $tabla_muestras['observ_muestra']; ?></mark>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="">Estados registrados:</label>
                                <ol>
                                    <?php
                                    foreach ($tabla_estados as $fila_estados) {
                                        ?>
                                        <li><mark><?php echo $fila_estados['nombre_estado']; ?></mark><?php echo " (" . $fila_estados['format_fecha_muestra_estado'] . ")"; ?></li>
                                        <?php
                                    }
                                    ?>
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <div class="centrar">
                                    <button type="submit" class="btn btn-primary" id="btn_editar" nombre="btn_editar" onclick="listar_recepciones();">Regresar</button>
                                </div>                                    
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
        break;

    case "8":
        @$id_clase_muestra = $utilidades->limpiar_tags($_POST["id_clase_muestra"]);
        $tiposMuestras = $dbTiposMuestras->getListaTiposMuestras($id_clase_muestra);
        $combo->getComboDb('cmb_busca_tipo', '', $tiposMuestras, 'id_tipo_muestra, nombre_tipo_muestra', '--Seleccione--', '', '', '', '', 'form-control');
        break;

    case "9"://Adicionales Muestras de agua 
        ?>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="">Tipo de muestra</label>
                <?php
                $combo->getComboDb('cmb_tipo_muestra_agua', '', $dbListas->getListaDetalles(8), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control required');
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="">Fecha de toma</label>
                <input type="text" class="form-control" name="txt_fecha_toma" id="txt_fecha_toma" placeholder="Fecha de toma" onkeyup="DateFormat(this, this.value, event, false, '3');" onfocus="vDateType = '3';" onBlur="DateFormat(this, this.value, event, true, '3');" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="">Hora de toma</label>
                <div class="row">
                    <div class="col-md-4 ">
                        <input type="number" class="form-control" name="txt_hora_toma" id="txt_hora_toma" placeholder="Hora" maxlength="2" size="2" required>
                    </div>
                    <div class="col-md-4 ">
                        <input type="number" class="form-control" name="txt_min_toma" id="txt_min_toma" placeholder="Minutos" maxlength="2" size="2" required>
                    </div>
                    <div class="col-md-4">
                        <select id="cmb_periodo_toma" name="cmb_periodo_toma" class="form-control required">
                            <option value="">Seleccione</option>
                            <option value="1">A.M.</option>
                            <option value="0">P.M.</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;
}


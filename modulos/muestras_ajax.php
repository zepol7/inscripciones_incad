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
    case "1":
        $buscar = urldecode($_POST["buscar"]);

        if ($buscar == 0) {
            $tabla_muestras = $dbMuestras->getMuestrasFormMuestras();
        } else {
            $codigo = urldecode($_POST["codigo"]);
            $clase = urldecode($_POST["clase"]);
            $tipo = urldecode($_POST["tipo"]);
            $fecha = urldecode($_POST["fecha"]);
            $tabla_muestras = $dbMuestras->buscarMuestrasFormMuestras($codigo, $clase, $tipo, $fecha);
        }
        ?>
        <br />
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h4 class="help-block">Seleccione una fila de la tabla <strong>"Muestras"</strong> para crear el acta de la muestra</h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="help-block">Mapa de colores:</p>
                        <div class="col-md-2">
                            <div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        <p>Recepción con Acta</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <tr><th colspan='7'><h4><strong>Muestras</strong></h4></th></tr>
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
                                $color = "";
                                $classCodigo = "";
                                if ($fila_muestra['ind_actual_muestra_estado'] == 0) {//Asigna el color de fondo para la fila
                                    $color = 'background:#5CB85C;color:#FFF;';
                                } else {
                                    $classCodigo = "label-default";
                                }
                                ?>
                                <tr style="cursor:pointer;<?php echo $color; ?>" onclick="crearMuestra('<?php echo $idMuestra; ?>');" >
                                    <td align="center"><h4><span class="label medium-10 <?php echo $classCodigo; ?>"><?php echo $idMuestra; ?></span></h4></td>
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

    case "2":
        @$idMuestra = $utilidades->limpiar_tags($_POST["idMuestra"]);

        $tipoMuestra = $dbMuestras->getMuestra($idMuestra);

        switch ($tipoMuestra['id_tipo_muestra']) {
            case 1://Tipo Muestra de agua
                $tabla_muestras = $dbMuestrasAguas->getMuestra($idMuestra);
                $tabla_estados = $dbMuestras->getEstadosMuestra($idMuestra);
                break;
        }

        $crearMuestra = 0;
        $estadoActual = false;
        ?>
        <br />
        <input type="hidden" id="hddIdMuestra" value="<?php echo $tabla_muestras['id_muestras']; ?>">
        <input type="hidden" id="hddIdTipoMuestra" value="<?php echo $tabla_muestras['id_tipo_muestra']; ?>">
        <div class="row visibleNone" id="divBarraProgreso">
            <div class="col-md-12">
                <p>Enviando, por favor espere...</p>
                <div class="progress">
                    <div id="barraProgreso" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    </div>
                </div>
            </div>
        </div>
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
                        <div class="panel panel-primary">
                            <div class="panel-heading">Estados registrados:</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <ol>
                                            <?php
                                            foreach ($tabla_estados as $fila_estados) {
                                                if ($fila_estados['id_estado'] == 4 && $fila_estados['ind_actual_muestra_estado'] == 1) {//Verifica si es necesarioc rear la muestra
                                                    $crearMuestra = 1;
                                                }
                                                if ($fila_estados['ind_actual_muestra_estado'] == 1) {//Verifica el estado Actual
                                                    $estadoActual = true;
                                                }
                                                ?>
                                                <li><?php echo $fila_estados['nombre_estado']; ?><?php echo " (" . $fila_estados['format_fecha_muestra_estado'] . ")" . ($estadoActual ? ' - <span class="label label-success">Actual</span>' : ''); ?></li>
                                                <?php
                                                $estadoActual = false;
                                            }
                                            ?>
                                        </ol>
                                        <input type="hidden" id="hddcrearMuestra" value="<?php echo $crearMuestra; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($crearMuestra < 1) {
                            ?>
                            <div class="row">
                                <div class="col-md-6 form-group centrar">
                                    <div class="form-group">
                                        <a href="#" onclick="imprimir_reporte_muestraAgua()">
                                            <span class="glyphicon glyphicon-print" aria-hidden="true" style="font-size: 50px;"></span>
                                        </a>
                                    </div>
                                    <div class="form-group">
                                        <span class="">Ver acta digital</span>
                                    </div>
                                </div>
                                <?php
                                if (strlen($tabla_muestras['acta_muestra_agua']) > 1) {//Verifica si existe archivo adjunto
                                    ?>
                                    <div class="col-md-6 form-group centrar">
                                        <div class="form-group">
                                            <a href="../<?php echo $tabla_muestras['acta_muestra_agua']; ?>" target="_blank">
                                                <span class="glyphicon glyphicon-cloud-download" aria-hidden="true" style="font-size: 50px;"></span>
                                            </a>
                                        </div>
                                        <div class="form-group">
                                            <span class="">Ver acta física</span>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="divFrmMuestra"></div>
            </div>
        </div>
        <?php
        break;
}
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
require_once("../db/DbLaboratorios.php");
require_once("../db/DbParasitos.php");
require_once("../db/DbBacterias.php");
require_once("../db/DbUsuariosLaboratorios.php");
require_once("../db/DbParasitismoIntestinal.php");
require_once("../funciones/Button.php");


$dbUsuarios = new DbUsuarios();
$dbListas = new DbListas();
$dbPefiles = new DbPerfiles();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
$dbDepartamentos = new DbDepartamentos();
$dbMunicipios = new DbMunicipios();
$combo = new Combo_Box();
$dbMuestrasAguas = new DbMuestrasAguas();
$dbLaboratorios = new DbLaboratorios();
$dbParasitos = new DbParasitos();
$dbBacterias = new DbBacterias();
$dbUsuariosLaboratorios = new DbUsuariosLaboratorios();
$dbParasitismoIntestinal = new DbParasitismoIntestinal();
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
    case "1": //CMB Municipios
        @$cod_dep = $utilidades->limpiar_tags($_POST["cod_dep"]);
        $municipios = $dbMunicipios->getListaMunicipiosDepartamento($cod_dep);
        $combo->getComboDb('cod_dep', '', $municipios, 'cod_mun_dane, nom_mun', '--Seleccione--', '', '', 'width:350px;', '', 'form-control required');

        break;
    case "2": //Modal Agregar otro parásito
        ?>
        <!-- Modal -->
        <div class="modal fade" id="modalAgregarOtroParasito" tabindex="-1" role="dialog" aria-labelledby="modalSeleccionarLaboratorio">
            <?php
            @$titulo = $_POST["titulo"];
            //@$funcion = $_POST["funcion"];
            ?>
            <form id="frmOtroParasito">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Agregar otro parásito</h4>
                        </div>
                        <div class="modal-body">

                            <div class="panel panel-success">
                                <div class="panel-heading">Datos requeridos</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="">Nombre del parásito</label>
                                            <input type="text" class="form-control" name="txt_otro_nombre_para" id="txt_otro_nombre_para" placeholder="Nombre del parásito" value="" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="">Mujeres</label>
                                            <div class="row">
                                                <div class="col-md-2 form-group">
                                                    <label for="">0-5</label>
                                                    <input type="number" class="form-control" name="txt_otro_m_1" id="txt_otro_m_1" placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="">6-15</label>
                                                    <input type="number" class="form-control" name="txt_otro_m_2" id="txt_otro_m_2" placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="">16-20</label>
                                                    <input type="number" class="form-control" name="txt_otro_m_3" id="txt_otro_m_3" placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="">21-60</label>
                                                    <input type="number" class="form-control" name="txt_otro_m_4" id="txt_otro_m_4" placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="">>60</label>
                                                    <input type="number" class="form-control" name="txt_otro_m_5" id="txt_otro_m_5" placeholder="" value="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="">Hombres</label>
                                            <div class="row">
                                                <div class="col-md-2 form-group">
                                                    <label for="">0-5</label>
                                                    <input type="number" class="form-control" name="txt_otro_h_1" id="txt_otro_h_1" placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="">6-15</label>
                                                    <input type="number" class="form-control" name="txt_otro_h_2" id="txt_otro_h_2" placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="">16-20</label>
                                                    <input type="number" class="form-control" name="txt_otro_h_3" id="txt_otro_h_3" placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="">21-60</label>
                                                    <input type="number" class="form-control" name="txt_otro_h_4" id="txt_otro_h_4" placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="">>60</label>
                                                    <input type="number" class="form-control" name="txt_otro_h_5" id="txt_otro_h_5" placeholder="" value="" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary"  onclick="agregarOtroParasito();">Agregar</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <?php
        break;

    case "3": //ventana modal de confirmación
        ?>
        <!-- Modal -->
        <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

    case "4"://FICHA DE CAPTURA DE INFORMACIÓN DE PARASITISMO INTESTINAL

        $tablaLaboratorios = $dbUsuariosLaboratorios->getListalaboratoriosActivosUsuario($id_usuario);
        $codLab = "";
        $nivelLab = "";
        ?>

        <div class="row visibleNone" id="divBarraProgreso">
            <div class="col-md-12">
                <p>Enviando, por favor espere...</p>
                <div class="progress">
                    <div id="barraProgreso" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    </div>
                </div>
            </div>
        </div>

        <form id="frmParasitismoIntestinal">
            <div class="panel panel-primary">
                <div class="panel-heading">INFORMACIÓN DEL LABORATORIO</div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="centrar">
                                <h5>Usted se encuentra asociado con <span class="label label-default"><?php echo count($tablaLaboratorios); ?></span> laboratorio(s)</h5>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (count($tablaLaboratorios) > 0) {
                        if (count($tablaLaboratorios) > 1) {
                            ?>

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="">Seleccione el laboratorio*</label>
                                    <?php
                                    $combo->getComboDb('cmb_lab', '', $tablaLaboratorios, 'cod_lab, nombre_lab', '--Seleccione--', 'infoLab()', '', '', '', 'form-control required');
                                    ?>
                                </div>
                            </div>
                            <?php
                        } else {
                            $codLab = $tablaLaboratorios[0]['cod_lab'];
                            $nivelLab = $tablaLaboratorios[0]['nivel_lab'];
                            ?>
                            <div id="infoLab">
                                <input type="hidden" id="hddCodLab" value="<?php echo $codLab; ?>" />
                                <input type="hidden" id="hddNivLab" value="<?php echo $nivelLab; ?>" />
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">Nivel:</label>
                                    </div>
                                    <div class="col-md-10">
                                        <h5><span class="label label-success"><?php echo $tablaLaboratorios[0]['nivel_lab']; ?></span></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">Número de distintivo:</label>
                                    </div>
                                    <div class="col-md-10">
                                        <h5><?php echo $tablaLaboratorios[0]['num_distintivo_lab']; ?></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">N.I.T.:</label>
                                    </div>
                                    <div class="col-md-10">
                                        <h5><?php echo $tablaLaboratorios[0]['nit_lab']; ?></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">Nombre:</label>
                                    </div>
                                    <div class="col-md-10">
                                        <h5><?php echo $tablaLaboratorios[0]['nombre_lab']; ?></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">Dirección:</label>
                                    </div>
                                    <div class="col-md-10">
                                        <h5><?php echo $tablaLaboratorios[0]['dir_lab']; ?></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">Departamento:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><?php echo $tablaLaboratorios[0]['nom_dep']; ?></h5>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Municipio:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><?php echo $tablaLaboratorios[0]['nom_mun']; ?></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">Teléfonos:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><?php echo $tablaLaboratorios[0]['tel1_lab'] . " " . $tablaLaboratorios[0]['tel2_lab']; ?></h5>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">@Email:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><?php echo $tablaLaboratorios[0]['email_lab']; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div id="infoLab">
                        <input type="hidden" id="hddCodLab" value="<?php echo $codLab; ?>" />
                        <input type="hidden" id="hddNivLab" value="<?php echo $nivelLab; ?>" />
                    </div>


                </div>
            </div>


            <div id="divFicha">
            </div>

        </form>
        <?php
        break;

    case "5":
        @$codLab = $utilidades->limpiar_tags($_POST["codLab"]);
        $tablaLaboratorio = $dbUsuariosLaboratorios->getLaboratorioActivo($codLab);
        $codLab = $tablaLaboratorio['cod_lab'];
        $nivelLab = $tablaLaboratorio['nivel_lab'];
        ?>
        <input type="hidden" id="hddCodLab" value="<?php echo $codLab; ?>" />
        <input type="hidden" id="hddNivLab" value="<?php echo $nivelLab; ?>" />
        <div class="row">
            <div class="col-md-2">
                <label for="">Nivel:</label>
            </div>
            <div class="col-md-10">
                <h5><span class="label label-success"><?php echo $tablaLaboratorio['nivel_lab']; ?></span></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="">Número de distintivo:</label>
            </div>
            <div class="col-md-10">
                <h5><?php echo $tablaLaboratorio['num_distintivo_lab']; ?></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="">N.I.T.:</label>
            </div>
            <div class="col-md-10">
                <h5><?php echo $tablaLaboratorio['nit_lab']; ?></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="">Nombre:</label>
            </div>
            <div class="col-md-10">
                <h5><?php echo $tablaLaboratorio['nombre_lab']; ?></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="">Dirección:</label>
            </div>
            <div class="col-md-10">
                <h5><?php echo $tablaLaboratorio['dir_lab']; ?></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="">Departamento:</label>
            </div>
            <div class="col-md-3">
                <h5><?php echo $tablaLaboratorio['nom_dep']; ?></h5>
            </div>
            <div class="col-md-2">
                <label for="">Municipio:</label>
            </div>
            <div class="col-md-3">
                <h5><?php echo $tablaLaboratorio['nom_mun']; ?></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="">Teléfonos:</label>
            </div>
            <div class="col-md-3">
                <h5><?php echo $tablaLaboratorio['tel1_lab'] . " " . $tablaLaboratorio['tel2_lab']; ?></h5>
            </div>
            <div class="col-md-2">
                <label for="">@Email:</label>
            </div>
            <div class="col-md-3">
                <h5><?php echo $tablaLaboratorio['email_lab']; ?></h5>
            </div>
        </div>
        <?php
        break;

    case "6"://Modal Agregar otra bacteria
        ?>
        <!-- Modal -->
        <div class="modal fade" id="modalAgregarOtraBacteria" tabindex="-1" role="dialog" aria-labelledby="modalSeleccionarLaboratorio">
            <?php
            @$titulo = $utilidades->limpiar_tags($_POST["titulo"]);
            //@$funcion = $_POST["funcion"];
            ?>
            <form id="frmOtraBacteria">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Agregar otras bacterias</h4>
                        </div>
                        <div class="modal-body">

                            <div class="panel panel-success">
                                <div class="panel-heading">Datos requeridos</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="">Nombre de la bacteria</label>
                                            <input type="text" class="form-control" name="txt_otro_b_nombre_para" id="txt_otro_b_nombre_para" placeholder="Nombre de la bacteria" value="" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="">Coprocultivo</label>
                                            <div class="row">
                                                <div class="col-md-2 form-group">
                                                    <label for="">0-5</label>
                                                    <input type="number" class="form-control" name="txt_otro_b_m_1" id="txt_otro_b_m_1" placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="">6-15</label>
                                                    <input type="number" class="form-control" name="txt_otro_b_m_2" id="txt_otro_b_m_2" placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="">16-20</label>
                                                    <input type="number" class="form-control" name="txt_otro_b_m_3" id="txt_otro_b_m_3" placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="">21-60</label>
                                                    <input type="number" class="form-control" name="txt_otro_b_m_4" id="txt_otro_b_m_4" placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="">>60</label>
                                                    <input type="number" class="form-control" name="txt_otro_b_m_5" id="txt_otro_b_m_5" placeholder="" value="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="">Aislamiento</label>
                                            <div class="row">
                                                <div class="col-md-2 form-group">
                                                    <label for="">0-5</label>
                                                    <input type="number" class="form-control" name="txt_otro_b_h_1" id="txt_otro_b_h_1" placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="">6-15</label>
                                                    <input type="number" class="form-control" name="txt_otro_b_h_2" id="txt_otro_b_h_2" placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="">16-20</label>
                                                    <input type="number" class="form-control" name="txt_otro_b_h_3" id="txt_otro_b_h_3" placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="">21-60</label>
                                                    <input type="number" class="form-control" name="txt_otro_b_h_4" id="txt_otro_b_h_4" placeholder="" value="" required>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label for="">>60</label>
                                                    <input type="number" class="form-control" name="txt_otro_b_h_5" id="txt_otro_b_h_5" placeholder="" value="" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"  onclick="agregarOtraBacteria();">Agregar</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <?php
        break;

    case "7":
        $nivelLab = $utilidades->limpiar_tags($_POST["nivelLab"]);
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">FICHA DE CAPTURA DE INFORMACIÓN DE PARASITISMO INTESTINAL</div>
                    <div class="panel-body">

                        <div class="panel panel-primary">
                            <div class="panel-heading">IDENTIFICACIÓN GENERAL</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="">Mes de notificación *</label>
                                        <?php
                                        $combo->getComboDb('cmb_mes_n', '', $dbListas->getListaDetalles(22), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control required');
                                        ?>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Año de notificación *</label>
                                        <?php
                                        $combo->getComboDb('cmb_year_n', '', $dbListas->getListaDetalles(23), 'id_detalle, nombre_detalle', '--Seleccione--', '', '', '', '', 'form-control required');
                                        ?>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">PROCEDENCIA</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12 form-group">
                                                        <label for="">Municipio *</label>
                                                        <?php
                                                        $municipios = $dbMunicipios->getListaMunicipiosDepartamento(68);
                                                        $combo->getComboDb('cmb_mun_p', '', $municipios, 'cod_mun_dane, nom_mun', '--Seleccione--', '', '', '', '', 'form-control required');
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-primary">
                            <div class="panel-heading">PARÁSITOS</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="">Número de muestras analizadas</label>
                                        <input type="number" class="form-control" name="txt_par_muestras_analizadas" id="txt_par_muestras_analizadas" placeholder="" required>                    
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Número de muestras positivas analizadas</label>
                                        <input type="number" class="form-control" name="txt_par_muestras_positivas_analizadas" id="txt_par_muestras_positivas_analizadas" placeholder="" required>                                   
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover paginated" id="tblParasitos">
                                                <thead>
                                                    <tr>
                                                        <th style="width:5%;"></th>
                                                        <th style="width:25%;" class="centrar">Mujeres</th>
                                                        <th style="width:25%;" class="centrar">Hombres</th>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:5%;"></th>
                                                        <th style="width:25%;" class="centrar">Grupos de edad</th>
                                                        <th style="width:25%;" class="centrar">Grupos de edad</th>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:5%;"></th>
                                                        <th style="width:25%;">
                                                <div class="row">
                                                    <div class="col-md-2 centrar">0-5</div>
                                                    <div class="col-md-2 centrar">6-15</div>
                                                    <div class="col-md-2 centrar">16-20</div>
                                                    <div class="col-md-2 centrar">21-60</div>
                                                    <div class="col-md-2 centrar">>60</div>
                                                </div>
                                                </th>
                                                <th style="width:25%;">
                                                <div class="row">
                                                    <div class="col-md-2 centrar">0-5</div>
                                                    <div class="col-md-2 centrar">6-15</div>
                                                    <div class="col-md-2 centrar">16-20</div>
                                                    <div class="col-md-2 centrar">21-60</div>
                                                    <div class="col-md-2 centrar">>60</div>
                                                </div>
                                                </th>
                                                </tr>
                                                </thead>
                                                <?php
                                                $tablaParasitos = $dbParasitos->getListaParasitos();
                                                $idParasitoOtro = 0;
                                                $cantidad_registro = count($tablaParasitos);

                                                if ($cantidad_registro > 0) {
                                                    foreach ($tablaParasitos as $fila_parasito) {

                                                        @$codPar = $fila_parasito['cod_par'];
                                                        @$nomPar = $fila_parasito['nom_par'];
                                                        @$indOtro = $fila_parasito['ind_otro'];

                                                        if ($indOtro == 1) {
                                                            $idParasitoOtro = $codPar;
                                                        } else {
                                                            ?>

                                                            <tr style="cursor:pointer;" id="<?php echo $codPar; ?>">
                                                                <td align="left"><?php echo $nomPar; ?></td>
                                                                <td align="left">
                                                                    <div class="row">
                                                                        <div class="col-md-2 nopadding"><input id="<?php echo $codPar; ?>_m_1" type="number" class="form-control centrar" name="txt_vereda" id="txt_vereda" placeholder=""></div>
                                                                        <div class="col-md-2 nopadding"><input id="<?php echo $codPar; ?>_m_2" type="number" class="form-control centrar" name="txt_vereda" id="txt_vereda" placeholder=""></div>
                                                                        <div class="col-md-2 nopadding"><input id="<?php echo $codPar; ?>_m_3" type="number" class="form-control centrar" name="txt_vereda" id="txt_vereda" placeholder=""></div>
                                                                        <div class="col-md-2 nopadding"><input id="<?php echo $codPar; ?>_m_4" type="number" class="form-control centrar" name="txt_vereda" id="txt_vereda" placeholder=""></div>
                                                                        <div class="col-md-2 nopadding"><input id="<?php echo $codPar; ?>_m_5" type="number" class="form-control centrar" name="txt_vereda" id="txt_vereda" placeholder=""></div>
                                                                    </div>
                                                                </td>
                                                                <td align="left">
                                                                    <div class="row">
                                                                        <div class="col-md-2 nopadding"><input id="<?php echo $codPar; ?>_h_1" type="number" class="form-control centrar" name="txt_vereda" id="txt_vereda" placeholder=""></div>
                                                                        <div class="col-md-2 nopadding"><input id="<?php echo $codPar; ?>_h_2" type="number" class="form-control centrar" name="txt_vereda" id="txt_vereda" placeholder=""></div>
                                                                        <div class="col-md-2 nopadding"><input id="<?php echo $codPar; ?>_h_3" type="number" class="form-control centrar" name="txt_vereda" id="txt_vereda" placeholder=""></div>
                                                                        <div class="col-md-2 nopadding"><input id="<?php echo $codPar; ?>_h_4" type="number" class="form-control centrar" name="txt_vereda" id="txt_vereda" placeholder=""></div>
                                                                        <div class="col-md-2 nopadding"><input id="<?php echo $codPar; ?>_h_5" type="number" class="form-control centrar" name="txt_vereda" id="txt_vereda" placeholder=""></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </table>
                                        </div>
                                        <br/>
                                        <div class="panel panel-primary hidden" id="divOtrosParasitos">
                                            <div class="panel-heading">OTROS PARÁSITOS</div>
                                            <div class="panel-body">

                                                <table class="table table-striped table-hover paginated" id="tblOtrosParasitos">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:5%;"></th>
                                                            <th style="width:25%;" class="centrar">Mujeres</th>
                                                            <th style="width:25%;" class="centrar">Hombres</th>
                                                            <th style="width:5%;"></th>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:5%;"></th>
                                                            <th style="width:25%;" class="centrar">Grupos de edad</th>
                                                            <th style="width:25%;" class="centrar">Grupos de edad</th>
                                                            <th style="width:5%;"></th>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:5%;"></th>
                                                            <th style="width:25%;">
                                                    <div class="row">
                                                        <div class="col-md-2 centrar">0-5</div>
                                                        <div class="col-md-2 centrar">6-15</div>
                                                        <div class="col-md-2 centrar">16-20</div>
                                                        <div class="col-md-2 centrar">21-60</div>
                                                        <div class="col-md-2 centrar">>60</div>
                                                    </div>
                                                    </th>
                                                    <th style="width:25%;">
                                                    <div class="row">
                                                        <div class="col-md-2 centrar">0-5</div>
                                                        <div class="col-md-2 centrar">6-15</div>
                                                        <div class="col-md-2 centrar">16-20</div>
                                                        <div class="col-md-2 centrar">21-60</div>
                                                        <div class="col-md-2 centrar">>60</div>
                                                    </div>
                                                    </th>
                                                    <th style="width:5%;"></th>
                                                    </tr>

                                                    </thead>

                                                </table>

                                            </div>
                                        </div>
                                        <?php
                                        $button->getButton(2, "¿Agregar Otro parásito?", "button", "", "btn btn-warning", "agregarOtrosParasitos();");
                                        ?>
                                        <input type="hidden" id="hddParasitosOtro" value="<?php echo $idParasitoOtro; ?>" />
                                    </div>
                                </div>

                            </div>
                        </div>

                        <?php
                        if ($nivelLab == 3) {//Si el laboratorio es nivel 3
                            ?>
                            <div class="panel panel-primary">
                                <div class="panel-heading">COPROCULTIVO</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Total coprocultivo</label>
                                            <input type="number" class="form-control" name="txt_copro_total" id="txt_copro_total" placeholder="" required> 
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Coprocultivos positivos </label>
                                            <input type="number" class="form-control" name="txt_copro_positivo" id="txt_copro_positivo" placeholder="" required> 
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-primary">
                                <div class="panel-heading">BACTERIAS</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover paginated" id="tblBacterias">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:5%;"></th>
                                                            <th style="width:25%;" class="centrar">Coprocultivo</th>
                                                            <th style="width:25%;" class="centrar">Aislamiento</th>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:5%;"></th>
                                                            <th style="width:25%;" class="centrar">Grupos de edad</th>
                                                            <th style="width:25%;" class="centrar">Grupos de edad</th>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:5%;"></th>
                                                            <th style="width:25%;">
                                                    <div class="row">
                                                        <div class="col-md-2 centrar">0-5</div>
                                                        <div class="col-md-2 centrar">6-15</div>
                                                        <div class="col-md-2 centrar">16-20</div>
                                                        <div class="col-md-2 centrar">21-60</div>
                                                        <div class="col-md-2 centrar">>60</div>
                                                    </div>
                                                    </th>
                                                    <th style="width:25%;">
                                                    <div class="row">
                                                        <div class="col-md-2 centrar">0-5</div>
                                                        <div class="col-md-2 centrar">6-15</div>
                                                        <div class="col-md-2 centrar">16-20</div>
                                                        <div class="col-md-2 centrar">21-60</div>
                                                        <div class="col-md-2 centrar">>60</div>
                                                    </div>
                                                    </th>
                                                    </tr>
                                                    </thead>
                                                    <?php
                                                    $tablaBacterias = $dbBacterias->getListabacteriasActivas();
                                                    $idBacteriaOtro = 0;
                                                    $cantidad_registro = count($tablaBacterias);

                                                    if ($cantidad_registro > 0) {
                                                        foreach ($tablaBacterias as $fila_bacteria) {

                                                            @$codBact = $fila_bacteria['cod_bact'];
                                                            @$nomBact = $fila_bacteria['nom_bact'];
                                                            @$indOtro = $fila_bacteria['ind_otro'];

                                                            if ($indOtro == 1) {
                                                                $idBacteriaOtro = $codBact;
                                                            } else {
                                                                ?>

                                                                <tr style="cursor:pointer;" id="<?php echo $codBact; ?>">
                                                                    <td align="left"><?php echo $nomBact; ?></td>
                                                                    <td align="left">
                                                                        <div class="row">
                                                                            <div class="col-md-2 nopadding"><input id="<?php echo $codBact; ?>_b_m_1" type="number" class="form-control centrar" name="txt_vereda" placeholder=""></div>
                                                                            <div class="col-md-2 nopadding"><input id="<?php echo $codBact; ?>_b_m_2" type="number" class="form-control centrar" name="txt_vereda" placeholder=""></div>
                                                                            <div class="col-md-2 nopadding"><input id="<?php echo $codBact; ?>_b_m_3" type="number" class="form-control centrar" name="txt_vereda" placeholder=""></div>
                                                                            <div class="col-md-2 nopadding"><input id="<?php echo $codBact; ?>_b_m_4" type="number" class="form-control centrar" name="txt_vereda" placeholder=""></div>
                                                                            <div class="col-md-2 nopadding"><input id="<?php echo $codBact; ?>_b_m_5" type="number" class="form-control centrar" name="txt_vereda" placeholder=""></div>
                                                                        </div>
                                                                    </td>
                                                                    <td align="left">
                                                                        <div class="row">
                                                                            <div class="col-md-2 nopadding"><input id="<?php echo $codBact; ?>_b_h_1" type="number" class="form-control centrar" name="txt_vereda" placeholder=""></div>
                                                                            <div class="col-md-2 nopadding"><input id="<?php echo $codBact; ?>_b_h_2" type="number" class="form-control centrar" name="txt_vereda" placeholder=""></div>
                                                                            <div class="col-md-2 nopadding"><input id="<?php echo $codBact; ?>_b_h_3" type="number" class="form-control centrar" name="txt_vereda" placeholder=""></div>
                                                                            <div class="col-md-2 nopadding"><input id="<?php echo $codBact; ?>_b_h_4" type="number" class="form-control centrar" name="txt_vereda" placeholder=""></div>
                                                                            <div class="col-md-2 nopadding"><input id="<?php echo $codBact; ?>_b_h_5" type="number" class="form-control centrar" name="txt_vereda" placeholder=""></div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                            <br/>
                                            <div class="panel panel-primary hidden" id="divOtrasBacterias">
                                                <div class="panel-heading">OTRAS BACTERIAS</div>
                                                <div class="panel-body">

                                                    <table class="table table-striped table-hover paginated" id="tblOtrasBacterias">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:5%;"></th>
                                                                <th style="width:25%;" class="centrar">Coprocultivo</th>
                                                                <th style="width:25%;" class="centrar">Aislamiento</th>
                                                                <th style="width:5%;"></th>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:5%;"></th>
                                                                <th style="width:25%;" class="centrar">Grupos de edad</th>
                                                                <th style="width:25%;" class="centrar">Grupos de edad</th>
                                                                <th style="width:5%;"></th>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:5%;"></th>
                                                                <th style="width:25%;">
                                                        <div class="row">
                                                            <div class="col-md-2 centrar">0-5</div>
                                                            <div class="col-md-2 centrar">6-15</div>
                                                            <div class="col-md-2 centrar">16-20</div>
                                                            <div class="col-md-2 centrar">21-60</div>
                                                            <div class="col-md-2 centrar">>60</div>
                                                        </div>
                                                        </th>
                                                        <th style="width:25%;">
                                                        <div class="row">
                                                            <div class="col-md-2 centrar">0-5</div>
                                                            <div class="col-md-2 centrar">6-15</div>
                                                            <div class="col-md-2 centrar">16-20</div>
                                                            <div class="col-md-2 centrar">21-60</div>
                                                            <div class="col-md-2 centrar">>60</div>
                                                        </div>
                                                        </th>
                                                        <th style="width:5%;"></th>
                                                        </tr>

                                                        </thead>

                                                    </table>

                                                </div>
                                            </div>
                                            <?php
                                            $button->getButton(2, "¿Agregar Otra bacteria?", "button", "btn_buscar_usuario", "btn btn-warning", "agregarOtrasBacterias();");
                                            ?>

                                            <input type="hidden" id="hddBacteriasOtro" value="<?php echo $idBacteriaOtro; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="centrar">
                                    <?php
                                    $button->getButton(2, "Enviar resultados", "submit", "btn_buscar_usuario", "btn btn-success", "validaEnviarResultado();");
                                    ?>
                                    <input type="hidden" id="hddResultado" name="hddResultado" />
                                </div>                                    
                            </div>
                        </div>

                    </div>
                </div>
            </div>    	
        </div>

        <?php
        break;


    case "8"://Guarda parasitismo intestinal
        @$mesN = $utilidades->limpiar_tags($_POST["mesN"]);
        @$yearN = $utilidades->limpiar_tags($_POST["yearN"]);
        @$munP = $utilidades->limpiar_tags($_POST["munP"]);
        @$parasitosTotal = $utilidades->limpiar_tags($_POST["parasitosTotal"]);
        @$parasitosPositivos = $utilidades->limpiar_tags($_POST["parasitosPositivos"]);
        @$coproTotal = $utilidades->limpiar_tags($_POST["coproTotal"]);
        @$coproPositivo = $utilidades->limpiar_tags($_POST["coproPositivo"]);
        @$codLab = $utilidades->limpiar_tags($_POST["codLab"]);

        @$totalParasitos = $utilidades->limpiar_tags($_POST["totalParasitos"]);
        @$totalOtrosParasitos = $utilidades->limpiar_tags($_POST["totalOtrosParasitos"]);
        @$totalBacterias = $utilidades->limpiar_tags($_POST["totalBacterias"]);
        @$totalOtrasBacterias = $utilidades->limpiar_tags($_POST["totalOtrasBacterias"]);

        $parasitos = "";
        $otrosParasitos = "";
        $bacterias = "";
        $otrasBacterias = "";

        /* Arma parametros para parásitos */
        for ($i = 1; $i <= $totalParasitos; $i++) {
            $parasitos .= $utilidades->limpiar_tags($_POST["parasito" . $i]) . ($i < $totalParasitos ? "*" : ""); //Agrega el separador *
        }

        /* Arma parametros para OTROS parásitos */
        if ($totalOtrosParasitos > 0) {
            for ($i = 1; $i <= $totalOtrosParasitos; $i++) {
                $otrosParasitos .= $utilidades->limpiar_tags($_POST["parasitoOtro" . $i]) . ($i < $totalOtrosParasitos ? "*" : ""); //Agrega el separador *
            }
        }

        /* Arma parametros para Bacterias */
        for ($i = 1; $i <= $totalBacterias; $i++) {
            $bacterias .= $utilidades->limpiar_tags($_POST["bacteria" . $i]) . ($i < $totalBacterias ? "*" : ""); //Agrega el separador *
        }

        /* Arma parametros para OTRAS bacterias */
        if ($totalOtrasBacterias > 0) {
            for ($i = 1; $i <= $totalOtrasBacterias; $i++) {
                $otrasBacterias .= $utilidades->limpiar_tags($_POST["bacteriaOtro" . $i]) . ($i < $totalOtrasBacterias ? "*" : ""); //Agrega el separador *
            }
        }

        $rta = $dbParasitismoIntestinal->crearParasitismoIntestinal($parasitos, $totalParasitos, $otrosParasitos, $totalOtrosParasitos, $bacterias, $totalBacterias, $otrasBacterias, $totalOtrasBacterias, $mesN, $yearN, $munP, $codLab, $parasitosTotal, $parasitosPositivos, $coproTotal, $coproPositivo, $id_usuario);
        echo $rta;
        /* END Arma parametros para parásitos */
        break;

    case "9"://Listado de envios
        $tabla_muestras = $dbParasitismoIntestinal->getListaPorUsuario($id_usuario);
        $cantidad_registro = count($tabla_muestras);
        ?>
        <br />
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h4 class="bg-warning">Seleccione una fila de la tabla <strong>"Resultados parasitismo intestinal"</strong> para ver el reporte</h4>
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
                            <tr><th colspan='7'><h4><strong>Resultados parasitismo intestinal (<?php echo $cantidad_registro; ?>)</strong></h4></th></tr>
                        <tr>
                            <th style="width:5%;"># de envio</th>
                            <th style="width:25%;">Departamento Notifica</th>

                            <th style="width:25%;">Municipio Procedencia</th>
                            <th style="width:20%;">Laboratorio</th>
                            <th style="width:20%;">Año notificación</th>
                            <th style="width:20%;">Mes notificación</th>
                        </tr>
                        </thead>
                        <?php
                        $i = 1;
                        if ($cantidad_registro > 0) {
                            foreach ($tabla_muestras as $fila_muestra) {

                                @$cod_p_i = $fila_muestra['cod_p_i'];
                                @$dep_notifica = $fila_muestra['dep_notifica'];
                                //@$municipio_notifica = $fila_muestra['municipio_notifica'];
                                @$municipio_procedencia = $fila_muestra['municipio_procedencia'];
                                @$nombre_lab = $fila_muestra['nombre_lab'];
                                @$year_notifica = $fila_muestra['year_notifica'];
                                @$mes_notifica = $fila_muestra['mes_notifica'];
                                ?>
                                <tr style="cursor:pointer;" onclick="imprimir_reporte_envios('<?php echo $cod_p_i; ?>');">
                                    <td align="center"><h4><span class="label label-default medium-10"><?php echo $cod_p_i; ?></span></h4></td>
                                    <td align="left"><?php echo $dep_notifica; ?></td>
                                    <td align="left"><?php echo $municipio_procedencia; ?></td>
                                    <td align="left"><?php echo $nombre_lab; ?></td>
                                    <td align="left"><?php echo $year_notifica; ?></td>
                                    <td align="left"><?php echo $mes_notifica; ?></td>
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
        break;
}
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

$dbUsuarios = new DbUsuarios();
$dbListas = new DbListas();
$dbPefiles = new DbPerfiles();
$utilidades = new Utilidades();
$contenido = new ContenidoHtml();
$dbDepartamentos = new DbDepartamentos();
$dbMunicipios = new DbMunicipios();
$combo = new Combo_Box();
$dbMuestrasAguas = new DbMuestrasAguas();


$id_usuario = $_SESSION["idUsuario"];


if (isset($_POST["hdd_numero_menu"])) {
    $tipo_acceso_menu = $contenido->obtener_permisos_menu($_POST["hdd_numero_menu"]);
}

$opcion = $_POST["opcion"];
if ($opcion != "4" && $opcion != "6") {
    header('Content-Type: text/xml; charset=UTF-8');
}






switch ($opcion) {
    case "1": //Cargar combo de municipios
        @$cod_dep = $utilidades->limpiar_tags($_POST["cod_dep"]);
        $municipios = $dbMunicipios->getListaMunicipiosDepartamento($cod_dep);
        $combo->getComboDb('cod_dep', '', $municipios, 'cod_mun_dane, nom_mun', '--Seleccione--', '', '', 'width:350px;', '', '');

    break;
    case "2": //Crear acta de muestra de agua

        
    break;
}
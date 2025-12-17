<?php
// Habilitar el manejo de CORS si se requiere
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");


define('API_KEY', '0afba991fa5b6f12dc2f6bc82f9b0874487733e80ba739c91e922848f6725dee');

// Obtener la API Key de los headers de la solicitud
$headers = apache_request_headers();
$apiKey = isset($headers['Authorization']) ? $headers['Authorization'] : '';

if ($apiKey !== API_KEY) {
    // Si la API Key no es válida, enviar una respuesta de error
    http_response_code(403); // Forbidden
    echo json_encode(array("mensaje" => "Acceso denegado: API Key no válida."));
    exit;
}


//echo bin2hex(random_bytes(32));

require_once("../db/DbRegistroPersonas.php");
require_once("../db/DbListas.php");

$dbRegistroPersonas = new DbRegistroPersonas();
$dbListas = new DbListas();

// Obtener los datos JSON recibidos en la solicitud POST
$data = json_decode(file_get_contents("php://input"), true);

// Función para validar que todos los campos necesarios estén presentes
function validarEstructura($data) {
    $requiredFields = ['datos_personales', 'personas_de_contacto', 'informacion_academica'];
    foreach ($requiredFields as $field) {
        if (!isset($data[$field])) {
            return false;
        }
    }
    return true;
}

// Validar la estructura JSON
if (!validarEstructura($data)) {
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "La estructura del JSON es incorrecta o incompleta."]);
    exit;
}

// Datos de "datos_personales"

if($data['datos_personales']['nombres']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -nombres- es obligatorio."]);
    exit;    
}
if($data['datos_personales']['apellidos']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -apellidos- es obligatorio."]);
    exit;    
}
if($data['datos_personales']['tipo_de_documento']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -tipo_de_documento- es obligatorio."]);
    exit;    
}
if($data['datos_personales']['numero_de_documento']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -numero_de_documento- es obligatorio."]);
    exit;    
}
if($data['datos_personales']['fecha_de_expedicion']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -fecha_de_expedicion- es obligatorio."]);
    exit;    
}
if($data['datos_personales']['lugar_de_expedicion']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -lugar_de_expedicion- es obligatorio."]);
    exit;    
}
if($data['datos_personales']['fecha_de_nacimiento']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -fecha_de_nacimiento- es obligatorio."]);
    exit;    
}
if($data['datos_personales']['lugar_de_nacimiento']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -lugar_de_nacimiento- es obligatorio."]);
    exit;    
}
if($data['datos_personales']['sexo']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -sexo- es obligatorio."]);
    exit;    
}
if($data['datos_personales']['estado_civil']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -estado_civil- es obligatorio."]);
    exit;    
}
if($data['datos_personales']['estrato']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -estrato- es obligatorio."]);
    exit;    
}
if($data['datos_personales']['direccion_residencia']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -direccion_residencia- es obligatorio."]);
    exit;    
}
if($data['datos_personales']['telefono_1']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -telefono_1- es obligatorio."]);
    exit;    
}
if($data['datos_personales']['correo_electronico']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -correo_electronico- es obligatorio."]);
    exit;    
}





$nombres = $data['datos_personales']['nombres'];
$apellidos = $data['datos_personales']['apellidos'];
$tipo_documento = $data['datos_personales']['tipo_de_documento'];




$tabla_tipo_documento = $dbListas->getListaTipoDocumentoNombre($tipo_documento);
if($tabla_tipo_documento){
    //echo "existe";
    $id_tipo_documento = $tabla_tipo_documento[0]['id_detalle'];
}
else{
    //echo "no existe";
    $id_tipo_documento = 0;
    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "No se encuentra el nombre del Tipo de Documento."]);
    exit;
}

$numero_documento = $data['datos_personales']['numero_de_documento'];
$tabla_existe_persona = $dbRegistroPersonas->getExistePersona($numero_documento);
$val_existe_persona = $tabla_existe_persona['cantidad'];
if($val_existe_persona > 0){    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "Este documento ya existe en el sistema"]);
    exit;    
}

$fecha_expedicion = $data['datos_personales']['fecha_de_expedicion'];
$date_fecha_expedicion = DateTime::createFromFormat('d/m/Y g:iA', $fecha_expedicion);
$fecha_expedicion_val = $date_fecha_expedicion->format('d/m/Y');


$lugar_expedicion = $data['datos_personales']['lugar_de_expedicion'];

$fecha_nacimiento = $data['datos_personales']['fecha_de_nacimiento'];
$date_fecha_nacimiento = DateTime::createFromFormat('d/m/Y g:iA', $fecha_nacimiento);
$fecha_nacimiento_val = $date_fecha_nacimiento->format('d/m/Y');


$lugar_nacimiento = $data['datos_personales']['lugar_de_nacimiento'];
$edad = $data['datos_personales']['edad'];

$sexo = $data['datos_personales']['sexo'];
$tabla_sexo = $dbListas->getListaSexoNombre($sexo);
if($tabla_sexo){
    //echo "existe";
    $id_sexo = $tabla_sexo[0]['id_detalle'];
}
else{
    //echo "no existe";
    $id_sexo = 0;
    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "No se encuentra el nombre del Tipo sexo."]);
    exit;
}



$tipo_sangre = $data['datos_personales']['tipo_de_sangre'];
$tabla_tipo_sangre = $dbListas->getListaTipoSangreNombre($tipo_sangre);
if($tabla_tipo_sangre){
    //echo "existe";
    $id_tipo_sangre = $tabla_tipo_sangre[0]['id_detalle'];
}
else{
    //echo "no existe";
    $id_tipo_sangre = 0;
    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "No se encuentra el nombre del Tipo de Sangre."]);
    exit;
}


$estado_civil = $data['datos_personales']['estado_civil'];
$tabla_estao_civil = $dbListas->getListaEstadoCivilNombre($estado_civil);
if($tabla_estao_civil){
    //echo "existe";
    $id_estado_civil = $tabla_estao_civil[0]['id_detalle'];
}
else{
    //echo "no existe";
    $id_estado_civil = 0;
    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "No se encuentra el nombre del Estado Civil."]);
    exit;
}



$direccion_residencia = $data['datos_personales']['direccion_residencia'];
$estrato = $data['datos_personales']['estrato'];
$tabla_estrato = $dbListas->getListaEstratoNombre($estrato);
if($tabla_estrato){
    //echo "existe";
    $id_estrato = $tabla_estrato[0]['id_detalle'];
}
else{
    //echo "no existe";
    $id_estrato = 0;
    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "No se encuentra el nombre del Estrato."]);
    exit;
}



$barrio_residencia = $data['datos_personales']['barrio_de_residencia'];
$telefono_1 = $data['datos_personales']['telefono_1'];
$telefono_2 = $data['datos_personales']['telefono_2'];
$ciudad_residencia = $data['datos_personales']['ciudad_de_residencia'];
$correo_electronico = $data['datos_personales']['correo_electronico'];
$eps = $data['datos_personales']['eps'];

// Datos de "personas_de_contacto"
$nombre_1 = $data['personas_de_contacto']['nombre_1'];
$nombre_2 = $data['personas_de_contacto']['nombre_2'];
$nombre_3 = $data['personas_de_contacto']['nombre_3'];
$telefono_contacto_1 = $data['personas_de_contacto']['telefono_contacto_1'];
$telefono_contacto_2 = $data['personas_de_contacto']['telefono_contacto_2'];
$telefono_contacto_3 = $data['personas_de_contacto']['telefono_contacto_3'];
$parentesco_1 = $data['personas_de_contacto']['parentesco_1'];
$parentesco_2 = $data['personas_de_contacto']['parentesco_2'];
$parentesco_3 = $data['personas_de_contacto']['parentesco_3'];

// Datos de "informacion_academica"

if($data['informacion_academica']['tipo_de_inscripcion']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -tipo_de_inscripcion- es obligatorio."]);
    exit;    
}
if($data['informacion_academica']['fecha_de_inscripcion']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -fecha_de_inscripcion- es obligatorio."]);
    exit;    
}
if($data['informacion_academica']['ultimo_estudio_aprobado']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -ultimo_estudio_aprobado- es obligatorio."]);
    exit;    
}
if($data['informacion_academica']['programa_academico_incad']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -programa_academico_incad- es obligatorio."]);
    exit;    
}
if($data['informacion_academica']['jornada']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -jornada- es obligatorio."]);
    exit;    
}
if($data['informacion_academica']['calendario_academico']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -calendario_academico- es obligatorio."]);
    exit;    
}
if($data['informacion_academica']['unidad_de_negocio']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -unidad_de_negocio- es obligatorio."]);
    exit;    
}
/*
if($data['informacion_academica']['valor_del_programa']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -valor_del_programa- es obligatorio."]);
    exit;    
}
if($data['informacion_academica']['descuento']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -descuento- es obligatorio."]);
    exit;    
}
if($data['informacion_academica']['valor_neto_a_pagar']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -valor_neto_a_pagar- es obligatorio."]);
    exit;    
} 
 
if($data['informacion_academica']['formas_de_pago']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -formas_de_pago- es obligatorio."]);
    exit;    
}
if($data['informacion_academica']['entidad_financiera']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -entidad_financiera- es obligatorio."]);
    exit;    
}
if($data['informacion_academica']['cuota_inicial']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -cuota_inicial- es obligatorio."]);
    exit;    
}
if($data['informacion_academica']['fecha_mensual_de_pago']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -fecha_mensual_de_pago- es obligatorio."]);
    exit;    
}
if($data['informacion_academica']['valor_a_financiar']==""){
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "El dato -valor_a_financiar- es obligatorio."]);
    exit;    
} 
 */









$tipo_inscripcion = $data['informacion_academica']['tipo_de_inscripcion'];

$tabla_tipo_inscripcion = $dbListas->getListaTipoInscripcion($tipo_inscripcion);
if($tabla_tipo_inscripcion){
    //echo "existe";
    $id_tipo_inscripcion = $tabla_tipo_inscripcion[0]['id_detalle'];
}
else{
    //echo "no existe";
    $id_tipo_inscripcion = 0;
    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "No se encuentra el nombre del Tipo de Inscripcion."]);
    exit;
}


$fecha_inscripcion = $data['informacion_academica']['fecha_de_inscripcion'];
$date_fecha_inscripcion = DateTime::createFromFormat('d/m/Y g:iA', $fecha_inscripcion);
$fecha_inscripcion_val = $date_fecha_inscripcion->format('d/m/Y');

$ultimo_estudio_aprobado = $data['informacion_academica']['ultimo_estudio_aprobado'];

$tabla_estudio_aprobado = $dbListas->getListaUltimoEstudio($ultimo_estudio_aprobado);
if($tabla_estudio_aprobado){
    //echo "existe";
    $ultimo_estudio_aprobado = $tabla_estudio_aprobado[0]['id_listas_editable_detalle'];
}
else{
    //echo "no existe";
    $ultimo_estudio_aprobado = 0;
    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "No se encuentra el nombre del Ultimo Programa."]);
    exit;
}





$institucion = $data['informacion_academica']['institucion'];

$programa_academico_incad = $data['informacion_academica']['programa_academico_incad'];
$tabla_programa = $dbListas->getListaTodosProgramasNombre($programa_academico_incad);
if($tabla_programa){
    //echo "existe";
    $id_programa = $tabla_programa[0]['id_listas_editable_detalle'];
}
else{
    //echo "no existe";
    $id_programa = 0;
    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "No se encuentra el nombre del Programam Academico."]);
    exit;
}

$jornada = $data['informacion_academica']['jornada'];
$tabla_jornada = $dbListas->getListaJornadasNombre($jornada);

if($tabla_jornada){
    //echo "existe";
    $id_jornada = $tabla_jornada[0]['id_listas_editable_detalle'];
}
else{
    //echo "no existe";
    $id_jornada = 0;
    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "No se encuentra el nombre de la Jornada Academico."]);
    exit;
}



$calendario_academico = $data['informacion_academica']['calendario_academico'];
$tabla_calendario_academico = $dbListas->getListaCalendarioNombre($calendario_academico);
if($tabla_calendario_academico){
    //echo "existe";
    $id_calendario_academico = $tabla_calendario_academico[0]['id_listas_editable_detalle'];
}
else{
    //echo "no existe";
    $id_calendario_academico = 0;
    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "No se encuentra el nombre de Calendario Academico."]);
    exit;
}



$unidad_negocio = $data['informacion_academica']['unidad_de_negocio'];
$tabla_unidad_negocio = $dbListas->getListaUnidadNegocioNombre($unidad_negocio);
if($tabla_unidad_negocio){
    //echo "existe";
    $id_unidad_negocio = $tabla_unidad_negocio[0]['id_listas_editable_detalle'];
}
else{
    //echo "no existe";
    $id_unidad_negocio = 0;
    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "No se encuentra el nombre de la Unidad de Negocio."]);
    exit;
}


$ha_estudiado_antes_programa_tecnico = $data['informacion_academica']['ha_estudiado_antes_un_programa_tecnico'];
$tabla_estudiado_antes = $dbListas->getListaSiNo($ha_estudiado_antes_programa_tecnico);
if($tabla_estudiado_antes){
    //echo "existe";
    $ha_estudiado_antes_programa_tecnico = $tabla_estudiado_antes[0]['id_detalle'];
}
else{
    //echo "no existe";
    $ha_estudiado_antes_programa_tecnico = 0;
    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "No se encuentra el ha_estudiado_antes_programa_tecnico."]);
    exit;
}



$realizo_practica_laboral_contrato_aprendizaje = $data['informacion_academica']['realizo_practica_laboral_con_contrato_de_aprendizaje'];
$tabla_realizo_practica_laboral = $dbListas->getListaSiNo($realizo_practica_laboral_contrato_aprendizaje);
if($tabla_realizo_practica_laboral){
    //echo "existe";
    $realizo_practica_laboral_contrato_aprendizaje = $tabla_realizo_practica_laboral[0]['id_detalle'];
}
else{
    //echo "no existe";
    $realizo_practica_laboral_contrato_aprendizaje = 0;    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "No se encuentra el realizo_practica_laboral_contrato_aprendizaje."]);
    exit;
}



$valor_programa = $data['informacion_academica']['valor_del_programa'];
$descuento = $data['informacion_academica']['descuento'];
$valor_neto_pagar = $data['informacion_academica']['valor_neto_a_pagar'];

$formas_pago = $data['informacion_academica']['formas_de_pago'];
$tabla_formas_pago = $dbListas->getListaFormasPagoNombre($formas_pago);

if($tabla_formas_pago){
    //echo "existe";
    $id_forma_pago = $tabla_formas_pago[0]['id_listas_editable_detalle'];
}
else{
    //echo "no existe";
    $id_forma_pago = 0;
    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "No se encuentra el nombre de la Forma de Pago."]);
    exit;
}



$entidad_financiera = $data['informacion_academica']['entidad_financiera'];
$tabla_entidad_financiera = $dbListas->getListaEntidadFinanciera($entidad_financiera);
if($tabla_entidad_financiera){
    //echo "existe";
    $id_entidad_financiera = $tabla_entidad_financiera[0]['id_listas_editable_detalle'];
}
else{
    //echo "no existe";
    $id_entidad_financiera = 0;
    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "No se encuentra el nombre de la id_entidad_financiera."]);
    exit;
}




$cuota_inicial = $data['informacion_academica']['cuota_inicial'];
$valor_financiar = $data['informacion_academica']['valor_a_financiar'];
$numeros_cuotas = $data['informacion_academica']['numeros_de_cuotas'];

$periodicidad_pago = $data['informacion_academica']['periodicidad_de_pago'];

$tabla_periodicidad_pago = $dbListas->getListaPeriodicidadPagoNombre($periodicidad_pago);
if($tabla_periodicidad_pago){
    //echo "existe";
    $id_periodicidad_pago = $tabla_periodicidad_pago[0]['id_detalle'];
}
else{
    //echo "no existe";
    $id_periodicidad_pago = 0;
    
    http_response_code(400); // Bad request
    echo json_encode(["mensaje" => "No se encuentra el nombre de la Periodicidad de Pago."]);
    exit;
}



$valor_cuotas = $data['informacion_academica']['valor_cuotas'];
$fecha_mensual_pago = $data['informacion_academica']['fecha_mensual_de_pago'];
$date_fecha_mensual_pago = DateTime::createFromFormat('d/m/Y', $fecha_mensual_pago);
$fecha_mensual_pago_val = $date_fecha_mensual_pago->format('d/m/Y');

$como_se_entero_incad = $data['informacion_academica']['como_se_entero_de_incad'];
$referido_por = $data['informacion_academica']['referido_por'];


$array_conoce_incad = '';
$programa_tecnico = 0;
$practica_laboral = 0;
$id_promotor = 0;
$estado_matriculado = 0;
$id_usuario_crea = 20;

try {
   $resultado = $dbRegistroPersonas->InsertRegistroPersona($id_tipo_documento, $numero_documento, $lugar_expedicion, $fecha_expedicion_val, $nombres, $apellidos, $fecha_nacimiento_val, $lugar_nacimiento, $id_tipo_sangre, $telefono_1, $telefono_2, $correo_electronico, $id_estado_civil, $direccion_residencia, $barrio_residencia, $ciudad_residencia, $nombre_1, $telefono_contacto_1, $parentesco_1, $nombre_2, $telefono_contacto_2, $parentesco_2, $nombre_3, $telefono_contacto_3, $parentesco_3, $nombre_1, $telefono_contacto_1, $parentesco_1, $eps, $id_tipo_inscripcion, $fecha_inscripcion_val, $ultimo_estudio_aprobado, $institucion, $id_programa, $jornada, $valor_programa, $descuento, $valor_neto_pagar, $id_forma_pago, $id_entidad_financiera, $cuota_inicial, $valor_financiar, $numeros_cuotas, $valor_cuotas, $fecha_mensual_pago_val, $array_conoce_incad, $referido_por, $id_estrato, $ha_estudiado_antes_programa_tecnico, $realizo_practica_laboral_contrato_aprendizaje, $id_sexo, $id_unidad_negocio, $id_calendario_academico, $id_jornada, $id_programa, $id_periodicidad_pago, $id_promotor, $estado_matriculado, $id_usuario_crea);
   #$resultado = 0;
} catch (Exception $e) {
    // Captura la excepción y muestra un mensaje de error
    $resultado = 0;
    echo "Error al insertar el registro: " . $e->getMessage();
}




//$resultado = $dbRegistroPersonas->InsertRegistroPersona($tipo_documento, $documento_persona, $lugar_documento, $fecha_documento, $nombre_persona, $apellido_persona, $fecha_nacimiento, $lugar_nacimiento, $tipo_sangre, $tel_casa_persona, $tel_movil_persona, $email_persona, $estado_civil, $direccion_casa, $barrio_residencia, $ciudad_residencia, $nombre_contacto_1, $telefono_contacto_1, $parentesco_contacto_1, $nombre_contacto_2, $telefono_contacto_2, $parentesco_contacto_2, $nombre_contacto_3, $telefono_contacto_3, $parentesco_contacto_3, $nombre_acudiente, $telefono_acudiente, $parentesco_acudiente, $eps, $tipo_inscripcion, $fecha_inscripcion, $id_ultimo_estudio, $institucion_estudio, $programa_incad, $jornada_incad, $valor_programa, $descuento, $valor_neto_pagar, $id_forma_pago, $id_entidad_financiera, $cuota_inicial, $valor_financiar, $num_cuotas, $valor_cuota, $fecha_mensula_pago, $array_conoce_incad, $referido_por, $estrato_persona, $programa_tecnico, $practica_laboral, $sexo, $unidad_negocio, $calendario_academico, $jornada, $id_programa, $periodicidad_pago, $id_promotor, $estado_matriculado, $id_usuario_crea);

// Continúa extrayendo los demás datos de "datos_personales", "personas_de_contacto" e "informacion_academica".


if($resultado>0){
    http_response_code(200); // OK
    echo json_encode(["mensaje" => "Datos guardados correctamente: ". $resultado]);
}
else{
    http_response_code(500); // Internal server error
    echo json_encode(["mensaje" => "Error al guardar los datos: " ]);
}


?>

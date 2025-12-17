
function form_buscar_estudiantes(){
    
    var titulo = 'Buscar Estudiante';
    
    //alert(11);
    
    var params = 'opcion=5&titulo=' + titulo;
    llamarAjax("seguimiento_estudiantes_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
    
}


function form_buscar_empresas(){
    
    var titulo = 'Buscar Empresas';
    
    //alert(11);
    
    var params = 'opcion=6&titulo=' + titulo;
    llamarAjax("seguimiento_estudiantes_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
    
}


function form_enviar_hv(){
    
    var id_empresa = $("#id_empresa").val(); 
    var id_academica = $("#id_academica").val(); 
    
    var nombre_estudiante = $("#nombre_estudiante").val(); 
    var nombre_empresa = $("#nombre_empresa").val(); 
    
    var result = 0;
    var msg_input='';
    
    $("#nombre_estudiante").removeClass("borde_error");    
    $("#nombre_empresa").removeClass("borde_error");    
    
    
    if ($('#id_empresa').val() == 0) { $("#nombre_empresa").addClass("borde_error"); result = 1; }    
    if ($('#id_academica').val() == 0) { $("#nombre_estudiante").addClass("borde_error"); result = 1; }
    
    if (result == 0) {	                        
        
        var params = "opcion=9&id_empresa=" + id_empresa + 
                     "&id_academica=" + id_academica + 
                     "&nombre_empresa=" + nombre_empresa +
                     "&nombre_estudiante=" + nombre_estudiante;
        llamarAjax("seguimiento_estudiantes_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
            
            
    } else if (result == 1) {
        
        $("#contenedor_error").addClass("contenedor_error_visible");
        $('#contenedor_error').html('Debe Seleccionar Empresa y Estudiante Para enviar HV' + msg_input);            
        setTimeout(
        function () {
            $('#contenedor_error').slideUp(200).removeClass("contenedor_error_visible");
        }, 5000);
        return false;
    } 
    
    
    
}


function enviar_hv_empresa(id_academica, id_empresa){
    
    $("#btn_enviar_hv_empresa").css("display", "none");
    var params = "opcion=10&id_empresa=" + id_empresa + 
                 "&id_academica=" + id_academica
    llamarAjax("seguimiento_estudiantes_ajax.php", params, "div_enviar_hv_empresa", "exito_enviar_hv_empresa("+id_academica+", "+id_empresa+");");
    //llamarAjax("seguimiento_estudiantes_ajax.php", params, "div_enviar_hv_empresa", "");
}


function exito_enviar_hv_empresa(id_academica, id_empresa) {
    
	var hdd_resul_enviar_hv = parseInt($("#hdd_resul_enviar_hv").val(), 10);
	
	$("#contenedor_error_hv_empresa").css("display", "none");
	$("#contenedor_exito_hv_empresa").css("display", "none");
	//alert(hdd_resul_validacion);        
	if (hdd_resul_enviar_hv > 0) {		
                $("#contenedor_exito_hv_empresa").addClass("contenedor_exito_visible");
                $('#contenedor_exito_hv_empresa').html('Datos Enviados con &eacute;xito');                
		setTimeout(
                function() {
                    $('#contenedor_exito_hv_empresa').slideUp(200).removeClass("contenedor_exito_visible");
                    $("#contenedor_exito_hv_empresa").css("display", "none");
                    
                    $("#btn_enviar_hv_empresa").css("display", "block");                    
                    cargar_relacion_estudiante_empresa(id_academica, id_empresa);
                },
		3000);
	} 
}


function reset_estudiantes(){
    
    $("#id_academica").val(0);
    $("#id_persona").val(0);
    $("#nombre_estudiante").val("");    
    var id_academica = $("#id_academica").val(); 
    var id_empresa = $("#id_empresa").val(); 
    
    $("#div_detalle_estudiante").css("display", "none");
    cargar_relacion_estudiante_empresa(id_academica, id_empresa);
}


function reset_empresas(){
    
    $("#id_empresa").val(0);    
    $("#nombre_empresa").val("");    
    var id_academica = $("#id_academica").val(); 
    var id_empresa = $("#id_empresa").val(); 
    
    $("#div_detalle_empresa").css("display", "none");
    cargar_relacion_estudiante_empresa(id_academica, id_empresa);
}



function validar_buscar_nombre_documento(){
    
    var result = 0;
    var msg_input='';    
    $("#nombre_documento").removeClass("borde_error");    
    if ($('#nombre_documento').val() == '') { $("#nombre_documento").addClass("borde_error"); result = 1; }
    
    if (result == 0) {	                        
        var nombre_documento = $("#nombre_documento").val();        
        var params = "opcion=1&nombre_documento=" + nombre_documento;
        llamarAjax("seguimiento_estudiantes_ajax.php", params, "div_lista_estudiantes", "");            
    } else if (result == 1) {        
        $("#contenedor_error_estudiante").addClass("contenedor_error_visible");
        $('#contenedor_error_estudiante').html('Debe Ingresar Nombre o Documento para buscar ' + msg_input);            
        setTimeout(
        function () {
            $('#contenedor_error_estudiante').slideUp(200).removeClass("contenedor_error_visible");
        }, 2000);
        return false;
    }
    
}


function validar_buscar_nombre_empresa(){
    
    
    var result = 0;
    var msg_input='';
    
    $("#nombre_nit_empresa").removeClass("borde_error");    
    if ($('#nombre_nit_empresa').val() == '') { $("#nombre_nit_empresa").addClass("borde_error"); result = 1; }
    
    
    if (result == 0) {	            
            
        var nombre_nit_empresa = $("#nombre_nit_empresa").val();        
        var params = "opcion=7&nombre_nit_empresa=" + nombre_nit_empresa;
        llamarAjax("seguimiento_estudiantes_ajax.php", params, "div_lista_empresas", "");
            
            
    } else if (result == 1) {
        
        $("#contenedor_error_estudiante").addClass("contenedor_error_visible");
        $('#contenedor_error_estudiante').html('Debe Ingresar Nombre de la empresa para buscar ' + msg_input);            
        setTimeout(
        function () {
            $('#contenedor_error_estudiante').slideUp(200).removeClass("contenedor_error_visible");
        }, 2000);
        return false;
    } 
    
    
}


function cargar_estudiante(id_academica, id_persona, nombre_completo){
    
    //alert(id_academica);
    
    $("#div_detalle_estudiante").css("display", "block");
    $("#nombre_estudiante").val(nombre_completo);
    
    var id_empresa = $("#id_empresa").val();     
    
    var params = "opcion=2&id_academica=" + id_academica + 
                 "&id_persona=" + id_persona;
    llamarAjax("seguimiento_estudiantes_ajax.php", params, "div_detalle_estudiante", "cargar_relacion_estudiante_empresa("+id_academica+", "+id_empresa+")");
    
    
}



function cargar_empresa(id_empresa, nombre_empresa){
    
    $("#div_detalle_empresa").css("display", "block");
    $("#nombre_empresa").val(nombre_empresa);    
    
    var id_academica = $("#id_academica").val(); 
    
    var params = "opcion=8&id_empresa=" + id_empresa;    
    llamarAjax("seguimiento_estudiantes_ajax.php", params, "div_detalle_empresa", "cargar_relacion_estudiante_empresa("+id_academica+", "+id_empresa+")");
    
    
}


function cargar_relacion_estudiante_empresa(id_academica, id_empresa){
    
    //alert(id_academica+" -- "+id_empresa);
    cerrarModalConfirmacion();
    $("#div_persona_empresa").css("display", "block");
    var params = "opcion=4&id_academica=" + id_academica + 
                 "&id_empresa=" + id_empresa;
    llamarAjax("seguimiento_estudiantes_ajax.php", params, "div_persona_empresa", "");
    
}





function modalConfirmarGuardar(titulo, funcion) {
    var params = 'opcion=3&titulo=' + titulo + '&funcion=' + funcion;
    llamarAjax("certifica_seguimiento_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}

function mostrarModalConfirmacion() {
    $('#modalConfirmacion').modal();
    
}

function cerrarModalConfirmacion() {
    $('#modalConfirmacion').modal('hide');
}



function descargar_base(especialidad_cita){
    setTimeout(function(){ 
        document.getElementById("form_xls_base").submit(); 
    }, 3000);	
}




function form_segumiento(id_empresa, id_academica, id_estudiante_empresa, nombre_empresa, nombre_estudiante, tipo){
    
    var titulo = 'Seguimiento Empresa - Estudiante';
    
    var params = 'opcion=11&titulo=' + titulo +
                 '&id_empresa=' + id_empresa +
                 '&id_academica=' + id_academica +
                 '&id_estudiante_empresa=' + id_estudiante_empresa +
                 '&nombre_empresa=' + nombre_empresa +
                 '&nombre_estudiante=' + nombre_estudiante +
                 '&tipo=' + tipo;
    llamarAjax("seguimiento_estudiantes_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
    
}


function enviar_segumiento_empresas_estudiante(id_empresa, id_academica, id_estudiante_empresa){
    
    var result = 0;
    var msg_input='';
    
    $("#observaciones_seguimiento").removeClass("borde_error");    
    if ($('#observaciones_seguimiento').val() == '') { $("#observaciones_seguimiento").addClass("borde_error"); result = 1; }
    
    
    if (result == 0) {	            
            
        var observaciones_seguimiento = $("#observaciones_seguimiento").val();     
        var params = "opcion=12&id_empresa=" + id_empresa + 
                     "&id_academica=" + id_academica +
                     "&id_estudiante_empresa=" + id_estudiante_empresa +
                     "&observaciones_seguimiento=" + str_encode(observaciones_seguimiento);
        llamarAjax("seguimiento_estudiantes_ajax.php", params, "div_enviar_seguimiento", "exito_enviar_segumiento();");
            
            
    } else if (result == 1) {
        
        $("#contenedor_error_segumiento").addClass("contenedor_error_visible");
        $('#contenedor_error_segumiento').html('Debe Ingresar el texto del Seguimiento ' + msg_input);            
        setTimeout(
        function () {
            $('#contenedor_error_segumiento').slideUp(200).removeClass("contenedor_error_visible");
        }, 1000);
        return false;
    } 
    
    
    
}


function exito_enviar_segumiento(){
    
        var hdd_resul_seguimiento = parseInt($("#hdd_resul_seguimiento").val(), 10);
	
	$("#contenedor_error_segumiento").css("display", "none");
	$("#contenedor_exito_segumiento").css("display", "none");
	//alert(hdd_resul_validacion);        
	if (hdd_resul_seguimiento > 0) {		
                $("#contenedor_exito_segumiento").addClass("contenedor_exito_visible");
                $('#contenedor_exito_segumiento').html('Datos Enviados con &eacute;xito');                
		setTimeout(
                function() {
                    $('#contenedor_exito_segumiento').slideUp(200).removeClass("contenedor_exito_visible");
                    $("#contenedor_exito_segumiento").css("display", "none");
                    cerrarModalConfirmacion();
                },
		1000);
	} 
    
}



function form_vincular(id_empresa, id_academica, id_estudiante_empresa, nombre_empresa, nombre_estudiante){
    
    var titulo = 'Vincular Empresa - Estudiante';
    
    var params = 'opcion=13&titulo=' + titulo +
                 '&id_empresa=' + id_empresa +
                 '&id_academica=' + id_academica +
                 '&id_estudiante_empresa=' + id_estudiante_empresa +
                 '&nombre_empresa=' + nombre_empresa +
                 '&nombre_estudiante=' + nombre_estudiante;
    llamarAjax("seguimiento_estudiantes_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
    
}


function vincular_empresas_estudiante(id_empresa, id_academica, id_estudiante_empresa){
    var result = 0;
    var msg_input='';
    
    $("#fecha_ini_contrato").removeClass("borde_error");    
    if ($('#fecha_ini_contrato').val() == '') { $("#fecha_ini_contrato").addClass("borde_error"); result = 1; }
    
    var fecha_ini_contrato = $("#fecha_ini_contrato").val(); 
    var fecha_fin_contrato = $("#fecha_fin_contrato").val(); 
    
    
    if (result == 0) {	            
            
        var params = "opcion=14&id_empresa=" + id_empresa + 
                "&id_academica=" + id_academica +
                "&id_estudiante_empresa=" + id_estudiante_empresa + 
                "&fecha_ini_contrato=" + fecha_ini_contrato + 
                "&fecha_fin_contrato=" + fecha_fin_contrato;
        llamarAjax("seguimiento_estudiantes_ajax.php", params, "div_vincular_empresa", "exito_vincular_empresa_estudiante();");
    
            
    } else if (result == 1) {
        
        $("#contenedor_error_segumiento").addClass("contenedor_error_visible");
        $('#contenedor_error_segumiento').html('Debe Ingresar La fecha de Incio de Vinculaci&oacute;n ' + msg_input);            
        setTimeout(
        function () {
            $('#contenedor_error_segumiento').slideUp(200).removeClass("contenedor_error_visible");
        }, 3000);
        return false;
    } 
    
    
}

function exito_vincular_empresa_estudiante(){
    
        var hdd_resul_vincular_seguimiento = parseInt($("#hdd_resul_vincular_seguimiento").val(), 10);
        
        var id_academica = $("#id_academica").val(); 
        var id_empresa = $("#id_empresa").val(); 
	
	$("#contenedor_error_segumiento").css("display", "none");
	$("#contenedor_exito_segumiento").css("display", "none");
	//alert(hdd_resul_validacion);        
	if (hdd_resul_vincular_seguimiento > 0) {		
                $("#contenedor_exito_segumiento").addClass("contenedor_exito_visible");
                $('#contenedor_exito_segumiento').html('Datos Enviados con &eacute;xito');                
		setTimeout(
                function() {
                    $('#contenedor_exito_segumiento').slideUp(200).removeClass("contenedor_exito_visible");
                    $("#contenedor_exito_segumiento").css("display", "none");
                    cerrarModalConfirmacion();
                    cargar_relacion_estudiante_empresa(id_academica, id_empresa);
                },
		1000);
	}
        else{
            $("#contenedor_error_segumiento").addClass("contenedor_error_visible");
            $('#contenedor_error_segumiento').html('No se guardo los datos');
        }
    
}


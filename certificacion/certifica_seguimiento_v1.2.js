
function cambiar_visible_hv(tipo){
    
    if(tipo == 1){ //Subir Archivos
        $("#input_subir_hv").css("display", "block");
        $("#link_ver_hv").css("display", "none");
        $("#link_mod_hv").css("display", "block");        
        $("#hdd_val_archivo").val(1);
    }  
    if(tipo == 2){ //No Subir Archivos
        $("#input_subir_hv").css("display", "none");
        $("#link_ver_hv").css("display", "block");
        $("#link_mod_hv").css("display", "none");   
        $("#hdd_val_archivo").val(0);
    }  
}

function obtener_extension_archivo(nombre_archivo) {
    var extension = nombre_archivo.substring(nombre_archivo.lastIndexOf(".") + 1).toLowerCase();	
    return extension;
}


function cargar_archivo_hv(tipo_accion){
    var result = 0;
    var msg_input='';
    
    var hdd_val_archivo = $("#hdd_val_archivo").val();
    
    if(tipo_accion==0){ // Nuevo Registro
        
        $("#archivo_hv").removeClass("borde_error");	        
        $("#observaciones_profesor").removeClass("borde_error");
        $("#fecha_hv").removeClass("borde_error");
        
        if ($('#archivo_hv').val() == '') { $("#archivo_hv").addClass("borde_error"); result = 1; }
        if ($('#observaciones_profesor').val() == '') { $("#observaciones_profesor").addClass("borde_error"); result = 1; }        
        if ($('#fecha_hv').val() == '') { $("#fecha_hv").addClass("borde_error"); result = 1; }
        
    } else if(tipo_accion==1){ // Editar registro
        
        $("#archivo_hv").removeClass("borde_error");	        
        $("#observaciones_profesor").removeClass("borde_error");  
        $("#fecha_hv").removeClass("borde_error");
        if ($('#observaciones_profesor').val() == '') { $("#observaciones_profesor").addClass("borde_error"); result = 1; }        
        if(hdd_val_archivo==1){
            if ($('#archivo_hv').val() == '') { $("#archivo_hv").addClass("borde_error"); result = 1; }
            if ($('#fecha_hv').val() == '') { $("#fecha_hv").addClass("borde_error"); result = 1; }
        }
        
    }
    
    if (result == 0) {	            
            
        var ruta_arch_adjunto = $("#archivo_hv").val();
        var observaciones_profesor = str_encode($("#observaciones_profesor").val());
        var hdd_id_academica = $("#hdd_id_academica").val();
        var fecha_hv = $("#fecha_hv").val();
        
        if(hdd_val_archivo==1){ //Subir Archivo    
            var extension = obtener_extension_archivo(ruta_arch_adjunto);
            if (extension != "pdf") {
                alert("El archivo a cargar debe ser un documento .pdf");
                return;
            }     
            var params = "opcion=6&id_academica=" + hdd_id_academica +
                         "&observaciones_profesor=" + observaciones_profesor + 
                         "&fecha_hv=" + fecha_hv;
            llamarAjaxUploadFiles("certifica_seguimiento_ajax.php", params, "d_guardar_arch_adjunto", "finalizar_cargar_datos()", "d_barra_progreso_adj", "archivo_hv");
        }
        else if(hdd_val_archivo==0){//No Subir Archivo
            
            var params = "opcion=7&id_academica=" + hdd_id_academica +
                         "&observaciones_profesor=" + observaciones_profesor;
            llamarAjax("certifica_seguimiento_ajax.php", params, "d_guardar_arch_adjunto", "finalizar_cargar_datos()");
            
        }
            
            
    } else if (result == 1) {
        
        $("#contenedor_error_subir_hv").addClass("contenedor_error_visible");
        $('#contenedor_error_subir_hv').html('Debe seleccionar los datos campos' + msg_input);            
        setTimeout(
        function () {
            $('#contenedor_error_subir_hv').slideUp(200).removeClass("contenedor_error_visible");
        }, 2000);
        return false;
    } 
        
}

function finalizar_cargar_datos() {
	var ind_resul_cargar_archivo = parseInt($("#hdd_resul_cargar_archivo").val(), 10);
	console.log("#test", ind_resul_cargar_archivo);
	$("#contenedor_error_subir_hv").css("display", "none");
	$("#contenedor_exito_subir_hv").css("display", "none");
	
	//$("#btn_cargar_datos").removeAttr("disabled");
	$("#d_boton_cargar_datos").css("display", "block");
	$("#d_espera_cargar_datos").css("display", "none");
	
        //alert(ind_resul_cargar_archivo);
        
	if (ind_resul_cargar_archivo > 0) {		
                $("#contenedor_exito_subir_hv").addClass("contenedor_exito_visible");
                $('#contenedor_exito_subir_hv').html('Datos guardados con &eacute;xito');                
		setTimeout(
                function() {
                        cerrarModalConfirmacion();
                        buscar_estudiantes();
                },
		3000);
	} else if (ind_resul_cargar_archivo == -3) {
		$("#contenedor_error_subir_hv").addClass("contenedor_error_visible");
                $('#contenedor_error_subir_hv').html('Error al limpiar el archivo temporal de afiliados');                
	} else if (ind_resul_cargar_archivo == -4) {
		$("#contenedor_error_subir_hv").addClass("contenedor_error_visible");
                $('#contenedor_error_subir_hv').html('Error - El archivo cargado no tiene todas las columnas requeridas');
	} else if (ind_resul_cargar_archivo == -5) {
		$("#contenedor_error_subir_hv").addClass("contenedor_error_visible");
                $('#contenedor_error_subir_hv').html('Error en la carga de datos a la tabla temporal');                
	} else if (ind_resul_cargar_archivo == -6) {
		$("#contenedor_error_subir_hv").addClass("contenedor_error_visible");
                $('#contenedor_error_subir_hv').html('Error - La extensi&oacute;n del archivo no es csv ni txt');                
	} else if (ind_resul_cargar_archivo == -7) {
		$("#contenedor_error_subir_hv").addClass("contenedor_error_visible");
                $('#contenedor_error_subir_hv').html('Error - El archivo cargado no tiene extensi&oacute;n');                
	} else {
		$("#contenedor_error_subir_hv").addClass("contenedor_error_visible");
                $('#contenedor_error_subir_hv').html("Error interno al tratar de cargar el archivo (" + ind_resul_cargar_archivo + ")");                
	}
}


function form_cargar_hv(id_academica, id_persona, nombre_completo){
    
    /*var params = 'opcion=5&id_academica=' + id_academica;
    llamarAjax("certifica_seguimiento_ajax.php", params, "d_interno", "");*/
    
    var titulo = 'Adjuntar Hoja de Vida';
    
    var params = 'opcion=5&titulo=' + titulo + 
                 '&id_academica=' + id_academica + 
                 '&nombre_completo=' + nombre_completo +                 
                 '&id_persona=' + id_persona;
    llamarAjax("certifica_seguimiento_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
    
    
    
}

/**
 * 
 * @param {type} id_academica
 * @param {type} id_persona
 * @param {type} nombre_completo
 * @param {type} tipo (1: Academica; 2: Cartera)
 * @returns {undefined}
 */
function form_validar(id_academica, id_persona, nombre_completo, tipo){
    
    /*var params = 'opcion=5&id_academica=' + id_academica;
    llamarAjax("certifica_seguimiento_ajax.php", params, "d_interno", "");*/
    
    /**
    var titulo = 'Validar Estudiante';
    
    var params = 'opcion=8&titulo=' + titulo + 
                 '&id_academica=' + id_academica + 
                 '&nombre_completo=' + nombre_completo +                 
                 '&id_persona=' + id_persona;
    llamarAjax("certifica_seguimiento_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
     */
    
    
    if(tipo==1){ //Coordicacion Academica
        var titulo = 'Validar por Academica';
    
        var params = 'opcion=12&titulo=' + titulo + 
                     '&id_academica=' + id_academica + 
                     '&nombre_completo=' + nombre_completo +                 
                     '&id_persona=' + id_persona;
        llamarAjax("certifica_seguimiento_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
    }
    
    if(tipo==2){ // Cartera
        var titulo = 'Validar por Cartera';
    
        var params = 'opcion=13&titulo=' + titulo + 
                     '&id_academica=' + id_academica + 
                     '&nombre_completo=' + nombre_completo +                 
                     '&id_persona=' + id_persona;
        llamarAjax("certifica_seguimiento_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
    }
    
    
    
    
    
    
}


function estado_validacion(id_academica, estado, campo, tipo_validacion){
    var params = 'opcion=9&id_academica=' + id_academica + 
                 '&estado=' + estado + 
                 '&campo=' + campo +
                 '&tipo_validacion=' + tipo_validacion;
    llamarAjax("certifica_seguimiento_ajax.php", params, "div_"+campo, "exito_estado_validacion();");
}


function exito_estado_validacion() {
	var hdd_resul_validacion = parseInt($("#hdd_resul_validacion").val(), 10);
	
	$("#contenedor_error_validar").css("display", "none");
	$("#contenedor_exito_validar").css("display", "none");
	//alert(hdd_resul_validacion);        
	if (hdd_resul_validacion > 0) {		
                $("#contenedor_exito_validar").addClass("contenedor_exito_visible");
                $('#contenedor_exito_validar').html('Datos Enviados con &eacute;xito');                
		setTimeout(
                function() {
                    $('#contenedor_exito_validar').slideUp(200).removeClass("contenedor_exito_visible");
                    $("#contenedor_exito_validar").css("display", "none");
                    buscar_estudiantes();
                },
		3000);
	} 
}



function validar_academica(id_academica){
    
    var result = 0;
    var msg_input='';
    
    $("#observacion_coor_acade").removeClass("borde_error");
    $("#val_estado_academica").removeClass("borde_error");
    if ($('#observacion_coor_acade').val() == '') { $("#observacion_coor_acade").addClass("borde_error"); result = 1; }
    if ($('#val_estado_academica').val() == '') { $("#val_estado_academica").addClass("borde_error"); result = 1; }
    
    if (result == 0) {	            
            
        var observacion_coor_acade = $("#observacion_coor_acade").val();
        var estado_academica = $("#val_estado_academica").val();
            
        var params = "opcion=10&id_academica=" + id_academica +
                     "&observacion_coor_acade=" + str_encode(observacion_coor_acade) + 
                     "&estado_academica=" + estado_academica;
        llamarAjax("certifica_seguimiento_ajax.php", params, "validar_coor_acade", "finalizar_validacion()");
            
            
    } else if (result == 1) {
        
        $("#contenedor_error_validar").addClass("contenedor_error_visible");
        $('#contenedor_error_validar').html('Debe Ingresar una Observaci&oacute;n y Estado ' + msg_input);            
        setTimeout(
        function () {
            $('#contenedor_error_validar').slideUp(200).removeClass("contenedor_error_visible");
        }, 2000);
        return false;
    } 
}


function finalizar_validacion(){
    
    var hdd_validacion_resultado = parseInt($("#hdd_validacion_resultado").val(), 10);
	
	$("#contenedor_error_validar").css("display", "none");
	$("#contenedor_exito_validar").css("display", "none");
	//alert(hdd_resul_validacion);        
	if (hdd_validacion_resultado > 0) {		
                $("#contenedor_exito_validar").addClass("contenedor_exito_visible");
                $('#contenedor_exito_validar').html('Datos Enviados con &eacute;xito');                
		setTimeout(
                function() {
                    $('#contenedor_exito_validar').slideUp(200).removeClass("contenedor_exito_visible");
                    $("#contenedor_exito_validar").css("display", "none");
                    buscar_estudiantes();
                    cerrarModalConfirmacion();
                },
		3000);
	} 
}




function validar_cartera(id_academica){
    
    var result = 0;
    var msg_input='';
    
    $("#observacion_cartera").removeClass("borde_error");
    $("#val_estado_cartera").removeClass("borde_error");
    if ($('#observacion_cartera').val() == '') { $("#observacion_cartera").addClass("borde_error"); result = 1; }
    if ($('#val_estado_cartera').val() == '') { $("#val_estado_cartera").addClass("borde_error"); result = 1; }
    
    
    if (result == 0) {	            
            
        var observacion_cartera = $("#observacion_cartera").val();
        var estado_cartera = $("#val_estado_cartera").val();
        
            
        var params = "opcion=11&id_academica=" + id_academica +
                     "&observacion_cartera=" + str_encode(observacion_cartera) + 
                     "&estado_cartera=" + estado_cartera;
        llamarAjax("certifica_seguimiento_ajax.php", params, "validar_cartera", "finalizar_validacion()");
            
            
    } else if (result == 1) {
        
        $("#contenedor_error_validar").addClass("contenedor_error_visible");
        $('#contenedor_error_validar').html('Debe Ingresar una Observaci&oacute;n y Estado' + msg_input);            
        setTimeout(
        function () {
            $('#contenedor_error_validar').slideUp(200).removeClass("contenedor_error_visible");
        }, 2000);
        return false;
    } 
}



function capacitar_persona(id_academica){
    
    
    //var val_id_academica = $("#id_capacita_"+id_academica).prop('checked');
    var val_id_academica = true;
    var val_resultado = 1;    
    if(val_id_academica == true){
        var val_resultado = 1;
        $("#tipo_productividad_"+id_academica).removeAttr("disabled",false);        
    }
    else{
        var val_resultado = 0;
        $("#tipo_productividad_"+id_academica).attr("disabled",true);
        $('#tipo_productividad_' + id_academica).val("");
        var params = 'opcion=4&id_academica=' + id_academica + '&tipo_productiva=' + 0;
        llamarAjax("certifica_seguimiento_ajax.php", params, "div_productividad_"+id_academica, "exito_productiva("+id_academica+")");
        
    }
    
    var params = 'opcion=2&id_academica=' + id_academica + '&val_resultado=' + val_resultado;
    llamarAjax("certifica_seguimiento_ajax.php", params, "div_capacita_"+id_academica, "");
    
}


function seleccionar_productiva(id_academica){
    
    var tipo_productiva = $('#tipo_productividad_' + id_academica).val();
    var params = 'opcion=4&id_academica=' + id_academica + '&tipo_productiva=' + tipo_productiva;
    llamarAjax("certifica_seguimiento_ajax.php", params, "div_productividad_"+id_academica, "exito_productiva("+id_academica+")");
}



function exito_productiva(id_academica){
    
    $('#div_productividad_'+id_academica).css('display', 'block')
    var tipo_productiva = $('#tipo_productividad_' + id_academica).val();
    
    if(tipo_productiva>0){
        $("#btn_subir_hv_"+id_academica).removeAttr("disabled",false);
        $("#btn_validar_hv_"+id_academica).removeAttr("disabled",false);       
    }
    else{
        $("#btn_subir_hv_"+id_academica).attr("disabled",true);
        $("#btn_validar_hv_"+id_academica).attr("disabled",true);
    }
    
    setTimeout(
    function () {
       //$('#contenedor_exito').slideUp(400).removeClass("contenedor_exito_visible").addClass("contenedor_exito");
       $('#div_productividad_'+id_academica).css('display', 'none')
       
    }, 3000);
}


/*
 * tipo_buscar
 * 1 = Todos
 * 2 = Validar por Coordinacion Academina - Cartera
 */
function validar_buscar(tipo_buscar){
	var result = 0;
   	var msg_input='';
        
	$("#id_programa").removeClass("borde_error");	
        $("#calendario_academico").removeClass("borde_error");
        $("#txt_busca_estudiante").removeClass("borde_error");
        $("#jornada").removeClass("borde_error");
        
        
        if (result == 0) {	            
		modalConfirmarGuardar("Desea Cargar los Estudiantes?", "buscar_estudiantes()");
		return false;
	} else if (result == 1) {
		
		$("#contenedor_error").addClass("contenedor_error_visible");
		$('#contenedor_error').html('Debe seleccionar al menos un campo para buscar' + msg_input);
		window.scroll(0, 0);
		return false;
	} 
	
}


function buscar_estudiantes(){
	
	var id_programa = $('#id_programa').val();
        if(id_programa==""){id_programa=0;}        
	
        var txt_busca_estudiante = $('#txt_busca_estudiante').val();
        if(txt_busca_estudiante==""){txt_busca_estudiante=0;}
        
        var calendario_academico = $('#calendario_academico').val();
        if(calendario_academico==""){calendario_academico=0;}
        
        var jornada = $('#jornada').val();
        if(jornada==""){jornada=0;}        
        
        
        
        var estado_capacitacion = $('#estado_capacitacion').val();
        if(estado_capacitacion==""){
            estado_capacitacion=-1;
        }else if(estado_capacitacion==46){
            estado_capacitacion=1;
        }else if(estado_capacitacion==47){
            estado_capacitacion=0;
        }
        
        var estado_productividad = $('#estado_productividad').val();
        if(estado_productividad==""){estado_productividad=0;}        
        
        var estado_hoja_vida = $('#estado_hoja_vida').val();
        if(estado_hoja_vida==""){estado_hoja_vida=0;}
        
        var estado_academica = $('#estado_academica').val();
        if(estado_academica==""){
            estado_academica=-1;
        }else if(estado_academica==46){
            estado_academica=1;
        }else if(estado_academica==47){
            estado_academica=0;
        }
        
        var estado_cartera = $('#estado_cartera').val();
        if(estado_cartera==""){
            estado_cartera=-1;
        }else if(estado_cartera==46){
            estado_cartera=1;
        }else if(estado_cartera==47){
            estado_cartera=0;
        }
        
	
	var params = 'opcion=1&id_programa=' + id_programa + 
                     '&calendario_academico=' + calendario_academico + 
                     '&jornada=' + jornada + 
                     '&txt_busca_estudiante=' + txt_busca_estudiante +
                     '&estado_capacitacion=' + estado_capacitacion + 
                     '&estado_productividad=' + estado_productividad + 
                     '&estado_hoja_vida=' + estado_hoja_vida + 
                     '&estado_academica=' + estado_academica + 
                     '&estado_cartera=' + estado_cartera;
        llamarAjax("certifica_seguimiento_ajax.php", params, "principal_lista_estudiantes", "");
	
	
	
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


function form_estado_certificacion(id_academica, id_persona, nombre_completo){
    var titulo = 'Cambiar Estado de Certificación';

    var params = 'opcion=14&titulo=' + titulo + 
                 '&id_academica=' + id_academica + 
                 '&nombre_completo=' + nombre_completo +                 
                 '&id_persona=' + id_persona;
    llamarAjax("certifica_seguimiento_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}


function estado_certificacion(id_academica){
    
    var result = 0;
    $("#val_estado_certificacion").removeClass("borde_error");
    $("#observacion_estado_certificacion").removeClass("borde_error");

    if ($('#val_estado_certificacion').val() == '') { $("#val_estado_certificacion").addClass("borde_error"); result = 1; }
    if ($('#observacion_estado_certificacion').val() == '') { $("#observacion_estado_certificacion").addClass("borde_error"); result = 1; }
    
    if (result == 0) {	            
            
        var observacion_estado_certificacion = $("#observacion_estado_certificacion").val();
        var val_estado_certificacion = $("#val_estado_certificacion").val();
           
        var params = "opcion=15&id_academica=" + id_academica +
                     "&observacion_estado_certificacion=" + str_encode(observacion_estado_certificacion) + 
                     "&estado_certificacion=" + val_estado_certificacion;
        llamarAjax("certifica_seguimiento_ajax.php", params, "div_estado_certificacion", "exito_estado_certificacion()");
            
    } else if (result == 1) {
        
        $("#contenedor_error_validar").addClass("contenedor_error_visible");
        $('#contenedor_error_validar').html('Debe Ingresar una Observaci&oacute;n y Seleccionar un Estado');            
        setTimeout(
        function () {
            $('#contenedor_error_validar').slideUp(200).removeClass("contenedor_error_visible");
        }, 2000);
        return false;
    } 

    
    
    
    
    
}


function exito_estado_certificacion() {
	var hdd_estado_certificacon = parseInt($("#hdd_estado_certificacon").val(), 10);
	
	$("#contenedor_error_validar").css("display", "none");
	$("#contenedor_exito_validar").css("display", "none");
	//alert(hdd_resul_validacion);        
	if (hdd_estado_certificacon > 0) {		
                $("#contenedor_exito_validar").addClass("contenedor_exito_visible");
                $('#contenedor_exito_validar').html('Datos Enviados con &eacute;xito');                
		setTimeout(
                function() {
                    $('#contenedor_exito_validar').slideUp(200).removeClass("contenedor_exito_visible");
                    $("#contenedor_exito_validar").css("display", "none");
                    buscar_estudiantes();
                    cerrarModalConfirmacion();
                },
		3000);
	} 
}




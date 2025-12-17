function buscar_registro_id(){	
	var txt_busca_id = $('#txt_busca_id').val();	
	var params = 'opcion=2&txt_busca_id=' + txt_busca_id;
    llamarAjax("chequeo_ajax.php", params, "principal_registro", "");	
}


function llamar_editar_lista(id_registro) {	
	var params = 'opcion=1&id_academico=' + id_registro;
    llamarAjax("chequeo_ajax.php", params, "principal_registro", "");
}


function llamar_buscar_registro($txt_busca_id) {
        var txt_busca_id = $('#txt_busca_id').val();	
	var params = 'opcion=2&txt_busca_id=' + txt_busca_id;
    llamarAjax("chequeo_ajax.php", params, "principal_registro", "");
}



function validar_documento_identidad_buscar(){
	var txt_documento_persona = $('#txt_busca_id').val();
	
	$("#contenedor_error").removeClass("contenedor_error_visible");
   	$("#contenedor_error").addClass("contenedor_error");
	
	if(txt_documento_persona.length > 50){
		$('#txt_busca_id').val('');
		
		$("#contenedor_error").addClass("contenedor_error_visible");
	    $('#contenedor_error').html('Error en el documento de Identidad');
		
	}
	
}


function validar_crear_editar_chequeo(tipo_accion) {
   
   	var result = 0;
   	var msg_input='';
   	
        
       
	if(tipo_accion == 1){ //Nuevo registro
		
		if (result == 0) {		
                    modalConfirmarGuardar("Realmente desea crear el nuevo registro?", "crear_editar_registro(1)");
                    return false;
		} else {
			
                $("#contenedor_error").addClass("contenedor_error_visible");
	        $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);
                    window.scroll(0, 0);
                    return false;
		}
		
	} else if(tipo_accion == 2){ //Editar registro
		
		if (result == 0) {		
                    modalConfirmarGuardar("Realmente desea editar el registro?", "crear_editar_registro(2)");
                    return false;
		} else {
			
                $("#contenedor_error").addClass("contenedor_error_visible");
	        $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);
                    window.scroll(0, 0);
                    return false;
		}
	} 
        
        
   
}


function modalConfirmarGuardar(titulo, funcion) {
    var params = 'opcion=4&titulo=' + titulo + '&funcion=' + funcion;
    llamarAjax("chequeo_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}



function mostrarModalConfirmacion() {
    $('#modalConfirmacion').modal();
}



function crear_editar_registro(tipo_accion) {
    
        var reg_oportunidad = $('#reg_oportunidad').val();
        if(reg_oportunidad==''){reg_oportunidad=0;}
        var info_basica = $('#info_basica').val();
        if(info_basica==''){info_basica=0;}
        var preguntas_perso = $('#preguntas_perso').val();
        if(preguntas_perso==''){preguntas_perso=0;}
        var info_acudiente = $('#info_acudiente').val();
        if(info_acudiente==''){info_acudiente=0;}
        var inscripcion_estudiante = $('#inscripcion_estudiante').val();
        if(inscripcion_estudiante==''){inscripcion_estudiante=0;}
        var matricula_foto = $('#matricula_foto').val();
        if(matricula_foto==''){matricula_foto=0;}
        var contrato_matricula = $('#contrato_matricula').val();
        if(contrato_matricula==''){contrato_matricula=0;}
        var fotocopia_documento_estudiante = $('#fotocopia_documento_estudiante').val();
        if(fotocopia_documento_estudiante==''){fotocopia_documento_estudiante=0;}
        var fotocopia_documento_acudiente = $('#fotocopia_documento_acudiente').val();
        if(fotocopia_documento_acudiente==''){fotocopia_documento_acudiente=0;}
        var fotocopia_certificado_ultimo_grado = $('#fotocopia_certificado_ultimo_grado').val();
        if(fotocopia_certificado_ultimo_grado==''){fotocopia_certificado_ultimo_grado=0;}
        var fotocopia_diploma_bachiller = $('#fotocopia_diploma_bachiller').val();
        if(fotocopia_diploma_bachiller==''){fotocopia_diploma_bachiller=0;}
        var carta_bienvenida = $('#carta_bienvenida').val();
        if(carta_bienvenida==''){carta_bienvenida=0;}
        var solicitud_academica = $('#solicitud_academica').val();
        if(solicitud_academica==''){solicitud_academica=0;}
        var carta_compromiso = $('#carta_compromiso').val();
        if(carta_compromiso==''){carta_compromiso=0;}
        var paz_salvo_estudiante = $('#paz_salvo_estudiante').val();
        if(paz_salvo_estudiante==''){paz_salvo_estudiante=0;}
        var autorizacion_centrales_riesgo = $('#autorizacion_centrales_riesgo').val();
        if(autorizacion_centrales_riesgo==''){autorizacion_centrales_riesgo=0;}
        var solicitud_credito = $('#solicitud_credito').val();
        if(solicitud_credito==''){solicitud_credito=0;}
        var consulta_datacredito = $('#consulta_datacredito').val();
        if(consulta_datacredito==''){consulta_datacredito=0;}
        var pagare_carta_instrucciones = $('#pagare_carta_instrucciones').val();
        if(pagare_carta_instrucciones==''){pagare_carta_instrucciones=0;}
        var plan_pagos = $('#plan_pagos').val();
        if(plan_pagos==''){plan_pagos=0;}
        var entrega_carpeta = $('#entrega_carpeta').val();
        if(entrega_carpeta==''){entrega_carpeta=0;}
        var registra_info_q10 = $('#registra_info_q10').val();
        if(registra_info_q10==''){registra_info_q10=0;}
        var matricula_estudiante_q10 = $('#matricula_estudiante_q10').val();
        if(matricula_estudiante_q10==''){matricula_estudiante_q10=0;}
        var crear_credito_q10 = $('#crear_credito_q10').val();
        if(crear_credito_q10==''){crear_credito_q10=0;}
        var foto_q10 = $('#foto_q10').val();
        if(foto_q10==''){foto_q10=0;}
        var confirmacion_pago = $('#confirmacion_pago').val();
        if(confirmacion_pago==''){confirmacion_pago=0;}
        var registra_estudiante_simat = $('#registra_estudiante_simat').val();
        if(registra_estudiante_simat==''){registra_estudiante_simat=0;}
        var recibe_carpeta_items = $('#recibe_carpeta_items').val();
        if(recibe_carpeta_items==''){recibe_carpeta_items=0;}
        var firma_contrato_matricula = $('#firma_contrato_matricula').val();
        if(firma_contrato_matricula==''){firma_contrato_matricula=0;}
        var devuelve_carpeta = $('#devuelve_carpeta').val();
        if(devuelve_carpeta==''){devuelve_carpeta=0;}
        
        
        
        var fecha_rev_comercial = $('#fecha_rev_comercial').val();
        if(fecha_rev_comercial==''){fecha_rev_comercial='01/01/1900';}
        var observacion_comercial = $('#observacion_comercial').val();
        
        var fecha_rev_academica = $('#fecha_rev_academica').val();
        if(fecha_rev_academica==''){fecha_rev_academica='01/01/1900';}
        var observacion_academica = $('#observacion_academica').val();
        
        var fecha_rev_rectoria = $('#fecha_rev_rectoria').val();
        if(fecha_rev_rectoria==''){fecha_rev_rectoria='01/01/1900';}
        var observacion_rectoria = $('#observacion_rectoria').val();
        
        var hdd_id_academica = $('#hdd_id_academica').val();

        
		
	   var params = 'opcion=5' +             
                        '&reg_oportunidad=' + reg_oportunidad +
                        '&info_basica=' + info_basica +
                        '&preguntas_perso=' + preguntas_perso +
                        '&info_acudiente=' + info_acudiente +
                        '&inscripcion_estudiante=' + inscripcion_estudiante +
                        '&matricula_foto=' + matricula_foto +
                        '&contrato_matricula=' + contrato_matricula +
                        '&fotocopia_documento_estudiante=' + fotocopia_documento_estudiante +
                        '&fotocopia_documento_acudiente=' + fotocopia_documento_acudiente +
                        '&fotocopia_certificado_ultimo_grado=' + fotocopia_certificado_ultimo_grado +
                        '&fotocopia_diploma_bachiller=' + fotocopia_diploma_bachiller +
                        '&carta_bienvenida=' + carta_bienvenida +
                        '&solicitud_academica=' + solicitud_academica +
                        '&carta_compromiso=' + carta_compromiso +
                        '&paz_salvo_estudiante=' + paz_salvo_estudiante +
                        '&autorizacion_centrales_riesgo=' + autorizacion_centrales_riesgo +
                        '&solicitud_credito=' + solicitud_credito +
                        '&consulta_datacredito=' + consulta_datacredito +
                        '&pagare_carta_instrucciones=' + pagare_carta_instrucciones +
                        '&plan_pagos=' + plan_pagos +
                        '&entrega_carpeta=' + entrega_carpeta +
                        '&registra_info_q10=' + registra_info_q10 +
                        '&matricula_estudiante_q10=' + matricula_estudiante_q10 +
                        '&crear_credito_q10=' + crear_credito_q10 +
                        '&foto_q10=' + foto_q10 +
                        '&confirmacion_pago=' + confirmacion_pago +
                        '&registra_estudiante_simat=' + registra_estudiante_simat +
                        '&recibe_carpeta_items=' + recibe_carpeta_items +
                        '&firma_contrato_matricula=' + firma_contrato_matricula +
                        '&devuelve_carpeta=' + devuelve_carpeta +
                        '&fecha_rev_comercial=' + fecha_rev_comercial +
                        '&observacion_comercial=' + observacion_comercial +
                        '&fecha_rev_academica=' + fecha_rev_academica +
                        '&observacion_academica=' + observacion_academica +
                        '&fecha_rev_rectoria=' + fecha_rev_rectoria +
                        '&observacion_rectoria=' + observacion_rectoria +
                        '&hdd_id_academica=' + hdd_id_academica +
                        '&tipo_accion=' + tipo_accion;   
            	 
    llamarAjax("chequeo_ajax.php", params, "principal_registro", "validar_exito();");
    //llamarAjax("registro_ajax.php", params, "principal_registro", "");

}



/*
 * Tipo
 * 1=crear
 * 2=editar
 */
function validar_exito() {

    var hdd_exito = $('#hdd_exito').val();
    
    var texto_exito = "";
    
    texto_exito = 'Registro guardado correctamente <br /> ';
	   
    	
    //$('.formulario').css('display', 'none')
    if (hdd_exito > 0) {
        $("#contenedor_exito").addClass("contenedor_exito_visible");
        $('#contenedor_exito').html(texto_exito);
        window.scroll(0, 0);
        setTimeout(
                function () {
                   $('#contenedor_exito').slideUp(400).removeClass("contenedor_exito_visible").addClass("contenedor_exito");
                }, 4000);
        //volver_inicio();
    } else {
        $("#contenedor_error").addClass("contenedor_error_visible");
        $('#contenedor_error').html('Error al guardar Registro');

        window.scroll(0, 0);
        etTimeout("$('#contenedor_error').slideUp(400).removeClass('contenedor_error_visible').addClass('contenedor_error')", 4000);
    }

}

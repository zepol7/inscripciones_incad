

function certificar_estados(id_academica, id_tipo){
    
    switch (id_tipo) {
        case 1:
          var val_id_academica = $("#id_carta_"+id_academica).prop('checked');
          break;
        case 2:
          var val_id_academica = $("#id_contrato_"+id_academica).prop('checked');
          break;
        case 3:
          var val_id_academica = $("#id_calificacion_"+id_academica).prop('checked');
          break;
        case 4:
          var val_id_academica = $("#id_certificacion_"+id_academica).prop('checked');
          break;
        case 5:
          var val_id_academica = $("#id_pasantia_"+id_academica).prop('checked');  
          break;
        case 6:
          var val_id_academica = $("#id_sol_academica_"+id_academica).prop('checked');
          break;
        case 7:
          var val_id_academica = $("#id_certificacion_lab_"+id_academica).prop('checked');
          break;  
        default:
    }
  
    //var val_resultado = 0;
    if(val_id_academica == true){
        var val_resultado = 1;
    }
    else{
        var val_resultado = 0;
    }
    
    var params = 'opcion=2&id_academica=' + id_academica + '&val_resultado=' + val_resultado + '&id_tipo=' + id_tipo;
    llamarAjax("seguimiento_certificacion_ajax.php", params, "div_estados_certifica_"+id_academica, "");
    
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
        
        
        
        var cert_carta = $('#cert_carta').val();
        if(cert_carta==""){
            cert_carta=-1;
        } else if(cert_carta==46){
            cert_carta=1;
        } else if(cert_carta==47){
            cert_carta=0;
        }        
        
        var cert_contrato = $('#cert_contrato').val();
        if(cert_contrato==""){
            cert_contrato=-1;
        } else if(cert_contrato==46){
            cert_contrato=1;
        } else if(cert_contrato==47){
            cert_contrato=0;
        }
        
        var cert_calificacion = $('#cert_calificacion').val();
        if(cert_calificacion==""){
            cert_calificacion=-1;
        } else if(cert_calificacion==46){
            cert_calificacion=1;
        } else if(cert_calificacion==47){
            cert_calificacion=0;
        }
        
        var cert_certificacion = $('#cert_certificacion').val();
        if(cert_certificacion==""){
            cert_certificacion=-1;
        } else if(cert_certificacion==46){
            cert_certificacion=1;
        } else if(cert_certificacion==47){
            cert_certificacion=0;
        }
        
        var cert_pasantia = $('#cert_pasantia').val();
        if(cert_pasantia==""){
            cert_pasantia=-1;
        } else if(cert_pasantia==46){
            cert_pasantia=1;
        } else if(cert_pasantia==47){
            cert_pasantia=0;
        }
        
        var cert_solicitud_academica = $('#cert_solicitud_academica').val();
        if(cert_solicitud_academica==""){
            cert_solicitud_academica=-1;
        } else if(cert_solicitud_academica==46){
            cert_solicitud_academica=1;
        } else if(cert_solicitud_academica==47){
            cert_solicitud_academica=0;
        }
        
        var cert_laboral = $('#cert_laboral').val();
        if(cert_laboral==""){
            cert_laboral=-1;
        } else if(cert_laboral==46){
            cert_laboral=1;
        } else if(cert_laboral==47){
            cert_laboral=0;
        }
        
	
	var params = 'opcion=1&id_programa=' + id_programa + 
                     '&calendario_academico=' + calendario_academico + 
                     '&jornada=' + jornada + 
                     '&txt_busca_estudiante=' + txt_busca_estudiante +
                     '&cert_carta=' + cert_carta +
                     '&cert_contrato=' + cert_contrato + 
                     '&cert_calificacion=' + cert_calificacion +
                     '&cert_certificacion=' + cert_certificacion +
                     '&cert_pasantia=' + cert_pasantia +
                     '&cert_solicitud_academica=' + cert_solicitud_academica +
                     '&cert_laboral=' + cert_laboral;
        llamarAjax("seguimiento_certificacion_ajax.php", params, "principal_lista_estudiantes", "");
	
	
	
}




function modalConfirmarGuardar(titulo, funcion) {
    var params = 'opcion=3&titulo=' + titulo + '&funcion=' + funcion;
    llamarAjax("seguimiento_certificacion_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
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








function validar_informe(){
	var result = 0;
   	var msg_input='';
        
	$("#fecha_inicial").removeClass("borde_error");	
        $("#fecha_final").removeClass("borde_error");	
	if ($('#fecha_inicial').val() == '') { $("#fecha_inicial").addClass("borde_error"); result = 1; }
        if ($('#fecha_final').val() == '') { $("#fecha_final").addClass("borde_error"); result = 1; }
	
        
        if($('#fecha_inicial').val() > $('#fecha_final').val()){
            result = 2;
        }
	
	if (result == 0) {		
		modalConfirmarGuardar("Desea realizar el Informe?", "ejecutar_informe()");
		return false;
	} else if (result == 1) {
		
		$("#contenedor_error").addClass("contenedor_error_visible");
		$('#contenedor_error').html('Debe Ingresar valores de fechas' + msg_input);
		window.scroll(0, 0);
		return false;
	} else if (result == 2) {
		
		$("#contenedor_error").addClass("contenedor_error_visible");
		$('#contenedor_error').html('La fecha Inicial debe ser menor que la Fecha Final');
		window.scroll(0, 0);
		return false;
	}
	
}


function ejecutar_informe(){
	
	var fecha_inicial = $('#fecha_inicial').val();
	var fecha_final = $('#fecha_final').val();
	
	var params = 'opcion=2&fecha_inicial=' + fecha_inicial + '&fecha_final=' + fecha_final;
    llamarAjax("informes_ajax.php", params, "principal_informe", "");
	
	
	
}




function modalConfirmarGuardar(titulo, funcion) {
    var params = 'opcion=3&titulo=' + titulo + '&funcion=' + funcion;
    llamarAjax("informes_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}

function mostrarModalConfirmacion() {
    $('#modalConfirmacion').modal();
}

function descargar_base(especialidad_cita){
    setTimeout(function(){ 
        document.getElementById("form_xls_base").submit(); 
    }, 3000);	
}







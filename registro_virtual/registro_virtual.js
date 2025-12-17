function validar_email( email ) 
{
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}

function buscar_registro_id(){	
	var txt_busca_id = $('#txt_busca_id').val();	
	var params = 'opcion=2&txt_busca_id=' + txt_busca_id;
    llamarAjax("registro_virtual_ajax.php", params, "principal_registro", "");	
}


function form_editar_registro(id){	
	var params = 'opcion=1&id_persona=' + id;
    llamarAjax("registro_virtual_ajax.php", params, "principal_registro", "");	
}


function llamar_crear_registro_virtual() {	
        var txt_busca_id = $('#txt_busca_id').val();	
	var params = 'opcion=1&documento_cargar=' + txt_busca_id;
    llamarAjax("registro_virtual_ajax.php", params, "principal_registro", "");
}



function validar_crear_editar_reg_virtual(tipo_accion, band_email){
    
    var result = 0;
    var msg_input='';
    $("#contenedor_error").removeClass("contenedor_error_visible");
    $("#contenedor_error").addClass("contenedor_error");

    $("#tipo_documento").removeClass("borde_error");
    $("#documento_persona").removeClass("borde_error");        
    $("#nombre_persona").removeClass("borde_error");
    $("#apellido_persona").removeClass("borde_error");        
    $("#email_persona").removeClass("borde_error");



    if ($('#tipo_documento').val() == '') { $("#tipo_documento").addClass("borde_error"); result = 1; }
    if ($('#documento_persona').val() == '') { $("#documento_persona").addClass("borde_error"); result = 1; }

    if ($('#nombre_persona').val() == '') { $("#nombre_persona").addClass("borde_error"); result = 1; }
    if ($('#apellido_persona').val() == '') { $("#apellido_persona").addClass("borde_error"); result = 1; }


    if ($('#email_persona').val() == '') { 
        $("#email_persona").addClass("borde_error"); result = 1; 
    }
    else{
        if(!validar_email($('#email_persona').val()))
        {
            $("#email_persona").addClass("borde_error"); result = 1;
            msg_input=msg_input + "<br /> * El e-mail tiene formato Incorrecto";
        }
    }
    
    
    
    if(tipo_accion == 1){ //Nuevo registro

            if (result == 0) {		
                modalConfirmarGuardar("Realmente desea crear el nuevo registro?", "crear_registro_virtual("+band_email+")");
                return false;
            } else {

            $("#contenedor_error").addClass("contenedor_error_visible");
            $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);           
            
            
            setTimeout(
            function () {
               $('#contenedor_error').slideUp(400).removeClass("contenedor_error_visible");
            }, 4000);
            
            
            
                window.scroll(0, 0);
                return false;
            }
            
            
            
            

    } else if(tipo_accion == 2){ //Editar registro

            if (result == 0) {		
                modalConfirmarGuardar("Realmente desea editar el registro?", "editar_registro_virtual("+band_email+")");
                return false;
            } else {

            $("#contenedor_error").addClass("contenedor_error_visible");
            $('#contenedor_error').html('Los campos marcados en rojo son obligatorios' + msg_input);
            
            setTimeout(
            function () {
               $('#contenedor_error').slideUp(400).removeClass("contenedor_error_visible");
            }, 4000);
            
                window.scroll(0, 0);
                return false;
            }
    }
    
        
        
    
}


function crear_registro_virtual(band_email) {
    
        var tipo_documento = $('#tipo_documento').val();
        var documento_persona = $('#documento_persona').val();        
        var nombre_persona = $('#nombre_persona').val();
        var apellido_persona = $('#apellido_persona').val();        
        var email_persona = $('#email_persona').val();
        
        var params = 'opcion=5' +             
                     '&tipo_documento=' + tipo_documento +
                     '&documento_persona=' + documento_persona +                        
                     '&nombre_persona=' + nombre_persona +
                     '&apellido_persona=' + apellido_persona + 
                     '&email_persona=' + email_persona;
            	 
        llamarAjax("registro_virtual_ajax.php", params, "principal_registro", "validar_exito("+band_email+");");
    
}

function editar_registro_virtual(band_email){
    
        var tipo_documento = $('#tipo_documento').val();
        var documento_persona = $('#documento_persona').val();        
        var nombre_persona = $('#nombre_persona').val();
        var apellido_persona = $('#apellido_persona').val();        
        var email_persona = $('#email_persona').val();
        var hdd_id_persona = $('#hdd_id_persona').val();
        
        
        var params = 'opcion=7' +             
                     '&tipo_documento=' + tipo_documento +
                     '&documento_persona=' + documento_persona +                        
                     '&nombre_persona=' + nombre_persona +
                     '&apellido_persona=' + apellido_persona + 
                     '&email_persona=' + email_persona +
                     '&hdd_id_persona=' + hdd_id_persona + 
                     '&band_email=' + band_email;
            	 
        llamarAjax("registro_virtual_ajax.php", params, "principal_registro", "validar_exito("+band_email+");");
        
}





function validar_exito(band_email) {

    var hdd_exito = $('#hdd_exito').val();    
    var texto_exito = "";    
    texto_exito = 'Registro guardado correctamente <br /> ';
	   
    	
    //$('.formulario').css('display', 'none')
    if (hdd_exito > 0) {
        
        //Enviar Correos ****
        if(band_email==1){
            var params = "opcion=6&id_registro=" + hdd_exito;			
            llamarAjax("registro_virtual_ajax.php", params, "d_envio_email", "");   
            
            texto_exito = texto_exito + 'Se envió un mensaje electrónico al correo registrado previamente <br /> ';
            
        }
        else{
            
        }
        
        $("#contenedor_exito").addClass("contenedor_exito_visible");
        $('#contenedor_exito').html(texto_exito);
        window.scroll(0, 0);
        setTimeout(
                function () {
                   $('#contenedor_exito').slideUp(900).removeClass("contenedor_exito_visible").addClass("contenedor_exito");
                }, 4000);
        //volver_inicio();
    } else {
        $("#contenedor_error").addClass("contenedor_error_visible");
        $('#contenedor_error').html('Error al guardar Registro');

        window.scroll(0, 0);
        setTimeout("$('#contenedor_error').slideUp(400).removeClass('contenedor_error_visible').addClass('contenedor_error')", 4000);
    }

}




function modalConfirmarGuardar(titulo, funcion) {
    var params = 'opcion=4&titulo=' + titulo + '&funcion=' + funcion;
    llamarAjax("registro_virtual_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}



function mostrarModalConfirmacion() {
    $('#modalConfirmacion').modal();
}




function copyToClipboard(elementId) {

  // Create a "hidden" input
  var aux = document.createElement("input");

  // Assign it the value of the specified element
  aux.setAttribute("value", document.getElementById(elementId).innerHTML);

  // Append it to the body
  document.body.appendChild(aux);

  // Highlight its content
  aux.select();

  // Copy the highlighted text
  document.execCommand("copy");

  // Remove it from the body
  document.body.removeChild(aux);

}
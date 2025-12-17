


function getMunicipios() {
	var cod_dep = $("#cmb_departamento").val();
	
	var params = 'opcion=1&cod_dep=' + cod_dep;
    llamarAjax("parasitosis_humana_ajax.php", params, "cmb_municipio", "");
}


















function muestraOtro() {
    var tipo_muestra = $("#cmb_tipo_muestra").val();

    if (tipo_muestra == 50) {//Muestra input de Otro
        $("#txt_otro_tipo_muestra").css({display: 'block'});
    } else {
        $("#txt_otro_tipo_muestra").css({display: 'none'});
    }
}

function muestraOtroAnalisisSolicitado() {
    var tipo_muestra = $("#cmb_tipo_analisis").val();

    if (tipo_muestra == 53) {//Muestra input de Otro
        $("#txt_otro_tipo_analisis").css({display: 'block'});
    } else {
        $("#txt_otro_tipo_analisis").css({display: 'none'});
    }
}

function muestraOtroObjetoAnalisis() {
    var tipo_muestra = $("#cmb_objeto_analisis").val();

    if (tipo_muestra == 56) {//Muestra input de Otro
        $("#txt_otro_objeto_analisis").css({display: 'block'});
    } else {
        $("#txt_otro_objeto_analisis").css({display: 'none'});
    }
}

function epsaAcompanante() {
    var acompanante = $("#cmb_epsa_acompanante").val();

    if (acompanante == 1) {//Muestra
        $(".tr-epsa-acompanante").css({display: 'table-row'});
    } else if (acompanante == 2) {
        $(".tr-epsa-acompanante").css({display: 'none'});
    }
}

/*Crear acta de muestra*/
function validaGuardarMuestra() {
    $("#frmActaMuestras").validate({
        rules: {
            txtSolicitante: {
                required: true,
            },
            txt_tel_s: {
                required: true,
                number: true,
            },
            txt_dir_s: {
                required: true,
            },
            txt_fecha_toma: {
                required: true,
            },
            txt_hora_toma: {
                required: true,
                range: [1, 12],
            },
            txt_min_toma: {
                required: true,
                range: [0, 59],
            },
            cmb_periodo_toma: {
                required: true,
            },
            txt_epsa_s: {
                required: true,
            },
            txt_dir_epsa_s: {
                required: true,
            },
            cmb_dep: {
                required: true,
            },
            cmb_mun: {
                required: true,
            },
            cmb_p_concretado: {
                required: true,
            },
            txt_p_muestreo: {
                required: true,
            },
            txt_dir_p_muestreo: {
                required: true,
            },
            txt_fuente_p_muestreo: {
                required: true,
            },
            cmb_tipo_muestra: {
                required: true,
            },
            cmb_epsa_acompanante: {
                required: true,
            },
            cmb_tipo_analisis: {
                required: true,
            },
            cmb_objeto_analisis: {
                required: true,
            },
            txt_temp: {
                required: true,
                number: true,
            },
            txt_color: {
                required: true,
            },
            txt_clrl: {
                required: true,
                number: true,
            },
            txt_ppm: {
                required: true,
                number: true,
            },
            txt_aspecto: {
                required: true,
            },
            txt_ph: {
                required: true,
                number: true,
            },
            cmb_muestra: {
                required: true,
            },
            txt_codigo_p_muestreo: {
                required: true,
            }
        },
        submitHandler: function () {

            var txt_otro_tipo_muestra = $('#txt_otro_tipo_muestra').val();
            var txt_acomp_epsa = $('#txt_acomp_epsa').val();
            var txt_acomp_cargo = $('#txt_acomp_cargo').val();
            var txt_otro_tipo_analisis = $('#txt_otro_tipo_analisis').val();
            var txt_otro_objeto_analisis = $('#txt_otro_objeto_analisis').val();

            if ($('#txt_otro_tipo_muestra').is(':visible')) {
                txt_otro_tipo_muestra = txt_otro_tipo_muestra.length > 0 ? $('#txt_otro_tipo_muestra').val() : "-1";
                txt_otro_tipo_muestra === "-1" ? $('#txt_otro_tipo_muestra').addClass("error") : '';
            }
            if ($('#txt_acomp_epsa').is(':visible')) {
                txt_acomp_epsa = txt_acomp_epsa.length > 0 ? $('#txt_acomp_epsa').val() : "-1";
                txt_acomp_epsa === "-1" ? $('#txt_acomp_epsa').addClass("error") : '';
            }
            if ($('#txt_acomp_cargo').is(':visible')) {
                txt_acomp_cargo = txt_acomp_cargo.length > 0 ? $('#txt_acomp_cargo').val() : "-1";
                txt_acomp_cargo === "-1" ? $('#txt_acomp_cargo').addClass("error") : '';
            }
            if ($('#txt_otro_tipo_analisis').is(':visible')) {
                txt_otro_tipo_analisis = txt_otro_tipo_analisis.length > 0 ? $('#txt_otro_tipo_analisis').val() : "-1";
                txt_otro_tipo_analisis === "-1" ? $('#txt_otro_tipo_analisis').addClass("error") : '';
            }
            if ($('#txt_otro_objeto_analisis').is(':visible')) {
                txt_otro_objeto_analisis = txt_otro_objeto_analisis.length > 0 ? $('#txt_otro_objeto_analisis').val() : "-1";
                txt_otro_objeto_analisis === "-1" ? $('#txt_otro_objeto_analisis').addClass("error") : '';
            }

            if (txt_otro_tipo_muestra === "-1" || txt_acomp_epsa === "-1" || txt_acomp_cargo === "-1" || txt_otro_tipo_analisis === "-1" || txt_otro_objeto_analisis === "-1") {
                mensajeError('Los campos en color rojo son obligatorios');
            } else {
                modalConfirmarGuardar("¿Realmente desea enviar la muestra?", "guardarMuestra()");
            }
        },
    });
}

function guardarMuestra() {

    var txtSolicitante = $("#txtSolicitante").val();
    var txt_tel_s = $("#txt_tel_s").val();
    var txt_dir_s = $("#txt_dir_s").val();
    var txt_fecha_toma = $("#txt_fecha_toma").val();
    var txt_hora_toma = $("#txt_hora_toma").val();
    var txt_min_toma = $("#txt_min_toma").val();
    var cmb_periodo_toma = $("#cmb_periodo_toma").val();
    var txt_epsa_s = $("#txt_epsa_s").val();
    var cmb_dep = $("#cmb_dep").val();
    var cmb_mun = $("#cmb_mun").val();
    var txt_vereda = $("#txt_vereda").val();
    var cmb_p_concretado = $("#cmb_p_concretado").val();
    var txt_p_muestreo = $("#txt_p_muestreo").val();
    var txt_dir_p_muestreo = $("#txt_dir_p_muestreo").val();
    var txt_fuente_p_muestreo = $("#txt_fuente_p_muestreo").val();
    var cmb_epsa_acompanante = $("#cmb_epsa_acompanante").val();
    var cmb_tipo_analisis = $("#cmb_tipo_analisis").val();
    var cmb_objeto_analisis = $("#cmb_objeto_analisis").val();
    var txt_temp = $("#txt_temp").val();
    var txt_color = $("#txt_color").val();
    var txt_clrl = $("#txt_clrl").val();
    var txt_ppm = $("#txt_ppm").val();
    var txt_aspecto = $("#txt_aspecto").val();
    var txt_ph = $("#txt_ph").val();
    var txt_otros_analisis = $("#txt_otros_analisis").val();
    var cmb_muestra = $("#cmb_muestra").val();
    var txt_codigo_p_muestreo = $("#txt_codigo_p_muestreo").val();
    var cmb_tipo_muestra = $("#cmb_tipo_muestra").val();
    var txt_dir_epsa_s = $("#txt_dir_epsa_s").val();
    var txt_observaciones_analisis = $("#txt_observaciones_analisis").val();

    var txt_otro_tipo_muestra = $('#txt_otro_tipo_muestra').val();
    var txt_acomp_epsa = $('#txt_acomp_epsa').val();
    var txt_acomp_cargo = $('#txt_acomp_cargo').val();
    var txt_otro_tipo_analisis = $('#txt_otro_tipo_analisis').val();
    var txt_otro_objeto_analisis = $('#txt_otro_objeto_analisis').val();

    var params = 'opcion=4&txtSolicitante=' + txtSolicitante + '&txt_tel_s=' + txt_tel_s + '&txt_dir_s=' + txt_dir_s + '&txt_fecha_toma=' + txt_fecha_toma
            + '&txt_hora_toma=' + txt_hora_toma + '&txt_min_toma=' + txt_min_toma + '&cmb_periodo_toma=' + cmb_periodo_toma + '&txt_epsa_s=' + txt_epsa_s
            + '&cmb_dep=' + cmb_dep + '&cmb_mun=' + cmb_mun + '&txt_vereda=' + txt_vereda + '&cmb_p_concretado=' + cmb_p_concretado + '&txt_p_muestreo=' + txt_p_muestreo
            + '&txt_dir_p_muestreo=' + txt_dir_p_muestreo + '&txt_fuente_p_muestreo=' + txt_fuente_p_muestreo + '&cmb_epsa_acompanante=' + cmb_epsa_acompanante
            + '&cmb_tipo_analisis=' + cmb_tipo_analisis + '&cmb_objeto_analisis=' + cmb_objeto_analisis + '&txt_temp=' + txt_temp + '&txt_color=' + txt_color
            + '&txt_clrl=' + txt_clrl + '&txt_ppm=' + txt_ppm + '&txt_aspecto=' + txt_aspecto + '&txt_ph=' + txt_ph + '&txt_otros_analisis=' + txt_otros_analisis
            + '&cmb_muestra=' + cmb_muestra + '&txt_otro_tipo_muestra=' + txt_otro_tipo_muestra + '&txt_acomp_epsa=' + txt_acomp_epsa + '&txt_acomp_cargo=' + txt_acomp_cargo
            + '&txt_otro_tipo_analisis=' + txt_otro_tipo_analisis + '&txt_otro_objeto_analisis=' + txt_otro_objeto_analisis + '&txt_codigo_p_muestreo=' + txt_codigo_p_muestreo
            + '&cmb_tipo_muestra=' + cmb_tipo_muestra + '&txt_dir_epsa_s=' + txt_dir_epsa_s + '&txt_observaciones_analisis=' + txt_observaciones_analisis;

    llamarAjax("calidad_agua_ajax.php", params, "hdd_resultado", "verifica_guardar();");
}

function modalConfirmarGuardar(titulo, funcion) {
    var params = 'opcion=5&titulo=' + titulo + '&funcion=' + funcion;
    llamarAjax("calidad_agua_ajax.php", params, "ventanaModal", "mostrarVentana();");
}

function mostrarVentana() {
    $('#myModal').modal();
}

function verifica_guardar() {
    var hdd_exito = $('#hdd_resultado').text();
    if (hdd_exito > 0) {
        mensajeExitoso('La muestra ha sido enviada');
        imprimir_reporte_muestra();
        setTimeout(
                function () {
                    listar_actas();
                }, 3000);

    }
    else {
        mensajeError('Error al intentar enviar la muestra, notifique del error al administrador del sistema');
    }
}

function imprimir_reporte_muestra() {
    var codMuestra = $('#hdd_resultado').text();
    var params = "opcion=1&codMuestra=" + codMuestra;
    //var params = "opcion=1&codMuestra=1";
    llamarAjax("generar_reporte_ajax.php", params, "hdd_imprimir_reporte", "mostrar_reporte();");
}

function mostrar_reporte() {
    var cont_aux = 0;
    var ruta = $("#hdd_ruta_arch_pdf").val();
    window.open("../funciones/abrir_pdf.php?ruta=" + ruta + "&nombre_arch=acta_muestra_agua_" + 1 + ".pdf", "_blank");
}

function generar_reporte_muestra(codMuestra) {
    var params = "opcion=1&codMuestra=" + codMuestra;
    llamarAjax("generar_reporte_ajax.php", params, "hdd_imprimir_reporte", "mostrar_reporte();");
}
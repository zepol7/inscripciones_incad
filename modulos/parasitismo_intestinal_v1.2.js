$(document).ready(function () {
    //listar_envios();
});

function listar_envios() {
    var params = 'opcion=9';
    llamarAjax("parasitismo_intestinal_ajax.php", params, "principal_parasitismoIntestinakl", "");
}

function getMunicipios() {
    var cod_dep = $("#cmb_departamento").val();
    var params = 'opcion=1&cod_dep=' + cod_dep;
    llamarAjax("parasitismo_intestinal_ajax.php", params, "cmb_municipio", "");
}

function modalAgregarOtroParasito() {
    var params = 'opcion=2';
    llamarAjax("parasitismo_intestinal_ajax.php", params, "ventanaModal", "mostrarVentana();");
}

function mostrarVentana() {
    $('#modalAgregarOtroParasito').modal();
}

function buscarLaboratorios() {
    var params = 'opcion=3';
    llamarAjax("parasitismo_intestinal_ajax.php", params, "rtaLaboratorios", "");
}

/*Crear acta de muestra*/
function validaEnviarResultado() {
    $("#frmParasitismoIntestinal").validate({
        submitHandler: function () {

            //Segunda validación - Número de muestras analizadas
            var parasitosTotal = parseInt($("#txt_par_muestras_analizadas").val(), 10);
            var parasitosPositivos = parseInt($("#txt_par_muestras_positivas_analizadas").val(), 10);

            if (parasitosPositivos > parasitosTotal) {
                mensajeError('Error, el número de muestras positivas anaizadas no puede ser mayor al número de muestras analizadas');
                $('#txt_par_muestras_analizadas').addClass("error");
                $('#txt_par_muestras_positivas_analizadas').addClass("error");
            } else {

                //Tercera validación
                /*TABLA: PARÁSITOS*/
                var filas = $('#tblParasitos tr').length;
                var validadorExterno = true;
                var cuentaParasitos = 0;
                for (var i = 3; i <= (filas - 1); i++) {
                    var idFila = $('#tblParasitos tr:eq(' + i + ')').attr('id');
                    //Comprueba los campos
                    var mA = $('#' + idFila + '_m_1').val(); //Mujer 0-5
                    var mB = $('#' + idFila + '_m_2').val(); //Mujer 6-15
                    var mC = $('#' + idFila + '_m_3').val(); //Mujer 16-20
                    var mD = $('#' + idFila + '_m_4').val(); //Mujer 21-60
                    var mE = $('#' + idFila + '_m_5').val(); //Mujer >60
                    var hA = $('#' + idFila + '_h_1').val(); //Hombre 0-5
                    var hB = $('#' + idFila + '_h_2').val(); //Hombre 6-15
                    var hC = $('#' + idFila + '_h_3').val(); //Hombre 16-20
                    var hD = $('#' + idFila + '_h_4').val(); //Hombre 21-60
                    var hE = $('#' + idFila + '_h_5').val(); //Hombre >60

                    //Suma parásitos, agrego la condicion  || 0 porque si no arroja excepción con valor NaN
                    cuentaParasitos += ((parseInt(mA) || 0) + (parseInt(mB) || 0) + (parseInt(mC) || 0) + (parseInt(mD) || 0) + (parseInt(mE) || 0) + (parseInt(hA) || 0) + (parseInt(hB) || 0) + (parseInt(hC) || 0) + (parseInt(hD) || 0) + (parseInt(hE) || 0));

                    var validadorInterno = true;
                    if (mA.length >= 1 && mB.length >= 1 && mC.length >= 1 && mD.length >= 1 && mE.length >= 1 && hA.length >= 1 && hB.length >= 1 && hC.length >= 1 && hD.length >= 1 && hE.length >= 1) {
                    } else {
                        if (mA.length == 0 && mB.length == 0 && mC.length == 0 && mD.length == 0 && mE.length == 0 && hA.length == 0 && hB.length == 0 && hC.length == 0 && hD.length == 0 && hE.length == 0) {
                        } else {
                            validadorInterno = false;
                            validadorExterno = false;
                        }
                    }
                    //Asigna clase de error a los input
                    if (!validadorInterno) {
                        $('#' + idFila + '_m_1').addClass("error"); //Mujer 0-5
                        $('#' + idFila + '_m_2').addClass("error"); //Mujer 6-15
                        $('#' + idFila + '_m_3').addClass("error"); //Mujer 16-20
                        $('#' + idFila + '_m_4').addClass("error"); //Mujer 21-60
                        $('#' + idFila + '_m_5').addClass("error"); //Mujer >60
                        $('#' + idFila + '_h_1').addClass("error"); //Hombre 0-5
                        $('#' + idFila + '_h_2').addClass("error"); //Hombre 6-15
                        $('#' + idFila + '_h_3').addClass("error"); //Hombre 16-20
                        $('#' + idFila + '_h_4').addClass("error"); //Hombre 21-60
                        $('#' + idFila + '_h_5').addClass("error"); //Hombre >60
                    }
                }

                /*TABLA OTROS PARÁSITOS*/
                var filasOtrosP = $('#tblOtrosParasitos tr').length;//Verifica que esté visible
                if (filasOtrosP > 3) {
                    var cuentaOtroParasito = 1;
                    var idOtroParasito = $('#hddParasitosOtro').val();
                    for (var i = 3; i <= (filasOtrosP - 1); i++) {//Obtiene los parásitos
                        var idFila = $('#tblOtrosParasitos tr:eq(' + i + ')').attr('id');

                        var nombre = $('#' + idFila + '_otro_p').text(); //Mujer 0-5
                        var mA = $('#' + idFila + '_otro_p_m1').text(); //Mujer 0-5
                        var mB = $('#' + idFila + '_otro_p_m2').text(); //Mujer 6-15
                        var mC = $('#' + idFila + '_otro_p_m3').text(); //Mujer 16-20
                        var mD = $('#' + idFila + '_otro_p_m4').text(); //Mujer 21-60
                        var mE = $('#' + idFila + '_otro_p_m5').text(); //Mujer >60
                        var hA = $('#' + idFila + '_otro_p_h1').text(); //Hombre 0-5
                        var hB = $('#' + idFila + '_otro_p_h2').text(); //Hombre 6-15
                        var hC = $('#' + idFila + '_otro_p_h3').text(); //Hombre 16-20
                        var hD = $('#' + idFila + '_otro_p_h4').text(); //Hombre 21-60
                        var hE = $('#' + idFila + '_otro_p_h5').text(); //Hombre >60

                        cuentaParasitos += ((parseInt(mA) || 0) + (parseInt(mB) || 0) + (parseInt(mC) || 0) + (parseInt(mD) || 0) + (parseInt(mE) || 0) + (parseInt(hA) || 0) + (parseInt(hB) || 0) + (parseInt(hC) || 0) + (parseInt(hD) || 0) + (parseInt(hE) || 0));
                    }
                }

                //Verifica si es necesario validar Bacterias
                var nivLab = $('#hddNivLab').val();
                if (nivLab == 3) {
                    //Cuarta validación
                    var coproTotal = parseInt($("#txt_copro_total").val(), 10);
                    var coproPositivo = parseInt($("#txt_copro_positivo").val(), 10);

                    if (coproPositivo > coproTotal) {
                        mensajeError('Error, el número de muestras positivas anaizadas de coprocultivo no puede ser mayor al número de muestras analizadas de coprocultivo');
                        $('#txt_par_muestras_analizadas').addClass("error");
                        $('#txt_par_muestras_positivas_analizadas').addClass("error");
                    } else {
                        var filas = $('#tblBacterias tr').length;
                        var cuentaBacterias = 0;
                        for (var i = 3; i <= (filas - 1); i++) {

                            var idFila = $('#tblBacterias tr:eq(' + i + ')').attr('id');
                            //Comprueba los campos
                            var bmA = $('#' + idFila + '_b_m_1').val(); //Mujer 0-5
                            var bmB = $('#' + idFila + '_b_m_2').val(); //Mujer 6-15
                            var bmC = $('#' + idFila + '_b_m_3').val(); //Mujer 16-20
                            var bmD = $('#' + idFila + '_b_m_4').val(); //Mujer 21-60
                            var bmE = $('#' + idFila + '_b_m_5').val(); //Mujer >60
                            var bhA = $('#' + idFila + '_b_h_1').val(); //Hombre 0-5
                            var bhB = $('#' + idFila + '_b_h_2').val(); //Hombre 6-15
                            var bhC = $('#' + idFila + '_b_h_3').val(); //Hombre 16-20
                            var bhD = $('#' + idFila + '_b_h_4').val(); //Hombre 21-60
                            var bhE = $('#' + idFila + '_b_h_5').val(); //Hombre >60

                            //Suma parásitos, agrego la condicion  || 0 porque si no arroja excepción con valor NaN
                            cuentaBacterias += ((parseInt(bmA) || 0) + (parseInt(bmB) || 0) + (parseInt(bmC) || 0) + (parseInt(bmD) || 0) + (parseInt(bmE) || 0) + (parseInt(bhA) || 0) + (parseInt(bhB) || 0) + (parseInt(bhC) || 0) + (parseInt(bhD) || 0) + (parseInt(bhE) || 0));

                            var validadorInterno2 = true;
                            if (bmA.length >= 1 && bmB.length >= 1 && bmC.length >= 1 && bmD.length >= 1 && bmE.length >= 1 && bhA.length >= 1 && bhB.length >= 1 && bhC.length >= 1 && bhD.length >= 1 && bhE.length >= 1) {
                            } else {
                                if (bmA.length == 0 && bmB.length == 0 && bmC.length == 0 && bmD.length == 0 && bmE.length == 0 && bhA.length == 0 && bhB.length == 0 && bhC.length == 0 && bhD.length == 0 && bhE.length == 0) {
                                } else {
                                    validadorInterno2 = false;
                                    validadorExterno = false;
                                }
                            }
                            //Asigna clase de error a los input
                            if (!validadorInterno2) {
                                $('#' + idFila + '_b_m_1').addClass("error"); //Mujer 0-5
                                $('#' + idFila + '_b_m_2').addClass("error"); //Mujer 6-15
                                $('#' + idFila + '_b_m_3').addClass("error"); //Mujer 16-20
                                $('#' + idFila + '_b_m_4').addClass("error"); //Mujer 21-60
                                $('#' + idFila + '_b_m_5').addClass("error"); //Mujer >60
                                $('#' + idFila + '_b_h_1').addClass("error"); //Hombre 0-5
                                $('#' + idFila + '_b_h_2').addClass("error"); //Hombre 6-15
                                $('#' + idFila + '_b_h_3').addClass("error"); //Hombre 16-20
                                $('#' + idFila + '_b_h_4').addClass("error"); //Hombre 21-60
                                $('#' + idFila + '_b_h_5').addClass("error"); //Hombre >60
                            }
                        }

                        /*TABLA OTRAS BACTERIAS*/
                        var filasOtrosP = $('#tblOtrasBacterias tr').length;//Verifica que esté visible
                        if (filasOtrosP > 3) {
                            var cuentaOtroParasito = 1;
                            var idOtroParasito = $('#tblOtrasBacterias').val();
                            for (var i = 3; i <= (filasOtrosP - 1); i++) {//Obtiene los parásitos
                                var idFila = $('#tblOtrasBacterias tr:eq(' + i + ')').attr('id');

                                var nombre = $('#' + idFila + '_otro_b').text(); //Mujer 0-5
                                var mA = $('#' + idFila + '_otro_b_m1').text(); //Mujer 0-5
                                var mB = $('#' + idFila + '_otro_b_m2').text(); //Mujer 6-15
                                var mC = $('#' + idFila + '_otro_b_m3').text(); //Mujer 16-20
                                var mD = $('#' + idFila + '_otro_b_m4').text(); //Mujer 21-60
                                var mE = $('#' + idFila + '_otro_b_m5').text(); //Mujer >60
                                var hA = $('#' + idFila + '_otro_b_h1').text(); //Hombre 0-5
                                var hB = $('#' + idFila + '_otro_b_h2').text(); //Hombre 6-15
                                var hC = $('#' + idFila + '_otro_b_h3').text(); //Hombre 16-20
                                var hD = $('#' + idFila + '_otro_b_h4').text(); //Hombre 21-60
                                var hE = $('#' + idFila + '_otro_b_h5').text(); //Hombre >60

                                cuentaBacterias += ((parseInt(mA) || 0) + (parseInt(mB) || 0) + (parseInt(mC) || 0) + (parseInt(mD) || 0) + (parseInt(mE) || 0) + (parseInt(hA) || 0) + (parseInt(hB) || 0) + (parseInt(hC) || 0) + (parseInt(hD) || 0) + (parseInt(hE) || 0));
                            }
                        }

                    }
                }

                //Mensaje de error validación 3
                if (!validadorExterno) {
                    mensajeError('Error, debe ingresar valores en los campos señalados con color rojo');
                    return;
                }

                //Mensaje de error, validación 3 Parásitos
                if (cuentaParasitos < parasitosPositivos) {
                    mensajeError('Error, el número de muestras positivas ingresadas en la tabla de PARÁSITOS es menor al número de muestras positivas analizadas');
                    //mensajeError('Error, el número de muestras positivas ingresadas en la tabla de PARÁSITOS es menor al número de muestras positivas analizadas');
                    validadorExterno = false;
                    return;
                }

                //Mensaje de error, validación 4 Bacterias
                if (cuentaBacterias < coproPositivo) {
                    mensajeError('Error, el número de coprocultivos positivos ingresados en la tabla de BACTERIAS es menor al número de coprocultivos positivos');
                    validadorExterno = false;
                    return;
                }

                //////////////////////////////////////////////////////
                //--valida la continuidad para enviar los resultados--
                //////////////////////////////////////////////////////
                if (validadorExterno) {

                    modalConfirmarGuardar("¿Realmente desea enviar los resultados?", "enviar()");


                }

            }

        },
    });
}

function enviar() {
    var nivLab = $('#hddNivLab').val();
    var totalParasitos = 0;
    var totalOtrosParasitos = 0;
    var totalBacterias = 0;
    var totalOtrasBacterias = 0;
    var coproTotal = (parseInt($("#txt_copro_total").val(), 10) || 0);
    var coproPositivo = (parseInt($("#txt_copro_positivo").val(), 10) || 0);
    var parasitosTotal = parseInt($("#txt_par_muestras_analizadas").val(), 10);
    var parasitosPositivos = parseInt($("#txt_par_muestras_positivas_analizadas").val(), 10);

    var params = 'opcion=8&';
    //Obtener datos de la tabla parásitos
    var filas = $('#tblParasitos tr').length;
    var cuentaParasitos2 = 0;
    for (var i = 3; i <= (filas - 1); i++) {
        var idFila = $('#tblParasitos tr:eq(' + i + ')').attr('id');
        //Comprueba los campos
        var mA = $('#' + idFila + '_m_1').val(); //Mujer 0-5
        var mB = $('#' + idFila + '_m_2').val(); //Mujer 6-15
        var mC = $('#' + idFila + '_m_3').val(); //Mujer 16-20
        var mD = $('#' + idFila + '_m_4').val(); //Mujer 21-60
        var mE = $('#' + idFila + '_m_5').val(); //Mujer >60
        var hA = $('#' + idFila + '_h_1').val(); //Hombre 0-5
        var hB = $('#' + idFila + '_h_2').val(); //Hombre 6-15
        var hC = $('#' + idFila + '_h_3').val(); //Hombre 16-20
        var hD = $('#' + idFila + '_h_4').val(); //Hombre 21-60
        var hE = $('#' + idFila + '_h_5').val(); //Hombre >60

        //Valida si hay datos
        var cuentaValores = ((parseInt(mA) || 0) + (parseInt(mB) || 0) + (parseInt(mC) || 0) + (parseInt(mD) || 0) + (parseInt(mE) || 0) + (parseInt(hA) || 0) + (parseInt(hB) || 0) + (parseInt(hC) || 0) + (parseInt(hD) || 0) + (parseInt(hE) || 0));
        if (cuentaValores > 0) {
            cuentaParasitos2++;//Lleva la cuenta de los parásitos con valores
            //Guarda en params
            params += '&parasito' + cuentaParasitos2 + '=' + idFila + ':' + mA + ':' + mB + ':' + mC + ':' + mD + ':' + mE + '|' + idFila + ':' + hA + ':' + hB + ':' + hC + ':' + hD + ':' + hE;
        }
    }
    totalParasitos = cuentaParasitos2;//Variable global del total de parasitos

    //Verifica la existencia de otros parásitos agregados
    var filasOtrosP = $('#tblOtrosParasitos tr').length;
    if (filasOtrosP > 3) {
        var cuentaOtroParasito = 0;
        var idOtroParasito = $('#hddParasitosOtro').val();
        for (var i = 3; i <= (filasOtrosP - 1); i++) {//Obtiene los parásitos
            cuentaOtroParasito++;
            var idFila = $('#tblOtrosParasitos tr:eq(' + i + ')').attr('id');

            var nombre = $('#' + idFila + '_otro_p').text(); //Mujer 0-5
            var mA = $('#' + idFila + '_otro_p_m1').text(); //Mujer 0-5
            var mB = $('#' + idFila + '_otro_p_m2').text(); //Mujer 6-15
            var mC = $('#' + idFila + '_otro_p_m3').text(); //Mujer 16-20
            var mD = $('#' + idFila + '_otro_p_m4').text(); //Mujer 21-60
            var mE = $('#' + idFila + '_otro_p_m5').text(); //Mujer >60
            var hA = $('#' + idFila + '_otro_p_h1').text(); //Hombre 0-5
            var hB = $('#' + idFila + '_otro_p_h2').text(); //Hombre 6-15
            var hC = $('#' + idFila + '_otro_p_h3').text(); //Hombre 16-20
            var hD = $('#' + idFila + '_otro_p_h4').text(); //Hombre 21-60
            var hE = $('#' + idFila + '_otro_p_h5').text(); //Hombre >60

            params += '&parasitoOtro' + cuentaOtroParasito + '=' + idOtroParasito + ':' + mA + ':' + mB + ':' + mC + ':' + mD + ':' + mE + ':' + nombre + '|' + idOtroParasito + ':' + hA + ':' + hB + ':' + hC + ':' + hD + ':' + hE + ':' + nombre;//Se añane del nombre del parásito 

            //cuentaParasitos += ((parseInt(mA) || 0) + (parseInt(mB) || 0) + (parseInt(mC) || 0) + (parseInt(mD) || 0) + (parseInt(mE) || 0) + (parseInt(hA) || 0) + (parseInt(hB) || 0) + (parseInt(hC) || 0) + (parseInt(hD) || 0) + (parseInt(hE) || 0));
        }
        totalOtrosParasitos = cuentaOtroParasito;//Variable global del total de otros parasitos
    }

    //Verifica si es necesario obtener datos de Bacterias
    if (nivLab == 3) {
        //Obtener datos de la tabla bacterias
        var filas = $('#tblBacterias tr').length;
        var cuentaBacterias = 0;
        for (var i = 3; i <= (filas - 1); i++) {
            var idFila = $('#tblBacterias tr:eq(' + i + ')').attr('id');
            //Comprueba los campos
            var bmA = $('#' + idFila + '_b_m_1').val(); //Mujer 0-5
            var bmB = $('#' + idFila + '_b_m_2').val(); //Mujer 6-15
            var bmC = $('#' + idFila + '_b_m_3').val(); //Mujer 16-20
            var bmD = $('#' + idFila + '_b_m_4').val(); //Mujer 21-60
            var bmE = $('#' + idFila + '_b_m_5').val(); //Mujer >60
            var bhA = $('#' + idFila + '_b_h_1').val(); //Hombre 0-5
            var bhB = $('#' + idFila + '_b_h_2').val(); //Hombre 6-15
            var bhC = $('#' + idFila + '_b_h_3').val(); //Hombre 16-20
            var bhD = $('#' + idFila + '_b_h_4').val(); //Hombre 21-60
            var bhE = $('#' + idFila + '_b_h_5').val(); //Hombre >60

            //Valida si hay datos
            var cuentaValores = ((parseInt(bmA) || 0) + (parseInt(bmB) || 0) + (parseInt(bmC) || 0) + (parseInt(bmD) || 0) + (parseInt(bmE) || 0) + (parseInt(bhA) || 0) + (parseInt(bhB) || 0) + (parseInt(bhC) || 0) + (parseInt(bhD) || 0) + (parseInt(bhE) || 0));
            if (cuentaValores > 0) {
                cuentaBacterias++;//Lleva la cuenta de los parásitos con valores
                //Guarda en params
                params += '&bacteria' + cuentaBacterias + '=' + idFila + ':' + bmA + ':' + bmB + ':' + bmC + ':' + bmD + ':' + bmE + '|' + idFila + ':' + bhA + ':' + bhB + ':' + bhC + ':' + bhD + ':' + bhE;
            }
        }
        totalBacterias = cuentaBacterias;//Variable global del total de bacterias

        //Verifica la existencia de otras bacterias agregadas
        var filasOtrosP = $('#tblOtrasBacterias tr').length;
        if (filasOtrosP > 3) {
            var cuentaOtraBacteria = 0;
            var idOtraBacteria = $('#hddBacteriasOtro').val();
            for (var i = 3; i <= (filasOtrosP - 1); i++) {//Obtiene los parásitos
                cuentaOtraBacteria++;
                var idFila = $('#tblOtrasBacterias tr:eq(' + i + ')').attr('id');


                var nombre = $('#' + idFila + '_otro_b').text(); //Mujer 0-5
                var mA = $('#' + idFila + '_otro_b_m1').text(); //Mujer 0-5
                var mB = $('#' + idFila + '_otro_b_m2').text(); //Mujer 6-15
                var mC = $('#' + idFila + '_otro_b_m3').text(); //Mujer 16-20
                var mD = $('#' + idFila + '_otro_b_m4').text(); //Mujer 21-60
                var mE = $('#' + idFila + '_otro_b_m5').text(); //Mujer >60
                var hA = $('#' + idFila + '_otro_b_h1').text(); //Hombre 0-5
                var hB = $('#' + idFila + '_otro_b_h2').text(); //Hombre 6-15
                var hC = $('#' + idFila + '_otro_b_h3').text(); //Hombre 16-20
                var hD = $('#' + idFila + '_otro_b_h4').text(); //Hombre 21-60
                var hE = $('#' + idFila + '_otro_b_h5').text(); //Hombre >60

                params += '&bacteriaOtro' + cuentaOtraBacteria + '=' + idOtraBacteria + ':' + mA + ':' + mB + ':' + mC + ':' + mD + ':' + mE + ':' + nombre + '|' + idOtraBacteria + ':' + hA + ':' + hB + ':' + hC + ':' + hD + ':' + hE + ':' + nombre;//Se añane del nombre del parásito

            }
            totalOtrasBacterias = cuentaOtraBacteria;//Variable global del total de otras bacterias
        }
    }

    /*Procesa las otras variables*/
    var mesN = $("#cmb_mes_n").val();
    var yearN = $("#cmb_year_n").val();
    var munP = $("#cmb_mun_p").val();
    var codLab = $("#hddCodLab").val();

    params += '&mesN=' + mesN + '&yearN=' + yearN + '&parasitosTotal=' + parasitosTotal + '&parasitosPositivos=' + parasitosPositivos +
            '&coproTotal=' + coproTotal + '&coproPositivo=' + coproPositivo + '&totalParasitos=' + totalParasitos + '&totalOtrosParasitos=' + totalOtrosParasitos +
            '&totalBacterias=' + totalBacterias + '&totalOtrasBacterias=' + totalOtrasBacterias + '&codLab=' + codLab + '&munP=' + munP;

    llamarAjax("parasitismo_intestinal_ajax.php", params, "hddResultado", "validarEnvio();", 1, "divBarraProgreso");
}


function validarEnvio() {
    var hdd_resultado = $('#hddResultado').text();
    if (parseInt(hdd_resultado) > 0) {
        mensajeExitoso('la información se ha enviado!');
        listar_envios();
    }
    else {
        mensajeError('Error al intentar enviar la información, notifique del error al administrador del sistema');
    }
}

function modalConfirmarGuardar(titulo, funcion) {
    var params = 'opcion=3&titulo=' + titulo + '&funcion=' + funcion;
    llamarAjax("parasitismo_intestinal_ajax.php", params, "ventanaModal", "mostrarModalConfirmacion();");
}

function mostrarModalConfirmacion() {
    $('#modalConfirmacion').modal();
}

function agregarOtrosParasitos() {
    var show = $('#divOtrosParasitos').is(':visible');
    if (!show) {
        $('#divOtrosParasitos').removeClass("hidden"); //Muestra el panel
        modalAgregarOtroParasito(); //Muestra panel flotante
    } else {
        modalAgregarOtroParasito(); //Muestra panel flotante
    }
}

function agregarOtroParasito() {
    $("#frmOtroParasito").validate({
        submitHandler: function () {
            var filas = $('#tblOtrosParasitos tr').length;

            //Procesa el id del registro
            var idOtroParasito = (filas - 3);
            if (filas == 2) {
                idOtroParasito = 1;
            } else {
                idOtroParasito = (filas - 3);
            }

            var nombreParasito = $('#txt_otro_nombre_para').val();
            var m1 = $('#txt_otro_m_1').val();
            var m2 = $('#txt_otro_m_2').val();
            var m3 = $('#txt_otro_m_3').val();
            var m4 = $('#txt_otro_m_4').val();
            var m5 = $('#txt_otro_m_5').val();
            var h1 = $('#txt_otro_h_1').val();
            var h2 = $('#txt_otro_h_2').val();
            var h3 = $('#txt_otro_h_3').val();
            var h4 = $('#txt_otro_h_4').val();
            var h5 = $('#txt_otro_h_5').val();

            $('#tblOtrosParasitos tr:eq(2)').after('<tr id="' + idOtroParasito + '">' +
                    '<td style="width:5%;"><span id="' + idOtroParasito + '_otro_p">' + nombreParasito + '<span></th>' +
                    '<td style="width:25%;">' +
                    '<div class="row">' +
                    '<div class="col-md-2 centrar"><span id="' + idOtroParasito + '_otro_p_m1">' + m1 + '<span></div>' +
                    '<div class="col-md-2 centrar"><span id="' + idOtroParasito + '_otro_p_m2">' + m2 + '<span></div>' +
                    '<div class="col-md-2 centrar"><span id="' + idOtroParasito + '_otro_p_m3">' + m3 + '<span></div>' +
                    '<div class="col-md-2 centrar"><span id="' + idOtroParasito + '_otro_p_m4">' + m4 + '<span></div>' +
                    '<div class="col-md-2 centrar"><span id="' + idOtroParasito + '_otro_p_m5">' + m5 + '<span></div>' +
                    '</div>' +
                    '</td>' +
                    '<td style="width:25%;">' +
                    '<div class="row">' +
                    '<div class="col-md-2 centrar"><span id="' + idOtroParasito + '_otro_p_h1">' + h1 + '<span></div>' +
                    '<div class="col-md-2 centrar"><span id="' + idOtroParasito + '_otro_p_h2">' + h2 + '<span></div>' +
                    '<div class="col-md-2 centrar"><span id="' + idOtroParasito + '_otro_p_h3">' + h3 + '<span></div>' +
                    '<div class="col-md-2 centrar"><span id="' + idOtroParasito + '_otro_p_h4">' + h4 + '<span></div>' +
                    '<div class="col-md-2 centrar"><span id="' + idOtroParasito + '_otro_p_h5">' + h5 + '<span></div>' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<button type="button" class="btn btn-danger glyphicon glyphicon-remove" onclick="eliminarOtroParasito(\'' + idOtroParasito + '\');"></button>' +
                    '</td>' +
                    '</tr>');
            $('#modalAgregarOtroParasito').modal('hide');
        },
    });
}

function eliminarOtroParasito(idOtroParasito) {
    $('#divOtrosParasitos #' + idOtroParasito).remove();

    var filas = $('#tblOtrosParasitos tr').length;

    if (filas == 3) {
        $('#divOtrosParasitos').addClass("hidden"); //Muestra el panel
    }
}

function crearFicha() {
    var params = 'opcion=4';
    llamarAjax("parasitismo_intestinal_ajax.php", params, "principal_parasitismoIntestinakl", "cargaFicha();");
}

function infoLab() {
    var codLab = $("#cmb_lab").val();
    var params = 'opcion=5&codLab=' + codLab;
    llamarAjax("parasitismo_intestinal_ajax.php", params, "infoLab", "cargaFicha()");
}


function modalAgregarOtraBacteria() {
    var params = 'opcion=6';
    llamarAjax("parasitismo_intestinal_ajax.php", params, "ventanaModal", "mostrarVentanaOtrasBacterias();");
}

function mostrarVentanaOtrasBacterias() {
    $('#modalAgregarOtraBacteria').modal();
}

function agregarOtrasBacterias() {
    var show = $('#divOtrasBacterias').is(':visible');
    if (!show) {
        $('#divOtrasBacterias').removeClass("hidden"); //Muestra el panel
        modalAgregarOtraBacteria(); //Muestra panel flotante
    } else {
        modalAgregarOtraBacteria(); //Muestra panel flotante
    }
}

function agregarOtraBacteria() {
    $("#frmOtraBacteria").validate({
        submitHandler: function () {
            var filas = $('#tblOtrasBacterias tr').length;

            //Procesa el id del registro
            var idOtraBacteria = (filas - 3);
            if (filas == 2) {
                idOtraBacteria = 1;
            } else {
                idOtraBacteria = (filas - 3);
            }

            var nombreBacteria = $('#txt_otro_b_nombre_para').val();
            var m1 = $('#txt_otro_b_m_1').val();
            var m2 = $('#txt_otro_b_m_2').val();
            var m3 = $('#txt_otro_b_m_3').val();
            var m4 = $('#txt_otro_b_m_4').val();
            var m5 = $('#txt_otro_b_m_5').val();
            var h1 = $('#txt_otro_b_h_1').val();
            var h2 = $('#txt_otro_b_h_2').val();
            var h3 = $('#txt_otro_b_h_3').val();
            var h4 = $('#txt_otro_b_h_4').val();
            var h5 = $('#txt_otro_b_h_5').val();

            $('#tblOtrasBacterias tr:eq(2)').after('<tr id="' + idOtraBacteria + '">' +
                    '<td style="width:5%;"><span id="' + idOtraBacteria + '_otro_b">' + nombreBacteria + '<span></th>' +
                    '<td style="width:25%;">' +
                    '<div class="row">' +
                    '<div class="col-md-2 centrar"><span id="' + idOtraBacteria + '_otro_b_m1">' + m1 + '<span></div>' +
                    '<div class="col-md-2 centrar"><span id="' + idOtraBacteria + '_otro_b_m2">' + m2 + '<span></div>' +
                    '<div class="col-md-2 centrar"><span id="' + idOtraBacteria + '_otro_b_m3">' + m3 + '<span></div>' +
                    '<div class="col-md-2 centrar"><span id="' + idOtraBacteria + '_otro_b_m4">' + m4 + '<span></div>' +
                    '<div class="col-md-2 centrar"><span id="' + idOtraBacteria + '_otro_b_m5">' + m5 + '<span></div>' +
                    '</div>' +
                    '</td>' +
                    '<td style="width:25%;">' +
                    '<div class="row">' +
                    '<div class="col-md-2 centrar"><span id="' + idOtraBacteria + '_otro_b_h1">' + h1 + '<span></div>' +
                    '<div class="col-md-2 centrar"><span id="' + idOtraBacteria + '_otro_b_h2">' + h2 + '<span></div>' +
                    '<div class="col-md-2 centrar"><span id="' + idOtraBacteria + '_otro_b_h3">' + h3 + '<span></div>' +
                    '<div class="col-md-2 centrar"><span id="' + idOtraBacteria + '_otro_b_h4">' + h4 + '<span></div>' +
                    '<div class="col-md-2 centrar"><span id="' + idOtraBacteria + '_otro_b_h5">' + h5 + '<span></div>' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<button type="button" class="btn btn-danger glyphicon glyphicon-remove" onclick="eliminarOtraBacteria(\'' + idOtraBacteria + '\');"></button>' +
                    '</td>' +
                    '</tr>');
            $('#modalAgregarOtraBacteria').modal('hide');

        },
    });
}


function eliminarOtraBacteria(idOtraBacteria) {
    $('#divOtrasBacterias #' + idOtraBacteria).remove();

    var filas = $('#tblOtrasBacterias tr').length;

    if (filas == 3) {
        $('#divOtrasBacterias').addClass("hidden"); //Muestra el panel
    }
}

function cargaFicha() {

    var nivelLab = $('#hddNivLab').val();

    if (nivelLab.length > 0) {//Verifica si imprime el bloque
        var params = 'opcion=7&nivelLab=' + nivelLab;
        llamarAjax("parasitismo_intestinal_ajax.php", params, "divFicha", "");
    }
}

function imprimir_reporte_envios(cod) {
    var params = "opcion=2&cod=" + cod;
    llamarAjax("generar_reporte_ajax.php", params, "hdd_imprimir_reporte", "mostrar_reporte();");
}


function mostrar_reporte() {
    var cont_aux = 0;
    var ruta = $("#hdd_ruta_arch_pdf").val();
    window.open("../funciones/abrir_pdf.php?ruta=" + ruta + "&nombre_arch=acta_muestra_agua_" + 1 + ".pdf", "_blank");
}
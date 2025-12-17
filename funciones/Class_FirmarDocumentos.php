<?php
    class ClassFirmarDocumentos {

        public function ObtenerRtResult($id_suscriptor) {
            
            try {
                $curl = curl_init();

                $Var_ObtenerRtResult = "ERROR";

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://biofirmacloud.com:2053/Servicios/Procesos.asmx',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'<?xml version="1.0" encoding="utf-8"?>
                    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                        <soap:Body>
                            <ObtenerRt xmlns="http://tempuri.org/">
                            <ID>' .$id_suscriptor. '</ID>
                            </ObtenerRt>
                        </soap:Body>
                    </soap:Envelope>',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: text/xml'
                    ),
                    ));

                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

                    $response = curl_exec($curl);
                    if (curl_errno($curl)) {
                        echo 'Error en cURL: ' . curl_error($curl);
                        curl_close($curl);
                        exit;
                    }

                    curl_close($curl);

                    // ✅ Extraer solo el valor entre <ObtenerRtResult>...</ObtenerRtResult>
                    if (preg_match('/<ObtenerRtResult>(.*?)<\/ObtenerRtResult>/', $response, $matches)) {
                        $resultado = $matches[1];
                        $Var_ObtenerRtResult = htmlspecialchars($resultado); 
                        #echo "Resultado: " . htmlspecialchars($resultado);
                    } else {
                        #echo "No se encontró el valor en la respuesta.";
                    }
            } catch (Error $e) {
                #echo "Homini ObtenrRt Error : " .$e->getMessage();
                $Var_ObtenerRtResult = $e->getMessage();
                return false;
            }
            
            return $Var_ObtenerRtResult;
        }



        public function AgregarPeticion($strRt, $strJson, $strAPI) {
            
            
            $curl = curl_init();

            $Var_ObtenerRtResult = "ERROR";
            //CURLOPT_URL => 'http://10.4.0.4:9898/Servicios/Procesos.asmx?op=AgregarPeticion',   
            curl_setopt_array($curl, array(                
                CURLOPT_URL => 'https://biofirmacloud.com:2053/servicios/procesos.asmx?op=AgregarPeticion',               
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'<?xml version="1.0" encoding="utf-8"?>
                <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                <soap:Body>
                    <AgregarPeticion xmlns="http://tempuri.org/">
                    <strRt>'.$strRt.'</strRt>
                    <strJson>'.htmlspecialchars($strJson, ENT_XML1 | ENT_QUOTES, 'UTF-8').'</strJson>
                    <intIdSuscriptor>101</intIdSuscriptor>
                    <strAPI>'.$strAPI.'</strAPI>
                    </AgregarPeticion>
                </soap:Body>
                </soap:Envelope>',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: text/xml'
                ),
                ));                    

                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

            // Ejecutar llamada
            $response = curl_exec($curl);
            $error = curl_error($curl);
            curl_close($curl);

            // Manejo de errores
            if ($error) {
                return "❌ Error cURL: " . $error;
            }

            // Si solo queremos el contenido dentro del CDATA
            if ($retornarSoloCData) {
                $xml = simplexml_load_string($response);
                $xml->registerXPathNamespace('soap', 'http://schemas.xmlsoap.org/soap/envelope/');
                $result = $xml->xpath('//soap:Body//AgregarPeticionResult')[0] ?? null;
                if ($result) {
                    // Elimina etiquetas CDATA si existen
                    return trim((string) $result);
                }
            }

            // Devolver XML completo
            return $response;

                    







        }
        
        
        
        
        
        
    }
?>

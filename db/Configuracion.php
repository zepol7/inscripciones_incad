<?php
	class Configuracion {
            
            /*Local host*/
            /*
            public static $SERVIDOR= "localhost";
            public static $PUERTO = "3306";
            public static $USUARIOS= "root";
            public static $PASS= "";
            public static $BASE_DATOS= "incad_inscripciones";
            */
            

            /*Docker*/            
            public static $SERVIDOR= "db";
            public static $PUERTO = "3310";
            public static $USUARIOS= "insc_user";
            public static $PASS= "insc_pass";
            public static $BASE_DATOS= "inscripciones";
            


            /*public static $SERVIDOR= "localhost";
            public static $PUERTO = "3306";
            public static $USUARIOS= "incadedu_inscrip";
            public static $PASS= "CrPl-zfGoBcn";
            public static $BASE_DATOS= "incadedu_inscripciones";*/
                
            public static $SERVIDOR_SMTP = "smtp.gmail.com";
            public static $PUERTO_SMTP = 587; //465, 587
            public static $PROTOCOLO_SEGURIDAD_CORREO = "tls"; //ssl, tls
            public static $USUARIO_CORREO = "sistemas@incad.edu.co";
            public static $CONTRASENA_CORREO = "xhyjloevnoklgidt";
            public static $NOMBRE_ENVIO = "Pre-Inscripcion INCAD";
            public static $USUARIO_ENVIO = "sistemas@incad.edu.co";
            public static $USUARIO_CORREO_RESPUESTA = "sistemas@incad.edu.co";

            public static $FIRMA_ID_SUSCRIPTOR = 101;
            public static $FIRMA_SECRETO_COMPARTIDO = "FZEYHfAHdf";

            public static $DIRECCION_INCAD = "3224042994";
            public static $TELEFONO_INCAD = "Calle 10 No. 22-77";


		
	}
?>

<?php

require_once("../db/Configuracion.php");
require_once("../funciones/composer/vendor/autoload.php");


class Class_Envio_Correo {

	private $servidor_smtp;
	private $puerto_smtp;
	private $protocolo_seguridad_correo;
	private $usuario_correo;
	private $contrasena_correo;
	private $nombre_envio;
	private $usuario_envio;

	public function __construct() {
		$this->servidor_smtp = Configuracion::$SERVIDOR_SMTP;
		$this->puerto_smtp = Configuracion::$PUERTO_SMTP;
		$this->protocolo_seguridad_correo = Configuracion::$PROTOCOLO_SEGURIDAD_CORREO;
		$this->usuario_correo = Configuracion::$USUARIO_CORREO;
		$this->contrasena_correo = Configuracion::$CONTRASENA_CORREO;
		$this->nombre_envio = Configuracion::$NOMBRE_ENVIO;
		$this->usuario_envio = Configuracion::$USUARIO_ENVIO;
	}

	
	public function enviar_correo($asunto, $lista_destinos, $cuerpo) {
		//Listado de destinatarios
		$array_destinos = array();
		foreach ($lista_destinos as $destino_aux) {
			if ($destino_aux["nombre"] != "") {
				$array_destinos[$destino_aux["email"]] = $destino_aux["nombre"];
			} else {
				array_push($array_destinos, $destino_aux["email"]);
			}
		}
		
		$transporte = (new Swift_SmtpTransport($this->servidor_smtp, $this->puerto_smtp, $this->protocolo_seguridad_correo))
				->setUsername($this->usuario_correo)
				->setPassword($this->contrasena_correo)
				->setStreamOptions([
			'ssl' => ['allow_self_signed' => true, 'verify_peer' => false, 'verify_peer_name' => false]
		]);

		$mailer = new Swift_Mailer($transporte);

		$mensaje = (new Swift_Message($asunto))
				->setFrom([$this->usuario_envio => $this->nombre_envio])
				->setTo($array_destinos)
				->setBody($cuerpo, "text/html");

		$resultado = $mailer->send($mensaje);

		return $resultado;
	}

}

?>

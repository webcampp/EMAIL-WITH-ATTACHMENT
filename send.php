<?php

class Email {
	
	//nombre
	var $nombre;
	//email del emisor
	var $mail;
	//email del receptor
	var $mailr;
	var $asunto;
	//mensaje
	var $msn;
	//archivo adjunto
	var $adjunto;
	//enviar el mensaje
	private $sender;
	//url para redireccionar
	private $url;

	//función constructora
	public function __construct(){
		//cada uno de ellos es el parámetro que enviamos desde el formulario
		$this->nombre = $n;
		$this->mail = $m;
		$this->mailr = $mr;
		$this->asunto = $a;
		$this->msn = $ms;
		$this->adjunto = $ad;
	}

	//método enviar con los parámetros del formulario
	public function enviar($n,$m,$mr,$a,$ms,$ad){
		//si existe post
		if(isset($_POST)){

			//si existe adjunto
			if($ad) {
				//añadimos texto al nombre original del archivo
				$dir_subida = 'fichero_';
				//nombre del fichero creado -> fichero_nombreArchivo.pdf
				$fichero_ok = $dir_subida . basename($ad);
				//y lo subimos a la misma carpeta
				move_uploaded_file($_FILES['adjunto']['tmp_name'], $fichero_ok);
			}
			//creamos el mensaje
			$contenido = '
				<h2>Nuevo mensaje de: '.$n.'</h2>
				<hr>
				Email: <b>'.$m.'</b><br>
				Mensaje: <br><b>'.$ms.'</b><br>
			';
			//archivo necesario para enviar los archivos adjuntos
			require_once 'AttachMailer.php';

			//enviamos el mensaje           (emisor,receptor,asunto,mensaje)
			$this->sender = new AttachMailer($m, $mr, $a, $contenido);
			$this->sender->attachFile($fichero_ok);
			//eliminamos el fichero de la carpeta con unlink()
			//si queremos que se guarde en nuestra carpeta, lo comentamos o borramos
			unlink($fichero_ok);
			//enviamos el email con el archivo adjunto
			$this->sender->send();
			//url para redireccionar
			$this->url = 'http://www.webcamp.es/email';
			//redireccionamos a la misma url conforme se ha enviado correctamente con la variable si
			header('Location:'.$this->url.'?s=si');
		}
		else{
			//redireccionamos a la misma url conforme NO se ha enviado correctamente con la variable no
			header('Location:'.$this->url.'?s=no');
		}
	}
}

//llamamos a la clase
$obj = new Email();
//ejecutamos el método enviar con los parámetros que recibimos del formulario
$obj->enviar($_POST['nombre'], $_POST['email'], $_POST['emailr'], $_POST['asunto'], $_POST['msn'], $_FILES['adjunto']['name']);

?>
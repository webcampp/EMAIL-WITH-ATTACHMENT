<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>envio de emails con archivos adjuntos</title>
	<style>
		body {
			background: #f5f5f5;
			font-family: Arial, Verdana, sans-serif;
		}
		#container {
			background: #fff;
			border: 1px solid #cecece;
			max-width: 1170px;
			margin: 20px auto 0 auto;
			padding: 20px;
			text-align: center;
		}
		h1 {
			color: #636363;
		}
		a {
			color: #9fcd32;
			text-decoration: none;
		}
		a:hover {
			text-decoration: underline;
		}
		form {
			max-width: 500px;
			margin: 0 auto;
		}
		form fieldset {
			background: #f5f5f5;
		}
		form legend {
			color: red;
			font-size: 20px;
			font-weight: bold;
			text-transform: uppercase;
		}
		form ul {
			padding: 0px;
		}
		form ul li {
			list-style-type: none;
			text-align: left;
			margin-top: 10px;
		}
		form ul li:last-child {
			text-align: center;
		}
		form ul li input[type="text"],form ul li input[type="email"], form ul li textarea {
			border: 1px solid #cecece;,
			border-radius: 3px;
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			-o-border-radius: 3px;
			padding: 7px;
			width: 96%;
		}
		form ul li input[type="submit"] {
			background: red;
			border: none;
			color: #fff;
			cursor: pointer;
			font-size: 16px;
			font-weight: bold;
			padding: 10px;
			text-transform: uppercase;
			width: 50%;
		}
		.msn-ok, .msn-ko {
		    color: #fff;
		    padding: 10px;
		    text-align: center;
		    width: 65%;
		    margin: 20px auto;
		}
		.msn-ok {
			background: #22AF22;
		}
		.msn-ko {
			background: #CC2F2F;
		}
	</style>
</head>
<body>
	<div id="container">
		<h1>Envio de emails con archivos adjuntos - <a href="http://www.webcamp.es">Webcamp.es</a></h1>
		<?php
			//si se ha enviado el correo
			if(isset($_REQUEST['s'])){
				$ok = $_REQUEST['s'];
				if($ok == 'si'){
					echo "<div class='msn-ok'>¡Mensaje enviado correctamente!</div>";
				}
				elseif($ok == 'no'){
					echo "<div class='msn-ko'>Ha habido un error de envio...</div>";
				}
			}
		?>
		<form action="send.php" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend>rellena el formulario</legend>
				<ul>
					<li>
						<label for="nombre">Nombre:</label>
						<br>
						<input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
					</li>
					<li>
						<label for="mail">E-mail:</label>
						<br>
						<input type="email" id="mail" name="email" placeholder="E-mail del emisor" required>
					</li>
					<li>
						<label for="mailr">E-mail del receptor:</label>
						<br>
						<input type="email" id="mailr" name="emailr" placeholder="E-mail del receptor" required>
					</li>
					<li>
						<label for="adjunto">Archivo adjunto</label>
						<br>
						<input type="file" id="adjunto" name="adjunto" required>
					</li>
					<li>
						<label for="asunto">Asunto:</label>
						<br>
						<input type="text" id="asunto" name="asunto" placeholder="Asunto" required>
					</li>
					<li>
						<label for="msn">Mensaje:</label>
						<br>
						<textarea name="msn" id="msn" rows="10" required></textarea>
					</li>
					<li>
						<input type="submit" value="Enviar">
					</li>
				</ul>
			</fieldset>
		</form>
	</div>

<!-- jQuery -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
	$(document).ready(function(){
		$('form').submit(function(){
			if($('input[type="text"]').val() == '' || $('input[type="email"]').val() == '' || $('input[type="file"]').val() == '' || $('textarea').val() == ''){
				alert('Rellena todos los campos');
				return false;
			}
		});
	});
</script>

</body>
</html>
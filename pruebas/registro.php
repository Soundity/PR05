<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Registro</title>
		<meta charset="utf-8" />
		<script type="text/javascript" src="js/validaFormulario.js"></script>
	</head>
	<body>
		<div>
			<!--<label><?php //if(isset($_SESSION['fallo_registro'])) echo $_SESSION['fallo_registro']; session_destroy();?></label>-->
			<h1><a>Datos personales</a></h1>
			<form id="form_registro" method="GET" action="procs/registro.proc.php" onsubmit="return validaFormulario();">
				<!-- CORREO ELECTRONICO DEL USUARIO -->
				<label>Correo Electrónico: </label>
				<span>
					<input id="correo" name="correo" class="element text medium" type="text" maxlength="50" size="30" value=""/>
					<span id="error_correo_vacio"></span>
					<span id="error_correo_formato"></span>
				</span>
				<br/><br/>

				<!-- CONTRASEÑA DEL USUARIO -->
				<label>Contraseña:</label>
				<span>
					<input id="contrasena" name="contrasena" type="password" value=""/>
					<span id="error_contrasena_vacio"></span>
				</span>
				<br/><br/>

				<!-- CONFIRMACIÓN DEL USUARIO -->
				<label>Confirmar contraseña:</label>
				<span>
    				<input id="confirmar_contrasena" type="password" />
    				<span id="error_confirmar_contrasena_vacio"></span>
    				<span id="error_confirmar_contrasena_incorrecto"></span>
				</span>
				<br/><br/>

				<!-- APODO O NICKNAME DEL USUARIO -->
				<label>Apodo / Nickname: </label>
				<span>
					<input id="apodo" name="apodo"  maxlength="30" size="30" value=""/>
					<span id="error_apodo"></span>
				</span>
				<br/><br/>

				<!-- BOTON DE ENVIAR -->
				<input type="submit" name="submit" value="Enviar" />
			</form>
		</div>
	</body>
</html>

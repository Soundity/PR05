<?php
	session_start();
	include("conexion.php");
	$sql = "SELECT * FROM `tbl_genere`";
	$datos = mysqli_query($con,$sql);
	$cont = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Soundity</title>
    <script src="js/validaFormulario.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="dist/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="css/registro.css">
    <meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
	<body>
		<div>
			<!--<label><?php //if(isset($_SESSION['fallo_registro'])) echo $_SESSION['fallo_registro']; session_destroy();?></label>-->
			
			<form id="form_registro" class="ui center aligned orange segment" method="GET" action="procs/registro.proc.php" onsubmit="return validaFormulario();">
				<h2 class="ui header">Registro</h2>
				<div class="ui form">
				<!-- CORREO ELECTRONICO DEL USUARIO -->
					<label>Correo Electrónico: </label>
					<div class="five wide field">
						<input id="correo" name="correo" class="element text medium" type="text" maxlength="50" size="30" value=""/>
						<span id="error_correo_vacio" class="error"></span>
						<span id="error_correo_formato" class="error"></span>
					</div>
					<!-- CONTRASEÑA DEL USUARIO -->
					<label>Contraseña:</label>
					<div class="five wide field">
						<input id="contrasena" name="contrasena" type="password" value=""/>
						<span id="error_contrasena_vacio" class="error"></span>
					</div>
					<!-- CONFIRMACIÓN DEL USUARIO -->
					<label>Confirmar contraseña:</label>
					<div class="five wide field">
	    				<input id="confirmar_contrasena" type="password" />
	    				<span id="error_confirmar_contrasena_vacio" class="error"></span>
	    				<span id="error_confirmar_contrasena_incorrecto" class="error"></span>
					</div>
					<!-- APODO O NICKNAME DEL USUARIO -->
					<label>Apodo / Nickname: </label>
					<div class="five wide field">
						<input id="apodo" name="apodo"  maxlength="30" size="30" value=""/>
						<span id="error_apodo" class="error"></span>
					</div>

					<!-- CHECKBOX DE GUSTOS -->
					<label>Selecciona tus gustos: </label>
					<table class="ui basic table">
						<tbody>
							<?php
							echo "<tr><td>";

							$contador=1; 
							while($valor=mysqli_fetch_array($datos)){
								//echo "<tr>";
								echo "<div class='ui checkbox'><input type='checkbox' name='gustos[]' value='".$valor['gen_id']."'/><label>".$valor['gen_nom']."</label></div></br>";
				    			if($contador==5){
				    				echo "</td><td>";
				    				$contador=1;
				    			} else {
				    				$contador++;
				    			}
							}
							echo "</tr>";
							?>
							<label>Mas adelante podras elegirlos y/o modificarlos.</label>
						</tbody>
					</table>
					<!-- BOTON DE ENVIAR -->
					<input type="submit" class="ui inverted orange button" name="submit" value="Registrarse" />
					<input type="button" class="ui inverted orange button" onclick="location='Login.php'" value="Atrás"/>
				</div>
			</form>
		</div>
		
	</body>
</html>
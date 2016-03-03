<?php
	session_start();
	if(isset($_SESSION['id']))$login = 1;
	if(isset($_COOKIE['Soundity']))$login = 1;
	if($login == 1){
	include("conexion.php");
	$sql2 = "SELECT * FROM `tbl_genere`";
	$datos2 = mysqli_query($con,$sql2);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modificar usuario</title>
		<link rel="stylesheet" type="text/css" href="dist/semantic.min.css">
		<link rel="stylesheet" type="text/css" href="css/modificar.css">
        <script type="text/javascript" src="js/validaModificar.js"></script>
	</head>
	<body>
		<?php include('header_menu.html'); 
			//$sql = "SELECT * FROM tbl_usuari WHERE usu_id=". $_SESSION['id'];
			$sql="SELECT * FROM `tbl_usuari` WHERE `tbl_usuari`.`usu_id`=".$_SESSION['id'];
			//mostramos la consulta para ver por pantalla si es lo que esperábamos o no
			//echo "$sql<br/>";
			//lanzamos la sentencia sql que devuelve el producto en cuestión
			$datos = mysqli_query($con, $sql);
			if(mysqli_num_rows($datos)>0){
				$prod=mysqli_fetch_array($datos);
		?>
				<div class="ui center aligned orange segment">
					<form name="form_registro" id="form_registro" class="ui form" method="POST" action="procs/modificar.proc.php" onsubmit="return validaFormulario();" enctype="multipart/form-data">
						<div class="three fields">
							<!-- DIV VACIO IZQUIERDA IMAGEN -->
							<div class="field">
							</div>
							<!-- MOSTRAR IMAGEN DEL USUARIO -->
							<div class="field">
								 <label>Imagen de perfil:</label>
								<img class="ui small circular image" src="media/images/avatares/<?php echo utf8_encode($prod['usu_avatar']);?>">
							</div>
							<!-- DIV VACIO DERECHA IMAGEN -->
							<div class="field">
							</div>
						</div>
						<div class="three fields">
							<!-- DIV VACIO IZQUIERDA SUBIR IMAGEN -->
							<div class="field">
							</div>
							<!-- SUBIR IMAGEN DEL USUARIO -->
							<div class="field">
								<input type="file" name="imagen" id="imagen"/>
							</div>
							<!-- DIV VACIO DERECHA SUBIR IMAGEN -->
							<div class="field">
							</div>
						</div>
						<div class="two fields">
							<div class="field">
								<!-- APODO O NICKNAME DEL USUARIO -->
								<label>Apodo / Nickname: </label>
								<input id="apodo" name="apodo"  maxlength="30" size="30" value="<?php echo utf8_encode($prod['usu_nom']);?>"/>
								<span id="error_apodo"></span>
							</div>
							<div class="field">
								<!-- CORREO ELECTRONICO DEL USUARIO -->
							    <label>Correo Electrónico: </label>
							    <input id="correo" name="correo" class="element text medium" type="text" maxlength="50" size="30" value="<?php echo utf8_encode($prod['usu_mail']); ?>"/>
								<span id="error_correo_vacio" class="error"></span>
								<span id="error_correo_formato" class="error"></span>
							</div>
						</div>
						<div class="two fields">
							<div class="field">
								<!-- CONTRASEÑA DEL USUARIO -->
							    <label>Nueva contraseña:</label>
								<input id="contrasena" name="contrasena" type="password"/>
								<span id="error_contrasena_vacio" class="error"></span>
							</div>
							<div class="field">
								<!-- CONFIRMACIÓN CONTRASEÑA DEL USUARIO -->
								<label>Confirmar nueva contraseña:</label>
								<input id="confirmar_contrasena" name="confirmar_contrasena" type="password"/>
								<span id="error_confirmar_contrasena_vacio" class="error"></span>
								<span id="error_confirmar_contrasena_incorrecto" class="error"></span>
							</div>
						</div>
						
						<div class="three fields">
							<!-- DIV VACIO IZQUIERDA IDIOMA -->
							<div class="field">
							</div>
							<!-- IDIOMA -->
							<div class="field">
								<label>Idioma:</label>
								<input id="idioma" name="idioma" class="element text" maxlength="20" size="48" value="<?php echo utf8_encode($prod['usu_idioma']); ?>"/><br/>
 							</div>
 							<!-- DIV VACIO DERECHA IDIOMA -->
							<div class="field">
							</div>
						</div>
						<!-- DESCRIPCIÓN -->
						<div class="ui form">
						  	<div class="field">
							    <label>Descripción:</label>
							    <textarea name="descripcion" rows="3">
							    	<?php echo utf8_encode($prod['usu_descripcio']);?>
							   	</textarea>
							</div>
						</div>	
						<div class="ui form">
							<div class="field">
								<label>Selecciona tus gustos:</label>
								<table class="ui basic table">
									<tbody>
									<?php
										echo "<tr><td>";
										$contador=1;
										while($valor2=mysqli_fetch_array($datos2)){
											$sql3 = "SELECT `gen_id` FROM `tbl_genere_usuari` WHERE `usu_id`='$_SESSION[id]' AND `gen_id`='$valor2[gen_id]'";
											//echo $sql3;
											$datos3 = mysqli_query($con,$sql3);
											if (mysqli_num_rows($datos3)==1){
												echo "<div class='ui checkbox'><input type='checkbox' name='gustos[]' value='".$valor2['gen_id']."' checked/><label>".utf8_encode($valor2['gen_nom'])."</label></div>";
											}else{
												echo "<div class='ui checkbox'><input type='checkbox' name='gustos[]' value='".$valor2['gen_id']."'/><label>".utf8_encode($valor2['gen_nom'])."</label></div>";
											}
											if($contador==5){
							    				echo "</td><td>";
							    				$contador=1;
							    			} else {
							    				$contador++;
							    			}
										}
										echo "</tr>";
									?>
									</tbody>
								</table>
							</div>
						</div>
							<!-- BOTON DE ENVIAR -->
						<input type="submit" name="submit" value="Enviar" />
					</form>
				</div>
		<?php
			} else {
				//echo "Usuario con id=$_REQUEST[id_usuario] no encontrado!";
			}
			//cerramos la conexión con la base de datos
			mysqli_close($con);
		?>
		<br/><br/>
	</body>
</html>
<?php
 	}else{
	    $_SESSION['validarse'] = 'error';
	    header("Location: login.php");
	    die();
	}
?>
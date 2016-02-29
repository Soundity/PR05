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
        <script type="text/javascript" src="js/validaFormulario.js"></script>
	</head>
	<body>
		<?php include('header_menu.html'); 
			//$sql = "SELECT * FROM tbl_usuari WHERE usu_id=". $_SESSION['id'];
			$sql ="SELECT * FROM `tbl_usuari` WHERE `tbl_usuari`.`usu_id`=".$_SESSION['id'];
			//mostramos la consulta para ver por pantalla si es lo que esperábamos o no
			//echo "$sql<br/>";
			//lanzamos la sentencia sql que devuelve el producto en cuestión
			$datos = mysqli_query($con, $sql);
			if(mysqli_num_rows($datos)>0){
				$prod=mysqli_fetch_array($datos);
		?>
				<form id="form_registro" method="POST" action="procs/modificar.proc.php" onsubmit="return validaFormulario();" enctype="multipart/form-data">
					<!-- CORREO ELECTRONICO DEL USUARIO -->
					<label>Correo Electrónico: </label>
					<span>
						<input id="correo" name="correo" class="element text medium" type="text" maxlength="50" size="30" value="<?php echo $prod['usu_mail']; ?>"/>
						<span id="error_correo_vacio"></span>
						<span id="error_correo_formato"></span>
					</span>
					<br/><br/>
					<!-- CONTRASEÑA DEL USUARIO -->
					<label>Nueva contraseña:</label>
					<span>
						<input id="contrasena" name="contrasena" maxlength="50" type="password"/>
						<span id="error_contrasena_vacio"></span>
					</span>
					<br/><br/>
					<!-- CONFIRMACIÓN DEL USUARIO -->
					<label>Confirmar nueva contraseña:</label>
					<span>
						<input id="confirmar_contrasena" maxlength="50" type="password"/>
						<span id="error_confirmar_contrasena_vacio"></span>
						<span id="error_confirmar_contrasena_incorrecto"></span>
					</span>
					<br/><br/>
					Imagen:<br/>
					<input type="file" name="imagen" id="imagen"/><br/>
					<!-- APODO O NICKNAME DEL USUARIO -->
					<label>Apodo / Nickname: </label>
					<span>
						<input id="apodo" name="apodo"  maxlength="30" size="30" value="<?php echo $prod['usu_nom']; ?>"/>
						<span id="error_apodo"></span>
					</span>
					<br/><br/>
					Descripcion : 
						<textarea name="descripcion" rows="4" cols="50" maxlength="250">
							<?php echo $prod['usu_descripcio'];?>
						</textarea>
					Idioma : 
						<input id="idioma" name= "idioma" class="element text" maxlength="20" size="48" value="<?php echo utf8_encode($prod['usu_idioma']); ?>"/><br/>
					Generos:
					<?php 
						while($valor2=mysqli_fetch_array($datos2)){
							$sql3 = "SELECT `gen_id` FROM `tbl_genere_usuari` WHERE `usu_id`='$_SESSION[id]' AND `gen_id`='$valor2[gen_id]'";
							//echo $sql3;
							$datos3 = mysqli_query($con,$sql3);
							if (mysqli_num_rows($datos3)==1){
								echo "<div class='ui checkbox'><input type='checkbox' name='gustos[]' value='".$valor2['gen_id']."' checked/><label>".$valor2['gen_nom']."</label></div>";
							}else{
								echo "<div class='ui checkbox'><input type='checkbox' name='gustos[]' value='".$valor2['gen_id']."'/><label>".$valor2['gen_nom']."</label></div>";
							}
						}
					?>
					<br/><br/>
						<!-- BOTON DE ENVIAR -->
					<input type="submit" name="submit" value="Enviar" />
				</form>
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
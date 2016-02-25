<?php
	session_start();
	if(isset($_SESSION['id']))$login = 1;
	if(isset($_COOKIE['Soundity']))$login = 1;
	if($login == 1){
include('header_menu.html');
include("conexion.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modificar usuario</title>   
        <script type="text/javascript" src="/jsvalidaFormulario.js"></script>
	</head>
	<body>
<?php
			$sql = "SELECT * FROM tbl_usuari WHERE usu_id=". $_SESSION['id'];
			//mostramos la consulta para ver por pantalla si es lo que esperábamos o no
			//echo "$sql<br/>";
			//lanzamos la sentencia sql que devuelve el producto en cuestión
			$datos = mysqli_query($con, $sql);
			if(mysqli_num_rows($datos)>0){
				$prod=mysqli_fetch_array($datos);
?>
		<form id="form_registro" method="GET" action="procs/modificar.proc.php" onsubmit="return validaFormulario();" enctype="multipart/form-data">
			<!-- CORREO ELECTRONICO DEL USUARIO -->
			<label>Correo Electrónico: </label>
			<span>
				<input id="correo" name="correo" class="element text medium" type="text" maxlength="50" size="30" value="<?php echo $prod['usu_mail']; ?>"/>
				<span id="error_correo_vacio"></span>
				<span id="error_correo_formato"></span>
			</span>
			<br/><br/>
			<!-- CONTRASEÑA DEL USUARIO -->
			<label>Contraseña:</label>
			<span>
				<input id="contrasena" name="contrasena" maxlength="50" type="password" value="<?php echo $prod['usu_contra']; ?>"/>
				<span id="error_contrasena_vacio"></span>
			</span>
			<br/><br/>
			<!-- CONFIRMACIÓN DEL USUARIO -->
			<label>Confirmar contraseña:</label>
			<span>
				<input id="confirmar_contrasena" maxlength="50" type="password" value="<?php echo $prod['usu_contra']; ?>"/>
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
				<input id="idioma" name= "idioma" class="element text" maxlength="20" size="48" value="<?php echo $prod['usu_idioma']; ?>"/><br/>
			<!-- BOTON DE ENVIAR -->
			<input type="submit" name="submit" value="Enviar" />
			<?php
				} else {
					//echo "Usuario con id=$_REQUEST[id_usuario] no encontrado!";
				}
				//cerramos la conexión con la base de datos
				mysqli_close($con);
			?>
		</form>
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
<?php
	session_start();
	if (isset($_SESSION[''])){
		//MODIFICAR AQUI ->
		header("location: PAGINA DONDE VAYA");
	}else{
		//Incluimos la conexion a BBDD
		include ("../conexion.php");
		//Recuperacion de variables pasadas con el formulario.
		$contrasena = md5($_REQUEST['contrasena']);
		$correo = $_REQUEST['correo'];
		$apodo = $_REQUEST['apodo'];
		//Lanzamiento de la consulta
		$sql = "INSERT INTO `bd_soundity`.`tbl_usuari` (`usu_id`, `usu_mail`, `usu_contra`, `usu_nom`, `usu_avatar`, `usu_descripcio`, `usu_rang`, `usu_idioma`) VALUES (NULL, '$correo','$contrasena', '$apodo', NULL, NULL, '0', NULL)";
		$datos = mysqli_query($con,$sql);

		//COMPROVACIONES VARIAS
		//si todo sale bien
		if (mysqli_affected_rows($con) == 1){
			//MODIFICAR AQUI ->
			header("location: ../login.php");
			$_SESSION['creado_correctamente'] = "El usuario se ha creado correctamente, bienvenido a nuestra comunidad.";
		//en caso de error
		}else{
			header("location: ../registro.php");
			//$_SESSION['fallo_registro'] = "Ha habido un error con el registro, intentalo de nuevo por favor."
		}
	}
?>
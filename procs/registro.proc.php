<?php
	session_start();
	if (isset($_SESSION['mail'])){
		//MODIFICAR AQUI ->
		header("location: index.php");
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
			if (isset($_REQUEST["gustos"])){
				$gustos = $_REQUEST['gustos'];
				$sql2= "SELECT `usu_id` FROM `tbl_usuari` WHERE `usu_mail`='$correo'";
			    $datos2 = mysqli_query($con,$sql2);
			    while($valor2=mysqli_fetch_array($datos2)){
					$id_usuario = $valor2['usu_id'];
				}
				for($i=0; $i<count($gustos); $i++) {
				    $gusto = $gustos[$i];
				    $sql3 = "INSERT INTO `bd_soundity`.`tbl_genere_usuari` (`gus_id`, `usu_id`, `gen_id`) VALUES (NULL, '$id_usuario', '$gusto')";
				    $datos3 = mysqli_query($con,$sql3);
				}
				header("location: ../login.php");
				$_SESSION['creado_correctamente'] = "El usuario se ha creado correctamente, bienvenido a nuestra comunidad.";
			} else {
				header("location: ../login.php");
				$_SESSION['creado_correctamente'] = "El usuario se ha creado correctamente, bienvenido a nuestra comunidad.";
			}
		}else{
			header("location: ../registro.php");
			//$_SESSION['fallo_registro'] = "Ha habido un error con el registro, intentalo de nuevo por favor."
		}
	}
?>

<?php
	session_start();
	if (isset($_POST['login'])){
		//Incluimos la conexion a BBDD
		include ("../conexion.php");
		//Recuperacion de variables pasadas con el formulario.
		$contrasena = md5($_POST['contrasena']);
		$correo = $_POST['correo'];
		//Lanzamiento de la consulta
		$sql = "SELECT usu_mail, usu_id, usu_contra FROM tbl_usuari WHERE usu_mail='$correo' AND usu_contra='$contrasena'";
		echo $sql. "<br>";
		$datos = mysqli_query($con, $sql);
		if(mysqli_num_rows($datos) > 0){
			while($send = mysqli_fetch_array($datos)){
				$_SESSION['mail']= $send['usu_mail'];
				$_SESSION['id']= $send['usu_id'];
				$_SESSION['pass']= $send['usu_contra'];
				echo $_SESSION['id']. "<br>";
				echo $_SESSION['mail']. "<br>";
				echo 1 . "<br>";
				header("Location: ../index.php");
				die();
			}
		}else{
			$_SESSION['error_login'] = 'Debes introducir un email';
			echo 2;
			header("Location: ../login.php");
			die();
		}
		mysqli_close($con);
	}else{
		$_SESSION['validarse'] = 'Email o contraseña incorrectos';
		echo 3;
		header("Location: ../login.php");
		die();
	}
	
?>
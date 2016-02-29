<?php
	session_start();
	if(isset($_SESSION['id']))$login = 1;
	if(isset($_COOKIE['Soundity']))$login = 1;
	if($login == 1){
		include("../conexion.php");
		$password=md5($_REQUEST['contrasena']);
		$apodo=$_REQUEST['apodo'];
		$correo=$_REQUEST['correo'];
		$descrip=$_REQUEST['descripcion'];
		$idioma=$_REQUEST['idioma'];
		echo $_FILES['imagen']['name'];
		if(empty($_FILES['imagen']['name'])){
			$sql = "UPDATE tbl_usuari SET usu_nom='$apodo', usu_mail='$correo', usu_contra='$password', usu_descripcio='$descrip', usu_idioma='$idioma' WHERE usu_id=$_SESSION[id]";
			$datos = mysqli_query($con, $sql);
			header("location: ../modificar.php");
		}else{
			$ruta = "../media/images/avatares/".$_SESSION['id']."_".$_FILES['imagen']['name'];
			$imagen=$_SESSION['id']."_".$_FILES['imagen']['name'];
			$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
			$sql = "UPDATE tbl_usuari SET usu_nom='$apodo', usu_avatar='$imagen', usu_mail='$correo', usu_contra='$password', usu_descripcio='$descrip', usu_idioma='$idioma' WHERE usu_id=$_SESSION[id]";
			$datos = mysqli_query($con, $sql);
			header("location: ../modificar.php");
		}

		if (mysqli_affected_rows($con) == 1){
			if (isset($_REQUEST["gustos"])){
				$gustos = $_REQUEST['gustos'];
				$sql2= "DELETE FROM `tbl_genere_usuari` WHERE `usu_id`=$_SESSION[id]";
				$datos2 = mysqli_query($con,$sql2);
				for($i=0; $i<count($gustos); $i++) {
				    $gusto = $gustos[$i];
				    $sql3 = "INSERT INTO `bd_soundity`.`tbl_genere_usuari` (`gus_id`, `usu_id`, `gen_id`) VALUES (NULL, '$_SESSION[id]', '$gusto')";
				    $datos3 = mysqli_query($con,$sql3);
				}
				header("location: ../modificar.php");
			} else {
				$sql2= "DELETE FROM `tbl_genere_usuari` WHERE `usu_id`=$_SESSION[id]";
				$datos2 = mysqli_query($con,$sql2);
				header("location: ../modificar.php");
			}
		}else{
			header("location: ../modificar.php");
			//MODIFICAR ESTO PARA QUE SEA UN ERROR DE MODIFICACION, NO DE REGISTRO
			$_SESSION['fallo_registro'] = "Ha habido un error con el registro, intentalo de nuevo por favor.";
		}
		
	}else{
		$_SESSION['validarse'] = 'error';
		header("Location: ../login.php");
		die();
	}
?>
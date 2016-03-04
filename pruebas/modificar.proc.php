<?php 
include("conexion.php");

 	
	//if(!isset($_SESSION['id_usuario'])){
	 //	header('location:index.php');
	//}
	

 ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Modificar update BD</title>
	</head>
	<body>
		<?php
			$password=md5($_REQUEST['contrasena']);
			if(empty($_FILES['imagen']['name'])){


			$sql = "UPDATE tbl_usuari SET usu_nom='$_REQUEST[apodo]', usu_mail='$_REQUEST[correo]', usu_contra='$password', usu_descripcio='$_REQUEST[descripcion]', usu_idioma='$_REQUEST[idioma]' WHERE usu_id=1";

			$datos = mysqli_query($con, $sql);

			//header("location: modificaruser.php")
		}else{
			$ruta = "img/" . $_FILES['imagen']['name'];
			$imagen=$_FILES['imagen']['name'];

			$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

			$sql = "UPDATE tbl_usuari SET usu_nom='$_REQUEST[apodo]', usu_avatar='$imagen', usu_mail='$_REQUEST[correo]', usu_contra='$password', usu_descripcio='$_REQUEST[descripcion]', usu_idioma='$_REQUEST[idioma]' WHERE usu_id=1";

			$datos = mysqli_query($con, $sql);

			//header("location: principal.php")
		}
		?>
	</body>
</html>
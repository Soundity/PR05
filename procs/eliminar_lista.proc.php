<?php
	session_start();
	if(isset($_SESSION['id']))$login = 1;
	if(isset($_COOKIE['Soundity']))$login = 1;
	if($login == 1){
		include("../conexion.php");
		$idllista=$_REQUEST['idllista'];
		$sql2 = "DELETE FROM `tbl_llistes_musica` WHERE `lli_id`=$idllista";
		$datos2 = mysqli_query($con, $sql2);
		$sql = "DELETE FROM `tbl_llistes` WHERE `lli_id`=$idllista";
		$datos = mysqli_query($con, $sql);
		header("Location: ../listas_reproducion.php");
	}else{
		$_SESSION['validarse'] = 'error';
		header("Location: ../login.php");
		die();
	}
?>
<?php
	session_start();
	if(isset($_SESSION['id']))$login = 1;
	if(isset($_COOKIE['Soundity']))$login = 1;
	if($login == 1){
		$lmu_id=$_REQUEST['lmu_id'];
		include("../conexion.php");
		$sql = "DELETE FROM `tbl_llistes_musica` WHERE lmu_id=$lmu_id";
		$datos = mysqli_query($con, $sql);
		header("Location: ../lista.php?idllista=$_REQUEST[idllista]");
	}else{
		$_SESSION['validarse'] = 'error';
		header("Location: ../login.php");
		die();
	}
?>
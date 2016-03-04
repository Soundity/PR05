<?php
	session_start();
	if(isset($_SESSION['id']))$login = 1;
	if(isset($_COOKIE['Soundity']))$login = 1;
	if($login == 1){
		include("../conexion.php");
		$mus_id=$_REQUEST['mus_id'];
		
		$sql3="DELETE FROM `tbl_valoracio` WHERE `mus_id`=$mus_id";
		$datos3 = mysqli_query($con, $sql3);
		$sql2 = "DELETE FROM `tbl_llistes_musica` WHERE `mus_id`=$mus_id";
		$datos2 = mysqli_query($con, $sql2);
		$sql = "DELETE FROM `tbl_musica` WHERE `mus_id`=$mus_id";
		$datos = mysqli_query($con, $sql);
		

		
		header("Location: ../verperfil.php");
	}else{
		$_SESSION['validarse'] = 'error';
		header("Location: ../login.php");
		die();
	}
?>
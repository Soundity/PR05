<?php
	session_start();
	if(isset($_SESSION['id']))$login = 1;
	if(isset($_COOKIE['Soundity']))$login = 1;
	if($login == 1){
		include("../conexion.php");
		$mus_id=$_REQUEST['mus_id'];
		echo $mus_id."<br/><br/>";
		$sql = "DELETE FROM `tbl_musica` WHERE `mus_id`=$mus_id";
		$datos = mysqli_query($con, $sql);
		echo $sql;
		$sql2 = "DELETE FROM `tbl_llistes_musica` WHERE `mus_id`=$mus_id";
		echo $sql2;
		$datos2 = mysqli_query($con, $sql2);
		//header("Location: ../verperfil.php");
	}else{
		$_SESSION['validarse'] = 'error';
		header("Location: ../login.php");
		die();
	}
?>
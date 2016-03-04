<?php
	session_start();
	if(isset($_SESSION['id']))$login = 1;
	if(isset($_COOKIE['Soundity']))$login = 1;
	if($login == 1){
		include("../conexion.php");
		$idllista=$_REQUEST['idllista'];
		echo $mus_id."<br/><br/>";
		$sql = "DELETE FROM  WHERE ";
		$datos = mysqli_query($con, $sql);
		echo $sql;
		$sql2 = "DELETE FROM  WHERE ";
		echo $sql2;
		$datos2 = mysqli_query($con, $sql2);
		//header("Location: ../listas_reproducion.php");
	}else{
		$_SESSION['validarse'] = 'error';
		header("Location: ../login.php");
		die();
	}
?>
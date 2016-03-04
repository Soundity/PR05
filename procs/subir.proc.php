<?php
	session_start();
if(isset($_SESSION['id']))$login = 1;
if(isset($_COOKIE['Soundity']))$login = 1;
	if(isset($login)){

		include("../conexion.php");
		// Retrieve data from Query String
		$titulo = $_GET['titulo'];
		$genero = $_GET['genero'];
		$usuario = $_GET['usuario'];
		$nombre = $_GET['nombre'];
		
		$nombre = substr($nombre,0,-4);
		// Escape User Input to help prevent SQL Injection
		//titulo = mysql_real_escape_string($titulo);
		//$genero = mysql_real_escape_string($genero);
		//$usuario = mysql_real_escape_string($usuario);
		//build query
		$query = "INSERT INTO tbl_musica(mus_nom,mus_titol,usu_id,gen_id) VALUES ('$nombre','$titulo',$usuario,$genero)";
		echo $query;
		$datos = mysqli_query($con,$query);
		header("Location: ../subir.php");

	}else{
		$_SESSION['validarse'] = 'error de validacio';
		header("Location: login.php");
		die();
	}
?>
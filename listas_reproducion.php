<?php
	session_start();
if(isset($_SESSION['id']))$login = 1;
if(isset($_COOKIE['Soundity']))$login = 1;
	if(isset($login)){
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Soundity</title>
		<link href="css/generic.css" rel="stylesheet" type="text/css" />
		
    	<script>
			//funcion que muestra el div oculto
			function mostrar(){
      		document.getElementById("alista").style="display:inline;"
  			}
    	</script>
	</head>
	<body>
		<?php include('header_menu.html'); ?>

		<div class="general">
		<div class="ui raised very centered padded text container segment">
		<h3>Mis Listas de Reproducción</h3>
			<?php
				include('conexion.php');
				$user = $_SESSION['id'];
				$sql = "SELECT * FROM tbl_usuari inner join tbl_llistes on tbl_usuari.usu_id=tbl_llistes.usu_id where tbl_usuari.usu_id=$user";
				$datos = mysqli_query ($con, $sql);
				if(mysqli_num_rows($datos)>0){
					$llistanom="hola";
					echo "<div class='list'>";
					While ($send = mysqli_fetch_array($datos)){
						$llistanom = utf8_encode($send['lli_nom']);
						$idllista = $send['lli_id'];
						?>
						<a href="lista.php?idllista=<?php echo $idllista;?>"><?php echo $llistanom;?></a> ----		
						<a href="procs/eliminar_lista.proc.php?idllista=<?php echo $idllista;?>" onClick="return confirm('Seguro que deseas eliminar esta lista de reproducción?')">Eliminar lista</a></br></br>
						<?php
					}
					echo "</div>";

				}else{
					echo "No hay listas de reprodución creadas.</br></br>";
				}	
			?>
		</div>
					<div class="nueva_lista">					
					<a href="#" onclick="mostrar();"><h3>Añade una nueva lista de reproducción: </h3></a>
		   				<div id="alista" style="visibility: hidden">
		      			<form action="procs/crear_lista.proc.php" method="post">
			  				<label>Introduce el nombre de la lista:</label><br/>
			  				<div class="ui input">
			  					<input type="text" name="lista">
			  				<div class="ui input">
			   				
			 			 	<input type="submit" class="ui inverted orange button" value="Enviar" />
						</form>
					</div>	
    </div>
	</body>
</html>
<?php
	}else{
		$_SESSION['validarse'] = 'error de validacio';
		header("Location: login.php");
		die();
	}
?>
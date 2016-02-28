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
		<!-- <link href="css/listas_reproducion.css" rel="stylesheet" type="text/css" /> -->
	</head>
	<body>
		<?php include('header_menu.html'); ?>
		<div class="general">
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
						<a href="lista.php?idllista=<?php echo $idllista;?>"><?php echo $llistanom;?></a></br>
						<?php
					}
					echo "</div>";
				}else{
					echo "No hay listas de reprodución creadas.";
				}	
			?>
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
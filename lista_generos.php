<?php
	session_start();
	if(isset($_SESSION['id']))$login = 1;
		if(isset($_COOKIE['Soundity']))$login = 1;
		if($login == 1){
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Soundity</title>
	<link rel="stylesheet" type="text/css" href="css/generos.css">
	
	<script>
		function onHover(i){
    		$("#" . id).attr('src', 'media/images/generos/Electronica_w.png');
		}
		function offHover(){
    		$("#" .id).attr('src', 'media/images/generos/Electronica.png');
		}
	</script>
</head>
<body>
	<?php include('header_menu.html'); ?>
	<section id="contenido">
		<section id="generos">

			<?php
			include("conexion.php");
			$sql = "SELECT * FROM tbl_genere";
			$datos = mysqli_query($con, $sql);
			if(mysqli_num_rows($datos)>0){
				
				while($genero = mysqli_fetch_array($datos)){
					$fichero="media/images/generos/$genero[gen_nom].png";
					?>
					<article class='elemento_genero' onclick="location.href='genero.php?gen=<?php echo $genero['gen_id']; ?>&genNom=<?php echo $genero['gen_nom']; ?>'">
						<?php echo "<div class='imagen'><img id='$genero[gen_id]' src='$fichero'</div>"?>
							
						<h3><?php echo $genero['gen_nom']; ?></h3>
					</article>
					<?php
				}
			}
			?>
		
			
		</section>
	
	</section>
</body>
</html>
<?php
	}else{
		$_SESSION['validarse'] = 'error';
		header("Location: login.php");
		die();
	}
?>
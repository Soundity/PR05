<?php
	session_start();
if(isset($_SESSION['id']))$login = 1;
if(isset($_COOKIE['Soundity']))$login = 1;
	if(isset($login)){
include('conexion.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Soundity</title>
		<link href="css/js-image-slider.css" rel="stylesheet" type="text/css" />
		<script src="js/js-image-slider.js" type="text/javascript"></script>
		<link rel="stylesheet" href="css/busqueda.css">
	</head>

	<body>
	<?php include('header_menu.html'); ?>
	<!-- CODI HTML DEL SLIDER -->
		<div id="sliderFrame">
			<div id="slider">
				<img src="media/images/Slider/slider1.jpg" alt="Top 1" />
				<img src="media/images/Slider/slider2.jpg" alt="Top 2" />
				<img src="media/images/Slider/slider3.jpg" alt="Top 3" />
				<img src="media/images/Slider/slider4.jpg" alt="Top 4" />
				<img src="media/images/Slider/slider5.jpg" alt="Top 5" />
			</div>
		</div>
	<!-- CODI HTML DEL TOP 5-->
	<div id="Top5">
		<?php
			$sql1 = "Select * From tbl_musica inner join tbl_usuari on tbl_musica.usu_id=tbl_usuari.usu_id inner join tbl_genere on tbl_musica.gen_id=tbl_genere.gen_id left join tbl_valoracio on tbl_musica.mus_id=tbl_valoracio.mus_id order by tbl_valoracio.val_puntuacio limit 5";
			
		?>
	</div>
	<!-- CODI HTML DELS GENERES PREFERITS-->	
		<div id="generesPreferits">
			<?php
				$id = $_SESSION['id'];
				$sql0 = "SELECT * FROM tbl_genere_usuari inner join tbl_genere on tbl_genere_usuari.gen_id=tbl_genere.gen_id inner join tbl_musica on tbl_genere.gen_id=tbl_musica.gen_id left join tbl_valoracio on tbl_musica.mus_id=tbl_valoracio.mus_id inner join tbl_usuari on tbl_musica.usu_id=tbl_usuari.usu_id WHERE tbl_genere_usuari.usu_id=$id";
				$datos0 = mysqli_query($con, $sql0);
				if(mysqli_num_rows($datos0)<=0){
					echo "</br></br><div class='seven wide centered column'>";
					echo "<div class='ui horizontal divider'>";
					echo "";
					echo "</div></div>";
				}else{
					echo "</br><div class='twelve wide centered column'><div class='ui horizontal divider'>";
					echo "<h2>Genero Favorito</h2></div></div><div class='ui two column centered grid'>";
					$genere="hola";
					while($pro0 = mysqli_fetch_array($datos0)) {
						if($genere != utf8_encode($pro0['gen_nom'])){
							$genere = utf8_encode($pro0['gen_nom']);
							echo "<div class='twelve wide centered column'><div class='ui horizontal divider'><h3>".$genere."</h3></div></div>";
						}
						echo "<div class='six wide centered column'>";
						echo "<div class='ui orange center aligned raised segment'>";
						echo "<div class='ui horizontal divider'>";
						echo utf8_encode("<h2>$pro0[mus_titol]</h2>");
						echo "</div>";
						
						echo "<h3>Género: </h3><p>$pro0[gen_nom]</p>";
						echo utf8_encode("<h3>Autor: </h3><p>$pro0[usu_nom]</p>");
						echo "<h3>Valoración: </h3>
								<div class='ui label'>
  									<i class='thumbs up large icon'></i> 23
								</div></div></div>";
					}
					echo "</div>";
				}
			?>
			
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
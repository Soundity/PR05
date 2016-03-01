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
		
		<link rel="stylesheet" type="text/css" href="css/generos.css">
        <link rel="stylesheet" type="text/css" href="css/styleRep1.css">
        <link rel="stylesheet" type="text/css" href="css/busqueda.css">
		<link href="css/js-image-slider.css" rel="stylesheet" type="text/css" />
		
		<script src="js/js-image-slider.js" type="text/javascript"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
        <script type="text/javascript" src="js/botonesReproductor1.js"></script>
	</head>

	<body>
	<?php include('header_menu.html'); ?>
	<!-- CODI HTML DEL SLIDER -->
		<div id="sliderFrame">
			<div id="slider">
				<img src="media/images/Slider/slider1.jpg" />
				<img src="media/images/Slider/slider2.jpg" />
				<img src="media/images/Slider/slider3.jpg" />
				<img src="media/images/Slider/slider4.jpg" />
				<img src="media/images/Slider/slider5.jpg" />
			</div>
		</div>
	<!-- CODI HTML DEL TOP 5-->
	<div id="Top5">
		<?php
			$sql1 = "Select distinct tbl_genere.gen_nom, tbl_usuari.usu_nom, tbl_musica.mus_titol, tbl_musica.mus_nom, tbl_valoracio.mus_id, COUNT(tbl_valoracio.val_puntuacio) as 'totalvots' From tbl_musica inner join tbl_usuari on tbl_musica.usu_id=tbl_usuari.usu_id inner join tbl_genere on tbl_musica.gen_id=tbl_genere.gen_id left join tbl_valoracio on tbl_musica.mus_id=tbl_valoracio.mus_id where tbl_valoracio.val_puntuacio=1 group by tbl_valoracio.mus_id limit 5";
			$datos1 = mysqli_query($con, $sql1);
			if(mysqli_num_rows($datos1)<=0){
					echo "</br></br><div class='seven wide centered column'>";
					echo "<div class='ui horizontal divider'>";
					echo "";
					echo "</div></div>";
				}else{
					echo "</br><div class='twelve wide centered column'><div class='ui horizontal divider'>";
					echo "<h2>TOP 5</h2></div></div><div class='ui two column centered grid'>";
					while($pro1 = mysqli_fetch_array($datos1)) {
						echo "<div class='five wide centered column'>";
						echo "<article class='cancion' data-source='media/music/$pro1[mus_nom]'><div class='ui orange center aligned raised segment'>";
						echo "<div class='ui horizontal divider'>";
						echo utf8_encode("<h2>$pro1[mus_titol]</h2>");
						echo "</div>";
						
						echo "<h3>Género: </h3><p>$pro1[gen_nom]</p>";
						echo utf8_encode("<h3>Autor: </h3><p>$pro1[usu_nom]</p>");
						echo "<h3>Valoración: </h3><div class='ui label'><i class='thumbs up large icon'></i>$pro1[totalvots]</div></div></article></div>";
					}
					echo "</div>";
				}
		?>
	</div>
	<!-- CODI HTML DELS GENERES PREFERITS-->	
		<div id="generesPreferits">
			<?php
			//tbl_genere.gen_nom, tbl_usuari.usu_nom, tbl_musica.mus_titol, tbl_musica.mus_nom, tbl_musica.usu_comptador
				$id = $_SESSION['id'];
				$sql0 = "SELECT * FROM tbl_genere_usuari inner join tbl_genere on tbl_genere_usuari.gen_id=tbl_genere.gen_id inner join tbl_musica on tbl_genere.gen_id=tbl_musica.gen_id inner join tbl_usuari on tbl_musica.usu_id=tbl_usuari.usu_id left join (Select sum(tbl_valoracio.val_puntuacio) as totalvots, mus_id from tbl_valoracio group by mus_id) as queryGen on tbl_musica.mus_id=queryGen.mus_id WHERE tbl_genere_usuari.usu_id=$id";
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
						echo "<article class='cancion' data-source='media/music/$pro0[mus_nom]'><div class='ui orange center aligned raised segment'>";
						echo "<div class='ui horizontal divider'>";
						echo utf8_encode("<h2>$pro0[mus_titol] </h2>");
						echo "</div>";
						
						echo "<h3>Género: </h3><p>$pro0[gen_nom] </p>";
						echo utf8_encode("<h3>Autor: </h3><p>$pro0[usu_nom] </p>");
						echo "<h3>Valoración: </h3>
								<div class='ui label'>
  									<i class='thumbs up large icon'></i>$pro0[totalvots]
								 </div></div></article></div>";
					}
					echo "</div>";
				}
			?>
		</div>
		<!-- CODI HTML DEL REPRODUCTOR -->
			<section id="player" data-autoplay='1' data-loop='1'>
				<section id="controls">
					<section id="songTitle">
						<span>Selecciona una canción</span>
					</section>
					<section id="playertrols">
						<div id="plauseStop">
							<div id="plause"></div>
							<div id="stop"></div>
						</div>
						<div id="progressBar">
							<div id="timeLoaded"></div>
							<div id="timePlayed"></div>
						</div>
					</section>
					<section id="volumeTime">
						<input type="range" min="0" max="1" step="0.1" value="0.5" />
						<div id="timeStatus">
							<time id="played">00:00</time>
							<span>/</span>
							<time id="totalTime">00:00</time>
						</div>
					</section>
				</section>
			</section>

	</body>
</html>
<?php
	}else{
		$_SESSION['validarse'] = 'error de validacio';
		header("Location: login.php");
		die();
	}
?>
<?php  
	session_start();
include('header_menu.html');
include('conexion.php');
	$sql0 = "SELECT * FROM tbl_usuari WHERE usu_nom LIKE'%$_REQUEST[buscar]%'";
	$datos0 = mysqli_query($con, $sql0);
	$sql1 = "SELECT * FROM tbl_musica INNER JOIN tbl_genere ON tbl_musica.gen_id=tbl_genere.gen_id INNER JOIN tbl_usuari on tbl_musica.usu_id = tbl_usuari.usu_id WHERE mus_titol LIKE'%$_REQUEST[buscar]%'";
	$datos1 = mysqli_query($con, $sql1);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>¡web de resultados!</title>
		<link rel="stylesheet" href="dist/semantic.min.css">
		<link rel="stylesheet" href="css/busqueda.css">
		<link rel="stylesheet" type="text/css" href="css/styleRep1.css">
		<script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
		<script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
		<script type="text/javascript" src="js/botonesReproductor1.js"></script>
	</head>
	<body>
		<div class="ui grid">
			<?php
			if(mysqli_num_rows($datos0)<=0){
				echo "<div class='nine wide centered column'>";
				echo "<div class='no_result'>";
				echo "<div class='ui horizontal divider'>";
				echo "No hay resultados de Autores";
				echo "</div>";
				echo "</div>";
				echo "</div>";
			}else{
				while($pro0 = mysqli_fetch_array($datos0)) {
					echo "<div class='twelve wide centered column'>";
					echo "<div class='ui orange raised segment'>";
					echo "<div class='ui horizontal divider'>";
					echo utf8_encode("<h2>$pro0[usu_nom]</h2>");
					echo "</div>";
					echo "<img class='ui small center left circular floated image' src='media/images/avatar.png'>
						<button class='ui orange button'>
							<i class='info circle large icon'></i>
							Ver Perfil
						</button>";
					echo "</div>";
					echo "</div>";
				}
			}
		?>
		</div> 
		<div class="ui grid">
			<?php
				if(mysqli_num_rows($datos1)<=0){
					echo "<div class='nine wide centered column'>";
					echo "<div class='no_result'>";
					echo "<div class='ui horizontal divider'>";
					echo "No hay resultados de Música";
					echo "</div>";
					echo "</div>";
					echo "</div>";
						
				}else{
					while($pro1 = mysqli_fetch_array($datos1)) {
						echo "<div class='twelve wide centered column'>";
						echo "<div class='ui orange raised segment'>";
						echo "<div class='ui horizontal divider'>";
						echo utf8_encode("<h2>$pro1[mus_titol]</h2>");
						echo "</div>";
						echo "<div class='flotante'>";
						echo "<h3>Género: </h3><p>$pro1[gen_nom]</p>";
						echo "<h3>Autor: </h3><p>$pro1[usu_nom]</p>";
						echo "<h3>Valoración: </h3>
								<div class='ui label'>
  									<i class='thumbs up large icon'></i> 23
								</div>";
						echo "</div>";
						?><article class="cancion" data-source="media/music/<?php echo $pro1['mus_nom']; ?>"><p id="nomOculto"><?php echo $pro1['mus_titol']; ?></p><img src="media/images/play.png"></img></article><?php
						echo "</div>";
						echo "</div>";
					}
				}
			?>
  		</div> 
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
						<div id="timeLoaded"><div id="timePlayed"></div></div>
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
<?php
	session_start();
	/*if(!isset($_SESSION['mail'])){
		$_SESSION['error']="Tienes que logarte";
		header("Location: index.php");
	}*/
	include("header_menu.html");
?>
<link rel="stylesheet" type="text/css" href="css/generos.css">
<link rel="stylesheet" type="text/css" href="css/styleRep1.css">
<script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
<script type="text/javascript" src="js/botonesReproductor1.js"></script>
<section id="contenido">
	<section id="generos">
		<?php
			include("conexion.php");
			$sql = "SELECT * FROM tbl_musica WHERE gen_id=$_REQUEST[gen]";
			$datos = mysqli_query($con, $sql);
			if(mysqli_num_rows($datos)>0){
				while($cancion = mysqli_fetch_array($datos)){
					?>
					<article class="cancion" data-source="media/music/<?php echo $cancion['mus_nom'] ?>">
						<p><?php echo "Nombre: ".$cancion['mus_titol']."   |   Genero: ".$_REQUEST['genNom']; ?></p>
					</article>
					<?php
				}
			}
		?>
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
	</section>
</section>
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
	<link rel="stylesheet" type="text/css" href="css/styleRep1.css">
	<script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
	<script type="text/javascript" src="js/botonesReproductor1.js"></script>
	<script type="text/javascript" src="js/valoracion.js"></script>
</head>
<body>
<?php include('header_menu.html'); ?>
<section id="contenido">
	<section id="generos">
		<?php
			include("conexion.php");
			$sql = "SELECT tbl_musica.mus_id, tbl_musica.mus_nom, tbl_musica.mus_titol, tbl_usuari.usu_nom, totalvots FROM tbl_musica inner join tbl_usuari on tbl_musica.usu_id=tbl_usuari.usu_id left join (Select sum(tbl_valoracio.val_puntuacio) as totalvots, mus_id from tbl_valoracio group by mus_id) as queryGen on tbl_musica.mus_id=queryGen.mus_id WHERE gen_id=$_REQUEST[gen] order BY totalvots DESC";
			//echo $sql;
			$datos = mysqli_query($con, $sql);
			if(mysqli_num_rows($datos)>0){
				while($cancion = mysqli_fetch_array($datos)){
					?>
					<article class="cancion" data-source="media/music/<?php echo $cancion['mus_nom'] ?>">
						<p><?php echo "Nombre: ".$cancion['mus_titol']."   |   Genero: ".$_REQUEST['genNom']. "   |    Valoración: ";
						$usuari=$_SESSION['id'];
						$sql2 = "Select * from tbl_valoracio where mus_id=$cancion[mus_id] AND usu_id=$usuari";
						//echo $sql2;
						$datos2 = mysqli_query($con, $sql2);
						if(mysqli_num_rows($datos2)==0){
							// POTS VOTAR
							echo"<i id=$cancion[mus_id] class=' thumbs outline up icon' onclick='suscriM($cancion[mus_id]);'></i>";
							echo"<i id=$cancion[mus_id] class=' thumbs outline down icon' onclick='suscriN($cancion[mus_id]);'></i>";
							if ($cancion['totalvots']!=0){
								echo $cancion['totalvots']. " Votos";
							} else {
								echo "0 Votos";
							}
						}else{
							// JA HAS VOTAT 
							while($pro2 = mysqli_fetch_array($datos2)) {	
								if ($pro2['val_puntuacio']==1){
									echo"<i id=$cancion[mus_id] class=' thumbs outline down icon' onclick='suscriN($cancion[mus_id]);'></i>$cancion[totalvots] Te Gusta ";
								} else {
									echo"<i id=$cancion[mus_id] class=' thumbs outline up icon' onclick='suscriM($cancion[mus_id]);'></i>$cancion[totalvots] Ya no te gusta ";
								}
							}
						}?></p>
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
						<div id="plause"><i class="play icon"></i></div>
						<div id="stop"><i class="stop icon"></i></div>
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
</body>
</html>
<?php
	}else{
		$_SESSION['validarse'] = 'error';
		header("Location: login.php");
		die();
	}
?>
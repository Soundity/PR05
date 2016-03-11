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
		<link rel="stylesheet" type="text/css" href="css/styleRep1.css">
		<link rel="stylesheet" type="text/css" href="css/generos.css">
		<link href="css/generic.css" rel="stylesheet" type="text/css" />
		<link href="css/listas_reproducion.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    	<script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
    	<script type="text/javascript" src="js/botonesReproductor2.js"></script>
		<script type="text/javascript" src="js/valoracion.js"></script>
	</head>
	<body>
	<?php include('header_menu.html'); ?>
		<div class="general">
			<?php
				include('conexion.php');
				$user = $_SESSION['id'];
				$llista = $_REQUEST['idllista'];
				$sql = "SELECT tbl_musica.mus_id, tbl_musica.mus_nom, tbl_musica.mus_titol, tbl_usuari.usu_nom, tbl_llistes_musica.lmu_id, tbl_genere.gen_nom, tbl_llistes.lli_id, tbl_llistes.lli_nom, totalvots FROM tbl_usuari inner join tbl_llistes on tbl_usuari.usu_id=tbl_llistes.usu_id inner join tbl_llistes_musica on tbl_llistes.lli_id=tbl_llistes_musica.lli_id inner join tbl_musica on tbl_llistes_musica.mus_id=tbl_musica.mus_id inner join tbl_genere on tbl_musica.gen_id=tbl_genere.gen_id left join (Select sum(tbl_valoracio.val_puntuacio) as totalvots, mus_id from tbl_valoracio group by mus_id) as queryGen on tbl_musica.mus_id=queryGen.mus_id where tbl_llistes.lli_id=".$llista;
				$datos = mysqli_query ($con, $sql);
				if(mysqli_num_rows($datos)>0){
					$llistanom="hola";
					echo "<div id='tracks' class='list'>";
					
					while ($send = mysqli_fetch_array($datos)){
						if($llistanom != utf8_encode($send['lli_nom'])){
							$llistanom = utf8_encode($send['lli_nom']);
							echo "<h1 id='title'>".$llistanom."</h1>";
						}
						?>
						<article class="cancion" data-source="media/music/<?php echo $send['mus_nom'] ?>">
							<p><?php echo utf8_encode("Nombre: ".$send['mus_titol']."   |   Genero: ".$send['gen_nom']. "   |    Valoración: "); 
							$usuari=$_SESSION['id'];
						$sql2 = "Select * from tbl_valoracio where mus_id=$send[mus_id] AND usu_id=$usuari";
						//echo $sql2;
						$datos2 = mysqli_query($con, $sql2);
						if(mysqli_num_rows($datos2)==0){
							// POTS VOTAR
							echo"<i id=$send[mus_id] class='large thumbs outline up icon' onclick='suscriM($send[mus_id]);'></i>";
							echo"<i id=$send[mus_id] class='large thumbs outline down icon' onclick='suscriN($send[mus_id]);'></i>";
							if ($send['totalvots']!=0){
								echo $send['totalvots']. " Votos";
							} else {
								echo "0 Votos";
							}
						}else{
							// JA HAS VOTAT 
							while($pro2 = mysqli_fetch_array($datos2)) {	
								if ($pro2['val_puntuacio']==1){
									echo"<i id=$send[mus_id] class='large thumbs outline down icon' onclick='suscriN($send[mus_id]);'></i>$send[totalvots] Te Gusta ";
								} else {
									echo"<i id=$send[mus_id] class='large thumbs outline up icon' onclick='suscriM($send[mus_id]);'></i>$send[totalvots] Ya no te gusta ";
									
								}
							}
						}?>
						<a href="procs/eliminar_cancion_lista.proc.php?idllista=<?php echo $send['lli_id']?>&lmu_id=<?php echo $send['lmu_id'];?>" onClick="return confirm('Seguro que deseas eliminar esta cancion de la lista de reproducción?')">Eliminar cancion de la lista.</a>
						</p>
						</article>
					<?php
					}
					echo "</div>";
					?>
					<section id="player" data-autoplay='1' data-loop='1'>
                    <section id="controls">
                        <section id="songTitle">
                            <span><?php echo utf8_encode("Selecciona una canción"); ?></span>
                        </section>
                        <section id="playertrols">
                            <div id="plauseStop">
                                <div id="plause"><i id="playPause" class="play icon"></i></div>
                                <div id="stop"><i class="stop icon"></i></div>
                                <div id="backward"><i class="step backward icon"></i></div>
                                <div id="forward"><i class="step forward icon"></i></div>
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
                <?php
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
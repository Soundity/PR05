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
		<link rel="stylesheet" href="css/modal.css">	
		<link rel="stylesheet" type="text/css" href="css/styleRep1.css">
		<script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
		<script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
		<script type="text/javascript" src="js/botonesReproductor1.js"></script>
		<script type="text/javascript" src="js/valoracion.js"></script>
		<script>
			function objetoAjax(){
				var xmlhttp=false;
				try {
					xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (E) {
						xmlhttp = false;
					}
				}
	 
				if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
					xmlhttp = new XMLHttpRequest();
				}
				return xmlhttp;
			}
			function pasarVariable(cancion){
				document.getElementById("buscar").value=cancion;
			}
			function listaBD(id){
				var lli_id=document.getElementById("listaFORM").value;
				var mus_id=document.getElementById("buscar").value;
					alert(lli_id);
					alert(mus_id);
					ajax=objetoAjax();
					ajax.open("POST", "procs/AmusLista.proc.php?lli_id="+lli_id+"&mus_id="+mus_id,true);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==4) {
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send(null);
					alert("Cancion añadida correctamente");
					window.location.href = "busqueda.php?buscar=";
			}
		</script>
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
							$valor=$cancion['mus_id'];
							?>
							<article id="generos" >
								<div class='cancion2'>
								<?php echo "<div class='cancion' data-source='media/music/$cancion[mus_nom]'><i class='play icon' ></i><p style='display:none'>Nombre: ".$cancion['mus_titol']."   |   Genero: ".$_REQUEST['genNom']. " </p></div>";
								echo "Nombre: ".$cancion['mus_titol']."   |   Genero: ".$_REQUEST['genNom']. "   |      Valoración: ";
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
								}?>
							
							<?php
							echo "Añadir a mi lista <a href='#lista' onclick='pasarVariable($valor);'>| Clica aquí</a></div></article>";
						}
					}
				?>
				
				<!-- SELECCIONAR LISTA / MODALBOX -->
				<div id="lista" class="modalmask">
					<div class="modalbox movedown" id="resultadoContent">
						<?php
							$sqlListas="SELECT COUNT(lli_id) AS total, usu_id, lli_id,lli_nom FROM tbl_llistes WHERE usu_id=$_SESSION[id] group by lli_id";
							$listas = mysqli_query($con, $sqlListas);
							if(mysqli_num_rows($listas)>0){
						?>
						<!-- Seleccionar lista -->
						<form name="lista" action="#">
							<label><input id="buscar" name="buscar" type="hidden" value="" /></label>
							<a href="#close" class="boxclose"><img src="media/images/close.png" alt=""></a>
							<h2 >Selecciona una lista</h2>
							<?php
								$filas=mysqli_num_rows($listas);
							?>
							<div id="contenidoListas">
								<select id="listaFORM" name="Listas">					
									<?php						
										echo $_REQUEST['idmusicaadd'];						
										while($misListas=mysqli_fetch_array($listas)) {							
											echo "<option value=\"$misListas[lli_id]\">$misListas[lli_nom]</option>";
										}
									?>
								</select>
								<input type="submit" onClick="listaBD()" class='ui orange button' value="Añadir">
							</div>
						</form>
						<div>
							
							<?php
								}else{
									?>
									<a href="#close" class="boxclose"><img src="media/images/close.png" alt=""></a>
									<?php
									echo "No tienes ninguna lista:</br>";
									echo "<a class='ui orange button' href=listas_reproducion.php>Crear nueva lista</a>";
								}
							?>
						</div>
					</div>
				</div>
				<!-- REPRODUCTOR -->
				<section id="player" data-autoplay='1' data-loop='1'>
					<section id="controls">
						<section id="songTitle">
							<span>Selecciona una canción</span>
						</section>
						<section id="playertrols">
							<div id="plauseStop">
								<div id="plause"><i id="playPause" class="play icon"></i></div>
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
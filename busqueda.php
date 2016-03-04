<?php
include('conexion.php');
	$sql0 = "SELECT * FROM tbl_usuari WHERE usu_nom LIKE'%$_REQUEST[buscar]%'";
	$datos0 = mysqli_query($con, $sql0);
	$sql1= "SELECT distinct tbl_genere.gen_nom, tbl_genere.gen_id, tbl_usuari.usu_nom, tbl_usuari.usu_id, tbl_musica.mus_titol, tbl_musica.mus_nom, tbl_musica.mus_id, tbl_valoracio.val_id, sum(tbl_valoracio.val_puntuacio) as 'totalvots' FROM tbl_musica INNER JOIN tbl_genere ON tbl_musica.gen_id=tbl_genere.gen_id INNER JOIN tbl_usuari on tbl_musica.usu_id = tbl_usuari.usu_id left join tbl_valoracio on tbl_musica.mus_id=tbl_valoracio.mus_id WHERE mus_titol LIKE'%$_REQUEST[buscar]%' group by tbl_musica.mus_id";
	$datos1 = mysqli_query($con, $sql1);
	session_start();
if(isset($_SESSION['id']))$login = 1;
if(isset($_COOKIE['Soundity']))$login = 1;
	if(isset($login)){
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>¡web de resultados!</title>
		<link rel="stylesheet" href="css/modal.css">
		<link rel="stylesheet" href="css/busqueda.css">
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
				document.getElementById("buscarBD").value=cancion;
			}
			function listaBD(id){
				var lli_id=document.getElementById("listaFORM").value;
				var mus_id=document.getElementById("buscarBD").value;
					ajax=objetoAjax();
					ajax.open("POST", "procs/AmusLista.proc.php?lli_id="+lli_id+"&mus_id="+mus_id,true);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==4) {
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send(null);
					alert("Cancion añadida correctamente");
					window.locationf="busqueda.php";
				}
			
		</script>
	</head>
	<body>
		<?php
			include('header_menu.html');
			include('autores.php');
		?>
		<!-- CADA CANCION -->
		<div class="ui two column centered grid">
			<?php
				// NO HAY DATOS DE MUSICA
				if(mysqli_num_rows($datos1)<=0){
					echo "<div class='seven wide centered column'>";
					echo "<div class='ui horizontal divider'>";
					echo "No hay resultados de Música";
					echo "</div>";
					echo "</div>";
				// HAY DATOS DE MUSICA
				}else{
					echo "<div class='twelve wide centered column'>";
					echo "<div class='ui horizontal divider'>";
					echo "<h2>Canciones</h2></div></div>";
					// CREAMOS CADA CANCION
					while($pro1 = mysqli_fetch_array($datos1)) {
						echo "<div class='six wide centered column'>";
						echo "<div id='generos' class='ui orange center aligned raised segment'>";
						// TITULO CANCION
						echo "<div class='ui horizontal divider'>";
						echo utf8_encode("<h2>$pro1[mus_titol]</h2>");
						echo "</div>";
						// GENERO CANCION
						echo "<div class='cancion' data-source='media/music/$pro1[mus_nom]'><i class='play icon'></i><p style='display:none'>Nombre: $pro1[mus_titol] | Genero: $pro1[gen_nom] </p></div>";
						echo "<h3>Género: </h3><p>$pro1[gen_nom]</p>";
						$valor=$pro1['mus_id'];
			?>
				<?php
					// AUTOR CANCION
					echo utf8_encode("<h3>Autor: </h3><p>$pro1[usu_nom]</p>");
					// AÑADIR A LISTA
				?>
				<h3>Añadir a mi lista <a href='#lista' onclick="pasarVariable(<?php echo $valor; ?>);">Clica aquí</a></h3>
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
						<label><input id="buscarBD" name="buscarBD" type="hidden" value="" /></label>
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
					<div>
						<a href="#close" class="boxclose"><img src="media/images/close.png" alt=""></a>
						<?php
								echo "No tienes ninguna lista:</br>";
								echo "<a class='ui orange button' href=listas_reproducion.php>Crear nueva lista</a>";
							}
						?>
    				</div>
				</div>
			</div>
			<?php
				echo "<h3>Valoración: </h3>";
				echo "<div class='ui label'>";
				$usuari=$_SESSION['id'];
				$sql2 = "Select * from tbl_valoracio where mus_id=$pro1[mus_id] & usu_id=$usuari";
				//echo $sql2;
				$datos2 = mysqli_query($con, $sql2);
				if(mysqli_num_rows($datos2)==0){
					// POTS VOTAR
					echo"<i id=$pro1[mus_id] class=' thumbs outline up icon' onclick='suscriM($pro1[mus_id]);'></i>";
					echo"<i id=$pro1[mus_id] class=' thumbs outline down icon' onclick='suscriN($pro1[mus_id]);'></i>";
					if ($pro1['totalvots']!=0){
						echo $pro1['totalvots']. " Votos";
					} else {
						echo "0 Votos";
					}
				}else{
					// JA HAS VOTAR 
					while($pro2 = mysqli_fetch_array($datos2)) {
						if ($pro2['val_puntuacio']==1){
							echo"<i id=$pro1[mus_id] class=' thumbs outline down icon' onclick='suscriN($pro1[mus_id]);'></i>$pro1[totalvots] Te Gusta ";
						} else {
							echo"<i id=$pro1[mus_id] class=' thumbs outline up icon' onclick='suscriM($pro1[mus_id]);'></i>$pro1[totalvots] Ya no te gusta ";
						}
					}
				}
				echo "</div>";
				echo "</div>";
				echo "</div>";
			}
			}
				?>
			</div>
		</div>
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
	</body>
</html>
<?php
	}else{
		$_SESSION['validarse'] = 'error de validacio';
		header("Location: login.php");
		die();
	}
?>
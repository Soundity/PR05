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
		
		<link rel="stylesheet" href="css/busqueda.css">
		<script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
		<script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
		<script type="text/javascript" src="js/botonesReproductor1.js"></script>
		<script type="text/javascript" src="js/valoracion.js"></script>
	</head>
	<body>
	<?php include('header_menu.html'); ?>
		<div class="ui two column centered grid">
		<?php
			if(mysqli_num_rows($datos0)<=0){
				echo "<div class='seven wide centered column'>";
				echo "<div class='ui horizontal divider'>";
				echo "No hay resultados de Autores";
				echo "</div></div>";
			}else{
				echo "<div class='twelve wide centered column'><div class='ui horizontal divider'>";
				echo "<h2>Artistas</h2></div></div>";
				while($pro0 = mysqli_fetch_array($datos0)) {
					
					echo "<div class='six wide centered column'>";
						echo "<div class='ui yellow center aligned raised segment'>";
						echo "<div class='ui horizontal divider'>";
						echo utf8_encode("<h2>$pro0[usu_nom]</h2>");
						echo "</div>";
					
						if(!empty($pro0['usu_avatar'])){
	          				$fichero="media/images/avatares/$pro0[usu_avatar]";
	          				echo"<img class='ui small centered circular image' src='$fichero'>";
	        			}else{
	          				echo"<img class='ui small centered circular image' src='media/images/avatar.png'>";
	        			}
						
							echo "<a href='verperfil.php?iduser=$pro0[usu_id]' class='ui orange button'>
								<i class='info circle large icon'></i>
								Ver Perfil
							</a>";
					echo "</div></div>";
				}
			}
		?>
		</div> 
		<div class="ui two column centered grid">
			<?php
				if(mysqli_num_rows($datos1)<=0){
					echo "<div class='seven wide centered column'>";
					echo "<div class='ui horizontal divider'>";
					echo "No hay resultados de Música";
					echo "</div></div>";
						
				}else{
					echo "<div class='twelve wide centered column'><div class='ui horizontal divider'>";
					echo "<h2>Canciones</h2></div></div>";
					while($pro1 = mysqli_fetch_array($datos1)) {
						echo "<div class='six wide centered column'>";
						echo "<div class='ui orange center aligned raised segment'>";
						echo "<div class='ui horizontal divider'>";
						echo utf8_encode("<h2>$pro1[mus_titol]</h2>");
						echo "</div>";
						
						echo "<h3>Género: </h3><p>$pro1[gen_nom]</p>";
						echo utf8_encode("<h3>Autor: </h3><p>$pro1[usu_nom]</p>");
						echo "<h3>Valoración: </h3><div class='ui label'>";
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
								echo "</div></div></div>";
					}
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
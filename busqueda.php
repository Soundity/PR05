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
						echo "</div>";
						echo "</div>";
					}
				}
			?>
  		</div> 
	</body>
</html>